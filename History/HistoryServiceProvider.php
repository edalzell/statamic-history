<?php

namespace Statamic\Addons\History;

use Statamic\API\Path;
use Statamic\Extend\ServiceProvider;

class HistoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // @see https://github.com/statamic/v2-hub/issues/2343
        app('config')->set(
            'database.connections.sqlite.database',
            Path::assemble(site_storage_path(), 'database.sqlite')
        );
    }
}
