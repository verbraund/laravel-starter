<?php

namespace App\Models\Access;

use App\Enums\SystemRole;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_system'
    ];

    protected function casts(): array
    {
        return [
            'is_system' => 'boolean'
        ];
    }

    public function scopeSlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function resource($resource)
    {
        //TODO remove start
        if(!$resource instanceof Resource){
            $resource = Resource::name($resource)->firstOrFail();
        }
        //TODO remove end

        return $this->belongsToMany(Permission::class)
            ->withPivotValue('resource_id', $resource->id)
            ->withTimestamps();
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role')
            ->withPivot('resource_id')
            ->withTimestamps();
    }

    public function resources()
    {
        return $this->belongsToMany(Resource::class, 'permission_role')
            ->withPivot('permission_id')
            ->withTimestamps();
    }

    public function isSuperAdmin(): bool
    {
        return $this->slug === SystemRole::SUPER_ADMIN->value;
    }

    public function isAdmin(): bool
    {
        return $this->slug === SystemRole::ADMIN->value;
    }



}
