<?php
	ini_set("display_errors", "off");
	session_start(); 
	if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true)) {
		unset($_SESSION['codigo']);
		unset($_SESSION['login']); 
		unset($_SESSION['senha']); 
		unset($_SESSION['nome']);
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
	
</head>
<body>
	<!-- Inicio do conteudo -->
		<div id="page-wrapper">
			<?php 
			include("dadosdash.php");
			include("formata_data.php"); ?>
			<br>
			<br>
			<br>
			<br>
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-4">
						<div class="panel panel-primary">
							<div class="circulo"><?php echo $totalSMS; ?></div>
							<div class="panel-heading">
								<h3>SMS RESTANTES</h3>								
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="panel panel-primary">
							<p class="circulo"><?php echo $contSMS; ?></p>
							<div class="panel-heading">
								<h3>SMS ENVIADOS</h3>								
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="panel panel-primary">
							<p class="circulo"><?php echo $contEmail; ?></p>
							<div class="panel-heading">
								<h3>EMAILS ENVIADOS</h3>								
							</div>
						</div>
					</div>
				</div> <!-- Fim da row dos numeros -->
				<div class="row">
					<div class="col-md-4">
						<div class="panel panel-success">
							<div class="panel-heading">
								<h3>Último SMS enviado</h3>
							</div>
							<table class="table">
								<?php 
									echo "<tr>
											<td>".formata_data($dt_sms)."</td>
											<td>".$hr_sms."</td>
											<td>".$msgSMS."</td>
										 </tr>";
								?>
							</table>
						</div>
					</div>
					<div class="col-md-4">
						<div class="panel panel-success">
							<div class="panel-heading">
								<h3>Último E-mail enviado</h3>
							</div>
							<table class="table">
								<?php 
									echo "<tr>
											<td>".formata_data($dt_email)."</td>
											<td>".$hr_email."</td>
											<td>".$msgEmail."</td>
										 </tr>";
								?>
							</table>
						</div>
					</div>
					<div class="col-md-4">
						<div class="panel panel-success">
							<div class="panel-heading">
								<h3>Últimos logins Realizados</h3>
							</div>
							<table class="table">
								<?php 
									for ($i=$k-1; $i >= 0; $i--) { 
										echo "<tr>
												<td>".$codigo[$i]."</td>
												<td>".$usuario[$i]."</td>
												<td>".formata_data($dt_log[$i])."</td>
												<td>".$hr_log[$i]."</td>
											 </tr>";
									}
								?>
							</table>
						</div>
					</div>
				</div> <!-- Fim da row dos ultimos -->
			</div>
		</div>
</body>
</html>