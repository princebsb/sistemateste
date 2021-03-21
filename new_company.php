<?php include 'db_connect.php';

?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://rawgit.com/RobinHerbots/Inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="js/jquery.validate.min.js"></script>
	   
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<h4>Empresas</h4>
			</div>
			<div class="card-body">
				<form action="" id="post">

					<div class="col-md-12">
						<div class="row">
							<div class="form-group col-md-5">
								<div class="item-row" id="list">	
								<label class="control-label" for="nu_cnpj_temp">Digite o CNPJ (Somente números)</label>
								<input type="text" class="form-control text-left" step="any" id="nu_cnpj_temp" name="nu_cnpj_temp" onblur="validaCpfCnpj(this.value)"><div id="alert"></div><br>
								<input type="hidden" id="nu_cnpj" name="nu_cnpj">
								
								<label class="control-label" for="sg_uf">Estado</label>
								<select id="sg_uf" name="sg_uf" class="custom-select">
								<option value="">SELECIONE</option>
								<option value="AC">Acre</option>
								<option value="AL">Alagoas</option>
								<option value="AP">Amapá</option>
								<option value="AM">Amazonas</option>
								<option value="BA">Bahia</option>
								<option value="CE">Ceará</option>
								<option value="DF">Distrito Federal</option>
								<option value="ES">Espírito Santo</option>
								<option value="GO">Goiás</option>
								<option value="MA">Maranhão</option>
								<option value="MT">Mato Grosso</option>
								<option value="MS">Mato Grosso do Sul</option>
								<option value="MG">Minas Gerais</option>
								<option value="PA">Pará</option>
								<option value="PB">Paraíba</option>
								<option value="PR">Paraná</option>
								<option value="PE">Pernambuco</option>
								<option value="PI">Piauí</option>
								<option value="RJ">Rio de Janeiro</option>
								<option value="RN">Rio Grande do Norte</option>
								<option value="RS">Rio Grande do Sul</option>
								<option value="RO">Rondônia</option>
								<option value="RR">Roraima</option>
								<option value="SC">Santa Catarina</option>
								<option value="SP">São Paulo</option>
								<option value="SE">Sergipe</option>
								<option value="TO">Tocantins</option>
								</select><br><br>

								<label class="control-label" for="no_fantasia">Nome Fantasia</label>
								<input type="text" class="form-control text-left" step="any" id="no_fantasia" name="no_fantasia">

							</div>
							</div>
								
						</div>

						<hr>

						<div class="row">
							 <button type="button" class="btn btn-primary btn-sm btn-block float-right" id='submit' onclick="$('#post').submit()">Gravar</button>
						</div>
					</div>

				</form>
			</div>
			
		</div>
	</div>
</div>

<style type="text/css">
	#tr_clone{
		display: none;
	}
	td{
		vertical-align: middle;
	}
	td p {
		margin: unset;
	}
	td input[type='number']{
		height: calc(100%);
		width: calc(100%);

	}
	input[type=number]::-webkit-inner-spin-button, 
	input[type=number]::-webkit-outer-spin-button { 
	  -webkit-appearance: none; 
	  margin: 0; 
	}
	.Holidays a{
		background-color: gray !important; 
	}
	.nonbusiness a{
		background-color: red !important; 
	}
	.ui-datepicker-week-end a {
		background-color: green !important; 
	}	

	#alert {
		display: none;
		font-family:Tahoma,Geneva,Arial,sans-serif;font-size:12px;
		font-weight: bold;
		position: relative;
		padding-top: 0px;
		color: #FF5252;
	}

	.alert-error {
		color:#FF5252;
	}

	.alert-success {
		background: #0f9d58;
	}
	
