<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Observation;

use Hanafalah\SatuSehat\Data\ParamSatuSehatData;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Observation\ParamObservationSatuSehatData as DataParamObservationSatuSehatData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\DateFormat;
use Illuminate\Support\Str;

class ParamObservationSatuSehatData extends ParamSatuSehatData implements DataParamObservationSatuSehatData
{
    #[MapInputName('name')]
    #[MapName('name')]
    public ?string $name = null;

    #[MapInputName('gender')]
    #[MapName('gender')]
    public ?string $gender = null;

    #[MapInputName('birthdate')]
    #[MapName('birthdate')]
    #[DateFormat('Y-m-d')]
    public ?string $birthdate = null;

    #[MapInputName('nik')]
    #[MapName('nik')]
    public ?string $nik = null;

    #[MapInputName('nik_ibu')]
    #[MapName('nik_ibu')]
    public ?string $nik_ibu = null;

    public static function before(array &$attributes){
        $new = static::new();
        $serialize = [
            'name'  => $attributes['name'] ?? null,
            'gender' => $attributes['gender'] ?? null,
            'birthdate' => $attributes['birthdate'] ?? null
        ];
        if (isset($attributes['nik'])){            
            if (!Str::contains($attributes['nik'],'https://fhir.kemkes.go.id/id/nik'))
                $attributes['nik'] = 'https://fhir.kemkes.go.id/id/nik|'.$attributes['nik'];
            $serialize['identifier'] = $attributes['nik'] ?? null;
        }
        if (isset($attributes['nik_ibu'])){            
            if (!Str::contains($attributes['nik_ibu'],'https://fhir.kemkes.go.id/id/nik-ibu')) 
                $attributes['nik_ibu'] = 'https://fhir.kemkes.go.id/id/nik-ibu|'.$attributes['nik_ibu'];
            $serialize['identifier'] = $attributes['nik_ibu'] ?? null;
        }
        $attributes['query'] = $new->serialize($serialize);
    }
}