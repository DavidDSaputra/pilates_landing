<?php

namespace App\Http\Controllers;

use App\Models\TentangImage;
use Illuminate\Http\Request;

class TentangController extends Controller
{
    public function index()
    {
        $storyImages = TentangImage::active()
            ->bySection('story')
            ->ordered()
            ->get();

        $teamImages = TentangImage::active()
            ->bySection('team')
            ->ordered()
            ->get();

        $otherImages = TentangImage::active()
            ->bySection('other')
            ->ordered()
            ->get();

        return view('tentang', compact('storyImages', 'teamImages', 'otherImages'));
    }
}
