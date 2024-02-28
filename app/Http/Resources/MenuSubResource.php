<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuSubResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'label' => $this->label,
            'url' => $this->url,
            'menu' => $this->when(isset($this->items) && count($this->items), [
                'type' => 'megamenu',
                'size' => 'sm',
                'columns' => [
                    [
                        'size' => 12,
                        'items' => MenuSubItemResource::collection($this->items)
                    ]
                ],
            ])
        ];
    }
}
