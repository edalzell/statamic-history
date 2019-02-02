<?php

namespace Statamic\Addons\History\Commands;

use Statamic\API\File;
use Statamic\API\Path;
use Statamic\Extend\Command;
use Illuminate\Support\Facades\Artisan;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'history:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->copyMigration();

        $this->initializeDB();

        // load the migration
        app('composer')->dumpAutoloads();

        // run the migration(s)
        Artisan::call('migrate');
    }

    private function copyMigration()
    {
        $migration = date('Y_m_d_His') . '_create_events_table.php';
        // copy the migration(s)
        File::copy(
            Path::assemble(
                addons_path($this->getAddonClassName()),
                'resources',
                'migrations',
                'create_events_table.php'
            ),
            Path::assemble(
                site_path('database'),
                'migrations',
                $migration
            ),
            true
        );
    }

    private function initializeDB()
    {
        // copy the db
        File::copy(
            Path::assemble(
                addons_path($this->getAddonClassName()),
                'resources',
                'migrations',
                'database.sqlite'
            ),
            Path::assemble(
                site_path('storage'),
                'database.sqlite'
            ),
            true
        );
    }
}
