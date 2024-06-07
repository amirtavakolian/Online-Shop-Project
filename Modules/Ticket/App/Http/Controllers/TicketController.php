<?php

namespace Modules\Ticket\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Coworkers\App\Models\Department;
use Modules\Ticket\App\Http\Requests\StoreTicketReplyRequest;
use Modules\Ticket\App\Http\Requests\StoreTicketRequest;
use Modules\Ticket\App\Models\Ticket;
use Modules\Ticket\App\Models\TicketAnswer;
use Modules\Ticket\App\Services\FileUploader;

class TicketController extends Controller
{

    public function __construct(private FileUploader $fileUploader)
    {
    }

    public function index()
    {
        $tickets = Ticket::query()->where('user_id', Auth::user()->id)->get();
        $openedTicketsCount = $tickets->where('status', '!=', 'closed')->count();
        $closedTicketsCount = $tickets->where('status', 'closed')->count();
        return view('ticket::index', compact('tickets', 'openedTicketsCount', 'closedTicketsCount'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('ticket::create', compact('departments'));
    }

    public function store(StoreTicketRequest $request)
    {
        if (Ticket::hasOpenTicketForDepartment(Auth::user()->id, $request->input('department_id'))) {
            return redirect()->back()->with('failed', 'شما یک تیکت باز برای این دپارتمان ارسال کرده اید');
        }

        $ticketData = $request->validated();
        $ticket = Ticket::query()->create($ticketData);

        if ($request->file('attachment')) {
            $attachments = $this->fileUploader->upload($request->file('attachment'), 'ticket');
            $ticket->attachments()->create(["file_path" => $attachments]);
        }
        return redirect()->route('tickets.index')->with('success', 'تیکت شما با موفقیت ایجاد شد');
    }

    public function show(Ticket $ticket)
    {
        return view('ticket::show', compact('ticket'));
    }

    public function storeReply(StoreTicketReplyRequest $requestُ)
    {
        $ticketAnswer = TicketAnswer::query()->create($requestُ->validated());
        $ticketAnswer->ticket->updateTicketStatus('pending');
        return redirect()->route('tickets.index')->with('success', 'تیکت شما با موفقیت ثبت شد');
    }
}
