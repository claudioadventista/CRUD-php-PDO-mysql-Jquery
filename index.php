<?php
include('db.php');
	$consultaCpf = $connection->prepare("SELECT * FROM configuracao WHERE id = 1");
    $consultaCpf->execute();
	$consult = $consultaCpf->fetch();
	
	$consCpf    = $consult['gerador_cpf'];
	$consPagina = $consult['linhas_por_pagina'];
	$consOrdem  = $consult['ordem_inicial'];
	$consColuna = $consult['coluna_inicial'];

	
?>
<html>
	<head>
		<title>Cadastro de pessoas</title>
		<!--<title>Webslesson Demo - PHP PDO Ajax CRUD with Data Tables and Bootstrap Modals</title>-->
		<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>-->
		
		<!---------------------------  Biblioteca JS principal -------------------------------->
		<script src="internet/ajax-googleapis-com-ajax-libs-jquery-2-2-0-jquery-min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />	
		
			<!---------------------------  Biblioteca Bootstrap principal -------------------------------->
		<link rel="stylesheet" href="internet/maxcdn-bootstrapcdn-com-bootstrap-3-3-6-css-bootstrap-min.css" />
		<!--<link rel="stylesheet" href="internet/bootstrap-4.3.1-dist/css/bootstrap.min.css" />-->
		<!---------- Plugin JS para adicionar máscara ------->
		<script src="internet/jquery.1.14.0.mask.js"></script>
		
		<!---------- Plugin datatables ----------------------->
			
		<!--<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>-->
		<script src="internet/cdn-datatables-net-1-10-12-js-jquery-dataTables-min.js"></script>
		<!--<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>-->		
		<script src="internet/cdn-datatables-net-1-10-12-js-dataTables-bootstrap-min.js"></script>		
		<!--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />-->
		<link rel="stylesheet" href="internet/cdn-datatables-net-1-10-12-css-dataTables-bootstrap-min.css" />	
		
		<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->
		<script src="internet/maxcdn-bootstrapcdn-com-bootstrap-3-3-6-js-bootstrap-min.js"></script>
			
		<style>
			body,.modal-dialog {
				margin: 0;
				padding: 0;
				background-color:#666;
				max-width:1300px;
			}
			.box {
				width: 99%;
				padding: 10px;
				background-color: #fafafa;
				border: 1px solid #fafafa;/*border-radius:5px;/*margin-top:25px;*/
			}
			.titulo{
				font-weight:bold;
				margin-right:15%;
			}
			.cabecario{
				background-color:#fff;
				padding:10px 10px 10px 0;
			}
			.az{
				margin-left:30px;
			}
			.za{
				margin-left:50px;
			}
			.sim{
				margin-left:103px;
			}
			.nao{
				margin-left:100px;
			}
			.coluna_1{
				margin-left:10px;
			}
			.coluna_2{
				margin-left:10px;
			}
			.coluna_3{
				margin-left:10px;
			}
			.coluna_4{
				margin-left:10px;
			}
			.coluna_5{
				margin-left:10px;
			}
			.coluna_6{
				margin-left:10px;
			}
			.coluna_7{
				margin-left:10px;
			}
			.coluna_8{
				margin-left:10px;
			}
			.coluna_9{
				margin-left:10px;
			}
			.coluna_10{
				margin-left:10px;
			}
			.coluna_11{
				margin-left:10px;
			}
			.coluna_12{
				margin-left:10px;
			}
			.coluna_13{
				margin-left:10px;
			}
			.mensagem {			
				display:none;
				padding:10px 20px 10px 20px;
				background-color:#fff;
				margin-right:5px;
				font-size:1.5em;
				border-radius:7px;
			}
			#geraCpf::selection{
				background-color:#fff0cc;
			}
			.resposta{
				position:absolute;
				top:115px;
			}
			.respostas{
				display:none;
				background-color:#ccc;
				border:1px solid #aaa;
				border-radius:5px;
				padding-left:20px;
			}
			#geraCpf{
				display:none;/* Numeros de cpf inicia sem visualização */
			}
			
