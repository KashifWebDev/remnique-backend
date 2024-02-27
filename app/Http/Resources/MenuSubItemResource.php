<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

class MenuSubItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $data = [
            'label' => $this->label,
            'url' => $this->url,
        ];


        if ($this->items !== null && count($this->items)) {
            $data['items'] = $this->items;
        }

        return $data;
    }

}
