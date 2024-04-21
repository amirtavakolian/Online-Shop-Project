<?php

namespace Modules\Auth\tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\App\Models\User;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_redirects_to_dashboard()
    {
        $user = User::factory()->create();
        $this->post(route('login'), [
            "email" => $user->email,
            "password" => "password"
        ])->assertRedirect(route('panel'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_cant_login_with_wrong_email_or_password()
    {
        $user = User::factory()->create();
        $this->post(route('login'), [
            "email" => $user->email,
            "password" => '123456'
        ])->assertSessionHas(['failed' => 'ایمیل یا پسورد وارد شده اشتباه است']);
    }
}
