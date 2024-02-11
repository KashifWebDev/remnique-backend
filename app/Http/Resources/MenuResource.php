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
            "image" =>  $this->when(!$this->parent_id, $this->image),
            "size" =>  $this->when(!$this->parent_id, $this->size),
            "parent_id" =>  $this->when($this->parent_id, $this->parent_id),
            "children_count" =>  $this->whenCounted('children'),
            "children" => MenuResource::collection($this->whenLoaded('children'))
        ];
    }
}
