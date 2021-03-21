

<html lang="pt-br">
<?php include 'db_connect.php'?>
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="row">
			<button class="col-md-2 float-right btn btn-primary btn-sm" id="new_company"><i class="fa fa-plus"></i> Nova Empresa</button>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<table class="table table-bordered"  id="main">
							<thead>
								<th class="text-center">#</th>
								<th class="text-center">Nome Fantasia</th>
								<th class="text-center">CNPJ</th>
								<th class="text-center">Estado</th>
							</thead>
							<tbody>
							<?php 
								$sql = "SELECT * FROM tb_empresa order by no_fantasia asc";


								$query = $conn->query($sql);
								$encoding = mb_internal_encoding();
								
								$i = 1;
								while($row=$query->fetch_assoc()):
								
	
								
							?>
								<tr>
									<td class="text-center"><?php echo $i++; ?></td>
									<td class="text-center"><?php echo $row['no_fantasia']; ?> </td>
									<td class="text-center"><?php echo $row['nu_cnpj']; ?></td>
									<td class="text-center"><?php echo $row['sg_uf']; ?></td>
										

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
	$('#new_company').click(function(){
		location.href = "index.php?page=new_company"
	})


</script>
