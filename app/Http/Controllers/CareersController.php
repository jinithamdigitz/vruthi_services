<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Support\Facades\Validator;
use App\Models\Service;
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
	   public function apply($id)
		{
			  $careerJob = CareerJob::findOrFail($id);
			 return view('careers.applytojob', compact('careerJob'));
		}
		public function submitApplication(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'job_id' => 'required|exists:career_jobs,id',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'location' => 'required|string|max:255',
            'country_code' => 'required|string',
            'phone' => 'required|string|max:20',
            'experience' => 'required|string',
            'cover_letter' => 'required|string|min:30',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:5120',
            'agree_terms' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Get the job
            $job = CareerJob::findOrFail($request->job_id);
            
            // Handle file upload
            $file = $request->file('resume');
            $originalName = $file->getClientOriginalName();
            $fileSize = $file->getSize();
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $originalName);
            $path = $file->storeAs('resumes', $filename, 'public');
            
            // Create application
            $application = new JobApplication();
            $application->job_id = $request->job_id;
            $application->job_title = $job->title;
            $application->job_department = $job->department;
            $application->job_location = $job->location;
            $application->job_type = $job->employment_type;
            $application->full_name = $request->full_name;
            $application->email = $request->email;
            $application->location = $request->location;
            $application->country_code = $request->country_code;
            $application->phone = $request->phone;
            $application->experience = $request->experience;
            $application->cover_letter = $request->cover_letter;
            $application->resume_path = $path;
            $application->resume_original_name = $originalName;
            $application->resume_file_size = $this->formatFileSize($fileSize);
            $application->terms_agreed = true;
            $application->ip_address = $request->ip();
            $application->user_agent = $request->userAgent();
            $application->save();
            
            // You can add email notification here
            // Mail::to($application->email)->send(new ApplicationReceived($application));
            // Mail::to('hr@outlinearchitects.ae')->send(new NewApplication($application));
            
            return response()->json([
                'success' => true,
                'message' => 'Application submitted successfully!'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again.'
            ], 500);
        }
    }
    
    private function formatFileSize($bytes)
    {
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        }
        return $bytes . ' bytes';
    }
   public function index(Request $request)
{
    $query = CareerJob::query();

    // Filter by search term (title, department, location)
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('title', 'like', '%' . $search . '%')
              ->orWhere('department', 'like', '%' . $search . '%')
              ->orWhere('location', 'like', '%' . $search . '%')
              ->orWhere('short_description', 'like', '%' . $search . '%');
        });
    }

    // Filter by department
    if ($request->filled('department')) {
        $query->where('department', $request->department);
    }

    // Filter by location
    if ($request->filled('location')) {
        $query->where('location', $request->location);
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

    $careerJobs = $query->where('status', 1)->orderBy('created_date', 'desc')->paginate(10);
    
    $departments = CareerJob::where('status', 1)
        ->select('department')
        ->whereNotNull('department')
        ->distinct()
        ->orderBy('department', 'asc')
        ->pluck('department');
        
    $locations = CareerJob::where('status', 1)
        ->select('location')
        ->whereNotNull('location')
        ->distinct()
        ->orderBy('location', 'asc')
        ->pluck('location');
		
		$category = PostCategory::where('slug', 'careers-banner')->first();
        $careerbanner = [];
        if ($category) {
            $careerbanner = Post::where('post_category_id', $category->id)->first();
        }
		
		$category = PostCategory::where('slug', 'career-highlights')->first();
        $careerhighlights = [];
        if ($category) {
            $careerhighlights = Post::where('post_category_id', $category->id)->get();
        }
		

    return view('careers.careers', compact('careerJobs', 'departments', 'locations','careerbanner','careerhighlights'));
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
