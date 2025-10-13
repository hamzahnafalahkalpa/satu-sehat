<?php

namespace Hanafalah\SatuSehat\Contracts\Schemas;

use Hanafalah\SatuSehat\Contracts\Data\PatientSatuSehatData;
//use Hanafalah\SatuSehat\Contracts\Data\PatientSatuSehatUpdateData;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
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

interface PatientSatuSehat extends SatuSehatLog
{
    public function prepareStorePatientSatuSehat(PatientSatuSehatData $patient_satu_sehat_dto): Model;
}