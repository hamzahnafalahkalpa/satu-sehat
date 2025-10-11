<?php

namespace Hanafalah\SatuSehat\Providers;

use Illuminate\Support\ServiceProvider;
use Hanafalah\SatuSehat\Commands;

class CommandServiceProvider extends ServiceProvider
{
    protected $__commands = [
        Commands\MigrateCommand::class,
        Commands\SeedCommand::class,
        Commands\InstallMakeCommand::class
    ];

    /**
     * Register the command.
     *
     * @return void
     */
    public function register()
    {
        $this->commands(config('satu-sehat.commands', $this->__commands));
    }

    public function provides()
    {
        return $this->__commands;
    }
}
