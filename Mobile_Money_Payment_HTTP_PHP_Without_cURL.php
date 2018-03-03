<?php
$data = array (
  	"customer_name" => "worla",
	"customer_phone" => "0546652999",
	"customer_email" => "winfredlen@gmail.com",
	"wallet_provider" => "MTN",
	"merchant_name" => "Creators Hub",
	"amount" => "1",
);


$url = "https://app.mpowerpayments.com/api/v1/direct-mobile/charge";

$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => "Content-Type: application/json\r\n" . "MP-Master-Key: arjx\r\n" . "MP-Private-Key: liveFGH\r\n" . "MP-Token: 12m9084r\r\n",
        'content' => json_encode($data)
    )
);
$context  = stream_context_create($opts);
$result = file_get_contents($url, false, $context);

var_dump($result);
?>
