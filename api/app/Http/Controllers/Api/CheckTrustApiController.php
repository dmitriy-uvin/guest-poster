<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

final class CheckTrustApiController extends ApiController
{
    private string $checkTrustApiKey;

    public function __construct()
    {
        $this->checkTrustApiKey = env('CHECK_TRUST_API_KEY');
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
