<?php

namespace Ashrafi\SMSGateway\Gateways;
use Ashrafi\PhpConnectors\ConnectorFactory;
use Ashrafi\PhpConnectors\CurlConnector;
use Ashrafi\SMSGateway\interfaces\iConfig;
use Ashrafi\SMSGateway\interfaces\iGateway;
use Ashrafi\SMSGateway\interfaces\iSMSResponse;

/**
 * Created by PhpStorm.
 * User: sonaa
 * Date: 4/3/17
 * Time: 5:45 PM
 */
class Kavenegar implements iGateway
{
    /**
     * @var KavenegarConfig
     */
    protected $config;

    /**
     * @param iConfig $config
     * @return $this
     */
    function setConfig(iConfig $config)
    {
        $this->config=$config;
        return $this;
    }

    function send($to, $message,iSMSResponse $response, $from = null)
    {
        $data = array(
            "receptor" => $to,
            "sender" => $from ? $from : $this->config->getFrom(),
            "message" => $message,
            "date" => null,
            "type" => 1,
            "localid" => null
        );
        $url=trim($this->config->getBaseUrl(),'/').'/'.$this->config->getApiKey().'/sms/send.json';

        $connector=ConnectorFactory::create(CurlConnector::class,$url,'','','');
        $result=json_decode($connector->run('',$data),JSON_UNESCAPED_UNICODE);

        $response->setResult($result);

        if(!isset($result['return']) || !isset($result['return']['status']) || !isset($result['entries'])){
            $response->setStatus(false);
        }
        else {
            if($result['return']['status']==200){
                foreach($result['entries'] as $entry){
                    $response->addMessageResponse($entry['sender'],$entry['receptor'],$entry['messageid'],$entry['status'],$entry);
                }
                $response->setStatus(true);
            }
            else{
                $response->setStatus(false);
            }
        }
    }


}