<?php

namespace App\Http\Controllers;

use App\Http\Resources\MenuResource;
use App\Models\Menu;
use App\Traits\APIResponseTrait;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    use APIResponseTrait;

    public function index()
    {
        $menus = Menu::with('children')->withCount('children')->whereNull('parent_id')->get();
        return $this->successResponse(
            'List of menu',
            MenuResource::collection($menus)
        );
    }
    public function completeSingleMenu(){
        $menus = Menu::leftJoin('menus as children', 'menus.id', '=', 'children.parent_id')
            ->select('menus.*', \DB::raw('COUNT(children.id) as children_count'))
            ->groupBy('menus.id')
            ->get();

        return $this->successResponse(
            'List of menu',
            MenuResource::collection($menus)
        );
    }

    public function parent(){
        $parentMenu = Menu::withCount('children')->whereNull('parent_id')->get();
        return $this->successResponse(
            'List of menu',
            MenuResource::collection($parentMenu)
        );
    }

    public function getById(Menu $menu){
        return new MenuResource($menu);
        return $this->successResponse(
            'Single Menu Details',
            new MenuResource($menu::with('children'))
        );
    }
}
