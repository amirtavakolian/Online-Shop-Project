<?php

namespace Modules\Coworkers\App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreTicketReplyRequest extends FormRequest
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
            "ticket_id" => "required|exists:tickets,id",
            "content" => "required|min:5",
            "user_id" => "required|exists:users,id"
        ];
    }

    public function validated($key = null, $default = null)
    {
        $validatedData = parent::validated();
        $validatedData['coworker_id'] = Auth::guard('coworker')->user()->id;
        return $validatedData;
    }
}
