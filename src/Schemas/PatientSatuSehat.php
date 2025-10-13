<?php

namespace Hanafalah\SatuSehat\Schemas;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\SatuSehat\Contracts\Schemas\PatientSatuSehat as ContractsPatientSatuSehat;
use Hanafalah\SatuSehat\Contracts\Data\PatientSatuSehatData;
use Illuminate\Support\Collection;

class PatientSatuSehat extends SatuSehatLog implements ContractsPatientSatuSehat
{
    protected string $__entity = 'PatientSatuSehat';
    public $patient_satu_sehat_model;
    //protected mixed $__order_by_created_at = false; //asc, desc, false

    protected array $__cache = [
        'index' => [
            'name'     => 'patient_satu_sehat',
            'tags'     => ['patient_satu_sehat', 'patient_satu_sehat-index'],
            'duration' => 24 * 60
        ]
    ];

    public function prepareStorePatientSatuSehat(PatientSatuSehatData $patient_satu_sehat_dto): Model{
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
        $patient_satu_sehat_dto ??= $this->requestDTO(PatientSatuSehatData::class, request()->all());
        return collect();
    }

    public function patientSatuSehat(mixed $conditionals = null): Builder{
        return $this->satuSehatLog($conditionals);
    }
}