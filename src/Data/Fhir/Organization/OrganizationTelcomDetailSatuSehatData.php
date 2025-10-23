<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Organization;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Organization\OrganizationTelcomDetailSatuSehatData as DataOrganizationTelcomDetailSatuSehatData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class OrganizationTelcomDetailSatuSehatData extends Data implements DataOrganizationTelcomDetailSatuSehatData
{
    #[MapName('phone')]
    #[MapInputName('phone')]
    public ?array $phone = null;

    #[MapName('fax')]
    #[MapInputName('fax')]
    public ?array $fax = null;

    #[MapName('email')]
    #[MapInputName('email')]
    public ?array $email = null;

    #[MapName('pager')]
    #[MapInputName('pager')]
    public ?array $pager = null;

    #[MapName('url')]
    #[MapInputName('url')]
    public ?array $url = null;

    #[MapName('sms')]
    #[MapInputName('sms')]
    public ?array $sms = null;

    #[MapName('other')]
    #[MapInputName('other')]
    public ?array $other = null;
}