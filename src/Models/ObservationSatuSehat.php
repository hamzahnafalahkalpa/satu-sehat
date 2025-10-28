<?php

namespace Hanafalah\SatuSehat\Models;

use Hanafalah\SatuSehat\Resources\ObservationSatuSehat\{
    ViewObservationSatuSehat,
    ShowObservationSatuSehat
};

class ObservationSatuSehat extends SatuSehatLog
{
    protected $table = 'satu_sehat_logs';

    public function getViewResource(){
        return ViewObservationSatuSehat::class;
    }

    public function getShowResource(){
        return ShowObservationSatuSehat::class;
    }
}
