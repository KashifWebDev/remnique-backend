<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'description',
        'cover_image',
        'content',
        'status',
        'tags',
        'featured'
    ];
    protected $casts = [
        'tags' => 'array'
    ];

    function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    function category(): BelongsTo{
        return $this->belongsTo(BlogCategory::class);
    }

    function comments(): HasMany{
        return $this->hasMany(BlogComment::class);
    }
}
