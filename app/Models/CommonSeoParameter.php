<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommonSeoParameter extends Model
{
    protected $table = 'common_seo_parameters';
    protected $fillable = ['keyword', 'post_id'];

    public function seoParameter()
    {
        return $this->belongsTo(SeoParameter::class, 'post_id');
    }
}
