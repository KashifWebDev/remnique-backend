<?php

namespace App\Http\Controllers;

use App\Http\Requests\Blog\BlogRequest;
use App\Http\Resources\BlogResource;
use App\Models\blog;
use App\Services\FileUploadService;
use App\Traits\APIResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller{

    use APIResponseTrait;

    public function index(): JsonResponse{
        return $this->successResponse(
            'List of blog posts',
            Blog::whereStatus('publish')->get()
        );
    }

    public function store(BlogRequest $request): JsonResponse{
        try{
            $blog = new Blog();
            $this->uploadBlogImg($request, $blog);
            $blog->fill($request->except('cover_image'));
            $blog->save();
            return $this->successResponse('Blog was created', new BlogResource($blog));
        }catch (\Exception $e){
            return $this->errorResponse('Error occurred while creating blog', $e->getMessage(), 500);
        }
    }

    public function show(blog $blog): JsonResponse{
        try{
            return $this->successResponse('Blog Post Listing', new BlogResource($blog));
        }catch (\Exception $e){
            return $this->errorResponse('Error occurred while fetching blog', $e->getMessage(), 500);
        }
    }

    public function update(BlogRequest $request, blog $blog){
        if($this->checkIfNotOwner($blog->id))
            return $this->errorResponse("You're not the owner of this post!", [], 500);

        try{
            $this->uploadBlogImg($request, $blog);
            $blog->update($request->except('cover_image'));
            $blog->refresh();
            return $this->successResponse('Blog was updated!', $blog);
        }catch(\Exception $e){
            return $this->errorResponse('Error occurred while updating blog', [], 500);
        }
    }

    public function destroy(blog $blog): JsonResponse{
        $this->checkIfOwner($blog->id);
        return $blog->delete() ?
            $this->successResponse('Record was deleted!', [], 200) :
            $this->successResponse('Error occurred while deleting record!', [], 500);
    }

    private function uploadBlogImg(BlogRequest $request, Blog $blog): void{
        if($request->file('cover_image')){
            $img = $request->file('cover_image');
            $coverImg = uniqid() . '_' . $img->getClientOriginalName();
            $blog->cover_image = $coverImg;

            $disk = Storage::disk('local');
            $filePath = 'storage/images/blogs/covers/' . $img->getClientOriginalName();
            $disk->put($filePath, file_get_contents($img));
        }
    }

    private function checkIfNotOwner($id){
        return !auth()->user()->hasRole('Super Admin') || Blog::find((int)$id)->user_id != auth()->user()->id;
    }

}
