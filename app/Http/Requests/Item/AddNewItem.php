<?php

namespace App\Http\Requests\Item;

use App\Http\Requests\Base\BaseRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AddNewItem extends BaseRequest
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
        // Item Request Validation Rules

        return [

            'section_id' => 'required|integer|exists:sections,id',

            // 'title' => 'nullable|array',

            // 'description' => 'nullable|array',

            'media' => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4|max:300240',

            'link' => 'nullable|url|max:500',

            // 'extra_data' => 'nullable|array',

            'sort_order' => 'nullable|integer|min:0',

            'item_code' => 'required|string|max:50|unique:items,item_code',

            'is_active' => 'nullable|in:0,1',

            'created_by' => 'required|integer|exists:users,id',

            'updated_by' => 'required|integer|exists:users,id',
        ];
    }
}
