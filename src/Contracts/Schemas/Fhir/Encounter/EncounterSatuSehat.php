<?php

namespace Hanafalah\SatuSehat\Contracts\Schemas\Fhir\Encounter;

use Hanafalah\SatuSehat\Contracts\Data\Fhir\Encounter\EncounterSatuSehatData;
//use Hanafalah\SatuSehat\Contracts\Data\EncounterSatuSehatUpdateData;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Hanafalah\SatuSehat\Contracts\Schemas\OAuth2;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @see \Hanafalah\SatuSehat\Schemas\EncounterSatuSehat
 * @method mixed export(string $type)
 * @method self conditionals(mixed $conditionals)
 * @method array updateEncounterSatuSehat(?EncounterSatuSehatData $encounter_satu_sehat_dto = null)
 * @method Model prepareUpdateEncounterSatuSehat(EncounterSatuSehatData $encounter_satu_sehat_dto)
 * @method bool deleteEncounterSatuSehat()
 * @method bool prepareDeleteEncounterSatuSehat(? array $attributes = null)
 * @method mixed getEncounterSatuSehat()
 * @method ?Model prepareShowEncounterSatuSehat(?Model $model = null, ?array $attributes = null)
 * @method array showEncounterSatuSehat(?Model $model = null)
 * @method Collection prepareViewEncounterSatuSehatList()
 * @method array viewEncounterSatuSehatList()
 * @method LengthAwarePaginator prepareViewEncounterSatuSehatPaginate(PaginateData $paginate_dto)
 * @method array viewEncounterSatuSehatPaginate(?PaginateData $paginate_dto = null)
 * @method array storeEncounterSatuSehat(?EncounterSatuSehatData $encounter_satu_sehat_dto = null)
 * @method Collection prepareStoreMultipleEncounterSatuSehat(array $datas)
 * @method array storeMultipleEncounterSatuSehat(array $datas)
 */

interface EncounterSatuSehat extends OAuth2
{
    public function prepareStoreEncounterSatuSehat(EncounterSatuSehatData $encounter_satu_sehat_dto): Model;
}