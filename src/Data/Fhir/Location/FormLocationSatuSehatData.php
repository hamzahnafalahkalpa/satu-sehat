<?php

namespace Hanafalah\SatuSehat\Data\Fhir\Location;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\AddressSatuSehatData;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Location\FormLocationSatuSehatData as DataFormLocationSatuSehatData;
use Hanafalah\SatuSehat\Contracts\Data\Fhir\Location\Form\LocationPayloadData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Illuminate\Support\Str;

class FormLocationSatuSehatData extends Data implements DataFormLocationSatuSehatData
{
    #[MapInputName('name')]
    #[MapName('name')]
    public string $name;

    #[MapInputName('description')]
    #[MapName('description')]
    public ?string $description = null;

    #[MapInputName('location_code')]
    #[MapName('location_code')]
    public string $location_code;

    #[MapInputName('organization_code')]
    #[MapName('organization_code')]
    public string $organization_code;

    #[MapInputName('mode')]
    #[MapName('mode')]
    public ?string $mode = 'instance';

    #[MapInputName('telecom')]
    #[MapName('telecom')]
    public ?LocationTelcomSatuSehatData $telecom = null;

    #[MapInputName('payload')]
    #[MapName('payload')]
    public ?LocationPayloadData $payload = null;

    #[MapInputName('address')]
    #[MapName('address')]
    public ?AddressSatuSehatData $address = null;

    #[MapInputName('physical_type')]
    #[MapName('physical_type')]
    public ?LocationPhysicalTypeData $physical_type = null;

    #[MapInputName('longitude')]
    #[MapName('longitude')]
    public ?string $longitude = null;

    #[MapInputName('latitude')]
    #[MapName('latitude')]
    public ?string $latitude = null;

    #[MapInputName('altitude')]
    #[MapName('altitude')]
    public ?string $altitude = null;

    #[MapInputName('managing_organization_code')]
    #[MapName('managing_organization_code')]
    public ?string $managing_organization_code = null;

    public static function before(array &$attributes){
        $new = static::new();        
        $payload = &$attributes['payload'];
        $payload['name'] = $attributes['name'];
        $payload['status'] = $attributes['status'] ?? 'active';
        $payload['description'] = $attributes['description'] ?? null;
        $payload['mode'] = $attributes['mode'] ?? 'instance';
        $new->setIdentifier($attributes)
            ->setAddress($attributes)
            ->setPosition($attributes)
            ->setPhysicalType($attributes)
            ->setTelecom($attributes)
            ->setManagingOrganization($attributes);
    }

    private function setIdentifier(array &$attributes): self{
        $identifier = &$attributes['payload']['identifier'];
        $identifier[] = [
            'system' => 'http://sys-ids.kemkes.go.id/location/'.$attributes['organization_code'],
            'value' => $attributes['location_code']
        ];
        return $this;
    }

    private function setPosition(array &$attributes): self{
        $position = &$attributes['payload']['position'];
        if (isset($attributes['longitude']) || isset($attributes['latitude']) || isset($attributes['altitude'])) {
            $position = [
                'longitude' => isset($attributes['longitude']) ? (float)$attributes['longitude'] : 0,
                'latitude'  => isset($attributes['latitude']) ? (float)$attributes['latitude'] : 0,
                'altitude'  => isset($attributes['altitude']) ? (float)$attributes['altitude'] : 0
            ];
        }
        return $this;
    }

    private function setManagingOrganization(array &$attributes): self{
        $managing_organization = &$attributes['payload']['managingOrganization'];
        if (isset($attributes['managing_organization_code'])){
            $managing_organization = [
                'reference' => 'Organization/'.$attributes['managing_organization_code']
            ];
        }else{
            throw new \Exception('managing_organization_code not found');
        }
        return $this;
    }

    private function setPhysicalType(array &$attributes): self{
        $physical_type = &$attributes['payload']['physicalType'];
        $physical_type = [
            'coding' => []
        ];
        foreach ($attributes['physical_type'] as $key => $incoming_physical_type) {
            $system = 'http://terminology.hl7.org/CodeSystem/location-physical-type';
            switch ($key) {
                case 'site': $code = 'si'; break;
                case 'building': $code = 'bu'; break;
                case 'wing': $code = 'wi'; break;
                case 'ward': $code = 'wa'; break;
                case 'level': $code = 'lvl'; break;
                case 'corridor': $code = 'co'; break;
                case 'room': $code = 'ro'; break;
                case 'bed': $code = 'bd'; break;
                case 'vehicle': $code = 've'; break;
                case 'house': $code = 'ho'; break;
                case 'cabinet': $code = 'ca'; break;
                case 'road': $code = 'rd'; break;
                case 'area': $code = 'area'; break;
                case 'jurisdiction': $code = 'jdn'; break;
                case 'virtual': $code = 'vir'; $system='http://terminology.kemkes.go.id/CodeSystem/location-physical-type'; break;
            }
            $physical_type['coding'][] = [
                'system' => $system,
                'code'   => $code,
                'display'=> $incoming_physical_type
            ];
        }
        return $this;
    }

    private function setAddress(array &$attributes): self{
        $address = &$attributes['payload']['address'];
        if (isset($attributes['address'])){
            $incoming_address = $attributes['address'];
            $address = [
                'use' => $incoming_address['use'] ?? 'work',
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
            $address['extension'][] = $new_extension;
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