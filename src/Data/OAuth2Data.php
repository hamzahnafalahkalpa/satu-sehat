<?php

namespace Hanafalah\SatuSehat\Data;

use Hanafalah\SatuSehat\Contracts\Data\OAuth2Data as DataOAuth2Data;
use Hanafalah\SatuSehat\Facades\SatuSehat;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class OAuth2Data extends SatuSehatLogData implements DataOAuth2Data
{
    #[MapInputName('client_id')]
    #[MapName('client_id')]
    public ?string $client_id = null;

    #[MapInputName('client_secret')]
    #[MapName('client_secret')]
    public ?string $client_secret = null;

    #[MapInputName('organization_id')]
    #[MapName('organization_id')]
    public ?string $organization_id = null;

    #[MapInputName('access_validation')]
    #[MapName('access_validation')]
    public ?bool $access_validation = true;

    #[MapInputName('grant_type')]
    #[MapName('grant_type')]
    public ?string $grant_type = null;

    #[MapInputName('model')]
    #[MapName('model')]
    public ?object $model = null;

    public static function before(array &$attributes){
        $attributes['access_validation'] ??= true;
        $attributes['name'] ??= 'OAuth2';
        $attributes['grant_type']   ??= 'client_credentials';
        $attributes['client_id']     = SatuSehat::getClientId();
        $attributes['client_secret'] = SatuSehat::getClientSecret();
        $attributes['organization_id'] = SatuSehat::getOrganizationId();
    }
}