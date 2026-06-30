<?php

namespace App\Http\Requests\Item;

use App\Http\Requests\Base\BaseRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdateItem extends BaseRequest
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
        $id = $this->route("item");
        return [

            'section_id' => 'required|integer|exists:sections,id',

            // 'title' => 'nullable|array',

            'type' => 'required|string|max:100',

            // 'description' => 'nullable|array',

            'media' => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,pdf|max:300240',

            'link' => 'nullable|url|max:500',

            // 'extra_data' => 'nullable|array',

            'sort_order' => 'nullable|integer|min:0',

            'item_code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('items', 'item_code')
                    ->ignore($id)
                    ->where('section_id', $this->input('section_id')),
            ],


            'is_active' => 'nullable|in:0,1',

            'updated_by' => 'required|integer|exists:users,id',
        ];
    }
}
