<?php include 'db_connect.php';
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="js/moment.js"></script>
<script src="https://rawgit.com/RobinHerbots/Inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<h4>Fornecedores</h4>
			</div>
			<div class="card-body">
				<form action="" id="post">

					<div class="col-md-12">
						<div class="row">
							<div class="form-group col-md-5">
								<div class="row">
									<div class="form-group col-md-5">
									
										<label class="control-label">Empresa</label>
										<select name="co_empresa" id="co_empresa" class="custom-select" >
											<option value="" selected=""></option>
										<?php 

										$customer = $conn->query("SELECT * FROM tb_empresa order by no_fantasia asc");
										while($row=$customer->fetch_assoc()):
										?>
											<option value="<?php echo $row['co_empresa'] ?>"><?php echo $row['no_fantasia'] ?></option>
										<?php endwhile; ?>
										</select>
									</div>
								</div>
								<label class="control-label" for="nu_cpf_cnpj">Digite o CNPJ ou CPF</label>
								<input class="form-control text-left" step="any" id="nu_cpf_cnpj_temp" name="nu_cpf_cnpj_temp" placeholder="CPF ou CNPJ" onblur="validaCpfCnpj(this.value)"><div id="alert"></div><br>								
								<input type="hidden" id="nu_cpf_cnpj" name="nu_cpf_cnpj">
								<input type="hidden" id="sg_uf" name="sg_uf">
								<input type="hidden" id="sg_uf_pj" name="sg_uf_pj">
								
								
								<label class="control-label" for="no_fornecedor">Nome Fornecedor</label>
								<input type="text" class="form-control text-left" step="any" id="no_fornecedor" name="no_fornecedor"><br>


								<div id="pjm" style="display:none">
								<label class="control-label" for="nu_im">Inscrição Municipal</label>
								<input type="text" class="form-control text-left" step="any" id="nu_im" name="nu_im">							
								</div>
								<div id="pje" style="display:none">
								<label class="control-label" for="nu_ie">Inscrição Estadual</label>
								<input type="text" class="form-control text-left" step="any" id="nu_ie" name="nu_ie">	
								</div>



								<div id="pf" style="display:none">
								<label class="control-label" for="nu_rg">RG</label>
								<input type="text" class="form-control text-left" step="any" id="nu_rg" name="nu_rg"><br>							

								<label class="control-label" for="dt_nascimento_temp">Data Nascimento</label>
								<input type="text" class="form-control text-left" step="any" id="dt_nascimento_temp" name="dt_nascimento_temp" onblur="veficaDataNascimento(this.value)">	
								<input type="hidden" id="dt_nascimento" name="dt_nascimento">								
								<div id="alert1"></div>
								</div><br>
								
									<div id="dateShow" >
										<label for="date_updated">Data Cadastro</label><br>
										<input id="dt_cadastro_temp" name="dt_cadastro_temp" type="text" value="<?php echo  date('d/m/Y');?>" class="form-control text-left" disabled>
										<input type="hidden" id="dt_cadastro" name="dt_cadastro" value="<?php echo  date('Y-m-d');?>">
									</div><br>
								<label class="control-label" for="nu_telefone">Telefone</label>
								<div class="input_fields_wrap">									
									<div><input type="text" name="nu_telefone[]" id="nu_telefone[]" class="form-control text-left" step="any" onkeypress="mask(this, mphone);"></div><br>
									<button class="col-md-3 float-left btn btn-primary btn-sm" id="new_telephone" class="add_field_button"><i class="fa fa-plus"></i> Adicionar Telefone</button><br>
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
	
