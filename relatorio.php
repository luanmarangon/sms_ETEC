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
include ("conexao.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Trabalho de TCC</title>

	<!-- Incluindo o css do Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<!-- Incluindo o css de estilo, que vai modificar o Bootstrap -->
	<link rel="stylesheet" href="css/estilo.css">
	<link rel="stylesheet" href="css/seta.css">

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
	<!-- Incluindo as mascaras -->
    <script src="js/jquery.maskedinput-1.3.min.js"></script>
    <script src="js/projeto.mascarajquery.js"></script>
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
					<div class="col-md-12">
						<h1 class="page-header">Relatórios</h1>
						<div class="tabbable">
						<ul class="nav nav-tabs">
							<li class="active">
								<a href="#tab1" data-toggle="tab">Relatórios Aluno por Turma</a>
							</li>
							<li> 
								<a href="#tab2" data-toggle="tab">Relatórios SMS</a>
							</li>
							<li> 
								<a href="#tab3" data-toggle="tab">Relatórios E-Mail</a>
							</li>
							<li> 
								<a href="#tab4" data-toggle="tab">Log's do Sistema</a>
							</li>
						</ul>
							<div class="tab-content" id="nav-bordas">
													<!-- Relatorio de Pessoas-->
							<div class="tab-pane active" id="tab1">
								<div class="row-fluid">
						            <div class="col-md-12">
						              <h2 align="center">Gere um Relatório dos Alunos por Turma</h2><br>
						                <ul>
						                	<form action="home.php?pagina=ralunos" method="post" class="form-inline">
						                		<div class="row">
						                			<div class="form-group">
						                				<label for="cursos">Curso:</label>
						                				<select name="curso" id="cursos" class="form-control">
						                					<option value="">Selecione</option>
						                					<?php
						                						
																	$procura1 = "SELECT * FROM tab_curso";
																	$resultado = mysqli_query($conexao, $procura1);
																	while ($org = mysqli_fetch_array($resultado)){
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
																	while ($org2 = mysqli_fetch_array($resultado2)){
																		echo "<option value=".$org2['cod_modulo'].">".$org2['modulo']."</option>";
																	}
																
						                					?>
														</select>
														&nbsp;
						                				<button type="submit" class="btn btn-primary">&nbsp;Gerar&nbsp;</button>
						                			</div>
						                		</div>
						                	</form>

							            </ul>
							         </div>
							     </div>								             
							</div>
												<!-- Relatorio de SMS-->
							<div class="tab-pane" id="tab2">
								<div class="row-fluid">
						            <div class="col-md-12">
						              <h2 align="center">Gere seus Relatórios de SMS</h2><br>
						                <ul>
						                	<h3>Selecione o Curso e o Modulo.</h3>
						                	<form action="home.php?pagina=rsms" method="post" class="form-inline">
						                		<div class="row">
						                			<div class="form-group">
						                				<label for="cursos">Curso:</label>
						                				<select name="curso" id="cursos" class="form-control">
						                					<option value="">Selecione</option>
						                					<?php
						                						
																	$procura1 = "SELECT * FROM tab_curso";
																	$resultado = mysqli_query($conexao, $procura1);
																	while ($org = mysqli_fetch_array($resultado)){
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
																	while ($org2 = mysqli_fetch_array($resultado2)){
																		echo "<option value=".$org2['cod_modulo'].">".$org2['modulo']."</option>";
																	}
																
						                					?>
														</select>
														&nbsp;
						                				<button type="submit" class="btn btn-primary">&nbsp;Gerar&nbsp;</button>
						                			</div>
						                		</div>
						                	</form>
						                </ul>
							        </div>
							    </div>
							   </br>
							    <div class="row-fluid">
							    	<div class="col-md-12">							    	
							    		<ul>
							    			<h3>Escolha um Intervalo entre as datas.</h3>
						           			<!-- INICIO DO FORM (PESQUISA POR DATAS) -->
											<form action="home.php?pagina=rdtsms" method="post" role="form">
												<div class="col-md-3">		
													<div class="row">
														<div class="form-group">
															<label for ="inputBuscaIni">Data Inicial:  
																<input type="date" name="dataIni" class="form-control">
															</label>
														</div>
													</div>
												</div>
												<div class="col-md-3">		
													<div class="row">
														<div class="form-group">
															<label for ="inputBuscaFin">Data Final:  
																<input type="date" name="dataFin" class="form-control"> 
															</label>
															&nbsp;
															<button type="submit" class="btn btn-primary">&nbsp;Gerar&nbsp;</button><br><br>
														</div>
													</div>
												</div>
											</form>
											<!-- FIM DO FORM -->	
										</ul>
									</div>
								</div>
							</div>
							<!-- Relatorio de Email-->
							<div class="tab-pane" id="tab3">
								<div class="row-fluid">
						            <div class="col-md-12">
						              <h2 align="center">Gere seus Relatórios de E-Mail</h2><br>
						                <ul>
						                	<h3>Selecione o Curso e o Modulo.</h3>
						                	<form action="home.php?pagina=remail" method="post" class="form-inline">
						                		<div class="row">
						                			<div class="form-group">
						                				<label for="cursos">Curso:</label>
						                				<select name="curso" id="cursos" class="form-control">
						                					<option value="">Selecione</option>
						                					<?php
						                						
																	$procura1 = "SELECT * FROM tab_curso";
																	$resultado = mysqli_query($conexao, $procura1);
																	while ($org = mysqli_fetch_array($resultado)){
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
																	while ($org2 = mysqli_fetch_array($resultado2)){
																		echo "<option value=".$org2['cod_modulo'].">".$org2['modulo']."</option>";
																	}
																
						                					?>
														</select>
														&nbsp;
						                				<button type="submit" class="btn btn-primary">&nbsp;Gerar&nbsp;</button>
						                			</div>
						                		</div>
						                	</form>
						                </ul>
							        </div>
							    </div>
							   </br>
							    <div class="row-fluid">
							    	<div class="col-md-12">							    	
							    		<ul>
							    			<h3>Escolha um Intervalo entre as datas.</h3>
						           			<!-- INICIO DO FORM (PESQUISA POR DATAS) -->
											<form action="home.php?pagina=rdtemail" method="post" role="form">
												<div class="col-md-3">		
													<div class="row">
														<div class="form-group">
															<label for ="inputBuscaIni">Data Inicial:  
																<input type="date" name="dataIni" class="form-control">
															</label>
														</div>
													</div>
												</div>
												<div class="col-md-3">		
													<div class="row">
														<div class="form-group">
															<label for ="inputBuscaFin">Data Final:  
																<input type="date" name="dataFin" class="form-control"> 
															</label>
															&nbsp;
															<button type="submit" class="btn btn-primary">&nbsp;Gerar&nbsp;</button><br><br>
														</div>
													</div>
												</div>
											</form>
											<!-- FIM DO FORM -->	
										</ul>
									</div>
								</div>
							</div>
					

						<!-- Relatorio de log-->
							<div class="tab-pane" id="tab4">
								<div class="row-fluid">
						            <div class="col-md-12">
						              <h2 align="center">Gere seus Relatórios de logs</h2><br>
						                <ul>
						                	<h3>Selecione o Curso e o Modulo.</h3>
						                	<form action="home.php?pagina=log" method="post" class="form-inline">
						                		<div class="row">
						                			<div class="form-group">
						                				<label for="usuarios">Usuario:</label>
						                				<select name="usuario" id="usuarios" class="form-control">
						                					<option value="">Selecione</option>
						                					<?php
						                						
																	$procura1 = "SELECT * FROM tab_usuario";
																	$resultado = mysqli_query($conexao, $procura1);
																	while ($org = mysqli_fetch_array($resultado)){
																		echo "<option value=".$org['cod_usuario'].">".$org['nome_usuario']."</option>";
																	}
															?>
														</select>
														&nbsp;
														
						                				<button type="submit" class="btn btn-primary">&nbsp;Gerar&nbsp;</button>
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

	</div> <!--fim do WRAPPER -->
</body>
</html>