<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GalleryRequest;
use App\Models\AuditLog;
use App\Models\Gallery;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim($request->string('search')->toString());
        $status = trim($request->string('status')->toString());

        $galleries = Gallery::query()
            ->when($search !== '', fn ($query) => $query->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('caption', 'like', "%{$search}%");
            }))
            ->when(in_array($status, ['published', 'draft'], true), fn ($query) => $query->where('is_published', $status === 'published'))
            ->orderBy('created_at')
            ->paginate(20)
            ->withQueryString();

        return view('admin.galleries.index', compact('galleries', 'search', 'status'));
    }

    public function create(): View
    {
        return view('admin.galleries.create', [
            'gallery' => new Gallery([
                'media_type' => 'photo',
                'is_published' => true,
            ]),
        ]);
    }

    public function store(GalleryRequest $request): RedirectResponse
    {
        $data = $this->galleryData($request);
        $data['created_by'] = $request->user()->id;
        $data['updated_by'] = $request->user()->id;

        $gallery = Gallery::create($data);
        $this->audit($request, 'gallery.created', $gallery, null, $gallery->toArray());

        return redirect()
            ->route('admin.galleries.edit', $gallery)
            ->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function edit(Gallery $gallery): View
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(GalleryRequest $request, Gallery $gallery): RedirectResponse
    {
        $oldValues = $gallery->toArray();
        $data = $this->galleryData($request, $gallery);
        $data['updated_by'] = $request->user()->id;

        $gallery->update($data);
        $this->audit($request, 'gallery.updated', $gallery, $oldValues, $gallery->fresh()->toArray());

        return redirect()
            ->route('admin.galleries.edit', $gallery)
            ->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy(Request $request, Gallery $gallery): RedirectResponse
    {
        $oldValues = $gallery->toArray();
        $this->deleteStoredImage($gallery->image_path);
        $gallery->delete();

        $this->audit($request, 'gallery.deleted', $gallery, $oldValues, null);

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Galeri berhasil dihapus.');
    }

    private function galleryData(GalleryRequest $request, ?Gallery $gallery = null): array
    {
        $data = $request->safe()->only([
            'title',
            'caption',
            'instagram_url',
            'media_type',
        ]);

        $imagePath = $gallery?->image_path;

        if ($request->boolean('remove_image')) {
            $this->deleteStoredImage($imagePath);
            $imagePath = null;
        }

        if ($request->hasFile('image_file')) {
            $this->deleteStoredImage($imagePath);
            $imagePath = $request->file('image_file')->store('galleries', 'public');
        } elseif ($request->filled('image_path_url')) {
            $this->deleteStoredImage($imagePath);
            $imagePath = $request->string('image_path_url')->toString();
        }

        $data['image_path'] = $imagePath;
        $data['is_published'] = $request->boolean('is_published');

        return $data;
    }

    private function deleteStoredImage(?string $path): void
    {
        if (! $path || str_starts_with($path, '/') || preg_match('/^https?:/i', $path)) {
            return;
        }

        Storage::disk('public')->delete($path);
    }

    private function audit(Request $request, string $action, Gallery $gallery, ?array $oldValues, ?array $newValues): void
    {
        AuditLog::create([
            'user_id' => $request->user()->id,
            'action' => $action,
            'subject_type' => Gallery::class,
            'subject_id' => $gallery->id,
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
    }
}
