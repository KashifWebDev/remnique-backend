<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'category_id' => (int)$this->category_id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'cover_image' => asset('/storage/images/blogs/'.$this->cover_image),
            'content' => $this->content,
            'status' => $this->status,
            'tags' => json_decode($this->tags),
            'featured' => boolval($this->featured),
            'comments' => BlogCommentResource::collection($this->comments)
        ];
    }
}
