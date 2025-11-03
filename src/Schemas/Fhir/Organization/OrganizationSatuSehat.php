<?php

namespace Hanafalah\SatuSehat\Schemas\Fhir\Organization;

use Hanafalah\SatuSehat\Contracts\Data\Fhir\Organization\OrganizationSatuSehatData;
use Hanafalah\SatuSehat\Contracts\Schemas\Fhir\Organization\OrganizationSatuSehat as ContractsOrganizationSatuSehat;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\SatuSehat\Facades\SatuSehat;
use Hanafalah\SatuSehat\Schemas\OAuth2;
use Illuminate\Support\Collection;

class OrganizationSatuSehat extends OAuth2 implements ContractsOrganizationSatuSehat
{
    protected string $__entity = 'OrganizationSatuSehat';
    public $organization_satu_sehat_model;
    protected array $__organization_examples;
    //protected mixed $__order_by_created_at = false; //asc, desc, false

    protected array $__cache = [
        'index' => [
            'name'     => 'organization_satu_sehat',
            'tags'     => ['organization_satu_sehat', 'organization_satu_sehat-index'],
            'duration' => 24 * 60
        ]
    ];

    public function prepareStoreOrganizationSatuSehat(OrganizationSatuSehatData $organization_satu_sehat_dto): Model{
        $organization = SatuSehat::store('Organization',$organization_satu_sehat_dto->form->payload->toArray());
        $this->organization_satu_sehat_model = $this->logSatuSehat($organization_satu_sehat_dto,SatuSehat::getResponse(),$organization,SatuSehat::getPayload());
        return $this->organization_satu_sehat_model;
    }

    public function prepareViewOrganizationSatuSehatList(?OrganizationSatuSehatData $organization_satu_sehat_dto = null): Collection{
        $organization_satu_sehat_dto ??= $this->requestDTO(config('app.contracts.OrganizationSatuSehatData'));
        $satu_sehat = SatuSehat::get('Organization'.$organization_satu_sehat_dto->params->query);
        $this->organization_satu_sehat_model = $this->logSatuSehat($organization_satu_sehat_dto,SatuSehat::getResponse(),$satu_sehat);
        return collect($satu_sehat['entry']);
    }

    public function prepareFindOrganizationSatuSehat(?OrganizationSatuSehatData $organization_satu_sehat_dto = null): Model{
        $organization_satu_sehat_dto ??= $this->requestDTO(config('app.contracts.OrganizationSatuSehatData'));
        $satu_sehat = SatuSehat::get('Organization/'.$organization_satu_sehat_dto->params->id);
        $this->organization_satu_sehat_model = $this->logSatuSehat($organization_satu_sehat_dto,SatuSehat::getResponse(),$satu_sehat);
        return $this->organization_satu_sehat_model;
    }

    public function organizationSatuSehat(mixed $conditionals = null): Builder{
        return $this->satuSehatLog($conditionals);
    }
}