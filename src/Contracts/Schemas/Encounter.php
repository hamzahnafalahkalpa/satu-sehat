<?php

namespace Hanafalah\SatuSehat\Contracts\Schemas;

use Hanafalah\SatuSehat\Contracts\Data\EncounterData;
//use Hanafalah\SatuSehat\Contracts\Data\EncounterUpdateData;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @see \Hanafalah\SatuSehat\Schemas\Encounter
 * @method mixed export(string $type)
 * @method self conditionals(mixed $conditionals)
 * @method array updateEncounter(?EncounterData $encounter_dto = null)
 * @method Model prepareUpdateEncounter(EncounterData $encounter_dto)
 * @method bool deleteEncounter()
 * @method bool prepareDeleteEncounter(? array $attributes = null)
 * @method mixed getEncounter()
 * @method ?Model prepareShowEncounter(?Model $model = null, ?array $attributes = null)
 * @method array showEncounter(?Model $model = null)
 * @method Collection prepareViewEncounterList()
 * @method array viewEncounterList()
 * @method LengthAwarePaginator prepareViewEncounterPaginate(PaginateData $paginate_dto)
 * @method array viewEncounterPaginate(?PaginateData $paginate_dto = null)
 * @method array storeEncounter(?EncounterData $encounter_dto = null)
 * @method Collection prepareStoreMultipleEncounter(array $datas)
 * @method array storeMultipleEncounter(array $datas)
 */

interface Encounter extends DataManagement
{
    public function prepareStoreEncounter(EncounterData $encounter_dto): Model;
}