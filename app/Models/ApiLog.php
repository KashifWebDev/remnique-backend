<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiLog extends Model
{
    use HasFactory;

    protected $fillable = ['request', 'method', 'response', 'response_status', 'user_id', 'request_params', 'route', 'ip'];
}
