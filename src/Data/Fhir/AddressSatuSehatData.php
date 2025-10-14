<?php

namespace Hanafalah\SatuSehat\Data\Fhir;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\AddressSatuSehatData as FhirAddressSatuSehatData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class AddressSatuSehatData extends Data implements FhirAddressSatuSehatData
{
}