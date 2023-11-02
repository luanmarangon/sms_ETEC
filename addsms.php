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
		
		<!-- Inicio do conteudo -->
		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h1 class="page-header">Cadastre os Pacotes de SMS</h1>
						<p>Após realizar a compra de pacotes de SMS, informe no campo abaixo a quantidade de SMS comprada.</p>
						<p>Para comprar SMS, <a href="http://sms.3ring.com.br/autenticar/login" target="_blank">clique aqui</a>.</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<form action="home.php?pagina=addsms" method="post" class="form-inline">
							<div class="form-group">
								<br>
						    	<label for="inputSMS">Quantidade de SMS comprada:</label>
						        <input type="text" class="form-control" id="inputSMS" name="cadsms">
						        <button type="submit" class="btn btn-primary">Cadastrar</button>
						    </div>
						</form>
					</div>
				</div>
				<?php
					ini_set("display_errors", "off");
					$novoSMS = $_POST['cadsms'];
					include ("conexao.php");
					if (!$conexao){
						die('<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Problema de conexão.</strong> Desculpe, mas não foi possível conectar ao nosso servidor.
							</div>');
					}
					if ($novoSMS != null) {
						$confere = "SELECT controleSMS FROM tab_controlesms WHERE cod_controleSMS = 1";
						$query = mysqli_query($conexao, $confere);
						while ($cfSMS = mysqli_fetch_array($query)){
							$qtSMS = $cfSMS['controleSMS'];
						}
						$qtdeSMS = $qtSMS + $novoSMS;

						$atualiza = mysqli_query($conexao, "UPDATE tab_controlesms SET controleSMS='$qtdeSMS' WHERE cod_controleSMS = '1'");

						echo '<br><div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Pacote de SMS inserido com sucesso!</strong> Agora você tem '.$qtdeSMS.' SMS para usar.
							</div>';
					}
					mysqli_close();
				?>
			</div>
		</div>
		<!-- Fim do conteudo -->
		
	
</body>
</html>