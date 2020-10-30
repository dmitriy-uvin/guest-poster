<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

final class CheckTrustApiController extends ApiController
{
    public function getCheckTrustData(Request $request)
    {
        $params = [
            'trust',
            'spam',
            'lrtPowerTrust'
        ];
        $paramsString = implode(',', $params);

        $url = 'https://checktrust.ru/app.php?r=host/app/summary/basic&applicationKey=' .
            env('CHECK_TRUST_API_KEY') . '&host=' .
            $request->query('host') . '&parameterList=' . $paramsString;
        $response = Http::get($url);

        return $response;
    }
}
