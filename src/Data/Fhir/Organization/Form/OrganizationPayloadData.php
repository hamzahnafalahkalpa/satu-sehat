<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Organization\Form;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Organization\Form\OrganizationPayloadData as DataOrganizationPayloadData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\DateFormat;

class OrganizationPayloadData extends Data implements DataOrganizationPayloadData
{
    #[MapInputName('resourceType')]
    #[MapName('resourceType')]
    public ?string $resourceType = 'Organization';

    #[MapInputName('meta')]
    #[MapName('meta')]
    public ?array $meta = [];

    #[MapInputName('identifier')]
    #[MapName('identifier')]
    #[DataCollectionOf(OrganizationFormIdentifierData::class)]
    public ?array $identifier = null;

    #[MapInputName('name')]
    #[MapName('name')]
    #[DataCollectionOf(OrganizationFormNameData::class)]
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
    #[DataCollectionOf(OrganizationFormAddressData::class)]
    public ?array $address = [];

    #[MapInputName('deceasedBoolean')]
    #[MapName('deceasedBoolean')]
    public ?bool $deceasedBoolean = false;

    #[MapInputName('multipleBirthInteger')]
    #[MapName('multipleBirthInteger')]
    public ?int $multipleBirthInteger = 0;

    public static function before(array &$attributes){
        $attributes['resourceType'] ??= 'Organization';
        $attributes['deceasedBoolean'] ??= false;
        $attributes['multipleBirthInteger'] ??= 0;
        $attributes['active'] ??= true;
        $attributes['meta'] = [
            "profile" => [
                "https://fhir.kemkes.go.id/r4/StructureDefinition/Organization"
            ]
        ];
    }
}