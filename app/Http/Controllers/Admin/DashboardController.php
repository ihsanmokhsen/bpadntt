<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Gallery;
use App\Models\Media;
use App\Models\Post;
use App\Models\PpidDocument;
use App\Models\WebsiteSetting;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'counts' => [
                'posts' => Post::count(),
                'published' => Post::published()->count(),
                'settings' => WebsiteSetting::count(),
                'ppid' => PpidDocument::count(),
                'media' => Media::count(),
                'galleries' => Gallery::count(),
            ],
            'recentLogs' => AuditLog::with('user')->latest()->limit(8)->get(),
        ]);
    }
}
