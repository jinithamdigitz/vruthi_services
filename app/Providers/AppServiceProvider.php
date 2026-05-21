<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Location;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Add this line to fix the key length issue
        Schema::defaultStringLength(191);
        
        if (Schema::hasTable('locations')) {
            View::share('locations', Location::orderBy('id', 'desc')->get());
        }
   
        View::composer('*', function ($view) {
            $category = PostCategory::where('slug','logo')->first();
            $logo = $category ? Post::where('post_category_id',$category->id)->first() : null;
            $view->with('logo', $logo);
        });
  
        View::composer('*', function ($view) {
            $category = PostCategory::where('slug', 'brand')->first();
            $brand = collect();
            
            if ($category) {
                $brand = Post::where('post_category_id', $category->id)->get();
            }
            
            $view->with('brand', $brand);
        });
    }
}