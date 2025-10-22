<?php

namespace Hanafalah\SatuSehat;

use Hanafalah\SatuSehat\Contracts\SatuSehat as ContractsSatuSehat;
use Hanafalah\SatuSehat\Facades\SatuSehat as FacadesSatuSehat;
use Hanafalah\SatuSehat\Supports\BaseSatuSehat;
use Illuminate\Support\Facades\Http;

class SatuSehat extends BaseSatuSehat implements ContractsSatuSehat {
    const LOWER_CLASS_NAME = "satu_sehat";
    protected ?string $__access_token = null;
    protected ?object $__organization = null;

    public function get(string $url, ?callable $on_success = null, ?callable $on_failed = null){
        $url = ltrim($url, '/');
        $this->__satu_sehat_url = $this->getCurrentFhirHost().'/'.$url;        
        $response = $this->http()->get($this->__satu_sehat_url);
        $this->__response = $response;
        return $this->responseHandler($response, $on_success, $on_failed);
    }

    public function store(string $url, array $payload, ?callable $on_success = null, ?callable $on_failed = null){
        $url = ltrim($url, '/');
        $this->setHttp(Http::record(function($http){
            $http->withHeaders($this->__headers);
        }));
        $this->__satu_sehat_url = $this->getCurrentFhirHost().'/'.$url;
        $response = $this->http()->post($this->__satu_sehat_url, $payload);
        $this->__response = $response;
        $this->__payload = $payload;
        return $this->responseHandler($response, $on_success, $on_failed);
    }

    public function auth(string $url, array $payload, ?callable $on_success = null, ?callable $on_failed = null){
        $this->setHttp(Http::record(function($http){
            $http->withHeaders($this->__headers);
        }));
        return $this->postAuth($url, $payload, $on_success, $on_failed);
    }

    public function getAccessToken(): ?string{
        return $this->__access_token;
    }

    public function setAccessToken(string $token): self{
        $this->__access_token = $token;
        return $this;
    }

    public function getOrganization(): ?string{
        return $this->__organization;
    }

    public function setOrganization(object $organization): self{
        $this->__organization = $organization;
        return $this;
    }
}
