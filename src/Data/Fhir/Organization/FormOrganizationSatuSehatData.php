<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Organization;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\MultipleAddressSatuSehatData;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Organization\Form\OrganizationPayloadData;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Organization\FormOrganizationSatuSehatData as DataFormOrganizationSatuSehatData;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Organization\OrganizationTypeSatuSehatData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Illuminate\Support\Str;

class FormOrganizationSatuSehatData extends Data implements DataFormOrganizationSatuSehatData
{
    #[MapInputName('active')]
    #[MapName('active')]
    public ?bool $active = true;

    #[MapInputName('part_of_organization_code')]
    #[MapName('part_of_organization_code')]
    public ?string $part_of_organization_code = null;

    #[MapInputName('organization_code')]
    #[MapName('organization_code')]
    public ?string $organization_code = null;

    #[MapInputName('organization_name')]
    #[MapName('organization_name')]
    public ?string $organization_name = null;

    #[MapInputName('type')]
    #[MapName('type')]
    public ?OrganizationTypeSatuSehatData $type = null;

    #[MapInputName('address')]
    #[MapName('address')]
    public ?MultipleAddressSatuSehatData $address = null;

    #[MapInputName('telecom')]
    #[MapName('telecom')]
    public ?OrganizationTelcomSatuSehatData $telecom = null;

    #[MapInputName('payload')]
    #[MapName('payload')]
    public ?OrganizationPayloadData $payload = null;

    public static function before(array &$attributes){
        $new = static::new();        
        $payload = &$attributes['payload'];
        $attributes['part_of_organization_code'] ??= $attributes['organization_code'];
        $payload['partOf'] = [
            "reference" => "Organization/".$attributes['part_of_organization_code']
        ];
        $attributes['active'] ??= true;

        $new->setIdentifier($attributes)
            ->setName($attributes)
            ->setAddress($attributes)
            ->setType($attributes)
            ->setTelecom($attributes);
    }

    private function setName(array &$attributes): self{
        $name = &$attributes['payload']['name'];
        if (isset($attributes['organization_name'])){
            $name = $attributes['organization_name'];
        }else{
            throw new \Exception('organization_name not found');
        }
        return $this;
    }

    private function setIdentifier(array &$attributes): self{
        $identifier = &$attributes['payload']['identifier'];
        if (isset($attributes['organization_code']) && isset($attributes['organization_name'])){
            $identifier[] = [
                'use' => 'official',
                'system' => 'http://sys-ids.kemkes.go.id/organization/'.$attributes['organization_code'],
                'value' => $attributes['organization_name']
            ];
        }else{
            throw new \Exception('organization_code or organization_name not found');
        }
        return $this;
    }

    private function setType(array &$attributes): self{
        $type = &$attributes['payload']['type'];
        if (isset($attributes['type'])){
            $type = [["coding" => []]];
            $coding = &$type[0]['coding'];
            foreach ($attributes['type'] as $key => $attr_type) {
                switch ($key) {
                    case 'provider'          : $key = 'prov';break;
                    case 'department'        : $key = 'dept';break;
                    case 'team'              : $key = 'team';break;
                    case 'government'        : $key = 'govt';break;
                    case 'insurence'         : $key = 'ins';break;
                    case 'payer'             : $key = 'pay';break;
                    case 'educational'       : $key = 'edu';break;
                    case 'religious'         : $key = 'reli';break;
                    case 'clinical_research' : $key = 'crs';break;
                    case 'community'         : $key = 'cg';break;
                    case 'bussiness'         : $key = 'bus';break;
                    case 'other'             : $key = 'other';break;
                }
                $coding[] = [
                    'system' => "http://terminology.hl7.org/CodeSystem/organization-type",
                    'code' => $key,
                    'display' => $attr_type
                ];                
            }
        }else{
            throw new \Exception('type not found');
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

    private function setTelecom(array &$attributes): self{
        $payload_telecom = &$attributes['payload']['telecom'];
        if (isset($attributes['telecom'])){
            foreach ($attributes['telecom'] as $key => $telecom_data) {
                foreach ($telecom_data as $telecom_type => $telecom_values) {
                    foreach ($telecom_values as $value) {
                        $payload_telecom[] = [
                            'system' => $telecom_type,
                            'value'  => $value,
                            'use'    => $key
                        ];
                    }
                }
            }
        }else{
            throw new \Exception('telecom not found');
        }
        return $this;
    }
}