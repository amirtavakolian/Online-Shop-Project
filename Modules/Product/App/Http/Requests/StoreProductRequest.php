<?php

namespace Modules\Product\App\Http\Requests;

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
            "name" => "required|min:5",
            "slug" => "required|unique:products,slug",
            "brand_id" => "required|exists:brands,id",
            "description" => "required|min:10",
            "category_id" => "required|exists:categories,id",
            "primary_image" => "required",
            "delivery_amount" => "required",
            "delivery_amount_per_product" => "required",
            "is_active" => "required|in:0,1",
            "attribute_ids" => "required",
            "variation_values" => "required"
        ];
    }

    protected function passedValidation(): void
    {
        $mapAttributes = [];
        foreach ($this->input('variation_values') as $key => $attribute) {
            foreach ($attribute as $index => $attributeValue) {
                $mapAttributes[$index][$key] = $attributeValue;
            }
        }
        $this->merge(['variation_values' => $mapAttributes]);

        $data = array_map(function ($value, $attribute) {
            return [
                "attribute_id" => $attribute,
                "value" => $value
            ];
        }, $this->input('attribute_ids'), array_keys($this->input('attribute_ids')));
        $this->merge(['attribute_ids' => $data]);
    }
}








