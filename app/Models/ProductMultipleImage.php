<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductMultipleImage extends Model
{
    protected $table = 'product_multiple_images';

    protected $fillable = [
        'product_id',
        'image'
    ];
}