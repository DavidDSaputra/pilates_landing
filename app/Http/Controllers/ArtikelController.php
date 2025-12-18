<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Artikel::with('penulis');

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('konten', 'like', "%{$search}%");
            });
        }

        // Penulis filter
        if ($request->filled('penulis')) {
            $query->where('penulis_id', $request->penulis);
        }

        $artikels = $query->latest()->paginate(10)->withQueryString();

        // Get all penulis for filter dropdown
        $penulis = User::whereIn('role', ['penulis', 'admin', 'super_admin'])->get();

        return view('admin.artikel.index', compact('artikels', 'penulis'));
    }

    /**
     * Display a listing of published articles for frontend.
     */
    public function list()
    {
        $artikels = Artikel::with('penulis')
            ->latest('created_at')
            ->paginate(12);

        return view('artikel', compact('artikels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil semua penulis untuk dropdown
        $penulis = User::where('role', 'penulis')
            ->orWhere('role', 'admin')
            ->get();

        return view('admin.artikel.create', compact('penulis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'gambar_featured' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string',
            'tags' => 'nullable|string',
            'penulis_id' => 'required|exists:users,id',
        ]);

        // Generate slug dari judul
        $validated['slug'] = Str::slug($validated['judul']) . '-' . time();

        // Handle upload gambar featured
        if ($request->hasFile('gambar_featured')) {
            $gambarPath = $request->file('gambar_featured')->store('artikel/featured', 'public');
            $validated['gambar_featured'] = $gambarPath;
        }

        // Konversi tags dari string ke array
        if ($request->filled('tags')) {
            $tags = explode(',', $request->tags);
            $tags = array_map('trim', $tags);
            $tags = array_filter($tags);
            $validated['tags'] = $tags;
        }

        // Simpan artikel
        Artikel::create($validated);

        return redirect()->route('admin.artikels.index')
            ->with('success', 'Artikel berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $artikel = Artikel::with('penulis')->findOrFail($id);

        return view('admin.artikel.show', compact('artikel'));
    }

    /**
     * Display the specified published article for frontend.
     */
    public function detail(string $slug)
    {
        $artikel = Artikel::with('penulis')
            ->where('slug', $slug)
            ->firstOrFail();

        // Increment views
        $artikel->increment('views');

        // Ambil artikel populer untuk sidebar
        $popularArticles = Artikel::popular(5)->get();

        // Ambil artikel terkait berdasarkan tags
        $relatedArticles = Artikel::where('id', '!=', $artikel->id)
            ->where(function ($query) use ($artikel) {
                if ($artikel->tags) {
                    foreach ($artikel->tags as $tag) {
                        $query->orWhereJsonContains('tags', $tag);
                    }
                }
            })
            ->take(3)
            ->get();

        return view('artikel.detail', compact('artikel', 'popularArticles', 'relatedArticles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $artikel = Artikel::findOrFail($id);
        $penulis = User::where('role', 'penulis')
            ->orWhere('role', 'admin')
            ->get();

        // Konversi tags array ke string untuk form
        if ($artikel->tags) {
            $artikel->tags_string = implode(', ', $artikel->tags);
        }

        return view('admin.artikel.edit', compact('artikel', 'penulis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $artikel = Artikel::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'gambar_featured' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string',
            'tags' => 'nullable|string',
            'penulis_id' => 'required|exists:users,id',
        ]);

        // Generate slug baru jika judul berubah
        if ($artikel->judul !== $validated['judul']) {
            $validated['slug'] = Str::slug($validated['judul']) . '-' . time();
        }

        // Handle upload gambar featured jika ada
        if ($request->hasFile('gambar_featured')) {
            // Hapus gambar lama jika ada
            if ($artikel->gambar_featured) {
                Storage::disk('public')->delete($artikel->gambar_featured);
            }

            $gambarPath = $request->file('gambar_featured')->store('artikel/featured', 'public');
            $validated['gambar_featured'] = $gambarPath;
        }

        // Konversi tags dari string ke array
        if ($request->filled('tags')) {
            $tags = explode(',', $request->tags);
            $tags = array_map('trim', $tags);
            $tags = array_filter($tags);
            $validated['tags'] = $tags;
        } else {
            $validated['tags'] = null;
        }

        // Update artikel
        $artikel->update($validated);

        return redirect()->route('admin.artikels.index')
            ->with('success', 'Artikel berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $artikel = Artikel::findOrFail($id);

        // Hapus gambar featured jika ada
        if ($artikel->gambar_featured) {
            Storage::disk('public')->delete($artikel->gambar_featured);
        }

        $artikel->delete();

        return redirect()->route('admin.artikels.index')
            ->with('success', 'Artikel berhasil dihapus.');
    }

    /**
     * Search articles by title or content.
     */
    public function search(Request $request)
    {
        $search = $request->input('search');

        $artikels = Artikel::with('penulis')
            ->where('judul', 'like', "%{$search}%")
            ->orWhere('konten', 'like', "%{$search}%")
            ->orWhere('meta_keywords', 'like', "%{$search}%")
            ->latest()
            ->paginate(10);

        return view('admin.artikel.index', compact('artikels'));
    }

    /**
     * Search articles for frontend.
     */
    public function searchFrontend(Request $request)
    {
        $search = $request->input('q');

        $artikels = Artikel::with('penulis')
            ->where('judul', 'like', "%{$search}%")
            ->orWhere('konten', 'like', "%{$search}%")
            ->orWhere('meta_keywords', 'like', "%{$search}%")
            ->latest('created_at')
            ->paginate(12);

        return view('artikel.search', compact('artikels', 'search'));
    }

    /**
     * Get articles by tag.
     */
    public function byTag($tag)
    {
        $artikels = Artikel::with('penulis')
            ->whereJsonContains('tags', $tag)
            ->latest('created_at')
            ->paginate(12);

        return view('artikel.tag', compact('artikels', 'tag'));
    }

    /**
     * Get articles by author.
     */
    public function byAuthor($penulisId)
    {
        $penulis = User::findOrFail($penulisId);

        $artikels = Artikel::where('penulis_id', $penulisId)
            ->with('penulis')
            ->latest('created_at')
            ->paginate(12);

        return view('artikel.author', compact('artikels', 'penulis'));
    }

    /**
     * Get popular articles.
     */
    public function popular()
    {
        $artikels = Artikel::with('penulis')
            ->orderBy('views', 'desc')
            ->paginate(12);

        return view('artikel.popular', compact('artikels'));
    }

    /**
     * Increment article views.
     */
    public function incrementViews($id)
    {
        $artikel = Artikel::findOrFail($id);
        $artikel->increment('views');

        return response()->json(['views' => $artikel->views]);
    }
}