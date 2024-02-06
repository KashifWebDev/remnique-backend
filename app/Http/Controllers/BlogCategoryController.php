<?php

namespace App\Http\Controllers;

use App\Http\Requests\Blog\BlogCategoryRequest;
use App\Http\Resources\BlogCategoryResource;
use App\Models\BlogCategory;
use App\Traits\APIResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller{
    use APIResponseTrait;

    public function index(): JsonResponse{
        return $this->successResponse(
            'List of Blog Categories',
            BlogCategoryResource::collection(BlogCategory::all())
        );
    }

    public function store(BlogCategoryRequest $request): JsonResponse{
        try {
            $blogCat = BlogCategory::create($request->only(['name', 'slug']));
            return $this->successResponse('Blog Category was created', new BlogCategoryResource($blogCat));
        }
        catch (\Exception $exception){
            return $this->errorResponse('Error occurred while creating Blog Category', $exception->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(BlogCategory $blogCategory)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlogCategory $blogCategory): JsonResponse{
        try {
            $blogCategory->update($request->only(['name', 'slug']));
            $updatedData = $blogCategory->refresh();
            return $this->successResponse('Blog Category was updated', new BlogCategoryResource($updatedData));
        }
        catch (\Exception $exception){
            return $this->errorResponse('Error occurred while updating Blog Category', $exception->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogCategory $blogCategory): JsonResponse{
        return $blogCategory->delete() ?
            $this->successResponse('Record was deleted!', [], 200) :
            $this->successResponse('Error occurred while deleting record!', [], 500);
    }
}
