<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Produk;
use App\Models\Artikel;
use App\Models\GambarProduk;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display admin dashboard.
     */
    public function index()
    {
        // Get statistics
        $stats = [
            'total_users' => User::count(),
            'total_products' => Produk::count(),
            'total_articles' => Artikel::count(),
            'total_gallery_images' => GambarProduk::count(),
            'published_articles' => Artikel::whereNotNull('published_at')->count(),
            'draft_articles' => Artikel::whereNull('published_at')->count(),
            'admin_users' => User::where('role', 'admin')->count(),
            'penulis_users' => User::where('role', 'penulis')->count(),
        ];

        // Recent articles
        $recent_articles = Artikel::with('penulis')
            ->latest()
            ->take(5)
            ->get();

        // Recent products
        $recent_products = Produk::latest()
            ->take(5)
            ->get();

        // Recent activity logs
        $recent_activities = ActivityLog::with('user')
            ->latest()
            ->take(10)
            ->get();

        // Popular articles (by views)
        $popular_articles = Artikel::whereNotNull('published_at')
            ->orderBy('views', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'recent_articles',
            'recent_products',
            'recent_activities',
            'popular_articles'
        ));
    }
}