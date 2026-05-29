<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Location;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Cache;
use App\Models\Service;

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

        // Logo
        View::composer('*', function ($view) {
            $category = PostCategory::where('slug', 'logo')->first();
            $logo = $category ? Post::where('post_category_id', $category->id)->first() : null;
            $view->with('logo', $logo);
        });

        // Brand
        View::composer('*', function ($view) {
            $category = PostCategory::where('slug', 'brand')->first();
            $brand = collect();

            if ($category) {
                $brand = Post::where('post_category_id', $category->id)->get();
            }

            $view->with('brand', $brand);
        });

        // Phone (single)
        View::composer('*', function ($view) {
            $category = PostCategory::where('slug', 'phone')->first();
            $phone = null;
            $phones = collect();

            if ($category) {
                $phonePost = Post::where('post_category_id', $category->id)->first();
                $phone = $phonePost ? $phonePost->title : null;
                $phones = Post::where('post_category_id', $category->id)->get();
            }

            $view->with('globalPhone', $phone);
            $view->with('globalPhones', $phones);
        });

        // Email
        View::composer('*', function ($view) {
            $category = PostCategory::where('slug', 'email')->first();
            $emails = $category ? Post::where('post_category_id', $category->id)->get() : collect();
            $view->with('globalEmails', $emails);
        });

        // Timings
        View::composer('*', function ($view) {
            $category = PostCategory::where('slug', 'timings')->first();
            $timings = null;

            if ($category) {
                $timing = Post::where('post_category_id', $category->id)->first();
                $timings = $timing ? $timing->title : null;
            }

            $view->with('globalTimings', $timings);
        });

        // Address
        View::composer('*', function ($view) {
            // Try with lowercase first
            $category = PostCategory::where('slug', 'address')->first();

            // If not found, try with capital A
            if (!$category) {
                $category = PostCategory::where('slug', 'Address')->first();
            }

            $addresses = collect();
            $address = null;

            if ($category) {
                $addresses = Post::where('post_category_id', $category->id)->get();
                $address = Post::where('post_category_id', $category->id)->first();
            }

            $view->with('globalAddresses', $addresses);
            $view->with('globalAddress', $address);
        });

        // Social Icons
        View::composer('*', function ($view) {
            $category = PostCategory::where('slug', 'social-icons')->first();
            $socialIcons = $category ? Post::where('post_category_id', $category->id)->get() : collect();
            $view->with('globalSocialIcons', $socialIcons);
        });
        // Services for footer - USING SERVICE MODEL
        View::composer('*', function ($view) {
            $globalServices = Service::orderBy('id', 'desc')->get();  // ← CHANGED THIS
            $view->with('globalServices', $globalServices);
        });
        View::composer('*', function ($view) {
            $category = PostCategory::where('slug', 'footer-content')->first();
            $footerContent = $category ? Post::where('post_category_id', $category->id)->first() : null;
            $view->with('footerContent', $footerContent);
        });
    }
}
