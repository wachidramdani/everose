<?php
	#info API, bisa diganti sesuai data aslinya
	$api_id = '2138';
	$api_key = 'SX83E5YPX43kmxtFaQbV9hJBw63D2yZo';
	$api_server = 'https://wa.otomat.web.id';

	#info rekening
	$rekening = "BCA 12345\nMANDIRI\n123456";
	$menu = "Pilih Menu\n1. Minuman\n2. Cemilan";

	#memastikan request adalah dari WA gateway
	if(!isset($_REQUEST['from']) or !isset($_REQUEST['to'])) return; 

	#membuat request menjadi huruf kecil semua
	$body = trim(strtolower($_REQUEST['body']));

	/*switch($body):
	case "rek":
	case "rekening":
	$pesan_wa = $rekening;
	break;
	case "order":
	$pesan_wa = $menu;
	break;
	endswitch;*/
	
	$pesan_wa = print_r($_REQUEST, true);
	
	
	$json = file_get_contents('php://input');
    $data = json_decode($json,true);
    $jdata = print_r($data, true);
    
    //$pesan_wa = $jdata;

	#memastikan ada variabel $pesan_wa
	if(!isset($pesan_wa)) exit;

	$var['api_id'] = $api_id;
	$var['api_key'] = $api_key;
	$var['phone'] = "6281210690690";
	//$var['phone'] = $_REQUEST['from'];
	$var['text'] = $pesan_wa;
	$ch = curl_init($api_server);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $var);
	$response = curl_exec($ch);
	curl_close($ch);
	var_dump($response);
?>