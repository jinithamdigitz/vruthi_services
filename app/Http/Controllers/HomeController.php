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

        $category = PostCategory::where('slug', 'featured-work')->first();
        $featured_work = [];
        if ($category) {
            $featured_work = Post::where('post_category_id', $category->id)->get();
        }

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


        $category = PostCategory::where('slug', 'cta')->first();
        $ctasection = [];
        if ($category) {
            $ctasection = Post::where('post_category_id', $category->id)->first();
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
            'ctasection' => $ctasection,
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

        $category = PostCategory::where('slug', 'cta')->first();
        $ctasection = [];
        if ($category) {
            $ctasection = Post::where('post_category_id', $category->id)->first();
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

        return view('about', ['homebanner' => $homebanner, 'ctasection' => $ctasection, 'counters' => $counters, 'ourStoryTitle' => $ourStoryTitle, 'ourStory' => $ourStory, 'ourValueTitle' => $ourValueTitle, 'ourValues' => $ourValues]);
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

    public function services()
    {
        $seo = $this->getSeoForCurrentRoute();
        $services = Service::latest()->get();
        $category = PostCategory::where('slug', 'brand')->first();
        $brand = collect();
        if ($category) {
            $brand = Post::where('post_category_id', $category->id)->get();
        }

        $category = PostCategory::where('slug', 'about-s')->first();
        $abouts = $category ? Post::where('post_category_id', $category->id)->first() : null;

        $category = PostCategory::where('slug', 'printingservice')->first();
        $printingservice = [];
        if ($category) {
            $printingservice = Post::where('post_category_id', $category->id)->get();
        }

        $category = PostCategory::where('slug', 'team')->first();
        $team = [];
        if ($category) {
            $team = Post::where('post_category_id', $category->id)->get();
        }

        $category = PostCategory::where('slug', 'highlights')->first();
        $highlights = collect();
        if ($category) {
            $highlights = Post::where('post_category_id', $category->id)->get();
        }

        $category = PostCategory::where('slug', 'specifications')->first();
        $specifications = collect();
        if ($category) {
            $specifications = Post::where('post_category_id', $category->id)->get();
        }

        $category = PostCategory::where('slug', 'features')->first();
        $features = collect();
        if ($category) {
            $features = Post::where('post_category_id', $category->id)->get();
        }

        $category = PostCategory::where('slug', 'projectlisting')->first();

        $projectlisting = collect();
        if ($category) {
            $projectlisting = Post::where('post_category_id', $category->id)->get();
        }

        return view('services', compact('services', 'brand', 'abouts', 'printingservice', 'team', 'seo', 'highlights', 'specifications', 'features', 'projectlisting'));
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

    public function projectlisting()
    {
        try {
            $seo = $this->getSeoForCurrentRoute();

            // Get projectlisting category
            $category = PostCategory::where('slug', 'projectlisting')->first();

            // Debug: Check if category exists
            \Log::info('Category ID: ' . ($category ? $category->id : 'Not found'));

            $projectlisting = collect();
            if ($category) {
                $projectlisting = Post::where('post_category_id', $category->id)->get();
                \Log::info('Number of projects: ' . $projectlisting->count());
            }

            // Check if view exists
            if (!view()->exists('projectlisting')) {
                \Log::error('View "projectlisting" does not exist!');
                return "View not found";
            }

            return view('projectlisting', compact('projectlisting', 'seo'));
        } catch (\Exception $e) {
            \Log::error('Error in projectlisting: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    /**
     * Show project details
     */
    public function projectDetails($slug)
    {
        // Find the project by slug
        $project = Post::where('slug', $slug)
            ->whereHas('category', function ($query) {
                $query->where('slug', 'projectlisting');
            })
            ->firstOrFail();

        // Get SEO data
        $seo = $this->getSeoForCurrentRoute();

        // Get brand posts for layout
        $category = PostCategory::where('slug', 'brand')->first();
        $brand = collect();
        if ($category) {
            $brand = Post::where('post_category_id', $category->id)->get();
        }

        // Get related projects (same category, exclude current)
        $relatedProjects = Post::where('post_category_id', $project->post_category_id)
            ->where('id', '!=', $project->id)
            ->latest()
            ->take(3)
            ->get();

        // Get project images - IMPORTANT: Use MultiplePostImage model
        $multiImages = MultiplePostImage::where('post_id', $project->id)->get();

        // Get services for layout
        $services = Service::orderBy('title')->get();

        // Debug: Log to check if images are found
        \Log::info('Project ID: ' . $project->id);
        \Log::info('Multi Images Count: ' . $multiImages->count());

        return view('projectdetails', compact(
            'project',
            'seo',
            'brand',
            'relatedProjects',
            'multiImages',
            'services'
        ));
    }



    public function facilityDetails($slug)  // Change parameter from $id to $slug
    {
        $facility = Post::where('slug', $slug)->firstOrFail(); // Change from findOrFail($id)

        $category = PostCategory::where('slug', 'brand')->first();
        $brand = collect();
        if ($category) {
            $brand = Post::where('post_category_id', $category->id)->get();
        }

        // Use facility's own SEO data
        $seo = (object) [
            'meta_title' => $facility->meta_title ?? $facility->title,
            'meta_description' => $facility->meta_description,
            'og_image' => $facility->og_image,
        ];

        return view('facilitydetails', compact('facility', 'brand', 'seo'));
    }
    public function donationtime()
    {
        $seo = $this->getSeoForCurrentRoute();
        return view('donationtime', compact('seo'));
    }

    public function projects()
    {
        $seo = $this->getSeoForCurrentRoute();
        $projects = Project::orderBy('id', 'desc')->get();
        return view('projects', [
            'projects' => $projects,
            'seo' => $seo
        ]);
    }




    public function productPage()
    {
        $ourproducts = OurProduct::all();
        return view('product', compact('ourproducts'));
    }

    public function productDetails($slug)
    {
        $product = OurProduct::where('slug', $slug)->first();
        $id = $product->id;
        if (!$product) {
            return redirect()->route('product.page')
                ->with('error', 'Product not found');
        }


        $slider = BrandSlider::where('status', 1)->get();

        $ourproductimages = ProductMultipleImage::where('product_id', $id)->get();
        $ourproductsections = ProductSection::where('product_id', $id)->get();
        $faqs = ProductFaq::where('product_id', $id)->get();

        return view('productdetails', compact(
            'product',
            'ourproductimages',
            'ourproductsections',
            'slider',
            'faqs'
        ));
    }

    public function programs()
    {
        $seo = $this->getSeoForCurrentRoute();
        $programs = Program::orderBy('id', 'desc')->get();
        return view('programs', [
            'programs' => $programs,
            'seo' => $seo
        ]);
    }

    public function locations()
    {
        $seo = $this->getSeoForCurrentRoute();
        $locations = Location::orderBy('id', 'desc')->get();
        return view('main', [
            'locations' => $locations,
            'seo' => $seo
        ]);
    }
    public function blogDetails($slug)
    {
        // Find blog by slug
        $blog = Post::where('slug', $slug)->firstOrFail();

        // Get multiple images for this blog
        $multiImages = MultiplePostImage::where('post_id', $blog->id)->get();

        // Get related blogs (same category, excluding current)
        $relatedBlogs = Post::where('post_category_id', $blog->post_category_id)
            ->where('id', '!=', $blog->id)
            ->latest()
            ->take(4)
            ->get();

        // Get latest blogs for sidebar (same as blogs() function)
        $blogCategory = PostCategory::where('slug', 'blogs')->first();
        $latestBlogs = collect();
        if ($blogCategory) {
            $latestBlogs = Post::where('post_category_id', $blogCategory->id)
                ->latest()
                ->limit(4)
                ->get();
        }

        // Get Twitter blogs
        $twitterCategory = PostCategory::where('slug', 'twitterblogs')->first();
        $twitterblogs = collect();
        if ($twitterCategory) {
            $twitterblogs = Post::where('post_category_id', $twitterCategory->id)
                ->latest()
                ->take(5)
                ->get();
        }

        // Get brand data
        $category = PostCategory::where('slug', 'brand')->first();
        $brand = collect();
        if ($category) {
            $brand = Post::where('post_category_id', $category->id)->get();
        }

        // SEO data
        $seo = (object) [
            'meta_title' => $blog->meta_title ?? $blog->title,
            'meta_description' => $blog->meta_description ?? strip_tags(substr($blog->body, 0, 160)),
            'og_image' => $blog->og_image ?? $blog->image,
        ];

        return view('blogdetails', compact(
            'blog',
            'multiImages',
            'relatedBlogs',
            'latestBlogs',
            'twitterblogs',
            'brand',
            'seo'
        ));
    }
    public function blogs(Request $request)
    {
        $seo = $this->getSeoForCurrentRoute();

        // Blog category
        $blogCategory = PostCategory::where('slug', 'blogs')->first();

        // If no blog category exists, return empty view
        if (!$blogCategory) {
            return view('blogs', [
                'blogs' => collect(),
                'latestBlogs' => collect(),
                'twitterblogs' => collect(),
                'brand' => collect(),
                'seo' => $seo
            ]);
        }

        // Twitter category
        $twitterCategory = PostCategory::where('slug', 'twitterblogs')->first();

        // Blogs list with search functionality
        $query = Post::where('post_category_id', $blogCategory->id);

        // Apply search filter if provided - Search ONLY in title and body
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('body', 'LIKE', '%' . $searchTerm . '%');
                // REMOVED: excerpt and tags columns (don't exist in your database)
            });
        }

        // Order by latest and paginate
        $blogs = $query->latest()->paginate(3)->appends($request->only('search'));

        // Latest blogs for sidebar
        $latestBlogs = Post::where('post_category_id', $blogCategory->id)
            ->latest()
            ->limit(5)
            ->get();

        // Twitter blogs
        $twitterblogs = collect();
        if ($twitterCategory) {
            $twitterblogs = Post::where('post_category_id', $twitterCategory->id)->latest()->get();
        }

        // Brand data
        $category = PostCategory::where('slug', 'brand')->first();
        $brand = collect();
        if ($category) {
            $brand = Post::where('post_category_id', $category->id)->get();
        }

        return view('blogs', compact('blogs', 'latestBlogs', 'twitterblogs', 'brand', 'seo'));
    }
    public function showEvents()
    {
        $seo = $this->getSeoForCurrentRoute();
        $events = Event::all();
        return view('events', compact('events', 'seo'));
    }

    public function donate($id)
    {
        $program = Program::findOrFail($id);
        return view('donate', [
            'program' => $program,
        ]);
    }

    public function eventsdetails($id)
    {
        $seo = $this->getSeoForCurrentRoute();
        $event = Event::findOrFail($id);
        return view('eventsdetails', compact('event', 'seo'));
    }

    public function programsdetails($id)
    {
        $program = Program::with('multipleImages')->findOrFail($id);

        // For now, use route-based SEO until you add SEO fields to programs table
        $seo = $this->getSeoForCurrentRoute();

        return view('programsdetails', compact('program', 'seo'));
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

    public function portfolio()
    {
        $seo = $this->getSeoForCurrentRoute();

        // Get projects with category
        $projects = Project::with('category')->latest()->paginate(12);

        // Get all project categories with project count
        $categories = ProjectCategory::withCount('projects')->get();

        // Get total projects count for stats
        $totalProjects = Project::count();

        // Add empty brand collection for the layout
        $category = PostCategory::where('slug', 'brand')->first();
        $brand = collect();
        if ($category) {
            $brand = Post::where('post_category_id', $category->id)->get();
        }

        return view('portfolio', [
            'projects' => $projects,
            'categories' => $categories,
            'totalProjects' => $totalProjects,
            'brand' => $brand,
            'seo' => $seo,
        ]);
    }

    public function portfolioDetails($slug)
    {
        // Find the project with its category - CHANGE THIS LINE
        // FROM: $project = Project::with('category')->findOrFail($slug);
        // TO: 
        $project = Project::with('category')->where('slug', $slug)->firstOrFail();

        // Get SEO data
        $seo = $this->getSeoForCurrentRoute();

        // Get related projects (same category, exclude current project)
        $relatedProjects = Project::with('category')
            ->where('project_category_id', $project->project_category_id)
            ->where('id', '!=', $project->id)
            ->latest()
            ->take(3)
            ->get();

        // If not enough related projects from same category, get latest projects
        if ($relatedProjects->count() < 3) {
            $additionalProjects = Project::with('category')
                ->where('id', '!=', $project->id)
                ->latest()
                ->take(3 - $relatedProjects->count())
                ->get();
            $relatedProjects = $relatedProjects->concat($additionalProjects);
        }

        // Get brand posts for layout (if needed)
        $category = PostCategory::where('slug', 'brand')->first();
        $brand = collect();
        if ($category) {
            $brand = Post::where('post_category_id', $category->id)->get();
        }

        return view('portfolio-details', [
            'project' => $project,
            'relatedProjects' => $relatedProjects,
            'brand' => $brand,
            'seo' => $seo,
        ]);
    }
    public function contact()
    {
        $seo = $this->getSeoForCurrentRoute();

        // Get contact posts
        $category = PostCategory::where('slug', 'contact')->first();
        if ($category) {
            $contact = Post::where('post_category_id', $category->id)->get();
        } else {
            $contact = collect();
        }

        // Get brand posts
        $category = PostCategory::where('slug', 'brand')->first();
        $brand = collect();
        if ($category) {
            $brand = Post::where('post_category_id', $category->id)->get();
        }

        // Get services - ADD THIS SECTION
        $services = Service::latest()->get();

        return view('contact', compact('contact', 'brand', 'services', 'seo'));
    }

    public function contactSubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Process the contact form
        try {
            // Save to database
            $contact = ContactSubmission::create($request->all());

            // Send email notification
            Mail::to(env('ADMIN_EMAIL', 'admin@example.com'))->send(new ContactFormSubmitted($contact));

            return redirect()->back()->with('success', 'Thank you for your message! We will get back to you soon.');
        } catch (\Exception $e) {
            \Log::error('Contact form error: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Sorry, there was an error sending your message. Please try again.')
                ->withInput();
        }
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
