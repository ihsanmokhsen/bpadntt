<?php

namespace App\Http\Requests\Admin;

use App\Models\PpidDocument;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PpidDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->is_active === true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'title' => $this->filled('title') ? trim((string) $this->input('title')) : null,
            'category' => $this->filled('category') ? trim((string) $this->input('category')) : null,
            'file_format' => $this->filled('file_format') ? strtoupper(trim((string) $this->input('file_format'))) : null,
            'file_size' => $this->filled('file_size') ? trim((string) $this->input('file_size')) : null,
            'description' => $this->filled('description') ? trim((string) $this->input('description')) : null,
            'source' => $this->filled('source') ? trim((string) $this->input('source')) : null,
            'file_path_url' => $this->filled('file_path_url') ? trim((string) $this->input('file_path_url')) : null,
            'external_url' => $this->filled('external_url') ? trim((string) $this->input('external_url')) : null,
            'preview_url' => $this->filled('preview_url') ? trim((string) $this->input('preview_url')) : null,
        ]);
    }

    public function rules(): array
    {
        $document = $this->route('ppid_document');

        return [
            'title' => [
                'required',
                'string',
                'max:200',
                Rule::unique('ppid_documents', 'title')
                    ->where(fn ($query) => $query->where('document_year', $this->integer('document_year')))
                    ->ignore($document),
            ],
            'category' => ['required', 'string', 'max:100'],
            'document_year' => ['required', 'integer', 'min:1900', 'max:' . (now()->year + 5)],
            'file_format' => ['required', 'string', 'max:20'],
            'file_size' => ['nullable', 'string', 'max:50'],
            'description' => ['nullable', 'string'],
            'document_file' => ['nullable', 'file', 'max:25600'],
            'file_path_url' => ['nullable', 'url:http,https', 'max:2000'],
            'external_url' => ['nullable', 'url:http,https', 'max:2000'],
            'preview_url' => ['nullable', 'url:http,https', 'max:2000'],
            'source' => ['required', Rule::in(['local', 'drive', 'external'])],
            'is_public' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'published_at' => ['nullable', 'date'],
            'remove_file' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.unique' => 'Judul dokumen pada tahun yang sama sudah digunakan.',
            'document_file.max' => 'Ukuran file dokumen maksimal 25 MB.',
            'file_path_url.url' => 'Tautan file dokumen harus berupa URL yang valid.',
            'external_url.url' => 'Tautan eksternal harus berupa URL yang valid.',
            'preview_url.url' => 'Tautan preview harus berupa URL yang valid.',
        ];
    }
}
