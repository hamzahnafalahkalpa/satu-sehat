<?php

namespace Hanafalah\SatuSehat\Schemas\Fhir\Practitioner;

use Hanafalah\SatuSehat\Contracts\Data\Fhir\Practitioner\PractitionerSatuSehatData;
use Hanafalah\SatuSehat\Contracts\Schemas\Fhir\Practitioner\PractitionerSatuSehat as ContractsPractitionerSatuSehat;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\SatuSehat\Facades\SatuSehat;
use Hanafalah\SatuSehat\Schemas\OAuth2;
use Illuminate\Support\Collection;

class PractitionerSatuSehat extends OAuth2 implements ContractsPractitionerSatuSehat
{
    protected string $__entity = 'PractitionerSatuSehat';
    public $practitioner_satu_sehat_model;
    protected array $__practitioner_examples;
    //protected mixed $__order_by_created_at = false; //asc, desc, false

    protected array $__cache = [
        'index' => [
            'name'     => 'practitioner_satu_sehat',
            'tags'     => ['practitioner_satu_sehat', 'practitioner_satu_sehat-index'],
            'duration' => 24 * 60
        ]
    ];

    public function prepareStorePractitionerSatuSehat(PractitionerSatuSehatData $practitioner_satu_sehat_dto): Model{
        $practitioner = SatuSehat::store('Practitioner',$practitioner_satu_sehat_dto->form->payload->toArray());
        $this->practitioner_satu_sehat_model = $this->logSatuSehat($practitioner_satu_sehat_dto,SatuSehat::getResponse(),$practitioner,SatuSehat::getPayload());
        return $this->practitioner_satu_sehat_model;
    }

    public function prepareViewPractitionerSatuSehatList(?PractitionerSatuSehatData $practitioner_satu_sehat_dto = null): Collection{
        $practitioner_satu_sehat_dto ??= $this->requestDTO(config('app.contracts.PractitionerSatuSehatData'));
        $satu_sehat = SatuSehat::get('Practitioner'.$practitioner_satu_sehat_dto->params->query);
        $this->practitioner_satu_sehat_model = $this->logSatuSehat($practitioner_satu_sehat_dto,SatuSehat::getResponse(),$satu_sehat);
        return collect($satu_sehat['entry']);
    }

    public function practitionerSatuSehat(mixed $conditionals = null): Builder{
        return $this->satuSehatLog($conditionals);
    }
}