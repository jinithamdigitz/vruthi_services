<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\MultipleImageController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderItemController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ContactRequestController;
use App\Http\Controllers\ScrapRequestController;
use App\Http\Controllers\Admin\AdminScrapRequestController;
use App\Http\Controllers\Admin\SeoParameterController;
use App\Http\Controllers\ContactSubmissionController;
use Illuminate\Http\Request;
use App\Http\Controllers\ProjectCategoryController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Admin\ProjectCategoryController as AdminProjectCategoryController;
use App\Http\Controllers\SolarCalculatorController;
use App\Http\Controllers\Admin\SolarCalculatorAdminController;
use App\Models\SolarCalculator;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\Admin\EnquiryAdminController;
use App\Http\Controllers\CaptchaController;
use App\Models\Post;
use App\Models\OurProduct;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\OurProductController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\FacultyController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ContactController;


Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('ourproduct', OurProductController::class);
});

Route::post('/admin/upload', [UploadController::class, 'store'])
    ->name('admin.upload')
    ->middleware(['auth']);



// In routes/web.php - CORRECT WAY
Route::get('/faculty', [App\Http\Controllers\HomeController::class, 'faculty'])->name('home.faculty');
// NOT home.faculty
// ============ NEW ENQUIRY ADMIN ROUTE (ADDED) ============
// Route for admin enquiries - using auth middleware
Route::prefix('admin')
    ->middleware('auth')
    ->group(function () {
        Route::get('/enquiries', [EnquiryAdminController::class, 'index'])
            ->name('admin.enquiry.index');
    });
// ============ END NEW ENQUIRY ADMIN ROUTE ============

// ============ NOTE: The route below might conflict with the one above ============
// Both use the same path '/admin/enquiries' with 'auth' middleware
// Keeping both - they are identical so no conflict
Route::prefix('admin')->group(function () {
    Route::get(
        '/enquiries',
        [EnquiryAdminController::class, 'index']
    )
        ->name('admin.enquiry.index');

    Route::get(
        '/enquiries/show/{id}',
        [EnquiryAdminController::class, 'show']
    );

    Route::get(
        '/enquiries/edit/{id}',
        [EnquiryAdminController::class, 'edit']
    );

    Route::post(
        '/enquiries/update/{id}',
        [EnquiryAdminController::class, 'update']
    );

    Route::get(
        '/enquiries/delete/{id}',
        [EnquiryAdminController::class, 'destroy']
    );
});

Route::post('/enquiry-store', [EnquiryController::class, 'store']);
Route::get('/enquiry-list', [EnquiryController::class, 'index']);
Route::get('/enquiry-delete/{id}', [EnquiryController::class, 'destroy']);
Route::get('/enquiry-edit/{id}', [EnquiryController::class, 'edit']);
Route::post('/enquiry-update/{id}', [EnquiryController::class, 'update']);

Route::get('/productdetails/{id}', [HomeController::class, 'productDetails'])->name('product.details');

// Frontend routes
Route::get('/blogs', [App\Http\Controllers\HomeController::class, 'blogs'])->name('home.blogs');

Route::get('/time', [HomeController::class, 'donationtime'])->name('home.time');

Route::get('/casestudies/{slug}', [HomeController::class, 'caseStudiesDetails'])->name('home.casestudiesdetails');

Route::prefix('admin')->middleware(['auth', 'route.access'])->name('admin.')->group(function () {
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users', [UserController::class, 'store'])->name('users.store');

    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
});

Route::prefix('admin')->middleware(['auth', 'route.access'])->name('admin.')->group(function () {
    Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('roles/store', [RoleController::class, 'store'])->name('roles.store');

    Route::get('roles/{role}/routes', [RoleController::class, 'editRoutes'])->name('roles.edit_routes');
    Route::post('roles/{role}/routes', [RoleController::class, 'updateRoutes'])->name('roles.update_routes');

    Route::put('roles/{role}/update-name', [RoleController::class, 'updateName'])->name('admin.roles.update_name');
});

Route::get('/signup', [RegisterController::class, 'show'])->name('signup');
Route::post('/signup', [RegisterController::class, 'register'])->name('signup.post');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::post('/footer-enquiry', [EnquiryController::class, 'store'])->name('footer.enquiry.store');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/reports', [ProfileController::class, 'reports'])->name('profile.reports');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/about-us', [HomeController::class, 'about'])->name('home.about');
Route::get('/projectlisting', [HomeController::class, 'projectlisting'])->name('home.projectlisting');


/*=========================================
   COURSES PAGE
========================================= */

