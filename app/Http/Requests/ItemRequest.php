<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'product_id' => 'required|string|exists:products,id',
            'quantity' => [
                Rule::requiredIf(fn () => $this->cartItemExists()),
                'integer',
                'min:0',
            ],
        ];
    }
    
    protected function cartItemExists(): bool
    {
        return $this->user()->cart->items()->where('product_id', $this->product_id)->exists();
    }
}
