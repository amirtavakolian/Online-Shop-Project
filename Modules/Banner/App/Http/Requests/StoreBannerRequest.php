<?php

namespace Modules\Banner\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBannerRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:1', 'max:255'],
            'text' => ['required', 'string', 'min:1', 'max:255'],
            'priority' => ['required', 'numeric'],
            'is_active' => ['required', 'boolean'],
            'type' => ['required', 'string', 'min:1', 'max:255'],
            'image' => ['required', 'file'],
            'button_text' => ['required', 'string', 'min:1', 'max:255'],
            'button_link' => ['required', 'string', 'min:1', 'max:255']
        ];
    }
}