/* --------- Estilo do botão Seleção de arquivo "imagem" -----*/			
			input[type='file']{
				display:none;
			}
			.selecao-imagem {
				/*background-color: #3498db;*/
				border-radius: 5px;
				/*color: #fff;*/
				cursor: pointer;
				margin: 10px;
				padding: 6px 20px;
				border:1px solid #ddd;
			}
			.selecao-imagem:hover {
				border:1px solid #aaa;
				color:#666;
			}
			.frescura{
				position:relative;
				left:140px;
				top:8px;
				padding:8px;
				background-color:#069;
				border-radius:4px;
				color:#fff;	
				display:none;
				font-weight:bold;
				margin-left:80px;
			}
			.informacao_cpf{
				padding:3 30% 3 30%;
				font-weight:bold;
				background-color:#069;
				color:#fff;
				border-radius:3px;
				border:solid 1px #069;
			}
			.retornar_valor_id{
				position:relative;
				margin-top:310px;
				margin-bottom:10px;
				left:370px;
			}
			/*botao fechar na janela cpf cadstrado*/
			.fechar_cpf_cadastrado{
				margin-top:170px;
				left:282px;
				padding:20px;
			}
			/* mostra o x para cancelar ou resetar, dentro do campo pesquisa 
			 no datatable */
			input[type="search"]::-webkit-search-cancel-button{
						-webkit-appearance:searchfield-cancel-button;
					}
					.modal-dialog{/* Muda a largura do formulário de cadastro */
						width:39%;
					
					}
					@media screen and (min-width: 1000px){
						body, .modal-dialog{/* centraliza oprojeto ao ultrapassaro limite tamanho máximo */
						margin:0 auto;	
						}
					}	
		</style>	
		<script>
		   function goFullscreen(id) {
    // Get the element that we want to take into fullscreen mode
    var element = document.getElementById(id);

    // These function will not exist in the browsers that don't support fullscreen mode yet, 
    // so we'll have to check to see if they're available before calling them.

    if (element.mozRequestFullScreen) {
      // This is how to go into fullscren mode in Firefox
      // Note the "moz" prefix, which is short for Mozilla.
      element.mozRequestFullScreen();
      document.getElementById('telaCheia').style.background='blue';
     
    
    } else if (element.webkitRequestFullScreen) {
      // This is how to go into fullscreen mode in Chrome and Safari
      // Both of those browsers are based on the Webkit project, hence the same prefix.
      element.webkitRequestFullScreen();
      
      
       
   }
   // Hooray, now we're in fullscreen mode!
  }
		</script>	
	</head>	
	<body>
	
		<div id="atualizar">
			
		<div class="container col-lg box">
				
			<!--<h4 align="center">Cadastro de Pessoas</h4>-->
			
			<div class="table-responsive">
				
				<div align="right" class="cabecario">
					
					<!--<span class="titulo">Cadastro de Pessoas </span>-->
					<?php if($consCpf=="sim"){ ;?>
					
					<span class="mensagem" > Copiado </span>	
					<input type="text" id="geraCpf"  class="btn btn-light btn-lg" style="width:170px;background-color:#fff0aa; outline:none;" >				
					<!--<input type="button" style="padding:10px;" value="Selecionar" id="btnSelecionar">-->
					<input type="button" id="geradorCPF" class="btn btn-success btn-lg" name="geradorCPF" value="Gerar CPF" onClick="gerarCpf()" >											                         				
					 <script type="text/javascript" language="javascript" >
					 
// ------------------------------------------mostra CPF gerado -----------------------------------
                       	// Quando for clicado o botão para gerar um novo CPF, inicia uma essa função...
						$('#geradorCPF').click(function() {

						$('#geraCpf').show();
						// ...seleciona o valor do CPF gerado...
						$('#geraCpf').select();

						// ...copia esse valor...
						var copiar = document.execCommand('copy');

						// ...exibe que o CPF foi copiado.
						$('.mensagem').fadeIn(400);

						// A mensagem de CPF copiado aparece por um momento, e desaparece
						setTimeout(function() {
						$('.mensagem').fadeOut(400, function() {
						$('.mensagem').hide();
						});
						}, 100);
						});

//------------------------------------- gerar CPF -----------------------------------------------
						//obtem o elemento apenas uma vez no inicio em vez de todas as vezes que gera o cpf
						const cpf = document.getElementById("geraCpf");

						function gerarCpf() {
						const num1 = aleatorio(); //aleatorio já devolve string, logo não precisa de toString
						const num2 = aleatorio();
						const num3 = aleatorio();

						const dig1 = dig(num1, num2, num3); //agora só uma função dig
						const dig2 = dig(num1, num2, num3, dig1); //mesma função dig aqui

						//aqui com interpolação de strings fica bem mais legivel
						//cpf.value = `${num1}.${num2}.${num3}-${dig1}${dig2}`;// com pontuação
						cpf.value = `${num1}${num2}${num3}${dig1}${dig2}`;// Sem pontuaçao
						}

						//o quarto parametro(n4) só será recebido para o segundo digito
						function dig(n1, n2, n3, n4) {

						//as concatenações todas juntas uma vez que são curtas e legíveis
						let nums = n1.split("").concat(n2.split(""), n3.split(""));

						if (n4){ //se for o segundo digito coloca o n4 no sitio certo
						nums[9] = n4;
						}

						let x = 0;

						//o j é também iniciado e incrementado no for para aproveitar a própria sintaxe dele
						//o i tem inicios diferentes consoante é 1º ou 2º digito verificador
						for (let i = (n4 ? 11:10), j = 0; i >= 2; i--, j++) {
						x += parseInt(nums[j]) * i;
						}

						const y = x % 11;
						//ternário aqui pois ambos os retornos são simples e continua legivel
						return y < 2 ? 0 : 11 - y;
						}

						function aleatorio() {
						const aleat = Math.floor(Math.random() * 999);
						//o preenchimento dos zeros à esquerda é mais facil com a função padStart da string
						return ("" + aleat).padStart(3, '0');
						}

						gerarCpf();

						</script>		
				<?php	};?>
				
				    <!-- data-backdrop="static" , evita fechar o modal clicando fora do botão fechar -->				
					<button type="button" id="add_button" data-toggle="modal" data-target="#userModal" data-backdrop="static" class="btn btn-info btn-lg" >Adicionar</button>
			        <button type="button" id="menu_button" data-toggle="modal" data-target="#userModalmenu" data-backdrop="static" class="btn btn-primary btn-lg">Menu</button>			
				</div>				
				<br />	
				<table id="user_data" class="table table-bordered table-striped table-hover table-condensed">
					<thead>
						<tr>
							<th width:"10%;"><center>Imagem</center></th>
							<th width="30%"><center>Nome</center></th>
							<th width="20%"><center>Cpf</center></th>
							<th width="20%"><center>Editar</center></th>
							<th width="19%"><center>Excluir</center></th>
						</tr>
					</thead>
				</table>
					<!--<button id="telaCheia" onclick="goFullscreen('atualizar'); return false">Clique para ir para tela cheia!</button>-->		
				</div>
		</div>
		
		<!-- Formulário -->
