<?php

namespace Database\Factories;

use App\DTO\CreateCategoryDTO;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'parent_id' => null,
            'slug'  => null,
            'name'  => null,
            'description'  => null,
            'new_text' => null,
            'icon_url' => null,
            'deleted_at' => null,
        ];
    }

    public function parent(CreateCategoryDTO $dto): static
    {
        return $this->state(fn (array $attributes) => [
            'parent_id' => $dto->parentId,
            'slug'  => $dto->slug,
            'name'  => $dto->name,
            'description'  => $dto->description,
            'new_text' => $dto->newText,
        ]);
    }

    public function child(CreateCategoryDTO $dto, ?int $parentId): static
    {
        return $this->state(fn (array $attributes) => [
            'parent_id' => $parentId,
            'slug'  => $dto->slug,
            'name'  => $dto->name,
            'description'  => $dto->description,
            'new_text' => $dto->newText,
        ]);
    }
}
