<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'category_id' => 'required|exists:blog_categories,id',
            'title' => 'required|max:255',
            'slug' => 'required|max:255|unique:blogs',
            'description' => 'required|max:255',
            'cover_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif',
            'content' => 'required',
            'status' => 'required|in:draft,publish',
            'featured' => 'required|in:0,1'
        ];
    }
}
