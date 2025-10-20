<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Organization;

use Hanafalah\SatuSehat\Contracts\Data\Fhir\Organization\{
    FormOrganizationSatuSehatData as OrganizationFormOrganizationSatuSehatData,
    OrganizationSatuSehatData as DataOrganizationSatuSehatData,
    ParamOrganizationSatuSehatData
};

use Hanafalah\SatuSehat\Data\OAuth2Data;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class OrganizationSatuSehatData extends OAuth2Data implements DataOrganizationSatuSehatData
{
    #[MapInputName('update_form')]
    #[MapName('update_form')]
    public ?OrganizationFormOrganizationSatuSehatData $update_form = null;

    #[MapInputName('form')]
    #[MapName('form')]
    public ?OrganizationFormOrganizationSatuSehatData $form = null;
    
    #[MapInputName('params')]
    #[MapName('params')]
    public ?ParamOrganizationSatuSehatData $params = null;

    public static function before(array &$attributes){
        $attributes['name'] ??= 'OrganizationSatuSehat';
        parent::before($attributes);
    }
}