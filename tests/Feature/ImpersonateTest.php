<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ImpersonateTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_non_admin_can_not_access()
    {


        $this->get('/admin/impersonate')->assertRedirect('/login');

        $user = User::factory()->create();
        $this->actingAs($user);
        $this->get('/admin/impersonate')->assertStatus(403);
    }
    public function test_non_admin_can_not_impersonate()
    {


        $this->post('/admin/impersonate')->assertRedirect('/login');
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->post('/admin/impersonate')->assertStatus(403);
    }
    public function test_admin_can_impersonate()
    {

        $admin = User::factory()->create(['roles' => 'admin']);
        $user = User::factory()->create();
        $this->actingAs($admin);
        $this->post('/admin/impersonate', ['email' => $user->email]);
        $this->assertEquals(Auth::user()->id, $user->id);

    }
    public function test_admin_can_stop_impersonate()
    {

        $admin = User::factory()->create(['roles' => 'admin']);
        $user = User::factory()->create();
        $this->actingAs($admin);
        $this->delete('/admin/impersonate', ['email' => $user->email]);
        $this->assertEquals(Auth::user()->id, $admin->id);

    }
}
