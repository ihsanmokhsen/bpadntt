<?php

namespace App\Http\Controllers;

use App\Models\PpidDocument;
use Illuminate\View\View;

class PpidController extends Controller
{
    public function index(): View
    {
        $documents = PpidDocument::public()
            ->orderBy('sort_order')
            ->orderByDesc('document_year')
            ->orderByDesc('published_at')
            ->orderBy('title')
            ->get();

        $settings = collect();

        return view('public.ppid', [
            'ppidDocuments' => $documents,
            'ppidStats' => [
                'total' => $documents->count(),
                'this_year' => $documents->where('document_year', now()->year)->count(),
                'categories' => $documents->pluck('category')->filter()->unique()->count(),
                'sources' => $documents->pluck('source')->filter()->unique()->count(),
            ],
            'ppidYears' => $documents->pluck('document_year')->filter()->unique()->sortDesc()->values(),
            'ppidCategories' => $documents->pluck('category')->filter()->unique()->sort()->values(),
        ]);
    }
}
