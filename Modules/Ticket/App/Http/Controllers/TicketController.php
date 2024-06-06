<?php

namespace Modules\Ticket\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Coworkers\App\Models\Department;
use Modules\Ticket\App\Http\Requests\StoreTicketRequest;
use Modules\Ticket\App\Models\Ticket;
use Modules\Ticket\App\Services\FileUploader;

class TicketController extends Controller
{

    public function __construct(private FileUploader $fileUploader)
    {
    }

    public function index()
    {
        return view('ticket::index');
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
        $ticketData['user_id'] = Auth::user()->id;
        $ticket = Ticket::query()->create($ticketData);

        if ($request->file('attachment')) {
            $attachments = $this->fileUploader->upload($request->file('attachment'), 'ticket');
            $ticket->attachments()->create([
                "file_path" => $attachments
            ]);
        }

    }
}
