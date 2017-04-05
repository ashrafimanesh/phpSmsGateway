<?php
/**
 * Created by PhpStorm.
 * User: sonaa
 * Date: 4/5/17
 * Time: 10:24 AM
 */

namespace Ashrafi\SMSGateway\interfaces;


interface iSMSResponse extends iAtomResponse
{

    function addMessageResponse($from,$to,$messageId,$status,$extra=[]);
    function getMessagesResponse();

}