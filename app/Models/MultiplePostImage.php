<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MultiplePostImage extends Model
{
    protected $table = 'multiple_post_images';

    protected $fillable = [
        'post_id',
        'image_name'
    ];

    // Relationship with Post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}