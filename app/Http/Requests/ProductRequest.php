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
            'menu_id' => 'nullable|exists:menus,id',
            'title' => 'required|string',
            'short_description' => 'nullable|string',
            'stock' => 'required|integer',
            'brand' => 'nullable|string',
            'sku' => 'nullable',
            'regular_price' => 'nullable|numeric',
            'sale_price' => 'nullable|numeric',
            'color' => 'nullable|string',
            'material' => 'nullable|string',
            'pictures' => 'nullable|array',
            'tags' => 'nullable',
            'long_description' => 'nullable|string',
            'specification' => 'nullable|array',
            'status' => 'required',
            'amazon_link' => 'nullable|string',
            'insta_link' => 'nullable|string',
        ];
    }
}
