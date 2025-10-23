<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Organization;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Organization\OrganizationTypeSatuSehatData as DataOrganizationTypeSatuSehatData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class OrganizationTypeSatuSehatData extends Data implements DataOrganizationTypeSatuSehatData
{
    #[MapName('provider')]
    #[MapInputName('provider')]
    public ?string $provider = null;

    #[MapName('department')]
    #[MapInputName('department')]
    public ?string $department = null;

    #[MapName('team')]
    #[MapInputName('team')]
    public ?string $team = null;

    #[MapName('government')]
    #[MapInputName('government')]
    public ?string $government = null;

    #[MapName('insurence')]
    #[MapInputName('insurence')]
    public ?string $insurence = null;

    #[MapName('payer')]
    #[MapInputName('payer')]
    public ?string $payer = null;

    #[MapName('educational')]
    #[MapInputName('educational')]
    public ?string $educational = null;

    #[MapName('religious')]
    #[MapInputName('religious')]
    public ?string $religious = null;
    
    #[MapName('clinical_research')]
    #[MapInputName('clinical_research')]
    public ?string $clinical_research = null;

    #[MapName('community')]
    #[MapInputName('community')]
    public ?string $community = null;

    #[MapName('bussiness')]
    #[MapInputName('bussiness')]
    public ?string $bussiness = null;

    #[MapName('other')]
    #[MapInputName('other')]
    public ?string $other = null;
}