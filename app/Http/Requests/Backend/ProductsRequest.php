<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProductsRequest extends FormRequest
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
        // return [
        //     //
        // ];

        // request for products
        return [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|' . Rule::unique('products', 'name')->ignore($this->id) . '|max:50|min:2',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'price' => 'required|string',
            'stock' => 'required|integer',
            'status' => 'required|boolean',
            'is_favorite' => 'required|boolean',
        ];
    }
}
