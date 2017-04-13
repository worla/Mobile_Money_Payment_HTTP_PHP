<?php

ini_set('max_execution_time', 120); //300 seconds = 5 minutes


$url = "https://app.mpowerpayments.com/api/v1/direct-mobile/charge";

$data = array(
	'customer_name' => 'worla',
	'customer_phone' => '0546652999',
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
	'MP-Master-Key: ad5c6d67-3a32-40d0-944c-6beb0485d20c',
	'MP-Private-Key: live_private_Ldp6gVtf7dsG8Q_3UxmRejerYHM',
	'MP-Token: 576bfc8ad14a51e42309')
);


curl_setopt($ch, CURLOPT_HEADER, 0);




$result = (string)curl_exec($ch);

$json = $result;
$obj = json_decode($json);

// print $obj->{'token'};

$token = $obj->{'token'};

print($token);

// print_r($result);
curl_close($ch);

sleep(60);
















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
	'MP-Master-Key: ad5c6d67-3a32-40d0-944c-6beb0485d20c',
	'MP-Private-Key: live_private_Ldp6gVtf7dsG8Q_3UxmRejerYHM',
	'MP-Token: 576bfc8ad14a51e42309')
);


curl_setopt($new_ch, CURLOPT_HEADER, 0);




$new_result = (string)curl_exec($new_ch);


$new_json = $new_result;
$new_obj = json_decode($new_json);

// print $obj->{'token'};

$tx_status = $new_obj->{'tx_status'};

print($tx_status);

// print_r($new_obj);

if ($tx_status == "complete"){echo "Weldone, you have successfully completed payment";}
else 
	echo "You either do not have enough funds in your account or you have not confirmed payment";
// else ($tx_status == "cancelled"){echo "Sorry, you have cancelled the transaction";}


curl_close($new_ch);