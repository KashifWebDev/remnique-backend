<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = ['label', 'url', 'menu_type', 'image', 'size', 'parent_id', 'visibility', 'page_title', 'meta_desc'];

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function scopePublished($q, bool $customQuery = false){
        return $customQuery ?
            $q->where('menus.visibility', true):
            $q->whereVisibility(true);
    }
}
