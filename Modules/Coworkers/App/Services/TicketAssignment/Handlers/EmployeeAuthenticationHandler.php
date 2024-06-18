<?php

namespace Modules\Coworkers\App\Services\TicketAssignment\Handlers;

use Exception;
use Illuminate\Support\Facades\Auth;
use Modules\Coworkers\App\Http\Requests\ReferTicketToColleagueRequest;
use Modules\Coworkers\App\Services\TicketAssignment\TicketAssignmentHandler;

class EmployeeAuthenticationHandler extends TicketAssignmentHandler
{
    public function refer(ReferTicketToColleagueRequest $request)
    {
        if (Auth::guard('coworker')->user()->id != $request->input('from_coworker_id')) {
            throw new Exception('دسترسی غیر مجاز. لطفا با نام کاربری خود وارد شوید');
        }
        return parent::refer($request);
    }
}
