<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'text1',
        'text2',
        'text3'
    ];

    public function images()
{
    return $this->hasMany(ServiceImage::class);
}


}
