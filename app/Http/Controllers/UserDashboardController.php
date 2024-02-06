<?php

namespace App\Http\Controllers;

use App\Http\Resources\BlogResource;
use App\Models\Blog;
use App\Traits\APIResponseTrait;
use Illuminate\Http\JsonResponse;

class UserDashboardController extends Controller
{
    use APIResponseTrait;

    public function myBlogs(): JsonResponse{
        if(!auth()->check()){
            return $this->errorResponse('No blogs found!', [], 200);
        }
        return $this->successResponse(
            'List of my blogs',
            BlogResource::collection(
                auth()->user()->hasRole('Super Admin') ?
                    Blog::all():
                    Blog::whereUserId(auth()->user()->id)->get()
            )
        );
    }

}
