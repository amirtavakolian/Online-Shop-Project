<?php

namespace Modules\Coworkers\App\Services\TicketAssignment\Handlers;

use Exception;
use Illuminate\Support\Facades\Auth;
use Modules\Coworkers\App\Http\Requests\ReferTicketToColleagueRequest;
use Modules\Coworkers\App\Models\Coworker;
use Modules\Coworkers\App\Services\TicketAssignment\TicketAssignmentHandler;

class DepartmentValidationHandler extends TicketAssignmentHandler
{
    public function refer(ReferTicketToColleagueRequest $request)
    {
        $coworker = Coworker::query()->where('id', $request->input('to_coworker_id'))
            ->where('department_id', Auth::guard('coworker')->user()->department_id)->first();

        if ($coworker == null) {
            throw new Exception('ارجاء تیکت به کارمند خارج از دپارتمان شما امکان پذیر نیست');
        }
        return parent::refer($request);
    }
}
