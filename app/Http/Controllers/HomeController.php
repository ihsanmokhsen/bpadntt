<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PpidDocument;
use App\Models\WebsiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('home', [
            'settings' => WebsiteSetting::public()->pluck('value', 'key'),
            'latestPosts' => Post::published()
                ->where('type', 'berita')
                ->latest('published_at')
                ->limit(6)
                ->get(),
            'counts' => [
                'berita' => Post::published()->where('type', 'berita')->count(),
                'pengumuman' => Post::published()->where('type', 'pengumuman')->count(),
                'agenda' => Post::published()->where('type', 'agenda')->count(),
                'ppid' => PpidDocument::public()->count(),
            ],
        ]);
    }

    public function showPost(string $slug): RedirectResponse
    {
        $post = Post::published()->where('slug', $slug)->firstOrFail();

        return redirect()->route('berita', ['slug' => $post->slug]);
    }
}
