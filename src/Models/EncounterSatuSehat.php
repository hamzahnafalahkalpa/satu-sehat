<?php

namespace Hanafalah\SatuSehat\Models;

use Hanafalah\SatuSehat\Resources\EncounterSatuSehat\{
    ViewEncounterSatuSehat,
    ShowEncounterSatuSehat
};

class EncounterSatuSehat extends SatuSehatLog
{
    protected $table = 'satu_sehat_logs';

    public function getViewResource(){
        return ViewEncounterSatuSehat::class;
    }

    public function getShowResource(){
        return ShowEncounterSatuSehat::class;
    }
}
