<?php

namespace Hanafalah\SatuSehat\Models;

use Hanafalah\SatuSehat\Resources\OrganizationSatuSehat\{
    ViewOrganizationSatuSehat,
    ShowOrganizationSatuSehat
};

class OrganizationSatuSehat extends SatuSehatLog
{
    protected $table = 'satu_sehat_logs';

    public function getViewResource(){
        return ViewOrganizationSatuSehat::class;
    }

    public function getShowResource(){
        return ShowOrganizationSatuSehat::class;
    }
}
