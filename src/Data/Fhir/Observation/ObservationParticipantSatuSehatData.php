<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Observation;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Observation\{
    ObservationParticipantSatuSehatData as DataObservationParticipantSatuSehatData,
};
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class ObservationParticipantSatuSehatData extends Data implements DataObservationParticipantSatuSehatData
{
    #[MapInputName('admitters')]
    #[MapName('admitters')]
    #[DataCollectionOf(ObservationParticipantSource::class)]
    public ?array $admitters = null;

    #[MapInputName('attenders')]
    #[MapName('attenders')]
    #[DataCollectionOf(ObservationParticipantSource::class)]
    public ?array $attenders = null;

    #[MapInputName('callback_contacts')]
    #[MapName('callback_contacts')]
    #[DataCollectionOf(ObservationParticipantSource::class)]
    public ?array $callback_contacts = null;

    #[MapInputName('consultants')]
    #[MapName('consultants')]
    #[DataCollectionOf(ObservationParticipantSource::class)]
    public ?array $consultants = null;

    #[MapInputName('dischargers')]
    #[MapName('dischargers')]
    #[DataCollectionOf(ObservationParticipantSource::class)]
    public ?array $dischargers = null;

    #[MapInputName('escorts')]
    #[MapName('escorts')]
    #[DataCollectionOf(ObservationParticipantSource::class)]
    public ?array $escorts = null;

    #[MapInputName('referrers')]
    #[MapName('referrers')]
    #[DataCollectionOf(ObservationParticipantSource::class)]
    public ?array $referrers = null;

    #[MapInputName('secondary_performers')]
    #[MapName('secondary_performers')]
    #[DataCollectionOf(ObservationParticipantSource::class)]
    public ?array $secondary_performers = null;

    #[MapInputName('primary_performers')]
    #[MapName('primary_performers')]
    #[DataCollectionOf(ObservationParticipantSource::class)]
    public ?array $primary_performers = null;

    #[MapInputName('participations')]
    #[MapName('participations')]
    #[DataCollectionOf(ObservationParticipantSource::class)]
    public ?array $participations = null;

    #[MapInputName('translators')]
    #[MapName('translators')]
    #[DataCollectionOf(ObservationParticipantSource::class)]
    public ?array $translators = null;

    #[MapInputName('emergencies')]
    #[MapName('emergencies')]
    #[DataCollectionOf(ObservationParticipantSource::class)]
    public ?array $emergencies = null;
}