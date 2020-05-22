<?php

namespace Tests\Feature\Admin\News;

use Tests\TestCase;
use App\Bulong\News\News;
use App\Bulong\Users\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NewsFeatureTest extends TestCase
{
    /** @test */
    public function it_can_show_all_the_news()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        factory(News::class, 20)->create();

        $this->actingAs($user)
            ->get(route('admin.news.index'))
            ->assertViewHas(['news']);
    }

    /** @test */
    public function it_can_remove_a_news()
    {
        $news = factory(News::class)->create();

        $this
            ->actingAs(factory(User::class)->create())
            ->delete(route('admin.news.destroy', $news->id))
            ->assertStatus(302)
            ->assertRedirect(route('admin.news.index'))
            ->assertSessionHas('message', 'Delete successful');
    }

    /** @test */
    public function it_can_update_the_news()
    {
        $this->withoutExceptionHandling();
        $data = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->text,
        ];

        $news = factory(News::class)->create();

        $this
            ->actingAs(factory(User::class)->create())
            ->put(route('admin.news.update', $news->id), $data)
            ->assertStatus(302)
            ->assertRedirect(route('admin.news.edit', $news->id))
            ->assertSessionHas('message', 'Update successful');
    }

    /** @test */
    public function it_can_show_the_news_edit_page()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $news = factory(News::class)->create();

        $this
            ->actingAs($user)
            ->get(route('admin.news.edit', $news->id))
            ->assertStatus(200)
            ->assertSee($news->title)
            ->assertSee($news->description);
    }

    /** @test */
    public function it_can_show_the_create_news_page()
    {
        $user = factory(User::class)->create();

        $this
            ->actingAs($user)
            ->get(route('admin.news.create'))
            ->assertStatus(200);
    }

    /** @test */
    public function it_can_create_the_news()
    {
        $this->withoutExceptionHandling();
        $image = UploadedFile::fake()->image('file.png', 600, 600);
        $user = factory(User::class)->create();

        $params = [
            'title' => 'news title',
            'description' => 'news description',
            'image' => $image,
        ];
        $this->actingAs($user)
            ->post(route('admin.news.store'), $params)
            ->assertStatus(302)
            ->assertRedirect(route('admin.news.index'))
            ->assertSessionHas('message', 'News created');
    }
}
