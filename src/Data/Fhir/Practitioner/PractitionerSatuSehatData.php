<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Practitioner;

use Hanafalah\SatuSehat\Contracts\Data\Fhir\Practitioner\{
    FormPractitionerSatuSehatData as PractitionerFormPractitionerSatuSehatData,
    PractitionerSatuSehatData as DataPractitionerSatuSehatData,
    ParamPractitionerSatuSehatData
};

use Hanafalah\SatuSehat\Data\OAuth2Data;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class PractitionerSatuSehatData extends OAuth2Data implements DataPractitionerSatuSehatData
{
    #[MapInputName('update_form')]
    #[MapName('update_form')]
    public ?PractitionerFormPractitionerSatuSehatData $update_form = null;

    #[MapInputName('form')]
    #[MapName('form')]
    public ?PractitionerFormPractitionerSatuSehatData $form = null;
    
    #[MapInputName('params')]
    #[MapName('params')]
    public ?ParamPractitionerSatuSehatData $params = null;

    public static function before(array &$attributes){
        $attributes['name'] ??= 'PractitionerSatuSehat';
        parent::before($attributes);
    }
}