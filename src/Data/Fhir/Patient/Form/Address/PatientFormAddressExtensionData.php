<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Patient\Form\Address;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Patient\Form\Address\PatientFormAddressExtensionData as DataPatientFormAddressExtensionData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\Enum;

class PatientFormAddressExtensionData extends Data implements DataPatientFormAddressExtensionData
{
    #[MapInputName('use')]
    #[MapName('use')]
    #[Enum('home','work','temp','old','billing')]
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