<?php

namespace Modules\Ticket\App\Enum;

enum TicketPriority: string
{
    case HIGH = 'زیاد';
    case MEDIUM = 'متوسط';
    case LOW = 'کم';
}