</style>
<script>
	$("input[id*='nu_cnpj_temp']").inputmask({
	    mask: ['99.999.999/9999-99'],
	  keepStatic: true
	});	

	function mask(o, f) {
	  setTimeout(function() {
		var v = mphone(o.value);
		if (v != o.value) {
		  o.value = v;
		}
	  }, 1);
	}
	
	function mphone(v) {
	  var r = v.replace(/\D/g, "");
	  r = r.replace(/^0/, "");
	  if (r.length > 10) {
		r = r.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
	  } else if (r.length > 5) {
		r = r.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
	  } else if (r.length > 2) {
		r = r.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
	  } else {
		r = r.replace(/^(\d*)/, "($1");
	  }
	  return r;
	}
	
	function validaCpfCnpj(cpfcnpj){
		var cpfcnpj = cpfcnpj.replace(/[^\d]+/g,'')
		$('#nu_cnpj').val(cpfcnpj);
		isCnpj(cpfcnpj);
		
		
	$("#nu_cnpj_temp").blur(function(){
		$.ajax({
			url: 'dados/cnpj.php?cnpj='+$("#nu_cnpj").val(),
			dataType: 'json',
			success: function(resposta){

				if(resposta.status == "ERROR"){
					//alert(resposta.message + "\nPor favor, digite os dados manualmente.");
					return false;
				}
				$("#post #sg_uf").val(resposta.uf);

				if(resposta != null){
					$("#post #no_fantasia").val(resposta.fantasia);
				}else{
					$("#post #no_fantasia").val(resposta.nome);
				}				
			}
		});
	});		
		
		
	}	
	
	function isCnpj(cnpj) {

        if (cnpj.length != 14){
			showAlert('error', 'CPF ou CNPJ inválido');	
			
            return false;
		}
		
        if (cnpj == "00000000000000" ||
            cnpj == "11111111111111" ||
            cnpj == "22222222222222" ||
            cnpj == "33333333333333" ||
            cnpj == "44444444444444" ||
            cnpj == "55555555555555" ||
            cnpj == "66666666666666" ||
            cnpj == "77777777777777" ||
            cnpj == "88888888888888" ||
            cnpj == "99999999999999"){
			showAlert('error', 'CPF ou CNPJ inválido');	
			//$("#post #nu_cnpj_temp").focus().select();
		
            return false;
			}


        tamanho = cnpj.length - 2
        numeros = cnpj.substring(0, tamanho);
        digitos = cnpj.substring(tamanho);
        soma = 0;
        pos = tamanho - 7;
        for (i = tamanho; i >= 1; i--) {
            soma += numeros.charAt(tamanho - i) * pos--;
            if (pos < 2)
                pos = 9;
        }
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(0))
			showAlert('error', 'CPF ou CNPJ inválido');
			//$("#post #nu_cnpj_temp").focus().select();
            return false;

        tamanho = tamanho + 1;
        numeros = cnpj.substring(0, tamanho);
        soma = 0;
        pos = tamanho - 7;
        for (i = tamanho; i >= 1; i--) {
            soma += numeros.charAt(tamanho - i) * pos--;
            if (pos < 2)
                pos = 9;
        }
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;

        if (resultado != digitos.charAt(1)){
            return false;
		}

        return true;

 	}
	

	function showAlert(type, message) {
		if (message !== '') {
			if (type === '') {
				type = 'success';
			}
			$('#alert').removeClass();
			$('#alert').addClass('alert-' + type).html(message).slideDown();
			setTimeout("closeAlert()", 3000);
			$('#nu_cnpj').val('');
			$('#nu_cnpj').focus();				
			
		}
	}
	
	
	$(function () {
		$('#alert').click(function () {
			closeAlert();
		});
	});

	function closeAlert() {
		$('#alert').slideUp();
		$('#alert').removeClass();
	}	
		
	

	$('#post').submit(function(e){
		//alert($(this).serialize())
		
		e.preventDefault()
		start_load()



		
		$.ajax({
			url:'ajax.php?action=save_company',
		    method: 'POST',
		    data: $(this).serialize(),
			success:function(resp){
				if(resp > 0){
					end_load()
					alert_toast("Dados gravados",'success')
				    setInterval(function () {
				      self.location='index.php?page=companies'
				    }, 3000);					
					

				}else{
					end_load()
					alert_toast("Erro na gravação",'danger')
					
				}
				
			}
		})
	})
	$( function() {
		$("#date_updated").datepicker({
			dateFormat: 'dd-mm-yy',
			minDate: new Date(),
			dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
			dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
			dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
			monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
			monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
			nextText: 'Próximo',
			prevText: 'Anterior',
			constrainInput: true,
			beforeShowDay: noWeekendsOrHolidays
		}).attr('readonly', 'readonly');;
	});	
	
	
	var disabledDays = ["11-2-2020","11-15-2020","12-25-2020","1-1-2021","2-15-2021","2-16-2021","2-17-2021","4-2-2021","4-21-2021","5-1-2021","6-3-2021","9-7-2021","10-12-2021","11-2-2021","11-15-2021","12-25-2021"];

	
	function nationalDays(date) {
		var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();
		for (i = 0; i < disabledDays.length; i++) {
			if($.inArray((m+1) + '-' + d + '-' + y,disabledDays) != -1 || new Date() > date) {
				return [false];
			}
		}
		return [true];
	}
	function noWeekendsOrHolidays(date) {
		var noWeekend = jQuery.datepicker.noWeekends(date);
		return noWeekend[0] ? nationalDays(date) : noWeekend;
	}

	
</script>

<script type="text/javascript">

</script>
<script>

	$("#post").validate({
		   debug: true
		   rules : {
				 nu_cnpj_temp:{
						required:true,
						minlength:3,
						maxlength:18,
				 },
				 sg_uf:{
						required:true
				 },
				 no_fantasia:{
						required:true
				 }                                
		   },

		   messages:{
				 nu_cnpj_temp:{
						required:"Informe o CNPJ",
						minlength:"O CNPJ deve ter pelo menos 3 números",
						maxlength:"O CNPJ deve ter no máximo 18 números"
				 },
				 sg_uf:{
						required:"Informe o Estado"
				 },
				 no_fantasia:{
						required:"Informe o Nome Fantasia"
				 }  
				 
		   }

	});
</script>
