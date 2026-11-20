<?php

namespace Tests\Unit;

use App\DTO\CreateCategoryDTO;
use PHPUnit\Framework\TestCase;

class CategoryDTOTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_dto_values(): void
    {
        $parentDto = CreateCategoryDTO::from([
            "name" => 'Mac'
         ]);

        $childtDto = CreateCategoryDTO::from([
            "name" => 'Macbook Pro'
        ], 1);

        $this->assertInstanceOf(CreateCategoryDTO::class, $parentDto);
        $this->assertInstanceOf(CreateCategoryDTO::class, $childtDto);

        $this->assertSame('Mac', $parentDto->name);
        $this->assertSame(null, $parentDto->parentId);

        $this->assertSame('Macbook Pro', $childtDto->name);
        $this->assertSame(1, $childtDto->parentId);
    }
}
