<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Observation\Form;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Observation\Form\ObservationFormIdentifierData as DataObservationFormIdentifierData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Illuminate\Support\Str;

class ObservationFormIdentifierData extends Data implements DataObservationFormIdentifierData
{
    #[MapInputName('system')]
    #[MapName('system')]
    public ?string $system = null;

    #[MapInputName('value')]
    #[MapName('value')]
    public ?string $value = null;

    public static function before(array &$attributes){
        if (!Str::contains($attributes['system'], 'http://sys-ids.kemkes.go.id/Observation/')){
            throw new \Exception('Observation identifier system not found');
        }
    }
}