<?php
	$link='https://wa.otomat.web.id';
	$var['api_id'] = '2138';
	$var['api_key'] = 'SX83E5YPX43kmxtFaQbV9hJBw63D2yZo';
	$var['phone'] = '081210690690';
	$var['text'] = 'Hallo ini WA Otomatis';
	$ch = curl_init($link);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $var);
	$response = curl_exec($ch);
	curl_close($ch);
	var_dump($response);
?>