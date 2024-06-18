<?php

namespace Modules\Ticket\App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreTicketRequest extends FormRequest
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
            "title" => "required",
            "priority" => "required|in:HIGH,MEDIUM,LOW",
            "department_id" => "required|exists:departments,id",
            "content" => "required"
        ];
    }

    public function validated($key = null, $default = null)
    {
        $validatedData = parent::validated();
        $validatedData['coworker_id'] = Auth::guard('coworker')->user()->id;
        return $validatedData;
    }
}
