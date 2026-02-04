<?php

namespace App\Http\Requests;

use App\Models\Product;
use App\Models\User;
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
        return [
            'items'         => [
                'required',
                'array'
            ],
            'items.*.id'    => [
                'required',
                'integer',
                'exists:products,id'
            ],
            'items.*.price' => [
                'required',
                'numeric'
            ],
        ];
    }
}
