<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Patient;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\MultipleAddressSatuSehatData;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Patient\FormPatientSatuSehatData as DataFormPatientSatuSehatData;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Patient\Form\PatientPayloadData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\DateFormat;
use Spatie\LaravelData\Attributes\Validation\BooleanType;
use Spatie\LaravelData\Attributes\Validation\Enum;
use Illuminate\Support\Str;

class FormPatientSatuSehatData extends Data implements DataFormPatientSatuSehatData
{
    #[MapInputName('name')]
    #[MapName('name')]
    public string $name;

    #[MapInputName('gender')]
    #[MapName('gender')]
    #[Enum('male', 'female')]
    public ?string $gender = null;

    #[MapInputName('nik')]
    #[MapName('nik')]
    public ?object $nik = null;

    #[MapInputName('nik_ibu')]
    #[MapName('nik_ibu')]
    public ?object $nik_ibu = null;

    #[MapInputName('active')]
    #[MapName('active')]
    public ?bool $active = true;

    #[MapInputName('birth_date')]
    #[MapName('birth_date')]
    #[DateFormat('Y-m-d')]
    public ?object $birth_date = null;

    #[MapInputName('deceased_boolean')]
    #[MapName('deceased_boolean')]
    #[BooleanType]
    public ?bool $deceased_boolean = false;

    #[MapInputName('payload')]
    #[MapName('payload')]
    public ?PatientPayloadData $payload = null;

    #[MapInputName('address')]
    #[MapName('address')]
    public ?MultipleAddressSatuSehatData $address = null;

    public static function before(array &$attributes){
        $new = static::new();        
        $payload = &$attributes['payload'];
        $attrs = ['active','gender','birth_date','deceased_boolean','multiple_birth_integer'];
        foreach ($attrs as $attr) $payload[Str::camel($attr)] = $attributes[$attr];
        $new->setIdentifier($attributes)
            ->setName($attributes)
            ->setName($attributes)
            ->setAddress($attributes);
    }

    private function setName(array &$attributes): self{
        $name = &$attributes['payload']['name'];
        $name['text'] = $attributes['name'];
        return $this;
    }

    private function setIdentifier(array &$attributes): self{
        $identifier = &$attributes['payload']['identifier'];
        if (isset($attributes['nik_ibu'])){
            $identifier['system']  = 'https://fhir.kemkes.go.id/id/nik-ibu';
        }
        $identifier['text'] = $attributes['nik'];
        return $this;
    }

    private function setAddress(array &$attributes): self{
        $address = &$attributes['payload']['address'];
        $attr_addresses = ['home','work','temp','old','billing'];
        $new_addresses = [];
        foreach ($attr_addresses as $attr) {
            if (isset($attributes['address'][$attr])){
                $incoming_address = $attributes['address'][$attr];
                $new_address = [
                    'use' => $attr,
                    'line' => [$incoming_address['name']],
                    'city' => $incoming_address['city'],
                    'postalCode' => $incoming_address['postalCode'],
                    'extension' => []
                ];
                $new_extension = [
                    'url' => 'https://fhir.kemkes.go.id/r4/StructureDefinition/administrativeCode',
                    'extension' => []
                ];

                $deep_extension = &$new_extension['extension'];
                $deep_attrs = [
                    'province_code','city_code','district_code','village_code','rt','rw'
                ];
                foreach ($deep_attrs as $deep_attr) {
                    $code = Str::before($deep_attr, '_code') ?? $deep_attr;
                    $deep_extension[] = [
                        'url' => $code,
                        'valueCode' => $incoming_address
                    ];
                }
                $new_address['extension'][] = $new_extension;
                $new_addresses[] = $new_address;
            }
            $address = $new_addresses;
        }
        return $this;
    }
}