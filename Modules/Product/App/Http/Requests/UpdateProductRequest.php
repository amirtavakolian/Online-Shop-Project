<?php

namespace Modules\Product\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "name" => "required",
            "brand_id" => "required|exists:brands,id",
            "is_active" => "required|in:0,1",
            "tag_ids" => "required",
            "tag_ids.*" => "required|exists:tags,id",
            "description" => "required",
            "delivery_amount" => "required",
            "delivery_amount_per_product" => "required",
            "attribute_values" => "required",
            "variation_values" => "required",
            "attirbute_id" => "required"
        ];
    }
}
















