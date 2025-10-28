<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Location;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Location\LocationTelcomDetailSatuSehatData;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Location\LocationTelcomSatuSehatData as DataLocationTelcomSatuSehatData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class LocationTelcomSatuSehatData extends Data implements DataLocationTelcomSatuSehatData
{
    #[MapName('work')]
    #[MapInputName('work')]
    public ?LocationTelcomDetailSatuSehatData $work = null;

    #[MapName('temp')]
    #[MapInputName('temp')]
    public ?LocationTelcomDetailSatuSehatData $temp = null;

    #[MapName('old')]
    #[MapInputName('old')]
    public ?LocationTelcomDetailSatuSehatData $old = null;
    
    #[MapName('mobile')]
    #[MapInputName('mobile')]
    public ?LocationTelcomDetailSatuSehatData $mobile = null;
}