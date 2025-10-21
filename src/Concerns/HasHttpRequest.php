<?php

namespace Hanafalah\SatuSehat\Concerns;

use Illuminate\Support\Facades\Http;

trait HasHttpRequest{
    use HasHeader;

    protected $__http;
    protected $__response;
    protected $__payload;

    public function initializeHttp(){ 
        // $this->setHttp(Http::record(function($http){
        //     $http->withHeaders($this->__headers);
        // }));

        $this->setHttp(Http::withHeaders($this->__headers));
    }

    public function setHttp($http): self{
        $this->__http = $http;
        return $this;
    }

    public function http(){
        $this->initializeHttp();
        return $this->__http;
    }

    public function async(): self{
        $this->__http->async();
        return $this;
    }

    protected function postAuth(string $url,$payload, ?callable $on_success = null, ?callable $on_failed = null){
        $url = ltrim($url, '/');    
        $this->__satu_sehat_url = $this->getCurrentAuthHost().'/'.$url;
        $response = $this->http()->asForm()->post($this->__satu_sehat_url, $payload);
        $this->__response = $response;
        $this->__payload = $payload;
        return $this->responseHandler($response, $on_success, $on_failed);
    }

    public function getResponse(){
        return $this->__response;
    }

    public function getPayload(){
        return $this->__payload;
    }

    public function getSatuSehatUrl(){
        return $this->__satu_sehat_url;
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