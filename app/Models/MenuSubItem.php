<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuSubItem extends Model
{
    use HasFactory;
    protected $fillable = ['label', 'url'];


    public function parent(){
        return $this->belongsTo(MenuSub::class, 'parent_id');
    }
}
