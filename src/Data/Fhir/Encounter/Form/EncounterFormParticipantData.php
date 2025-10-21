<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Encounter\Form;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Encounter\Form\EncounterFormParticipantData as DataEncounterFormParticipantData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\In;

class EncounterFormParticipantData extends Data implements DataEncounterFormParticipantData
{
    #[MapInputName('type')]
    #[MapName('type')]
    public ?array $type = [];

    #[MapInputName('individual')]
    #[MapName('individual')]
    public ?array $individual = [];
}