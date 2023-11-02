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
		// $cod = $_SESSION['codigocliente'];
		include("conexao.php");
		if (!$conexao){
			die('<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Problema de conexão.</strong> Desculpe, mas não foi possível conectar ao nosso servidor.
				</div>');
		}
		else {
			include("formata_data.php");
			$cod = $_GET['cod'];
			$procura = "SELECT * FROM tab_pessoas WHERE cod_pessoas = '$cod'";
			$resultado = mysqli_query($conexao, $procura);
			$confcad = mysqli_fetch_array($resultado);
				
				$codigo = $confcad['cod_pessoas'];
				$nome = $confcad['nome_pessoas'];
				$cel = $confcad['cel_pessoas'];
				$dt_nasc = $confcad['dt_nasc'];
				$cpf = $confcad['cpf_pessoas'];
				$email = $confcad['email_pessoas'];
				$aceita_email = $confcad['aceita_email'];
				$aceita_sms = $confcad['aceita_sms'];
				$status = $confcad['status'];
		}
							
	} 
?>

<!DOCTYPE html>
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
	<script async src="js/jquery.buscaPorCPF.js"></script>
	<script async src="js/JsValidacaoMascara.js"></script>
	<script async src="js/jquery.maskedinput-1.3.min.js"></script>
	<script async src="js/projeto.mascarajquery.js"></script>
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
					<div class="col-md-10">
						<h1 class="page-header"> <br/>Alterar Aluno</h1>
					</div>
				</div>
				<br>
				<!-- INÍCIO DO FORM -->
				<form action="altera_aluno.php" method="post" name="pessoas" class="form-group form-group-lg">
					<div class="row">
						<div class="col-md-3">
							<label for="cpf">CPF:</label>
							<input name="cpf" class="form-control" type="text" id="cpf" value="<?php echo $cpf; ?>" onblur="javascript: validarCPF(this.value);" onkeypress="javascript: mascara(this, cpf_mask);"  maxlength="14" />
							<!-- <input type="text" class="form-control" name="cpf" id="inputCPF" required autofocus> -->
						</div>
						<div class="col-md-2">
							<label for="inputCod">Código:</label>
							<input type="text" class="form-control" name="codigo" id="inputCod" value="<?php echo $codigo; ?>" readonly>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-6">
							<label for="inputNome">Nome:</label>
							<input type="text" class="form-control" name="nome" value="<?php echo $nome; ?>" id="inputNome" required>
						</div>
						<div class="col-md-3">
							<label for="inputDtNasc">Data de Nascimento: </label>
							<input type="date" value="<?php echo $dt_nasc; ?>" class="form-control" name="dtNasc" id="inputDtNasc" >
						</div>
							
					</div>
					<br>
					<div class="row">
						<div class="col-md-3">
							<label for="inputCel">Celular:</label>
							<input type="tel" class="form-control" name="cel" value="<?php echo $cel; ?>" id="inputCel" required>
						</div>
						<div class="col-md-6">
							<label for="inputEmail">E-mail:</label>
							<input type="email" class="form-control" name="email" value="<?php echo $email; ?>" id="inputEmail">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-4">
							<div class="radio">
								<p>Aceita receber SMS?</p>
								<label class="radio-inline">
									<input type="radio" name="radioSMS" id="inlineRadio1" value="1" checked> SIM
								</label>
								<label class="radio-inline">
									<input type="radio" name="radioSMS" id="inlineRadio2" value="0"> NÃO
								</label>
							</div>
						</div>
						<div class="col-md-4 col-md-offset-2">
							<div class="radio">
								<p>Aceita receber e-mail?</p>
								<label class="radio-inline">
									<input type="radio" name="radioEmail" id="inlineRadio3" value="1" checked> SIM
								</label>
								<label class="radio-inline">
									<input type="radio" name="radioEmail" id="inlineRadio4" value="0"> NÃO
								</label>
							</div>
						</div>
					</div>
					<br>
					<button type="submit" class="btn btn-primary btn-lg">&nbsp;&nbsp;Atualizar&nbsp;&nbsp;</button>
					<button type="button" class="btn btn-default btn-lg">Cancelar</button>
				</form><!--FIM DO FORM -->
			</div>
		<?php
			ini_set ("display_errors", "off");
			$nome = $_POST['nome'];
			$codigo = $_POST['codigo'];
			$cel = $_POST['cel'];
			$dtNasc = $_POST['dtNasc'];
			$cpf = $_POST['cpf'];
			$email = $_POST['email'];
			$aceitaSMS = $_POST['radioSMS'];
			$aceitaEmail = $_POST['radioEmail'];
			if ($codigo!=NULL){
				$atualiza = mysqli_query($conexao, "UPDATE tab_pessoas SET nome_pessoas='$nome', cel_pessoas='$cel', dt_nasc='$dtNasc',
				cpf_pessoas='$cpf', email_pessoas='$email', aceita_email='$aceitaEmail', aceita_sms='$aceitaSMS' 
				WHERE cod_pessoas = '$codigo'");
				echo "Atualizado com sucesso.";
			}
			else {
				echo "Não foi possível atualizar.";
			}
			mysqli_close();
		?>
		</div>
	</div>
</body>
</html>