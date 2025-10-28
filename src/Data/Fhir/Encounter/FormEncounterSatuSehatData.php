<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Encounter;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\MultipleAddressSatuSehatData;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Encounter\FormEncounterSatuSehatData as DataFormEncounterSatuSehatData;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Encounter\Form\EncounterPayloadData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\DateFormat;
use Spatie\LaravelData\Attributes\Validation\BooleanType;
use Illuminate\Support\Str;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\Validation\In;
use Illuminate\Support\Carbon;

class FormEncounterSatuSehatData extends Data implements DataFormEncounterSatuSehatData
{
    #[MapInputName('status')]
    #[MapName('status')]
    #[In(['arrived', 'planned', 'triaged', 'in-progress', 'onleave', 'finished', 'cancelled'])]
    public ?string $status = 'arrived';

    #[MapInputName('class_code')]
    #[MapName('class_code')]
    #[In(['AMB','EMER','FLD','HH','IMP','ACUTE','NONAC','OBSENC','PRENC','SS','VR','referred-procedure'])]
    public string $class_code;

    #[MapInputName('organization_code')]
    #[MapName('organization_code')]
    public string $organization_code;

    #[MapInputName('visit_code')]
    #[MapName('visit_code')]
    public string $visit_code;

    #[MapInputName('patient_code')]
    #[MapName('patient_code')]
    public string $patient_code;

    #[MapInputName('patient_name')]
    #[MapName('patient_name')]
    public string $patient_name;

    #[MapInputName('period')]
    #[MapName('period')]
    #[DateFormat('Y-m-d H:i:s')]
    public ?string $period = null;

    #[MapInputName('status_history')]
    #[MapName('status_history')]
    public ?EncounterStatusHistoryData $status_history = null;

    #[MapInputName('participant')]
    #[MapName('participant')]
    public ?EncounterParticipantSatuSehatData $participant;

    #[MapInputName('payload')]
    #[MapName('payload')]
    public ?EncounterPayloadData $payload = null;

    #[MapInputName('location_code')]
    #[MapName('location_code')]
    public string $location_code;

    #[MapInputName('location_name')]
    #[MapName('location_name')]
    public string $location_name;

    public static function before(array &$attributes){
        $new = static::new();       
        $attributes['status'] ??= 'arrived';
        
        $payload = &$attributes['payload'];
        $payload['serviceProvider'] = [
            'reference' => 'Organization/'.$attributes['organization_code']
        ];
        $new->setIdentifier($attributes)
            ->setClass($attributes)
            ->setSubject($attributes)
            ->setParticipant($attributes)
            ->setLocation($attributes)
            ->setPeriod($attributes)
            ->setStatusHistory($attributes)
            ->setServiceProvider($attributes);
    }

    private function setServiceProvider(array &$attributes): self{
        $service_provider = &$attributes['payload']['serviceProvider'];
        $service_provider['reference'] = 'Organization/'.$attributes['organization_code'];
        return $this;
    }

    private function setIdentifier(array &$attributes): self{
        $identifier = &$attributes['payload']['identifier'];
        if (isset($attributes['organization_code']) && isset($attributes['visit_code'])){
            $identifier[] = [
                'system' => 'http://sys-ids.kemkes.go.id/encounter/'.$attributes['organization_code'],
                'value' => $attributes['visit_code']
            ];
        }else{
            throw new \Exception('org_id or visit_code not found');
        }

        return $this;
    }

    private function setClass(array &$attributes): self{
        $class = &$attributes['payload']['class'];
        $class['system'] ??= 'http://terminology.hl7.org/CodeSystem/v3-ActCode';
        switch ($attributes['class_code']) {
            case 'AMB'    : $class['code'] = $attributes['class_code'];$class['display'] = 'ambulatory';break;
            case 'EMER'   : $class['code'] = $attributes['class_code'];$class['display'] = 'emergency';break;
            case 'FLD'    : $class['code'] = $attributes['class_code'];$class['display'] = 'field';break;
            case 'HH'     : $class['code'] = $attributes['class_code'];$class['display'] = 'home health';break;
            case 'IMP'    : $class['code'] = $attributes['class_code'];$class['display'] = 'inpatient encounter';break;
            case 'ACUTE'  : $class['code'] = $attributes['class_code'];$class['display'] = 'inpatient acute';break;
            case 'NONAC'  : $class['code'] = $attributes['class_code'];$class['display'] = 'inpatient non-acute';break;
            case 'OBSENC' : $class['code'] = $attributes['class_code'];$class['display'] = 'observation encounter';break;
            case 'PRENC'  : $class['code'] = $attributes['class_code'];$class['display'] = 'pre-admission';break;
            case 'SS'     : $class['code'] = $attributes['class_code'];$class['display'] = 'short stay';break;
            case 'VR'     : $class['code'] = $attributes['class_code'];$class['display'] = 'virtual';break;
            case 'referred-procedure': 
                $class['code'] = $attributes['class_code'];
                $class['display'] = 'Prosedur yang Dirujuk';
                $class['system'] = 'http://terminology.kemkes.go.id/CodeSystem/encounter-class';
            break;
        }
        return $this;
    }

