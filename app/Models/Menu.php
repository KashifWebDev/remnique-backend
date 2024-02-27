<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Menu extends Model
{
    use HasFactory;

//    protected $fillable = ['label', 'url', 'menu_type', 'image', 'size', 'parent_id', 'visibility', 'page_title', 'meta_desc'];
    protected $fillable = ['label', 'url'];


    public function scopePublished($q, bool $customQuery = false)
    {
        return $customQuery ?
            $q->where('menus.visibility', true) :
            $q->whereVisibility(true);
    }

    public function items(): HasMany{
        return $this->hasMany(MenuSub::class, 'parent_id');
    }

    public function products(): HasManyThrough{
        return $this->hasManyThrough(MenuSubItem::class, MenuSub::class, 'parent_id', 'parent_id');
    }

}
