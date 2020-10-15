<?php

namespace App\Exceptions\Import;

final class ImportErrorPropertyStatuses
{
    public static function getStatuses()
    {
        return [
            'notfound',
            'N/A',
            'unknown',
            ''
        ];
    }
}
