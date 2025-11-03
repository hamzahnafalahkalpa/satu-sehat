<?php

namespace Hanafalah\SatuSehat\Schemas\Fhir\Observation;

use Hanafalah\SatuSehat\Contracts\Data\Fhir\Observation\ObservationSatuSehatData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\SatuSehat\Contracts\Schemas\Fhir\Observation\{
    ObservationSatuSehat as ContractsObservationSatuSehat
};
use Hanafalah\SatuSehat\Facades\SatuSehat;
use Hanafalah\SatuSehat\Schemas\OAuth2;
use Illuminate\Support\Collection;

class ObservationSatuSehat extends OAuth2 implements ContractsObservationSatuSehat
{
    protected string $__entity = 'ObservationSatuSehat';
    public $observation_model;
    //protected mixed $__order_by_created_at = false; //asc, desc, false

    protected array $__cache = [
        'index' => [
            'name'     => 'observation',
            'tags'     => ['observation', 'observation-index'],
            'duration' => 24 * 60
        ]
    ];

    public function prepareStoreObservationSatuSehat(ObservationSatuSehatData $observation_dto): Model{
        $observation = SatuSehat::store('',$observation_dto->form->payload);
        $this->observation_model = $this->logSatuSehat($observation_dto,SatuSehat::getResponse(),$observation,SatuSehat::getPayload());
        return $this->observation_model;
    }

    public function prepareViewObservationSatuSehatList(?ObservationSatuSehatData $observation_dto = null): Collection{
        $observation_dto ??= $this->requestDTO(config('app.contracts.ObservationSatuSehatData'));
        $satu_sehat = SatuSehat::get('Observation'.$observation_dto->params->query);
        $this->observation_model = $this->logSatuSehat($observation_dto,SatuSehat::getResponse(),$satu_sehat);
        return collect($satu_sehat['entry']);
    }

    public function patientSatuSehat(mixed $conditionals = null): Builder{
        return $this->satuSehatLog($conditionals);
    }
}