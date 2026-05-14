<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoParameter extends Model
{
    protected $table = 'seo_parameters';
    protected $fillable = [
        'route_name', 
        'title', 
        'meta_title', 
        'meta_description', 
        'og_image'
    ];

    public function commonSeoParameters()
    {
        return $this->hasOne(CommonSeoParameter::class, 'post_id');
    }
}