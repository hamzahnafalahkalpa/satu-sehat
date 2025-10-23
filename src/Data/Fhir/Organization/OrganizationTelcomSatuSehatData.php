<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Organization;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Organization\OrganizationTelcomDetailSatuSehatData;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Organization\OrganizationTelcomSatuSehatData as DataOrganizationTelcomSatuSehatData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class OrganizationTelcomSatuSehatData extends Data implements DataOrganizationTelcomSatuSehatData
{
    #[MapName('work')]
    #[MapInputName('work')]
    public ?OrganizationTelcomDetailSatuSehatData $work = null;

    #[MapName('temp')]
    #[MapInputName('temp')]
    public ?OrganizationTelcomDetailSatuSehatData $temp = null;

    #[MapName('old')]
    #[MapInputName('old')]
    public ?OrganizationTelcomDetailSatuSehatData $old = null;
    
    // #[MapName('home')]
    // #[MapInputName('home')]
    // public ?OrganizationTelcomDetailSatuSehatData $home = null;

    #[MapName('mobile')]
    #[MapInputName('mobile')]
    public ?OrganizationTelcomDetailSatuSehatData $mobile = null;
}