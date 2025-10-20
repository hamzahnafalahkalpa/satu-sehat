<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Location\Form;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Location\Form\LocationPayloadData as DataLocationPayloadData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\DateFormat;

class LocationPayloadData extends Data implements DataLocationPayloadData
{
    #[MapInputName('resourceType')]
    #[MapName('resourceType')]
    public ?string $resourceType = 'Location';

    #[MapInputName('meta')]
    #[MapName('meta')]
    public ?array $meta = [];

    #[MapInputName('identifier')]
    #[MapName('identifier')]
    #[DataCollectionOf(LocationFormIdentifierData::class)]
    public ?array $identifier = null;

    #[MapInputName('name')]
    #[MapName('name')]
    #[DataCollectionOf(LocationFormNameData::class)]
    public ?array $name = null;

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
    #[DataCollectionOf(LocationFormAddressData::class)]
    public ?array $address = [];

    #[MapInputName('deceasedBoolean')]
    #[MapName('deceasedBoolean')]
    public ?bool $deceasedBoolean = false;

    #[MapInputName('multipleBirthInteger')]
    #[MapName('multipleBirthInteger')]
    public ?int $multipleBirthInteger = 0;

    public static function before(array &$attributes){
        $attributes['resourceType'] ??= 'Location';
        $attributes['deceasedBoolean'] ??= false;
        $attributes['multipleBirthInteger'] ??= 0;
        $attributes['active'] ??= true;
        $attributes['meta'] = [
            "profile" => [
                "https://fhir.kemkes.go.id/r4/StructureDefinition/Location"
            ]
        ];
    }
}