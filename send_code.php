<?php

include "connection.php";

use Infobip\Configuration;
use Infobip\Api\SmsApi;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;

require __DIR__ . '/vendor/autoload.php';



if(isset($_POST["send"])){

    $number = $_POST["number"];

    $message = "reference id";
    
    $base_url = "https://5y3n9x.api.infobip.com";
    
    $api_key = "56c512eef79987f0fc5982fb9a800ba9-077c348c-b5f3-436f-aeed-01228e9e63e8";
    
    $configuration = new Configuration (host: $base_url, apiKey: $api_key);
    
    $api = new SmsApi(config: $configuration);
    
    $destination = new SmsDestination (to: $number);
    
    $message = new SmsTextualMessage (
    destinations: [$destination],
    text: $message
    );
    
    $request = new SmsAdvancedTextualRequest (messages: [$message]);

    $response = $api->sendSmsMessage($request);

    if ($response) {
      echo "Msg sent";
    }

}






?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    
<form method="post">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">number</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="number">
  </div>

  <button type="submit" class="btn btn-primary" name="send">send code</button>
</form>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>