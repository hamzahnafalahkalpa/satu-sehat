<?php

namespace Hanafalah\SatuSehat\Models;

use Hanafalah\SatuSehat\Resources\PractitionerSatuSehat\{
    ViewPractitionerSatuSehat,
    ShowPractitionerSatuSehat
};

class PractitionerSatuSehat extends SatuSehatLog
{
    protected $table = 'satu_sehat_logs';

    public function getViewResource(){
        return ViewPractitionerSatuSehat::class;
    }

    public function getShowResource(){
        return ShowPractitionerSatuSehat::class;
    }
}
