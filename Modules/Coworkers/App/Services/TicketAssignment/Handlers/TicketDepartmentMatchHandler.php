<?php

namespace Modules\Coworkers\App\Services\TicketAssignment\Handlers;

use Exception;
use Modules\Coworkers\App\Http\Requests\ReferTicketToColleagueRequest;
use Modules\Coworkers\App\Models\Ticket;
use Modules\Coworkers\App\Services\TicketAssignment\TicketAssignmentHandler;

class TicketDepartmentMatchHandler extends TicketAssignmentHandler
{
    public function refer(ReferTicketToColleagueRequest $request)
    {
        $ticket = Ticket::query()->where('department_id', $request->input('department_id'))->first();

        if ($ticket == null) {
            throw new Exception('تیکت انتخابی؛ مطعلق به دپارتمان شما نمیباشد');
        }
        return parent::refer($request);
    }
}
