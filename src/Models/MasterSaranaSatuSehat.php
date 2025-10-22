<?php

namespace Hanafalah\SatuSehat\Models;

use Hanafalah\SatuSehat\Resources\MasterSaranaSatuSehat\{
    ViewMasterSaranaSatuSehat,
    ShowMasterSaranaSatuSehat
};

class MasterSaranaSatuSehat extends SatuSehatLog
{
    protected $table = 'satu_sehat_logs';

    public function getViewResource(){
        return ViewMasterSaranaSatuSehat::class;
    }

    public function getShowResource(){
        return ShowMasterSaranaSatuSehat::class;
    }
}
