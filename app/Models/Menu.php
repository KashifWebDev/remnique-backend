<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['label', 'url', 'menu_type', 'image', 'size', 'parent_id', 'visibility', 'page_title', 'meta_desc'];


    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id')->with('children');
    }

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function scopePublished($q, bool $customQuery = false)
    {
        return $customQuery ?
            $q->where('menus.visibility', true) :
            $q->whereVisibility(true);
    }

    public function items(): HasMany
    {
        return $this->hasMany(MenuItem::class);
    }
    public function menuItems(): HasMany
    {
        return $this->hasMany(MenuItem::class);
    }

}
