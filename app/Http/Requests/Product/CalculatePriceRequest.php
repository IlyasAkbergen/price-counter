<?php

namespace App\Http\Requests\Product;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CalculatePriceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => ['required', 'numeric', Rule::exists(Product::class, 'id')],
            'tax_number' => ['required', 'regex:/^([A-Z]{2})?[0-9]{9,10}/'],
        ];
    }
}
