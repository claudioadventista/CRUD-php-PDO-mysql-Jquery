<?php
include('db.php');
include('mascara.php');
$query = '';

/* Busca por ocorrência */
$query .= "SELECT * FROM users ";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE id LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR first_name LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR last_name LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR  cpf LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR  endereco LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR  telefone LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR  email LIKE "%'.$_POST["search"]["value"].'%" ';
}

// Conta o resultado no rodapé da tabela
	if(isset($_POST["search"]["value"]))
{
	$busca = $_POST["search"]["value"];
	$statem = $connection->prepare("SELECT * FROM users WHERE id LIKE '%$busca%' OR first_name LIKE '%$busca%' OR last_name LIKE '%$busca%' OR cpf LIKE '%$busca%' OR endereco LIKE '%$busca%' OR telefone LIKE '%$busca%' OR email LIKE '%$busca%'");
    $statem->execute();
	$filtro = $statem->rowCount();
	
	// Conta o total de entradas no banco
	$entradas = $connection->prepare("SELECT * FROM users");
    $entradas->execute();
	$total_de_entradas= $entradas->rowCount();
}
	
/* Ordenação da tabela */
$columns = array( 
    0 => 'image',
	1 => 'first_name', 
	2 => 'cpf',
	3 => 'alterar',
	4 => 'excluir',
); 

if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY id DESC ';
}
if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();

foreach($result as $row)
{
	
	$image = '';
	if($row["image"] != '')
	{
		$image = '<img src="upload/'.$row["image"].'" width="60" height="60" />';
	}
	else
	{
		//$image = '<img src="imagem_teste/sem_imagem.jpg"  width="60" height="60" />';
		// coloque uma imagem com o nome sem_imagem.jpg e habilite o campo acima
	}
		
	$sub_array = array();
	if(!empty($image)){$sub_array[] = '<span style="width:10%;"><center><button type="button" name="update" id="'.$row["id"].'" class="btn btn-warning btn-xs update" style="width:100%;">'.$image.'</button></center></span>';}else{$sub_array[] ='';};
	$sub_array[] = '<span style="width:30%;"><span id="'.$row["id"].'" class="btn btn-light btn-xs update">'.$row["first_name"].'</span></span>';
	$sub_array[] = '<span style="width:20%;"><span id="'.$row["id"].'" class="btn btn-light btn-xs update">'.mask($row["cpf"],'###.###.###-##').'</span></span>';// Coloca uma máscara no cpf para mostrar na tabela
	$sub_array[] = '<span style="width:20%;"><button type="button" name="update" id="'.$row["id"].'" class="btn btn-warning btn-xs update"style="margin-left:20%;margin-top:3px;padding:20px">Alterar</button></span>';
	$sub_array[] = '<span style="width:19%;"><button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-xs delete" style="margin-left:20%;margin-top:3px;padding:20px">Excluir</button></span>';
	
	$data[] = $sub_array;
}

$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$total_de_entradas,// Total de registro na tabela
	"recordsFiltered"	=>	$filtro,// Filtra os registro encontrados, elimina páginas no rodapé,
	"data"				=>	$data
);

echo json_encode($output);
?>