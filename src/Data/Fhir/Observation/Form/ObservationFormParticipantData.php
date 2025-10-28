<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Observation\Form;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Observation\Form\ObservationFormParticipantData as DataObservationFormParticipantData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\In;

class ObservationFormParticipantData extends Data implements DataObservationFormParticipantData
{
    #[MapInputName('type')]
    #[MapName('type')]
    public ?array $type = [];

    #[MapInputName('individual')]
    #[MapName('individual')]
    public ?array $individual = [];
}