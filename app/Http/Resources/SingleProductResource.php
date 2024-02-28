<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SingleProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->title,
            'sku' => $this->sku,
            'price' => (integer)$this->regular_price,
            'salePrice' => (integer)$this->sale_price,
            'reviews' => $this->reviews_count,
            'rating' => $this->averageRating(),
            'availability' => $this->stock,
            'colors' => json_decode($this->colors),
            'dynamicHeading' => $this->dynamicHeading,
            'materials' => json_decode($this->materials),
            'tags' => explode(',', $this->tags),
            'brand' => $this->brand,
            'categories' => $this->parent,
            'short_description' => $this->short_description,
            'long_description' => $this->long_description,
            'customFields' => $this->specification,
            'amazon_link' => $this->amazon_link,
            'insta_link' => $this->insta_link,
            'created_at' => $this->created_at
        ];

        //Adding Menu Categories
        $categories = [];
//        array_push($categories, ['label' => 'Home', 'url' => '/']);
//        if($this->menu_level1 <=1){
//            array_push($categories, new CategoryResource($this->menu()));
//        }
//        if($this->menu_level1 <=2){
//            array_push($categories, new CategoryResource($this->menu()));
//        }
//        if($this->menu_level1 <=1){
//            array_push($categories, new CategoryResource($this->menu()));
//        }


        $data['menus'] = $categories;

        // Transforming Pictures
        $transformedItems = [];
        $transformedItems[] = env('APP_URL').'/'.$this->cover_img;
        $items = is_string($this->pictures) ? json_decode($this->pictures, true) : $this->pictures;
        if (is_array($items) && count($items) > 0) {
            // Transform each item in the array
            foreach ($items as $item) {
                  $transformedItems[] = env('APP_URL').'/'.$item;
            }
        }
        $data['images'] = $transformedItems;

        // Transoforming Attributes
        $specifications = json_decode($this->specification, true);
        $transformedSpecifications = [];
        foreach ($specifications as $slug => $value) {
            $transformedSpecifications[] = [
                'key' => $slug,
                'value' => $value,
            ];
        }
        $data['specs'] = $transformedSpecifications;

        return $data;
    }
}
