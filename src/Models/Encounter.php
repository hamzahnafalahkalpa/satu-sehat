<?php

namespace Hanafalah\SatuSehat\Models;

use Hanafalah\LaravelHasProps\Concerns\HasProps;
use Hanafalah\LaravelSupport\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hanafalah\SatuSehat\Resources\Encounter\{
    ViewEncounter,
    ShowEncounter
};
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Encounter extends BaseModel
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
        return ViewEncounter::class;
    }

    public function getShowResource(){
        return ShowEncounter::class;
    }

    

    
}
