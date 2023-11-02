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
		$cod = $_SESSION['codigo'];

		include("conexao.php");
		if (!$conexao){
			die('<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Problema de conexão.</strong> Desculpe, mas não foi possível conectar ao nosso servidor.
				</div>');
		}
		$query = "SELECT * FROM tab_usuario WHERE cod_usuario = '$cod'";
		$procura = mysqli_query($conexao,$query);
		$resultado = mysqli_fetch_array($procura);
		$nome = $resultado['nome_usuario'];
		$tel = $resultado['tel_usuario'];
		$email = $resultado['email_usuario'];

	} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Trabalho de TCC</title>

	<!-- Incluindo o css do Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<!-- Incluindo o css para o Dashboard -->
	<link rel="stylesheet" href="css/sb-admin.css">
	<link rel="stylesheet" href="font-awesome-4.1.0/css/font-awesome.min.css">
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
	<script async src="js/jquery-1.11.1.min.js"></script>
	<!-- Incluindo o js do Bootstrap (.min) -->
	<script async src="js/bootstrap.min.js"></script>	
	<!-- Mascaras -->
	<script src="js/jquery.maskedinput-1.3.min.js"></script>
	<script src="js/projeto.mascarajquery.js"></script>

	<div id="wrapper">
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container-fluid">
				<ul class="nav navbar-nav navbar-right">
					<li>
						<a href="perfil.php"><span class="glyphicon glyphicon-user"></span><?php echo "&nbsp;&nbsp;".$admin; ?></a>
					</li>	
				</ul>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav side-nav">
					<li><a href="home.php?pagina=sistema"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Dashboard</a></li>
					<li>
						<a href="javascript:;" data-toggle="collapse" data-target="#envio">
							<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Envios<i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="envio" class="collapse">
                            <li>
                                <a href="home.php?pagina=sms">Enviar SMS</a>
                            </li>
                            <li>
                                <a href="home.php?pagina=email">Enviar Email</a>
                            </li>
                        </ul>
					</li>
					<li>
						<a href="javascript:;" data-toggle="collapse" data-target="#cadastro">
							<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>Cadastro <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="cadastro" class="collapse">
                            <li>
                                <a href="home.php?pagina=cadastro">Aluno</a>
                            </li>
                            <li>
                                <a href="home.php?pagina=curso">Curso e Turma</a>
                            </li>
                            <li>
                                <a href="home.php?pagina=usuario">Administrador</a>
                            </li>
                        </ul>
					</li>
					<li>
						<a href="javascript:;" data-toggle="collapse" data-target="#busca">
							<span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscas <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="busca" class="collapse">
                            <li>
                                <a href="home.php?pagina=busca_aluno">Aluno</a>
                            </li>
                            <li>
                                <a href="home.php?pagina=busca_sms">Mensagem SMS</a>
                            </li><li>
                                <a href="home.php?pagina=busca_email">Mensagem Email</a>
                            </li>
                        </ul>
					</li>
					<li><a href="home.php?pagina=relatorio"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Relatórios </a></li>
					<li><a href="javascript:;" data-toggle="collapse" data-target="#configura">
						<span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Configurações <i class="fa fa-fw fa-caret-down"></i></a>
						<ul id="configura" class="collapse">
							<li><a href="home.php?pagina=statusaluno">Status de Alunos</a></li>
							<li><a href="home.php?pagina=confadmin">Administradores</a></li>
							<li><a href="home.php?pagina=addsms">Pacote de SMS</a></li>
						</ul>
					</li>
					<li><a href="index.php"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Sair</a></li>
				</ul>			
			</div>
		</nav><!--Fim do Menu -->
		<!-- Inicio do conteudo -->
		
		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h1 class="page-header"><?php echo $admin ?> <small>Altere o seu cadastro</small></h1>		
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<!-- INÍCIO DO FORM -->
						<form action="alteraperfil.php" method="post" class="form-group form-group-lg">
							<div class="row">
								<div class="col-md-6">
									<label for="inputNome">Nome:</label>
									<input type="text" class="form-control" name="nome" id="inputNome" value="<?php echo $nome; ?>">
								</div>
							</div>				
							<br>
							<div class="row">
								<div class="col-md-4">
									<label for="inputEmail">E-mail:</label>
									<input type="email" class="form-control" name="email" id="inputEmail" value="<?php echo $email; ?>">
								</div>
								<div class="col-md-2">
									<label for="inputCel">Celular:</label>
									<input type="tel" class="form-control" name="cel" id="inputCel" value="<?php echo $tel; ?>">
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-3">
									<label for="inputSenha">Alterar Senha: </label>
									<input type="password" class="form-control" name="senha" id="inputSenha">
								</div>
								<div class="col-md-3">
									<label for="inputConfSenha"> Confirme a Nova Senha: </label>
									<input type="password" class="form-control" name="confsenha" id="inputConfSenha">
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-3 col-md-offset-4">
									<button type="submit" class="btn btn-primary btn-lg">Cadastrar</button>
									<button type="reset" class="btn btn-default btn-lg">Cancelar</button>
								</div>
							</div>
						</form><!--FIM DO FORM -->
					</div>
					
				</div>
			</div>
		<!-- Fim do conteudo -->
		<?php
			ini_set("display_errors", "off");
			$ok = $_GET['ok'];
			
			if ($ok==1){
				echo '<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Problema ao Alterar.</strong> Desculpe, mas não foi possível alterar os dados.
					</div>';
			}
			elseif ($ok==2) {
				echo '<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Dados Alterados com Sucesso.</strong> Realize o logout para completar as alterações.
					</div>';
			}
			elseif ($ok==3) {
				echo '<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Senhas não conferem.</strong> 
					</div>';
			}
			mysqli_close();
		?>
		</div> <!--fim do WRAPPER -->
</body>
</html>