<?php

namespace Hanafalah\SatuSehat\Contracts\Schemas;

use Hanafalah\SatuSehat\Contracts\Data\SatuSehatTokenData;
//use Hanafalah\SatuSehat\Contracts\Data\SatuSehatTokenUpdateData;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @see \Hanafalah\SatuSehat\Schemas\SatuSehatToken
 * @method mixed export(string $type)
 * @method self conditionals(mixed $conditionals)
 * @method array updateSatuSehatToken(?SatuSehatTokenData $satu_sehat_token_dto = null)
 * @method Model prepareUpdateSatuSehatToken(SatuSehatTokenData $satu_sehat_token_dto)
 * @method bool deleteSatuSehatToken()
 * @method bool prepareDeleteSatuSehatToken(? array $attributes = null)
 * @method mixed getSatuSehatToken()
 * @method ?Model prepareShowSatuSehatToken(?Model $model = null, ?array $attributes = null)
 * @method array showSatuSehatToken(?Model $model = null)
 * @method Collection prepareViewSatuSehatTokenList()
 * @method array viewSatuSehatTokenList()
 * @method LengthAwarePaginator prepareViewSatuSehatTokenPaginate(PaginateData $paginate_dto)
 * @method array viewSatuSehatTokenPaginate(?PaginateData $paginate_dto = null)
 * @method array storeSatuSehatToken(?SatuSehatTokenData $satu_sehat_token_dto = null)
 * @method Collection prepareStoreMultipleSatuSehatToken(array $datas)
 * @method array storeMultipleSatuSehatToken(array $datas)
 */

interface SatuSehatToken extends DataManagement
{
    public function prepareStoreSatuSehatToken(SatuSehatTokenData $satu_sehat_token_dto): Model;
}