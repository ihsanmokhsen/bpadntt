<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GalleryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->is_active === true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'title' => $this->filled('title') ? trim((string) $this->input('title')) : null,
            'caption' => $this->filled('caption') ? trim((string) $this->input('caption')) : null,
            'image_path_url' => $this->filled('image_path_url') ? trim((string) $this->input('image_path_url')) : null,
            'instagram_url' => $this->filled('instagram_url') ? trim((string) $this->input('instagram_url')) : null,
            'media_type' => $this->filled('media_type') ? trim((string) $this->input('media_type')) : 'photo',
        ]);
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:200'],
            'caption' => ['nullable', 'string'],
            'image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'image_path_url' => ['nullable', 'string', 'max:2000'],
            'instagram_url' => ['nullable', 'url:http,https', 'max:2000'],
            'media_type' => ['required', Rule::in(['photo', 'video'])],
            'is_published' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'remove_image' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'image_file.image' => 'File harus berupa gambar (JPG, PNG, atau WebP).',
            'image_file.max' => 'Ukuran gambar maksimal 5 MB.',
            'instagram_url.url' => 'Tautan Instagram harus berupa URL yang valid.',
        ];
    }
}
