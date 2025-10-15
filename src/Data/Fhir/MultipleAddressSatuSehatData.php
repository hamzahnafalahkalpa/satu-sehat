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

    #[MapInputName('work')]
    #[MapName('work')]
    public ?AddressSatuSehatData $work = null;

    #[MapInputName('temp')]
    #[MapName('temp')]
    public ?AddressSatuSehatData $temp = null;

    #[MapInputName('old')]
    #[MapName('old')]
    public ?AddressSatuSehatData $old = null;

    #[MapInputName('billing')]
    #[MapName('billing')]
    public ?AddressSatuSehatData $billing = null;
}