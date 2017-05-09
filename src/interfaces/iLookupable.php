<?php

namespace Ashrafi\SMSGateway\interfaces;

use Ashrafi\SMSGateway\interfaces\iSMSResponse;


interface iLookupable
{
	public function verify($to,$token,iSMSResponse $response);
}
