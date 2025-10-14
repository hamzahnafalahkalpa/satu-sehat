<?php

namespace Hanafalah\SatuSehat\Models;

use Hanafalah\LaravelHasProps\Concerns\HasProps;
use Hanafalah\LaravelSupport\Models\BaseModel;
use Hanafalah\SatuSehat\Resources\SatuSehatLog\{
    ViewSatuSehatLog,
    ShowSatuSehatLog
};
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class SatuSehatLog extends BaseModel
{
    use HasUlids, HasProps;
    
    public $incrementing  = false;
    protected $keyType    = 'string';
    protected $primaryKey = 'id';
    public $list = [
        'id',
        'name',
        'env_type',
        'url',
        'props'
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
        return ViewSatuSehatLog::class;
    }

    public function getShowResource(){
        return ShowSatuSehatLog::class;
    }
}