<div id="userModal" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="user_form" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header" >
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					
					 <!--<input type="submit" name="action" id="action2"  class="btn btn-success" />-->
					 <h4 class="modal-title">Adicionar Cadastro</h4>			 
				</div>
				<div class="modal-body">
					
					<!-- Essa div esconde outros campos até que o cpf seja validado -->
					<div id="formulario" class="formulario">
						 
						<label>Entre com o Nome.</label>
						<input type="text" name="first_name" autocomplete="off" id="first_name" class="form-control title" onKeyup="pri_mai(this);" />				
						<br />												
						<label>Entre com o Sobrenome.</label>
						<input type="text" name="last_name" id="last_name" autocomplete="off" class="form-control title" />
						<br />
					</div>
				    <div id="campoCPF">
				    
					    <!-- O texto atribuido a essa label e diferente no formulário adicionar, e alterar -->	
						<label class="label-cpf "></label>    
						<div id="estado_cpf"></div>            
						<input type="text" id="cpf" name="cpf" maxlength="14" autocomplete="off" class="cpf_form form-control"  placeholder="Digite o CPF" onkeypress='return event.charCode >= 48 && event.charCode <= 57' autofocus />
						<span class="frescura" ><span class="texto_frescura">P r o c e s s a n d o</span></span>
						<!-- Depois de validado o cpf, mostra esse campo com o valor do cpf, impedindo qualquer modificação -->
						<span class="span-cpf form-control" ></span>    
						<br>
						
					    <div class="respostas">	
					    	<span class="informacao_cpf">Este cpf já está cadastrado</span><br>				
							<span class="resposta" id="resposta"></span><br>				
								<button type="button" name="update" id="alteracao" class="btn btn-warning btn update retornar_valor_id"style="padding:20px">Alterar</button>
								<button type="button" class="retornar_valor_id fechar_cpf_cadastrado btn btn-default" data-dismiss="modal">Fechar</button>
						</div>
                   </div>
                   
                   	<!-- Essa div esconde outros campos até que o cpf seja validado -->				
					<div id="formulario" class="formulario">
						<label>Endereço.</label>
						<input type="text" name="endereco" id="endereco" autocomplete="off" class="form-control title" onKeyup="pri_mai(this);" />
						<br />
						<label>Telefone.</label>
						<input type="text" name="telefone" id="telefone" autocomplete="off" placeholder="(99)99999-9999" class="form-control" />
						<br />		
						<label>E-mail.</label>
						<input type="email" name="email" id="email" autocomplete="off" class="form-control" />
						<br />					
					   <!-- Botão escolher arquivo estilizado -->
					   <label class="selecao-imagem" for="user_image">Selecione uma imagem.</label>
					   <input type="file" name="user_image" id="user_image" />
					    
					    <!-- Mostra a imagem ampliada no formulário de atualização -->	
					   	<span id="user_uploaded_image"></span>	                                   			   	
					    <div class="modal-footer">
					 	   <input type="hidden" name="user_id" id="user_id" />
						   <input type="hidden" name="operation" id="operation" />
						   <input type="submit" name="action" id="action" class="btn btn-success" />
						   <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
						</div>
				</div>
		</form>
	</div>
