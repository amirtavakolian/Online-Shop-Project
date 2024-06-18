<?php

namespace Modules\Coworkers\App\Services\TicketAssignment\Handlers;

use Exception;
use Illuminate\Support\Facades\Auth;
use Modules\Coworkers\App\Http\Requests\ReferTicketToColleagueRequest;
use Modules\Coworkers\App\Services\TicketAssignment\TicketAssignmentHandler;

class UserDepartmentValidationHandler extends TicketAssignmentHandler
{
    public function refer(ReferTicketToColleagueRequest $request)
    {

        if (Auth::guard('coworker')->user()->departmentt->id != $request->input('department_id')) {
            throw new Exception('نام کاربری شما؛ مطعلق به دپارتمان انتخابی نمیباشد');
        }
        return parent::refer($request);
    }
}
