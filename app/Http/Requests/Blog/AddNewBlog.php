<?php

namespace App\Http\Requests\Blog;

use App\Http\Requests\Base\BaseRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AddNewBlog extends BaseRequest
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

            // 'title' => 'required|array',
            'title' => 'required',

            // 'excerpt' => 'nullable|array',

            // 'content' => 'required|array',
            'content' => 'required',

            'media' => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4|max:300240',

            // 'seo' => 'nullable|array',

            'is_published' => 'nullable|in:0,1',

            'published_at' => 'nullable|date',

            'created_by' => 'required|integer|exists:users,id',

            'updated_by' => 'required|integer|exists:users,id',
        ];
    }
}
