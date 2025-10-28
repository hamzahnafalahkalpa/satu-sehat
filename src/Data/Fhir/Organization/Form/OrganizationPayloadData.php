<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Organization\Form;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Organization\Form\OrganizationPayloadData as DataOrganizationPayloadData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class OrganizationPayloadData extends Data implements DataOrganizationPayloadData
{
    #[MapInputName('resourceType')]
    #[MapName('resourceType')]
    public ?string $resourceType = 'Organization';

    #[MapInputName('active')]
    #[MapName('active')]
    public ?bool $active = true;

    #[MapInputName('identifier')]
    #[MapName('identifier')]
    #[DataCollectionOf(OrganizationFormIdentifierData::class)]
    public ?array $identifier = null;

    #[MapInputName('type')]
    #[MapName('type')]
    public ?array $type;

    #[MapInputName('name')]
    #[MapName('name')]
    public ?string $name;

    #[MapInputName('telecom')]
    #[MapName('telecom')]
    public ?array $telecom;

    #[MapInputName('address')]
    #[MapName('address')]
    #[DataCollectionOf(OrganizationFormAddressData::class)]
    public ?array $address = [];

    #[MapInputName('partOf')]
    #[MapName('partOf')]
    public ?array $partOf = [];

    public static function before(array &$attributes){
        $attributes['resourceType'] ??= 'Organization';
        $attributes['active'] ??= true;        
    }
}