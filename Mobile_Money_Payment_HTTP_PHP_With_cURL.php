<?php


//initialise the maximum execution time to 2 minutes to allow the process to finish
ini_set('max_execution_time', 120); //120 seconds = 2 minutes



$url = "https://app.mpowerpayments.com/api/v1/direct-mobile/charge";

// $settings = parse_ini_file("sample.ini");

// $master_key = $settings["MP-Master-Key"];
// $private_key = $se
// $

// $api_version=$settings["slydepay.api_version"];


$data = array(
	'customer_name' => 'worla',  //this should be from the form that the user will fill, so using GET or POST to get the name
	'customer_phone' => '0546652999', //this should be from the form that the user will fill, so using GET or POST to get the name
	'customer_email' => 'winfredlen@gmail.com',
	'wallet_provider' => 'MTN',
	'merchant_name' => 'Creators Hub',
	'amount' => '1'
	 );

$data_string = json_encode($data);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,0);
curl_setopt($ch, CURLOPT_TIMEOUT, 400);
// curl_setopt($ch, CURLOPT_TIMEOUT, 20);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'Content-Type: application/json',
	'MP-Master-Key: arj67js7-g45n-1o1k-099t-5s7d8g8g0a73nx',
	'MP-Private-Key: live_private_Hri2vBoqen5alM9c_4IvbbBqweersdFGH',
	'MP-Token: 123asdt4ki85g12m9084r')
);


curl_setopt($ch, CURLOPT_HEADER, 0);




$result = (string)curl_exec($ch);

$json = $result;
$obj = json_decode($json);



/*
Due to the the nature of mobile money transactions, we need to get the token from the transaction 
to ascertain whether the transaction was succesful, pending or cancelled

*/

$token = $obj->{'token'};

print($token);

curl_close($ch);


//sleep for 60 seconds and give the user enough time to accept the transaction and enter their mobile money pi
sleep(60);






/*
after getting the token, we now use  the token to perform a new post request request

*/





$new_url = "https://app.mpowerpayments.com/api/v1/direct-mobile/status";

$new_data = array(
	'token' => $token
	 );

$new_data_string = json_encode($new_data);

$new_ch = curl_init($new_url);
curl_setopt($new_ch, CURLOPT_POST, 1);
curl_setopt($new_ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($new_ch, CURLOPT_POSTFIELDS, $new_data_string);
curl_setopt($new_ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($new_ch, CURLOPT_CONNECTTIMEOUT ,0);
curl_setopt($new_ch, CURLOPT_TIMEOUT, 400);
// curl_setopt($ch, CURLOPT_TIMEOUT, 20);
curl_setopt($new_ch, CURLOPT_HTTPHEADER, array(
	'Content-Type: application/json',
	'MP-Master-Key: arj67js7-g45n-1o1k-099t-5s7d8g8g0a73nx',
	'MP-Private-Key: live_private_Hri2vBoqen5alM9c_4IvbbBqweersdFGH',
	'MP-Token: 123asdt4ki85g12m9084r')
);


curl_setopt($new_ch, CURLOPT_HEADER, 0);




$new_result = (string)curl_exec($new_ch);


$new_json = $new_result;
$new_obj = json_decode($new_json);


$tx_status = $new_obj->{'tx_status'};

print($tx_status);


if ($tx_status == "complete"){echo "Weldone, you have successfully completed payment";}
else 
	echo "You either do not have enough funds in your account or you have not confirmed payment";
// else ($tx_status == "cancelled"){echo "Sorry, you have cancelled the transaction";}


curl_close($new_ch);
