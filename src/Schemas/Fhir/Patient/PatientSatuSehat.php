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
        $payload = $patient_satu_sehat_dto->form->payload->toArray();
        $model = $patient_satu_sehat_dto->model;
        try {
            $patient = SatuSehat::store('Patient',$payload);
        } catch (\Exception $e) {
            $patient = SatuSehat::getResponse()->json();
            if (isset($patient['issue']) && $patient['issue'][0]['code'] === 'duplicate') {
                $patient = $this->prepareViewPatientSatuSehatList($this->requestDTO(config('app.contracts.PatientSatuSehatData'),[
                    'params' => [
                        "name" => $payload['name'][0]['text'],
                        "birthdate" => $payload['birthDate'],
                        "gender" => $payload['gender']
                    ]
                ]));
                if (isset($patient)) {
                    if (count($patient) == 1){
                        $patient = $patient->first()['resource'];
                    }else{
                        $patient = $patient->toArray();
                        if (isset($model)){
                            $integration = $model->integration;
                            $satu_sehat = $integration['satu_sehat'];
                            $satu_sehat['patient_lists'] = $patient;
                            $model->setAttribute('integration',$integration);
                            $model->save();
                        }
                    }
                }
            } 
        }
        $this->patient_satu_sehat_model = $this->logSatuSehat($patient_satu_sehat_dto, SatuSehat::getResponse(), $patient ?? null,SatuSehat::getPayload());
        return $this->patient_satu_sehat_model;
    }

    public function prepareViewPatientSatuSehatList(?PatientSatuSehatData $patient_satu_sehat_dto = null): Collection{
        $patient_satu_sehat_dto ??= $this->requestDTO(config('app.contracts.PatientSatuSehatData'));
        $satu_sehat = SatuSehat::get('Patient'.$patient_satu_sehat_dto->params->query);
        $this->patient_satu_sehat_model = $this->logSatuSehat($patient_satu_sehat_dto,SatuSehat::getResponse(),$satu_sehat);
        return collect($satu_sehat['entry']);
    }

    public function patientSatuSehat(mixed $conditionals = null): Builder{
        return $this->satuSehatLog($conditionals);
    }
}