    private function setSubject(array &$attributes): self{
        $subject = &$attributes['payload']['subject'];
        $subject['reference'] = 'Patient/'.$attributes['patient_code'];
        $subject['display'] = $attributes['patient_name'];
        return $this;
    }

    private function setParticipant(array &$attributes): self{
        $participants = &$attributes['payload']['participant'];
        $temp_participants = [];
        foreach ($attributes['participant'] as $key => $participant_attrs) {
            $coding = ['system' => 'http://terminology.hl7.org/CodeSystem/v3-ParticipationType'];
            switch ($key) {
                case 'admitters'            : array_merge($coding,['code' => 'ADM','display' => 'admitter']);break;
                case 'attenders'            : array_merge($coding,['code' => 'ATND','display' => 'attender']);break;
                case 'callback_contacts'    : array_merge($coding,['code' => 'CALLBCK','display' => 'callback contact']);break;
                case 'consultants'          : array_merge($coding,['code' => 'CON','display' => 'consultant']);break;
                case 'dischargers'          : array_merge($coding,['code' => 'DIS','display' => 'discharger']);break;
                case 'escorts'              : array_merge($coding,['code' => 'ESC','display' => 'escort']);break;
                case 'referrers'            : array_merge($coding,['code' => 'REF','display' => 'referrer']);break;
                case 'secondary_performers' : array_merge($coding,['code' => 'SPRF','display' => 'secondary performer']);break;
                case 'primary_performers'   : array_merge($coding,['code' => 'PPRF','display' => 'primary performer']);break;
                case 'participations'       : array_merge($coding,['code' => 'PART','display' => 'Participation']);break;
                case 'translators'          : array_merge($coding,['code' => 'translator','display' => 'Translator','system' => 'http://terminology.hl7.org/CodeSystem/participant-type']);break;
                case 'emergencies'          : array_merge($coding,['code' => 'emergency','display' => 'Emergency', 'system' => 'http://terminology.hl7.org/CodeSystem/participant-type']);break;
            }
            foreach ($participant_attrs as $participant) {
                if (isset($temp_participants[$participant['participant_code']])){
                    $temp_participant = &$temp_participants[$participant['participant_code']];
                }else{
                    $temp_participants[$participant['participant_code']] = [
                        'type' => [
                            [
                                'coding' => []
                            ]
                        ],
                        'individual' => [
                            'reference' => 'Practitioner/'.$participant['participant_code'],
                            'display' => $participant['participant_name']
                        ]
                    ];
                    $temp_participant = &$temp_participants[$participant['participant_code']];
                }
                $temp_participant['type'][0]['coding'][] = $coding;
            }
        }
        $participants = array_values($temp_participants);
        return $this;
    }

    private function setLocation(array &$attributes): self{
        $location = &$attributes['payload']['location'];
        $location[] = [
            'location' => [
                'reference' => 'Location/'.$attributes['location_code'],
                'display' => $attributes['location_name']
            ]
        ];
        return $this;
    }

    private function setPeriod(array &$attributes): self{
        $period = &$attributes['payload']['period'];
        if (isset($attributes['period'])){
            $period = [
                'start' => Carbon::createFromFormat('Y-m-d H:i:s', $attributes['period'])->toIso8601String(),
            ];

        }
        return $this;
    }

    private function setStatusHistory(array &$attributes): self{
        $status_history = &$attributes['payload']['statusHistory'];
        foreach ($attributes['status_history'] as $key => $status_history_value) {
            if (!isset($status_history_value)) continue;
            $status_history[] = [
                'status' => Str::kebab($key),
                'period' => [
                    'start' => Carbon::createFromFormat('Y-m-d H:i:s', $status_history_value)->toIso8601String(),
                ]
            ];
        }
        return $this;
    }
}