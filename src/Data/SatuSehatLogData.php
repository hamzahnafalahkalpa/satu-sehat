<?php

namespace Hanafalah\SatuSehat\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\SatuSehat\Contracts\Data\SatuSehatLogData as DataSatuSehatLogData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class SatuSehatLogData extends Data implements DataSatuSehatLogData
{
    #[MapInputName('id')]
    #[MapName('id')]
    public mixed $id = null;

    #[MapInputName('name')]
    #[MapName('name')]
    public ?string $name = null;

    #[MapInputName('env_type')]
    #[MapName('env_type')]
    public ?string $env_type = null;

    #[MapInputName('url')]
    #[MapName('url')]
    public ?string $url = null;

    #[MapInputName('props')]
    #[MapName('props')]
    public ?array $props = null;

    public static function before(array &$attributes){
        $attributes['name'] ??= 'SatuSehatLog';
    }
}