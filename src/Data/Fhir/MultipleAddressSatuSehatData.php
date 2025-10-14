<?php

namespace Hanafalah\SatuSehat\Data\Fhir;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\AddressSatuSehatData;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\MultipleAddressSatuSehatData as DataMultipleAddressSatuSehatData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class MultipleAddressSatuSehatData extends Data implements DataMultipleAddressSatuSehatData
{
    #[MapInputName('home')]
    #[MapName('home')]
    public ?AddressSatuSehatData $home = null;
}