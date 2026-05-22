<?php

namespace App\Http\Requests\Setting;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AddNewSetting extends FormRequest
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
        // Setting Request Validation Rules

        return [

            'key' => 'required|string|max:255|unique:settings,key',

            'value' => 'nullable|array',

            'created_by' => 'required|integer|exists:users,id',

            'updated_by' => 'required|integer|exists:users,id',
        ];
    }
}
