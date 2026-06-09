<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPostTest extends TestCase
{
    use RefreshDatabase;

    public function test_published_post_is_public_and_draft_is_hidden(): void
    {
        Post::create([
            'type' => 'berita',
            'title' => 'Berita Terbit',
            'slug' => 'berita-terbit',
            'summary' => 'Ringkasan',
            'content' => 'Isi berita',
            'status' => 'published',
            'published_at' => now()->subMinute(),
        ]);

        Post::create([
            'type' => 'berita',
            'title' => 'Berita Draft',
            'slug' => 'berita-draft',
            'status' => 'draft',
        ]);

        $this->get('/berita/berita-terbit')
            ->assertRedirect('/berita?slug=berita-terbit');

        $this->get('/berita/berita-draft')->assertNotFound();
    }
}
