<?php

namespace Hanafalah\SatuSehat\Schemas;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\SatuSehat\{
    Supports\BaseSatuSehat
};
use Hanafalah\SatuSehat\Contracts\Schemas\Encounter as ContractsEncounter;
use Hanafalah\SatuSehat\Contracts\Data\EncounterData;

class Encounter extends BaseSatuSehat implements ContractsEncounter
{
    protected string $__entity = 'Encounter';
    public $encounter_model;
    //protected mixed $__order_by_created_at = false; //asc, desc, false

    protected array $__cache = [
        'index' => [
            'name'     => 'encounter',
            'tags'     => ['encounter', 'encounter-index'],
            'duration' => 24 * 60
        ]
    ];

    public function prepareStoreEncounter(EncounterData $encounter_dto): Model{
        $add = [
            'name' => $encounter_dto->name
        ];
        $guard  = ['id' => $encounter_dto->id];
        $create = [$guard, $add];
        // if (isset($encounter_dto->id)){
        //     $guard  = ['id' => $encounter_dto->id];
        //     $create = [$guard, $add];
        // }else{
        //     $create = [$add];
        // }

        $encounter = $this->usingEntity()->updateOrCreate(...$create);
        $this->fillingProps($encounter,$encounter_dto->props);
        $encounter->save();
        return $this->encounter_model = $encounter;
    }
}