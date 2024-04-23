<?php

namespace Modules\Panel\tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Panel\App\Models\User;
use Tests\TestCase;

class PanelControllerTest extends TestCase
{

    use RefreshDatabase;

    public function test_panel_accessible_only_to_authenticated_users()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
            ->get(route('panel'))
            ->assertViewIs('panel::index')
            ->assertOk();
    }
}
