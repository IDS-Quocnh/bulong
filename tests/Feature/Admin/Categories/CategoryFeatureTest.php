<?php

namespace Tests\Feature\Admin\Categories;

use Tests\TestCase;
use App\Bulong\Users\User;
use App\Bulong\Categories\Category;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;

class CategoryFeatureTest extends TestCase
{
    /** @test */
    public function it_can_list_all_the_categories()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $category = factory(Category::class)->create();

        $this
        ->actingAs($user)
        ->get(route('admin.categories.index'))
        ->assertStatus(200)
        ->assertSee($category->name);
    }

    /** @test */
    public function it_can_remove_a_category()
    {
        $this->withoutExceptionHandling();

        $category = factory(Category::class)->create();
        $user = factory(User::class)->create();

        $this
            ->actingAs($user)
            ->delete(route('admin.categories.destroy', $category->id))
            ->assertStatus(302)
            ->assertRedirect(route('admin.categories.index'))
            ->assertSessionHas('message', 'Delete successful');
    }

    /** @test */
    public function it_can_update_the_category()
    {
        $this->withoutExceptionHandling();

        $data = ['name' => $this->faker->name];

        $user = factory(User::class)->create();
        $category = factory(Category::class)->create();

        $this
            ->actingAs($user)
            ->put(route('admin.categories.update', $category->id), $data)
            ->assertStatus(302)
            ->assertRedirect(route('admin.categories.edit', $category->id))
            ->assertSessionHas('message', 'Update successful');
    }

    /** @test */
    public function it_can_show_the_category_edit_page()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $category = factory(Category::class)->create();

        $this
            ->actingAs($user)
            ->get(route('admin.categories.edit', $category->id))
            ->assertStatus(200)
            ->assertSee($category->name);
    }

    /** @test */
    public function it_can_show_the_create_category_page()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $this
            ->actingAs($user)
            ->get(route('admin.categories.create'))
            ->assertStatus(200);
    }

    /** @test */
    public function it_can_create_category()
    {
        $this->withoutExceptionHandling();
        $image = UploadedFile::fake()->image('file.png', 600, 600);
        $params = [
            'name' => 'Love and Relationships',
            'image' => $image,
        ];

        $this
            ->post(route('admin.categories.store'), $params)
            ->assertStatus(302)
            ->assertRedirect(route('admin.categories.index'))
            ->assertSessionHas('message', 'Category created');
    }
}
