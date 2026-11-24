<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AllCategoriesApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/api/top-categories');

        $response->assertStatus(200);

        $response->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.0.name', "Mac")
            ->assertJsonPath('data.0.slug', 'mac');
    }
}
