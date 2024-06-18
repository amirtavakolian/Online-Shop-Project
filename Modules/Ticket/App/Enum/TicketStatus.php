<?php

namespace Modules\Ticket\App\Enum;

enum TicketStatus: string
{
    case PENDING = 'در انتظار پاسخ';
    case REVIEWING = 'در حال بررسی';
    case RESPONDED = 'پاسخ داده شد';
    case CLOSED = 'بسته شده';


    public static function getValue(string $caseName): array
    {
        return match ($caseName) {
            'PENDING' => ['danger', self::PENDING->value],
            'REVIEWING' => ['warning', self::REVIEWING->value],
            'RESPONDED' => ['success', self::RESPONDED->value],
            'CLOSED' => ['primary', self::RESPONDED->value],
        };
    }

}
