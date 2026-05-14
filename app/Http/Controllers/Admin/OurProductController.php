<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OurProduct;
use Illuminate\Http\Request;
use App\Models\ProductMultipleImage;
use App\Models\ProductSection;
use App\Models\ProductFaq;
use App\Models\BrandSlider;
use Illuminate\Support\Str;

class OurProductController extends Controller
{
    public function index()
    {
        $products = OurProduct::latest()->paginate(10);
        return view('admin.ourproduct.index', compact('products'));
    }

    public function create()
    {
        return view('admin.ourproduct.create');
    }

  public function store(Request $request)
{
    // Validate the request
    $request->validate([
        'title' => 'required|max:255',
        'slug' => 'nullable|max:255|unique:our_products,slug',
        'description' => 'required',
        'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        'multiple_images' => 'nullable|array',
        'multiple_images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        'brand_name.*' => 'nullable|max:255',
        'brand_image.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    // Handle main image upload
    $mainImagePath = '';
    if ($request->hasFile('image')) {
        $mainImage = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads/products'), $mainImage);
        $mainImagePath = 'uploads/products/' . $mainImage;
    }

    // Generate slug
    $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->title);
    $existingSlug = OurProduct::where('slug', $slug)->exists();
    if ($existingSlug) {
        $slug = $slug . '-' . time();
    }

    // Create the main product (1 query)
    $product = OurProduct::create([
        'title' => $request->title,
        'slug' => $slug,
        'description' => $request->description,
        'image' => $mainImagePath
    ]);

    $productId = $product->id;
    $timestamp = now();

    // 1. Handle Multiple Images - BULK INSERT (1 query)
    if ($request->hasFile('multiple_images')) {
        $multipleImagesData = [];
        foreach ($request->file('multiple_images') as $index => $image) {
            if ($image && $image->isValid()) {
                $imageName = time() . '_' . $index . '_' . rand(100, 999) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/products/multiple'), $imageName);
                
                $multipleImagesData[] = [
                    'product_id' => $productId,
                    'image' => 'uploads/products/multiple/' . $imageName,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp
                ];
            }
        }
        if (!empty($multipleImagesData)) {
            ProductMultipleImage::insert($multipleImagesData); // Single query
        }
    }

    // 2. Handle Brand Slider - BULK INSERT (1 query)
    if ($request->has('brand_name') && is_array($request->brand_name)) {
        $brandsData = [];
        foreach ($request->brand_name as $index => $brandName) {
            if (!empty($brandName)) {
                $brandImagePath = '';
                
                if ($request->hasFile('brand_image') && isset($request->file('brand_image')[$index])) {
                    $brandImage = $request->file('brand_image')[$index];
                    if ($brandImage && $brandImage->isValid()) {
                        $brandImageName = time() . '_brand_' . $index . '_' . rand(100, 999) . '.' . $brandImage->getClientOriginalExtension();
                        $brandImage->move(public_path('uploads/brands'), $brandImageName);
                        $brandImagePath = 'uploads/brands/' . $brandImageName;
                    }
                }
                
                $brandsData[] = [
                    'product_id' => $productId,
                    'title' => $request->brand_title[$index] ?? '',
                    'brand_name' => $brandName,
                    'image' => $brandImagePath,
                    'link' => $request->brand_link[$index] ?? '',
                    'sort_order' => $request->brand_sort[$index] ?? 0,
                    'status' => $request->brand_status[$index] ?? 1,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp
                ];
            }
        }
        if (!empty($brandsData)) {
            BrandSlider::insert($brandsData); // Single query
        }
    }

    // 3. Handle Product Sections - BULK INSERT (1 query)
    if ($request->has('section_title') && is_array($request->section_title)) {
        $sectionsData = [];
        foreach ($request->section_title as $index => $sectionTitle) {
            if (!empty($sectionTitle) || !empty($request->section_description[$index] ?? '')) {
                $sectionsData[] = [
                    'product_id' => $productId,
                    'title' => $sectionTitle,
                    'description' => $request->section_description[$index] ?? '',
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp
                ];
            }
        }
        if (!empty($sectionsData)) {
            ProductSection::insert($sectionsData); // Single query
        }
    }

    // 4. Handle Product FAQs - BULK INSERT (1 query)
    if ($request->has('faq_question') && is_array($request->faq_question)) {
        $faqsData = [];
        foreach ($request->faq_question as $index => $faqQuestion) {
            if (!empty($faqQuestion) || !empty($request->faq_answer[$index] ?? '')) {
                $faqsData[] = [
                    'product_id' => $productId,
                    'question' => $faqQuestion,
                    'answer' => $request->faq_answer[$index] ?? '',
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp
                ];
            }
        }
        if (!empty($faqsData)) {
            ProductFaq::insert($faqsData); // Single query
        }
    }

    return redirect()
        ->route('admin.ourproduct.index')
        ->with('success', 'Product created successfully!');
}


  public function edit($id)
{
    $product = OurProduct::with('images', 'sections', 'faqs', 'brands')->findOrFail($id);
    return view('admin.ourproduct.edit', compact('product'));
}

public function update(Request $request, $id)
{
    // Validate the request
    $request->validate([
        'title' => 'required|max:255',
        'slug' => 'nullable|max:255|unique:our_products,slug,' . $id,
        'description' => 'required',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'multiple_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'brand_name.*' => 'nullable|max:255',
        'brand_image.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $product = OurProduct::findOrFail($id);
    
    // Generate slug if needed
    $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->title);
    $existingSlug = OurProduct::where('slug', $slug)->where('id', '!=', $id)->exists();
    if ($existingSlug) {
        $slug = $slug . '-' . time();
    }

    // Update main product data
    $data = [
        'title' => $request->title,
        'slug' => $slug,
        'description' => $request->description,
    ];

    // Main Image Update - Delete old if new uploaded
    if ($request->hasFile('image')) {
        // Delete old image
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }
        
        $mainImage = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads/products'), $mainImage);
        $data['image'] = 'uploads/products/' . $mainImage;
    }

    $product->update($data);
    
    $productId = $product->id;
    $timestamp = now();

    // 1. Handle New Multiple Images (ADD only, don't delete existing)
    if ($request->hasFile('multiple_images')) {
        $multipleImagesData = [];
        foreach ($request->file('multiple_images') as $index => $image) {
            if ($image && $image->isValid()) {
                $imageName = time() . '_' . $index . '_' . rand(100, 999) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/products/multiple'), $imageName);
                
                $multipleImagesData[] = [
                    'product_id' => $productId,
                    'image' => 'uploads/products/multiple/' . $imageName,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp
                ];
            }
        }
        if (!empty($multipleImagesData)) {
            ProductMultipleImage::insert($multipleImagesData);
        }
    }

    // 2. Handle Brand Slider - Replace all brands
    // First, delete old brand images
    $oldBrands = BrandSlider::where('product_id', $productId)->get();
    foreach ($oldBrands as $oldBrand) {
        if ($oldBrand->image && file_exists(public_path($oldBrand->image))) {
            unlink(public_path($oldBrand->image));
        }
    }
    BrandSlider::where('product_id', $productId)->delete();
    
    if ($request->has('brand_name') && is_array($request->brand_name)) {
        $brandsData = [];
        foreach ($request->brand_name as $index => $brandName) {
            if (!empty($brandName)) {
                $brandImagePath = '';
                
                if ($request->hasFile('brand_image') && isset($request->file('brand_image')[$index])) {
                    $brandImage = $request->file('brand_image')[$index];
                    if ($brandImage && $brandImage->isValid()) {
                        $brandImageName = time() . '_brand_' . $index . '_' . rand(100, 999) . '.' . $brandImage->getClientOriginalExtension();
                        $brandImage->move(public_path('uploads/brands'), $brandImageName);
                        $brandImagePath = 'uploads/brands/' . $brandImageName;
                    }
                }
                
                $brandsData[] = [
                    'product_id' => $productId,
                    'title' => $request->brand_title[$index] ?? '',
                    'brand_name' => $brandName,
                    'image' => $brandImagePath,
                    'link' => $request->brand_link[$index] ?? '',
                    'sort_order' => $request->brand_sort[$index] ?? 0,
                    'status' => $request->brand_status[$index] ?? 1,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp
                ];
            }
        }
        if (!empty($brandsData)) {
            BrandSlider::insert($brandsData);
        }
    }

    // 3. Handle Product Sections - Replace all sections
    ProductSection::where('product_id', $productId)->delete();
    
    if ($request->has('section_title') && is_array($request->section_title)) {
        $sectionsData = [];
        foreach ($request->section_title as $index => $sectionTitle) {
            if (!empty($sectionTitle) || !empty($request->section_description[$index] ?? '')) {
                $sectionsData[] = [
                    'product_id' => $productId,
                    'title' => $sectionTitle,
                    'description' => $request->section_description[$index] ?? '',
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp
                ];
            }
        }
        if (!empty($sectionsData)) {
            ProductSection::insert($sectionsData);
        }
    }

    // 4. Handle Product FAQs - Replace all FAQs
    ProductFaq::where('product_id', $productId)->delete();
    
    if ($request->has('faq_question') && is_array($request->faq_question)) {
        $faqsData = [];
        foreach ($request->faq_question as $index => $faqQuestion) {
            if (!empty($faqQuestion) || !empty($request->faq_answer[$index] ?? '')) {
                $faqsData[] = [
                    'product_id' => $productId,
                    'question' => $faqQuestion,
                    'answer' => $request->faq_answer[$index] ?? '',
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp
                ];
            }
        }
        if (!empty($faqsData)) {
            ProductFaq::insert($faqsData);
        }
    }

    return redirect()
        ->route('admin.ourproduct.index')
        ->with('success', 'Product Updated Successfully!');
}

public function destroyMultipleImage($id)
{
    try {
        $image = ProductMultipleImage::findOrFail($id);
        
        // Delete physical file
        if ($image->image && file_exists(public_path($image->image))) {
            unlink(public_path($image->image));
        }
        
        // Delete database record
        $image->delete();
        
        return response()->json(['success' => true, 'message' => 'Image deleted successfully']);
        
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Image not found'], 404);
    }
}

//     public function update(Request $request, $id)
//     {
//         $request->validate([
//             'title' => 'required|max:255',
//             'slug' => 'nullable|max:255|unique:our_products,slug,' . $id,
//             'description' => 'required',
//             'image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
//             'multiple_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp',

//             'section_title.*' => 'nullable|max:255',
//             'section_description.*' => 'nullable'
//         ]);


//         $product = OurProduct::findOrFail($id);


//         $data = [
//             'title' => $request->title,
//             'slug' => $request->slug,
//             'description' => $request->description
//         ];


//         /* Main Image Update */
//         if ($request->hasFile('image')) {

//             $name = time() . '.' . $request->image->extension();

//             $request->image->move(
//                 public_path('uploads/products'),
//                 $name
//             );

//             $data['image'] = 'uploads/products/' . $name;
//         }


//         $product->update($data);


//         /* Multiple Images Upload */
//         if ($request->hasFile('multiple_images')) {

//             foreach ($request->file('multiple_images') as $img) {

//                 $name = rand() . time() . '.' . $img->extension();

//                 $img->move(
//                     public_path('uploads/products/multiple'),
//                     $name
//                 );

//                 ProductMultipleImage::create([
//                     'product_id' => $product->id,
//                     'image' => 'uploads/products/multiple/' . $name
//                 ]);
//             }
//         }


//         /* Update Product Sections */
//         ProductSection::where('product_id', $product->id)->delete();

// if ($request->brand_name) {

//     foreach ($request->brand_name as $key => $brand) {

//         if (!empty($brand)) {

//             $brandId = $request->brand_id[$key] ?? null;

//             // Find existing brand or create new
//             $brandSlider = $brandId
//                 ? BrandSlider::find($brandId)
//                 : new BrandSlider();

//             $imgPath = $brandSlider->image ; // keep old image

//             // Upload new image only if selected
//             if ($request->hasFile('brand_image')) {

//                 $images = $request->file('brand_image');

//                 if (isset($images[$key]) && $images[$key]) {

//                     $img = $images[$key];

//                     $imgName = rand() . time() . '.' . $img->getClientOriginalExtension();

//                     $img->move(
//                         public_path('uploads/brands'),
//                         $imgName
//                     );

//                     $imgPath = 'uploads/brands/' . $imgName;
//                 }
//             }

//             $brandSlider->product_id = $product->id;
//             $brandSlider->title = $request->brand_title[$key] ?? '';
//             $brandSlider->brand_name = $brand;
//             $brandSlider->image = $imgPath;
//             $brandSlider->link = $request->brand_link[$key] ?? '';
//             $brandSlider->sort_order = $request->brand_sort[$key] ?? 0;
//             $brandSlider->status = $request->brand_status[$key] ?? 1;
//             $brandSlider->save();
//         }
//     }
// }
//         // Delete existing FAQs before adding new ones
//         ProductFaq::where('product_id', $product->id)->delete(); // ADD THIS LINE

//         if ($request->brand_name) {

//             foreach ($request->brand_name as $key => $brand) {

//                 if (!empty($brand)) {

//                     $imgPath = '';

//                     if ($request->hasFile('brand_image')) {

//                         $images = $request->file('brand_image');

//                         if (isset($images[$key]) && $images[$key]) {

//                             $img = $images[$key];

//                             $imgName = rand() . time() . '.' . $img->getClientOriginalExtension();

//                             $img->move(
//                                 public_path('uploads/brands'),
//                                 $imgName
//                             );

//                             $imgPath = 'uploads/brands/' . $imgName;
//                         }
//                     }

//                     BrandSlider::create([
//                         'product_id' => $product->id,
//                         'title' => $request->brand_title[$key] ?? '',
//                         'brand_name' => $brand,
//                         'image' => $imgPath,
//                         'link' => $request->brand_link[$key] ?? '',
//                         'sort_order' => $request->brand_sort[$key] ?? 0,
//                         'status' => $request->brand_status[$key] ?? 1
//                     ]);
//                 }
//             }
//         }


        

//         if ($request->faq_question) {
//             foreach ($request->faq_question as $key => $question) {
//                 if ($question != '' || $request->faq_answer[$key] != '') {
//                     ProductFaq::create([
//                         'product_id' => $product->id,
//                         'question' => $question,
//                         'answer' => $request->faq_answer[$key]
//                     ]);
//                 }
//             }
//         }


//         if ($request->section_title) {

//             foreach ($request->section_title as $key => $title) {

//                 if ($title != '' || $request->section_description[$key] != '') {

//                     ProductSection::create([
//                         'product_id' => $product->id,
//                         'title' => $title,
//                         'description' => $request->section_description[$key]
//                     ]);
//                 }
//             }
//         }


//         return redirect()
//             ->route('admin.ourproduct.index')
//             ->with('success', 'Product Updated Successfully');
//     }


    public function show($id)
    {
        $product = OurProduct::with('images')->findOrFail($id);
        return view('admin.ourproduct.show', compact('product'));
    }

    public function destroy($id)
    {
        $product = OurProduct::findOrFail($id);

        /* Delete Main Image */
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }


        /* Delete Gallery Images */
        foreach ($product->images as $img) {

            if ($img->image && file_exists(public_path($img->image))) {
                unlink(public_path($img->image));
            }

            $img->delete();
        }


        /* Delete Sections */
        ProductSection::where('product_id', $product->id)->delete();


        /* Delete Product */
        $product->delete();


        return redirect()
            ->route('admin.ourproduct.index')
            ->with('success', 'Product Deleted Successfully');
    }
}
