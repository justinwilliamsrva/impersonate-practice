<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
}
