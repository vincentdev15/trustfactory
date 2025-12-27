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
    protected $signature = 'trustfactory:init {--dev}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dev = $this->option('dev');

        $this->info('Migrating the database ...');

        $this->call('migrate:fresh');

        $this->info('Seeding the database ...');

        if ($dev) {
            $this->call('db:seed', [
                '--class' => 'DevSeeder',
            ]);
        } else {
            $this->call('db:seed');
        }

        $this->info('The application has been initialized successfully.');
    }
}
