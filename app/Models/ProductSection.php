<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSection extends Model
{
    protected $fillable = [
    'product_id',
    'title',
    'description'
];
}