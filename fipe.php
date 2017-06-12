<?php
/*
* Rafael Piza
* rafael.piza@yahoo.com.br
* atualizado em: 03/10/2016
*/
if($_POST){
	set_time_limit(0);
	require_once('fipe_con.php');
	require_once('funcoes.php');

	$tipo				= $_POST['tipo'];
	$mesReferencia 		= $_POST['mes']; 
	$urlMarcas 			= 'http://veiculos.fipe.org.br/api/veiculos/ConsultarMarcas';
	$urlModelos 		= 'http://veiculos.fipe.org.br/api/veiculos/ConsultarModelos';
	$urlAno 			= 'http://veiculos.fipe.org.br/api/veiculos/ConsultarAnoModelo';
	$urlValor 			= 'http://veiculos.fipe.org.br/api/veiculos/ConsultarValorComTodosParametros';
	echo $tipo;
		
		$mesReferenciaCodigo = $mesReferencia;
		$marcas = array(
						'codigoTabelaReferencia'	=> $mesReferenciaCodigo,
						'codigoTipoVeiculo'			=> $tipo
						);

		$retornoMarcas 	= curl($urlMarcas,$marcas);

		$fipeMarcas 	= json_decode($retornoMarcas);
		$totalMarcas 	= count($fipeMarcas);
		
			for($x=0;$x<=$totalMarcas-1;$x++){

				$codigoMarca 	= $fipeMarcas[$x]->Value;
				$nomeMarca 		= $fipeMarcas[$x]->Label;

				$modelos = array(
							'codigoTipoVeiculo'			=> $tipo,
							'codigoTabelaReferencia'	=> $mesReferenciaCodigo,
							'codigoModelo'				=> '',
							'codigoMarca'				=> $codigoMarca,
							'ano'						=> '',
							'codigoTipoCombustivel'		=> '',
							'anoModelo'					=> '',
							'modeloCodigoExterno'		=> ''
							);
				$retornoModelos = curl($urlModelos,$modelos);

				$fipeModelos 	= json_decode($retornoModelos);
				$totalModelos	= count($fipeModelos->Modelos);	
				for($y=0;$y<=$totalModelos-1;$y++){
					
					$codigoModelo 	= $fipeModelos->Modelos[$y]->Value;
					$nomeModelo 	= $fipeModelos->Modelos[$y]->Label;

					$ano = array(
								'codigoTipoVeiculo'				=>$tipo,
								'codigoTabelaReferencia'		=>$mesReferenciaCodigo,
								'codigoMarca'					=>$codigoMarca,
								'codigoModelo'					=>$codigoModelo,
								'ano'							=>'',
								'codigoTipoCombustivel'			=>'',
								'anoModelo'						=>'',
								'modeloCodigoExterno'			=>'',
								);
							$retornoAnos 	= curl($urlAno,$ano);
							$fipeAnos 		= json_decode($retornoAnos);
							$totalAnos		= count($fipeAnos);	
							
							for($z=0;$z<=$totalAnos-1;$z++){

								$codigoTipoCombustivel 	= explode('-',$fipeAnos[$z]->Value);
								$anoModelo				= explode('-',$fipeAnos[$z]->Value);

								$valor = array(
												'codigoTipoVeiculo'				=> $tipo,
												'codigoTabelaReferencia'		=> $mesReferenciaCodigo,
												'codigoModelo'					=> $codigoModelo,
												'codigoMarca'					=> $codigoMarca,
												'ano'							=> $fipeAnos[$z]->Value,
												'codigoTipoCombustivel'			=> $codigoTipoCombustivel[1],
												'anoModelo'						=> $anoModelo[0],
												'tipoConsulta'					=> 'Tradicional'
												);
												

								$retornoValor 	= curl($urlValor,$valor);
								
								$fipeValor 		= json_decode($retornoValor);
								$totalValor		= count($fipeValor);	

								for($k=0;$k<=$totalValor-1;$k++){
									$valorFipe 			= $fipeValor->Valor;
									$valorFipe			= str_replace('R$','',$valorFipe);
									$valorFipe			= str_replace('.','',$valorFipe);
									$valorFipe			= trim(str_replace(',','.',$valorFipe));
									$marcaFipe 			= trim($fipeValor->Marca);
									$modeloFipe 		= trim($fipeValor->Modelo);
									$anoModeloFipe 		= trim($fipeValor->AnoModelo);
									$combustivelFipe 	= trim($fipeValor->Combustivel);
									$codigoFipe 		= trim($fipeValor->CodigoFipe);
									$mesReferenciafipe 	= trim($fipeValor->MesReferencia);
									$tipoVeiculoFipe 	= trim($fipeValor->TipoVeiculo);

									gravarMarcas($codigoMarca,utf8_decode($nomeMarca),$tipoVeiculoFipe);
									gravarModelos($codigoModelo,$codigoMarca,$codigoFipe,utf8_decode($nomeModelo));
									gravarAno($codigoModelo,$codigoFipe,$anoModeloFipe,utf8_decode($combustivelFipe),$valorFipe);
									
								}		
							}	
				}
			}
}else{
		
		echo 'Execute o arquivo <b><a href="fipe_form.php">fipe_form.php</a></b>';
	
}

?>



