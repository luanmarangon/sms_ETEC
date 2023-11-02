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
		$cod = $_SESSION['codigo'];
		include("conexao.php");
		if (!$conexao){
			die('<strong>Problema de conexão.</strong> Desculpe, mas não foi possível conectar ao nosso servidor.
				</div>');
		}
	} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>SMS</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/estilo.css">
	<link rel="stylesheet" href="css/seta.css">
</head>
<body>
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script>
		$('#Tabs a').click(function (e) {
			e.preventDefault();
			$(this).tab('show');
		});
	</script>

	<div id="page-wrapper">
		<div class="content-fluid">
			<div class="row">
				<div class="col-md-12"><br>
					<h1>Defina o Status do(s) Aluno(s)</h1>
					<div class="tabbable">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab1" data-toggle="tab">Status Por Aluno</a></li>
							<li><a href="#tab2" data-toggle="tab">Status Por Turma</a></li>
							<li><a href="#tab3" data-toggle="tab">Atualizar Turma</a></li>
						</ul>
						<div class="tab-content" id="nav-bordas">
							<div class="tab-pane active" id="tab1">
								<div class="row">
									<div class="col-md-12">
										<h3>Status Por Aluno</h3>
										<form action="#" method="post" class="form-inline">
											<label for="inputAluno">Nome do aluno:</label>
											<input type="text" name="aluno" class="form-control" id="inputAluno">
											<button type="submit" class="btn btn-primary">OK</button>
										</form>
									</div>
								</div>
							</div> <!-- fim do tab1 -->

							<div class="tab-pane" id="tab2">
								<div class="row">
									<div class="col-md-12">
										<h3>Status Por Turma <small>Lista alunos ativos por turma</small></h3><br>
										<form action="#" method="post" class="form-inline">
											<label for="cursos">Curso:</label>
											<select name="curso" id="cursos" class="form-control">
												<option value="">Selecione</option>
												<?php 
													$procura1 = "SELECT * FROM tab_curso";
													$resultado = mysqli_query($conexao, $procura1);
													while ($org = mysqli_fetch_array($resultado)) {
														echo "<option value=".$org['cod_curso'].">".$org['nome_curso']."</option>";
													}
												?>
											</select>
											&nbsp;
											<label for="modulos">Módulo:</label>
											<select name="modulo" id="modulos" class="form-control">
												<option value="">Selecione</option>
												<?php 
													$procura2 = "SELECT * FROM tab_modulo";
													$resultado2 = mysqli_query($conexao, $procura2);
													while ($org2 = mysqli_fetch_array($resultado2)) {
														echo "<option value=".$org2['cod_modulo'].">".$org2['modulo']."</option>";
													}
												?>
											</select>
											<button class="btn btn-primary" type="submit">OK</button>
										</form>
									</div>
								</div>
							</div> <!-- Fim do tab2 -->
							<div class="tab-pane" id="tab3">
								<div class="row">
									<div class="col-md-12">
										<h3>Atualizar Turma</h3>
										<form action="#" method="post" class="form-inline">
											<label for="cursos">Curso:</label>
											<select name="cursoT" id="cursos" class="form-control">
												<option value="">Selecione</option>
												<?php 
													$procura1 = "SELECT * FROM tab_curso";
													$resultado = mysqli_query($conexao, $procura1);
													while ($org = mysqli_fetch_array($resultado)) {
														echo "<option value=".$org['cod_curso'].">".$org['nome_curso']."</option>";
													}
												?>
											</select>
											&nbsp;
											<label for="modulos">Módulo:</label>
											<select name="moduloT" id="modulos" class="form-control">
												<option value="">Selecione</option>
												<?php 
													$procura2 = "SELECT * FROM tab_modulo";
													$resultado2 = mysqli_query($conexao, $procura2);
													while ($org2 = mysqli_fetch_array($resultado2)) {
														echo "<option value=".$org2['cod_modulo'].">".$org2['modulo']."</option>";
													}
												?>
											</select>
											<button class="btn btn-primary" type="submit">OK</button>
										</form>
									</div>
								</div>
							</div><!-- Fim do tab3 -->
						</div>
					</div> <!-- Fim do tabbable -->
					<?php include ("bstatusaluno.php"); ?>
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
			<strong>Turma atualizada com sucesso.</strong>
			</div>';
		}
		elseif ($ok == 2) {
			echo '<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Erro ao atualizar.</strong> Verifique se a turma atual já não se encontra no 3º Módulo.
			</div>';
		}
		if ($mostra = $_GET['mostra'] == 1) {
			echo '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Ação completada com sucesso.</strong>
				</div>';
		}
		elseif ($mostra = $_GET['mostra'] == 2) {
			echo '<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Houve algum erro.</strong>
			</div>';	
		}
	?>

</body>
</html>