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
	
	} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Trabalho de TCC</title>

	
	<!-- Abaixo recursos para utilizar HTML5 no IE8 -->
    <!-- ATENÇÃO: Respond.js não funciona se for acessado via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
		<!-- Inicio do conteudo -->
		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-10">
						<h1 class="page-header"> <br/> Procurar Mensagem de Texto</h1>
					</div>
				</div>
				<br>

				<!-- INICIO DO FORM -->
				<form action="home.php?pagina=busca_sms" method="post" class="form-group form-group-lg">
					<div class="col-md-3">
						<div class="row">
							<div class "form-group">
							<label for="inputBuscaIni">Data Inicial:
								<input name="dataIni" class="form-control" type="date">
							</label>
							</div>		
						</div>
					</div>
					<div class="col-md-4">
						<div class="row">
							<div class "form-group">
								<label for="inputBuscaFin">Data Final:
									<input type="date" class="form-control" name="dataFin">
								</label>
								&nbsp;
								<button type="submit" class="btn btn-primary btn-lg">&nbsp;Buscar&nbsp;</button>
							</div>
						</div>
					</div>
					<br><br><br><br>					
				</form>
				<!-- FIM DO FORM -->

<?php
	include("formata_data.php");
	ini_set("display_errors", "off");
	$dt_inicial = $_POST['dataIni'];
	$dt_final = $_POST['dataFin'];

	include("conexao.php");
	if (!$conexao){
		die('<div>
		<strong>Problema de conexão.</strong> Desculpe, mas não foi possível conectar ao nosso servidor.
		</div>');
	}
			
	else {

		if (($dt_final == 0 || $dt_inicial == 0) || ($dt_final == 0 && $dt_inicial == 0)){
			echo "Digite as datas corretamente!";
		}

		elseif ($dt_final < $dt_inicial){
		echo "A data inicial deve ser maior do que a data final!";
		}

		elseif ($dt_final >= $dt_inicial){
			$procurar_sms= "SELECT * FROM tab_sms WHERE dt_sms BETWEEN '$dt_inicial' AND '$dt_final'";
			$resultado= mysqli_query($conexao,$procurar_sms);
				echo'<br><table class="table">
			 	<thead>
			 		<tr>
			 			<th> Data de Envio </th>
			 			<th> Hora do Envio </th>
			 			<th> Email </th>
			 			<th> Nome do Usuário </th>
			 		</tr>
			 	</thead>
				<tbody>';

				while ($dados = mysqli_fetch_array($resultado)) {
					$data = formata_data($dados['dt_sms']);
					$hora = $dados['hr_sms'];
					$mensagem = $dados['mensagem_sms'];
					$user = $dados['cod_usuario'];               							
					
					$procuraUsuario = "SELECT * FROM tab_usuario WHERE cod_usuario = '$user'";
					$resultUsuario = mysqli_query($conexao, $procuraUsuario);
						while ($usuario = mysqli_fetch_array ($resultUsuario)){
							$nomeuser = $usuario['nome_usuario'];
							echo " <tr>
						          <td width=70>".$data."</td>
						          <td width=70>".$hora."</td>
						          <td width=300>".$mensagem."</td>
						          <td width=70>".$nomeuser."</td>
						     </tr>";
						} 
					}
			echo '</table>';
		}
	}
?>

			</div>
		</div>
	
	
</body>
</html>