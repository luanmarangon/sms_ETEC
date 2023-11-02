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
		
		include("conexao.php");
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
						<h1 class="page-header">Cadastro de Curso e Turma</h1>
						<div class="tabbable">
						<ul class="nav nav-tabs">
							<li class="active">
								<a href="#tab1" data-toggle="tab">Cadastro de Curso</a>
							</li>
							<li>
								<a href="#tab2" data-toggle="tab">Cadastro de Turma</a>
							</li>
						</ul>
						<div class="tab-content" id="nav-bordas">
							<div class="tab-pane active" id="tab1">
								<div class="row-fluid">
						            <div class="col-md-12">
						              <h3>Cadastro de Curso</h3><br>
						                <ul>
						                	<form action="cad.php" method="post" class="form-inline">
						                		<div class="row">
						                			<div class="form-group">
						                				<label for="inputCurso">Nome do Curso:</label>
						                				<input type="text" class="form-control" id="inputCurso" name="cadcurso">
						                				<button type="submit" class="btn btn-primary">OK</button>
						                			</div>
						                		</div>
						                	</form>
							            </ul>
							         </div>
							     </div>							             
							</div>
							<div class="tab-pane" id="tab2">
								<div class="row-fluid">
						            <div class="col-md-12">
						              <h3>Cadastro de Turma</h3><br>
						                <ul>
						                	<form action="cad.php" method="post" class="form-inline">
						                		<div class="row">
						                			<div class="form-group">
						                				<label for="cursos">Curso:</label>
						                				<select name="curso" id="cursos" class="form-control">
						                					<option value="">Selecione</option>
						                					<?php
																if (!$conexao){
																	die('<strong>Problema de conexão.</strong> Desculpe, mas não foi possível conectar ao nosso servidor.
																		</div>');
																}
																else{
																	$procura1 = "SELECT * FROM tab_curso";
																	$resultado = mysqli_query($conexao, $procura1);
																	while ($org = mysqli_fetch_array($resultado)){
																		echo "<option value=".$org['cod_curso'].">".$org['nome_curso']."</option>";
																	}
																}
						                					?>
														</select>
														&nbsp;
														<label for="modulos">Módulo:</label>
						                				<select name="modulo" id="modulos" class="form-control">
						                					<option value="">Selecione</option>
						                					<?php
																if (!$conexao){
																	die('<strong>Problema de conexão.</strong> Desculpe, mas não foi possível conectar ao nosso servidor.
																		</div>');
																}
																else{
																	$procura2 = "SELECT * FROM tab_modulo";
																	$resultado2 = mysqli_query($conexao, $procura2);
																	while ($org2 = mysqli_fetch_array($resultado2)){
																		echo "<option value=".$org2['cod_modulo'].">".$org2['modulo']."</option>";
																	}
																}
																mysqli_close();
						                					?>
														</select>
														&nbsp;
						                				<button type="submit" class="btn btn-primary">OK</button>
						                			</div>
						                		</div>
						                	</form>
							            </ul>
							         </div>
							     </div>							             
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php 
			ini_set("display_errors", "off");
			$ok = $_GET['ok'];
			if ($ok == 1) {
				echo '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Cadastro realizado com sucesso.</strong>
				</div>';
			}
			elseif ($ok == 2) {
				echo '<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Erro ao Cadastrar.</strong> Verifique se a turma atual já não se encontra no 3º Módulo.
				</div>';
			}
        ?>
	
</body>
</html>