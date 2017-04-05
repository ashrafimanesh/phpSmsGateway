<?php
/**
 * Created by PhpStorm.
 * User: sonaa
 * Date: 4/5/17
 * Time: 10:34 AM
 */

namespace Ashrafi\SMSGateway;


use Ashrafi\SMSGateway\interfaces\iSMSResponse;

class Response implements iSMSResponse
{
    protected $status,$result;
    protected $items=[];

    /**
     * @param $status
     * @return $this
     */
    function setStatus($status)
    {
        $this->status=$status;
        return $this;
    }

    function getStatus()
    {
        return $this->status;
    }

    /**
     * @param $result
     * @return $this
     */
    function setResult($result)
    {
        $this->result=$result;
        return $this;
    }

    function getResult()
    {
        return $this->result;
    }

    function addMessageResponse($from, $to, $messageId, $status, $extra = [])
    {
        $this->items[]=new MessageResponse($from,$to,$messageId,$status,$extra);
        return $this;
    }

    function getMessagesResponse()
    {
        return $this->items;
    }


}