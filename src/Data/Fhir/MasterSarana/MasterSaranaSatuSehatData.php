<?php

namespace Hanafalah\SatuSehat\Data\Fhir\MasterSarana;

use Hanafalah\SatuSehat\Contracts\Data\Fhir\MasterSarana\{
    MasterSaranaSatuSehatData as DataMasterSaranaSatuSehatData,
    ParamMasterSaranaSatuSehatData
};

use Hanafalah\SatuSehat\Data\OAuth2Data;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class MasterSaranaSatuSehatData extends OAuth2Data implements DataMasterSaranaSatuSehatData
{
    #[MapInputName('params')]
    #[MapName('params')]
    public ?ParamMasterSaranaSatuSehatData $params = null;

    public static function before(array &$attributes){
        $attributes['name'] ??= 'MasterSaranaSatuSehat';
        parent::before($attributes);
    }
}