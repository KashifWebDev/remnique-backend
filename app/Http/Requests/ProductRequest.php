<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'menuId' => 'required',
            'title' => 'required',
            'slug' => 'required',
            'short_description' => 'nullable',
            'stock' => 'numeric',
            'tags' => 'nullable|string',
            'brand' => 'nullable|string',
            'sku' => 'nullable|string',
            'regular_price' => 'nullable|numeric',
            'sale_price' => 'nullable|numeric',
            'material' => 'nullable|array',
            'long_description' => 'nullable|string',
            'status' => 'nullable|string|in:Active,Inactive',
            'amazon_link' => 'nullable|url',
            'insta_link' => 'nullable|url',
            'cover_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,jfif|max:15360', // Adjust validation rule for cover_img
            'coverImages' => 'nullable|array',
            'coverImages.*' => 'required|image|mimes:jpeg,png,jpg,gif,jfif|max:15360', // Adjust validation rule for coverImages
            'specifications' => 'nullable|array',
            'specifications.*.key' => 'required|string',
            'specifications.*.value' => 'required|string',
            'colors' => 'nullable|array',
            'colors.*' => 'string', // Assuming colors are strings, adjust if necessary
        ];
    }
}
