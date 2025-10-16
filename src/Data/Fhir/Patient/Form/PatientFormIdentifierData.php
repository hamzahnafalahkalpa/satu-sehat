<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Patient\Form;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Patient\Form\PatientFormIdentifierData as DataPatientFormIdentifierData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\In;

class PatientFormIdentifierData extends Data implements DataPatientFormIdentifierData
{
    #[MapInputName('use')]
    #[MapName('use')]
    #[In('usual','official','temp','secondary','old')]
    public ?string $use = 'official';

    #[MapInputName('system')]
    #[MapName('system')]
    #[In(
        'https://fhir.kemkes.go.id/id/nik',
        'https://fhir.kemkes.go.id/id/nik-ibu',
        'https://fhir.kemkes.go.id/id/ihs-number',
        'https://fhir.kemkes.go.id/id/kk',
        'https://fhir.kemkes.go.id/id/paspor'
    )]
    public ?string $system = null;

    #[MapInputName('value')]
    #[MapName('value')]
    public ?string $value = null;

    public static function before(array &$attributes){
        $attributes['use'] ??= 'official';
        $attributes['system'] ??= 'https://fhir.kemkes.go.id/id/nik';
    }
}