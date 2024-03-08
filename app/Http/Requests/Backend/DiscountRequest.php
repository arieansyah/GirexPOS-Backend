<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DiscountRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            // 'type' => ['nullable', Rule::in(['percentage', 'fixed'])],
            'type' => ['nullable'],
            'value' => ['required', 'numeric'],
            // 'status' => [Rule::in(['active', 'inactive'])],
            'status' => ['nullable'],
            'expired_date' => ['nullable', 'string'],
        ];
    }
}