<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Service;
use App\Models\SeoParameter;
use App\Models\Course;
use App\Models\Faculty;
use App\Models\Member;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;


class HomeController extends Controller
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
    public function index()
    {
        $seo = $this->getSeoForCurrentRoute();

        $category = PostCategory::where('slug', 'home-banner')->first();
        $homebanner = [];
        if ($category) {
            $homebanner = Post::where('post_category_id', $category->id)->first();
        }

        $category = PostCategory::where('slug', 'about-us-title')->first();
        $aboutUSTitle = [];
        if ($category) {
            $aboutUSTitle = Post::where('post_category_id', $category->id)->first();
        }

        $category = PostCategory::where('slug', 'home-about-us')->first();
        $about_us = [];
        if ($category) {
            $about_us = Post::where('post_category_id', $category->id)->first();
        }

        $category = PostCategory::where('slug', 'service-title')->first();
        $service_title = [];
        if ($category) {
            $service_title = Post::where('post_category_id', $category->id)->first();
        }

        $services = Service::limit(5)->get();

        $category = PostCategory::where('slug', 'featured-work-title')->first();
        $featured_work_title = [];
        if ($category) {
            $featured_work_title = Post::where('post_category_id', $category->id)->first();
        }

        $featured_work = Portfolio::with('category')
            ->orderBy('id', 'desc')
            ->limit(6)
            ->get();

        $category = PostCategory::where('slug', 'counter')->first();
        $counters = collect();
        if ($category) {
            $counters = Post::where('post_category_id', $category->id)->get();
        }

        $category = PostCategory::where('slug', 'why-choose-us')->first();
        $whychooseus = collect();
        if ($category) {
            $whychooseus = Post::where('post_category_id', $category->id)->first();
        }

        $category = PostCategory::where('slug', 'why-choose-us-title')->first();
        $whychooseustitle = collect();
        if ($category) {
            $whychooseustitle = Post::where('post_category_id', $category->id)->first();
        }

        $category = PostCategory::where('slug', 'testimonials')->first();
        $testimonials = collect();
        if ($category) {
            $testimonials = Post::where('post_category_id', $category->id)->get();
        }

        $category = PostCategory::where('slug', 'testimonials-title')->first();
        $testimonialstitle = [];
        if ($category) {
            $testimonialstitle = Post::where('post_category_id', $category->id)->first();
        }


        $category = PostCategory::where('slug', 'our-expertise')->first();
        $ourExpertise = collect();
        if ($category) {
            $ourExpertise = Post::where('post_category_id', $category->id)->latest()->take(4)->get();
        }

        $category = PostCategory::where('slug', 'features')->first();
        $features = collect();
        if ($category) {
            $features = Post::where('post_category_id', $category->id)->get();
        }




        $category = PostCategory::where('slug', 'phone')->first();

        $phones = collect();
        if ($category) {
            $phones = Post::where('post_category_id', $category->id)->get();
        }
        // ✅ Get first phone
        $firstPhone = $phones->first()?->title;


        return view('index', [
            'homebanner' => $homebanner,
            'aboutUSTitle' => $aboutUSTitle,
            'about_us' => $about_us,
            'features' => $features,
            'counters' => $counters,
            'testimonials' => $testimonials,
            'testimonialstitle' => $testimonialstitle,
            'seo' => $seo,
            'ourExpertise' => $ourExpertise,
            'features' => $features,
            'phone' => $firstPhone,
            'service_title' => $service_title,
            'services' => $services,
            'featured_work_title' => $featured_work_title,
            'featured_work' => $featured_work,
            'whychooseus' => $whychooseus,
            'whychooseustitle' => $whychooseustitle,
        ]);
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




    public function about()
    {
        $category = PostCategory::where('slug', 'home-banner')->first();
        $homebanner = [];
        if ($category) {
            $homebanner = Post::where('post_category_id', $category->id)->first();
        }
        $category = PostCategory::where('slug', 'counter')->first();
        $counters = collect();
        if ($category) {
            $counters = Post::where('post_category_id', $category->id)->get();
        }
        $category = PostCategory::where('slug', 'our-story-title')->first();
        $ourStoryTitle = [];
        if ($category) {
            $ourStoryTitle = Post::where('post_category_id', $category->id)->first();
        }
        $category = PostCategory::where('slug', 'our-story')->first();
        $ourStory = [];
        if ($category) {
            $ourStory = Post::where('post_category_id', $category->id)->first();
        }
        $category = PostCategory::where('slug', 'our-value-title')->first();
        $ourValueTitle = [];
        if ($category) {
            $ourValueTitle = Post::where('post_category_id', $category->id)->first();
        }
        $category = PostCategory::where('slug', 'our-values')->first();
        $ourValues = [];
        if ($category) {
            $ourValues = Post::where('post_category_id', $category->id)->get();
        }
        $category = PostCategory::where('slug', 'member-title')->first();
        $memberTitle = [];
        if ($category) {
            $memberTitle = Post::where('post_category_id', $category->id)->first();
        }
        $category = PostCategory::where('slug', 'about-banner')->first();
        $aboutBanner = [];
        if ($category) {
            $aboutBanner = Post::where('post_category_id', $category->id)->first();
        }

        $members = Member::limit(10)->get();


        return view('about', ['homebanner' => $homebanner,  'counters' => $counters, 'ourStoryTitle' => $ourStoryTitle, 'ourStory' => $ourStory, 'ourValueTitle' => $ourValueTitle, 'ourValues' => $ourValues, 'members' => $members, 'memberTitle' => $memberTitle, 'aboutBanner' => $aboutBanner]);
    }


    public function service()
    {
        $services = Service::orderBy('id', 'desc')->paginate(12);

        $category = PostCategory::where('slug', 'service-content')->first();
        $serviceContent = [];
        if ($category) {
            $serviceContent = Post::where('post_category_id', $category->id)->first();
        }
        $category = PostCategory::where('slug', 'why-choose-us-2')->first();
        $whyChooseUs = [];
        if ($category) {
            $whyChooseUs = Post::where('post_category_id', $category->id)->first();
        }
        $category = PostCategory::where('slug', 'why-choose-us-card')->first();
        $whyChooseUsCards = [];
        if ($category) {
            $whyChooseUsCards = Post::where('post_category_id', $category->id)->get();
        }
        $category = PostCategory::where('slug', 'service-banner')->first();
        $serviceBanner = [];
        if ($category) {
            $serviceBanner = Post::where('post_category_id', $category->id)->first();
        }

        return view('services', [
            'services' => $services,
            'serviceContent' => $serviceContent,
            'whyChooseUs' => $whyChooseUs,
            'whyChooseUsCards' => $whyChooseUsCards,
            'serviceBanner' => $serviceBanner
        ]);
    }


    public function portfolio()
    {
        $categories = PortfolioCategory::with('portfolios')->get();

        $portfolios = Portfolio::with('category')->orderBy('id', 'desc')->paginate(12);

        $category = PostCategory::where('slug', 'portfolio-banner')->first();
        $portfolioBanner = [];
        if ($category) {
            $portfolioBanner = Post::where('post_category_id', $category->id)->first();
        }

        return view('portfolio', compact('categories', 'portfolios', 'portfolioBanner'));
    }



    public function caseStudiesDetails($slug)
    {
        try {
            $seo = $this->getSeoForCurrentRoute();

            // Get the case study with proper relationships
            $caseStudy = Post::where('slug', $slug)
                ->whereHas('category', function ($query) {
                    $query->where('slug', 'casestudies');
                })
                ->with('multipleImages')
                ->firstOrFail();

            // Prepare gallery images
            $galleryImages = [];
            if ($caseStudy->multipleImages && $caseStudy->multipleImages->count() > 0) {
                foreach ($caseStudy->multipleImages as $index => $image) {
                    // Check if image_name exists and is not empty
                    if (!empty($image->image_name)) {
                        $imageUrl = $this->getImageUrl($image->image_name);

                        $galleryImages[] = [
                            'id' => $image->id,
                            'url' => $imageUrl,
                            'thumb' => $imageUrl,
                            'caption' => $image->caption ?? $image->alt_text ?? 'Project Image ' . ($index + 1),
                            'title' => $image->title ?? $caseStudy->title . ' - Image ' . ($index + 1)
                        ];
                    }
                }
            }

            // Get category
            $category = PostCategory::where('slug', 'casestudies')->first();

            // Get related case studies
            $otherCaseStudies = collect();
            if ($category) {
                $otherCaseStudies = Post::where('post_category_id', $category->id)
                    ->where('id', '!=', $caseStudy->id)
                    ->orderBy('created_at', 'desc')
                    ->limit(4)
                    ->get();

                // Add image URLs for related case studies
                foreach ($otherCaseStudies as $other) {
                    $other->image_url = $this->getImageUrl($other->image);
                }
            }

            // Get main image URL
            $mainImageUrl = $this->getImageUrl($caseStudy->image);

            return view('casestudiesdetails', [
                'caseStudy' => $caseStudy,
                'otherCaseStudies' => $otherCaseStudies,
                'galleryImages' => $galleryImages,
                'mainImageUrl' => $mainImageUrl,
                'seo' => $seo,
            ]);
        } catch (\Exception $e) {
            \Log::error('Case study error: ' . $e->getMessage());
            abort(404, 'Case study not found');
        }
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



    public function faculty()
    {
        $seo = $this->getSeoForCurrentRoute();

        // Get all faculty members from the faculties table
        $faculties = Faculty::orderBy('id', 'desc')->get();

        // Get counter posts
        $category = PostCategory::where('slug', 'counter')->first();
        $counters = collect();
        if ($category) {
            $counters = Post::where('post_category_id', $category->id)->get();
        }

        // Get teaching approach section
        $teachingApproach = null;
        $category = PostCategory::where('slug', 'teaching-approach')->first();
        if ($category) {
            $teachingApproach = Post::where('post_category_id', $category->id)->first();
        }

        // Get teaching approach cards
        $teachingApproachCards = collect();
        $category = PostCategory::where('slug', 'teaching-approach-cards')->first();
        if ($category) {
            $teachingApproachCards = Post::where('post_category_id', $category->id)->get();
        }

        return view('faculty', compact('faculties', 'counters', 'seo', 'teachingApproach', 'teachingApproachCards'));
    }




    public function courses()
    {
        $seo = $this->getSeoForCurrentRoute();

        // Get all courses (latest first)
        $courses = Course::latest()->paginate(12);

        // Get popular courses - only if 'views' column exists
        $popularCourses = collect();
        try {
            $popularCourses = Course::orderBy('views', 'desc')->limit(6)->get();
        } catch (\Exception $e) {
            // If 'views' column doesn't exist, just get latest courses
            $popularCourses = Course::latest()->limit(6)->get();
        }

        return view('courses', compact(
            'courses',
            'popularCourses',
            'seo'
        ));
    }

    public function courseDetail($slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();

        $courses = Course::where('id', '!=', $course->id)
            ->latest()
            ->take(4)
            ->get();

        return view('coursedetail', compact('course', 'courses'));
    }

    public function facilities()
    {
        $seo = $this->getSeoForCurrentRoute();
        $category = PostCategory::where('slug', 'facilities')->first();

        $facilities = collect();
        if ($category) {
            $facilities = Post::where('post_category_id', $category->id)->get();
        }

        $category = PostCategory::where('slug', 'brand')->first();
        $brand = collect();
        if ($category) {
            $brand = Post::where('post_category_id', $category->id)->get();
        }

        return view('facilities', compact('facilities', 'brand', 'seo'));
    }



    /**
     * Get SEO data for static routes from seo_parameters table
     */
    private function getSeoForCurrentRoute()
    {
        $currentRoute = request()->path();

        // Handle home page
        if ($currentRoute === '/') {
            $currentRoute = '/';
        } else {
            $currentRoute = '/' . $currentRoute;
        }

        // First try to find exact match
        $seo = SeoParameter::where('route_name', $currentRoute)->first();

        // If no exact match, try to find pattern match for dynamic routes
        if (!$seo) {
            // Split the URL into segments
            $segments = explode('/', trim($currentRoute, '/'));

            if (count($segments) > 1) {
                // For routes like blog-details/123, try to match blog-details/{id}
                $patternRoute = '/' . $segments[0] . '/{id}';
                $seo = SeoParameter::where('route_name', $patternRoute)->first();

                // If still not found, try with different patterns
                if (!$seo && isset($segments[1])) {
                    $patternRoute = '/' . $segments[0] . '/*';
                    $seo = SeoParameter::where('route_name', $patternRoute)->first();
                }
            }
        }

        return $seo;
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
