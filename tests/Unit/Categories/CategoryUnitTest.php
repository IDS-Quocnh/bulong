<?php

namespace Tests\Unit\Categories;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use App\Bulong\Categories\Category;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Bulong\Categories\Repositories\CategoryRepository;

class CategoryUnitTest extends TestCase
{
    /** @test */
    public function it_can_create_a_category()
    {
        $image = UploadedFile::fake()->image('file.png', 600, 600);

        $params = [
            'name' => 'Love and Relationships',
            'image' => $image,
        ];

        $category = new CategoryRepository(new Category);
        $created = $category->createCategory($params);

        $this->assertInstanceOf(Category::class, $created);
        $this->assertEquals($params['name'], $created->name);
        $this->assertEquals($params['image'], $image);
    }
}
