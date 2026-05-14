<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    protected $table = 'faculties';

    protected $fillable = [
        'title',
        'keyword',
        'description',
        'image',
        'qualification',
        'experience'
    ];

    // Accessor for image URL
    public function getImageUrlAttribute()
    {
        if ($this->image && file_exists(storage_path('app/public/' . $this->image))) {
            return asset('storage/' . $this->image);
        }
        return asset('default-avatar.jpg');
    }

    // Mutator for title (auto capitalize)
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucwords($value);
    }
}