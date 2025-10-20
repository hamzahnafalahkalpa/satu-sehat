<?php

namespace Hanafalah\SatuSehat\Contracts\Schemas\Fhir\Practitioner;

use Hanafalah\SatuSehat\Contracts\Data\Fhir\Practitioner\PractitionerSatuSehatData;
//use Hanafalah\SatuSehat\Contracts\Data\PractitionerSatuSehatUpdateData;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Hanafalah\SatuSehat\Contracts\Schemas\OAuth2;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @see \Hanafalah\SatuSehat\Schemas\PractitionerSatuSehat
 * @method mixed export(string $type)
 * @method self conditionals(mixed $conditionals)
 * @method array updatePractitionerSatuSehat(?PractitionerSatuSehatData $practitioner_satu_sehat_dto = null)
 * @method Model prepareUpdatePractitionerSatuSehat(PractitionerSatuSehatData $practitioner_satu_sehat_dto)
 * @method bool deletePractitionerSatuSehat()
 * @method bool prepareDeletePractitionerSatuSehat(? array $attributes = null)
 * @method mixed getPractitionerSatuSehat()
 * @method ?Model prepareShowPractitionerSatuSehat(?Model $model = null, ?array $attributes = null)
 * @method array showPractitionerSatuSehat(?Model $model = null)
 * @method Collection prepareViewPractitionerSatuSehatList()
 * @method array viewPractitionerSatuSehatList()
 * @method LengthAwarePaginator prepareViewPractitionerSatuSehatPaginate(PaginateData $paginate_dto)
 * @method array viewPractitionerSatuSehatPaginate(?PaginateData $paginate_dto = null)
 * @method array storePractitionerSatuSehat(?PractitionerSatuSehatData $practitioner_satu_sehat_dto = null)
 * @method Collection prepareStoreMultiplePractitionerSatuSehat(array $datas)
 * @method array storeMultiplePractitionerSatuSehat(array $datas)
 */

interface PractitionerSatuSehat extends OAuth2
{
    public function prepareStorePractitionerSatuSehat(PractitionerSatuSehatData $practitioner_satu_sehat_dto): Model;
}