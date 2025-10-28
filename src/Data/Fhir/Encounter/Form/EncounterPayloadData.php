<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Encounter\Form;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Encounter\Form\EncounterPayloadData as DataEncounterPayloadData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\DateFormat;

class EncounterPayloadData extends Data implements DataEncounterPayloadData
{
    #[MapInputName('resourceType')]
    #[MapName('resourceType')]
    public ?string $resourceType = 'Encounter';

    #[MapInputName('status')]
    #[MapName('status')]
    public ?string $status = 'arrived';

    #[MapInputName('class')]
    #[MapName('class')]
    public ?array $class = null;

    #[MapInputName('subject')]
    #[MapName('subject')]
    public ?array $subject = null;

    #[MapInputName('participant')]
    #[MapName('participant')]
    #[DataCollectionOf(EncounterFormParticipantData::class)]
    public ?array $participant = null;

    #[MapInputName('period')]
    #[MapName('period')]
    public ?array $period = null;

    #[MapInputName('location')]
    #[MapName('location')]
    public ?array $location = null;

    #[MapInputName('statusHistory')]
    #[MapName('statusHistory')]
    public ?array $statusHistory = null;

    #[MapInputName('serviceProvider')]
    #[MapName('serviceProvider')]
    public ?array $serviceProvider = null;

    #[MapInputName('identifier')]
    #[MapName('identifier')]
    #[DataCollectionOf(EncounterFormIdentifierData::class)]
    public ?array $identifier = null;

    public static function before(array &$attributes){
        $attributes['resourceType'] ??= 'Encounter';
        $attributes['status'] ??= 'arrived';
        $attributes['period'] ??= [
            'start' => now()->toIso8601String(),
        ];
    }
}