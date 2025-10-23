<?php

namespace Hanafalah\SatuSehat\Concerns;
use Illuminate\Support\Str;

trait HasEnvironment{
    protected $__satu_sehat_env;
    protected $__current_auth_host;
    protected $__current_fhir_host;
    protected $__current_satu_sehat_host;
    protected $__credentials = [
        'client_id' => null,
        'client_secret' => null,
        'organization_id' => null
    ];

    public function setEnvironment(?string $env_type = null){
        $env_type ??= config('satu-sehat.env_type','STG');
        $this->setDefaultHosts()->setCredentialsDefault();

        $this->__satu_sehat_env = config('satu-sehat.environment',[]);
        $this->__current_auth_host = $this->getHost('AUTH', $env_type);
        $this->__current_fhir_host = $this->getHost('FHIR', $env_type);
        $this->__current_satu_sehat_host = $this->getHost('SATUSEHAT', $env_type);

        $this->setEnvConfig('env_type', $env_type)
             ->setEnvConfig('hosts', $this->__hosts)
             ->setEnvConfig('credentials', $this->__credentials);
        config(['satu-sehat.environment' => $this->__satu_sehat_env]);
    }

    public function getCurrentAuthHost():string{
        return $this->__current_auth_host;
    }

    public function getCurrentFhirHost():string{
        return $this->__current_fhir_host;
    }

    public function getCurrentSatuSehatHost():string{
        return $this->__current_satu_sehat_host;
    }

    private function setCurrentAuthHost(string $host): self{
        $this->__current_auth_host = $host;
        return $this;
    }

    private function setCurrentFhirHost(string $host): self{
        $this->__current_fhir_host = $host;
        return $this;
    }

    private function setCurrentSatuSehatHost(string $host): self{
        $this->__current_satu_sehat_host = $host;
        return $this;
    }

    public function setEnvConfig(string $key, array|string|null $value): self{
        $this->__satu_sehat_env[$key] = $value;
        return $this;
    }

    public function getEnvironment(): array{
        return config('satu-sehat.environment');
    }

    public function setCredentialsDefault(): self{
        $config_credentials = config('environment.credentials',[
            'client_id' => null,
            'client_secret' => null,
            'organization_id' => null
        ]);
        $client_id = $config_credentials['client_id'] ?? env('SS_CLIENT_ID');
        $client_secret = $config_credentials['client_secret'] ?? env('SS_CLIENT_SECRET');
        $org_id = $config_credentials['organization_id'] ?? env('SS_ORGANIZATION_ID');
        $this->setCredential('client_id', $client_id)
             ->setCredential('client_secret', $client_secret)
             ->setCredential('organization_id', $org_id);
        return $this;
    }

    private function validateCredentialKeys(string $credential_type): bool{
        $valid = in_array($credential_type, array_keys($this->__credentials));
        if (!$valid) throw new \Exception($credential_type.' not available on credentials');
        return $valid;
    }

    public function getClientId(): ?string{
        return $this->getCredentials('client_id');
    }

    public function getClientSecret(): ?string{
        return $this->getCredentials('client_secret');
    }

    public function getOrganizationId(): ?string{
        return $this->getCredentials('organization_id');
    }

    public function getCredentials(?string $credential_type = null): array|string|null{
        if (isset($credential_type)) {
            $this->validateCredentialKeys($credential_type);
            return $this->__credentials[$credential_type];
        }
        return $this->credentials;
    }

    public function setCredential(string $credential_type, string $value): self{
        $this->validateCredentialKeys($credential_type);
        $this->__credentials[$credential_type] = $value;
        return $this;
    }
}