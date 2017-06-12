/*
* Rafael Piza
* rafael.piza@yahoo.com.br
* atualizado em: 03/10/2016
*/
$(document).ready(function(){
	var gerarInput = '';
	var container 	= $(".container");
	var load        = container.find(".load");
	var selectMes 	= container.find('#mes-referencia');
	var formFipe 	= container.find('#form-fipe');
	var tabDados    = container.find('.dados');
	load.hide();
	
	//quando clicar no Iniciar
	formFipe.on('click', '.iniciar', function(event){
		event.preventDefault();
		var dadosForm = $(formFipe).serialize();
		$.ajax({
			  url: "fipe.php",
			  type: "POST",
			  data: dadosForm,
			  beforeSend: function(){
				 load.show();
			  },
			  success: function(data){
				 load.hide();
				 alert('Processo terminado com sucesso!');
			  }
		});
	});
	
	//carrega o iput com os meses de referência
	$.ajax({
	  url: "mesReferencia.php",
      type: "GET",
	  datatype: 'json',
	  beforeSend: function(){
		 selectMes.html('<option value="0">Aguarde carregando...</option>'); 
	  },
      success: function(data){
		$.each(data, function(i, item) {
			gerarInput += '<option value="'+data[i].Codigo+'">'+data[i].Mes+'</option>';
		})
		selectMes.html(gerarInput);     
      }
	});

	setInterval(function(){
		$.ajax({
		  url: "carregarDados.php",
		  type: "GET",
		  beforeSend: function(){
			
		  },
		  success: function(data){
			tabDados.html(data);     
		  }
		});
	}, 5000);
	
});


