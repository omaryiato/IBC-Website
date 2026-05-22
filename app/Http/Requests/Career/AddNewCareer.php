<?php

namespace App\Http\Requests\Career;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AddNewCareer extends FormRequest
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
        // Career Request Validation Rules

        return [

            'title' => 'required|array',

            'description' => 'nullable|array',

            'requirements' => 'nullable|array',

            'location' => 'nullable|string|max:255',

            'employment_type' => 'nullable|string|max:100',

            'deadline' => 'nullable|date',

            'is_active' => 'nullable|in:0,1',

            'created_by' => 'required|integer|exists:users,id',

            'updated_by' => 'required|integer|exists:users,id',
        ];
    }
}
