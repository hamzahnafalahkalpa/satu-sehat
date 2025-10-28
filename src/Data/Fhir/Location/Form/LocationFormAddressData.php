<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Location\Form;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Location\Form\LocationFormAddressData as DataLocationFormAddressData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\In;

class LocationFormAddressData extends Data implements DataLocationFormAddressData
{
    #[MapInputName('use')]
    #[MapName('use')]
    #[In('home','work','temp','old','billing')]
    public ?string $use = 'home';

    #[MapInputName('line')]
    #[MapName('line')]
    public ?array $line = [];

    #[MapInputName('city')]
    #[MapName('city')]
    public ?string $city = null;

    #[MapInputName('postalCode')]
    #[MapName('postalCode')]
    public ?string $postalCode = null;

    #[MapInputName('country')]
    #[MapName('country')]
    public ?string $country = 'ID';

    #[MapInputName('extension')]
    #[MapName('extension')]
    public ?array $extension = [];

    public static function before(array &$attributes){
        $attributes['use'] ??= 'home';
        $attributes['country'] ??= 'ID';
    }
}