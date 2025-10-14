<?php

namespace Hanafalah\SatuSehat\Contracts;

use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;

interface SatuSehat extends DataManagement{
    public function get(string $url);
    public function store(string $url);
    public function auth(string $url, array $payload, ?callable $on_success = null, ?callable $on_failed = null);
    public function getAccessToken(): ?string;
    public function setAccessToken(string $token): self;
}