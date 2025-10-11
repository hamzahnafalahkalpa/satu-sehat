<?php

namespace Hanafalah\SatuSehat\Facades;

class SatuSehat extends \Illuminate\Support\Facades\Facade
{
  /**
   * Get the registered name of the component.
   *
   * @return string
   */
  protected static function getFacadeAccessor()
  {
    return \Hanafalah\SatuSehat\Contracts\SatuSehat::class;
  }
}
