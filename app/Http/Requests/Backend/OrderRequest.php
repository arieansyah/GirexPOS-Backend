<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
        // 'payment_amount',
        // 'sub_total',
        // 'tax',
        // 'discount',
        // 'total',
        // 'payment_method',
        // 'total_item',
        // 'user_id',
        // 'transaction_time',
        // validation for order from table orders
        return [
            'payment_amount' => 'required|numeric',
            'sub_total' => 'required|numeric',
            'tax' => 'required|numeric',
            'discount' => 'required|numeric',
            'total' => 'required|numeric',
            'payment_method' => 'required|string',
            'total_item' => 'required|numeric',
            // user_id with exists validation
            'user_id' => 'required|exists:users,id',
            'transaction_time' => 'required|string',

            'order_details' => 'required|array',
            'order_details.*.product_id' => 'required|exists:products,id',
            'order_details.*.quantity' => 'required|numeric',
            'order_details.*.price' => 'required|numeric',
        ];
    }
}