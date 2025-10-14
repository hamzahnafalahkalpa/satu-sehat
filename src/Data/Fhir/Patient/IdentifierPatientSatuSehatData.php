<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Patient;

use Hanafalah\SatuSehat\Contracts\Data\Fhir\Patient\IdentifierPatientSatuSehatData as DataIdentifierPatientSatuSehatData;
use Hanafalah\SatuSehat\Data\SatuSehatLogData;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class IdentifierPatientSatuSehatData extends SatuSehatLogData implements DataIdentifierPatientSatuSehatData
{
    #[MapInputName('use')]
    #[MapName('use')]
    public ?string $use = null;

    public function rules(): array{
        return [
            'use' => [
                'required', Rule::in([
                    'usual',
                    'official',
                    'temp',
                    'secondary'
                ])
            ],
        ];
    }
}