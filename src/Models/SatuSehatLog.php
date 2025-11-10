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
        'reference_type',
        'reference_id',
        'method',
        'env_type',
        'url',
        'props'
    ];

    protected $casts = [
        'name' => 'string',
        'reference_type' => 'string',
        'reference_id' => 'string',
        'method' => 'string',
        'env_type' => 'string',
        'url' => 'string'
    ];

    protected static function booted(): void{
        parent::booted();
        static::addGlobalScope('name',function($query){
            $morph = (new static)->getMorphClass();
            if ($morph !== 'SatuSehatLog'){
                $query->where(function($query) use ($morph){
                    $query->where('name',$morph);
                });
            }
        });
    }

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
