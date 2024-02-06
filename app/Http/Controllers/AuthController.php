<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\APIResponseTrait;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use APIResponseTrait;
    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse{
        if(!auth()->attempt($request->all())){
            return $this->errorResponse('You have entered an invalid username or password', [], 401);
        }

        $user = User::whereEmail($request->input('email'))->first();
        $userToken = $user->createToken('loginToken')->plainTextToken;

        return $this->successResponse(
            'Login Successfully',array(
                "user" => new UserResource($user),
                "token" => $userToken
            )
        );
    }
}
