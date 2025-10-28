<?php

namespace Hanafalah\SatuSehat\Schemas;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\SatuSehat\{
    Supports\BaseSatuSehat
};
use Hanafalah\SatuSehat\Contracts\Schemas\ObservationSatuSehat as ContractsObservationSatuSehat;
use Hanafalah\SatuSehat\Contracts\Data\ObservationSatuSehatData;

class ObservationSatuSehat extends BaseSatuSehat implements ContractsObservationSatuSehat
{
    protected string $__entity = 'ObservationSatuSehat';
    public $observation_satu_sehat_model;
    //protected mixed $__order_by_created_at = false; //asc, desc, false

    protected array $__cache = [
        'index' => [
            'name'     => 'observation_satu_sehat',
            'tags'     => ['observation_satu_sehat', 'observation_satu_sehat-index'],
            'duration' => 24 * 60
        ]
    ];

    public function prepareStoreObservationSatuSehat(ObservationSatuSehatData $observation_satu_sehat_dto): Model{
        $add = [
            'name' => $observation_satu_sehat_dto->name
        ];
        $guard  = ['id' => $observation_satu_sehat_dto->id];
        $create = [$guard, $add];
        // if (isset($observation_satu_sehat_dto->id)){
        //     $guard  = ['id' => $observation_satu_sehat_dto->id];
        //     $create = [$guard, $add];
        // }else{
        //     $create = [$add];
        // }

        $observation_satu_sehat = $this->usingEntity()->updateOrCreate(...$create);
        $this->fillingProps($observation_satu_sehat,$observation_satu_sehat_dto->props);
        $observation_satu_sehat->save();
        return $this->observation_satu_sehat_model = $observation_satu_sehat;
    }
}