<?php

namespace Tests\Feature\Admin\Users;

use Tests\TestCase;
use App\Bulong\Users\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersFeatureTest extends TestCase
{
    /** @test */
    public function it_can_show_all_the_users()
    {
        $user = factory(User::class)->create();
        factory(User::class, 20)->create();

        $this->actingAs($user)
            ->get(route('admin.users.index'))
            ->assertViewHas(['users']);
    }
}
