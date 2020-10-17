<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

final class CheckTrustApiController extends ApiController
{
    private string $checkTrustApiKey;

    public function __construct()
    {
        $this->checkTrustApiKey = 'a0aece19412bc5f00b4e595fbd158fb4';
    }

    public function getCheckTrustData(Request $request)
    {
        $params = [
            'trust',
            'spam',
            'lrtPowerTrust'
        ];
        $paramsString = implode(',', $params);

        $url = 'https://checktrust.ru/app.php?r=host/app/summary/basic&applicationKey=' .
            $this->checkTrustApiKey . '&host=' .
            $request->query('host') . '&parameterList=' . $paramsString;

        $response = Http::get($url);

        return $response;
    }
}
