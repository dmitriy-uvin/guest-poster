<?php

namespace App\Http\Controllers\Api;

use App\Action\ByIdsRequest;
use App\Action\Export\ExportPlatformsAllAction;
use App\Action\Export\ExportPlatformsByIdsAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

final class ExportPlatformsController extends ApiController
{
    private ExportPlatformsAllAction $exportPlatformsAllAction;
    private ExportPlatformsByIdsAction $exportPlatformsByIdsAction;

    public function __construct(
        ExportPlatformsAllAction $exportPlatformsAllAction,
        ExportPlatformsByIdsAction $exportPlatformsByIdsAction
    ) {
        $this->exportPlatformsAllAction = $exportPlatformsAllAction;
        $this->exportPlatformsByIdsAction = $exportPlatformsByIdsAction;
    }

    public function exportPlatformsAll()
    {
        $this->exportPlatformsAllAction->execute();

        return Storage::download('public/export/export-all.csv', 'export.csv');
    }

    public function exportPlatformsByIds(Request $request)
    {
        $ids = explode(',', $request->query('ids'));

        $this->exportPlatformsByIdsAction->execute(
            new ByIdsRequest($ids)
        );
        return Storage::download('public/export/export-by-ids.csv', 'export.csv');
    }
}
