<?php

namespace Modules\Coworkers\App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ReferTicketToColleagueRequest extends FormRequest
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
            "from_coworker_id" => "required|exists:coworkers,id",
            "department_id" => "required|exists:departments,id",
            "ticket_id" => "required|exists:tickets,id",
            "to_coworker_id" => "required|exists:coworkers,id"
        ];
    }
}

