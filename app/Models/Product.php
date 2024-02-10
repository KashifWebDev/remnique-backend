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
        'title',
        'short_description',
        'availability',
        'brand',
        'sku',
        'price',
        'color',
        'material',
        'pictures',
        'tags',
        'long_description',
        'specification',
        'status',
        'amazon_link',
        'insta_link',
    ];

    protected $casts = [
        'pictures' => 'array',
        'tags' => 'array',
        'specification' => 'array',
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function reviews(): HasMany{
        return $this->hasMany(Review::class);
    }
}
