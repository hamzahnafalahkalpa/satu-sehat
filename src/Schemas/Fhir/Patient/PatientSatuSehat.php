<?php

namespace Hanafalah\SatuSehat\Schemas\Fhir\Patient;

use Hanafalah\SatuSehat\Contracts\Data\Fhir\Patient\PatientSatuSehatData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\SatuSehat\Contracts\Schemas\Fhir\Patient\{
    PatientSatuSehat as ContractsPatientSatuSehat
};
use Hanafalah\SatuSehat\Facades\SatuSehat;
use Hanafalah\SatuSehat\Schemas\OAuth2;
use Illuminate\Support\Collection;

class PatientSatuSehat extends OAuth2 implements ContractsPatientSatuSehat
{
    protected string $__entity = 'PatientSatuSehat';
    public $patient_satu_sehat_model;
    protected array $__patient_examples;
    //protected mixed $__order_by_created_at = false; //asc, desc, false

    protected array $__cache = [
        'index' => [
            'name'     => 'patient_satu_sehat',
            'tags'     => ['patient_satu_sehat', 'patient_satu_sehat-index'],
            'duration' => 24 * 60
        ]
    ];

    public function __construct(){
        parent::__construct();
        $this->setPatientExample();
    }

    private function setPatientExample(): self{
        $this->__patient_examples = include __DIR__.'/data/patient-example-data.php';
        return $this;
    }

    public function prepareStorePatientSatuSehat(PatientSatuSehatData $patient_satu_sehat_dto): Model{
        dd($patient_satu_sehat_dto);
        $add = [
            'name' => $patient_satu_sehat_dto->name
        ];
        $guard  = ['id' => $patient_satu_sehat_dto->id];
        $create = [$guard, $add];

        $patient_satu_sehat = $this->usingEntity()->updateOrCreate(...$create);
        $this->fillingProps($patient_satu_sehat,$patient_satu_sehat_dto->props);
        $patient_satu_sehat->save();
        return $this->patient_satu_sehat_model = $patient_satu_sehat;
    }

    public function prepareViewPatientSatuSehatList(?PatientSatuSehatData $patient_satu_sehat_dto = null): Collection{
        $patient_satu_sehat_dto ??= $this->requestDTO(config('app.contracts.PatientSatuSehatData'));
        $satu_sehat = SatuSehat::get('Patient'.$patient_satu_sehat_dto->params->query);
        $this->o_auth2_model = $this->logSatuSehat(SatuSehat::getResponse(),$satu_sehat);
        return collect($satu_sehat['entry']);
    }

    public function patientSatuSehat(mixed $conditionals = null): Builder{
        return $this->satuSehatLog($conditionals);
    }
}