<?php
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
			<?php
				ini_set("display_errors", "off");
				$pagina = $_GET['pagina'];
				if ($pagina == 'sistema') {
					include("sistema.php");
				}
				else if ($pagina == 'sms') {
					include("sms.php");
				}
				else if ($pagina == 'email') {
					include ("email.php");
				}
				else if ($pagina == 'cadastro') {
					include ("cadastro.php");
				}
				else if ($pagina == 'curso') {
					include ("curso.php");
				}
				else if ($pagina == 'usuario') {
					include ("usuario.php");
				}
				else if ($pagina == 'busca_aluno') {
					include ("busca_aluno.php");
				}
				else if ($pagina == 'busca_sms') {
					include ("busca_sms.php");
				}
				else if ($pagina == 'busca_email') {
					include ("busca_email.php");
				}
				else if ($pagina == 'relatorio') {
					include ("relatorio.php");
				}
				else if ($pagina == 'statusaluno') {
					include ("statusaluno.php");
				}
				else if ($pagina == 'confadmin') {
					include ("confadmin.php");
				}
				else if ($pagina == 'addsms') {
					include ("addsms.php");
				}
				else if ($pagina == 'ralunos') {
					include ("ralunos.php");
				}
				else if ($pagina == 'rsms') {
					include ("rsms.php");
				}
				else if ($pagina == 'rdtsms') {
					include ("rdtsms.php");
				}
				else if ($pagina == 'remail') {
					include ("remail.php");
				}
				else if ($pagina == 'rdtemail') {
					include ("rdtemail.php");
				}
				else if ($pagina == 'log') {
					include ("log.php");
				}
				else {
					include("sistema.php");
					// include("teste.php");
				}
			?>
		</div>
		<!-- Fim do conteudo -->
	</div> <!--fim do WRAPPER -->
	<!--Incluindo plugin JQuery -->
	<script async src="js/jquery-1.11.1.min.js"></script>
	<!-- Incluindo o js do Bootstrap (.min) -->
	<script async src="js/bootstrap.min.js"></script>	
</body>
</html>