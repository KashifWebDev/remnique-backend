<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Http\Resources\MenuResource;
use App\Models\Menu;
use App\Services\FileUploadService;
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

    public function activeChildMenus()
    {
        $menus = Menu::published()->whereNotNull('parent_id')->get();
        return $this->successResponse(
            'List of child menus',
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

        $customObject = [
            'id' => 0,
            'url' => null,
            'label' => '[None]',
            "menu_type" =>  'null',
            "visibility" => 'null',
            "image" =>  'null',
            "size" => 'null',
            "parent_id" =>  null,
            "page_title" =>  'null',
            "meta_desc" =>  'null',
        ];

        // Merge the custom object with the collection
        $mergedCollection = collect([$customObject])->merge($parentMenu);

        return $this->successResponse(
            'List of menu',
            $mergedCollection
        );
    }


    public function getById(Menu $menu){
        return $this->successResponse(
            'Single Menu Details',
            new MenuResource($menu)
        );
    }

    public function store(StoreMenuRequest $request, FileUploadService $fileUploadService){
        $menu = new Menu();

        $menu->label = $request->input('label');
        $menu->url = $request->input('url');
        $menu->menu_type = $request->input('menu_type');
        $menu->size = $request->input('size');
        $menu->parent_id = $request->input('parent_id') === "0" ? null : $request->input('parent_id');
        $menu->visibility = (bool)$request->input('visibility'); // Default to true if not provided
        $menu->page_title = $request->input('page_title');
        $menu->meta_desc = $request->input('meta_desc');




        if($request->hasFile('image')){
            $imagePath = $fileUploadService->upload(
                $request->file('image'),
                $request->input('label'),
                '/images/menus'
            );
return $imagePath;
            $menu->image = $imagePath;
        }

        $menu->save();

        return $this->successResponse(
            'Menu was created',
            new MenuResource($menu)
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

    public function upload(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'file' => 'required|file|max:10240', // Example: max file size of 10MB
        ]);

        // Handle the file upload
        if ($request->file('file')->isValid()) {
            $fileName = time().'.'.$request->file->extension();
            $request->file->move(public_path('uploads'), $fileName); // Move the file to the uploads directory

            // You can also store the file in cloud storage like AWS S3
            // Storage::disk('s3')->put('folder_name/'.$fileName, file_get_contents($request->file('file')));

            return redirect()->back()->with('success', 'File uploaded successfully.');
        } else {
            return redirect()->back()->with('error', 'Invalid file.');
        }
    }
}
