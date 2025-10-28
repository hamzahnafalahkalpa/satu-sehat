<?php

use Hanafalah\SatuSehat\{
    Models,
    Commands,
    Contracts
};

return [
    'env_type' => env('SS_ENV_TYPE','STG'),
    'environment'=> [],
    'credentials'=> [],
    'namespace'     => 'Hanafalah\SatuSehat',
    'client_id' => env('SS_CLIENT_ID'),
    'client_secret' => env('SS_CLIENT_SECRET'),
    'organization_id' => env('SS_ORGANIZATION_ID'),
    'app' => [
        'contracts' => [
        ],
    ],
    'commands'  => [
        Commands\SeedCommand::class,
        Commands\MigrateCommand::class,
        Commands\InstallMakeCommand::class
    ],
    'libs' => [
        'asset' => '../assets',
        'config' => '../assets/config',
        'migration' => '../assets/database/migrations',
        'model' => 'Models',
        'controller' => 'Controllers',
        'provider' => 'Providers',
        'contract' => 'Contracts',
        'concern' => 'Concerns',
        'command' => 'Commands',
        'route' => 'Routes',
        'import' => 'Imports',
        'data' => 'Data',
        'transformer' => 'Transformers',
        'resource' => 'Resources',
        'seeder' => 'Database/Seeders',
        'middleware' => 'Middleware',
        'request' => 'Requests',
        'support' => 'Supports',
        'schema' => 'Schemas',
        'facade' => 'Facades',
    ],
    'database' => [
        'models' => [
        ]
    ],
    'provider' => 'Hanafalah\SatuSehat\\Providers\\SatuSehatServiceProvider'
];
