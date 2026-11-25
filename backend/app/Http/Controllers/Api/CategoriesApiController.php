<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Services\ApiResponse;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class CategoriesApiController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(): JsonResponse
    {
        $payload = Cache::remember(
            'api:categories',
            now()->addSeconds(10),
            function () {
                $categories = Category::with('children')
                    ->whereNull('parent_id')
                    ->orderBy('id')
                    ->get();

                return CategoryResource::collection($categories)->resolve(request());
            }
        );

        return ApiResponse::success($payload);
    }
}
