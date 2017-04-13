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
        'header'  => "Content-Type: application/json\r\n" . "MP-Master-Key: arj67js7-g45n-1o1k-099t-5s7d8g8g0a73nx\r\n" . "MP-Private-Key: live_private_Hri2vBoqen5alM9c_4IvbbBqweersdFGH\r\n" . "MP-Token: 123asdt4ki85g12m9084r\r\n",
        'content' => json_encode($data)
    )
);
$context  = stream_context_create($opts);
$result = file_get_contents($url, false, $context);

var_dump($result);
?>
