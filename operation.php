<?php
include('db.php');
include('function.php');
if(isset($_POST["operation"]))
{
	
	# Adicionar novo cadastro -----------------------------------------------------------
	if($_POST["operation"] == "Add")
	{	
		$image = '';
		if($_FILES["user_image"]["name"] != '')
		{
			$image = upload_image();
		}
		$statement = $connection->prepare("
			INSERT INTO users (first_name, last_name, cpf, endereco, telefone, email, image) 
			VALUES (:first_name, :last_name, :cpf, :endereco, :telefone, :email, :image)
		");
		$result = $statement->execute(
			array(
				':first_name'	=>	$_POST["first_name"],
				':last_name'	=>	$_POST["last_name"],
				':cpf'	        =>	tiraMask($_POST["cpf"]),// retira a mascara do cpf para gravar no banco
				':endereco'	    =>	$_POST["endereco"],
				':telefone'	    =>	tiraMask($_POST["telefone"]),
				':email'	    =>	$_POST["email"],
				':image'		=>	$image
			)
		);
		if(!empty($result))
		{
			echo 'Dados Inseridos';
		}
		
	}
	
	
	# Editar cadastro ---------------------------------------------------------------
	if($_POST["operation"] == "Edit")
	{
		$image = '';
		if($_FILES["user_image"]["name"] != '')
		{
			$image = upload_image2();
		}
		else
		{
			$image = $_POST["hidden_user_image"];
		}
		$statement = $connection->prepare(
			"UPDATE users 
			SET first_name = :first_name, last_name = :last_name, endereco = :endereco, telefone = :telefone, email = :email, image = :image  
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':first_name'	=>	$_POST["first_name"],
				':last_name'	=>	$_POST["last_name"],
				':endereco'	    =>	$_POST["endereco"],
				':telefone'	    =>	tiraMask($_POST["telefone"]),
				':email'	    =>	$_POST["email"],
				':image'		=>	$image,
				':id'			=>	$_POST["user_id"]
			)
		);
		if(!empty($result))
		{
			echo 'Dados Atualizados';
		}
	}
	
# Excluir cadastro ---------------------------------------------------------------
	if($_POST["operation"] == "Del")
	{
	if(isset($_POST["user_id"]))
{
	$image = get_image_name($_POST["user_id"]);
	if($image != '')
	{
		unlink("upload/" . $image);
	}
	$statement = $connection->prepare(
		"DELETE FROM users WHERE id = :id"
	);
	$result = $statement->execute(
		array(
			':id'	=>	$_POST["user_id"]
		)
	);
	
	if(!empty($result))
	{
		echo 'Cadastro Excluído';
	}
}
	
}
}

?>