<?php

namespace Tests\Feature\Front\Accounts;

use Tests\TestCase;
use App\Bulong\Cities\City;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FrontAccountsFeatureTest extends TestCase
{
    /** @test */
    public function it_can_register_the_user()
    {
        // $this->withoutExceptionHandling();
        $city = factory(City::class)->create();
        $data = [
            'username' => $this->faker->username,
            'email' => $this->faker->email,
            'password' => 'secret',
            'gender' => 'M',
            'city_id' => $city->id,
            'dob' => '2020-01-01',
        ];

        $this->post(route('register'), $data)
            ->assertStatus(302);
        // ->assertRedirect(route('feeds'));
    }
}
