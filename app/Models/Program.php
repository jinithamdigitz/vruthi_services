<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
   protected $fillable = [
    'title',
    'created_date',
    'start_date',
    'end_date',
    'description',
    'image',
    'video_id',
];

public function multipleImages()
{
    return $this->hasMany(MultipleImage::class);
}


}
