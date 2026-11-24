<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TopCategoriesResource;
use App\Http\Services\ApiResponse;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class TopCategoriesApiController extends Controller
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
                $categories = Category::query()
                    ->whereNull('parent_id')
                    ->orderBy('id')
                    ->get();

                return TopCategoriesResource::collection($categories)->resolve(request());
            }
        );

        return ApiResponse::success($payload);
    }
}
