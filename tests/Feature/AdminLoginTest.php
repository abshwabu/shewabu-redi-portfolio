<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AdminLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_login_page_is_reachable(): void
    {
        $this->get('/admin/login')->assertOk();
    }

    public function test_staff_can_authenticate_via_filament_login(): void
    {
        $user = User::factory()->create([
            'email' => 'staff@shewaburedi.com',
            'password' => bcrypt('password'),
        ]);

        Livewire::test(\Filament\Pages\Auth\Login::class)
            ->fillForm([
                'email' => 'staff@shewaburedi.com',
                'password' => 'password',
            ])
            ->call('authenticate')
            ->assertHasNoFormErrors()
            ->assertRedirect('/admin');

        $this->assertAuthenticatedAs($user);
    }

    public function test_home_layout_renders(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('Shewabu Redi')
            ->assertSee('Get in Touch')
            ->assertSee('Authorized Accounting Firm');
    }
}
