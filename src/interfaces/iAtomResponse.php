<?php
/**
 * Created by PhpStorm.
 * User: sonaa
 * Date: 4/5/17
 * Time: 3:15 PM
 */

namespace Ashrafi\SMSGateway\interfaces;


interface iAtomResponse
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