<?php

namespace Hanafalah\SatuSehat\Schemas\Fhir\MasterSarana;

use Hanafalah\SatuSehat\Contracts\Data\Fhir\MasterSarana\MasterSaranaSatuSehatData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\SatuSehat\Contracts\Schemas\Fhir\MasterSarana\{
    MasterSaranaSatuSehat as ContractsMasterSaranaSatuSehat
};
use Hanafalah\SatuSehat\Facades\SatuSehat;
use Hanafalah\SatuSehat\Schemas\OAuth2;
use Illuminate\Support\Collection;

class MasterSaranaSatuSehat extends OAuth2 implements ContractsMasterSaranaSatuSehat
{
    protected string $__entity = 'MasterSaranaSatuSehat';
    public $master_sarana_model;
    protected array $__patient_examples;
    //protected mixed $__order_by_created_at = false; //asc, desc, false

    protected array $__cache = [
        'index' => [
            'name'     => 'master_sarana',
            'tags'     => ['master_sarana', 'master_sarana-index'],
            'duration' => 24 * 60
        ]
    ];

    public function prepareStoreMasterSaranaSatuSehat(MasterSaranaSatuSehatData $master_sarana_dto): Model{
        $patient = SatuSehat::store('MasterSarana',$master_sarana_dto->form->payload->toArray());
        $this->master_sarana_model = $this->logSatuSehat($master_sarana_dto,SatuSehat::getResponse(),$patient,SatuSehat::getPayload());
        return $this->master_sarana_model;
    }

    public function prepareViewMasterSaranaSatuSehatList(?MasterSaranaSatuSehatData $master_sarana_dto = null): Collection{
        $master_sarana_dto ??= $this->requestDTO(config('app.contracts.MasterSaranaSatuSehatData'));
        $satu_sehat = SatuSehat::getSatuSehat('masterdata/v1/mastersaranaindex/mastersarana'.$master_sarana_dto->params->query);
        $this->master_sarana_model = $this->logSatuSehat($master_sarana_dto,SatuSehat::getResponse(),$satu_sehat);
        return collect($satu_sehat['data']);
    }

    public function patientSatuSehat(mixed $conditionals = null): Builder{
        return $this->satuSehatLog($conditionals);
    }
}