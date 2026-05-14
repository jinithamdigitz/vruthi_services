<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Program;
use App\Models\Event;
use App\Models\Project;

class PagesController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		// $this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function cancellationAndRefunds()
	{

		$category = PostCategory::where('slug', 'cancellation-and-refunds')->first();
		$catid = $category->id;
		$cancellationandrefunds = Post::where('post_category_id', $catid)->first();

		

		return view('cancellationandrefunds', [
			'cancellationandrefunds' => $cancellationandrefunds
		]);
	}
	public function termsandconditions()
	{

		$category = PostCategory::where('slug', 'termsandconditions')->first();
		$catid = $category->id;
		$contentcreated = Post::where('post_category_id', $catid)->first();

		

		return view('termsandconditions', [
			'contentcreated' => $contentcreated
		]);
	}
	public function shipping()
	{

		$category = PostCategory::where('slug', 'shipping')->first();
		$catid = $category->id;
		$contentcreated = Post::where('post_category_id', $catid)->first();

		

		return view('shipping', [
			'contentcreated' => $contentcreated
		]);
	}
	public function privacy()
	{

		$category = PostCategory::where('slug', 'privacy')->first();
		$catid = $category->id;
		$contentcreated = Post::where('post_category_id', $catid)->first();

		

		return view('privacy', [
			'contentcreated' => $contentcreated
		]);
	}
	public static function getphone()
	{

		$editpost = PostCategory::where('slug', 'phone')->first();
		$catid = $editpost->id;
		$phone = Post::where('post_category_id', $catid)->get();
		return $phone;
	}
	public static function getphone1()
	{
		$editpost = PostCategory::where('slug', 'phone')->first();
		if (!$editpost) return null;
		$catid = $editpost->id;
		$phone = Post::where('post_category_id', $catid)->first();
		return $phone ? $phone->title : null;
	}

	public static function getemail()
	{
		$editpost = PostCategory::where('slug', 'email')->first();
		if (!$editpost) return null;
		$catid = $editpost->id;
		$email = Post::where('post_category_id', $catid)->first();
		return $email ? $email->title : null;
	}


	// public static function getemail()
	// {

	// 	$editpost = PostCategory::where('slug', 'email')->first();
	// 	$catid = $editpost->id;
	// 	$email = Post::where('post_category_id', $catid)->first();
	// 	return $email->email1;
	// }
	public static function getemail1()
	{

		$editpost = PostCategory::where('slug', 'email')->first();
		$catid = $editpost->id;
		$email = Post::where('post_category_id', $catid)->first();
		return $email->title;
	}

	public static function getalladdress()
	{

		$editpost = PostCategory::where('slug', 'address')->first();
		$catid = $editpost->id;
		$address = Post::where('post_category_id', $catid)->get();
		return $address;
	}

	public static function getsocialicons()
	{
		$editpost = PostCategory::where('slug', 'social-icons')->first();
		$catid = $editpost->id;
		$socialicons = Post::where('post_category_id', $catid)->get();
		return $socialicons;
	}

	public static function getaddress()
	{

		$editpost = PostCategory::where('slug', 'address')->first();
		$catid = $editpost->id;
		$address = Post::where('post_category_id', $catid)->first();
		return $address->address1;
	}
	public static function getlogo()
	{

		$editpost = PostCategory::where('slug', 'logo')->first();
		$catid = $editpost->id;
		$logo = Post::where('post_category_id', $catid)->first();
		return $logo->image;
	}

	public function cancellationandrefund()
	{

		$category = PostCategory::where('slug', 'about-s')->first();
		$catid = $category->id;
		$abouts = Post::where('post_category_id', $catid)->first();

		$category = PostCategory::where('slug', 'features')->first();
		$catid = $category->id;
		$features = Post::where('post_category_id', $catid)->get();


		return view('about', [

			//'banner'=>$banner,
			'abouts' => $abouts,
			//	'email'=>$email,
			//'phone'=>$phone,
			'features' => $features,
			//'quotes'=>$quotes
		]);
	}


	public function projects()
	{
		$projects = Project::orderBy('id', 'desc')->get();
		return view('projects', compact('projects'));
	}
	public function projectDetails($id)
	{
		$project = Project::findOrFail($id);
		return view('projects.details', compact('project'));
	}

	public function programs()
	{
		$programs = Program::orderBy('id', 'desc')->get();

		return view('programs', [

			'programs' => $programs,
		]);
	}



	public function showEvents()
	{
		$events = Event::all();
		return view('events', compact('events'));
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
		$event = Event::findOrFail($id);

		return view('eventsdetails', compact('event'));
	}



	public function programsdetails($id)
	{
		$program = Program::with('multipleImages')->findOrFail($id);
		return view('programsdetails', compact('program'));
	}




	public function portfolio()
	{
		$category = PostCategory::where('slug', 'slider')->first();
		$catid = $category->id;
		$slider = Post::where('post_category_id', $catid)->get();

		$category = PostCategory::where('slug', 'about-s')->first();
		$catid = $category->id;
		$abouts = Post::where('post_category_id', $catid)->first();

		$category = PostCategory::where('slug', 'features')->first();
		$catid = $category->id;
		$features = Post::where('post_category_id', $catid)->get();

		$category = PostCategory::where('slug', 'counter')->first();
		$catid = $category->id;
		$counters = Post::where('post_category_id', $catid)->get();

		$category = PostCategory::where('slug', 'whychooseus')->first();
		$catid = $category->id;
		$whychooseus = Post::where('post_category_id', $catid)->first();

		$category = PostCategory::where('slug', 'facilities')->first();
		$catid = $category->id;
		$facilities = Post::where('post_category_id', $catid)->get();

		// Only featured posts with images for the Gallery category
		$category = PostCategory::where('slug', 'gallery')->first();
		$catid = $category->id;
		$gallery = Post::where('post_category_id', $catid)->get();

		$category = PostCategory::where('slug', 'testimonials')->first();
		$catid = $category->id;
		$testimonials = Post::where('post_category_id', $catid)->get();

		$category = PostCategory::where('slug', 'Highlights')->first();
		$catid = $category->id;
		$Highlights = Post::where('post_category_id', $catid)->get();

		$category = PostCategory::where('slug', 'faq')->first();
		$catid = $category->id;
		$faq = Post::where('post_category_id', $catid)->get();

		$products = Product::all();
		$programs = Program::orderBy('id', 'desc')->get();
		$events = event::all();

		return view('portfolio', [
			'slider' => $slider,
			'abouts' => $abouts,
			'features' => $features,
			'products' => $products,
			'counters' => $counters,
			'whychooseus' => $whychooseus,
			'facilities' => $facilities,
			'gallery' => $gallery,
			'testimonials' => $testimonials,
			'faq' => $faq,
			'highlights' => $Highlights,
			'programs' => $programs,
			'events' => $events,
		]);
	}
	
	
	public function Contact()
     {
		
		
		$category=PostCategory::where('slug','logo')->first();
		$catid=$category->id;
$logo=Post::where('post_category_id',$catid)->first();
        
		$category=PostCategory::where('slug','phone')->first();
		$catid=$category->id;
		$phone=Post::where('post_category_id',$catid)->first();

		
         
		$category=PostCategory::where('slug','email')->first();
		$catid=$category->id;
		$email=Post::where('post_category_id',$catid)->first();
		
		$category=PostCategory::where('slug','email')->first();
		$catid=$category->id;
		$allemails=Post::where('post_category_id',$catid)->get();
	
    	$editpost=PostCategory::where('slug','address')->first();
		$catid=$editpost->id;
		$address=Post::where('post_category_id',$catid)->first();
		
		
		
		$editpost=PostCategory::where('slug','social-icons')->first();
		$catid=$editpost->id;
		$socialicons=Post::where('post_category_id',$catid)->get();
		
		
		
		
		
        return view('contact',[
		'address'=>$address,
		'socialicons'=>$socialicons,
		'email'=>$email,
		'phone'=>$phone,
		
		'logo'=>$logo,
		'allemails'=>$allemails,
		]);
    }
}
