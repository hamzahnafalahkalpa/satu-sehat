<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Encounter;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Encounter\{
    EncounterStatusHistoryData as DataEncounterStatusHistoryData,
};
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\DateFormat;

class EncounterStatusHistoryData extends Data implements DataEncounterStatusHistoryData
{
    #[MapInputName('planned')]
    #[MapName('planned')]
    #[DateFormat('Y-m-d H:i:s')]
    public ?string $planned = null;

    #[MapInputName('arrived')]
    #[MapName('arrived')]
    #[DateFormat('Y-m-d H:i:s')]
    public ?string $arrived = null;

    #[MapInputName('triaged')]
    #[MapName('triaged')]
    #[DateFormat('Y-m-d H:i:s')]
    public ?string $triaged = null;

    #[MapInputName('in-progress')]
    #[MapName('in-progress')]
    #[DateFormat('Y-m-d H:i:s')]
    public ?string $in_progress = null;

    #[MapInputName('on_leave')]
    #[MapName('on_leave')]
    #[DateFormat('Y-m-d H:i:s')]
    public ?string $on_leave = null;

    #[MapInputName('finished')]
    #[MapName('finished')]
    #[DateFormat('Y-m-d H:i:s')]
    public ?string $finished = null;

    #[MapInputName('cancelled')]
    #[MapName('cancelled')]
    #[DateFormat('Y-m-d H:i:s')]
    public ?string $cancelled = null;
}