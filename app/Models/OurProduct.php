<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductMultipleImage;
use App\Models\ProductSection;
use App\Models\ProductFaq;
use App\Models\BrandSlider;
use Illuminate\Support\Str;

class OurProduct extends Model
{
    use HasFactory;

    protected $table = 'our_products';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image'
    ];

    /**
     * Boot the model and add event listeners
     */
    protected static function boot()
    {
        parent::boot();

        // Handle slug generation when creating a new product
        static::creating(function ($product) {
            // If admin provided a slug, use it and make it unique
            if ($product->slug) {
                $product->slug = static::generateUniqueSlug($product->slug, $product->id);
            } 
            // Otherwise auto-generate from title
            else {
                $product->slug = static::generateUniqueSlug($product->title, $product->id);
            }
        });

        // Handle slug generation when updating an existing product
        static::updating(function ($product) {
            // Check if the slug field was manually changed by admin
            if ($product->isDirty('slug') && !empty($product->slug)) {
                // Admin provided a new slug, make it unique
                $product->slug = static::generateUniqueSlug($product->slug, $product->id);
            } 
            // Check if title changed but slug wasn't manually changed
            elseif ($product->isDirty('title') && !$product->isDirty('slug')) {
                // Auto-generate from updated title
                $product->slug = static::generateUniqueSlug($product->title, $product->id);
            }
        });
    }

    /**
     * Generate a unique slug for the product
     *
     * @param string $text
     * @param int|null $currentId
     * @return string
     */
    public static function generateUniqueSlug($text, $currentId = null)
    {
        // Convert the text to a URL-friendly slug
        $slug = Str::slug($text);
        
        // If slug is empty (e.g., special characters only), use a fallback
        if (empty($slug)) {
            $slug = 'product';
        }
        
        $originalSlug = $slug;
        $counter = 1;
        
        // Check if slug already exists in the database
        $query = static::where('slug', $slug);
        
        // Exclude current product when updating
        if ($currentId) {
            $query->where('id', '!=', $currentId);
        }
        
        // Keep checking and incrementing counter until we find a unique slug
        while ($query->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $query = static::where('slug', $slug);
            if ($currentId) {
                $query->where('id', '!=', $currentId);
            }
            $counter++;
        }
        
        return $slug;
    }

    /**
     * Manually set slug with uniqueness check
     * Useful for admin to force a specific slug
     *
     * @param string $slug
     * @return bool
     */
    public function setUniqueSlug($slug)
    {
        $this->slug = static::generateUniqueSlug($slug, $this->id);
        return $this->save();
    }

    /**
     * Use slug for route model binding instead of ID
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Accessor to get formatted URL for the product
     *
     * @return string
     */
    public function getUrlAttribute()
    {
        return route('products.show', $this->slug);
    }

    /**
     * Mutator to ensure slug is always properly formatted
     *
     * @param string $value
     */
    public function setSlugAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['slug'] = Str::slug($value);
        } else {
            $this->attributes['slug'] = null;
        }
    }

    /**
     * Query scope to find product by slug
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $slug
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWhereSlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }

    // ========== Relationship Methods ==========

    /**
     * Get the multiple images for this product
     */
    public function images()
    {
        return $this->hasMany(ProductMultipleImage::class, 'product_id');
    }

    /**
     * Get the sections for this product
     */
    public function sections()
    {
        return $this->hasMany(ProductSection::class, 'product_id');
    }

    /**
     * Get the FAQs for this product
     */
    public function faqs()
    {
        return $this->hasMany(ProductFaq::class, 'product_id');
    }

    /**
     * Get the brands for this product
     */
    public function brands()
    {
        return $this->hasMany(BrandSlider::class, 'product_id');
    }
}