<?php

namespace Hanafalah\SatuSehat\Contracts\Schemas\Fhir\MasterSarana;

use Hanafalah\SatuSehat\Contracts\Data\Fhir\MasterSarana\MasterSaranaSatuSehatData;
//use Hanafalah\SatuSehat\Contracts\Data\MasterSaranaSatuSehatUpdateData;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Hanafalah\SatuSehat\Contracts\Schemas\OAuth2;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @see \Hanafalah\SatuSehat\Schemas\MasterSaranaSatuSehat
 * @method mixed export(string $type)
 * @method self conditionals(mixed $conditionals)
 * @method array updateMasterSaranaSatuSehat(?MasterSaranaSatuSehatData $master_sarana_satu_sehat_dto = null)
 * @method Model prepareUpdateMasterSaranaSatuSehat(MasterSaranaSatuSehatData $master_sarana_satu_sehat_dto)
 * @method bool deleteMasterSaranaSatuSehat()
 * @method bool prepareDeleteMasterSaranaSatuSehat(? array $attributes = null)
 * @method mixed getMasterSaranaSatuSehat()
 * @method ?Model prepareShowMasterSaranaSatuSehat(?Model $model = null, ?array $attributes = null)
 * @method array showMasterSaranaSatuSehat(?Model $model = null)
 * @method Collection prepareViewMasterSaranaSatuSehatList()
 * @method array viewMasterSaranaSatuSehatList()
 * @method LengthAwarePaginator prepareViewMasterSaranaSatuSehatPaginate(PaginateData $paginate_dto)
 * @method array viewMasterSaranaSatuSehatPaginate(?PaginateData $paginate_dto = null)
 * @method array storeMasterSaranaSatuSehat(?MasterSaranaSatuSehatData $master_sarana_satu_sehat_dto = null)
 * @method Collection prepareStoreMultipleMasterSaranaSatuSehat(array $datas)
 * @method array storeMultipleMasterSaranaSatuSehat(array $datas)
 */

interface MasterSaranaSatuSehat extends OAuth2
{
    public function prepareStoreMasterSaranaSatuSehat(MasterSaranaSatuSehatData $master_sarana_satu_sehat_dto): Model;
}