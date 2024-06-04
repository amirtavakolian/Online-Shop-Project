<?php

namespace Modules\Ticket\App\Http\Controllers;

use App\Http\Controllers\Controller;

class TicketController extends Controller
{

    public function index()
    {
        return view('ticket::index');
    }
}
