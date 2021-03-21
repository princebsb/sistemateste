<?php
date_default_timezone_set('America/Sao_Paulo');	
date_default_timezone_set('UTC');
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
$hoje = utf8_encode(strftime('%A, %d/%m/%Y', strtotime('today')));
$mes = utf8_encode(strftime('%B', strtotime('today')));
?>
<html lang="pt-br">
<style>
   
</style>

<div>

	<div class="row">
		<div class="col-lg-12">
			
		</div>
	</div>

	<div class="row mt-3 ml-3 mr-3">
			<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
				<?php echo "Olá, ".$_SESSION['login_name']."!"  ?>
									
				</div>
				<hr>
				<div class="alert alert-success col-md-4 ml-4">
					<p><b><large>TOTAL DE EMPRESAS<br><?php echo $hoje; ?></large></b></p>
				<hr>
					<p class="text-right"><b><large><?php 

					
					include 'db_connect.php';
					$sales = $conn->query("SELECT count(*) as totalEmpresa from tb_empresa ");
					echo $sales->num_rows > 0 ? number_format($sales->fetch_array()['totalEmpresa'],0, ',', '.') : "0";
	
					 ?></large></b></p>
				</div>

				<div class="alert alert-success col-md-4 ml-4">
					<p><b><large>TOTAL DE FORNECEDORES <br><?php echo ($mes); ?></large></b></p>
				<hr>
					<p class="text-right"><b><large><?php 

					$sales = $conn->query("SELECT count(*) as totalFornecedor from tb_fornecedor");
					echo $sales->num_rows > 0 ? number_format($sales->fetch_array()['totalFornecedor'],0, ',', '.') : "0";
	
					 ?></large></b></p>
				</div>				
				
				
			</div>
			
		</div>
		</div>
		
		
		
	</div>

</div>
<script>
	
</script>