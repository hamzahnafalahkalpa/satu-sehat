<?php

namespace Hanafalah\SatuSehat\Models;

use Hanafalah\SatuSehat\Resources\LocationSatuSehat\{
    ViewLocationSatuSehat,
    ShowLocationSatuSehat
};

class LocationSatuSehat extends SatuSehatLog
{
    protected $table = 'satu_sehat_logs';

    public function getViewResource(){
        return ViewLocationSatuSehat::class;
    }

    public function getShowResource(){
        return ShowLocationSatuSehat::class;
    }
}