</div>
</div>
</div>

<!-- Formulario Menu -->
<div id="userModalmenu" class="modal fade" >
	<div class="modal-dialog">
       <form method="post" id="user_form_menu" >
           <div class="modal-content">
				<div class="modal-header" >
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					
					 <!--<input type="submit" name="action" id="action2"  class="btn btn-success" />-->
					 <h4 class="modal-title-menu">Menu configuração</h4>
				</div>
				<div class="modal-body">						 
					<label>Número de linhas por página  ( 1 a 100 )</label>
					<input type="number" name="linha" id="linha"  autocomplete="off" autofocus maxlength="3" min="1" max="100" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="<?php echo $consPagina; ?>" />				
					<br />												
					<label>Coluna em que deve iniciar a ordenação</label><br>
					<span class="coluna_0"> 0 </span><input type="radio" name="coluna" id="0" value="0" disabled />
					<span class="coluna_1"> 1 </span><input type="radio" name="coluna" id="1" value="1" <?php if($consColuna=="1")  {echo "checked";} ?>  />
					<span class="coluna_2"> 2 </span><input type="radio" name="coluna" id="2" value="2" <?php if($consColuna=="2")  {echo "checked";} ?> />
					<span class="coluna_3"> 3 </span><input type="radio" name="coluna" id="3" value="3" disabled />
					<span class="coluna_4"> 4 </span><input type="radio" name="coluna" id="4" value="4" disabled />
					<span class="coluna_5"> 5 </span><input type="radio" name="coluna" id="5" value="5" disabled />
					<span class="coluna_6"> 6 </span><input type="radio" name="coluna" id="6" value="6" disabled />
					<span class="coluna_7"> 7 </span><input type="radio" name="coluna" id="7" value="7" disabled />
					<span class="coluna_8"> 8 </span><input type="radio" name="coluna" id="7" value="8" disabled />
					<span class="coluna_9"> 9 </span><input type="radio" name="coluna" id="7" value="9" disabled />
					<span class="coluna_10"> 10 </span><input type="radio" name="coluna" id="7" value="10" disabled />
					<span class="coluna_11"> 11 </span><input type="radio" name="coluna" id="7" value="11" disabled />
					<span class="coluna_12"> 12 </span><input type="radio" name="coluna" id="7" value="12" disabled />
					<span class="coluna_13"> 13 </span><input type="radio" name="coluna" id="7" value="13" disabled />
					<br /><br />
					<label>Ordem em que deve iniciar</label>
					<label for="asc">
					<span class="az btn btn-info"> de A para Z </span><label class="btn btn-primary"><input type="radio" name="ordem" id="asc" value="asc"   <?php if($consOrdem=="asc")  {echo "checked";} ?> /></label>
					</label>
					<label for="desc">
					<span class="za btn btn-info"> de Z para A </span><label class="btn btn-primary"><input type="radio" name="ordem" id="desc" value="desc"  <?php if($consOrdem=="desc") {echo "checked";} ?> /></label>
					</label>
					<br /><br />
					<label>Gerador de CPF</label>
					<label for="sim">
					<span class="sim btn btn-info"> Sim </span><label class="btn btn-primary"><input type="radio"  name="cpf" id="sim" value="sim"  <?php if($consCpf=="sim")  {echo "checked";} ?> /></label>
					</label>
					<label for="nao"> 
					<span class="nao btn btn-info"> Não </span><label class="btn btn-primary"><input type="radio" name="cpf" id="nao" value="nao"  <?php if($consCpf=="nao")  {echo "checked";} ?> /></label>
					</label>
					<br /><br />
					<div class="modal-footer">			
					   <input type="hidden" name="operation-menu" id="operation-menu" />
					   <input type="submit" name="action-menu" id="action-menu" class="btn btn-success" />
					   <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					</div>
		</form>
	</div>
