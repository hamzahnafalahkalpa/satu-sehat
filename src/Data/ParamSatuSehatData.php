<?php

namespace Hanafalah\SatuSehat\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\SatuSehat\Contracts\Data\ParamSatuSehatData as DataParamSatuSehatData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class ParamSatuSehatData extends Data implements DataParamSatuSehatData
{
    #[MapInputName('query')]
    #[MapName('query')]
    public ?string $query = null;

    protected function serialize(array $params){
        // Hapus nilai null agar tidak muncul di query string
        $filtered = array_filter($params, fn($v) => !is_null($v));

        // Gunakan http_build_query untuk hasil seperti key=value&key2=value2
        $query = http_build_query($filtered, '', '&', PHP_QUERY_RFC3986);
        if (trim($query) !== '') return '?'.$query;
        return $query;
    }
}