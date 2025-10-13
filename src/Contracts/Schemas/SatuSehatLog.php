<?php

namespace Hanafalah\SatuSehat\Contracts\Schemas;

use Hanafalah\SatuSehat\Contracts\Data\SatuSehatLogData;
//use Hanafalah\SatuSehat\Contracts\Data\SatuSehatLogUpdateData;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @see \Hanafalah\SatuSehat\Schemas\SatuSehatLog
 * @method mixed export(string $type)
 * @method self conditionals(mixed $conditionals)
 * @method array updateSatuSehatLog(?SatuSehatLogData $satu_sehat_log_dto = null)
 * @method Model prepareUpdateSatuSehatLog(SatuSehatLogData $satu_sehat_log_dto)
 * @method bool deleteSatuSehatLog()
 * @method bool prepareDeleteSatuSehatLog(? array $attributes = null)
 * @method mixed getSatuSehatLog()
 * @method ?Model prepareShowSatuSehatLog(?Model $model = null, ?array $attributes = null)
 * @method array showSatuSehatLog(?Model $model = null)
 * @method Collection prepareViewSatuSehatLogList()
 * @method array viewSatuSehatLogList()
 * @method LengthAwarePaginator prepareViewSatuSehatLogPaginate(PaginateData $paginate_dto)
 * @method array viewSatuSehatLogPaginate(?PaginateData $paginate_dto = null)
 * @method array storeSatuSehatLog(?SatuSehatLogData $satu_sehat_log_dto = null)
 * @method Collection prepareStoreMultipleSatuSehatLog(array $datas)
 * @method array storeMultipleSatuSehatLog(array $datas)
 */

interface SatuSehatLog extends DataManagement
{
    public function prepareStoreSatuSehatLog(SatuSehatLogData $satu_sehat_log_dto): Model;
}