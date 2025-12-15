<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function dashboard()
    {
        $user = Auth::user();
        return view('admin.dashboard', compact('user'));
    }

    /**
     * Show admin profile
     */
    public function profile()
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }
}