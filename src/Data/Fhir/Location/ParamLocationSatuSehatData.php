<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Location;

use Hanafalah\SatuSehat\Data\ParamSatuSehatData;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Location\ParamLocationSatuSehatData as DataParamLocationSatuSehatData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Illuminate\Support\Str;

class ParamLocationSatuSehatData extends ParamSatuSehatData implements DataParamLocationSatuSehatData
{
    #[MapInputName('id')]
    #[MapName('id')]
    public ?string $id = null;

    #[MapInputName('identifier')]
    #[MapName('identifier')]
    public ?string $identifier = null;

    #[MapInputName('id_main_location')]
    #[MapName('id_main_location')]
    public ?string $id_main_location = null;

    #[MapInputName('name')]
    #[MapName('name')]
    public ?string $name = null;

    #[MapInputName('organization')]
    #[MapName('organization')]
    public ?string $organization = null;

    public static function before(array &$attributes){
        $new = static::new();
        $serialize = [
            'identifier'  => $attributes['identifier'] ?? null,
            'organization' => $attributes['organization'] ?? null,
            'name' => $attributes['name'] ?? null
        ];
        if (isset($attributes['indentifier']) && isset($attributes['id_main_location'])) {            
            $attributes['indentifier'] = 'http://sys-ids.kemkes.go.id/location/'.$attributes['id_main_location'].'|'.$attributes['indentifier'];
            $serialize['identifier'] = $attributes['indentifier'] ?? null;
        }
        $attributes['query'] = $new->serialize($serialize);
    }
}