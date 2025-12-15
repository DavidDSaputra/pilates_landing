<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimoniController extends Controller
{
    public function index()
    {
        $testimonis = Testimoni::latest()->paginate(10);
        return view('admin.testimoni.index', compact('testimonis'));
    }

    public function create()
    {
        return view('admin.testimoni.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'pekerjaan' => 'nullable|string|max:255',
            'isi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('testimoni', 'public');
        }

        Testimoni::create($validated);

        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni berhasil ditambahkan.');
    }

    public function edit(Testimoni $testimoni)
    {
        return view('admin.testimoni.edit', compact('testimoni'));
    }

    public function update(Request $request, Testimoni $testimoni)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'pekerjaan' => 'nullable|string|max:255',
            'isi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        if ($request->hasFile('foto')) {
            if ($testimoni->foto) {
                Storage::disk('public')->delete($testimoni->foto);
            }
            $validated['foto'] = $request->file('foto')->store('testimoni', 'public');
        }

        $testimoni->update($validated);

        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni berhasil diperbarui.');
    }

    public function destroy(Testimoni $testimoni)
    {
        if ($testimoni->foto) {
            Storage::disk('public')->delete($testimoni->foto);
        }
        $testimoni->delete();

        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni berhasil dihapus.');
    }
}
