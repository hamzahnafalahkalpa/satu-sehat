<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Organization;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\MultipleAddressSatuSehatData;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Organization\FormOrganizationSatuSehatData as DataFormOrganizationSatuSehatData;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Organization\Form\OrganizationPayloadData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\DateFormat;
use Spatie\LaravelData\Attributes\Validation\BooleanType;
use Illuminate\Support\Str;
use Spatie\LaravelData\Attributes\Validation\In;

class FormOrganizationSatuSehatData extends Data implements DataFormOrganizationSatuSehatData
{
    #[MapInputName('active')]
    #[MapName('active')]
    public ?bool $active = true;

    #[MapInputName('address')]
    #[MapName('address')]
    public ?MultipleAddressSatuSehatData $address = null;

    public static function before(array &$attributes){
        $new = static::new();        
        $payload = &$attributes['payload'];
        $attributes['active'] ??= true;

        $new->setIdentifier($attributes)
            ->setName($attributes)
            ->setAddress($attributes);
    }

    private function setName(array &$attributes): self{
        $name = &$attributes['payload']['name'];
        $name[] = [
            'text' => $attributes['name'],
        ];
        return $this;
    }

    private function setIdentifier(array &$attributes): self{
        $identifier = &$attributes['payload']['identifier'];
        if (isset($attributes['nik_ibu'])){
            $identifier[] = [
                'system' => 'https://fhir.kemkes.go.id/id/nik-ibu',
                'value' => $attributes['nik_ibu']
            ];
        }

        if (isset($attributes['nik'])){
            $identifier[] = [
                'system' => 'https://fhir.kemkes.go.id/id/nik',
                'value' => $attributes['nik']
            ];
        }

        if (isset($attributes['ihs_number'])){
            $identifier[] = [
                'system' => 'https://fhir.kemkes.go.id/id/ihs-number',
                'value' => $attributes['ihs_number']
            ];
        }

        return $this;
    }

    private function setAddress(array &$attributes): self{
        $address = &$attributes['payload']['address'];
        $attr_addresses = ['home','work','temp','old','billing'];
        $new_addresses = [];
        foreach ($attr_addresses as $attr) {
            if (isset($attributes['address'][$attr])){
                $incoming_address = $attributes['address'][$attr];
                if (!isset($incoming_address['name'])) continue;
                $new_address = [
                    'use' => $attr,
                    'line' => [$incoming_address['name']],
                    'city' => $incoming_address['city'] ?? null,
                    'postalCode' => $incoming_address['postalCode'] ?? null,
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
                        'valueCode' => $incoming_address[$deep_attr]
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