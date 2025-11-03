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
        $data = $response->json();
        if ($response->successful() ) {
            if (isset($on_success)) $on_success($data);
            return $data;
        } elseif ($response->clientError() || $response->serverError()) {
            if (isset($on_failed)) $on_failed($response);
            throw new \Exception($response->body());
        } else {
            throw new \Exception($response->body());
        }
    }

    // protected function responseHandler($response, ?callable $on_success = null, ?callable $on_failed = null)
    // {
    //     $json = $response->json();
    //     $status = $response->status();

    //     // Kalau 2xx → sukses normal
    //     if ($response->successful()) {
    //         return $on_success ? $on_success($json, $response) : $json;
    //     }

    //     // Kalau 4xx/5xx tapi masih ada JSON → tetap lempar ke callback success,
    //     // tapi tandai is_error agar bisa dibedain
    //     if ($response->failed() && is_array($json)) {
    //         // $json['_meta'] = [
    //         //     'is_error' => true,
    //         //     'status' => $status,
    //         //     'reason' => $response->reason(),
    //         // ];
    //         return $on_success ? $on_success($json, $response) : $json;
    //     }

    //     // Kalau total gagal dan gak ada JSON
    //     if ($on_failed) {
    //         return $on_failed($response);
    //     }

    //     return null;
    // }

}