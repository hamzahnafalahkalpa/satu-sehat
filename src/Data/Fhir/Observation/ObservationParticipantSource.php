<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Observation;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Observation\{
    ObservationParticipantSource as DataObservationParticipantSource,
};

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class ObservationParticipantSource extends Data implements DataObservationParticipantSource
{
    #[MapName('participant_code')]
    #[MapInputName('participant_code')]
    public ?string $participant_code = null;

    #[MapName('participant_name')]
    #[MapInputName('participant_name')]
    public ?string $participant_name = null;
}