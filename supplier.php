

<html lang="pt-br">
<?php include 'db_connect.php'?>
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="row">
			<button class="col-md-2 float-right btn btn-primary btn-sm" id="new_supplier"><i class="fa fa-plus"></i> Novo Fornecedor</button>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<table class="table table-bordered"  id="main">
							<thead>
								<th class="text-center">#</th>
								<th class="text-center">Empresa</th>
								<th class="text-center">Fornecedor</th>
								<th class="text-center">CPF/CNPJ</th>
								<th class="text-center">Data Cadastro</th>
								<th class="text-center">Telefone</th>
							</thead>
							<tbody>
							<?php 
								$sql  = " SELECT a.co_fornecedor, c.no_fantasia, a.no_fornecedor, a.nu_cpf_cnpj, a.dt_cadastro ";
								$sql .= " FROM";
								$sql .= "	tb_fornecedor a, tb_empresa c, rl_empresa_fornecedor d";
								$sql .= " WHERE";
								$sql .= "   d.co_empresa = c.co_empresa AND";
								$sql .= "   d.co_fornecedor = a.co_fornecedor";
								$sql .= "   order by no_fornecedor asc";

								$query = $conn->query($sql);
								$encoding = mb_internal_encoding();
								
								$i = 1;
								while($row=$query->fetch_assoc()):
								
	
								
							?>
								<tr>
									<td class="text-center"><?php echo $i++; ?></td>
									<td class="text-center"><?php echo $row['no_fantasia']; ?> </td>
									<td class="text-center"><?php echo $row['no_fornecedor']; ?></td>
									<td class="text-center"><?php echo $row['nu_cpf_cnpj']; ?></td>
									<td class="text-center"><?php echo date("d/m/Y",strtotime($row['dt_cadastro'])); ?></td>
									
									<td class="text-center">
									<?php 
									$sql2 = "SELECT nu_telefone FROM tb_telefone_fornecedor WHERE co_fornecedor = '".$row['co_fornecedor']."'";
									$query2 = $conn->query($sql2);
									while($row2=$query2->fetch_assoc()):
										echo $row2['nu_telefone']."<br>";
									?>	
									<?php endwhile; ?>
									</td>


								</tr>
							<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>


<script>


	$('table').dataTable()
	$('#new_supplier').click(function(){
		location.href = "index.php?page=new_supplier"
	})

</script>
