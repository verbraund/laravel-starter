<?php

namespace App\Models\Access;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    protected $fillable = [
        'name',
        'label'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function scopeHasPermission($query, $name)
    {
        return $query->where('name',$name)->exists();
    }

}
