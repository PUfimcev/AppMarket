<?php

namespace App\DTO;

use Illuminate\Support\Str;

final  readonly  class CreateCategoryDTO
{
    public function __construct(
        public string $slug,
        public string $name,
        public ?int $parentId = null,
        public ?string $description = null,
        public ?string $newText = null,
    )
    {}

    public static function from(array $data, ?int $parentId = null): self
    {
        return new self(
            slug: Str::slug($data['name']),
            name: Str::trim($data['name']),
            parentId: $parentId,
            description: empty($data['description']) ? null : Str::trim($data['description']),
            newText: empty($data['new_text']) ? null : Str::trim($data['new_text']),
        );
    }
}
