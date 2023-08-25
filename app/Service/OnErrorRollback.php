<?php

namespace App\Service;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class OnErrorRollback
{
    protected Collection $savePoints;

    public function __construct()
    {
        $this->savePoints = collect();
    }

    public function createSavePoint(string $savePointName): void
    {
        if ($this->savePoints->isNotEmpty()) {
            // If there is a save point, we assume that the previous query failed so we need to roll back to the previous save point

            $this->rollbackToSavePoint($this->savePoints->last());

            $this->releaseSavePoints();

            $this->savePoints = collect();
        }

        DB::getPdo()->exec("SAVEPOINT {$savePointName}");

        $this->savePoints->push($savePointName);
    }

    public function releaseSavePoints(): void
    {
        $this->savePoints->each(function (string $savePointName) {
            DB::getPdo()->exec("RELEASE {$savePointName}");
        });

        $this->savePoints = collect();
    }

    public function rollbackToSavePoint(string $savePointName)
    {
        DB::getPdo()->exec("ROLLBACK TO SAVEPOINT {$savePointName}");
    }
}
