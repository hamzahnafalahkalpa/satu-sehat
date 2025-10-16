<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Patient\Form;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Patient\Form\PatientFormNameData as DataPatientFormNameData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\In;

class PatientFormNameData extends Data implements DataPatientFormNameData
{
    #[MapInputName('use')]
    #[MapName('use')]
    #[In('usual','official','temp','nickname','anonymous','old','maiden')]
    public ?string $use = 'official';

    #[MapInputName('text')]
    #[MapName('text')]
    public ?string $text = null;

    public static function before(array &$attributes){
        $attributes['use'] ??= 'official';
    }
}