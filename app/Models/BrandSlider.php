<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandSlider extends Model
{
    protected $fillable = [
        'product_id',
        'title',
        'brand_name',
        'image',
        'link',
        'sort_order',
        'status'
    ];

    public function product()
    {
        return $this->belongsTo(OurProduct::class, 'product_id');
    }
}


