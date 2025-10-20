<?php

namespace Hanafalah\SatuSehat\Contracts\Schemas\Fhir\Organization;

use Hanafalah\SatuSehat\Contracts\Data\Fhir\Organization\OrganizationSatuSehatData;
//use Hanafalah\SatuSehat\Contracts\Data\OrganizationSatuSehatUpdateData;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Hanafalah\SatuSehat\Contracts\Schemas\OAuth2;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @see \Hanafalah\SatuSehat\Schemas\OrganizationSatuSehat
 * @method mixed export(string $type)
 * @method self conditionals(mixed $conditionals)
 * @method array updateOrganizationSatuSehat(?OrganizationSatuSehatData $organization_satu_sehat_dto = null)
 * @method Model prepareUpdateOrganizationSatuSehat(OrganizationSatuSehatData $organization_satu_sehat_dto)
 * @method bool deleteOrganizationSatuSehat()
 * @method bool prepareDeleteOrganizationSatuSehat(? array $attributes = null)
 * @method mixed getOrganizationSatuSehat()
 * @method ?Model prepareShowOrganizationSatuSehat(?Model $model = null, ?array $attributes = null)
 * @method array showOrganizationSatuSehat(?Model $model = null)
 * @method Collection prepareViewOrganizationSatuSehatList()
 * @method array viewOrganizationSatuSehatList()
 * @method LengthAwarePaginator prepareViewOrganizationSatuSehatPaginate(PaginateData $paginate_dto)
 * @method array viewOrganizationSatuSehatPaginate(?PaginateData $paginate_dto = null)
 * @method array storeOrganizationSatuSehat(?OrganizationSatuSehatData $organization_satu_sehat_dto = null)
 * @method Collection prepareStoreMultipleOrganizationSatuSehat(array $datas)
 * @method array storeMultipleOrganizationSatuSehat(array $datas)
 */

interface OrganizationSatuSehat extends OAuth2
{
    public function prepareStoreOrganizationSatuSehat(OrganizationSatuSehatData $organization_satu_sehat_dto): Model;
}