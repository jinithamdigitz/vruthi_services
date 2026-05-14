<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = ProductCategory::pluck('name','id');
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'                => 'required|string|max:255',
            'description'         => 'nullable|string',
            'image'               => 'nullable|image|max:2048',
            'product_category_id' => 'required|exists:product_categories,id',
            'gallery.*'           => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
             $filename = time() . '.' . $request->file('image')->getClientOriginalExtension();

                        // Move the file directly into  <project>/public/posts
                        $request->file('image')->move(public_path('products'), $filename);

                        // store the relative path (so asset() works)
                        $validated['image'] = 'products/' . $filename;
            
        }

            $product = Product::create($validated);

         // Multiple images
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $filename = time() . '.' . $request->file('image')->getClientOriginalExtension();

                        // Move the file directly into  <project>/public/posts
                        $request->file('image')->move(public_path('products'), $filename);

            $product->images()->create(['path' =>'products/' . $filename]);
            }
        }
        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = ProductCategory::pluck('name','id');
        $product->load('images');
        return view('admin.products.edit', compact('product','categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'                => 'required|string|max:255',
            'description'         => 'nullable|string',
            'image'               => 'nullable|image|max:2048',
            'product_category_id' => 'required|exists:product_categories,id',
              'gallery.*'          => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $filename = time() . '.' . $request->file('image')->getClientOriginalExtension();

                        // Move the file directly into  <project>/public/posts
                        $request->file('image')->move(public_path('products'), $filename);

                        // store the relative path (so asset() works)
                        $validated['image'] = 'products/' . $filename;
        }

        $product->update($validated);

    /* ---- 1. Remove selected gallery images ---- */
    if ($request->filled('delete_images')) {
        foreach ($product->images()->whereIn('id', $request->delete_images)->get() as $img) {
            if (Storage::disk('public')->exists($img->path)) {
                Storage::disk('public')->delete($img->path);
            }
            $img->delete();
        }
    }

     /* --- 2. Add new extra images --- */
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $file) {
              $filename = time() . '.' . $request->file('image')->getClientOriginalExtension();

                        // Move the file directly into  <project>/public/posts
                        $request->file('image')->move(public_path('products'), $filename);

            $product->images()->create(['path' =>'products/' . $filename]);
        }
    }


        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
