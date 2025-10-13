<?php

namespace Hanafalah\SatuSehat\Models;

use Hanafalah\SatuSehat\Resources\PatientSatuSehat\{
    ViewPatientSatuSehat,
    ShowPatientSatuSehat
};

class PatientSatuSehat extends SatuSehatLog
{
    protected $table = 'satu_sehat_logs';

    public function getViewResource(){
        return ViewPatientSatuSehat::class;
    }

    public function getShowResource(){
        return ShowPatientSatuSehat::class;
    }
}
