```php

require_once __DIR__.'/vendor/autoload.php';

/**
 * Created by PhpStorm.
 * User: ashrafimanesh@gmail.com
 * Date: 4/3/17
 * Time: 5:05 PM
 */
$kavenegarConfig=new \Ashrafi\SMSGateway\Gateways\KavenegarConfig();

$kavenegarConfig->setFrom('xyz')->setApiKey('xyz');

$SMSGateway=\Ashrafi\SMSGateway\SMSGateway::getInstance(['kavenegar'=>$kavenegarConfig]);

echo '<pre>';
var_dump($SMSGateway->send('mobile number ','sms text'));

echo '<pre>';
var_dump($SMSGateway->kavenegar->send('mobile number ','sms text'));

echo '<pre>';
var_dump($SMSGateway->tryAll('mobile number ','sms text'));

```