Route::get('/courselisting', [HomeController::class, 'courses'])->name('courses');


Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Course Listing
        Route::get('/courses', [CourseController::class, 'index'])
            ->name('courses.index');

        // Create Course Form
        Route::get('/courses/create', [CourseController::class, 'create'])
            ->name('courses.create');

        // Store Course
        Route::post('/courses/store', [CourseController::class, 'store'])
            ->name('courses.store');

        // Show Course
        Route::get('/courses/show/{id}', [CourseController::class, 'show'])
            ->name('courses.show');

        // Edit Course Form
        Route::get('/courses/edit/{id}', [CourseController::class, 'edit'])
            ->name('courses.edit');

        // Update Course
        Route::put('/courses/update/{id}', [CourseController::class, 'update'])
            ->name('courses.update');

        // Delete Course
        Route::delete('/courses/delete/{id}', [CourseController::class, 'destroy'])
            ->name('courses.destroy');
    });


/* =========================================
   COURSE DETAIL PAGE
========================================= */
Route::get('/course/{slug}', [HomeController::class, 'courseDetail'])->name('course.detail');


Route::get('/calculator', [SolarCalculatorController::class, 'index'])->name('calculator');
Route::post('/calculator', [SolarCalculatorController::class, 'store'])->name('calculator.store');

Route::get('/admin/solar-calculations', [SolarCalculatorController::class, 'adminList'])->name('admin.solar.calculations');

Route::get('/programs', [HomeController::class, 'programs'])->name('home.programs');

Route::get('/projects/{slug}/details', [HomeController::class, 'projectDetails'])->name('projects.details');
Route::get('/projects/{slug}', [HomeController::class, 'project']);

Route::get('/eventsdetails/{id}', [HomeController::class, 'eventsdetails'])->name('events.details');
Route::get('/programsdetails/{id}', [HomeController::class, 'programsdetails'])->name('programs.details');

Route::prefix('admin')->middleware(['auth', 'route.access'])->group(function () {
    Route::get('user/change-password', [UserController::class, 'showChangePasswordForm'])->name('admin.user.change-password.form');
    Route::post('user/change-password', [UserController::class, 'changePassword'])->name('admin.user.change-password');
});

Route::prefix('admin')->middleware(['auth', 'route.access'])->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/dashboard/stats', [DashboardController::class, 'getStats'])->name('dashboard.stats');
    Route::get('/dashboard/activity', [DashboardController::class, 'getRecentActivity'])->name('dashboard.activity');
    Route::get('/dashboard/status-distribution', [DashboardController::class, 'getDonationStatusDistribution'])->name('dashboard.status-distribution');

    Route::resource('orders', OrderController::class);
    Route::resource('orderitems', OrderItemController::class);
    Route::resource('transactions', TransactionController::class);

    Route::resource('post-categories', PostCategoryController::class);
    Route::resource('posts', PostController::class);

    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');

    Route::get('page/{slug}', [PageController::class, 'create'])->name('page.create');
    Route::post('page', [PageController::class, 'store'])->name('page.store');
    Route::get('pageview/{id}', [PageController::class, 'show'])->name('page.show');
    Route::get('pagelist/{slug}', [PageController::class, 'index'])->name('page.index');

    Route::get('pageedit/{id}', [PageController::class, 'edit'])->name('page.edit');
    Route::put('pageupdate/{id}', [PageController::class, 'update'])->name('page.update');
    Route::post('pagedelete/{id}', [PageController::class, 'destroy'])->name('page.destroy');
    Route::delete('pagedelete/{id}', [PageController::class, 'destroy'])->name('page.destroy');
});

Route::prefix('admin')->middleware(['auth', 'route.access'])->name('admin.')->group(function () {
    Route::resource('programs', ProgramController::class);
});

Route::post('programs/{program}/images', [MultipleImageController::class, 'store'])->name('admin.programs.images.store');

Route::post('/admin/upload-image', function (Request $request) {
    $request->validate([
        'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    if ($request->hasFile('file')) {
        $path = $request->file('file')->store('uploads', 'public');
        return response()->json([
            'location' => asset('storage/' . $path)
        ]);
    }

    return response()->json(['error' => 'Upload failed'], 500);
})->name('admin.upload.image');

Route::get('/cancellation-and-refunds', [PagesController::class, 'cancellationAndRefunds'])->name('cancellation-and-refunds');
Route::get('/termsandconditions', [PagesController::class, 'termsandconditions'])->name('termsandconditions');
Route::get('/shipping', [PagesController::class, 'shipping'])->name('shipping');
Route::get('/privacy', [PagesController::class, 'privacy'])->name('privacy');

Auth::routes();

Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('locations', LocationController::class);
});

Route::post('/contact-us', [ContactRequestController::class, 'store'])->name('contact.store');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/contact-requests', [ContactRequestController::class, 'index'])->name('contact-requests.index');
    Route::delete('/contact-requests/{id}', [ContactRequestController::class, 'destroy'])->name('contact-requests.destroy');
});

Route::post('/scrap-request', [ScrapRequestController::class, 'store'])->name('scrap-request.store');

