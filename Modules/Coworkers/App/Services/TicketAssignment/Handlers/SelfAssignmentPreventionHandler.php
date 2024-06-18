<?php

namespace Modules\Coworkers\App\Services\TicketAssignment\Handlers;

use Exception;
use Illuminate\Support\Facades\Auth;
use Modules\Coworkers\App\Http\Requests\ReferTicketToColleagueRequest;
use Modules\Coworkers\App\Services\TicketAssignment\TicketAssignmentHandler;

class SelfAssignmentPreventionHandler extends TicketAssignmentHandler
{
    public function refer(ReferTicketToColleagueRequest $request)
    {
        if (Auth::guard('coworker')->user()->id == $request->input('to_coworker_id')) {
            throw new Exception('ارجاء تیکت به خودتان مجاز نیست');
        }
        return parent::refer($request);
    }
}
