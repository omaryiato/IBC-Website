<?php

namespace App\Http\Requests\Page;

use App\Http\Requests\Base\BaseRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePage extends BaseRequest
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
        $id = $this->route("page");
        return [
            'slug' => 'required|string|max:255|unique:pages,slug,' . $id,
            // 'meta_title' => 'nullable|array',
            // 'meta_description' => 'nullable|array',
            'page_code' => 'required|string|max:50|unique:pages,page_code,' . $id,
            'is_active' => 'nullable|in:0,1',
        ];
    }
}
