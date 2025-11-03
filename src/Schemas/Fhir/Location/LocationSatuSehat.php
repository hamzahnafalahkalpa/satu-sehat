<?php

namespace Hanafalah\SatuSehat\Schemas\Fhir\Location;

use Hanafalah\SatuSehat\Contracts\Data\Fhir\Location\LocationSatuSehatData;
use Hanafalah\SatuSehat\Contracts\Schemas\Fhir\Location\LocationSatuSehat as ContractsLocationSatuSehat;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\SatuSehat\Facades\SatuSehat;
use Hanafalah\SatuSehat\Schemas\OAuth2;
use Illuminate\Support\Collection;

class LocationSatuSehat extends OAuth2 implements ContractsLocationSatuSehat
{
    protected string $__entity = 'LocationSatuSehat';
    public $location_satu_sehat_model;
    protected array $__location_examples;
    //protected mixed $__order_by_created_at = false; //asc, desc, false

    protected array $__cache = [
        'index' => [
            'name'     => 'location_satu_sehat',
            'tags'     => ['location_satu_sehat', 'location_satu_sehat-index'],
            'duration' => 24 * 60
        ]
    ];

    public function prepareStoreLocationSatuSehat(LocationSatuSehatData $location_satu_sehat_dto): Model{
        $location = SatuSehat::store('Location',$location_satu_sehat_dto->form->payload->toArray());
        $this->location_satu_sehat_model = $this->logSatuSehat($location_satu_sehat_dto,SatuSehat::getResponse(),$location,SatuSehat::getPayload());
        return $this->location_satu_sehat_model;
    }

    public function prepareViewLocationSatuSehatList(?LocationSatuSehatData $location_satu_sehat_dto = null): Collection{
        $location_satu_sehat_dto ??= $this->requestDTO(config('app.contracts.LocationSatuSehatData'));
        $satu_sehat = SatuSehat::get('Location'.$location_satu_sehat_dto->params->query);
        $this->location_satu_sehat_model = $this->logSatuSehat($location_satu_sehat_dto,SatuSehat::getResponse(),$satu_sehat);
        return collect($satu_sehat['entry']);
    }

    public function prepareFindLocationSatuSehat(?LocationSatuSehatData $location_satu_sehat_dto = null): Model{
        $location_satu_sehat_dto ??= $this->requestDTO(config('app.contracts.LocationSatuSehatData'));
        $satu_sehat = SatuSehat::get('Location/'.$location_satu_sehat_dto->params->id);
        $this->location_satu_sehat_model = $this->logSatuSehat($location_satu_sehat_dto,SatuSehat::getResponse(),$satu_sehat);
        return $this->location_satu_sehat_model;
    }

    public function locationSatuSehat(mixed $conditionals = null): Builder{
        return $this->satuSehatLog($conditionals);
    }
}