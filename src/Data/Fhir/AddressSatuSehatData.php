<?php

namespace Hanafalah\SatuSehat\Data\Fhir;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\AddressSatuSehatData as FhirAddressSatuSehatData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\In;

class AddressSatuSehatData extends Data implements FhirAddressSatuSehatData
{
    #[MapInputName('use')]
    #[MapName('use')]
    #[In('home','work','temp','old','billing')]
    public ?string $use = null;

    #[MapInputName('name')]
    #[MapName('name')]
    public ?string $name = null;

    #[MapInputName('city')]
    #[MapName('city')]
    public ?string $city = null;

    #[MapInputName('postal_code')]
    #[MapName('postal_code')]
    public ?string $postal_code = null;

    #[MapInputName('province_code')]
    #[MapName('province_code')]
    public ?string $province_code = null;

    #[MapInputName('city_code')]
    #[MapName('city_code')]
    public ?string $city_code = null;

    #[MapInputName('district_code')]
    #[MapName('district_code')]
    public ?string $district_code = null;

    #[MapInputName('village_code')]
    #[MapName('village_code')]
    public ?string $village_code = null;

    #[MapInputName('rt')]
    #[MapName('rt')]
    public ?string $rt = null;

    #[MapInputName('rw')]
    #[MapName('rw')]
    public ?string $rw = null;
}