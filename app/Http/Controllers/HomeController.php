<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\KategoriProduk;
use App\Models\Artikel;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch categories and sample products
        $categories = KategoriProduk::orderBy('urutan', 'asc')->get();

        // Get featured / rekomendasi products first, falling back to latest products
        $featured = Produk::where('rekomendasi', 'yes')->take(8)->get();

        // For the grid, we'll show products with gambar_utama or the first gambar
        $products = Produk::with('gambar', 'kategori')->orderBy('created_at', 'desc')->take(24)->get();

        // Get latest 3 published articles
        $latestArticles = Artikel::with('penulis')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('home', compact('categories', 'featured', 'products', 'latestArticles'));
    }
}