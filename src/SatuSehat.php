<?php

namespace Hanafalah\SatuSehat;

use Hanafalah\SatuSehat\Contracts\SatuSehat as ContractsSatuSehat;
use Hanafalah\SatuSehat\Supports\BaseSatuSehat;

class SatuSehat extends BaseSatuSehat implements ContractsSatuSehat {
    const LOWER_CLASS_NAME = "satu_sehat";

    public function get(string $url){
        $url = ltrim($url, '/');

    }

    public function store(string $url){
        $url = ltrim($url, '/');

    }

    public function auth(?string $url = 'accesstoken', array $payload, ?callable $on_success, ?callable $on_failed){
        return $this->postAuth($url, $payload, $on_success, $on_failed);
    }
}
