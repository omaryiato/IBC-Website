<?php

namespace App\Http\Requests\CareerApplication;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AddNewCareerApplication extends FormRequest
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
            'career_id' => 'required|integer|exists:careers,id',

            'full_name' => 'required|string|max:255',

            'email' => 'required|email|max:255',

            'phone' => 'nullable|string|max:100',

            'cv_file' => 'required|file|mimes:pdf,doc,docx|max:10240',

            'message' => 'nullable|string|max:5000',
        ];
    }
}
