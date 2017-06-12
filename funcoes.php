<?php

function curl($url,$parametros = array()){

	//concatena os parametros
	$query_string = null;
	foreach($parametros as $key=>$value) { $query_string .= $key.'='.$value.'&'; }
	rtrim($query_string, '&');
	
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_POST, count($parametros));
	curl_setopt($ch,CURLOPT_POSTFIELDS, $query_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(	
		'Accept:application/json, text/javascript, */*; q=0.01',
		'Accept-Encoding:gzip, deflate',
		'Accept-Language:pt-BR,pt;q=0.8,en-US;q=0.6,en;q=0.4',
		'Connection:keep-alive',
		'Content-Type:application/x-www-form-urlencoded; charset=UTF-8',
		'Cookie:_ga=GA1.3.472052299.1466616166; _gat=1',
		'Host:veiculos.fipe.org.br',
		'Origin:http://veiculos.fipe.org.br',
		'Referer:http://veiculos.fipe.org.br/',
		'User-Agent:Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36',
		'X-Requested-With:XMLHttpRequest'
    ));
	//retorna o json
	$result = curl_exec($ch);
	curl_close($ch);
	
	return $result;
}
