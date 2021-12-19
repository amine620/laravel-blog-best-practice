<?php

namespace App\Providers;

use App\Http\Resources\PostResource;
use App\Http\viewComposers\ActivityComposer;
use App\Models\Post;
use App\Observers\PostObserver;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        view()->composer(['home'],ActivityComposer::class);
      
        Post::observe(PostObserver::class);
        // PostResource::withoutWrapping();
        JsonResource::withoutWrapping();
    }
}
