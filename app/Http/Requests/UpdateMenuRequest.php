<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMenuRequest extends FormRequest
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
            'label' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'menu_type' => 'sometimes|nullable|string',
            'image' => 'nullable|sometimes|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max file size as needed
            'size' => 'nullable|string|in:xl,lg,nl,sm',
            'parent_id' => 'nullable|integer',
            'visibility' => 'nullable|string',
            'page_title' => 'nullable|string|max:255',
            'meta_desc' => 'nullable|string|max:255',
        ];
    }
}
