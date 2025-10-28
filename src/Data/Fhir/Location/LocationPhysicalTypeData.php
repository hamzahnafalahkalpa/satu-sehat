<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Location;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Location\{
    LocationPhysicalTypeData as DataLocationPhysicalTypeData
};

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class LocationPhysicalTypeData extends Data implements DataLocationPhysicalTypeData
{
    #[MapInputName('site')]
    #[MapName('site')]
    public ?string $site = null;

    #[MapInputName('building')]
    #[MapName('building')]
    public ?string $building = null;

    #[MapInputName('wing')]
    #[MapName('wing')]
    public ?string $wing = null;

    #[MapInputName('ward')]
    #[MapName('ward')]
    public ?string $ward = null;

    #[MapInputName('level')]
    #[MapName('level')]
    public ?string $level = null;

    #[MapInputName('corridor')]
    #[MapName('corridor')]
    public ?string $corridor = null;

    #[MapInputName('room')]
    #[MapName('room')]
    public ?string $room = null;

    #[MapInputName('bed')]
    #[MapName('bed')]
    public ?string $bed = null;

    #[MapInputName('vehicle')]
    #[MapName('vehicle')]
    public ?string $vehicle = null;

    #[MapInputName('house')]
    #[MapName('house')]
    public ?string $house = null;

    #[MapInputName('cabinet')]
    #[MapName('cabinet')]
    public ?string $cabinet = null;

    #[MapInputName('road')]
    #[MapName('road')]
    public ?string $road = null;

    #[MapInputName('area')]
    #[MapName('area')]
    public ?string $area = null;

    #[MapInputName('jurisdiction')]
    #[MapName('jurisdiction')]
    public ?string $jurisdiction = null;

    #[MapInputName('virtual')]
    #[MapName('virtual')]
    public ?string $virtual = null;
}