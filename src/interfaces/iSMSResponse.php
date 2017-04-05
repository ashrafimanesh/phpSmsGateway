<?php
/**
 * Created by PhpStorm.
 * User: sonaa
 * Date: 4/5/17
 * Time: 10:24 AM
 */

namespace Ashrafi\SMSGateway\interfaces;


interface iSMSResponse
{
    /**
     * @param $status
     * @return $this
     */
    function setStatus($status);
    function getStatus();

    /**
     * @param $result
     * @return $this
     */
    function setResult($result);
    function getResult();
}