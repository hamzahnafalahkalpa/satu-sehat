<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Location;

use Hanafalah\SatuSehat\Contracts\Data\Fhir\Location\{
    FormLocationSatuSehatData as LocationFormLocationSatuSehatData,
    LocationSatuSehatData as DataLocationSatuSehatData,
    ParamLocationSatuSehatData
};

use Hanafalah\SatuSehat\Data\OAuth2Data;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class LocationSatuSehatData extends OAuth2Data implements DataLocationSatuSehatData
{
    #[MapInputName('update_form')]
    #[MapName('update_form')]
    public ?LocationFormLocationSatuSehatData $update_form = null;

    #[MapInputName('form')]
    #[MapName('form')]
    public ?LocationFormLocationSatuSehatData $form = null;
    
    #[MapInputName('params')]
    #[MapName('params')]
    public ?ParamLocationSatuSehatData $params = null;

    public static function before(array &$attributes){
        $attributes['name'] ??= 'LocationSatuSehat';
        parent::before($attributes);
    }
}