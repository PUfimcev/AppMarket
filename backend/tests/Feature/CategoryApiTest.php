<?php

namespace Tests\Feature;

use App\DTO\CreateCategoryDTO;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryApiTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_category_api(): void
    {
        $metaParent = [
            'name' => 'Mac',
            'description' => 'Notebooks and desktops with Apple silicon — updated at the September 2026 event with M5 across key models.',
            'new_text' => 'New'
        ];
        $metaChildren = [
            'name' => 'MacBook Air',
            'description' => 'Fanless 13" and 15" laptops with M5, Center Stage camera, and all-day battery for work and travel.',
            'new_text' => 'New'
        ];

        $parentDto = CreateCategoryDTO::from($metaParent);
        $parent = Category::factory()->parent($parentDto)->create();
        $childDto = CreateCategoryDTO::from($metaChildren, 1);
        $child = Category::factory()->child($childDto, 1)->create();

        $this->assertDatabaseCount('categories', 2);
        $this->assertDatabaseHas('categories', ['name' => $parent->name, 'slug' => $parent->slug, 'parent_id' => null] );
        $this->assertDatabaseHas('categories', ['name' => $child->name, 'slug' => $child->slug, 'parent_id' => 1] );

        $responseParent = $this->get('/api/mac');
        $responseChild = $this->get('/api/macbook-air');

        $responseParent->assertStatus(200);
        $responseParent->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.slug', $parent->slug)
            ->assertJsonPath('data.name', $parent->name)
            ->assertJsonCount(1, 'data.children')
            ->assertJsonPath('data.children.0.slug', $child->slug);

        $responseChild->assertStatus(200);
        $responseChild->assertOk()
            ->assertJson([
                'success' => true,
                'data' => [
                    'slug' => 'macbook-air',
                    'parent_slug' => 'mac',
                ]
            ]);


    }
}
