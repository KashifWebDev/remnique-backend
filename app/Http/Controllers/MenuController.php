<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Http\Resources\MenuListingResource;
use App\Http\Resources\MenuResource;
use App\Models\Menu;
use App\Models\MenuSub;
use App\Models\MenuSubItem;
use App\Services\FileUploadService;
use App\Traits\APIResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class MenuController extends Controller
{
    use APIResponseTrait;

    public function index(): JsonResponse{
        $menus = new Collection();
        $menu = Menu::withCount('items')->get()->map(function ($m) {
            $m->level = 1;
            return $m;
        });
        $menus = $menus->concat($menu);
        $menuSub = MenuSub::withCount('items')->get()->map(function ($m) {
            $m->level = 2;
            return $m;
        });
        $menus = $menus->concat($menuSub);
        return $this->successResponse(
            'List of menu',
            MenuListingResource::collection($menus)
        );
    }

    public function firstLevel(): JsonResponse{
        $customObject = [
            'id' => 0,
            'url' => null,
            'label' => '[None]',
        ];
        $mergedMenu = collect([$customObject])->merge(MenuListingResource::collection(Menu::all()));

        return $this->successResponse(
            'List of menu',
            $mergedMenu
        );
    }

    public function secondLevel($id){
        $customObject = [
            'id' => 0,
            'url' => null,
            'label' => '[None]',
        ];

        if($id == 0){
            $mergedMenu = collect([$customObject]);
        }else{
            $mergedMenu = collect([$customObject])->merge(MenuListingResource::collection(Menu::find($id)->items));
        }


        return $this->successResponse(
            'List of menu',
            $mergedMenu
        );
    }


    public function store(StoreMenuRequest $request, FileUploadService $fileUploadService){
//        $menu->visibility = (bool)$request->input('visibility'); // Default to true if not provided
//        $menu->page_title = $request->input('page_title');
//        $menu->meta_desc = $request->input('meta_desc');

//        return $request;

        $parentID = $request->input('parent_id');

        if($parentID == 0){
            $menu = new Menu();
        }

        if($request->exists('child_id')){
            $childID = $request->input('child_id');
            if(isset($childID)){
                if($childID == 0){
                    $menu = new MenuSub();
                    $menu->parent_id = $parentID;
                }elseif ($childID > 0){
                    $menu = new MenuSubItem();
                    $menu->parent_id = $childID;
                }
            }
        }

        $menu->label = $request->input('label');
        $menu->url = $request->input('url');



        if($request->hasFile('image')){
            $imagePath = $fileUploadService->upload(
                $request->file('image'),
                $request->input('label'),
                '/images/menus'
            );
//            $menu->image = $imagePath;
        }

        $menu->save();
//        return  $menu;

        return $this->successResponse(
            'Menu was created',
            $menu
        );
    }

    public function update(UpdateMenuRequest $request, Menu $menu,  FileUploadService $fileUploadService)
    {
//        $menu = Menu::findOrFail($id);
//        return $menu;

        $menu->label = $request->input('label');
        $menu->url = $request->input('url');
        $menu->menu_type = $request->input('menu_type');
        $menu->size = $request->input('size');
        $menu->parent_id = $request->input('parent_id') === "0" ? null : $request->input('parent_id');
        $menu->visibility = $request->input('visibility', true); // Default to true if not provided
        $menu->page_title = $request->input('page_title');
        $menu->meta_desc = $request->input('meta_desc');

        if($request->hasFile('image')){
            $imagePath = $fileUploadService->upload(
                $request->file('image'),
                $request->input('label'),
                '/images/menus/'
            );
            $menu->image = $imagePath;
        }

        $menu->save();

        return $this->successResponse(
            'Menu was updated',
            new MenuResource($menu)
        );
    }

}
