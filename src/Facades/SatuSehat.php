<?php

namespace Hanafalah\SatuSehat\Facades;

class SatuSehat extends \Illuminate\Support\Facades\Facade
{
  /**
   * @see \Hanafalah\SatuSehat\Contracts\SatuSehat
   * @method mixed export(string $type)
   * @method mixed get(string $url)
   * @method mixed store(string $url)
   * @method mixed auth(string $url, array $payload, ?callable $on_success = null, ?callable $on_failed = null)
   * @method ?string getAccessToken()
   * @method self setAccessToken(string $token)
   */
  protected static function getFacadeAccessor()
  {
    return \Hanafalah\SatuSehat\Contracts\SatuSehat::class;
  }
}
