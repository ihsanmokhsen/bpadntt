<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PpidDocumentRequest;
use App\Models\AuditLog;
use App\Models\PpidDocument;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PpidDocumentController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim($request->string('search')->toString());
        $category = trim($request->string('category')->toString());
        $year = $request->integer('year') ?: null;
        $source = trim($request->string('source')->toString());
        $status = trim($request->string('status')->toString());

        $documents = PpidDocument::query()
            ->when($search !== '', fn ($query) => $query->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            }))
            ->when($category !== '', fn ($query) => $query->where('category', $category))
            ->when($year, fn ($query) => $query->where('document_year', $year))
            ->when(in_array($source, ['local', 'drive', 'external'], true), fn ($query) => $query->where('source', $source))
            ->when(in_array($status, ['public', 'private'], true), fn ($query) => $query->where('is_public', $status === 'public'))
            ->orderBy('sort_order')
            ->orderByDesc('document_year')
            ->orderByDesc('published_at')
            ->orderBy('title')
            ->paginate(15)
            ->withQueryString();

        return view('admin.ppid-documents.index', compact('documents', 'search', 'category', 'year', 'source', 'status'));
    }

    public function create(): View
    {
        return view('admin.ppid-documents.create', [
            'document' => new PpidDocument([
                'document_year' => now()->year,
                'file_format' => 'PDF',
                'source' => 'local',
                'is_public' => true,
                'sort_order' => 0,
                'published_at' => now(),
            ]),
        ]);
    }

    public function store(PpidDocumentRequest $request): RedirectResponse
    {
        $data = $this->documentData($request);
        $data['created_by'] = $request->user()->id;
        $data['updated_by'] = $request->user()->id;

        $document = PpidDocument::create($data);
        $this->audit($request, 'ppid_document.created', $document, null, $document->toArray());

        return redirect()
            ->route('admin.ppid-documents.edit', $document)
            ->with('success', 'Dokumen PPID berhasil dibuat.');
    }

    public function edit(PpidDocument $ppid_document): View
    {
        return view('admin.ppid-documents.edit', [
            'document' => $ppid_document,
        ]);
    }

    public function update(PpidDocumentRequest $request, PpidDocument $ppid_document): RedirectResponse
    {
        $oldValues = $ppid_document->toArray();
        $data = $this->documentData($request, $ppid_document);
        $data['updated_by'] = $request->user()->id;

        $ppid_document->update($data);
        $this->audit($request, 'ppid_document.updated', $ppid_document, $oldValues, $ppid_document->fresh()->toArray());

        return redirect()
            ->route('admin.ppid-documents.edit', $ppid_document)
            ->with('success', 'Dokumen PPID berhasil diperbarui.');
    }

    public function destroy(Request $request, PpidDocument $ppid_document): RedirectResponse
    {
        $oldValues = $ppid_document->toArray();
        $this->deleteStoredFile($ppid_document->file_path);
        $ppid_document->delete();

        $this->audit($request, 'ppid_document.deleted', $ppid_document, $oldValues, null);

        return redirect()
            ->route('admin.ppid-documents.index')
            ->with('success', 'Dokumen PPID berhasil dihapus.');
    }

    private function documentData(PpidDocumentRequest $request, ?PpidDocument $document = null): array
    {
        $data = $request->safe()->only([
            'title',
            'category',
            'document_year',
            'file_format',
            'file_size',
            'description',
            'source',
            'is_public',
            'sort_order',
            'published_at',
        ]);

        $filePath = $document?->file_path;

        if ($request->boolean('remove_file')) {
            $this->deleteStoredFile($filePath);
            $filePath = null;
        }

        if ($request->hasFile('document_file')) {
            $this->deleteStoredFile($filePath);
            $filePath = $request->file('document_file')->store('ppid-documents', 'public');
        } elseif ($request->filled('file_path_url')) {
            $this->deleteStoredFile($filePath);
            $filePath = $request->string('file_path_url')->toString();
        }

        $data['file_path'] = $filePath;
        $data['external_url'] = $request->filled('external_url') ? $request->string('external_url')->toString() : null;
        $data['preview_url'] = $request->filled('preview_url') ? $request->string('preview_url')->toString() : null;
        $data['is_public'] = $request->boolean('is_public');
        $data['published_at'] = $data['published_at'] ?? null;

        return $data;
    }

    private function deleteStoredFile(?string $path): void
    {
        if (! $path || str_starts_with($path, '/') || preg_match('/^https?:/i', $path)) {
            return;
        }

        Storage::disk('public')->delete($path);
    }

    private function audit(Request $request, string $action, PpidDocument $document, ?array $oldValues, ?array $newValues): void
    {
        AuditLog::create([
            'user_id' => $request->user()->id,
            'action' => $action,
            'subject_type' => PpidDocument::class,
            'subject_id' => $document->id,
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
    }
}
