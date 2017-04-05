<?php
/**
 * Created by PhpStorm.
 * User: sonaa
 * Date: 4/3/17
 * Time: 4:40 PM
 */

namespace Ashrafi\SMSGateway\interfaces;


interface iGateway
{
    function setConfig(iConfig $config);
    function send($to,$message,iSMSResponse $response,$from=null);
}