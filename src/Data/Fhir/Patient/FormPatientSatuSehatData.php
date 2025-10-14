<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Patient;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\MultipleAddressSatuSehatData;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Patient\FormPatientSatuSehatData as DataFormPatientSatuSehatData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\DateFormat;
use Spatie\LaravelData\Attributes\Validation\BooleanType;
use Spatie\LaravelData\Attributes\Validation\Enum;

class FormPatientSatuSehatData extends Data implements DataFormPatientSatuSehatData
{
    #[MapInputName('name')]
    #[MapName('name')]
    public string $name;

    #[MapInputName('gender')]
    #[MapName('gender')]
    #[Enum('male', 'female')]
    public ?string $gender = null;

    #[MapInputName('nik')]
    #[MapName('nik')]
    public ?object $nik = null;

    #[MapInputName('birthDate')]
    #[MapName('birthDate')]
    #[DateFormat('Y-m-d')]
    public ?object $birthDate = null;

    #[MapInputName('deceasedBoolean')]
    #[MapName('deceasedBoolean')]
    #[BooleanType]
    public ?bool $deceasedBoolean = false;

    #[MapInputName('nik_ibu')]
    #[MapName('nik_ibu')]
    public ?object $nik_ibu = null;

    #[MapInputName('address')]
    #[MapName('address')]
    public ?MultipleAddressSatuSehatData $address = null;

    public static function before(array &$attributes){
        $attributes['deceasedBoolean'] ??= false;
        $attributes['meta'] = (object) [
            "profile" => [
                "https://fhir.kemkes.go.id/r4/StructureDefinition/Patient"
            ]
        ];

    }
}