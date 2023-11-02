<?php
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
						<h1 class="page-header"> <br/> Enviar E-mail</h1>
					</div>
				</div>
				<br>
				<!-- INICIO DO FORM -->
				<form action="home.php?pagina=email" method="post" role="form">
					<div class="row">
						<div class="col-md-10">
							<div class="form-group">
								<label for="exampleTextArea">Mensagem:</label>
								<textarea class="form-control" id="msgEmail" rows="10" name="msgEmail"></textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group" id="select">
								<div class="col-md-5">
									<label for="selCurso">Selecione o Curso:</label>
									<select name="curso[]" id="selCurso" class="form-control">
										<option value="">Selecione</option>
										<option value="1">Administração</option>
										<option value="2">Contabilidade</option>
										<option value="3">Informática para Internet</option>
										<option value="4">Marketing</option>
										<option value="5">Redes</option>
										<option value="6">Serviços Jurídicos</option>
									</select>
								</div>
								<div class="col-md-5">
									<label for="selModulo">Selecione o Módulo:</label>
									<select name="modulo[]" id="selModulo" class="form-control">
										<option value="">Selecione</option>
										<option value="1">1º Módulo</option>
										<option value="2">2º Módulo</option>
										<option value="3">3º Módulo</option>
									</select>
								</div>
							</div>
							<div class="col-md-2">
								<button type="button" value="+" id="add" class="btn btn-primary">+</button>
							</div>				
						</div>
					</div>
					<br><br>
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-2 col-md-offset-9">
								<button type="submit" id="buttonGrupo" class="btn btn-primary">Enviar</button>
							</div>
						</div>
					</div>
				</form>
				<!-- FIM DO FORM -->
			</div>
		</div>
		<?php
			ini_set("display_errors", "off");
			$date_envio = date("Y-m-d");
			$hora_envio = date("H:i:s");
			$msgEmail = $_POST['msgEmail'];
			$user = $cod;
			if ($msgEmail != null) {
				$conexao = mysqli_connect("localhost","root","","db_sms");
				$inserirEmail = "insert into tab_email values ('','$msgEmail', '$date_envio','$hora_envio', '$user')";
				$insercaoEmail = mysqli_query($conexao, $inserirEmail);
				if (!$insercaoEmail) {
					die('Problema ao enviar E-mail');
				}
				$cod_email = mysqli_insert_id($conexao); 

				if (isset($_POST['curso']) and isset($_POST['modulo'])) {
					for ($i=0; $i < count($_POST['curso']); $i++) {
						$codcurso = $_POST['curso'][$i];

						$codmodulo = $_POST['modulo'][$i];

						$procuraTurma = "SELECT cod_turma FROM turma WHERE cod_curso = '$codcurso' AND cod_modulo = '$codmodulo'";
						$resulTurma = mysqli_query($conexao, $procuraTurma);
						while ($turma = mysqli_fetch_array($resulTurma)) {
							$codTurma = $turma['cod_turma'];

							$procuraTP = "SELECT cod_tab_pessoas_turma, cod_pessoas FROM tab_pessoas_turma WHERE cod_turma = '$codTurma'";
							$resulTP = mysqli_query($conexao, $procuraTP);
							while ($TP = mysqli_fetch_array($resulTP)) {							
								$pessoaTurma = $TP['cod_tab_pessoas_turma'];
								$codPessoa = $TP['cod_pessoas'];


								$inserirEMAILPESSOASTURMA = "insert into tab_pessoas_turma_email values ('','$pessoaTurma','$cod_email')";
								$insercaoEMAILPESSOASTURMA = mysqli_query($conexao, $inserirEMAILPESSOASTURMA); 

								$procuraEmail = "SELECT email_pessoas FROM tab_pessoas WHERE cod_pessoas = '$codPessoa'";
								$resulEmail = mysqli_query($conexao, $procuraEmail);
								 
								while ($email = mysqli_fetch_array($resulEmail)) {
								
									$dest_email = $email['email_pessoas'];
									$mensagem = $msgEmail;
								
									

									$assunto = 'Comunicado ETEC Arruda Mello';
									
									

									require_once("phpmailer\class.smtp.php");
									require_once("phpmailer\class.phpmailer.php");
									 
									$mail = new PHPMailer();
									
									$mail->IsSMTP(); 
									$mail->Host = "smtp.gmail.com"; 
									$mail->SMTPDebug = 0;		
									$mail->SMTPSecure = 'tls';	
									$mail->SMTPAuth = true; 
									$mail->Username = 'luanemayra@gmail.com'; 
									$mail->Password = 'LYVIAMARANGON'; 
									$mail->Port = 587;
									 
									
									$mail->From = "luanemayra@gmail.com";
									$mail->Sender = "luanemayra@gmail.com"; 
									$mail->FromName = "ETEC Arruda Mello"; 
									 
									
									$mail->AddAddress($dest_email);
									
									$mail->IsHTML(true);
									$mail->CharSet = 'utf8_encode'; 
									 
									
									$mail->Subject  = $assunto;
									$mail->Body = $mensagem;
									
									$enviado = $mail->Send();
									 
									
									$mail->ClearAllRecipients();
									$mail->ClearAttachments();
									 
								}						
							} 
						}
					}
				}
				if ($enviado) {
					echo "E-mail enviado com sucesso! <br/>";
					} else {
					echo "Não foi possível enviar o e-mail.<br/>";

					echo "Informações do erro: " . $mail->ErrorInfo;
				}
			}
		 ?>
	</div> <!--fim do WRAPPER -->

	<!--Incluindo plugin JQuery -->
	<script src="js/jquery-1.11.1.min.js"></script>
	<!-- Incluindo o js do Bootstrap (.min) -->
	<script src="js/bootstrap.min.js"></script>
	<script src="js/addCampo.js"></script>
</body>
</html>