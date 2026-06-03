<?php

namespace App\Http\Requests\Media;

use App\Http\Requests\Base\BaseRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AddNewMedia extends BaseRequest
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
        return[
            'media' => 'required|file|mimes:jpg,jpeg,png,webp,mp4,pdf,doc,docx|max:300240',
            // 'alt_text' => 'nullable|array',
        ];
    }
}
