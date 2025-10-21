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

    #[MapInputName('patient_code')]
    #[MapName('patient_code')]
    public string $patient_code;

    #[MapInputName('patient_name')]
    #[MapName('patient_name')]
    public string $patient_name;

    #[MapInputName('participant')]
    #[MapName('participant')]
    public ?EncounterParticipantSatuSehatData $participant;

    #[MapInputName('payload')]
    #[MapName('payload')]
    public ?EncounterPayloadData $payload = null;

    public static function before(array &$attributes){
        $new = static::new();       
        $attributes['status'] ??= 'arrived';
        
        $payload = &$attributes['payload'];
        $new->setIdentifier($attributes)
            ->setClass($attributes)
            ->setPatient($attributes)
            ->setParticipant($attributes);
    }

    private function setIdentifier(array &$attributes): self{
        $identifier = &$attributes['payload']['identifier'];
        if (isset($attributes['org_id']) && isset($attributes['visit_code'])){
            $identifier[] = [
                'system' => 'http://sys-ids.kemkes.go.id/encounter/'.$attributes['org_id'],
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
        switch ($attributes['class_cpde']) {
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

    private function setPatient(array &$attributes): self{
        $patient = &$attributes['payload']['patient'];
        $patient['reference'] = 'Patient/'.$attributes['patient_code'];
        $patient['display'] = $attributes['patient_name'];
        return $this;
    }

    private function setParticipant(array &$attributes): self{
        $participants = &$attributes['payload']['participant'];
        foreach ($attributes['participant'] as $key => $participant) {
            switch ($key) {
                case 'admitters'            : [];
                case 'attenders'            : [];
                case 'callback_contacts'    : [];
                case 'consultants'          : [];
                case 'dischargers'          : [];
                case 'escorts'              : [];
                case 'referrers'            : [];
                case 'secondary_performers' : [];
                case 'primary_performers'   : [];
                case 'participations'       : [];
                case 'translators'          : [];
                case 'emergencies'          : [];
            }
        }
        return $this;
    }
}