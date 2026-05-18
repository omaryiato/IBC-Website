<?php

namespace App\Http\Requests\Blog;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBlog extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'slug' => 'required|string|max:255|unique:blogs,slug',

            'title' => 'required|array',

            'excerpt' => 'nullable|array',

            'content' => 'required|array',

            'media' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:10240',

            'seo' => 'nullable|array',

            'is_published' => 'nullable|in:0,1',

            'published_at' => 'nullable|date',
        ];
    }
}
