<?php
	session_start();
	session_unset();
	session_destroy();
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

	<!-- Abaixo recursos para utilizar HTML5 no IE8 -->
    <!-- ATENÇÃO: Respond.js não funciona se for acessado via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body id="background-login">
	<!--Incluindo plugin JQuery -->
	<script src="js/jquery-1.11.1.min.js"></script>
	<!-- Incluindo o js do Bootstrap (.min) -->
	<script src="js/bootstrap.min.js"></script>
	
	<div class="topo-site">
		<div id="login">
			<form role="form" action="autentica.php" method="post">
				<div class="form-group">
					<label for="InputLogin">LOGIN:</label>
					<input type="email" class="form-control" id="InputLogin" name="login" autofocus>
				</div>
				<div class="form-group">
					<label for="InputSenha">SENHA:</label>
					<input type="password" class="form-control" id="InputSenha" name="senha">
				</div>
				<button type="submit" class="btn btn-primary btn-lg btn-block">Entrar</button>
			</form>
		</div>
	</div>
	<?php
		ini_set ("display_errors", "off");
		$no = $_GET['no'];
		if ($no==1) {
			echo '<div class="alert alert-error">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>E-mail e/ou senha errados. </strong>
				</div>';
		}
	?>
</body>
	
</html>