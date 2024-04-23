<?php

namespace Modules\Auth\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TwoAuthCodeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return url()->previous() == route('two-auth.index');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "two_auth" => "required"
        ];
    }
}
