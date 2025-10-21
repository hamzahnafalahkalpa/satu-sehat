<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Encounter\Form;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Encounter\Form\EncounterFormIdentifierData as DataEncounterFormIdentifierData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Illuminate\Support\Str;

class EncounterFormIdentifierData extends Data implements DataEncounterFormIdentifierData
{
    #[MapInputName('system')]
    #[MapName('system')]
    public ?string $system = null;

    #[MapInputName('value')]
    #[MapName('value')]
    public ?string $value = null;

    public static function before(array &$attributes){
        if (!Str::contains($attributes['system'], 'http://sys-ids.kemkes.go.id/encounter/')){
            throw new \Exception('encounter identifier system not found');
        }
    }
}