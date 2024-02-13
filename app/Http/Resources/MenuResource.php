<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" =>  $this->id,
            "label" =>  $this->label,
            "url" =>  $this->url,
            "menu_type" =>  $this->when(!$this->parent_id, $this->menu_type),
            "visibility" =>  $this->when($request->user()->hasRole('Super Admin'), $this->visibility),
            "image" =>  $this->when(!$this->parent_id, env('APP_URL').'/'.$this->image),
            "size" =>  $this->when(!$this->parent_id, $this->size),
            "parent_id" =>  $this->when($this->parent_id, $this->parent_id),
            "page_title" =>  $this->when(!$this->parent_id, $this->page_title),
            "meta_desc" =>  $this->when(!$this->parent_id, $this->meta_desc),
            "children_count" =>  $this->whenCounted('children'),
            "children" => MenuResource::collection($this->whenLoaded('children'))
        ];
    }
}