</div>
</div>
</div>
</div>

       <script type="text/javascript" language="javascript" >
			$(document).ready(function(){
					
// --------------------- Menu configuração da tabela ----------------------------------------------
				$('#menu_button').click(function(){
					$('#user_form_menu')[0].reset();//...................... Limpa o form ao abrir
					$('.modal-title-menu').text("Cofiguração da tabela");//. Muda o nome do título
					$('#action-menu').val("Atualizar");	//.................. Muda o nome do botão
					$(".modal-dialog").show()
				});
							
// -------------------- Limpa camp ao fechar o modal ----------------------------------------------
				$('.close').click(function(){
					$('.modal').modal('hide');
					$('.formulario').css('display','block');
					$('.respostas').hide();
					$("#resposta").text("");// limpa o campo resposta que mostra informação do cpf encontrado
					$("#estado_cpf").text("");
					
					// atraves da classe, retorna o valor do id do botão alteração quando mostra 
					//informação do cpc já cadastrado, para receber outro valor
					$(".retornar_valor_id").prop('id',"alteracao");
					$(".modal-dialog").hide().css({width:"39%"});// redimensiona o formulário e esconde*/		
					//$("#cpf").unmask();// Retira a máscara do campo cpf, porem ela fica oculta
				});
				
				$('.btn-default').click(function(){
					$('.modal').modal('hide');
					$("#estado_cpf").text("");
					// retorna o valor do id no botão alterar na janela cpf já está cadastrado
					$(".retornar_valor_id").prop('id',"alteracao");
					$('.respostas').hide();
					$(".modal-dialog").hide().css({width:"39%"});
				});
				
// -------------------- Botão adicionar ------------------------------------------------------------
				$('#add_button').click(function(){
					$('.formulario').css('display','none');	
					$('#user_form')[0].reset();//............................................... Limpa o form ao abrir
					$('.modal-title').text("Adicionar Cadastro");//............................. Muda o nome do título
					$('#action').val("Adicionar");//............................................ Muda o nome do botão
					$('#operation').val("Add");//............................................... Pega o valor do campo operação
					$('#user_uploaded_image').html('');//....................................... Pega o valor do campo imagem
			        $('.label-cpf').text("Digite o CPF.");//.. Atribui um título a span
			        $("#cpf").show().attr("readonly", false).css({background:"#fff" }).mask('000.000.000-00').val();//.......................................Muda a cor do campo Cpf
				    $("#telefone").mask('(00)00000-0000').val();
				   // $("#cpf").mask('000.000.000-00').val();
				    $(".span-cpf").hide();
				    $(".modal-dialog").show();
				    
				});	
			
// --------------------- Tabela -------------------------------------------------------------------
				var dataTable = $('#user_data').DataTable({
					
					"destroy":true,
					"pageLength":<?php print $consPagina; ?>,// Fixa o valor de linhas por página
					"bLengthChange":false,// Some com as opções de escolha de linhas por página
					"scrollY":false,// Impede scrool horizontal abaixo da tabela
					"processing":true,
					"serverSide":true,
					"order":[<?php print $consColuna ; ?>,"<?php print $consOrdem; ?>"],
					// Se for usar colunas que não vão ter setas de ordenação, usar essa função dessa forma
					// "order":[],
					// Para iniciar a tabela em uma ordem escolhida use a função conforme descrita abaixo
					// "order":[2,"desc"], Aqui diz que deve iniciar a tabela com a coluna 2 ordenada decrescente
					// Nessa tabela foi usado com variavel php com informação vinda do banco
					"ajax":{
						url:"fetch.php",
						type:"POST"
					},
					"columnDefs":[
						{
							"targets":[0,3,4],// Colunas que não vão ter setas de ordenação
							"orderable":false,
						},
					],
				});	
			
// ------------- Tratamento do submit ------------------------------------------------------------				
				$(document).on('submit', '#user_form', function(event){
					event.preventDefault();
					var firstName = $('#first_name').val();
					var lastName = $('#last_name').val();
					//var cpf = $('#cpf').mask('00000000000').val();// modifica a mascara do cpf para ter somente números para gravar no banco
					var cpf = $('#cpf').val();				
					var endereco = $('#endereco').val();
				    var telefone = $('#telefone').val();
				    var email = $('#email').val();
					var extension = $('#user_image').val().split('.').pop().toLowerCase();
					if(extension != '')
					{
						if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
						{
							alert("Imagem com Extenção Inválida");
							$('#user_image').val('');
							return false;
						}
					}	
					if(firstName != '' && lastName != '' && cpf != '' && endereco != '' && user_image !='')
					{
						$.ajax({
							url:"operation.php",
							method:'POST',
							data:new FormData(this),
							contentType:false,
							processData:false,
							success:function(data)
							{
								alert(data);                   // Confirmação de sucesso
								$('#user_form')[0].reset();    // Limpa os campos do formulário
								$('#userModal').modal('hide'); // fecha o modal
								$("#estado_cpf").text("");
								$(".modal-dialog").hide().css({width:"39%"});
								
								dataTable.ajax.reload();       // atualiza a tabela
							}
						});
					}
					else
					{
						alert("Todos os campos são obrigatórios");
					}
				});
				
// --------------------------- As funções abaixo acontecem quando clica em Alterar ----------------
				$(document).on('click', '.update', function(){
					var user_id = $(this).attr("id");
					$.ajax({
						url:"fetch_single.php",
						method:"POST",
						data:{user_id:user_id},
						dataType:"json",
						success:function(data)
						{   					
							$('#userModal').modal('show');  // ....................... Mostra o formulário
							$('#first_name').val(data.first_name);  // ............... Pega o valore enviado pelo ajax
							$('#last_name').val(data.last_name);  // ................. Pega o valore enviado pelo ajax
							$('#cpf').val(data.cpf).hide();  // ...................... Pega o valore enviado pelo ajax
							$('#estado_cpf').text(data.estadoCpf);  // ............... Retorna o estado correspondente ao cpf
							$('#endereco').val(data.endereco);  // ................... Pega o valore enviado pelo ajax
							$('#telefone').val(data.telefone).mask('(00)00000-0000');
							$('#email').val(data.email);  // ................... Pega o valore enviado pelo ajax
							$('.modal-title').text("Editar Cadastro");  //............ Muda o texto do título
							$('#user_id').val(user_id);  // .......................... Pega o valor da id
							$('#user_uploaded_image').html(data.user_image);  // ..... Pega o valore enviado pelo ajax	
							$('#action').val("Editar");  // .......................... Muda o valor do botão 
							$('#operation').val("Edit");  // ......................... Muda o texto do botão		
						    $('.respostas').hide();  // .............................. Esconde a div respostas		
			                $('.label-cpf').text("CPF.");  // ........................ Muda o texto do label              
						    $('.span-cpf').css({background:"#f1f1f1" }).show().text(data.cpf);
						    // retorna o valor da id do botão alterar na janela cpf já está cadastrado
						    $(".retornar_valor_id").prop('id',"alteracao");
						    $(".modal-dialog").css({width:"97%"}).show();//.................. Redimensiona, e mostra o formulário
						}
					})
				});
				
// ----------função para mostrar o formulário quando clicar em alterar na janela de cpf já está cadastrado --------------	
				$('.retornar_valor_id').click(function(){
					$('.formulario').show();  // ....................... Mostra o formulário
				});	
					
// ---------------------- Tratamento para excluir cadastro ---------------------------------------		
				$(document).on('click', '.delete', function(){
					var user_id = $(this).attr("id");
					if(confirm("Tem certeza que deseja excluir este?"))
					{
						$.ajax({
							url:"operation.php",
							method:"POST",
							data:{user_id:user_id, operation:'Del'},
							success:function(data)
							{
								alert(data);
								dataTable.ajax.reload();	
							}
						});
					}
					else
					{			
						return false;	
					}
				});
			});
			
