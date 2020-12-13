<?php
include('db.php');

$linha = $_POST["linha"];
$coluna = $_POST["coluna"];
$ordem = $_POST["ordem"];
$geraCpf = $_POST["cpf"];
 	
$sql = "UPDATE configuracao
   SET linhas_por_pagina='$linha', coluna_inicial='$coluna', ordem_inicial='$ordem', gerador_cpf='$geraCpf'
   WHERE id= 1 "; 
	if($connection->query($sql)===TRUE){
	}
	
?>