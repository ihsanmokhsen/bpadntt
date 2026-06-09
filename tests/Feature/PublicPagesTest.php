<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\PpidDocument;
use App\Models\WebsiteSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_public_pages_are_available(): void
    {
        $pages = [
            '/' => 'Optimalisasi',
            '/profil' => 'Profil BPAD',
            '/layanan' => 'Layanan',
            '/ppid' => 'Pejabat Pengelola Informasi',
            '/berita' => 'Berita dan Informasi',
            '/pengumuman' => 'Pengumuman',
            '/galeri' => 'Galeri',
        ];

        foreach ($pages as $url => $expectedText) {
            $this->get($url)
                ->assertOk()
                ->assertSee($expectedText);
        }
    }

    public function test_legacy_html_urls_redirect_to_laravel_routes(): void
    {
        $this->get('/index.html')->assertRedirect('/');
        $this->get('/profil.html')->assertRedirect('/profil');
        $this->get('/admin.html')->assertRedirect('/admin/login');
    }

    public function test_public_api_only_returns_publishable_data(): void
    {
        WebsiteSetting::create([
            'key' => 'site.test',
            'value' => 'Terlihat',
            'is_public' => true,
        ]);
        WebsiteSetting::create([
            'key' => 'site.secret',
            'value' => 'Rahasia',
            'is_public' => false,
        ]);

        Post::create([
            'type' => 'berita',
            'title' => 'Berita Terbit',
            'slug' => 'berita-terbit',
            'status' => 'published',
            'published_at' => now()->subMinute(),
        ]);
        Post::create([
            'type' => 'berita',
            'title' => 'Berita Draft',
            'slug' => 'berita-draft',
            'status' => 'draft',
        ]);

        PpidDocument::create([
            'title' => 'Dokumen Publik',
            'category' => 'Berkala',
            'document_year' => 2026,
            'is_public' => true,
        ]);
        PpidDocument::create([
            'title' => 'Dokumen Internal',
            'category' => 'Berkala',
            'document_year' => 2026,
            'is_public' => false,
        ]);

        $this->getJson('/api/public/posts?type=berita')
            ->assertOk()
            ->assertJsonCount(1)
            ->assertJsonFragment(['title' => 'Berita Terbit'])
            ->assertJsonMissing(['title' => 'Berita Draft']);

        $this->getJson('/api/public/settings')
            ->assertOk()
            ->assertJsonFragment(['key' => 'site.test'])
            ->assertJsonMissing(['key' => 'site.secret']);

        $this->getJson('/api/public/ppid-documents')
            ->assertOk()
            ->assertJsonCount(1)
            ->assertJsonFragment(['title' => 'Dokumen Publik'])
            ->assertJsonMissing(['title' => 'Dokumen Internal']);
    }
}
