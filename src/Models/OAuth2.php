<?php

namespace Hanafalah\SatuSehat\Models;

use Hanafalah\SatuSehat\Resources\OAuth2\{
    ViewOAuth2,
    ShowOAuth2
};

class OAuth2 extends SatuSehatLog
{
    protected $table = 'satu_sehat_logs';

    public function getViewResource(){
        return ViewOAuth2::class;
    }

    public function getShowResource(){
        return ShowOAuth2::class;
    }
}
