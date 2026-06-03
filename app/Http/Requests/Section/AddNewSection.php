<?php

namespace App\Http\Requests\Section;

use App\Http\Requests\Base\BaseRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AddNewSection extends BaseRequest
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
        // Section Request Validation Rules

        return [

            'page_id' => 'required|integer|exists:pages,id',

            'type' => 'required|string|max:100',

            // 'title' => 'nullable|array',

            // 'description' => 'nullable|array',

            'media' => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4|max:300240',

            // 'settings' => 'nullable|array',

            'sort_order' => 'nullable|integer|min:0',

            'section_code' => 'required|string|max:50|unique:sections,section_code',

            'is_active' => 'nullable|in:0,1',

            'created_by' => 'required|integer|exists:users,id',

            'updated_by' => 'required|integer|exists:users,id',
        ];
    }
}
