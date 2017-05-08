<?php

namespace Ashrafi\SMSGateway;
use Ashrafi\SMSGateway\interfaces\iConfig;
use Ashrafi\SMSGateway\interfaces\iGateway;
use Ashrafi\SMSGateway\interfaces\iLookupable;
use Ashrafi\SMSGateway\interfaces\iSMSResponse;

/**
 * Created by PhpStorm.
 * User: ashrafimanesh@gmail.com
 * Date: 4/3/17
 * Time: 4:09 PM
 */
class SMSGateway
{

    protected static $object=null;

    protected $using=null,$current=null,$to,$message,$from=null;

    /**
     * @var GatewayCollection
     */
    protected $collection;

    protected function __construct($configs){

    }

    public function __get($name){
        return $this->using($name);
    }

    /**
     *
     * @param $configs ['gatewayUniqueName1'=> iConfig configs ,...]
     * @return SMSGateway|null
     */
    public static function getInstance($configs){
        if(!self::$object){
            $smsGateway=new SMSGateway($configs);
            self::$object=$smsGateway;

            self::$object->setCollection(new GatewayCollection());
            array_walk($configs,[$smsGateway,'registerGateway']);
        }
        return self::$object;
    }

    /**
     * @param iConfig $configs
     * @param $gatewayUniqueName
     */
    protected function registerGateway(iConfig $configs,$gatewayUniqueName){
        $gateway=$configs->getHandler();
        if(is_string($gateway)){
            $gateway=new $gateway();
        }
        if(!($gateway instanceof iGateway)){
            throw new \InvalidArgumentException('Invalid Argument');
        }
        $gateway->setConfig($configs);
        $this->collection->add($gatewayUniqueName,$gateway);
    }

    public function using($gatewayUniqueName){
        $this->using=$gatewayUniqueName;
        return $this;
    }

    public function send($to,$message,$from=null){
        $collection = $this->getCollection();

        $this->current=$this->using ? $this->using : $collection->key();

        $gateway=$collection[$this->current];
        $response = new Response();
        return $this->_callSend($to, $message, $from, $gateway,$response);
    }


    public function verify($to,$token,$message=null){
        $collection = $this->getCollection();

        if( !is_string($token) || !is_array($token)  ){
            throw new \InvalidArgumentException('Invalid Argument');
        }        

        $this->current=$this->using ? $this->using : $collection->key();

        $gateway=$collection[$this->current];
        $response = new Response();
        return $this->_callVerify($to, $token, $message, $gateway,$response);
    }





    public function tryAll($to,$message,$from=null){
        $collection = $this->getCollection();
        $allResponse=[];
        foreach($collection as $key=>$gateway){
            $response = new Response();
            $response=$this->_callSend($to,$message,$from,$gateway,$response);
            $allResponse[]=$response;
            if($response->getStatus()){
                return $response;
            }
        }
        return $allResponse;
    }

    /**
     * @return GatewayCollection
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * @param GatewayCollection $collection
     * @return $this
     */
    public function setCollection(GatewayCollection $collection)
    {
        $this->collection = $collection;
        return $this;
    }

    /**
     * @param $to
     * @param $message
     * @param $from
     * @param $gateway
     * @param iSMSResponse $response
     * @return Response
     */
    protected function _callSend($to, $message, $from, $gateway,iSMSResponse $response)
    {
        if (!($gateway instanceof iGateway)) {
            throw new \InvalidArgumentException('Invalid config set at getInstance method');
        }
        $gateway->send($to, $message, $response, $from);
        return $response;
    }

    /**
     * @param $to
     * @param $token
     * @param $message
     * @param $gateway
     * @param iSMSResponse $response
     * @return Response
     */
    protected function _callVerify($to, $token, $message, $gateway,iSMSResponse $response)
    {
        if (!($gateway instanceof iGateway)) {
            throw new \InvalidArgumentException('Invalid config set at getInstance method');
        }
        if ($gateway instanceof iLookupable){
            $gateway->verify($to, $token, $response);
            return $response;
        }
        return $this->send($to, $message);

    }
}