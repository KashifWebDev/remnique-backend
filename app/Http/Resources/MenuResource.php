<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

class MenuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        $items = isset($this->items) && count($this->items) ? MenuSubItemResource::collection($this->items) : new MenuSubItemResource($this->items);

        return [
            'label' => $this->label,
            'url' => $this->url,
            'menu' => $this->when(isset($this->items) && count($this->items) , [
                'type' => 'megamenu',
                'size' => 'sm',
                'columns' => [
                    array(
                        'size' => 12,
                        'items' => MenuSubItemResource::collection($this->items)
//                        'items' => $this->items
                    )
                ],
            ])
        ];
    }
}
