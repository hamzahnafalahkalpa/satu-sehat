<?php

namespace Hanafalah\SatuSehat\Concerns;
use Illuminate\Support\Str;

trait HasHeader{
    protected $__headers = [
        'Content-Type' => 'application/json',
        'Accept' => 'application/json',
    ];

    public function setHeader(string $key, string $value): self{
        $this->__headers[$key] = $value;
        return $this;
    }

    public function getHeaders(): array{
        return $this->__headers;
    }
}