<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Patient;

use Hanafalah\SatuSehat\Contracts\Data\Fhir\Patient\{
    FormPatientSatuSehatData as PatientFormPatientSatuSehatData,
    PatientSatuSehatData as DataPatientSatuSehatData,
    ParamPatientSatuSehatData
};

use Hanafalah\SatuSehat\Data\OAuth2Data;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class PatientSatuSehatData extends OAuth2Data implements DataPatientSatuSehatData
{
    #[MapInputName('update_form')]
    #[MapName('update_form')]
    public ?PatientFormPatientSatuSehatData $update_form = null;

    #[MapInputName('form')]
    #[MapName('form')]
    public ?PatientFormPatientSatuSehatData $form = null;
    
    #[MapInputName('params')]
    #[MapName('params')]
    public ?ParamPatientSatuSehatData $params = null;

    public static function before(array &$attributes){
        $attributes['name'] ??= 'PatientSatuSehat';
        parent::before($attributes);
    }
}