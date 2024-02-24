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
            'id' => $this->id,
            'label' => $this->label,
            'url' => $this->url,
            'menu' => [
                'type' => $this->menu_type,
                'size' => $this->size,
                'columns' => $this->when($this->menu_type === 'megamenu', [
                    [
                        'size' => 12,
                        'items' => MenuItemResource::collection($this->items)
                    ]
                ]),
                'items' => $this->when($this->menu_type !== 'megamenu', MenuItemResource::collection($this->items))
            ]
        ];

    }
}
