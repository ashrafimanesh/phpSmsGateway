<?php
/**
 * Created by PhpStorm.
 * User: sonaa
 * Date: 4/5/17
 * Time: 3:14 PM
 */

namespace Ashrafi\SMSGateway\interfaces;



interface iMessageResponse extends iAtomResponse
{
    /**
     * @param $id
     * @return $this
     */
    function setMessageId($id);
    function getMessageId();

    /**
     * @param $from
     * @return $this
     */
    function setFrom($from);
    function getFrom();

    /**
     * @param $to
     * @return $this
     */
    function setTo($to);
    function getTo();

    /**
     * @param array $extra
     * @return $this
     */
    function setExtra($extra=[]);
    function getExtra();

}