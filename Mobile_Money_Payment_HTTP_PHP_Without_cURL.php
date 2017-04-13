<?php
$data = array (
  	"customer_name" => "worla",
	"customer_phone" => "0546652999",
	"customer_email" => "winfredlen@gmail.com",
	"wallet_provider" => "MTN",
	"merchant_name" => "Creators Hub",
	"amount" => "1",
);


// $method = "getCallDetails";
$url = "https://app.mpowerpayments.com/api/v1/direct-mobile/charge";

$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => "Content-Type: application/json\r\n" . "MP-Master-Key: ad5c6d67-3a32-40d0-944c-6beb0485d20c\r\n" . "MP-Private-Key: live_private_Ldp6gVtf7dsG8Q_3UxmRejerYHM\r\n" . "MP-Token: 576bfc8ad14a51e42309\r\n",
        'content' => json_encode($data)
    )
);
$context  = stream_context_create($opts);
$result = file_get_contents($url, false, $context);

var_dump($result);
?>

<form>
  First name:<br>
  <input type="text" name="firstname"><br>
  Last name:<br>
  <input type="text" name="lastname">
</form>