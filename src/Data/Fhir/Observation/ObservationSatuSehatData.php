<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Observation;

use Hanafalah\SatuSehat\Contracts\Data\Fhir\Observation\{
    FormObservationSatuSehatData as ObservationFormObservationSatuSehatData,
    ObservationSatuSehatData as DataObservationSatuSehatData,
    ParamObservationSatuSehatData
};

use Hanafalah\SatuSehat\Data\OAuth2Data;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class ObservationSatuSehatData extends OAuth2Data implements DataObservationSatuSehatData
{
    #[MapInputName('update_form')]
    #[MapName('update_form')]
    public ?ObservationFormObservationSatuSehatData $update_form = null;

    #[MapInputName('form')]
    #[MapName('form')]
    public ?ObservationFormObservationSatuSehatData $form = null;
    
    #[MapInputName('params')]
    #[MapName('params')]
    public ?ParamObservationSatuSehatData $params = null;

    public static function before(array &$attributes){
        $attributes['name'] ??= 'ObservationSatuSehat';
        parent::before($attributes);
    }
}