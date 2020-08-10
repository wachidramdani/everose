<?php

	$url = "https://api.maytapi.com/api/429bf263-bff3-437f-ad99-4fa4c0d383fc/4186/sendMessage";
	//$url = "https://api.maytapi.com/api/429bf263-bff3-437f-ad99-4fa4c0d383fc/product";
	$header = array (
			"accept: application/json",
			"x-maytapi-key: 908a82b1-1fce-4283-be06-86115100bea3",
			"content-type: application/json"
		);
		
	$json = file_get_contents('php://input');
    $data = json_decode($json,true);
    $var = print_r($data, true);
    
	$data = json_encode(array(
		"to_number" => "6281210690690",
		"type" => "text",
		"message" => $var
	));
	
	//print_r($data);exit;
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_POST,true); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
	$head = curl_exec($ch);
	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	echo $head;
	curl_close($ch); 
?>