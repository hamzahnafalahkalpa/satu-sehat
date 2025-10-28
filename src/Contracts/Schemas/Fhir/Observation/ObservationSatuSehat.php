<?php

namespace Hanafalah\SatuSehat\Contracts\Schemas\Fhir\Observation;

use Hanafalah\SatuSehat\Contracts\Data\Fhir\Observation\ObservationSatuSehatData;
//use Hanafalah\SatuSehat\Contracts\Data\ObservationSatuSehatUpdateData;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Hanafalah\SatuSehat\Contracts\Schemas\OAuth2;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @see \Hanafalah\SatuSehat\Schemas\ObservationSatuSehat
 * @method mixed export(string $type)
 * @method self conditionals(mixed $conditionals)
 * @method array updateObservationSatuSehat(?ObservationSatuSehatData $observation_satu_sehat_dto = null)
 * @method Model prepareUpdateObservationSatuSehat(ObservationSatuSehatData $observation_satu_sehat_dto)
 * @method bool deleteObservationSatuSehat()
 * @method bool prepareDeleteObservationSatuSehat(? array $attributes = null)
 * @method mixed getObservationSatuSehat()
 * @method ?Model prepareShowObservationSatuSehat(?Model $model = null, ?array $attributes = null)
 * @method array showObservationSatuSehat(?Model $model = null)
 * @method Collection prepareViewObservationSatuSehatList()
 * @method array viewObservationSatuSehatList()
 * @method LengthAwarePaginator prepareViewObservationSatuSehatPaginate(PaginateData $paginate_dto)
 * @method array viewObservationSatuSehatPaginate(?PaginateData $paginate_dto = null)
 * @method array storeObservationSatuSehat(?ObservationSatuSehatData $observation_satu_sehat_dto = null)
 * @method Collection prepareStoreMultipleObservationSatuSehat(array $datas)
 * @method array storeMultipleObservationSatuSehat(array $datas)
 */

interface ObservationSatuSehat extends OAuth2
{
    public function prepareStoreObservationSatuSehat(ObservationSatuSehatData $observation_satu_sehat_dto): Model;
}