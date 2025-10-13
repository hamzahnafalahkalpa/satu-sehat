<?php

namespace Hanafalah\SatuSehat\Data;

use Hanafalah\LaravelSupport\Supports\Data;
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

    #[MapInputName('grant_type')]
    #[MapName('grant_type')]
    public ?string $grant_type = null;

    public static function before(array &$attributes){
        $attributes['name'] ??= 'OAuth2';
        $attributes['grant_type']   ??= 'client_credentials';
        $attributes['client_id']     = SatuSehat::getClientId();
        $attributes['client_secret'] = SatuSehat::getClientSecret();
    }
}