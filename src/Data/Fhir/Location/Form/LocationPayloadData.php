<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Location\Form;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Location\Form\LocationPayloadData as DataLocationPayloadData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\DateFormat;
use Spatie\LaravelData\Attributes\Validation\In;

class LocationPayloadData extends Data implements DataLocationPayloadData
{
    #[MapInputName('resourceType')]
    #[MapName('resourceType')]
    public ?string $resourceType = 'Location';

    #[MapInputName('identifier')]
    #[MapName('identifier')]
    #[DataCollectionOf(LocationFormIdentifierData::class)]
    public ?array $identifier = null;

    #[MapInputName('status')]
    #[MapName('status')]
    public ?string $status = 'active';

    #[MapInputName('name')]
    #[MapName('name')]
    public string $name;

    #[MapInputName('description')]
    #[MapName('description')]
    public ?string $description = null;

    #[MapInputName('mode')]
    #[MapName('mode')]
    #[In('instance','kind')]
    public ?string $mode = null;

    #[MapInputName('address')]
    #[MapName('address')]
    public ?LocationFormAddressData $address = null;

    #[MapInputName('telecom')]
    #[MapName('telecom')]
    public ?array $telecom;

    #[MapInputName('physicalType')]
    #[MapName('physicalType')]
    public ?array $physicalType = null;

    #[MapInputName('position')]
    #[MapName('position')]
    public ?array $position = null;

    #[MapInputName('managingOrganization')]
    #[MapName('managingOrganization')]
    public array $managingOrganization;

    public static function before(array &$attributes){
        $attributes['resourceType'] ??= 'Location';
        $attributes['status'] ??= 'active';
        $attributes['mode'] ??= 'instance';
    }
}