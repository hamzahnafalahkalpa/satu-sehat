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

    #[MapInputName('reference_type')]
    #[MapName('reference_type')]
    public ?string $reference_type = null;

    #[MapInputName('reference_id')]
    #[MapName('reference_id')]
    public mixed $reference_id = null;

    #[MapInputName('method')]
    #[MapName('method')]
    public ?string $method = null;

    #[MapInputName('env_type')]
    #[MapName('env_type')]
    public ?string $env_type = null;

    #[MapInputName('url')]
    #[MapName('url')]
    public ?string $url = null;

    #[MapInputName('model')]
    #[MapName('model')]
    public ?object $model = null;

    #[MapInputName('props')]
    #[MapName('props')]
    public ?array $props = null;

    public static function before(array &$attributes){
        $attributes['name'] ??= 'SatuSehatLog';
    }
}