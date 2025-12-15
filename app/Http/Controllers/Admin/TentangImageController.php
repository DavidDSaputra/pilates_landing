<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TentangImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TentangImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = TentangImage::ordered()->paginate(15);
        return view('admin.tentang-images.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tentang-images.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'section' => 'required|in:story,team,other',
            'keterangan' => 'nullable|string',
            'urutan' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('tentang', 'public');
            $validated['image_path'] = $imagePath;
        }

        $validated['is_active'] = $request->has('is_active');

        TentangImage::create($validated);

        return redirect()->route('admin.tentang-images.index')
            ->with('success', 'Gambar berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $image = TentangImage::findOrFail($id);
        return view('admin.tentang-images.show', compact('image'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $image = TentangImage::findOrFail($id);
        return view('admin.tentang-images.edit', compact('image'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $image = TentangImage::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'section' => 'required|in:story,team,other',
            'keterangan' => 'nullable|string',
            'urutan' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($image->image_path) {
                Storage::disk('public')->delete($image->image_path);
            }

            $imagePath = $request->file('image')->store('tentang', 'public');
            $validated['image_path'] = $imagePath;
        }

        $validated['is_active'] = $request->has('is_active');

        $image->update($validated);

        return redirect()->route('admin.tentang-images.index')
            ->with('success', 'Gambar berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $image = TentangImage::findOrFail($id);

        // Hapus file gambar
        if ($image->image_path) {
            Storage::disk('public')->delete($image->image_path);
        }

        $image->delete();

        return redirect()->route('admin.tentang-images.index')
            ->with('success', 'Gambar berhasil dihapus.');
    }

    /**
     * Toggle active status
     */
    public function toggleActive($id)
    {
        $image = TentangImage::findOrFail($id);
        $image->update(['is_active' => !$image->is_active]);

        return response()->json([
            'success' => true,
            'is_active' => $image->is_active
        ]);
    }
}
