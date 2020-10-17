<?php

declare(strict_types=1);

namespace App\Action\Import;

final class ImportPlatformsTableResponse
{
    private $response;

    public function __construct($response)
    {
        $this->response = $response;
    }

    public function getResponse()
    {
        return $this->response;
    }
}
