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
	<script src="js/jquery.buscaPorCPF.js"></script>
	<script src="js/JsValidacaoMascara.js"></script>
	<script src="js/jquery.maskedinput-1.3.min.js"></script>
	<script src="js/projeto.mascarajquery.js"></script>

		<!-- Inicio do conteudo -->
		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h1 class="page-header">Seja Bem Vindo! <small>Cadastro</small></h1>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-12">
						<!-- INÍCIO DO FORM -->
						<form action="home.php?pagina=cadastro" method="post" name="pessoas" class="form-group form-group-lg">
							<div class="row">
								<div class="col-md-3">
									<label for="cpf">CPF:</label>
									<input name="cpf" class="form-control" type="text" id="cpf" onblur="javascript: validarCPF(this.value);" onkeypress="javascript: mascara(this, cpf_mask);"  maxlength="14" />
									
								</div>
								<div class="col-md-2">
									<label for="inputCod">Código:</label>
									<input type="text" class="form-control" name="codigo" id="inputCod" readonly>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-6">
									<label for="inputNome">Nome:</label>
									<input type="text" class="form-control" name="nome" id="inputNome" required>
								</div>
								<div class="col-md-3">
									<label for="inputDtNasc">Data de Nascimento:</label>
									<input type="date" class="form-control" name="dtNasc" id="inputDtNasc">
								</div>
								
							</div>
							<br>
							<div class="row">
								<div class="col-md-3">
									<label for="inputCel">Celular:</label>
									<input type="tel" class="form-control" name="cel" id="inputCel" required>
								</div>
								<div class="col-md-6">
									<label for="inputEmail">E-mail:</label>
									<input type="email" class="form-control" name="email" id="inputEmail">
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
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label for="cadCurso">Curso:</label>
										<select name="curso" id="cadCurso" class="form-control">
											<option value="">Selecione</option>
											<option value="1">Administração</option>
											<option value="2">Contabilidade</option>
											<option value="3">Informática para Internet</option>
											<option value="4">Marketing</option>
											<option value="5">Redes</option>
											<option value="6">Serviços Jurídicos</option>
										</select>
									</div>
								</div>
								<div class="col-md-4 col-md-offset-1">
									<div class="form-group">
										<label for="cadrModulo">Módulo:</label>
										<select name="modulo" id="cadModulo" class="form-control">
											<option value="">Selecione</option>
											<option value="1">1º Módulo</option>
											<option value="2">2º Módulo</option>
											<option value="3">3º Módulo</option>
										</select>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-3 col-md-offset-7">
									<button type="submit" class="btn btn-primary btn-lg">&nbsp;&nbsp;Salvar&nbsp;&nbsp;</button>
									<button type="button" class="btn btn-default btn-lg">Cancelar</button>
								</div>
							</div>
						</form><!--FIM DO FORM -->
					</div>
				</div>
			</div>
		</div>
		<!-- Fim do conteudo -->
		<?php
			ini_set ("display_errors", "off");
			$nome = $_POST['nome'];
			$codigo = $_POST['codigo'];
			$cel = $_POST['cel'];
			$dtNasc = $_POST['dtNasc'];
			$cpf = $_POST['cpf'];
			$curso = $_POST['curso'];
			$modulo = $_POST['modulo'];
			$email = $_POST['email'];
			$aceitaSMS = $_POST['radioSMS'];
			$aceitaEmail = $_POST['radioEmail'];

			
			include("conexao.php");
				if (!$conexao){
					die('<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Problema de conexão.</strong> Desculpe, mas não foi possível conectar ao nosso servidor.
						</div>');
				}
				else {
					$queryTurma = "SELECT * FROM turma WHERE cod_curso = '$curso' AND cod_modulo = '$modulo'";
					$resultado = mysqli_query($conexao, $queryTurma);
					$VerTurma = mysqli_fetch_array($resultado);
					$Turma = $VerTurma['cod_turma'];
				}			

				if (($nome!=NULL)&&($cel!=NULL)&&(dtNasc!=NULL)&&($cpf!=NULL)&&($curso!=NULL)&&($aceitaSMS!=NULL)&&($aceitaEmail!=NULL)&&($codigo==NULL)){
					
					
					if (!$conexao){
						die('<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Problema de conexão.</strong> Desculpe, mas não foi possível conectar ao nosso servidor.
							</div>');
					}
					else {
							$inserir1 = "insert into tab_pessoas values ('','$nome','$cel','$dtNasc','$cpf','$email','$aceitaEmail','$aceitaSMS',1)";
							$insercao = mysqli_query($conexao, $inserir1); 
							if(!$insercao){
								die('<div class="alert alert-danger">
									<button type="button" class="close" data-dismiss="alert">&times;</button>
									<strong>Problema ao inserir (PESSOAS).</strong> Desculpe, houve um problema ao inserir seus dados em nosso sistema.
									</div>');
							}
							$cod_pessoas = mysqli_insert_id($conexao); 

							echo "codigo pessoa: ".$cod_pessoas."<br>";
							
							echo "Código da pessoa: ".$cod_pessoas;
							echo "<br>Código Turma Módulo: ".$Turma."<br>";

																							
							$inserir2 = "insert into tab_pessoas_turma values ('','$cod_pessoas','$Turma',1)";
							$insercao2 = mysqli_query($conexao, $inserir2); 
							if(!$insercao2){
								die('<div class="alert alert-danger">
									<button type="button" class="close" data-dismiss="alert">&times;</button>
									<strong>Problema ao inserir (PESSOAS TURMA).</strong> Desculpe, houve um problema ao inserir seus dados em nosso sistema.
									</div>');
							}

							else{
								mysqli_close($conexao);
								echo '<div class="alert alert-success">
									<button type="button" class="close" data-dismiss="alert">&times;</button>
									<strong>Cadastro Realizado com Sucesso.</strong></div>';
							}
						}
				}
				elseif ($codigo!=null) {
					$inserir2 = "insert into tab_pessoas_turma values ('','$codigo','$Turma',1)";
					$insercao2 = mysqli_query($conexao, $inserir2); 
					if(!$insercao2){
						die('<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Problema ao inserir (PESSOAS TURMA).</strong> Desculpe, houve um problema ao inserir seus dados em nosso sistema.
							</div>');
					}
					else{
						mysqli_close($conexao);
						echo '<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Cadastro Realizado com Sucesso.</strong></div>';
					}
				}
				else {
					echo '<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Preencha Todos os Campos.</strong>
						</div>';
				}
			mysqli_close();
		?> 

	</div> 
</body>
</html>