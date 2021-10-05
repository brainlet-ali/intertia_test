<?php

namespace Tests\Feature;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_authentication_status_remains_when_users_post_route_is_used()
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->post(route('users.store')); // for example this is storing sub-user

        $this->post('/logout');

        $this->assertGuest();
    }

    public function test_user_authentication_status_goes_when_users_post_route_is_not_used()
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->post('/logout');

        $this->assertGuest();
    }
}
