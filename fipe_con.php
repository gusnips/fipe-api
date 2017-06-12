<?php
/*
* Rafael Piza
* rafael.piza@yahoo.com.br
* atualizado em: 03/10/2016
*/
function conectar(){

	$servidor = "localhost";
	$usuario  = "root";
	$senha    = "";
	$baseDados= "fipe";
	try{
		$pdo = new PDO("mysql:host=".$servidor.";dbname=".$baseDados,$usuario,$senha);
	}catch(PDOException $e){
		echo $e->getMessage();
	}
	return $pdo;
}

function gravarMarcas($codigoMarca,$nomeMarca,$tipo){

	try{

		$sql 				= "SELECT codigo_marca FROM
							   fp_marca
							   WHERE
							   codigo_marca = :codigo_marca";

		$procurarRegistro 	= conectar()->prepare($sql);
		$procurarRegistro->bindValue(":codigo_marca",$codigoMarca);
		$procurarRegistro->execute();

		if($procurarRegistro->rowCount() == 0){

			$sql				= "INSERT INTO fp_marca (codigo_marca,marca,tipo) VALUES
								   (:codigo_marca,:marca,:tipo)";
			$cadastrarMarca 	= conectar()->prepare($sql);
			$cadastrarMarca->bindValue(":codigo_marca",$codigoMarca,PDO::PARAM_INT);
			$cadastrarMarca->bindValue(":marca",$nomeMarca);
			$cadastrarMarca->bindValue(":tipo",$tipo);
			$cadastrarMarca->execute();

		}

	}catch(PDOException $e){
		return $e->getMessage();
	}

}

function gravarModelos($codigoModelo,$codigoMarca,$codigoFipe,$nomeModelo){
		try{

		$sql 				= "SELECT codigo_modelo FROM
							   fp_modelo
							   WHERE
							   codigo_modelo = :codigo_modelo";

		$procurarRegistro 	= conectar()->prepare($sql);
		$procurarRegistro->bindValue(":codigo_modelo",$codigoModelo);
		$procurarRegistro->execute();

		if($procurarRegistro->rowCount() == 0){

			$sql				= "INSERT INTO fp_modelo (codigo_modelo,codigo_marca,codigo_fipe,modelo) VALUES
							      (:codigo_modelo,:codigo_marca,:codigo_fipe,:modelo)";
			$cadastrarModelo 	= conectar()->prepare($sql);
			$cadastrarModelo->bindValue(":codigo_modelo",$codigoModelo,PDO::PARAM_INT);
			$cadastrarModelo->bindValue(":codigo_marca",$codigoMarca,PDO::PARAM_INT);
			$cadastrarModelo->bindValue(":codigo_fipe",$codigoFipe);
			$cadastrarModelo->bindValue(":modelo",$nomeModelo);
			$cadastrarModelo->execute();

		}

	}catch(PDOException $e){
		return $e->getMessage();
	}
}
function gravarAno($codigoModelo,$codigoFipe,$anoModeloFipe,$combustivelFipe,$valorFipe){
		try{
			$sql 				= "SELECT * FROM
								   fp_ano
								   WHERE
								   codigo_modelo = :codigo_modelo
								   AND
								   ano = :ano
								   AND
								   combustivel = :combustivel";

			$procurarRegistro 	= conectar()->prepare($sql);
			$procurarRegistro->bindValue(":codigo_modelo",$codigoModelo);
			$procurarRegistro->bindValue(":ano",$anoModeloFipe);
			$procurarRegistro->bindValue(":combustivel",$combustivelFipe);
			$procurarRegistro->execute();

			if($procurarRegistro->rowCount() == 0){
				$sql				= "INSERT INTO fp_ano (codigo_modelo,codigo_fipe,ano,combustivel,valor) VALUES
									  (:codigo_modelo,:codigo_fipe,:ano_modelo_fipe,:combustivel_fipe,:valor_fipe)";
				$cadastrarAno 	= conectar()->prepare($sql);
				$cadastrarAno->bindValue(":codigo_modelo",$codigoModelo,PDO::PARAM_INT);
				$cadastrarAno->bindValue(":codigo_fipe",$codigoFipe);
				$cadastrarAno->bindValue(":ano_modelo_fipe",$anoModeloFipe);
				$cadastrarAno->bindValue(":combustivel_fipe",$combustivelFipe);
				$cadastrarAno->bindValue(":valor_fipe",$valorFipe);
				$cadastrarAno->execute();

			}

	}catch(PDOException $e){
		return $e->getMessage();
	}
}


function listarDados(){

	try{

		$sql 				= "SELECT
									fp_marca.marca,
									fp_modelo.modelo,
									fp_modelo.codigo_fipe as cod_fipe,
									fp_ano.ano,
									fp_ano.combustivel,
									fp_ano.valor
								FROM fp_marca
								INNER JOIN  fp_modelo ON  fp_marca.codigo_marca = fp_modelo.codigo_marca
								INNER JOIN  fp_ano ON fp_modelo.codigo_modelo = fp_ano.codigo_modelo ORDER BY fp_ano.id_ano DESC LIMIT 10";

			$listarRegistro 	= conectar()->prepare($sql);
			$listarRegistro->execute();

			$tabela = '';
			$tabela .= '<div class="table-responsive">';
			$tabela .= '<table class="table table-striped table-bordered table-hover table-condensed">';
			$tabela .= '<thead>';
			$tabela .= '<tr>';
			$tabela .= '<th>Código Fipe</th>';
			$tabela .= '<th>Marca</th>';
			$tabela .= '<th>Modelo</th>';
			$tabela .= '<th>Ano</th>';
			$tabela .= '<th>Combustível</th>';
			$tabela .= '<th>Valor</th>';
			$tabela .= '</tr>';
			$tabela .= '</thead>';
			$tabela .= '<tbody>';

			while($d = $listarRegistro->fetch(PDO::FETCH_OBJ)){

				$tabela .= '<tr>';
				$tabela .= '<td class="text-center"><u>'.$d->cod_fipe.'</u></td>';
				$tabela .= '<td><b>'.utf8_encode($d->marca).'</b></td>';
				$tabela .= '<td>'.utf8_encode($d->modelo).'</td>';
				$tabela .= '<td class="text-center"><i>'.($d->ano).'</i></td>';
				$tabela .= '<td class="text-center"><span class="badge">'.utf8_encode($d->combustivel).'</span></td>';
				$tabela .= '<td class="text-center"><span class="label label-success">R$ '.number_format($d->valor,2,',','.').'</span></td>';
				$tabela .= '</tr>';

			}

			$tabela .= '</tbody>';
			$tabela .= '</table>';
			$tabela .= '</div>';



		return $tabela;


	}catch(PDOException $e){
		return $e->getMessage();
	}

}
?>
