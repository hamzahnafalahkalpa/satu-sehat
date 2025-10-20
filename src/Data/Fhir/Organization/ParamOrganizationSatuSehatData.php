<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Organization;

use Hanafalah\SatuSehat\Data\ParamSatuSehatData;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Organization\ParamOrganizationSatuSehatData as DataParamOrganizationSatuSehatData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\DateFormat;
use Illuminate\Support\Str;

class ParamOrganizationSatuSehatData extends ParamSatuSehatData implements DataParamOrganizationSatuSehatData
{
    #[MapInputName('id')]
    #[MapName('id')]
    public ?string $id = null;

    #[MapInputName('name')]
    #[MapName('name')]
    public ?string $name = null;

    #[MapInputName('partof')]
    #[MapName('partof')]
    public ?string $partof = null;

    public static function before(array &$attributes){
        $new = static::new();
        $serialize = [
            'id'  => $attributes['id'] ?? null,
            'partof' => $attributes['partof'] ?? null,
            'name' => $attributes['name'] ?? null
        ];        
        $attributes['query'] = $new->serialize($serialize);
    }
}