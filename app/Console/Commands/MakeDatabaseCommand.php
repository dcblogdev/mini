<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeDatabaseCommand extends Command
{
    protected $signature = 'db:build';
    protected $description = 'Build and seed all table from fresh.';

    public function handle()
    {
        if (app()->environment(['local', 'staging'])) {
            if ($this->confirm('Do you wish to continue?')) {
                $this->call('migrate:fresh');
                $this->line('------');
                $this->call('db:seed');
            }
        } else {
            $this->error('This command is disabled on production.');
        }
    }
}
