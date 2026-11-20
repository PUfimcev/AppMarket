<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array_merge(
            [
                'slug' => $this->slug,
                'name' => $this->name,
                'description' => $this->description,
                'new_text' => $this->new_text,
                'icon_url' => $this->icon_url,
                'images' => $this->when(
                    $this->relationLoaded('images') && $this->images->isNotEmpty(),
                    fn () => ImageResource::collection($this->images),
                ),
                'children' => $this->when(
                    $this->relationLoaded('children'),
                    fn () => CategoryResource::collection($this->children),
                ),
            ],
            $this->parentPayload(),
        );
    }

    /**
     * @return array<string, string>
     */
    private function parentPayload(): array
    {
        if (! $this->parent_id || ! $this->parent) {
            return [];
        }

        return [
            'parent_slug' => $this->parent->slug,
            'parent_name' => $this->parent->name,
        ];
    }
}