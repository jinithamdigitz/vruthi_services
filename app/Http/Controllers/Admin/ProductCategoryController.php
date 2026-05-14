<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::latest()->paginate(10);
        return view('admin.product_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.product_categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
              $filename = time() . '.' . $request->file('image')->getClientOriginalExtension();

                        // Move the file directly into  <project>/public/posts
                        $request->file('image')->move(public_path('product_categories'), $filename);

                        // store the relative path (so asset() works)
                        $validated['image'] = 'product_categories/' . $filename;
           
        }

        ProductCategory::create($validated);

        return redirect()->route('admin.product-categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function show(ProductCategory $product_category)
    {
        return view('admin.product_categories.show', compact('product_category'));
    }

    public function edit(ProductCategory $product_category)
    {
        return view('admin.product_categories.edit', compact('product_category'));
    }

    public function update(Request $request, ProductCategory $product_category)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // delete old if exists
            if ($product_category->image) {
                Storage::disk('public')->delete($product_category->image);
            }
             $filename = time() . '.' . $request->file('image')->getClientOriginalExtension();

                        // Move the file directly into  <project>/public/posts
                        $request->file('image')->move(public_path('product_categories'), $filename);

                        // store the relative path (so asset() works)
                        $validated['image'] = 'product_categories/' . $filename;
        }

        $product_category->update($validated);

        return redirect()->route('admin.product-categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(ProductCategory $product_category)
    {
        if ($product_category->image) {
            Storage::disk('public')->delete($product_category->image);
        }
        $product_category->delete();

        return redirect()->route('admin.product-categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
