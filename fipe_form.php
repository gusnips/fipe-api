<!--
* Rafael Piza
* rafael.piza@yahoo.com.br
* atualizado em: 03/10/2016
-->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FIPE</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="bootstrap/font-awesome/css/font-awesome.min.css">
  </head>
  <body>
     <div class="container">
      <div class="masthead">
        <h3 class="text-muted">Fipe</h3>
      </div>
      <div class="jumbotron">
        <form id="form-fipe">
		  <div class="form-group">
			<label>Consultar por:</label>
			<select type="text" class="form-control" name="tipo">
				<option value="1">Carro</option>
				<option value="2">Moto</option>
				<option value="3">Caminhão / Ônibus</option>
			</select>
		  </div>
		 <div class="form-group">
			<label>Mês de Referência</label>
			<select type="text" class="form-control" id="mes-referencia" name="mes">
			</select>
		  </div>
		  <button type="submit" class="btn btn-default btn-success iniciar"><i class="fa fa-cloud-download" aria-hidden="true"></i> Iniciar</button>
		</form>
		<div class="load text-center">
			<img src="img/ajax_load.gif" />
			<p>Processo iniciado...</p>
		</div>
      </div>
      <div class="row">
        <div class="col-lg-12 dados">
        </div>
      </div>
      <footer class="footer">
        <p>&copy; 2016</p>
      </footer>
    </div>
    <script src="js/jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/fipe.js"></script>
  </body>
</html>