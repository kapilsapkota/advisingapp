<?php

namespace App\Providers;

use App\Service\OnErrorRollback;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Events\QueryExecuted;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(OnErrorRollback::class, function ($app) {
            return new OnErrorRollback();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        DB::connection('pgsql')->beforeExecuting(function ($query) {
            if (DB::transactionLevel() > 0) {
                resolve(OnErrorRollback::class)->createSavePoint('tmp_' . md5($query));
            }
        });

        Event::listen(QueryExecuted::class, function (QueryExecuted $event) {
            if (DB::transactionLevel() > 0 && $event->connectionName == 'pgsql') {
                resolve(OnErrorRollback::class)->releaseSavePoints();
            }
        });
    }
}
