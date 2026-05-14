<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultipleImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'program_id',
    ];

    // Relation to program
    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}

