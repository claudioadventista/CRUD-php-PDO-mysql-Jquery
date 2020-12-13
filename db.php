<?php
// Conecta ao dominio
$conn=mysql_connect("localhost","root","");

for($i = 1; $i<=2; $i++){

$db=mysql_select_db("cadastro");

// Se não existir...
if(empty($db))
{
	
// Cria a database 'control'
	$dbcr="create database cadastro character set utf8 collate utf8_general_ci";
	
//Checa se a database foi criada
	$check=mysql_query($dbcr);
	
// Se não existir...
	if(!$check){
		
// Informa que houve erro ao criar a database
//echo"Erro ao criar o banco de dados</br>";	
	}else {
		
// Se existir; informa database criada ok
//echo "O banco foi criado<br/>";
	}
}else{
// Se tentar criara a mesma database, informa database ja existe 
//echo"O banco já existe<br/>";
}

$table4="select * from users";
//Checa se a tabela existe no banco criado
$checktable4=mysql_query($table4);
// Se não exixtir...
if(!$checktable4)
{
//echo"A tabela não existe, por favor crie uma</br>";
	
	$create4="create table users(
	id int(11) NOT NULL AUTO_INCREMENT,
	first_name varchar (50) NOT NULL,
	last_name varchar (50) NOT NULL,
	image varchar (21) NOT NULL,
	cpf varchar (15) NOT NULL,
	endereco varchar (200) NOT NULL,
	telefone varchar (15) NOT NULL,
	email varchar (50) NOT NULL,
	PRIMARY KEY (id)
	)";
	
	$ok4=mysql_query($create4);
	if(!$ok4){
	//echo"Erro ao criar a tabela";
	}else {
		//echo"A tabela foi criada";
	}

}else {//echo"A tabela já existe";
}

$table5="select * from configuracao";
//Checa se a tabela existe no banco criado
$checktable5=mysql_query($table5);
// Se não exixtir...
if(!$checktable5)
{
	//echo"A tabela não existe, por favor crie uma</br>";
	
	$create5="create table configuracao(
	id int(5) NOT NULL,
	linhas_por_pagina int(5) NOT NULL,
	coluna_inicial int(5) NOT NULL,
	ordem_inicial varchar(5) NOT NULL,
	gerador_cpf varchar(5) NOT NULL,
	PRIMARY KEY (id)
	)";
	
	$ok5=mysql_query($create5);
	if(!$ok5){
	//echo"Erro ao criar a tabela";
	}else {
		//echo"A tabela foi criada";
	}

}else {//echo"A tabela já existe";
}

}// fim do laço for

if(isset($check)){
	//echo "Banco OK</br>";
}

if(isset($ok4)){
	//echo "Tabela funcionario OK</br>";
}

if(isset($ok5)){
	//echo "Tabela config OK</br>";
}

$link = mysqli_connect("localhost","root","","cadastro");

$sqlinsert="INSERT INTO configuracao (id, linhas_por_pagina, coluna_inicial, ordem_inicial, gerador_cpf)
VALUES ('1', '5', '1', 'asc', 'nao')";

if(mysqli_query($link, $sqlinsert)){
	
}

       $username = 'root';
       $password = '';
       $connection = new PDO( 'mysql:host=localhost;dbname=cadastro', $username, $password );

?>