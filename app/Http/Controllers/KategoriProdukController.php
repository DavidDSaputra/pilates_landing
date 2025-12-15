<?php

namespace App\Http\Controllers;

use App\Models\KategoriProduk;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KategoriProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua kategori dengan urutan dan hitung jumlah produk
        $kategoris = KategoriProduk::withCount('produk')
            ->orderBy('urutan', 'asc')
            ->latest()
            ->paginate(10);

        return view('admin.kategori-produk.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kategori-produk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori_produk,nama_kategori',
            'deskripsi' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'urutan' => 'nullable|integer|min:0',
        ]);

        // Generate slug dari nama kategori
        $validated['slug'] = Str::slug($validated['nama_kategori']);

        // Handle upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('kategori-produk', 'public');
            $validated['gambar'] = $gambarPath;
        }

        // Set urutan default jika kosong
        if (empty($validated['urutan'])) {
            $lastOrder = KategoriProduk::max('urutan') ?? 0;
            $validated['urutan'] = $lastOrder + 1;
        }

        // Simpan kategori
        KategoriProduk::create($validated);

        return redirect()->route('admin.kategori-produks.index')
            ->with('success', 'Kategori berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kategori = KategoriProduk::with([
            'produk' => function ($query) {
                $query->with('gambarProduk')->latest()->take(10);
            }
        ])->findOrFail($id);

        return view('admin.kategori-produk.show', compact('kategori'));
    }

    /**
     * Display kategori dengan produk untuk frontend.
     */
    public function detail(string $slug)
    {
        $kategori = KategoriProduk::where('slug', $slug)->firstOrFail();

        // Ambil produk dalam kategori ini
        $produks = Produk::with(['kategori', 'gambarProduk'])
            ->where('kategori_id', $kategori->id)

            ->latest()
            ->paginate(12);

        // Ambil semua kategori untuk sidebar
        $semuaKategoris = KategoriProduk::orderBy('urutan', 'asc')->get();

        return view('kategori.detail', compact('kategori', 'produks', 'semuaKategoris'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategori = KategoriProduk::findOrFail($id);

        return view('admin.kategori-produk.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kategori = KategoriProduk::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori_produk,nama_kategori,' . $id,
            'deskripsi' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'urutan' => 'nullable|integer|min:0',
        ]);

        // Generate slug baru jika nama kategori berubah
        if ($kategori->nama_kategori !== $validated['nama_kategori']) {
            $validated['slug'] = Str::slug($validated['nama_kategori']);
        }

        // Handle upload gambar jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($kategori->gambar) {
                Storage::disk('public')->delete($kategori->gambar);
            }

            $gambarPath = $request->file('gambar')->store('kategori-produk', 'public');
            $validated['gambar'] = $gambarPath;
        }

        // Update kategori
        $kategori->update($validated);

        return redirect()->route('admin.kategori-produks.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = KategoriProduk::findOrFail($id);

        // Cek apakah kategori memiliki produk
        if ($kategori->produk()->count() > 0) {
            return redirect()->route('admin.kategori-produks.index')
                ->with('error', 'Tidak dapat menghapus kategori yang memiliki produk. Pindahkan produk terlebih dahulu.');
        }

        // Hapus gambar jika ada
        if ($kategori->gambar) {
            Storage::disk('public')->delete($kategori->gambar);
        }

        $kategori->delete();

        return redirect()->route('admin.kategori-produks.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }

    /**
     * Restore soft deleted category.
     */
    public function restore($id)
    {
        // $kategori = KategoriProduk::withTrashed()->findOrFail($id);
        // $kategori->restore();

        return redirect()->route('admin.kategori-produks.index')
            ->with('error', 'Fitur restore tidak tersedia.');
    }

    /**
     * Force delete category.
     */
    public function forceDelete($id)
    {
        // $kategori = KategoriProduk::withTrashed()->findOrFail($id);

        // // Hapus gambar jika ada
        // if ($kategori->gambar) {
        //     Storage::disk('public')->delete($kategori->gambar);
        // }

        // $kategori->forceDelete();

        return redirect()->route('admin.kategori-produks.index')
            ->with('error', 'Fitur force delete tidak tersedia.');
    }

    /**
     * Display trashed categories.
     */
    public function trashed()
    {
        // $kategoris = KategoriProduk::onlyTrashed()
        //     ->latest()
        //     ->paginate(10);

        return redirect()->route('admin.kategori-produks.index');
    }

    /**
     * Update category order.
     */
    public function updateOrder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'exists:kategori_produk,id',
        ]);

        foreach ($request->order as $position => $id) {
            KategoriProduk::where('id', $id)->update(['urutan' => $position + 1]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Search categories by name.
     */
    public function search(Request $request)
    {
        $search = $request->input('search');

        $kategoris = KategoriProduk::withCount('produk')
            ->where('nama_kategori', 'like', "%{$search}%")
            ->orWhere('deskripsi', 'like', "%{$search}%")
            ->orWhere('meta_keywords', 'like', "%{$search}%")
            ->orderBy('urutan', 'asc')
            ->paginate(10);

        return view('admin.kategori-produk.index', compact('kategoris'));
    }

    /**
     * List all categories for frontend.
     */
    public function list()
    {
        $kategoris = KategoriProduk::withCount([
            'produk' => function ($query) {

            }
        ])
            ->orderBy('urutan', 'asc')
            ->get();

        return view('kategori.index', compact('kategoris'));
    }

    /**
     * Get categories for dropdown (API).
     */
    public function getCategories()
    {
        $kategoris = KategoriProduk::select('id', 'nama_kategori')
            ->orderBy('urutan', 'asc')
            ->get();

        return response()->json($kategoris);
    }

    /**
     * Bulk delete categories.
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:kategori_produk,id',
        ]);

        $ids = $request->ids;

        // Cek apakah ada kategori yang memiliki produk
        $kategorisDenganProduk = KategoriProduk::whereIn('id', $ids)
            ->whereHas('produk')
            ->count();

        if ($kategorisDenganProduk > 0) {
            return redirect()->back()
                ->with('error', 'Tidak dapat menghapus kategori yang memiliki produk.');
        }

        // Hapus gambar-gambar kategori
        $kategoris = KategoriProduk::whereIn('id', $ids)->get();
        foreach ($kategoris as $kategori) {
            if ($kategori->gambar) {
                Storage::disk('public')->delete($kategori->gambar);
            }
        }

        // Hapus kategori
        KategoriProduk::whereIn('id', $ids)->delete();

        return redirect()->route('admin.kategori-produks.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }

    /**
     * Update category status.
     */
    public function toggleStatus($id)
    {
        $kategori = KategoriProduk::findOrFail($id);

        // Jika Anda memiliki field status di model, aktifkan ini:
        // $kategori->update([
        //     'status' => $kategori->status == 'active' ? 'inactive' : 'active'
        // ]);

        return redirect()->back()->with('success', 'Status kategori berhasil diubah.');
    }

    /**
     * Get category statistics.
     */
    public function statistics()
    {
        $totalKategoris = KategoriProduk::count();
        $totalKategorisAktif = KategoriProduk::count(); // Ganti jika ada field status
        $kategoriTerbanyakProduk = KategoriProduk::withCount('produk')
            ->orderBy('produk_count', 'desc')
            ->first();

        $statistics = [
            'total' => $totalKategoris,
            'aktif' => $totalKategorisAktif,
            'populer' => $kategoriTerbanyakProduk
        ];

        return response()->json($statistics);
    }

    /**
     * Export categories to CSV.
     */
    public function export()
    {
        $kategoris = KategoriProduk::withCount('produk')
            ->orderBy('urutan', 'asc')
            ->get();

        // Format data untuk CSV
        $csvData = "ID,Nama Kategori,Slug,Deskripsi,Jumlah Produk,Urutan,Created At\n";

        foreach ($kategoris as $kategori) {
            $csvData .= sprintf(
                '%d,"%s","%s","%s",%d,%d,"%s"' . "\n",
                $kategori->id,
                $kategori->nama_kategori,
                $kategori->slug,
                $kategori->deskripsi,
                $kategori->produk_count,
                $kategori->urutan,
                $kategori->created_at
            );
        }

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="kategori-produk-' . date('Y-m-d') . '.csv"',
        ];

        return response($csvData, 200, $headers);
    }

    /**
     * Show category tree view.
     */
    public function tree()
    {
        $kategoris = KategoriProduk::orderBy('urutan', 'asc')->get();

        return view('admin.kategori-produk.tree', compact('kategoris'));
    }

    /**
     * Import categories from CSV.
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('file');
        $path = $file->getRealPath();
        $data = array_map('str_getcsv', file($path));

        $imported = 0;
        $skipped = 0;

        // Skip header row
        array_shift($data);

        foreach ($data as $row) {
            if (count($row) >= 2) {
                $namaKategori = trim($row[0]);
                $slug = trim($row[1]) ?: Str::slug($namaKategori);

                // Cek apakah kategori sudah ada
                if (!KategoriProduk::where('slug', $slug)->exists()) {
                    KategoriProduk::create([
                        'nama_kategori' => $namaKategori,
                        'slug' => $slug,
                        'deskripsi' => $row[2] ?? null,
                        'urutan' => $row[3] ?? (KategoriProduk::max('urutan') + 1),
                    ]);
                    $imported++;
                } else {
                    $skipped++;
                }
            }
        }

        return redirect()->route('admin.kategori-produks.index')
            ->with('success', 'Import selesai. ' . $imported . ' kategori ditambahkan, ' . $skipped . ' kategori dilewati.');
    }
}