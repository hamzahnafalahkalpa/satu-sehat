<?php

namespace Hanafalah\SatuSehat\Schemas;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\SatuSehat\{
    Supports\BaseSatuSehat
};
use Hanafalah\SatuSehat\Contracts\Schemas\SatuSehatLog as ContractsSatuSehatLog;
use Hanafalah\SatuSehat\Contracts\Data\SatuSehatLogData;
use Hanafalah\SatuSehat\Facades\SatuSehat;

class SatuSehatLog extends BaseSatuSehat implements ContractsSatuSehatLog
{
    protected string $__entity = 'SatuSehatLog';
    public $satu_sehat_log_model;
    protected $__headers = [];
    protected $__status_code = null;
    protected $__response = null;
    protected $__payload = [];
    //protected mixed $__order_by_created_at = false; //asc, desc, false

    protected array $__cache = [
        'index' => [
            'name'     => 'satu_sehat_log',
            'tags'     => ['satu_sehat_log', 'satu_sehat_log-index'],
            'duration' => 24 * 60
        ]
    ];

    protected function logSatuSehat(mixed $response, array $response_data, ?array $payload = [], ?array $query_params = []):Model{
        return $this->prepareStoreSatuSehatLog(
            $this->requestDTO(
                config('app.contracts.SatuSehatLogData'),[
                    'name' => $this->__entity,
                    'env_type' => config('satu-sehat.environment.env_type'),
                    'url' => SatuSehat::getSatuSehatUrl(),
                    'name' => $this->__entity,
                    'status_code' => $response->getStatusCode(),
                    'headers' => $response->getHeaders(),
                    'params' => $query_params,
                    'payload' => $payload,
                    'response' => $response_data
                ])
        );
    }

    public function prepareStoreSatuSehatLog(SatuSehatLogData $satu_sehat_log_dto): Model{
        $add = [
            'name' => $satu_sehat_log_dto->name,
            'env_type' => $satu_sehat_log_dto->env_type,
            'url' => $satu_sehat_log_dto->url
        ];
        $guard  = ['id' => $satu_sehat_log_dto->id];
        $create = [$guard, $add];
        $satu_sehat_log = $this->usingEntity()->updateOrCreate(...$create);
        $this->fillingProps($satu_sehat_log,$satu_sehat_log_dto->props);
        $satu_sehat_log->save();
        return $this->satu_sehat_log_model = $satu_sehat_log;
    }
}