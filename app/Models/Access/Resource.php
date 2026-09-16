<?php

namespace App\Models\Access;

use App\Models\Admin\Menu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resource extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'label'
    ];

    public function scopeName($query, $name)
    {
        return $query->where('name', $name);
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

}
