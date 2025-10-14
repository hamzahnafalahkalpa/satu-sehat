<?php

namespace Hanafalah\SatuSehat\Concerns;
use Illuminate\Support\Facades\Http;

trait HasHeader{
    protected $__headers = [
        'Content-Type' => 'application/json',
        'Accept' => 'application/json',
    ];

    public function setHeader(string $key, string $value): self{
        $this->__headers[$key] = $value;
        $this->setHttp(Http::record(function($http){
            $http->withHeaders($this->__headers);
        }));
        return $this;
    }

    public function getHeaders(): array{
        return $this->__headers;
    }
}