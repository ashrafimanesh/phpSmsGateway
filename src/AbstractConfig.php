<?php
/**
 * Created by PhpStorm.
 * User: sonaa
 * Date: 4/3/17
 * Time: 5:49 PM
 */

namespace Ashrafi\SMSGateway;


use Ashrafi\SMSGateway\interfaces\iConfig;

Abstract class AbstractConfig implements iConfig
{
    protected $handler,$configs,$from;

    /**
     * @param $handlerClass
     * @return $this
     */
    function setHandler($handlerClass)
    {
        $this->handler=$handlerClass;
        return $this;
    }

    /**
     * @param $configs
     * @return $this
     */
    function setConfigs($configs)
    {
        $this->configs=$configs;
        return $this;
    }
}