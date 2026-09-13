<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'site_menus';

    protected $fillable = [
        'parent_id',
        'name',
        'urn'
    ];

    public function scopeMain($query)
    {
        return $query->WhereNull('parent_id');
    }
}
