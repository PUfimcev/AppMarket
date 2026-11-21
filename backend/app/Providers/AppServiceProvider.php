<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Image;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Relation::enforceMorphMap([
            'category' => Category::class,
            'user' => User::class,
            'image' => Image::class,
        ]);

        RateLimiter::for('api', function (Request $request){
            if($request->user()?->is_admin){
                return Limit::none();
            }

            return [
                Limit::perMinute(60)->by(
                    $request->user()?->id ?: $request->ip()
                ),
                Limit::perHour(100)->by(
                    $request->user()?->id ?: $request->ip()
                ),
            ];
        });
    }
}
