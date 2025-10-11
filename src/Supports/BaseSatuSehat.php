<?php

namespace Hanafalah\SatuSehat\Supports;

use Hanafalah\LaravelSupport\Supports\PackageManagement;
use Hanafalah\SatuSehat\Concerns;
use Hanafalah\SatuSehat\Contracts\Supports\BaseSatuSehat as SupportsBaseSatuSehat;

class BaseSatuSehat extends PackageManagement implements SupportsBaseSatuSehat
{
    use Concerns\HasEnvironment;
    use Concerns\HasHost;
    use Concerns\HasHttpRequest;

    protected $__config_name = 'satu-sehat';
    protected $__satu_sehat_config = [];

    /**
     * A description of the entire PHP function.
     *
     * @param Container $app The Container instance
     * @throws Exception description of exception
     * @return void
     */
    public function __construct()
    {
        $this->setConfig($this->__config_name, $this->__satu_sehat_config);
        $this->setEnvironment();
        parent::__construct();
    }


}