// --------------------------------- Tratamento do submit do menu tabela --------------------------
			$(document).on('submit', '#user_form_menu', function(event){
					event.preventDefault();
					var linha = $('#linha').val();
					var coluna = $('#coluna').val();
					var ordem = $('#ordem').val();
					
					if(linha != '' && coluna != '' && ordem != '' )
					{
						$.ajax({
							url:"config_tables.php",
							method:'POST',
							data:new FormData(this),
							contentType:false,
							processData:false,
							success:function(data)
							{
								$('#userModalmenu').modal('hide'); // fecha o modal
								location.reload();// Atualiza a página inteira						
							}
						});
					}
					else
					{
						alert("Todos os campos são obrigatórios");
					}
				});
				
// -------------------------------- Tratamento para validação do Cpf ------------------------------
			function CPF()
			{	
			   document.getElementById('cpf').focus();
			"user_strict";
			function r(r)
			     {
				for(var t=null,n=0;9>n;++n)t+=r.toString().charAt(n)*(10-n);
				var i=t%11;return i=2>i?0:11-i
				}
				function t(r)
				    {
					for(var t=null,n=0;10>n;++n)t+=r.toString().charAt(n)*(11-n);
					var i=t%11;
					return i=2>i?0:11-i
					}
					/*var n=" CPF Inválido",i=" CPF Válido";*/
					var n="",i=" CPF válido";
					this.gera=function()
					{
						for(var n="",i=0;9>i;++i)n+=Math.floor(9*Math.random())+"";
						/*var o=r(n),a=n+"-"+o+t(n+""+o);*/
						var o=r(n),a=n+o+t(n+""+o);
						return a
						},
						this.valida=function(o)
						{
							for(var a=o.replace(/\D/g,""),u=a.substring(0,9),f=a.substring(9,11),v=0;10>v;v++)
							if(""+u+f==""+v+v+v+v+v+v+v+v+v+v+v)
							return n;
							var c=r(u),e=t(u+""+c);
							return f.toString()===c.toString()+e.toString()?i:n
							}
							}
							
			// Fim da função valida cpf
			
