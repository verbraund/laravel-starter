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

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function resource($name)
    {
        return $this->belongsToMany(Permission::class)
            ->wherePivot('resource_id', Resource::findIdByName($name));
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function resources()
    {
        return $this->belongsToMany(Resource::class, 'permission_role');
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
