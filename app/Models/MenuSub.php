<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuSub extends Model
{
    use HasFactory;
    protected $fillable = ['label', 'url'];

    public function parent(){
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function items(){
        return $this->hasMany(MenuSubItem::class, 'parent_id');
    }
}
