<?php

namespace Modules\Coworkers\App\Services\TicketAssignment;

use Modules\Coworkers\App\Http\Requests\ReferTicketToColleagueRequest;

abstract class TicketAssignmentHandler
{
    protected $nextHandler;

    public function __construct(TicketAssignmentHandler $nextHandler = null)
    {
        $this->nextHandler = $nextHandler;
    }

    public function refer(ReferTicketToColleagueRequest $request)
    {
        if (!$this->nextHandler) {
            return true;
        }
        return $this->nextHandler->refer($request);
    }
}
