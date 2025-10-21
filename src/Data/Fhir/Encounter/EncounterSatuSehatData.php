<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Encounter;

use Hanafalah\SatuSehat\Contracts\Data\Fhir\Encounter\{
    FormEncounterSatuSehatData as EncounterFormEncounterSatuSehatData,
    EncounterSatuSehatData as DataEncounterSatuSehatData,
    ParamEncounterSatuSehatData
};

use Hanafalah\SatuSehat\Data\OAuth2Data;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class EncounterSatuSehatData extends OAuth2Data implements DataEncounterSatuSehatData
{
    #[MapInputName('update_form')]
    #[MapName('update_form')]
    public ?EncounterFormEncounterSatuSehatData $update_form = null;

    #[MapInputName('form')]
    #[MapName('form')]
    public ?EncounterFormEncounterSatuSehatData $form = null;
    
    #[MapInputName('params')]
    #[MapName('params')]
    public ?ParamEncounterSatuSehatData $params = null;

    public static function before(array &$attributes){
        $attributes['name'] ??= 'EncounterSatuSehat';
        parent::before($attributes);
    }
}