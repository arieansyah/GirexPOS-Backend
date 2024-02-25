<?php

namespace App\Http\Requests\Backend\Master;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|' . Rule::unique('categories', 'name')->ignore($this->id) . '|max:50|min:2',
            'description' => 'nullable|string',
            // image
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}
