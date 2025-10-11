<?php

namespace Hanafalah\SatuSehat\Concerns;

use Illuminate\Support\Facades\Http;

trait HasHttpRequest{
    use HasHeader;

    protected $__http;

    public function initializeHttp(){
        $this->sethHttp(Http::withHeaders($this->__headers));
    }

    public function setHttp(Http $http): self{
        $this->__http = $http;
        return $this;
    }

    public function http(){
        return $this->__http;
    }

    public function async(): self{
        $this->__http->async();
        return $this;
    }

    protected function postAuth(?string $url = 'accesstoken',$payload, ?callable $on_success = null, ?callable $on_failed = null): self{
        $url = ltrim($url, '/');
        $response = $this->http()->post($this->getCurrentAuthHost().'/'.$url, $payload);
        $this->responseHandler($response, $on_success, $on_failed);
        return $this;
    }

    protected function responseHandler($response, ?callable $on_success = null, ?callable $on_failed = null){
        if ($response->successful()) {
            $data = $response->json();
            if (isset($on_success)) $on_success($data);
            return $data;
        } elseif ($response->clientError() || $response->serverError()) {
            if (isset($on_failed)) $on_failed($response);
            throw new \Exception($response->body());
        } else {
            throw new \Exception($response->body());
        }
    }
}