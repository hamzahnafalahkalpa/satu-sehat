<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Encounter;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Encounter\{
    EncounterParticipantSource as DataEncounterParticipantSource,
};

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class EncounterParticipantSource extends Data implements DataEncounterParticipantSource
{
    #[MapName('participant_code')]
    #[MapInputName('participant_code')]
    public ?array $participant_code = null;

    #[MapName('participant_name')]
    #[MapInputName('participant_name')]
    public ?array $participant_name = null;
}