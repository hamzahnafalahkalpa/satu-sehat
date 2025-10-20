<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Location;

use Hanafalah\SatuSehat\Data\ParamSatuSehatData;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Location\ParamLocationSatuSehatData as DataParamLocationSatuSehatData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\DateFormat;
use Illuminate\Support\Str;

class ParamLocationSatuSehatData extends ParamSatuSehatData implements DataParamLocationSatuSehatData
{
    #[MapInputName('identifier')]
    #[MapName('identifier')]
    public ?string $identifier = null;

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
        if (isset($attributes['indentifier'])){            
            if (!Str::contains($attributes['indentifier'],'http://sys-ids.kemkes.go.id/location/1000001'))
                $attributes['indentifier'] = 'http://sys-ids.kemkes.go.id/location/1000001|'.$attributes['indentifier'];
            $serialize['identifier'] = $attributes['indentifier'] ?? null;
        }
        $attributes['query'] = $new->serialize($serialize);
    }
}