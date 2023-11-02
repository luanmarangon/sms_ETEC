<?php
	ini_set("display_errors", "off");
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
	<!-- Mascaras -->
	<script src="js/jquery.maskedinput-1.3.min.js"></script>
	<script src="js/projeto.mascarajquery.js"></script>

	
		<!-- Inicio do conteudo -->
		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h1 class="page-header">Seja Bem Vindo! <small>Cadastro de Usuários</small></h1>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-12">
						<!-- INÍCIO DO FORM -->
						<form action="home.php?pagina=usuario" method="post" class="form-group form-group-lg">
							<div class="row">
								<div class="col-md-8">
									<label for="inputNome">Nome:</label>
									<input type="text" class="form-control" name="nome" id="inputNome">
								</div>
							</div>				
							<br>
							<div class="row">
								<div class="col-md-4">
									<label for="inputEmail">E-mail:</label>
									<input type="email" class="form-control" name="email" id="inputEmail">
								</div>
								<div class="col-md-2">
									<label for="inputCel">Celular:</label>
									<input type="tel" class="form-control" name="cel" id="inputCel">
								</div>
								<div class="col-md-2">
									<label for="inputNivelAcesso"> Nivel de Acesso: </label>
									<select name="nivelAcesso" id="nivel" class="form-control">
										<option value="">Selecione</option>
										<option value="1">Acesso Total</option>
										<option value="2">Acesso Restrito</option>
									</select>
								</div>
							</div>
							<br>
							<div class="row">
								
								<div class="col-md-3">
									<label for="inputSenha"> Senha: </label>
									<input type="password" class="form-control" name="senha" id="inputSenha">
								</div>
								<div class="col-md-3">
									<label for="inputConfSenha"> Confirme a Senha: </label>
									<input type="password" class="form-control" name="confsenha" id="inputConfSenha">
								</div>
								
							</div>
							<br>
							<div class="row">
								<div class="col-md-3 col-md-offset-5">
									<button type="submit" class="btn btn-primary btn-lg">Cadastrar</button>
									<button type="reset" class="btn btn-default btn-lg">Cancelar</button>
								</div>
							</div>
						</form><!--FIM DO FORM -->
					</div>
				</div>
			</div>
<?php
	ini_set ("display_errors", "off");
	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$cel = $_POST['cel'];
	$nivel = $_POST['nivelAcesso'];
	$senha = md5($_POST['senha']);
	$confsenha = md5($_POST['confsenha']);
	include("conexao.php");
 
 
	if (($nome!=NULL)&&($email!=NULL)&&($cel!=NULL)&&($senha!=NULL)&&($confsenha!=NULL)){
		if (!$conexao){
			die('<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Problema de conexão.</strong> Desculpe, mas não foi possível conectar ao nosso servidor.
				</div>');
		}
		elseif ($senha!=$confsenha) {
			die('<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Senhas não conferem.
				</div>');
		}
		else{
			$inserir = "insert into tab_usuario values ('','$nome','$cel', '$email', '$senha', '$nivel')";
			$insercao = mysqli_query($conexao, $inserir); 
			if(!$insercao){
				die('<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Problema ao inserir (Usuario).</strong> Desculpe, houve um problema ao inserir seus dados em nosso sistema.
					</div>');
			}
			echo '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Cadastro realizado com sucesso.</strong>
				</div>';
		}				
	}
	else {
		echo '<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Preencha todos os campos.</strong>
			</div>';
	}
	mysqli_close();
?>
	</div> <!--fim do WRAPPER -->

	
</body>
</html>