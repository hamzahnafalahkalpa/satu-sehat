<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Encounter;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Encounter\{
    EncounterParticipantSatuSehatData as DataEncounterParticipantSatuSehatData,
};
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class EncounterParticipantSatuSehatData extends Data implements DataEncounterParticipantSatuSehatData
{
    #[MapInputName('admitters')]
    #[MapName('admitters')]
    #[DataCollectionOf(EncounterParticipantSource::class)]
    public ?array $admitters = null;

    #[MapInputName('attenders')]
    #[MapName('attenders')]
    #[DataCollectionOf(EncounterParticipantSource::class)]
    public ?array $attenders = null;

    #[MapInputName('callback_contacts')]
    #[MapName('callback_contacts')]
    #[DataCollectionOf(EncounterParticipantSource::class)]
    public ?array $callback_contacts = null;

    #[MapInputName('consultants')]
    #[MapName('consultants')]
    #[DataCollectionOf(EncounterParticipantSource::class)]
    public ?array $consultants = null;

    #[MapInputName('dischargers')]
    #[MapName('dischargers')]
    #[DataCollectionOf(EncounterParticipantSource::class)]
    public ?array $dischargers = null;

    #[MapInputName('escorts')]
    #[MapName('escorts')]
    #[DataCollectionOf(EncounterParticipantSource::class)]
    public ?array $escorts = null;

    #[MapInputName('referrers')]
    #[MapName('referrers')]
    #[DataCollectionOf(EncounterParticipantSource::class)]
    public ?array $referrers = null;

    #[MapInputName('secondary_performers')]
    #[MapName('secondary_performers')]
    #[DataCollectionOf(EncounterParticipantSource::class)]
    public ?array $secondary_performers = null;

    #[MapInputName('primary_performers')]
    #[MapName('primary_performers')]
    #[DataCollectionOf(EncounterParticipantSource::class)]
    public ?array $primary_performers = null;

    #[MapInputName('participations')]
    #[MapName('participations')]
    #[DataCollectionOf(EncounterParticipantSource::class)]
    public ?array $participations = null;

    #[MapInputName('translators')]
    #[MapName('translators')]
    #[DataCollectionOf(EncounterParticipantSource::class)]
    public ?array $translators = null;

    #[MapInputName('emergencies')]
    #[MapName('emergencies')]
    #[DataCollectionOf(EncounterParticipantSource::class)]
    public ?array $emergencies = null;
}