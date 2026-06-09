<?php

namespace Tests\Feature\Admin;

use App\Models\AuditLog;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminPostManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_open_content_management(): void
    {
        $this->get('/admin/konten')->assertRedirect('/admin/login');
        $this->get('/admin/konten/tambah')->assertRedirect('/admin/login');
    }

    public function test_only_active_admin_can_open_content_management(): void
    {
        $inactiveAdmin = User::factory()->create(['is_active' => false]);
        $nonAdmin = User::factory()->create(['role' => 'editor']);

        $this->actingAs($inactiveAdmin)
            ->get('/admin/konten')
            ->assertForbidden();

        $this->actingAs($nonAdmin)
            ->get('/admin/konten')
            ->assertForbidden();
    }

    public function test_active_admin_can_create_published_content_with_uploaded_cover(): void
    {
        Storage::fake('public');
        $admin = User::factory()->create();

        $response = $this->actingAs($admin)->post('/admin/konten', [
            'type' => 'berita',
            'title' => 'Berita Baru dari Dashboard',
            'slug' => '',
            'category' => 'Kegiatan',
            'summary' => 'Ringkasan berita baru.',
            'content' => 'Isi lengkap berita baru.',
            'cover_image' => UploadedFile::fake()->image('cover.jpg', 1200, 750),
            'status' => 'published',
            'published_at' => now()->subMinute()->format('Y-m-d H:i:s'),
        ]);

        $post = Post::where('slug', 'berita-baru-dari-dashboard')->firstOrFail();

        $response->assertRedirect(route('admin.posts.edit', $post));
        $this->assertSame($admin->id, $post->created_by);
        $this->assertNotNull($post->cover_image_path);
        Storage::disk('public')->assertExists($post->cover_image_path);
        $this->assertDatabaseHas('audit_logs', [
            'action' => 'post.created',
            'subject_id' => $post->id,
        ]);

        $this->getJson('/api/public/posts?type=berita')
            ->assertOk()
            ->assertJsonFragment(['title' => 'Berita Baru dari Dashboard']);
    }

    public function test_draft_content_does_not_appear_in_public_api(): void
    {
        $admin = User::factory()->create();

        $this->actingAs($admin)->post('/admin/konten', [
            'type' => 'berita',
            'title' => 'Berita Masih Draft',
            'status' => 'draft',
        ])->assertSessionHasNoErrors();

        $this->assertDatabaseHas('posts', [
            'slug' => 'berita-masih-draft',
            'status' => 'draft',
        ]);

        $this->getJson('/api/public/posts?type=berita')
            ->assertOk()
            ->assertJsonMissing(['title' => 'Berita Masih Draft']);
    }

    public function test_active_admin_can_update_and_delete_content(): void
    {
        Storage::fake('public');
        $admin = User::factory()->create();
        Storage::disk('public')->put('posts/old-cover.jpg', 'old image');

        $post = Post::create([
            'type' => 'berita',
            'title' => 'Judul Lama',
            'slug' => 'judul-lama',
            'cover_image_path' => 'posts/old-cover.jpg',
            'status' => 'draft',
            'created_by' => $admin->id,
            'updated_by' => $admin->id,
        ]);

        $this->actingAs($admin)->put(route('admin.posts.update', $post), [
            'type' => 'pengumuman',
            'title' => 'Judul Baru',
            'slug' => 'judul-baru',
            'status' => 'published',
            'remove_cover' => '1',
        ])->assertRedirect(route('admin.posts.edit', $post));

        $post->refresh();
        $this->assertSame('Judul Baru', $post->title);
        $this->assertSame('pengumuman', $post->type);
        $this->assertNull($post->cover_image_path);
        Storage::disk('public')->assertMissing('posts/old-cover.jpg');
        $this->assertSame(1, AuditLog::where('action', 'post.updated')->count());

        $this->actingAs($admin)
            ->delete(route('admin.posts.destroy', $post))
            ->assertRedirect(route('admin.posts.index'));

        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
        $this->assertSame(1, AuditLog::where('action', 'post.deleted')->count());
    }
}
