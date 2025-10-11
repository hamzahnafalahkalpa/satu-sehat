<?php

namespace Hanafalah\SatuSehat\Contracts\Supports;

use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;

interface BaseSatuSehat extends DataManagement{
    public function setDefaultHosts(): self;
    public function setHost(string $host_type, string $env_type, string $host_value): self;
    public function getHost(?string $host_type = null, ?string $env_type = null): array|string;

}