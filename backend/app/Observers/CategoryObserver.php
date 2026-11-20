<?php

namespace App\Observers;

use App\Models\Category;
use App\Models\Image;
use Illuminate\Support\Facades\Cache;

class CategoryObserver
{
    /**
     * Handle the Category "created" event.
     */
    public function created(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "updated" event.
     */
    public function updated(Category $category): void
    {
        //
    }
    public function updating(Category $category): void
    {
        Cache::forget("api:category:{$category->slug}");
    }

    public function deleting(Category $category): void
    {
        Cache::forget("api:category:{$category->slug}");
    }

    /**
     * Handle the Category "deleted" event.
     */
    public function deleted(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "restored" event.
     */
    public function restored(Category $category): void
    {
        //
    }
    public function restoring(Category $category): void
    {
        Cache::forget("api:category:{$category->slug}");
    }

    /**
     * Handle the Category "force deleted" event.
     */
    public function forceDeleted(Category $category): void
    {
        //
    }

    public function forceDeleting(Category $category): void
    {
        Cache::forget("api:category:{$category->slug}");

        $category->images()->lazy()->each(fn(Image $image) => $image->delete());

    }
}
