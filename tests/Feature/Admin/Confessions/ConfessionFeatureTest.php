<?php

namespace Tests\Feature\Admin\Confessions;

use Tests\TestCase;
use App\Bulong\Feeds\Feed;
use App\Bulong\Users\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConfessionFeatureTest extends TestCase
{
    /** @test */
    public function it_list_all_the_confessions()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $confession = factory(Feed::class)->create();

        $this
        ->actingAs($user)
        ->get(route('admin.categories.index'))
        ->assertStatus(200)
        ->assertSee($confession->name);
    }
}
