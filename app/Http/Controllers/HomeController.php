<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

use App\Models\Artikel;

use App\Models\Testimoni;

class HomeController extends Controller
{
    public function index()
    {
        // Get all products, ordered by latest
        $featured = Produk::orderBy('created_at', 'desc')->get();

        // For the grid, we'll show products with gambar_utama or the first gambar
        $products = Produk::with('gambar')->orderBy('created_at', 'desc')->take(24)->get();

        // Get latest 3 published articles
        $latestArticles = Artikel::with('penulis')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->take(3)
            ->get();

        // Get latest testimonials
        $testimonials = Testimoni::latest()->take(6)->get();

        return view('pilates', compact('featured', 'products', 'latestArticles', 'testimonials'));
    }
}