<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Location\Form;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Location\Form\LocationFormIdentifierData as DataLocationFormIdentifierData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\In;

class LocationFormIdentifierData extends Data implements DataLocationFormIdentifierData
{
    #[MapInputName('system')]
    #[MapName('system')]
    public ?string $system = null;

    #[MapInputName('value')]
    #[MapName('value')]
    public ?string $value = null;

    public static function before(array &$attributes){
        $attributes['system'] ??= 'http://sys-ids.kemkes.go.id/location/';
    }
}