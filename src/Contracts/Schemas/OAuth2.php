<?php

namespace Hanafalah\SatuSehat\Contracts\Schemas;

use Hanafalah\SatuSehat\Contracts\Data\OAuth2Data;
//use Hanafalah\SatuSehat\Contracts\Data\OAuth2UpdateData;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @see \Hanafalah\SatuSehat\Schemas\OAuth2
 * @method mixed export(string $type)
 * @method self conditionals(mixed $conditionals)
 * @method array updateOAuth2(?OAuth2Data $o_auth2_dto = null)
 * @method Model prepareUpdateOAuth2(OAuth2Data $o_auth2_dto)
 * @method bool deleteOAuth2()
 * @method bool prepareDeleteOAuth2(? array $attributes = null)
 * @method mixed getOAuth2()
 * @method ?Model prepareShowOAuth2(?Model $model = null, ?array $attributes = null)
 * @method array showOAuth2(?Model $model = null)
 * @method Collection prepareViewOAuth2List()
 * @method array viewOAuth2List()
 * @method LengthAwarePaginator prepareViewOAuth2Paginate(PaginateData $paginate_dto)
 * @method array viewOAuth2Paginate(?PaginateData $paginate_dto = null)
 * @method array storeOAuth2(?OAuth2Data $o_auth2_dto = null)
 * @method Collection prepareStoreMultipleOAuth2(array $datas)
 * @method array storeMultipleOAuth2(array $datas)
 */

interface OAuth2 extends SatuSehatLog
{
    public function accessToSatuSehat(? string $token = null): bool;
    public function prepareStoreOauth2(OAuth2Data $o_auth2_dto): Model;
}