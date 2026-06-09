<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PpidDocument;
use App\Models\WebsiteSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublicDataController extends Controller
{
    public function posts(Request $request): JsonResponse
    {
        $type = $request->string('type')->toString();
        abort_unless(in_array($type, ['berita', 'pengumuman', 'agenda'], true), 422);

        $limit = min(max($request->integer('limit', 12), 1), 50);
        $posts = Post::published()
            ->where('type', $type)
            ->latest('published_at')
            ->latest('updated_at')
            ->limit($limit)
            ->get()
            ->map(fn (Post $post) => [
                'id' => $post->id,
                'type' => $post->type,
                'title' => $post->title,
                'slug' => $post->slug,
                'summary' => $post->summary,
                'content' => $post->content,
                'category' => $post->category,
                'cover_image' => $this->fileUrl($post->cover_image_path),
                'status' => $post->status,
                'published_at' => $post->published_at,
                'updated_at' => $post->updated_at,
            ]);

        return response()->json($posts);
    }

    public function settings(): JsonResponse
    {
        return response()->json(
            WebsiteSetting::public()
                ->orderBy('key')
                ->get(['key', 'value', 'group_name', 'is_public', 'updated_at'])
        );
    }

    public function ppidDocuments(): JsonResponse
    {
        $documents = PpidDocument::public()
            ->orderBy('sort_order')
            ->orderByDesc('document_year')
            ->orderByDesc('published_at')
            ->orderBy('title')
            ->get()
            ->map(fn (PpidDocument $document) => [
                'id' => $document->id,
                'title' => $document->title,
                'category' => $document->category,
                'document_year' => $document->document_year,
                'file_format' => $document->file_format,
                'file_size' => $document->file_size,
                'description' => $document->description,
                'file_url' => $this->fileUrl($document->file_path),
                'external_url' => $document->external_url,
                'preview_url' => $document->preview_url,
                'source' => $document->source,
                'sort_order' => $document->sort_order,
                'published_at' => $document->published_at,
                'updated_at' => $document->updated_at,
            ]);

        return response()->json($documents);
    }

    private function fileUrl(?string $path): string
    {
        if (! $path) {
            return '';
        }

        if (str_starts_with($path, '/') || preg_match('/^(https?:|data:image)/i', $path)) {
            return $path;
        }

        return Storage::disk('public')->url($path);
    }
}
