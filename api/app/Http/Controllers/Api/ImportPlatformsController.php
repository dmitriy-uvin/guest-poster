<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Action\Import\ImportPlatformsTableAction;
use App\Action\Import\ImportPlatformsTableRequest;
use App\Http\Requests\Platform\UploadPlatformsTableHttpRequest;
use Illuminate\Http\Request;

final class ImportPlatformsController extends ApiController
{
    private ImportPlatformsTableAction $importPlatformsTableAction;

    public function __construct(ImportPlatformsTableAction $importPlatformsTableAction)
    {
        $this->importPlatformsTableAction = $importPlatformsTableAction;
    }

    public function importPlatforms(UploadPlatformsTableHttpRequest $request)
    {
        $response = $this->importPlatformsTableAction->execute(
            new ImportPlatformsTableRequest(
                $request->file('platforms_table')
            )
        );

        return $response->getResponse();
    }
}
