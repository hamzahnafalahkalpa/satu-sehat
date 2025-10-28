<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Observation;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Observation\FormObservationSatuSehatData as DataFormObservationSatuSehatData;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Observation\Form\ObservationPayloadData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\DateFormat;
use Illuminate\Support\Str;
use Spatie\LaravelData\Attributes\Validation\In;
use Illuminate\Support\Carbon;

class FormObservationSatuSehatData extends Data implements DataFormObservationSatuSehatData
{
    #[MapInputName('encounter_display')]
    #[MapName('encounter_display')]
    public string $encounter_display;

    #[MapInputName('encounter_code')]
    #[MapName('encounter_code')]
    public string $encounter_code;

    #[MapInputName('organization_code')]
    #[MapName('organization_code')]
    public string $organization_code;

    #[MapInputName('patient_code')]
    #[MapName('patient_code')]
    public string $patient_code;

    #[MapInputName('status')]
    #[MapName('status')]
    #[In(['registered','preliminary','final','amended','corrected','cancelled','entered-in-error','unknown'])]
    public ?string $status = 'final';

    #[MapInputName('practitioner_codes')]
    #[MapName('practitioner_codes')]
    public array $practitioner_codes = [];

    #[MapInputName('issued_at')]
    #[MapName('issued_at')]
    #[DateFormat('Y-m-d H:i:s')]
    public string $issued_at;

    #[MapInputName('category')]
    #[MapName('category')]
    public ObservationCategorySatuSehatData $category;

    #[MapInputName('payload')]
    #[MapName('payload')]
    public ObservationPayloadData|array|null $payload = null;

    public static function before(array &$attributes){
        $new = static::new();       
        $attributes['status'] ??= 'arrived';
        
        $payload = &$attributes['payload'];
        $issuedDt = Carbon::parse($attributes['issued_at'], 'Asia/Jakarta');
        $payload['issued'] = $issuedDt->toIso8601String();
        $payload['effectiveDateTime'] ??= $issuedDt->toIso8601String();

        $new->setStatus($attributes)
            ->setSubject($attributes)
            ->setPerformer($attributes)
            ->setEncounter($attributes);
    }

    public static function after(self $data): self{
        $new = static::new();       
        $payload = [
            "fullUrl" => "urn:uuid:".Str::uuid()->toString(),
            "request" => [
                "method" => "POST",
                "url" => "Observation"
            ],
            "resource" => $data->payload
        ];
        $new_payload = [
            "resourceType" => "Bundle",
            "type" => "transaction",
            "entry" => []
        ];
        $forms = $data->category->forms;
        foreach ($forms as $form) {
            $category = $data->category->{$form};
            $value = $category->value;
            if (empty($value)) {
                continue;
            }

            $payload['resource'] = $payload['resource']->toArray();
            $temp_payload = $payload;
            $temp_payload['resource'] = array_merge($temp_payload['resource'],...$value);
            $new_payload['entry'][] = $temp_payload;
        }

        $data->payload = $new_payload;
        return $data;
    }

    private function setStatus(array &$attributes): self{
        $payload = &$attributes['payload'];
        $payload['status'] ??= 'final';
        return $this;
    }

    private function setSubject(array &$attributes): self{
        $payload = &$attributes['payload'];
        if (!isset($payload['subject']) && !empty($attributes['patient_code'])) {
            $payload['subject'] = ['reference' => 'Patient/'.$attributes['patient_code']];
        }
        return $this;
    }

    private function setEncounter(array &$attributes): self{
        $payload = &$attributes['payload'];
        if (!isset($payload['encounter']) && !empty($attributes['encounter_code'])) {
            $payload['encounter'] = [
                'reference' => 'Encounter/'.$attributes['encounter_code'],
                'display' => $attributes['encounter_display']
            ];
        }
        return $this;
    }

    private function setPerformer(array &$attributes): self{
        $payload = &$attributes['payload'];
        if (!isset($payload['performer'])) {
            $practitioners = $attributes['practitioner_codes'] ?? [];
            if (!empty($practitioners) && is_array($practitioners)) {
                $payload['performer'] = array_map(fn($c) => ['reference' => 'Practitioner/'.$c], $practitioners);
            }
        }
        return $this;
    }

    private function normalize(array &$attributes): self{
        $payload = &$attributes['payload'];

        //SET CATEGORY
        $categories = ['coding' => []];
        $code = ['coding' => []];
        foreach ($attributes['category'] as $exam => $category) {
            $system = 'http://terminology.hl7.org/CodeSystem/observation-category';
            $code = Str::kebab($exam);
            $display = Str::title(str_replace('-', ' ', $code));
            $categories['coding'][] = [
                'system'  => $system,
                'code'    => $code,
                'display' => $display,
            ];
        }
        $payload['category'] = $categories;
        return $this;
    }
}