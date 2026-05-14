<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
protected $fillable = [
    'title',
    'slug',
    'body',
    'image',
    'video_url',
    'post_category_id',
    'user_id',
    'published',
    'featured',
    'gallery_category_id',
    'meta_title',
    'meta_description',
    'og_image',
    'section_one_left',
    'section_one_right',
    'section_two_left',
    'section_two_right',
];

    protected static function boot()
    {
        parent::boot();

        // Handle slug generation when creating a new post
        static::creating(function ($post) {
            // If admin provided a slug, use it and make it unique
            if ($post->slug) {
                $post->slug = static::generateUniqueSlug($post->slug, $post->id);
            } 
            // Otherwise auto-generate from title
            else {
                $post->slug = static::generateUniqueSlug($post->title, $post->id);
            }
        });

        // Handle slug generation when updating an existing post
        static::updating(function ($post) {
            // Check if the slug field was manually changed by admin
            if ($post->isDirty('slug') && !empty($post->slug)) {
                // Admin provided a new slug, make it unique
                $post->slug = static::generateUniqueSlug($post->slug, $post->id);
            } 
            // Check if title changed but slug wasn't manually changed
            elseif ($post->isDirty('title') && !$post->isDirty('slug')) {
                // Auto-generate from updated title
                $post->slug = static::generateUniqueSlug($post->title, $post->id);
            }
        });
    }

    /**
     * Generate a unique slug for the post
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
            $slug = 'post';
        }
        
        $originalSlug = $slug;
        $counter = 1;
        
        // Check if slug already exists in the database
        $query = static::where('slug', $slug);
        
        // Exclude current post when updating
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
     * Accessor to get formatted URL for the post
     *
     * @return string
     */
    public function getUrlAttribute()
    {
        return route('posts.show', $this->slug);
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
     * Query scope to find post by slug
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $slug
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWhereSlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }


    /**
     * Get the gallery category that owns the post.
     */
    public function galleryCategory()
    {
        return $this->belongsTo(GalleryCategory::class);
    }

    /**
     * Scope posts by gallery category
     */
    public function scopeByGalleryCategory($query, $categoryId)
    {
        return $query->where('gallery_category_id', $categoryId);
    }
    
    /**
     * Casts for specific columns.
     */
    protected $casts = [
        'published' => 'boolean',
        'featured' => 'boolean',
    ];

    /**
     * Relationship: Post belongs to a category.
     */
    public function category()
    {
        return $this->belongsTo(PostCategory::class, 'post_category_id');
    }

    /**
     * Relationship: Post belongs to a user (author).
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function keywords()
    {
        return $this->hasMany(\App\Models\CommonSeoParameter::class, 'post_id');
    }
    
    /**
     * Relationship: Post has many multiple images.
     */
    public function multipleImages()
    {
        return $this->hasMany(MultiplePostImage::class, 'post_id');
    }
}