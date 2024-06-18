<?php

namespace Modules\Coworkers\App\Services\TicketAssignment;

use Modules\Coworkers\App\Http\Requests\ReferTicketToColleagueRequest;
use Modules\Coworkers\App\Services\TicketAssignment\Handlers\DepartmentValidationHandler;
use Modules\Coworkers\App\Services\TicketAssignment\Handlers\EmployeeAuthenticationHandler;
use Modules\Coworkers\App\Services\TicketAssignment\Handlers\SelfAssignmentPreventionHandler;
use Modules\Coworkers\App\Services\TicketAssignment\Handlers\TicketDepartmentMatchHandler;
use Modules\Coworkers\App\Services\TicketAssignment\Handlers\UserDepartmentValidationHandler;

class TicketAssignmentService
{

    public function verify(ReferTicketToColleagueRequest $request)
    {
        $departmentValidation = new DepartmentValidationHandler();
        $employeeAuth = new EmployeeAuthenticationHandler($departmentValidation);
        $preventSelfAssignemnet = new SelfAssignmentPreventionHandler($employeeAuth);
        $ticketDepartment = new TicketDepartmentMatchHandler($preventSelfAssignemnet);
        $userValidation = new UserDepartmentValidationHandler($ticketDepartment);
        return $userValidation->refer($request);
    }
}
