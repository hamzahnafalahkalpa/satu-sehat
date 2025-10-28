<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Observation;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Observation\{
    ObservationVitalSignSatuSehatData as DataObservationVitalSignSatuSehatData,
};
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class ObservationVitalSignSatuSehatData extends Data implements DataObservationVitalSignSatuSehatData
{
    #[MapInputName('heart_rate')]
    #[MapName('heart_rate')]
    public ?int $heart_rate = null;

    #[MapInputName('oxygen_saturation')]
    #[MapName('oxygen_saturation')]
    public ?int $oxygen_saturation = null;

    #[MapInputName('respiratory_rate')]
    #[MapName('respiratory_rate')]
    public ?int $respiratory_rate = null;

    #[MapInputName('body_temperature')]
    #[MapName('body_temperature')]
    public ?float $body_temperature = null;

    #[MapInputName('body_height')]
    #[MapName('body_height')]
    public ?int $body_height = null;

    #[MapInputName('body_weight')]
    #[MapName('body_weight')]
    public ?int $body_weight = null;

    #[MapInputName('body_mass_index')]
    #[MapName('body_mass_index')]
    public ?float $body_mass_index = null;

    #[MapInputName('systolic_blood_pressure')]
    #[MapName('systolic_blood_pressure')]
    public ?int $systolic_blood_pressure = null;

    #[MapInputName('diastolic_blood_pressure')]
    #[MapName('diastolic_blood_pressure')]
    public ?int $diastolic_blood_pressure = null;

    #[MapInputName('value')]
    #[MapName('value')]
    public ?array $value = [];

    public static function before(array &$attributes){
        $weight = $attributes['body_weight'] ?? null;
        $height = $attributes['body_height'] ?? null;

        if ($weight === null || $height === null) return;
        if (!is_numeric($weight) || !is_numeric($height)) return;

        $weight = (float) $weight;
        $height = (float) $height;
        if ($height <= 0) return;

        $heightMeters = $height / 100;
        if ($heightMeters <= 0) return;

        $bmi = $weight / ($heightMeters * $heightMeters);
        $attributes['body_mass_index'] = round($bmi, 1);

        $arr = [
            'heart_rate',
            'oxygen_saturation',
            'respiratory_rate',
            'body_temperature',
            'body_height',
            'body_weight',
            'body_mass_index',
            'systolic_blood_pressure',
            'diastolic_blood_pressure'
        ];
        $attributes['value'] = [];
        $value = &$attributes['value'];
        foreach($arr as $key){
            if (isset($attributes[$key])){
                $value[] = [
                    'category' => [
                        [
                            'coding' => [
                                [
                                    'system'  => 'http://terminology.hl7.org/CodeSystem/observation-category',
                                    'code'    => 'vital-signs',
                                    'display' => 'Vital Signs',
                                ]
                            ]
                        ]
                    ],
                    'code' => [
                        'coding' => [
                            [
                                'system'  => 'http://loinc.org',
                                'code'    => self::getLoincCode($key),
                                'display' => self::getLoincDisplay($key),
                            ]
                        ]
                    ],
                    'valueQuantity' => [
                        'value' => $attributes[$key],
                        'unit'  => self::getUnit($key),
                        'system'=> 'http://unitsofmeasure.org',
                        'code'  => self::getUnitCode($key),
                    ],
                ];
            }
        }
    }

    private static function getLoincCode(string $key): string{
        return match($key){
            'heart_rate' => '8867-4',
            'oxygen_saturation' => '59408-5',
            'respiratory_rate' => '9279-1',
            'body_temperature' => '8310-5',
            'body_height' => '8302-2',
            'body_weight' => '29463-7',
            'body_mass_index' => '39156-5',
            'systolic_blood_pressure' => '8480-6',
            'diastolic_blood_pressure' => '8462-4',
            default => '',
        };
    }

    private static function getLoincDisplay(string $key): string{
        return match($key){
            'heart_rate' => 'Heart rate',
            'oxygen_saturation' => 'Oxygen saturation in Arterial blood by Pulse oximetry',
            'respiratory_rate' => 'Respiratory rate',
            'body_temperature' => 'Body temperature',
            'body_height' => 'Body height',
            'body_weight' => 'Body weight',
            'body_mass_index' => 'Body mass index (BMI) [Ratio]',
            'systolic_blood_pressure' => 'Systolic blood pressure',
            'diastolic_blood_pressure' => 'Diastolic blood pressure',
            default => '',
        };
    }

    private static function getUnit(string $key): string{
        return match($key){
            'heart_rate' => 'beats/minute',
            'oxygen_saturation' => '%',
            'respiratory_rate' => 'breaths/minute',
            'body_temperature' => 'degrees Celsius',
            'body_height' => 'cm',
            'body_weight' => 'kg',
            'body_mass_index' => 'kg/m2',
            'systolic_blood_pressure' => 'mmHg',
            'diastolic_blood_pressure' => 'mmHg',
            default => '',
        };
    }

    private static function getUnitCode(string $key): string{
        return match($key){
            'heart_rate' => '/min',
            'oxygen_saturation' => '%',
            'respiratory_rate' => '/min',
            'body_temperature' => 'Cel',
            'body_height' => 'cm',
            'body_weight' => 'kg',
            'body_mass_index' => 'kg/m2',
            'systolic_blood_pressure' => 'mm[Hg]',
            'diastolic_blood_pressure' => 'mm[Hg]',
            default => '',
        };
    }
}