<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InitCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'teac:init {--dev}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Application initialization';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dev = $this->option('dev');

        if ($dev) {
            $this->info('Migrating the database ...');

            $this->call('migrate:fresh');

            $this->info('Seeding the database ...');

            $this->call('db:seed', [
                '--class' => 'DevSeeder',
            ]);
        }

        $this->info('Nothing to initialize in development mode.');

        $this->info('The application has been initialized successfully.');
    }
}
