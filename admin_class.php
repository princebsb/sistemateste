<?php
session_start();
ini_set('display_errors', 1);
Class Action {
	private $db;

	public function __construct() {
		ob_start();
   	include 'db_connect.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}

	function login(){
		extract($_POST);
		$qry = $this->db->query("SELECT * FROM users where username = '".$username."' and password = '".$password."' ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'passwors' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
				return 1;
		}else{
			return 3;
		}
	}
	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}

	function save_company(){
		extract($_POST);

		$data = " nu_cnpj = '$nu_cnpj' ";
		$data .= ", no_fantasia = '$no_fantasia' ";
		$data .= ", sg_uf = '$sg_uf' ";


		$save = $this->db->query("INSERT INTO tb_empresa set ".$data);
		$id =$this->db->insert_id;

		if(isset($save)){
			return $id;
		}
	}
	
	function save_supplier(){
		extract($_POST);

		$data = " no_fornecedor = '$no_fornecedor' ";
		$data .= ", nu_cpf_cnpj = '$nu_cpf_cnpj' ";
		$data .= ", dt_cadastro = '$dt_cadastro' ";

		if (strlen($nu_cpf_cnpj) < 12){
			$data .= ", nu_rg = '$nu_rg' ";
			$data .= ", dt_nascimento = '$dt_nascimento' ";
		}	
		if (strlen($nu_cpf_cnpj) > 11){
			$data .= ", nu_im = '$nu_im' ";
			$data .= ", nu_ie = '$nu_ie' ";
		}	
		$save = $this->db->query("INSERT INTO tb_fornecedor set ".$data);
		$id =$this->db->insert_id;

		$sql = "SELECT MAX(co_fornecedor) as id FROM tb_fornecedor";
		$sql = $this->db->query($sql);
		$row=$sql->fetch_assoc();
		$ultimo_id = $row['id'];

		
		$data = " co_empresa = '$co_empresa' ";
		$data .= ", co_fornecedor = '$ultimo_id' ";

		$save = $this->db->query("INSERT INTO rl_empresa_fornecedor set ".$data);
		
		//TELEFONES		
		$save = $this->db->query("INSERT INTO tb_telefone_fornecedor set ".$data);

		foreach($nu_telefone as $k => $v){
			$numero = preg_replace("/[^0-9]/", "", $nu_telefone[$k]); 		

			$data = " co_fornecedor = '$ultimo_id' ";
			$data .= ", nu_telefone = '$numero' ";
			$save2[]= $this->db->query("INSERT INTO tb_telefone_fornecedor set ".$data);
		}

		if(isset($save2)){
			return $id;
		}
	}

}