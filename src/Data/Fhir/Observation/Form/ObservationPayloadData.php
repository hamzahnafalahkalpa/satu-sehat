<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Observation\Form;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Observation\Form\ObservationPayloadData as DataObservationPayloadData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\DateFormat;

class ObservationPayloadData extends Data implements DataObservationPayloadData
{
    #[MapInputName('resourceType')]
    #[MapName('resourceType')]
    public ?string $resourceType = 'Observation';
    
    #[MapInputName('status')]
    #[MapName('status')]
    public ?string $status = 'final';

    #[MapInputName('category')]
    #[MapName('category')]
    public ?array $category = null;

    #[MapInputName('code')]
    #[MapName('code')]
    public ?array $code = null;

    #[MapInputName('subject')]
    #[MapName('subject')]
    public ?array $subject = null;

    #[MapInputName('performer')]
    #[MapName('performer')]
    public ?array $performer = null;

    #[MapInputName('encounter')]
    #[MapName('encounter')]
    public ?array $encounter = null;

    #[MapInputName('effectiveDateTime')]
    #[MapName('effectiveDateTime')]
    #[DateFormat('Y-m-d')]
    public ?string $effectiveDateTime = null;

    #[MapInputName('issued')]
    #[MapName('issued')]
    #[DateFormat('Y-m-d\TH:i:sP')]
    public ?string $issued = null;

    #[MapInputName('valueQuantity')]
    #[MapName('valueQuantity')]
    public ?array $valueQuantity = null;
    public static function before(array &$attributes){
        $attributes['resourceType'] ??= 'Observation';
    }
}