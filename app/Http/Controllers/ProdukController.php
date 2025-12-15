<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\KategoriProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Models\GambarProduk;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $produk = Produk::with(['kategori', 'gambar'])
            ->when($request->search, function ($query) use ($request) {
                $query->where('nama_produk', 'like', "%{$request->search}%")
                    ->orWhere('deskripsi_lengkap', 'like', "%{$request->search}%")
                    ->orWhere('slug', 'like', "%{$request->search}%");
            })
            ->when($request->kategori, function ($query) use ($request) {
                $query->where('kategori_id', $request->kategori);
            })
            ->latest()
            ->paginate(15)
            ->appends($request->all());

        $kategori = KategoriProduk::orderBy('nama_kategori')->get();

        return view('admin.produk.index', compact('produk', 'kategori'));
    }

    public function create()
    {
        $kategori = KategoriProduk::all();
        return view('admin.produk.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori_produk,id',
            'deskripsi_lengkap' => 'nullable|string',
            'gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gambar_produk.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:500',
            'og_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'canonical_url' => 'nullable|url|max:500',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->nama_produk);

        if ($request->hasFile('gambar_utama')) {
            $data['gambar_utama'] = $request->file('gambar_utama')->store('produk', 'public');
        }

        if ($request->hasFile('og_image')) {
            $data['og_image'] = $request->file('og_image')->store('produk/og', 'public');
        }

        $produk = Produk::create($data);

        // Handle Gallery Uploads
        if ($request->hasFile('gambar_produk')) {
            foreach ($request->file('gambar_produk') as $file) {
                $path = $file->store('produk/gallery', 'public');
                GambarProduk::create([
                    'produk_id' => $produk->id,
                    'nama_file' => $path,
                ]);
            }
        }

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function show($id)
    {
        $produk = Produk::with(['kategori', 'gambar'])->findOrFail($id);
        return view('admin.produk.show', compact('produk'));
    }

    public function edit($id)
    {
        $produk = Produk::with('gambar')->findOrFail($id);
        $kategori = KategoriProduk::all();
        return view('admin.produk.edit', compact('produk', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori_produk,id',
            'deskripsi_lengkap' => 'nullable|string',
            'gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gambar_produk.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:500',
            'og_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'canonical_url' => 'nullable|url|max:500',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->nama_produk);

        if ($request->hasFile('gambar_utama')) {
            if ($produk->gambar_utama) {
                Storage::disk('public')->delete($produk->gambar_utama);
            }
            $data['gambar_utama'] = $request->file('gambar_utama')->store('produk', 'public');
        }

        if ($request->hasFile('og_image')) {
            if ($produk->og_image) {
                Storage::disk('public')->delete($produk->og_image);
            }
            $data['og_image'] = $request->file('og_image')->store('produk/og', 'public');
        }

        $produk->update($data);

        // Handle Gallery Uploads (Add new images)
        if ($request->hasFile('gambar_produk')) {
            foreach ($request->file('gambar_produk') as $file) {
                $path = $file->store('produk/gallery', 'public');
                GambarProduk::create([
                    'produk_id' => $produk->id,
                    'nama_file' => $path,
                ]);
            }
        }

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->gambar_utama) {
            Storage::disk('public')->delete($produk->gambar_utama);
        }
        if ($produk->og_image) {
            Storage::disk('public')->delete($produk->og_image);
        }

        // Delete gallery images
        foreach ($produk->gambar as $gambar) {
            Storage::disk('public')->delete($gambar->nama_file);
        }

        $produk->delete();

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dihapus');
    }

    public function deleteImage($id)
    {
        $gambar = GambarProduk::findOrFail($id);
        Storage::disk('public')->delete($gambar->nama_file);
        $gambar->delete();

        return back()->with('success', 'Gambar galeri berhasil dihapus');
    }

    // Frontend Methods
    public function list(Request $request)
    {
        $produks = Produk::with('kategori', 'gambar')
            ->when($request->kategori, function ($query) use ($request) {
                $query->whereHas('kategori', function ($q) use ($request) {
                    $q->where('slug', $request->kategori);
                });
            })
            ->latest()
            ->paginate(12);

        $kategoris = KategoriProduk::orderBy('urutan')->get();

        return view('produk.index', compact('produks', 'kategoris'));
    }

    public function searchFrontend(Request $request)
    {
        $query = $request->input('q');
        $produks = Produk::with('kategori', 'gambar')
            ->where('nama_produk', 'like', "%{$query}%")
            ->orWhere('deskripsi_lengkap', 'like', "%{$query}%")
            ->paginate(12);

        $kategoris = KategoriProduk::orderBy('urutan')->get();

        return view('produk.search', compact('produks', 'query', 'kategoris'));
    }

    public function terlaris()
    {
        // Placeholder: In a real app, this would query order details
        $produks = Produk::with('kategori', 'gambar')
            ->inRandomOrder()
            ->take(12)
            ->get();

        $kategoris = KategoriProduk::orderBy('urutan')->get();

        return view('produk.terlaris', compact('produks', 'kategoris'));
    }

    public function rekomendasi()
    {
        $produks = Produk::with('kategori', 'gambar')
            ->where('rekomendasi', 'yes')
            ->paginate(12);

        $kategoris = KategoriProduk::orderBy('urutan')->get();

        return view('produk.rekomendasi', compact('produks', 'kategoris'));
    }

    public function detail($slug)
    {
        $produk = Produk::with('kategori', 'gambar')
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedProducts = Produk::where('kategori_id', $produk->kategori_id)
            ->where('id', '!=', $produk->id)
            ->take(4)
            ->get();

        return view('produk.detail', compact('produk', 'relatedProducts'));
    }
}
