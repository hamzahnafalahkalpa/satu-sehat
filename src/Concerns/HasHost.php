<?php

namespace Hanafalah\SatuSehat\Concerns;

trait HasHost{
    protected $__hosts = [
        'AUTH' => [
            'DEV' => 'https://api-satusehat-dev.dto.kemkes.go.id/oauth2/v1',
            'STG' => 'https://api-satusehat-stg.dto.kemkes.go.id/oauth2/v1',
            'PROD' => 'https://api-satusehat.kemkes.go.id/oauth2/v1',
        ],
        'FHIR' => [
            'DEV' => 'https://api-satusehat-dev.dto.kemkes.go.id/fhir-r4/v1',
            'STG' => 'https://api-satusehat-stg.dto.kemkes.go.id/fhir-r4/v1',
            'PROD' => 'https://api-satusehat.kemkes.go.id/fhir-r4/v1'
        ],
        'SATUSEHAT' => [
            'DEV' => 'https://api-satusehat-dev.dto.kemkes.go.id',
            'STG' => 'https://api-satusehat-stg.dto.kemkes.go.id',
            'PROD' => 'https://api-satusehat.kemkes.go.id'
        ]
    ];

    public function setDefaultHosts(): self{
        $host_types = ['AUTH','FHIR','SATUSEHAT'];
        $env_types = ['DEV','STG','PROD'];
        foreach ($host_types as $host_type) {
            foreach ($env_types as $env_type) {
                $env_var = 'SS_'.strtoupper($host_type).'_'.strtoupper($env_type);
                $host_value = env($env_var,$this->__hosts[$host_type][$env_type]);
                $this->setHost($host_type, $env_type, $host_value);
            }
        }
        return $this;
    }

    public function setHost(string $host_type, string $env_type, string $host_value): self{
        $this->__hosts[$host_type][$env_type] = $host_value;
        return $this;
    }

    public function getHost(?string $host_type = null, ?string $env_type = null): array|string{
        if (isset($host_type) && isset($env_type)){
            return $this->__hosts[$host_type][$env_type];
        }
        return $this->__hosts;
    }
}