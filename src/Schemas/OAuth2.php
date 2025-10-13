<?php

namespace Hanafalah\SatuSehat\Schemas;

use Hanafalah\SatuSehat\Contracts\Schemas\OAuth2 as ContractsOAuth2;
use Hanafalah\SatuSehat\Contracts\Data\OAuth2Data;
use Hanafalah\SatuSehat\Facades\SatuSehat;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class OAuth2 extends SatuSehatLog implements ContractsOAuth2
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

    public function prepareStoreOauth2(OAuth2Data $o_auth2_dto): Model{
        $satu_sehat = SatuSehat::auth('accesstoken?grant_type='.$o_auth2_dto->grant_type,[
            'client_id'     => $o_auth2_dto->client_id,
            'client_secret' => $o_auth2_dto->client_secret
        ]);
        $this->o_auth2_model = $this->logSatuSehat(SatuSehat::getResponse(),SatuSehat::getPayload(),[
            'grant_type' => $o_auth2_dto->grant_type
        ],$satu_sehat);
        return $this->o_auth2_model;
    }

    public function oauth2(mixed $conditionals = null): Builder{
        return $this->satuSehatLog($conditionals);
    }
}