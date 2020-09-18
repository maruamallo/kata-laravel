<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200)
                ->assertSee('Documentation');
    }

    /** @test */
    public function existCategoryRoute()
    {
        $response = $this->get('/categories');

        $response->assertStatus(200)
                ->assertSee('Categories');
    }

    /** @test */
    public function itCanCreateCategories()
    {
        $data = [
            'name' => 'Fashion',
        ];

        Category::create($data);

        $this->assertDatabaseHas('categories', $data);
    }

    /** @test */
    public function itCanSeeCategoryListInCategoriesRaoute()
    {
        Category::factory()->create([
            'name' => 'Calzado industrial'
        ]);

        $response = $this->get('/categories');

        $response->assertStatus(200)
                ->assertSee('Calzado industrial');
    }
}
