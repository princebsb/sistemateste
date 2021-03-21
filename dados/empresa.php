<?php
include '../db_connect.php';

$codigo = $_REQUEST["codigo"];

$sql = "SELECT * FROM TB_EMPRESA WHERE CO_EMPRESA = ".$codigo;
$query = $conn->query($sql);
$row=$query->fetch_assoc();
$retorno = $row['sg_uf'];
json_decode($retorno); 


echo json_encode($retorno, JSON_PRETTY_PRINT);

?>
