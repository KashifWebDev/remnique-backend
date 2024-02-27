<?php

namespace App\Http\Controllers\store;

use App\Http\Controllers\Controller;
use App\Http\Resources\MenuResource;
use App\Models\Menu;
use App\Traits\APIResponseTrait;
use Illuminate\Http\Request;

class StoreMenuController extends Controller
{
    use APIResponseTrait;

    public function index(){
        $menus = Menu::all();

//        return MenuResource::collection($menus);

//        $menus = Menu::published()->whereNull('parent_id')->with('children')->get();
        return $this->successResponse(
            'Menu Listing',
            MenuResource::collection($menus)
        );
    }
}
