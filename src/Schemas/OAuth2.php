<?php

namespace Hanafalah\SatuSehat\Schemas;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\SatuSehat\{
    Supports\BaseSatuSehat
};
use Hanafalah\SatuSehat\Contracts\Schemas\OAuth2 as ContractsOAuth2;
use Hanafalah\SatuSehat\Contracts\Data\OAuth2Data;
use Hanafalah\SatuSehat\Facades\SatuSehat;

class OAuth2 extends BaseSatuSehat implements ContractsOAuth2
{
    protected string $__entity = 'OAuth2';
    public $o_auth2_model;
    //protected mixed $__order_by_created_at = false; //asc, desc, false

    protected array $__cache = [
        'index' => [
            'name'     => 'o_auth2',
            'tags'     => ['o_auth2', 'o_auth2-index'],
            'duration' => 24 * 60
        ]
    ];

    public function generateToken(OAuth2Data $o_auth2_dto){
        return SatuSehat::auth('accesstoken',[
            'client_id'     => $o_auth2_dto->client_id,
            'client_secret' => $o_auth2_dto->client_secret,
            'grant_type'    => $o_auth2_dto->grant_type
        ]);
    }
}