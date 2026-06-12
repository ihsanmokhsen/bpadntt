<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\View\View;

class GalleryPublicController extends Controller
{
    public function index(): View
    {
        $galleries = Gallery::published()
            ->orderBy('created_at')
            ->get();

        return view('public.galeri', [
            'galleries' => $galleries,
            'galleryCount' => $galleries->count(),
            'videoCount' => $galleries->where('media_type', 'video')->count(),
            'photoCount' => $galleries->where('media_type', 'photo')->count(),
        ]);
    }
}
