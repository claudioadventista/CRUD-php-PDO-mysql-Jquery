<?php
// Função para adicionar 10 caracters alfanuméricos aleatórios ao nome da imagem, alem do rand()
function generateRandomString($size = 10){
   $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuwxyz0123456789";
   $randomString = '';
   for($i = 0; $i < $size; $i = $i+1){
      $randomString .= $chars[mt_rand(0,60)];
   }
   return $randomString;
}

// Novo cadastro, faz o upload da imagam para a pasta e cria um nome unico
function upload_image()
{
	if(isset($_FILES["user_image"]))
	{
		$extension = explode('.', $_FILES['user_image']['name']);
		$new_name = generateRandomString().rand(100000,999999) . '.' . $extension[1];
		$destination = './upload/' . $new_name;
		move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);
		return $new_name;
	}
}

// Atualiza cadastro, faz o upload da imagem para a pasta e cria um nome unico
function upload_image2()
{
	if(isset($_FILES["user_image"]))
	{
		
		$image = get_image_name($_POST["user_id"]);
	    if($image != '')
	{
		unlink("upload/" . $image); // apaga a imagem antiga, se houver
	}
		$extension = explode('.', $_FILES['user_image']['name']);// cria um nova imagem, e um novo nome
		$new_name = generateRandomString().rand(100000,999999) . '.' . $extension[1];
		$destination = './upload/' . $new_name;
		move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);
		return $new_name;
	}
}

function get_image_name($user_id)
{
	include('db.php');
	$statement = $connection->prepare("SELECT image FROM users WHERE id = '$user_id'");
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row["image"];
	}
}

function get_total_all_records()
{
	include('db.php');
	$statement = $connection->prepare("SELECT * FROM users");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

// função para retirar a máscara do cpf
 function tiraMask($valor){
			 $valor = trim($valor);
			 $valor = str_replace(".", "", $valor);
			 $valor = str_replace(",", "", $valor);
			 $valor = str_replace("-", "", $valor);
			 $valor = str_replace("/", "", $valor);
			  $valor = str_replace("(", "", $valor);
			 $valor = str_replace(")", "", $valor);
			 return $valor;
			}
 
?>