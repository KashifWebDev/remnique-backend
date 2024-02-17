<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'menu_id',
        'title',
        'slug',
        'short_description',
        'stock',
        'brand',
        'sku',
        'regular_price',
        'sale_price',
        'colors',
        'materials',
        'cover_img',
        'pictures',
        'tags',
        'long_description',
        'specification',
        'status',
        'amazon_link',
        'insta_link',
    ];


    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function reviews(): HasMany{
        return $this->hasMany(Review::class);
    }

    public function menu(): BelongsTo{
        return $this->belongsTo(Menu::class);
    }
}
