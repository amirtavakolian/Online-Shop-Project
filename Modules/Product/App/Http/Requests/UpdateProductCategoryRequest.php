<?php

namespace Modules\Product\App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductCategoryRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "category_id" => "required",
            "attribute_ids" => "required",
            "attribute_id" => "required",
            "variation_values" => "required",
        ];
    }

    protected function passedValidation()
    {
        foreach ($this->input('attribute_ids') as $key => $attribute) {
            $attributes[$key]['value'] = $attribute;
        }
        $this->merge(['attribute_ids' => $attributes]);

        foreach ($this->input('variation_values') as $key => $variationAttribute) {
            foreach ($variationAttribute as $variationAttributeKey => $attribute) {
                $variationAttributes[$variationAttributeKey][$key] = $attribute;
                $variationAttributes[$variationAttributeKey]['attribute_id'] = $this->input('attribute_id');
            }
        }
        $this->merge(['variation_values' => $variationAttributes]);
    }
}
