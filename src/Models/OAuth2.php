<?php

namespace Hanafalah\SatuSehat\Models;

use Hanafalah\LaravelHasProps\Concerns\HasProps;
use Hanafalah\LaravelSupport\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hanafalah\SatuSehat\Resources\OAuth2\{
    ViewOAuth2,
    ShowOAuth2
};
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class OAuth2 extends BaseModel
{
    use HasUlids, HasProps, SoftDeletes;
    
    public $incrementing  = false;
    protected $keyType    = 'string';
    protected $primaryKey = 'id';
    public $list = [
        'id',
        'name',
        'props',
    ];

    protected $casts = [
        'name' => 'string'
    ];

    

    public function viewUsingRelation(): array{
        return [];
    }

    public function showUsingRelation(): array{
        return [];
    }

    public function getViewResource(){
        return ViewOAuth2::class;
    }

    public function getShowResource(){
        return ShowOAuth2::class;
    }

    

    
}
