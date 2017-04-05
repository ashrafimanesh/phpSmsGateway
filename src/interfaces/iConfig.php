<?php
/**
 * Created by PhpStorm.
 * User: sonaa
 * Date: 4/3/17
 * Time: 4:24 PM
 */

namespace Ashrafi\SMSGateway\interfaces;


interface iConfig
{
    function setHandler($handlerClass);

    /**
     * @return string|iGateway
     */
    function getHandler();

    function setConfigs($configs);

    function getConfigs();

    function setFrom($from);
    function getFrom();
}