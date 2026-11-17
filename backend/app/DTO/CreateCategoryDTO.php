<?php

namespace App\DTO;

use Illuminate\Support\Str;

final  readonly  class CreateCategoryDTO
{
    public function __construct(
        public ?int $parentId = null,
        public string $slug,
        public string $name,
        public ?string $description = null,
        public ?string $newText = null,
    )
    {}

    public static function from(array $data, ?int $parentId = null): self
    {
        return new self(
            parentId: $parentId,
            slug: Str::slug($data['name']),
            name: Str::trim($data['name']),
            description: empty($data['description']) ? null : Str::trim($data['description']),
            newText: empty($data['new_text']) ? null : Str::trim($data['new_text']),
        );
    }
}
