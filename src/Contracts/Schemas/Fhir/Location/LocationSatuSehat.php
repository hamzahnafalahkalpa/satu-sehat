<?php

namespace Hanafalah\SatuSehat\Contracts\Schemas\Fhir\Location;

use Hanafalah\SatuSehat\Contracts\Data\Fhir\Location\LocationSatuSehatData;
//use Hanafalah\SatuSehat\Contracts\Data\LocationSatuSehatUpdateData;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Hanafalah\SatuSehat\Contracts\Schemas\OAuth2;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @see \Hanafalah\SatuSehat\Schemas\LocationSatuSehat
 * @method mixed export(string $type)
 * @method self conditionals(mixed $conditionals)
 * @method array updateLocationSatuSehat(?LocationSatuSehatData $location_satu_sehat_dto = null)
 * @method Model prepareUpdateLocationSatuSehat(LocationSatuSehatData $location_satu_sehat_dto)
 * @method bool deleteLocationSatuSehat()
 * @method bool prepareDeleteLocationSatuSehat(? array $attributes = null)
 * @method mixed getLocationSatuSehat()
 * @method ?Model prepareShowLocationSatuSehat(?Model $model = null, ?array $attributes = null)
 * @method array showLocationSatuSehat(?Model $model = null)
 * @method Collection prepareViewLocationSatuSehatList()
 * @method array viewLocationSatuSehatList()
 * @method LengthAwarePaginator prepareViewLocationSatuSehatPaginate(PaginateData $paginate_dto)
 * @method array viewLocationSatuSehatPaginate(?PaginateData $paginate_dto = null)
 * @method array storeLocationSatuSehat(?LocationSatuSehatData $location_satu_sehat_dto = null)
 * @method Collection prepareStoreMultipleLocationSatuSehat(array $datas)
 * @method array storeMultipleLocationSatuSehat(array $datas)
 */

interface LocationSatuSehat extends OAuth2
{
    public function prepareStoreLocationSatuSehat(LocationSatuSehatData $location_satu_sehat_dto): Model;
}