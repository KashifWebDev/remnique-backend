<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $baseURL = env("APP_URL"); // Replace this with your base URL

        // Decode the 'pictures' JSON string into an array
        $pictures = json_decode($this->pictures);

        // Prepend the base URL to each picture URL
        $picturesWithBaseURL = array_map(function($picture) use ($baseURL) {
            return $baseURL .'/'. $picture;
        }, $pictures);


        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'short_description' => $this->short_description,
            'stock' => $this->stock,
            'brand' => $this->brand,
            'sku' => $this->sku,
            'regular_price' => $this->regular_price,
            'sale_price' => $this->sale_price,
            'colors' => $this->colors,
            'materials' => $this->materials,
            'pictures' => $picturesWithBaseURL,
            'tags' => $this->tags,
            'long_description' => $this->long_description,
            'specification' => $this->specification,
            'amazon_link' => $this->amazon_link,
            'insta_link' => $this->insta_link,
            'created_at' => $this->created_at,
            'status' => $this->status
        ];
    }
}
