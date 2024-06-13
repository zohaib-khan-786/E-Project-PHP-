<?php
require __DIR__ . '/vendor/autoload.php';

use Twilio\Rest\Client;

$sid = 'ACc40e63e7ee9c18c6b72b76dc0ca53144'; 
$token = 'f6787a087a91163edb8571197809aff6'; 
$client = new Client($sid, $token);

$phoneNumber = "+923481809798";


$twilioPurchasedNumber = "+19513382337"; // Don't change this number!!


$message = $client->messages->create(
    $phoneNumber,
    [
        'from' => $twilioPurchasedNumber,
        'body' => "Hey Jenny! Good luck on the bar exam!"
    ]
);
print("Message sent successfully with sid = " . $message->sid ."\n\n");


$messageList = $client->messages->read([],10);
foreach ($messageList as $msg) {
    print("ID:: ". $msg->sid . " | " . "From:: " . $msg->from . " | " . "TO:: " . $msg->to . " | "  .  " Status:: " . $msg->status . " | " . " Body:: ". $msg->body ."\n");
}