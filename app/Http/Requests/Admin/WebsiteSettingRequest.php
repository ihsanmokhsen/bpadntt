<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class WebsiteSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->is_active === true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'site_name' => $this->filled('site_name') ? trim((string) $this->input('site_name')) : null,
            'site_short_name' => $this->filled('site_short_name') ? trim((string) $this->input('site_short_name')) : null,
            'site_tagline' => $this->filled('site_tagline') ? trim((string) $this->input('site_tagline')) : null,
            'copyright_year' => $this->filled('copyright_year') ? trim((string) $this->input('copyright_year')) : null,
            'hero_title' => $this->filled('hero_title') ? trim((string) $this->input('hero_title')) : null,
            'hero_description' => $this->filled('hero_description') ? trim((string) $this->input('hero_description')) : null,
            'hero_badge_image' => $this->filled('hero_badge_image') ? trim((string) $this->input('hero_badge_image')) : null,
            'hero_badge_alt' => $this->filled('hero_badge_alt') ? trim((string) $this->input('hero_badge_alt')) : null,
            'hero_slide_2' => $this->filled('hero_slide_2') ? trim((string) $this->input('hero_slide_2')) : null,
            'hero_slide_4' => $this->filled('hero_slide_4') ? trim((string) $this->input('hero_slide_4')) : null,
            'contact_email' => $this->filled('contact_email') ? trim((string) $this->input('contact_email')) : null,
            'contact_phone' => $this->filled('contact_phone') ? trim((string) $this->input('contact_phone')) : null,
            'contact_address' => $this->filled('contact_address') ? trim((string) $this->input('contact_address')) : null,
            'contact_hours_weekday' => $this->filled('contact_hours_weekday') ? trim((string) $this->input('contact_hours_weekday')) : null,
            'contact_hours_friday' => $this->filled('contact_hours_friday') ? trim((string) $this->input('contact_hours_friday')) : null,
            'instagram_url' => $this->filled('instagram_url') ? trim((string) $this->input('instagram_url')) : null,
            'facebook_url' => $this->filled('facebook_url') ? trim((string) $this->input('facebook_url')) : null,
            'youtube_url' => $this->filled('youtube_url') ? trim((string) $this->input('youtube_url')) : null,
            'x_url' => $this->filled('x_url') ? trim((string) $this->input('x_url')) : null,
            'ppid_request_url' => $this->filled('ppid_request_url') ? trim((string) $this->input('ppid_request_url')) : null,
            'ppid_objection_url' => $this->filled('ppid_objection_url') ? trim((string) $this->input('ppid_objection_url')) : null,
        ]);
    }

    public function rules(): array
    {
        return [
            'site_name' => ['nullable', 'string', 'max:200'],
            'site_short_name' => ['nullable', 'string', 'max:60'],
            'site_tagline' => ['nullable', 'string', 'max:200'],
            'copyright_year' => ['nullable', 'integer', 'min:2000', 'max:2100'],
            'hero_title' => ['nullable', 'string', 'max:200'],
            'hero_description' => ['nullable', 'string', 'max:500'],
            'hero_badge_image' => ['nullable', 'string', 'max:255'],
            'hero_badge_alt' => ['nullable', 'string', 'max:120'],
            'hero_slide_2' => ['nullable', 'string', 'max:255'],
            'hero_slide_4' => ['nullable', 'string', 'max:255'],
            'contact_email' => ['nullable', 'email:rfc,dns', 'max:255'],
            'contact_phone' => ['nullable', 'string', 'max:50'],
            'contact_address' => ['nullable', 'string', 'max:255'],
            'contact_hours_weekday' => ['nullable', 'string', 'max:80'],
            'contact_hours_friday' => ['nullable', 'string', 'max:80'],
            'instagram_url' => ['nullable', 'url:http,https', 'max:255'],
            'facebook_url' => ['nullable', 'url:http,https', 'max:255'],
            'youtube_url' => ['nullable', 'url:http,https', 'max:255'],
            'x_url' => ['nullable', 'url:http,https', 'max:255'],
            'ppid_request_url' => ['nullable', 'url:http,https', 'max:255'],
            'ppid_objection_url' => ['nullable', 'url:http,https', 'max:255'],
        ];
    }
}
