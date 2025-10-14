<?php

namespace Hanafalah\SatuSehat\Contracts\Schemas\Fhir\Patient;

use Hanafalah\SatuSehat\Contracts\Data\Fhir\Patient\PatientSatuSehatData;
//use Hanafalah\SatuSehat\Contracts\Data\PatientSatuSehatUpdateData;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Hanafalah\SatuSehat\Contracts\Schemas\OAuth2;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @see \Hanafalah\SatuSehat\Schemas\PatientSatuSehat
 * @method mixed export(string $type)
 * @method self conditionals(mixed $conditionals)
 * @method array updatePatientSatuSehat(?PatientSatuSehatData $patient_satu_sehat_dto = null)
 * @method Model prepareUpdatePatientSatuSehat(PatientSatuSehatData $patient_satu_sehat_dto)
 * @method bool deletePatientSatuSehat()
 * @method bool prepareDeletePatientSatuSehat(? array $attributes = null)
 * @method mixed getPatientSatuSehat()
 * @method ?Model prepareShowPatientSatuSehat(?Model $model = null, ?array $attributes = null)
 * @method array showPatientSatuSehat(?Model $model = null)
 * @method Collection prepareViewPatientSatuSehatList()
 * @method array viewPatientSatuSehatList()
 * @method LengthAwarePaginator prepareViewPatientSatuSehatPaginate(PaginateData $paginate_dto)
 * @method array viewPatientSatuSehatPaginate(?PaginateData $paginate_dto = null)
 * @method array storePatientSatuSehat(?PatientSatuSehatData $patient_satu_sehat_dto = null)
 * @method Collection prepareStoreMultiplePatientSatuSehat(array $datas)
 * @method array storeMultiplePatientSatuSehat(array $datas)
 */

interface PatientSatuSehat extends OAuth2
{
    public function prepareStorePatientSatuSehat(PatientSatuSehatData $patient_satu_sehat_dto): Model;
}