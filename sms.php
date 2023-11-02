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
		$email = $_SESSION['login'];
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
	<script src="js/addCampo.js"></script>
	<script type="text/javascript">
		
$(function(){
 
    
    $(".maxlength").keyup(function(event){
 
       
        var target    = $("#content-countdown");
 
        
        var max        = target.attr('title');
 
       
        var len     = $(this).val().length;
 
        
        var remain    = max - len;
 
        
        if(len > max)
        {
            
            var val = $(this).val();
            $(this).val(val.substr(0, max));
 
            
            remain = 0;
        }
 
        
        target.html(remain);
 
    });
 
});
	</script>
		<!-- Inicio do conteudo -->
		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-10">
						<h1 class="page-header"> <br/> Enviar SMS</h1>
					</div>
				</div>
				<br>
				<!-- INICIO DO FORM -->
				<form action="home.php?pagina=sms" method="post" role="form">
					<div class="row">
						<div class="col-md-10">
							<div class="form-group">
								<label for="exampleTextArea">Mensagem:</label>
								<textarea class="form-control maxlength" id="exampleTextArea" rows="10" maxlength="140" name="msgSMS"></textarea>
								<p id="cont-sms">Caracteres restantes: <span id="content-countdown" title="140">140</span></p>
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
			ini_set ("display_errors", "off");
			$msgSMS = $_POST['msgSMS'];
			$user = $cod;
			$dtEnvio = date("Y-m-d");
			$hrEnvio = date("H:i:s");
			$cont = 0;
			if ($msgSMS != null) {
				include("conexao.php");
				$inserirSMS = "insert into tab_sms values ('','$msgSMS','$dtEnvio','$hrEnvio','$user')";
				$insercaoSMS = mysqli_query($conexao, $inserirSMS);
				if (!$insercaoSMS) {
					die('Problema ao enviar SMS');
				}
				$cod_sms = mysqli_insert_id($conexao);

				if (isset($_POST['curso']) and isset($_POST['modulo'])) {
					for ($i=0; $i < count($_POST['curso']); $i++) {
						$codcurso = $_POST['curso'][$i];

						$codmodulo = $_POST['modulo'][$i];

						$procuraTurma = "SELECT cod_turma FROM turma WHERE cod_curso = '$codcurso' AND cod_modulo = '$codmodulo'";
						$resulTurma = mysqli_query($conexao, $procuraTurma);
						while ($turma = mysqli_fetch_array($resulTurma)) {
							$codTurma = $turma['cod_turma'];

							$procuraTP = "SELECT cod_tab_pessoas_turma, cod_pessoas, status_pessoa_turma FROM tab_pessoas_turma WHERE cod_turma = '$codTurma'";
							$resulTP = mysqli_query($conexao, $procuraTP);
							while ($TP = mysqli_fetch_array($resulTP)) {
								$statusAtual = $TP ['status_pessoa_turma'];
								if ($statusAtual == 1) {
									$pessoaTurma = $TP['cod_tab_pessoas_turma'];
									$codPessoa = $TP['cod_pessoas'];

									$inserirSMSPESSOASTURMA = "insert into tab_sms_pessoas_turma values ('','$cod_sms','$pessoaTurma')";
									$insercaoSMSPESSOASTURMA = mysqli_query($conexao, $inserirSMSPESSOASTURMA);

									$procuraCel = "SELECT cel_pessoas FROM tab_pessoas WHERE cod_pessoas = '$codPessoa'";
									$resulCel = mysqli_query($conexao, $procuraCel);
									while ($sms = mysqli_fetch_array($resulCel)) {
										$cel = $sms['cel_pessoas'];
										$login = 'luande_lm@yahoo.com.br';
									    $senha = 'tcc2015';
									    $mensagem = $msgSMS;

									   
									    $url = 'http://sms.3ring.com.br/enviar_mensagem?';
									   
									    $campos = array(
									    	'u'=>urlencode($login),
									        'p'=>urlencode($senha),
									        'n'=>urlencode($cel),
									        'm'=>urlencode($mensagem)
									    );

			
									    $string_campos = "";
									    foreach($campos as $name => $valor) {
									        $string_campos .= $name . '=' . $valor . '&';
									    }

									    $string_teste = rtrim($string_campos,'&');

									    $ch = curl_init();

									    $url = $url . $string_teste;
									   
									    curl_setopt($ch,CURLOPT_URL,$url);
									    
									    curl_setopt($ch,CURLOPT_RETURNTRANSFER, TRUE);
									    curl_setopt($ch,CURLOPT_POST,count($campos));
									    curl_setopt($ch,CURLOPT_POSTFIELDS,$string_teste);

									
									    $resultado = curl_exec($ch);
											if ($resultado == 'ok') {
												$cont++;
											}	

									    curl_close($ch);
									}
								}								
							} 
						}
					}
				}

				echo '<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>'.$resultado.'</strong></div>';
				$confere = "SELECT controleSMS FROM tab_controlesms WHERE cod_controleSMS = 1";
				$query = mysqli_query($conexao, $confere);
				while ($cfSMS = mysqli_fetch_array($query)){
					$qtSMS = $cfSMS['controleSMS'];
				}
				$calcula = $qtSMS - $cont;

				$atualiza = mysqli_query($conexao, "UPDATE tab_controlesms SET controleSMS='$calcula' WHERE cod_controleSMS = '1'");
			}
			mysqli_close();
			
		 ?>
</body>
</html>