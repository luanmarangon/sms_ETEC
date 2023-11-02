
<?php
	session_start(); 
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
<?php
	include("formata_data.php");
	ini_set("display_errors", "off");
	$dt_inicial = $_POST['dataIni'];
	$dt_final = $_POST['dataFin'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- Abaixo recursos para utilizar HTML5 no IE8 -->
    <!-- ATENÇÃO: Respond.js não funciona se for acessado via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
	<script>
    	$('#Tabs a').click(function (e) {
		  e.preventDefault()
		  $(this).tab('show')
		})
    </script>
    <!-- Inicio do conteudo -->
		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
			<br/>	
	<h1> Relatório de E-Mail enviados.</h1>
	<h4>Periodo: <?php echo formata_data($dt_inicial) ?> à <?php echo formata_data($dt_final) ?></h4>
	<br/> <br/>
	<a class="btn btn-default" href="javascript:history.go(-1);"> Retornar</a> 

	<a class="btn btn-default" href="javascript:window.print();">Imprimir postagem</a>
	
	<table class="table">
		<thead>
			<tr>
				<th width=70> Data de Envio </th>
				<th width=70> Hora do Envio </th>
				<th width=300> Email </th>
				<th width=70> Código do Usuário </th>
			</tr>
		</thead>
		<tbody>
      
	<?php
	
	include ("conexao.php");
	
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
			$procurar_email= "SELECT * FROM tab_email WHERE dt_envio BETWEEN '$dt_inicial' AND '$dt_final'  ORDER BY dt_envio";
			$resultado= mysqli_query($conexao,$procurar_email);
			
				while ($msgEMAIL = mysqli_fetch_array($resultado)) {
							$mensagem = $msgEMAIL['mensagem_email'];
							$data = formata_data($msgEMAIL['dt_envio']);
							$hora = $msgEMAIL['hr_envio'];
							$user = $msgEMAIL['cod_usuario'];
							           							
				
					$procuraUsuario = "SELECT nome_usuario FROM tab_usuario WHERE cod_usuario = '$user'";
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
						echo "</tbody>";
		}
	}
?>
	 </tbody>
	</table>
				</div>
			</div>
		</div>

	</div> <!--fim do WRAPPER -->
</body>
</html>