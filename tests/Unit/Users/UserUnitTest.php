<?php

namespace Tests\Unit\Users;

use Tests\TestCase;
use App\Bulong\Users\User;
use App\Bulong\Cities\City;
use Illuminate\Foundation\Testing\WithFaker;
use App\Bulong\Users\Repositories\UserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserUnitTest extends TestCase
{
    /** @test */
    public function it_can_create_a_user()
    {
        $city = factory(City::class)->create();
        $data = [
            'username' => $this->faker->username,
            'email' => $this->faker->email,
            'password' => 'secret',
            'gender' => 'M',
            'city_id' => $city->id,
        ];

        $user = new UserRepository(new User);
        $created = $user->createUser($data);

        $this->assertInstanceOf(User::class, $created);
        $this->assertEquals($data['username'], $created->username);
        $this->assertEquals($data['email'], $created->email);

        $collection = collect($data)->except('password');

        $this->assertDatabaseHas('users', $collection->all());
    }
}
