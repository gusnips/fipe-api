<?php
/*
* Rafael Piza
* rafael.piza@yahoo.com.br
* atualizado em: 03/10/2016
*/
header('Content-Type: application/json');
require_once('funcoes.php');

//Código referência do mês atual
$urlMesReferencia = 'http://veiculos.fipe.org.br/api/veiculos/ConsultarTabelaDeReferencia';

$jsonMesReferencia 	= curl($urlMesReferencia);
$mesReferencia 	= ($jsonMesReferencia);
echo trim($mesReferencia);