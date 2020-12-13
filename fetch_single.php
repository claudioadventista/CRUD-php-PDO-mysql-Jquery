
<?php
include('db.php');
include('function.php');
include('mascara.php');

if(isset($_POST["user_id"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM users 
		WHERE id = '".$_POST["user_id"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	
	foreach($result as $row)
	{
		# Pega os número do cpf registrado no banco...	
		$pega_cpf = $row["cpf"];
		# ...seleciona o terceiro algarismo da direita para a esquerda...
		$codigo_estado_cpf = substr("$pega_cpf", -3,1);
	    # ...compara esse algarismo e mostra o(s) estado(s) correspondente
			if($codigo_estado_cpf ==0){	
				$estadoCpf = "Rio Grande do Sul";
			}
			else if($codigo_estado_cpf ==1){	
				$estadoCpf = "Distrito Federeal, Goiás, Mato Grosso do Sul e Tocantins";
			}
			else if($codigo_estado_cpf ==2){	
				$estadoCpf = "Pará, Amazonas, Acre, Amapá, Rondônia e Roraima";
			}
			else if($codigo_estado_cpf ==3){	
				$estadoCpf = "Ceará, Maranhão e Piauí";
			}
			else if($codigo_estado_cpf ==4){	
				$estadoCpf = "Pernambuco, Rio Grande do Norte, Paraíba e Alagoas";
			}
			else if($codigo_estado_cpf ==5){	
				$estadoCpf = "Bahia e Sergipe";
			}
			else if($codigo_estado_cpf ==6){	
				$estadoCpf = "Minas Gerais";
			}
			else if($codigo_estado_cpf ==7){	
				$estadoCpf = "Rio de Janeiro e Espírito Santo";
			}
			else if($codigo_estado_cpf ==8){	
				$estadoCpf = "São Paulo".'<br>';
			}
			else{	
				$estadoCpf = "Paraná e Santa Catarina";
			}
	
				$output["first_name"] = $row["first_name"];
				$output["last_name"] = $row["last_name"];
				$output["estadoCpf"] = $estadoCpf;
				$output["cpf"] = mask($row["cpf"],'###.###.###-##');// Coloca uma máscara no cpf para mostrar no formulario de alteração
				$output["endereco"] = $row["endereco"];
				if($row["telefone"]<>""){
				$output["telefone"] = mask($row["telefone"],'(##)#####-####');
				}
				$output["email"] = $row["email"];
				
				if($row["image"] != '')
				{
					$output['user_image'] = '<img src="upload/'.$row["image"].'" class="img-thumbnail" width="30%" height="30%" /><input type="hidden" name="hidden_user_image" value="'.$row["image"].'" />';
				}
				else
				{
					$output['user_image'] = '<input type="hidden" name="hidden_user_image" value="" />';
				}
	}
	echo json_encode($output);
}
?>