<?php

namespace Modules\Blog\App\Services\TimestampConverter;

use DateTime;
use DateTimeZone;

class TimestampConverterService
{

    public static function convert($timestamp)
    {
        $timestampInSeconds = $timestamp / 1000;
        $date = new DateTime("@$timestampInSeconds");
        $date->setTimezone(new DateTimeZone('Asia/Tehran'));
        return $date->format('Y-m-d H:i:s');
    }
}
