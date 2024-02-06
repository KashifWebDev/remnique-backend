<?php

namespace App\Http\Controllers;

use App\Http\Requests\Blog\BlogCommentRequest;
use App\Models\Blog;
use App\Models\BlogComment;
use App\Traits\APIResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogCommentController extends Controller
{
    use APIResponseTrait;

    public function store(BlogCommentRequest $request): JsonResponse{
        $blogId = $request->input('blog_id');
        $blog = Blog::find($blogId);
        if(!$blog){
            return $this->errorResponse('Blog not found', [], 500);
        }

        $blogComment = new BlogComment();
        $this->uploadCommentAttachment($request, $blogComment);
        $blogComment->fill($request->except('attachment'));
        $comment = $blog->comments()->create($blogComment->toArray());

        return $this->successResponse('Comment was posted', $comment);
    }

    public function update(Request $request, Blog $id)
    {
        //
    }

    public function destroy(Blog $id)
    {
        //
    }

    private function uploadCommentAttachment(BlogCommentRequest $request, BlogComment $blogComment): void{
        if($request->file('attachment')){
            $img = $request->file('attachment');
            $attachment = uniqid() . '_' . $img->getClientOriginalName();
            $blogComment->attachment = $attachment;

            $disk = Storage::disk('local');
            $filePath = 'storage/images/blogs/comments/' . $img->getClientOriginalName();
            $disk->put($filePath, file_get_contents($img));
        }
    }
}
