<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Observation;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Observation\{
    ObservationCategorySatuSehatData as DataObservationCategorySatuSehatData,
};
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class ObservationCategorySatuSehatData extends Data implements DataObservationCategorySatuSehatData
{
    #[MapInputName('vital_signs')]
    #[MapName('vital_signs')]
    public ?ObservationVitalSignSatuSehatData $vital_signs = null;

    #[MapInputName('forms')]
    #[MapName('forms')]
    public ?array $forms = [];

    public static function before(array &$attributes){
        $attributes['forms'] ??= [];
        if (isset($attributes['vital_signs'])) $attributes['forms'][] ='vital_signs';
    }
}