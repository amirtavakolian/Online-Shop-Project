<?php

namespace Modules\Product\App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "name" => "required",
            "slug" => "required|unique:products,slug",
            "brand_id" => "required|exists:brands,id",
            "description" => "required",
            "category_id" => "required|exists:categories,id",
            "primary_image" => "required",
            "delivery_amount" => "required",
            "delivery_amount_per_product" => "required",
            "is_active" => "required|in:0,1",
            "attribute_ids" => "required",
            "variation_values" => "required"
        ];
    }
}








