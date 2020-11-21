<?php


namespace App\Exceptions\Import;

final class ImportAPIErrorStatuses
{
    public static function getStatuses()
    {
        return [
            'bad_url',
            'not_found',
            'empty',
            'no_data',
            'error_internal',
            'disallowed'
        ];
    }
}
