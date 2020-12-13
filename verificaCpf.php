<?php
include('db.php');
include('function.php');
// retira a máscara do cpf para consultar o banco 
$cpfPostado = tiraMask($_POST["cpf"]);
$sql = $connection->prepare("SELECT * FROM users WHERE cpf = '$cpfPostado'");
$sql->execute();
$informacao = $sql->fetch();
$total = $sql->rowCount();

// recupeara informação do cpf que está sendo cadastrado, e foi encontrado cadastrado no banco
$id = $informacao['id'];
$nome = $informacao['first_name'];
$sobrenome = $informacao['last_name'];
$cpf = $informacao['cpf'];
$endereco = $informacao['endereco'];
$telefone = $informacao['telefone'];
$email = $informacao['email'];
	// tratamento da imagem do cpf encontrado
	if($informacao['image'] != '')
	  {
		$imagem = $informacao['image'];;
	  }
	else
	  {
		$imagem = 'sem_imagem.jpg';
	  }

	if($total>0)
	  {
	 # Envia informações do cpf encontrado
	     echo json_encode(array(
         'cpf' => $cpf,
		 'nome' => $nome,
		 'sobrenome' =>$sobrenome,
		 'endereco' =>$endereco,
		 'telefone' =>$telefone,
		 'email' =>$email,
		 'imagem' =>$imagem,
		 'id' => $id
		));  
    }else{
    # Caso não encontro nenhum cpf registrado, retorna cpf válido para ser cadastrado 
        echo json_encode(array('cpf' => 'CPF válido')); 	   
}
?>