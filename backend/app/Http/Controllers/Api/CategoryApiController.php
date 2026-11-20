<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Services\ApiResponse;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class CategoryApiController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Category $category): JsonResponse
    {
        $category->loadMissing(
            $category->parent_id === null
                ? ['children.parent', 'children', 'images']
                : ['parent', 'images']
        );

        $payload = Cache::remember(
            "api:category:{$category->slug}",
            now()->addSeconds(10),
            fn () => CategoryResource::make($category)->resolve(request())
        );

        return ApiResponse::success($payload);
    }
}
