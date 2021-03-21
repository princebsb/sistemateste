<?php
ob_start();
$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();

if($action == "save_company"){
	$save = $crud->save_company();
	if($save)
		echo $save;
}

if($action == "save_supplier"){
	$save = $crud->save_supplier();
	if($save)
		echo $save;
}
if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		echo $logout;
}

if($action == 'login'){
	$login = $crud->login();
	if($login)
		echo $login;
}

