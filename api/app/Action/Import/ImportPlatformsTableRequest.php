<?php

declare(strict_types=1);

namespace App\Action\Import;

final class ImportPlatformsTableRequest
{
    private $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function getFile()
    {
        return $this->file;
    }
}
