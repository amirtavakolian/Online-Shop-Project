<?php

namespace Modules\Ticket\App\Enum;

enum TicketStatus: string
{
    case PENDING = 'در انتظار پاسخ';
    case REVIEWING = 'در حال بررسی';
    case RESPONDED = 'پاسخ داده شد';
    case PUBLISH_LATER = 'در انتظار انتشار';
    case CLOSED = 'بسته شده';
}
