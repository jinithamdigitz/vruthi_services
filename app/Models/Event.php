<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description',
        'created_date',
        

    ];

    public function multipleImages()
    {
        return $this->hasMany(EventMultipleImage::class);
    }
}
