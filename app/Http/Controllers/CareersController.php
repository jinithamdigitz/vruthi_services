<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\ProjectCategory;
use App\Models\Program;
use App\Models\Event;
use App\Models\Project;
use App\Models\ContactSubmission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormSubmitted;
use App\Models\Location;
use App\Models\Service;
use App\Models\SeoParameter;
use App\Models\MultiplePostImage;
use App\Models\GalleryCategory;
use App\Models\SolarCalculator;
use Illuminate\Support\Facades\View;
use App\Models\OurProduct;
use App\Models\ProductMultipleImage;
use App\Models\ProductSection;
use App\Models\BrandSlider;
use App\Models\ProductFaq;
use App\Models\Course;
use App\Models\Faculty;
use App\Models\CareerJob;

class CareersController  extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /**
         * Create a new controller instance.
         *
         * @return void
         */
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        
         $query = CareerJob::query();

        // Filter by title
        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_date', '<=', $request->date_to);
        }

        // Filter by status
        if ($request->filled('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filter by employment type
        if ($request->filled('employment_type')) {
            $query->where('employment_type', $request->employment_type);
        }

        $careerJobs = $query->orderBy('created_date', 'desc')->paginate(10);

       return view('careers.careers', compact('careerJobs'));
    }

    // public function calculator(){
    //    $calculators  = SolarCalculator::latest()->get(); 
    //    return view('index', ['calculators' => $calculators]);
    // }


    public static function getphone()
    {
        $editpost = PostCategory::where('slug', 'phone')->first();
        if (!$editpost) return collect();
        return Post::where('post_category_id', $editpost->id)->get();
    }

    public static function getpbanner()
    {
        $editpost = PostCategory::where('slug', 'common-banner')->first();
        if (!$editpost) return null;
        $banner = Post::where('post_category_id', $editpost->id)->first();
        return $banner ? $banner->image : null;
    }

    public static function getphone1()
    {
        $editpost = PostCategory::where('slug', 'phone')->first();
        if (!$editpost) return null;
        $phone = Post::where('post_category_id', $editpost->id)->first();
        return $phone ? $phone->title : null;
    }

    public static function getemail()
    {
        $category = PostCategory::where('slug', 'email')->first();

        if (!$category) {
            return collect();
        }

        return Post::where('post_category_id', $category->id)->get();
    }

public static function gettimings()
{
    $editpost = PostCategory::where('slug', 'timings')->first();  // Changed from 'timing' to 'timings'
    if (!$editpost) return null;
    $timing = Post::where('post_category_id', $editpost->id)->first();
    return $timing ? $timing->title : null;
}

    public static function getalladdress()
    {
        // Try with lowercase first
        $editpost = PostCategory::where('slug', 'address')->first();

        // If not found, try with capital A
        if (!$editpost) {
            $editpost = PostCategory::where('slug', 'Address')->first();
        }

        if (!$editpost) return collect();
        return Post::where('post_category_id', $editpost->id)->get();
    }
   

    public static function getsocialicons()
    {
        $editpost = PostCategory::where('slug', 'social-icons')->first();
        if (!$editpost) return collect();
        return Post::where('post_category_id', $editpost->id)->get();
    }

    public static function getaddress()
    {
        $editpost = PostCategory::where('slug', 'address')->first();
        if (!$editpost) return null;
        return Post::where('post_category_id', $editpost->id)->first();
    }

    public static function getsecondlogo()
    {
        $editpost = PostCategory::where('slug', 'second-logo')->first();
        if (!$editpost) return null;
        return Post::where('post_category_id', $editpost->id)->first();
    }

    public static function getlogo()
    {
        $editpost = PostCategory::where('slug', 'logo')->first();
        if (!$editpost) return null;
        return Post::where('post_category_id', $editpost->id)->first();
    }


    /**
     * Helper function to get proper image URL
     */
    private function getImageUrl($imagePath)
    {
        if (empty($imagePath)) {
            return asset('images/default-placeholder.jpg');
        }

        // Check if it's already a full URL
        if (filter_var($imagePath, FILTER_VALIDATE_URL)) {
            return $imagePath;
        }

        // Remove any leading slashes
        $imagePath = ltrim($imagePath, '/');

        // Return asset URL
        return asset($imagePath);
    }
    public function logo()
    {
        $seo = $this->getSeoForCurrentRoute();
        $category = PostCategory::where('slug', 'logo')->first();
        $logo = $category ? Post::where('post_category_id', $category->id)->first() : null;

        return view('main', [
            'logo' => $logo,
            'seo' => $seo
        ]);
    }


    /**
     * Get about text for footer
     */
    public static function getAboutText()
    {
        $aboutCategory = PostCategory::where('slug', 'about-s')->first();
        if ($aboutCategory) {
            return Post::where('post_category_id', $aboutCategory->id)->first();
        }
        return null;
    }

    /**
     * Get footer services
     */
    public static function getFooterServices()
    {
        return Service::latest()->take(6)->get();
    }

    /**
     * Get footer emails
     */
    public static function getFooterEmails()
    {
        $category = PostCategory::where('slug', 'email')->first();
        return $category ? Post::where('post_category_id', $category->id)->get() : collect();
    }

    /**
     * Get footer phones
     */
    public static function getFooterPhones()
    {
        $category = PostCategory::where('slug', 'phone')->first();
        return $category ? Post::where('post_category_id', $category->id)->get() : collect();
    }

    /**
     * Get footer addresses
     */
    public static function getFooterAddresses()
    {
        $category = PostCategory::where('slug', 'address')->first();
        return $category ? Post::where('post_category_id', $category->id)->get() : collect();
    }
}