Route::get('/admin/scrap-requests', [AdminScrapRequestController::class, 'index'])->name('admin.scrap_requests.index');

Route::delete('/admin/scrap-requests/{id}', [AdminScrapRequestController::class, 'destroy'])->name('admin.scrap_requests.destroy');

Route::get('/admin/scrap-requests/{id}', [AdminScrapRequestController::class, 'show'])->name('admin.scrap_requests.show');

Route::get('/cookie-policy', function () {
    return view('cookie-policy');
})->name('cookie.policy');

Route::post('/contact-submit', [ContactSubmissionController::class, 'store'])->name('contact.submit');

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/contact-submissions', [ContactSubmissionController::class, 'index'])->name('admin.contact.index');
    Route::get('/contact-submissions/{slug}', [ContactSubmissionController::class, 'show'])->name('admin.contact.show');
    Route::delete('/contact-submissions/{slug}', [ContactSubmissionController::class, 'destroy'])->name('admin.contact.destroy');
});

// ============ ADMIN ROUTES (PROTECTED) ============
Route::prefix('admin')->middleware(['auth', 'route.access'])->name('admin.')->group(function () {
    Route::resource('project-categories', AdminProjectCategoryController::class);
    Route::resource('projects', AdminProjectController::class);
});

// ============ PUBLIC FRONTEND ROUTES (NO AUTH) ============
Route::get('/portfolio', [ProjectController::class, 'portfolio'])->name('home.portfolio');
Route::get('/portfolio/category/{slug}', [ProjectController::class, 'byCategory'])->name('portfolio.category');
Route::get('/portfolio/project/{slug}', [ProjectController::class, 'show'])->name('portfolio-details');
Route::get('/categories', [ProjectCategoryController::class, 'index'])->name('categories.index');
Route::get('/category/{slug}', [ProjectCategoryController::class, 'show'])->name('category.show');

Route::get('/api/category/{id}/projects', [ProjectCategoryController::class, 'getProjects'])->name('api.category.projects');
Route::get('/api/category-stats', [ProjectCategoryController::class, 'getStats'])->name('api.category.stats');

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('seo', SeoParameterController::class);
});

Route::get('/admin/rename-seo-images', [PageController::class, 'renameSeoImages']);
Route::get('/admin/rename-category-images', [ProjectCategoryController::class, 'renameSeoImages']);
Route::get('/admin/rename-project-images', [ProjectController::class, 'renameSeoImages']);

Route::post('/solar-calculator-store', [SolarCalculatorController::class, 'store'])->name('solar.calculator.store');

Route::prefix('admin')->group(function () {
    Route::get('/solar-calculators', [SolarCalculatorAdminController::class, 'index'])->name('admin.solar_calculators.index');
    Route::get('/solar-calculators/{id}', [SolarCalculatorAdminController::class, 'show'])->name('admin.solar_calculators.show');
});

Route::get('/captcha-image', [CaptchaController::class, 'generate'])->name('captcha.image');

Route::delete('/admin/ourproduct/delete-image/{id}', [App\Http\Controllers\Admin\OurProductController::class, 'destroyMultipleImage'])->name('admin.ourproduct.delete-image');

// ============ DYNAMIC SLUG ROUTE - MUST BE LAST ============
Route::get('/{slug}', function ($slug) {
    $product = OurProduct::where('slug', $slug)->first();
    if ($product) {
        return app(HomeController::class)->productDetails($slug);
    }

    $blog = Post::where('slug', $slug)->first();
    if ($blog) {
        return app(HomeController::class)->blogDetails($slug);
    }

    abort(404);
})->name('dynamic.slug');


Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('faculties', FacultyController::class);
});


// Admin routes (with auth middleware)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/admin/services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::post('/admin/services', [ServiceController::class, 'store'])->name('services.store');
    Route::get('/admin/services/{id}', [ServiceController::class, 'show'])->name('services.show');
    Route::get('/admin/services/{id}/edit', [ServiceController::class, 'edit'])->name('services.edit');
    Route::put('/admin/services/{id}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('/admin/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');
});

// Frontend routes
Route::get('/services', [ServiceController::class, 'frontendIndex'])->name('frontend.services');
Route::get('/services/{slug}', [ServiceController::class, 'showBySlug'])->name('service.detail');


Route::post('/contact/submit', [ContactController::class, 'submit'])->name('contact.submit');

// Admin routes (add to your existing admin middleware group)
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/contacts', [ContactController::class, 'index'])->name('admin.contacts.index');
    Route::get('/contacts/{id}', [ContactController::class, 'show'])->name('admin.contacts.show');
    Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('admin.contacts.destroy');
    Route::post('/contacts/{id}/read', [ContactController::class, 'markAsRead'])->name('admin.contacts.mark-read');
});