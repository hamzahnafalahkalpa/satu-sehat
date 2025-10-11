<?php

namespace Hanafalah\SatuSehat\Schemas;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\SatuSehat\{
    Supports\BaseSatuSehat
};
use Hanafalah\SatuSehat\Contracts\Schemas\SatuSehatToken as ContractsSatuSehatToken;
use Hanafalah\SatuSehat\Contracts\Data\SatuSehatTokenData;

class SatuSehatToken extends BaseSatuSehat implements ContractsSatuSehatToken
{
    protected string $__entity = 'SatuSehatToken';
    public $satu_sehat_token_model;
    //protected mixed $__order_by_created_at = false; //asc, desc, false

    protected array $__cache = [
        'index' => [
            'name'     => 'satu_sehat_token',
            'tags'     => ['satu_sehat_token', 'satu_sehat_token-index'],
            'duration' => 24 * 60
        ]
    ];

    public function prepareStoreSatuSehatToken(SatuSehatTokenData $satu_sehat_token_dto): Model{
        $add = [
            'name' => $satu_sehat_token_dto->name
        ];
        $guard  = ['id' => $satu_sehat_token_dto->id];
        $create = [$guard, $add];
        // if (isset($satu_sehat_token_dto->id)){
        //     $guard  = ['id' => $satu_sehat_token_dto->id];
        //     $create = [$guard, $add];
        // }else{
        //     $create = [$add];
        // }

        $satu_sehat_token = $this->usingEntity()->updateOrCreate(...$create);
        $this->fillingProps($satu_sehat_token,$satu_sehat_token_dto->props);
        $satu_sehat_token->save();
        return $this->satu_sehat_token_model = $satu_sehat_token;
    }
}