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
      'reference_type' => $this->reference_type,      
      'reference_id' => $this->reference_id,
      'api_resource' => [
        'status_code' => $this->status_code,
        'headers' => $this->headers,
        'params' => $this->params,
        'payload' => $this->payload,
        'response' => $this->response
      ]
    ];
    return $arr;
  }
}
