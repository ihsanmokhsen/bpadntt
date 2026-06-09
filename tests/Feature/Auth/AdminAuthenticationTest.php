<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_admin_dashboard(): void
    {
        $this->get('/admin')->assertRedirect('/admin/login');
    }

    public function test_active_admin_can_login_and_logout(): void
    {
        $user = User::factory()->create([
            'username' => 'admin',
            'password' => 'password-kuat',
            'is_active' => true,
        ]);

        $this->post('/admin/login', [
            'username' => 'admin',
            'password' => 'password-kuat',
        ])->assertRedirect('/admin');

        $this->assertAuthenticatedAs($user);
        $this->assertNotNull($user->fresh()->last_login_at);

        $this->post('/admin/logout')->assertRedirect('/admin/login');
        $this->assertGuest();
    }

    public function test_inactive_admin_cannot_login(): void
    {
        User::factory()->create([
            'username' => 'nonaktif',
            'password' => 'password-kuat',
            'is_active' => false,
        ]);

        $this->post('/admin/login', [
            'username' => 'nonaktif',
            'password' => 'password-kuat',
        ])->assertSessionHasErrors('username');

        $this->assertGuest();
    }
}
