<?php

namespace App\Observers;

use App\Models\Category;
use App\Models\Image;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class ImageObserver
{
    /**
     * Handle the Image "created" event.
     */
    public function created(Image $image): void
    {
        //
    }

    /**
     * Handle the Image "updated" event.
     */
    public function updated(Image $image): void
    {
        //
    }

    /**
     * Handle the Image "deleted" event.
     */
    public function deleted(Image $image): void
    {

    }
    public function deleting(Image $image): void
    {
        $this->forgetRelatedCategoryCache($image);

        if(filled($image->path)){
            Storage::disk(config('filesystems.default'))->delete($image->path);
        }

    }

    /**
     * Handle the Image "restored" event.
     */
    public function restored(Image $image): void
    {
        //
    }

    /**
     * Handle the Image "force deleted" event.
     */
    public function forceDeleted(Image $image): void
    {
        //
    }

    private function forgetRelatedCategoryCache(Image $image): void
    {
        if ($image->imageable_type !== Category::class) {
            return;
        }

        $slug = $image->imageable instanceof Category
            ? $image->imageable->slug
            : Category::withTrashed()->whereKey($image->imageable_id)->value('slug');

        if (filled($slug)) {
            Cache::forget("api:category:{$slug}");
        }
    }
}
