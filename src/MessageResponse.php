<?php
/**
 * Created by PhpStorm.
 * User: sonaa
 * Date: 4/5/17
 * Time: 3:25 PM
 */

namespace Ashrafi\SMSGateway;


use Ashrafi\SMSGateway\interfaces\iMessageResponse;

class MessageResponse implements iMessageResponse
{
    protected $status,$from,$to,$messageId,$extra,$result;

    /**
     * MessageResponse constructor.
     * @param $from
     * @param $to
     * @param null $messageId
     * @param bool|false $status
     * @param array $extra
     */
    public function __construct($from, $to, $messageId=null, $status=false, $extra=[])
    {
        $this->setFrom($from)->setTo($to)->setMessageId($messageId)->setStatus($status)->setExtra($extra);
    }

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
        $this->setResult($result);
        return $this;
    }

    function getResult()
    {
        return $this->result;
    }

    /**
     * @param $id
     * @return $this
     */
    function setMessageId($id)
    {
        $this->messageId=$id;
        return $this;
    }

    function getMessageId()
    {
        return $this->messageId;
    }

    /**
     * @param $from
     * @return $this
     */
    function setFrom($from)
    {
        $this->from=$from;
        return $this;
    }

    function getFrom()
    {
        return $this->from;
    }

    /**
     * @param $to
     * @return $this
     */
    function setTo($to)
    {
        $this->to=$to;
        return $this;
    }

    function getTo()
    {
        return $this->to;
    }

    /**
     * @param array $extra
     * @return $this
     */
    function setExtra($extra = [])
    {
        $this->extra=$extra;
        return $this;
    }

    function getExtra()
    {
        return $this->extra;
    }


}