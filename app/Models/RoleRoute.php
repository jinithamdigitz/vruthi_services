<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleRoute extends Model
{
    protected $fillable = ['role_id', 'route_name'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
