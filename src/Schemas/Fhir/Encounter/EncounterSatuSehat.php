<?php

namespace Hanafalah\SatuSehat\Schemas\Fhir\EncounterSatuSehat;

use Hanafalah\SatuSehat\Contracts\Data\Fhir\Encounter\EncounterSatuSehatData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\SatuSehat\Contracts\Schemas\Fhir\Encounter\{
    EncounterSatuSehat as ContractsEncounterSatuSehat
};
use Hanafalah\SatuSehat\Facades\SatuSehat;
use Hanafalah\SatuSehat\Schemas\OAuth2;
use Illuminate\Support\Collection;

class EncounterSatuSehat extends OAuth2 implements ContractsEncounterSatuSehat
{
    protected string $__entity = 'EncounterSatuSehat';
    public $encounter_model;
    protected array $__patient_examples;
    //protected mixed $__order_by_created_at = false; //asc, desc, false

    protected array $__cache = [
        'index' => [
            'name'     => 'encounter',
            'tags'     => ['encounter', 'encounter-index'],
            'duration' => 24 * 60
        ]
    ];

    public function prepareStoreEncounterSatuSehat(EncounterSatuSehatData $encounter_dto): Model{
        $patient = SatuSehat::store('Encounter',$encounter_dto->form->payload->toArray());
        $this->encounter_model = $this->logSatuSehat(SatuSehat::getResponse(),$patient,SatuSehat::getPayload());
        return $this->encounter_model;
    }

    public function prepareViewEncounterSatuSehatList(?EncounterSatuSehatData $encounter_dto = null): Collection{
        $encounter_dto ??= $this->requestDTO(config('app.contracts.EncounterSatuSehatData'));
        $satu_sehat = SatuSehat::get('Encounter'.$encounter_dto->params->query);
        $this->encounter_model = $this->logSatuSehat(SatuSehat::getResponse(),$satu_sehat);
        return collect($satu_sehat['entry']);
    }

    public function patientSatuSehat(mixed $conditionals = null): Builder{
        return $this->satuSehatLog($conditionals);
    }
}