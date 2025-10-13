<?php

namespace Hanafalah\SatuSehat\Data;

use Hanafalah\SatuSehat\Contracts\Data\PatientSatuSehatData as DataPatientSatuSehatData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class PatientSatuSehatData extends SatuSehatLogData implements DataPatientSatuSehatData
{
    public static function before(array &$attributes){
        parent::before($attributes);
    }
}