</style>
<script>

	$('#post').submit(function(e){
		//alert($(this).serialize())
		e.preventDefault()
		start_load()

		$.ajax({
			url:'ajax.php?action=save_supplier',
		    method: 'POST',
		    data: $(this).serialize(),
			success:function(resp){
				if(resp > 0){
					end_load()
					alert_toast("Dados gravados",'success')
				    setInterval(function () {
				      self.location='index.php?page=supplier'
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
	
	$("input[id*='nu_cpf_cnpj']").inputmask({
	  mask: ['999.999.999-99', '99.999.999/9999-99'],
	  keepStatic: true
	});	
	
	$("input[id*='dt_nascimento_temp']").inputmask({
	  mask: ['99/99/9999'],
	  keepStatic: true
	});
	

	
	function validaCpfCnpj(cpfcnpj){
		var cpfcnpj = cpfcnpj.replace(/[^\d]+/g,'')
		$('#nu_cpf_cnpj').val(cpfcnpj);
		if(cpfcnpj.length <= 11){	
			$('#pf').show();
			$('#pjm').hide();
			$('#pje').hide();			
			$('#nu_rg').focus();
			isCpf(cpfcnpj);
		}else{
			$('#pf').hide();
			isCnpj(cpfcnpj);
		}	
	}
	
		
	function veficaDataNascimento(data){
		var dia  = data.split("/")[0];
		var mes  = data.split("/")[1];
		var ano  = data.split("/")[2];
		var anoAtual = new Date().getFullYear();
		var contaDif = (anoAtual - ano)


		dataFormatada = ano + '-' + ("0"+mes).slice(-2) + '-' + ("0"+dia).slice(-2);
		$('#dt_nascimento').val(dataFormatada)	
		if ($('#post #sg_uf').val() == "PR" && contaDif < 18 ){
			showAlert2('error', 'Idade menor que 18 anos.');	
		}
		
	}	
		
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
	
	
	function isCpf(cpf) {
		exp = /\.|-/g;
		cpf = cpf.toString().replace(exp, "");
		var digitoDigitado = eval(cpf.charAt(9) + cpf.charAt(10));
		var soma1 = 0,
				soma2 = 0;
		var vlr = 11;
		for (i = 0; i < 9; i++) {
			soma1 += eval(cpf.charAt(i) * (vlr - 1));
			soma2 += eval(cpf.charAt(i) * vlr);
			vlr--;
		}
		soma1 = (((soma1 * 10) % 11) === 10 ? 0 : ((soma1 * 10) % 11));
		soma2 = (((soma2 + (2 * soma1)) * 10) % 11);
		if (cpf === "11111111111" || cpf === "22222222222" || cpf === "33333333333" || cpf === "44444444444" || cpf === "55555555555" || cpf === "66666666666" || cpf === "77777777777" || cpf === "88888888888" || cpf === "99999999999" || cpf === "00000000000") {
			var digitoGerado = null;
		} else {
			var digitoGerado = (soma1 * 10) + soma2;
		}
		if (digitoGerado !== digitoDigitado) {
			showAlert('error', 'CPF ou CNPJ inválido');	
			$('#pf').hide();			
			return false;
		}
		return true;
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
			$('#nu_cpf_cnpj').val('');
			$('#nu_cpf_cnpj').focus();				
			
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
	
	function showAlert2(type, message) {
		if (message !== '') {
			if (type === '') {
				type = 'success';
			}
			$('#alert1').removeClass();
			$('#alert1').addClass('alert-' + type).html(message).slideDown();
			setTimeout("closeAlert2()", 4000); 
			$('#dt_nascimento_temp').val('');
			$('#dt_nascimento_temp').focus();
			return false;
			
		}
	}
	

	$(function () {
		$('#alert1').click(function () {
			closeAlert2();
		});
	});

	function closeAlert2() {
		$('#alert1').slideUp();
		$('#alert1').removeClass();
	}


	$(document).ready(function() {
		var max_fields      = 5;
		var wrapper   		= $(".input_fields_wrap");
		var add_button      = $("#new_telephone");
		
		var x = 1;
		$(add_button).click(function(e){
			e.preventDefault();
			if(x < max_fields){
				x++;
				$(wrapper).append('<br><div><input type="text" class="form-control text-left" step="any" name="nu_telefone[] id="nu_telefone[]" onkeypress="mask(this, mphone);" /><a href="#" class="remove_field">Remover</a></div>');
			}
		});
		
		$(wrapper).on("click",".remove_field", function(e){
			e.preventDefault(); $(this).parent('div').remove(); x--;
		})
	});


		$("#co_empresa").change(function(){
			$.ajax({
				url: 'dados/empresa.php?codigo='+$("#co_empresa").val(),
				dataType: 'json',
				success: function(resposta){
					$("#post #sg_uf").val(resposta);
				}
			});
		});


		$("#nu_cpf_cnpj_temp").blur(function(){
			$.ajax({
				url: 'dados/cnpj.php?cnpj='+$("#nu_cpf_cnpj_temp").val(),
				dataType: 'json',
				success: function(resposta){
					if(resposta.status == "ERROR"){
						//alert(resposta.message + "\nPor favor, digite os dados manualmente.");
						//$("#post #nu_cpf_cnpj_temp").focus().select();
						return false;
					}
					$("#post #sg_uf_pj").val(resposta.uf);					

					if(resposta != null){
						$("#post #no_fornecedor").val(resposta.fantasia);
					}else{
						$("#post #no_fornecedor").val(resposta.nome);
					}	

					
					if ($('#sg_uf_pj').val() == "DF"){
						$('#pjm').hide();
						$('#pje').show();
					}else{
						$('#pje').hide();
						$('#pjm').show();
					}					
				}
			});
		});	


	
</script>

<style>

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