// ----------------- Começa a função verificar cada número digitado -------------------------------
		
			var CPF = new CPF();  
			$("#cpf").keyup(function(){
				
				  // Impede esse dois cpf válidos
				  if($("#cpf").val() == "123.456.789-09" ||  $("#cpf").val() == "012.345.678-90") {
			     			$("#cpf").css({background:"#f00" });  
			     			$("#cpf").css({color:"#fff" });
			     			return false;
			      };
			     		
			    
			      // Se o CPF for válido, vai verificar no banco se está cadastrado    
			      // condição que só entra aqui se o cpf for válido
			      if (CPF.valida($(this).val())==" CPF válido")
			      
			      {
			     	
			     	
			     		// muda a cor do campo cpf e esconde as respostas
			     	    $("#cpf").css({background:"#0f0" }); // #cef6d8 cor verde claro     
			     	   
			       // se o CPF for válido, vai verificar no banco se está cadastrado      	   			     
			     	var cpf = $("#cpf"); 
			            $.ajax({ 
			                url: 'verificaCpf.php', 
			                type: 'POST', 
			                data:{"cpf" : cpf.val()},               
			                success: function(data) { 
			                console.log(data); 
			                data = $.parseJSON(data);
			                // mostra informações do cpf encontrado,funciona também trocando html por append
			                 $("#resposta").html("Nome : "+data.nome + " "+ data.sobrenome + '.<br>'+"Endereço : "+data.endereco+".<br>Telefone : "+data.telefone+". - Email : "+data.email+'.<br>'+'<img src="upload/'+data.imagem+'" width="360" height="330">');// pega o nome e sobrenome enviado via json
			                 // atribui o valor da id do cpf encontrado ao botão alterar da janela cpf já está cadastrado
			                 $("#alteracao").prop('id',data.id);
			                 
			                // Se o cpf válido não estiver cadastrado no banco, continua por aqui      
			                 if ( data.cpf == "CPF válido")
			                   {
			                   	var estCpf = $('#cpf').val().substring(10,11); // ---------- Pega o numero de caracter digitado no campo cpf em tempo real			     	        		     	       
				     	        if  (estCpf == 0){				     	        	
				     	 	     $('#estado_cpf').text("Rio Grande do Sul");				     	 	
				     	         }else if(estCpf == 1){				     	 
				     	         	 $('#estado_cpf').text("Distrito Federeal, Goiás, Mato Grosso do Sul e Tocantins");			     	        
				     	         }else if(estCpf == 2){				     	        		  
				     	             $('#estado_cpf').text("Pará, Amazonas, Acre, Amapá, Rondônia e Roraima");				     	       
				     	         }else if(estCpf == 3){				     	        	 
				     	        	 $('#estado_cpf').text("Ceará, Maranhão e Piauí");				     	       
				     	         }else if(estCpf == 4){				     	        	 
				     	        	 $('#estado_cpf').text("Pernambuco, Rio Grande do Norte, Paraíba e Alagoas");				     	       
				     	        }else if(estCpf == 5){				     	        	
				     	        	 $('#estado_cpf').text("Bahia e Sergipe");				     	       
				     	         }else if(estCpf == 6){				     	        	
				     	        	 $('#estado_cpf').text("Minas Gerais");				     	        	 
				     	         }else if(estCpf == 7){				     	        	
				     	        	 $('#estado_cpf').text("Rio de Janeiro e Espírito Santo");				     	        	 
				     	         }else if(estCpf == 8){			     	        	
				     	        	 $('#estado_cpf').text("São Paulo");			     	       
				     	         }else{			     	              
				     	              $('#estado_cpf').text("Paraná e Santa Catarina");				     	        
				     	         }
				     	         
// ----------------------------- Frescura só para demorar 3 segundos para abrir o formulário, 
//                               caso contrário, nem dá para ver o cpf válido em verde rsrsrs :D        
			                    $('.frescura').show();			            
			                    
			                    // o código abaixo serve para fazer a palavra processando piscar :D
			                    var textoPiscante = $('.texto_frescura');
			                    window.setInterval( function(){
			                    	textoPiscante.css('visibility','hidden');
			                    	window.setTimeout(function(){
			                    		textoPiscante.css('visibility','visible');
			                    	}, 400)
			                    },1 * 800)
			                    
			                  //o código abaixo serve para demorar 3 segundos, se for 3000, para abrir o resto do formulário
			                   	setTimeout(continua, 1000); // aguarda um pouco, com o campo validado em verde, e continua
// ---------------------------- fim da frescura 
			                                   		                      	                	    
			     	           function continua(){  			     	           	       
			     	                 $(".respostas").hide();   	                
			     	                 $('.formulario').fadeIn(400); // --------------------------------------------- Mostra os campos do formulário de forma suave              
			     	                 $('#first_name').focus(); // ----------------------------------- Focalisa o campo nome              
			     	                 $('#cpf').css({background:"#a9f5bc" }).attr("readonly", true).hide(); // ----- Atribue somente leitura no campo cpf   	               
			                         $('.label-cpf').text("CPF"); // ---------------------------------------------- muda o texto da label para CPF			                     
			                          $('.frescura').hide();
			                         var valorCpf = $("#cpf").val(); // -------------------- Pega o valor do campo cpf e bota numa variavel para aparecer numa div, com uma mascara 			                        						             					           
						             $('.span-cpf').css({background:"#f1f1f1" }).show().text(valorCpf); // -------- atribui o valor do Cpf a span		              	        	                	                             	
			                         $(".modal-dialog").css({width:"97%"});
			                        }
			                   }  
// ---- As ações abaixo são realizadas quando o Cpf já é registrado ----------------------------
			                   else                 
			                   {  
			                   	    $("#cpf").css({background:"#ff0" }); // ------------------------------------ #f5f6ce cor amarela no campo Cpf para amarelo claro
			                   	    $(".respostas").show(); // ---------------------------------------------------- mostra as informações do cpf registrado
			                       
			                    }    	                
			            } 
			        });    	
			     }
			     // condição que entra se o cpf for inválido
			     else{
				
// ---- As ações abaixo são realizadas quando o Cpf é inválido -------------------------------	     	
				     	 var contCpf = $('#cpf').val(); // ---------- Pega o numero de caracter digitado no campo cpf em tempo real
				     	 if (contCpf.length == 14) {    // ---------- Qualdo chega a 11 caracteres(tem também os pontos e o traço da máscara), mostra a mensagem abaixo
				     	 $("#cpf").css({background:"red",color:"#ffffff"});// -- #f8e6e0 cor rosa no campo cpf inválido
			     	 
			     	 }
			     	 else
			     	 {
			            // se deletar um número do cpf inválido ou já cadastrado, campo volta a ser branco
			     	 	 //$("#cpf").css({background:"#fff" });
			     	 	 $("#cpf").css({background:"#fff",color:"#000"});
			     	 	 $(".respostas").hide();
			     	 	 // limpa o campo da imagem para não repetir a imagem
			     	 	 $("#resposta").text("");
			     	     $(".retornar_valor_id").prop('id',"alteracao");// retorna o valor para receber outro cpf
			     	 }
			     }
			});
			
			// Primeira letra maiúscula
			function pri_mai(obj){
			    str = obj.value;
			    qtd = obj.value.length;
			    prim = str.substring(0,1);
			    resto = str.substring(1,qtd);
			    str = prim.toUpperCase() + resto;
			    obj.value = str;
			}
			
			// Primeira letra de cada palavra maiúscula
			$.fn.capitalize = function () {
			    //palavras para ser ignoradas
			  var wordsToIgnore = ["to", "and", "the", "it", "or", "that", "this"],
			    minLength = 3;
			
			  function getWords(str) {
			    //return str.match(/\S+\s*/g);
			    return str.match(/\S+\s*/g);
			  }
			  this.each(function () {
			    var words = getWords(this.value);
			    $.each(words, function (i, word) {
			      // somente continua se a palavra nao estiver na lista de ignorados
			      if (wordsToIgnore.indexOf($.trim(word)) == -1 && $.trim(word).length > minLength) {
			        words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1);
			      }
			    });
			    this.value = words.join("");
			  });
			};
			
			//onblur do campo com classe .title
			$('.title').on('keyup', function () {
			  $(this).capitalize();
			}).capitalize();
       </script>
	</body>	
</html>
