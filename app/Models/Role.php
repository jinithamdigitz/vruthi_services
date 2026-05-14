<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name'];

    /**
     * Relationship: A role can have many users.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Relationship: A role can have many allowed routes.
     */
   public function routes()
    {
        return $this->hasMany(RoleRoute::class);
    }

    /**
     * Check if the role has access to a specific route name.
     *
     * @param string $routeName
     * @return bool
     */
    public function hasAccessTo(string $routeName): bool
    {
        return $this->routes->pluck('route_name')->contains($routeName);
    }
}
