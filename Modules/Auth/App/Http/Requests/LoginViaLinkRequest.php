<?php

namespace Modules\Auth\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginViaLinkRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "email" => "required|email"
        ];
    }
}
