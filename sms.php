<?php
use Infobip\Configuration;
use Infobip\Api\SmsApi;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;

require __DIR__ . "/vendor/autoload.php";

$message = "Attendance have Confirmed";
$phone = "250783818521";

$apiUrl = "6g2qx5.api.infobip.com";
$apiKey = "63ac68eb1fcb2241acc95012342b79eb-f3a42537-9439-440e-8d69-1f6c37a333f4";


$configuration = new Configuration(host: $apiUrl, apiKey: $apiKey);
$api = new SmsApi(config: $configuration);


$destination = new SmsDestination(to: $phone);

$themessage = new SmsTextualMessage(

destinations: [$destination],
text: $message,
from: "Fabrice pro"
); 

$request = new SmsAdvancedTextualRequest(messages: [$themessage]);
$response = $api->sendSmsMessage($request);

echo header("location:home.php");





?>