<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->is_active === true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->input('slug') ?: $this->input('title')),
            'category' => $this->filled('category') ? trim((string) $this->input('category')) : null,
            'summary' => $this->filled('summary') ? trim((string) $this->input('summary')) : null,
            'content' => $this->filled('content') ? trim((string) $this->input('content')) : null,
        ]);
    }

    public function rules(): array
    {
        $post = $this->route('post');

        return [
            'type' => ['required', Rule::in(['berita', 'pengumuman', 'agenda'])],
            'title' => ['required', 'string', 'max:200'],
            'slug' => ['required', 'string', 'max:220', Rule::unique('posts', 'slug')->ignore($post)],
            'category' => ['nullable', 'string', 'max:80'],
            'summary' => ['nullable', 'string', 'max:2000'],
            'content' => ['nullable', 'string'],
            'cover_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:6144'],
            'cover_image_url' => ['nullable', 'url:http,https', 'max:2000'],
            'remove_cover' => ['nullable', 'boolean'],
            'status' => ['required', Rule::in(['draft', 'published'])],
            'published_at' => ['nullable', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'slug.unique' => 'Slug URL sudah digunakan konten lain.',
            'cover_image.image' => 'File cover harus berupa gambar.',
            'cover_image.mimes' => 'Format cover harus JPG, PNG, atau WEBP.',
            'cover_image.max' => 'Ukuran cover maksimal 6 MB.',
        ];
    }
}
