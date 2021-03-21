
<nav class='navbar navbar-expand-sm navbar-light bg-light' >
		
		<div class="collapse navbar-collapse" id="navbarSupportedContent">

				<a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-home"></i></span> Home</a>
				<a href="index.php?page=companies" class="nav-item nav-sales"><span class='icon-field'><i class="fa fa-building"></i></span> Empresas</a>
				<a href="index.php?page=supplier" class="nav-item nav-customer"><span class='icon-field'><i class="fa fa-dolly-flatbed"></i></span> Fornecedores</a>
				<?php if($_SESSION['login_type'] == 1): ?>
				<a href="ajax.php?action=logout" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-power-off"></i></span> Sair</a>
			<?php endif; ?>
		</div>

</nav>
<script>
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>
<?php if($_SESSION['login_type'] != 1): ?>
	<style>
		.nav-item{
			display: none!important;
		}
		.nav-sales ,.nav-home ,.nav-inventory{
			display: block!important;
		}
	</style>
<?php endif ?>