<?php

namespace Modules\Coworkers\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Auth\App\Models\User;
use Modules\Coworkers\App\Http\Requests\StoreTicketReplyRequest;
use Modules\Coworkers\App\Models\Ticket;
use Modules\Coworkers\App\Models\TicketAnswer;
use Modules\Coworkers\App\Notifications\TicketRespondedNotification;
use Modules\Ticket\App\Enum\TicketStatus;


class TicketController extends Controller
{

    public function index()
    {
        $tickets = Ticket::query()
            ->where('department_id', Auth::guard('coworker')->user()->department_id)
            ->where('status', '!=', TicketStatus::CLOSED)
            ->get();

        return view('coworkers::tickets.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        if (Auth::guard('coworker')->user()->openedTicketsBy() >= 3) {
            return redirect()->back()->with('faild', 'تعداد تیکت های باز شده بیشتر از 3 میباشد');
        }
        $ticket->opened();
        $ticket->openBy(Auth::guard('coworker')->user()->id);
        $ticket->updateTicketStatus('reviewing');
        return view('coworkers::tickets.show', compact('ticket'));
    }

    public function store(StoreTicketReplyRequest $request)
    {
        $ticketAnswer = TicketAnswer::query()->create($request->validated());
        $ticketAnswer->ticket->updateTicketStatus('responded');
        User::find($request->input('user_id'))->notify(new TicketRespondedNotification());
        return redirect()->route('coworkers.tickets.index')->with('success', 'تیکت شما با موفقیت ثبت شد');
    }
}
