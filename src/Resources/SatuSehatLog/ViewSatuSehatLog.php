<?php

namespace Hanafalah\SatuSehat\Resources\SatuSehatLog;

use Hanafalah\LaravelSupport\Resources\ApiResource;

class ViewSatuSehatLog extends ApiResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
   */
  public function toArray(\Illuminate\Http\Request $request): array
  {
    $arr = [
      'id' => $this->id,
      'name' => $this->name,
      'payload' => $this->getOriginal('props')
    ];
    return $arr;
  }
}
