<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Patient\Form;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Patient\Form\PatientPayloadData as DataPatientPayloadData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\DateFormat;

class PatientPayloadData extends Data implements DataPatientPayloadData
{
    #[MapInputName('resourceType')]
    #[MapName('resourceType')]
    public string $resourceType = 'Patient';

    #[MapInputName('meta')]
    #[MapName('meta')]
    public ?array $meta = [];

    #[MapInputName('identifier')]
    #[MapName('identifier')]
    public ?PatientFormIdentifierData $identifier = null;

    #[MapInputName('name')]
    #[MapName('name')]
    public ?PatientFormNameData $name = null;

    #[MapInputName('active')]
    #[MapName('active')]
    public ?bool $active = true;

    #[MapInputName('gender')]
    #[MapName('gender')]
    public ?string $gender;

    #[MapInputName('birthDate')]
    #[MapName('birthDate')]
    #[DateFormat('Y-m-d')]
    public ?string $birthDate;

    #[MapInputName('address')]
    #[MapName('address')]
    #[DataCollectionOf(PatientFormAddressData::class)]
    public ?array $address = [];

    #[MapInputName('deceasedBoolean')]
    #[MapName('deceasedBoolean')]
    public ?bool $deceasedBoolean = false;

    public static function before(array &$attributes){
        $attributes['deceasedBoolean'] ??= false;
        $attributes['active'] ??= true;
        $attributes['meta'] = (object) [
            "profile" => [
                "https://fhir.kemkes.go.id/r4/StructureDefinition/Patient"
            ]
        ];
    }
}