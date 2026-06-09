<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use App\Models\AuditLog;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(Request $request): View
    {
        $type = $request->string('type')->toString();
        $status = $request->string('status')->toString();
        $search = trim($request->string('search')->toString());

        $posts = Post::query()
            ->when(in_array($type, ['berita', 'pengumuman', 'agenda'], true), fn ($query) => $query->where('type', $type))
            ->when(in_array($status, ['draft', 'published'], true), fn ($query) => $query->where('status', $status))
            ->when($search !== '', fn ($query) => $query->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            }))
            ->latest('updated_at')
            ->paginate(15)
            ->withQueryString();

        return view('admin.posts.index', compact('posts', 'type', 'status', 'search'));
    }

    public function create(): View
    {
        return view('admin.posts.create', [
            'post' => new Post([
                'type' => 'berita',
                'status' => 'draft',
                'published_at' => now(),
            ]),
        ]);
    }

    public function store(PostRequest $request): RedirectResponse
    {
        $data = $this->postData($request);
        $data['created_by'] = $request->user()->id;
        $data['updated_by'] = $request->user()->id;

        $post = Post::create($data);
        $this->audit($request, 'post.created', $post, null, $post->toArray());

        return redirect()
            ->route('admin.posts.edit', $post)
            ->with('success', 'Konten berhasil dibuat.');
    }

    public function edit(Post $post): View
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        $oldValues = $post->toArray();
        $data = $this->postData($request, $post);
        $data['updated_by'] = $request->user()->id;

        $post->update($data);
        $this->audit($request, 'post.updated', $post, $oldValues, $post->fresh()->toArray());

        return redirect()
            ->route('admin.posts.edit', $post)
            ->with('success', 'Konten berhasil diperbarui.');
    }

    public function destroy(Request $request, Post $post): RedirectResponse
    {
        $oldValues = $post->toArray();
        $this->deleteStoredCover($post->cover_image_path);
        $post->delete();
        $this->audit($request, 'post.deleted', $post, $oldValues, null);

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Konten berhasil dihapus.');
    }

    private function postData(PostRequest $request, ?Post $post = null): array
    {
        $data = $request->safe()->only([
            'type',
            'title',
            'slug',
            'category',
            'summary',
            'content',
            'status',
            'published_at',
        ]);

        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        $coverPath = $post?->cover_image_path;

        if ($request->boolean('remove_cover')) {
            $this->deleteStoredCover($coverPath);
            $coverPath = null;
        }

        if ($request->hasFile('cover_image')) {
            $this->deleteStoredCover($coverPath);
            $coverPath = $request->file('cover_image')->store('posts', 'public');
        } elseif ($request->filled('cover_image_url')) {
            $this->deleteStoredCover($coverPath);
            $coverPath = $request->string('cover_image_url')->toString();
        }

        $data['cover_image_path'] = $coverPath;

        return $data;
    }

    private function deleteStoredCover(?string $path): void
    {
        if (! $path || str_starts_with($path, '/') || preg_match('/^https?:/i', $path)) {
            return;
        }

        Storage::disk('public')->delete($path);
    }

    private function audit(Request $request, string $action, Post $post, ?array $oldValues, ?array $newValues): void
    {
        AuditLog::create([
            'user_id' => $request->user()->id,
            'action' => $action,
            'subject_type' => Post::class,
            'subject_id' => $post->id,
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
    }
}
