<?php
	ini_set ("display_errors", "off");
	session_start(); 
	if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true)) {
		unset($_SESSION['codigo']);
		unset($_SESSION['login']); 
		unset($_SESSION['senha']); 
		unset($_SESSION['nome']);
		unset($_SESSION['nivel']);
		header('location:index.php'); 
	}
	elseif ($_SESSION['nivel']!=1) {
		unset($_SESSION['codigo']);
		unset($_SESSION['login']); 
		unset($_SESSION['senha']); 
		unset($_SESSION['nome']);
		unset($_SESSION['nivel']);
		header('location:index.php');
	}
	else{
		$admin = $_SESSION['nome'];
		
	} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Trabalho de TCC</title>

	<!-- Incluindo o css do Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<!-- Incluindo o css de estilo, que vai modificar o Bootstrap -->
	<link rel="stylesheet" href="css/estilo.css">
	<link rel="stylesheet" href="css/seta.css">

	<!-- Abaixo recursos para utilizar HTML5 no IE8 -->
    <!-- ATENÇÃO: Respond.js não funciona se for acessado via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
	<!--Incluindo plugin JQuery -->
	<script src="js/jquery-1.11.1.min.js"></script>
	<!-- Incluindo o js do Bootstrap (.min) -->
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.buscaPorCPF.js"></script>
	<script src="js/JsValidacaoMascara.js"></script>
	<script src="js/jquery.maskedinput-1.3.min.js"></script>
	<script src="js/projeto.mascarajquery.js"></script>

		<!-- Inicio do conteudo -->
		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-10">
						<h1 class="page-header"> <br/> Procurar Aluno</h1>
					</div>
				</div>
				<br>

				<!-- INICIO DO FORM -->
				<form action="home.php?pagina=busca_aluno" method="post" class="form-inline">
					<div class="row">
						<div class="form-group">
							<label for="inputBusca">Nome:</label>
							<input type="text" class="form-control" id="inputBusca" name="busca">
							<button type="submit" class="btn btn-primary">Buscar</button>
						</div>
					</div>
				</form>
				<!-- FIM DO FORM -->
<?php
		ini_set("display_errors", "off");
		$busca = $_POST['busca'];
		include("formata_data.php");
		include("conexao.php"); 
			if (!$conexao){
				die('<div>
					<strong>Problema de conexão.</strong> Desculpe, mas não foi possível conectar ao nosso servidor.
					</div>');
			}
			
				else {
					$procurar= "SELECT * FROM tab_pessoas WHERE nome_pessoas like '%".$busca."%' ORDER BY nome_pessoas";
					$resultado= mysqli_query($conexao,$procurar);
					
					if($busca!=null){
						echo'<table class="table">
						<thead>
							<tr>
								<th> NOME DO ALUNO </th>
								<th> CELULAR </th>
								<th> NASCIMENTO </th>
								<th> CPF </th>
								<th> EMAIL </th>
							</tr>
						</thead>
						<tbody>';
						while ($dados = mysqli_fetch_array($resultado)) {
								$codAluno=$dados['cod_pessoas'];
								echo "<tr><td>" . $dados['nome_pessoas'] . "</td>
								<td>" . $dados['cel_pessoas'] . "</td> 
								<td>" . formata_data($dados['dt_nasc']) . "</td>
								<td>" . $dados['cpf_pessoas'] . "</td> 
								<td>" . $dados['email_pessoas'] . "</td>
								<td>".'<a class="btn btn-default btn-xs" href="altera_aluno.php?cod='.$codAluno.'" 
														role="button">Alterar</a></td>';                                                                                                                                                           
														
						}
						'</tbody>';
						echo '</table>';
					}				
			}
	?>
			</div>
</body>
</html>