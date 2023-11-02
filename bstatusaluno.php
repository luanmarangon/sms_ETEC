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
	<div id="page-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<table class="table">
						<?php
							include("conexao.php");
							if (!$conexao){
								die('<strong>Problema de conexão.</strong> Desculpe, mas não foi possível conectar ao nosso servidor.
									</div>');
							}
							else{
								ini_set("display_errors", "off");
						       	$aluno = $_POST['aluno'];
						       	$curso = $_POST['curso'];
						       	$modulo = $_POST['modulo'];
						       	$cursoT = $_POST['cursoT'];
						       	$moduloT = $_POST['moduloT'];
						       	if ($aluno != null) {
						       		echo '<table class="table">
									<thead>
										<tr>
											<th>Código</th>
											<th>Nome</th>
											<th>CPF</th>
											<th>STATUS</th>
											<th>Curso</th>
											<th>Módulo</th>
											<th>&nbsp;</th>
										</tr>
									</thead>
									<tbody>';
									$pessoa = "SELECT P.cod_pessoas, P.nome_pessoas, P.cpf_pessoas, T.status_pessoa_turma, T.cod_turma, M.cod_modulo, 
						     		M.modulo, C.cod_curso, C.nome_curso 
									FROM tab_pessoas P, tab_pessoas_turma T, tab_modulo M, tab_curso C, turma TU
									WHERE P.nome_pessoas LIKE '%".$aluno."%' 
									and P.cod_pessoas = T.cod_pessoas
									and t.cod_turma = TU.cod_turma
									and TU.cod_modulo = M.cod_modulo
									and TU.cod_curso = C.cod_curso
									ORDER BY P.nome_pessoas";
							     	$procura = mysqli_query($conexao, $pessoa);
							     	while ($resultado = mysqli_fetch_array($procura)) {
										$codigo = $resultado['cod_pessoas'];
										$nome = $resultado['nome_pessoas'];
										$cpf = $resultado['cpf_pessoas'];
										$status = $resultado['status_pessoa_turma'];
										$modulo = $resultado['modulo'];
										$curso = $resultado['nome_curso'];
										$codTurma = $resultado['cod_turma'];
										if ($status == 1) {
											echo '<tr>';
											echo '<td>'.$codigo.'</td>'.'<td>'.$nome.'</td>'.'<td>'.$cpf.
											'</td>'.'<td>Aluno Ativo</td>'.'<td>'.$curso.'</td>'.
											'<td>'.$modulo.'</td>'.'<td><a class="btn btn-default btn-xs" href="desativa.php?turma='.$codTurma.'&cod='.$codigo.'&op=1" 
													role="button">Desativar</a></td>';
											echo "</tr>";
										}
										else {
											echo '<tr>';
											echo '<td>'.$codigo.'</td>'.'<td>'.$nome.'</td>'.'<td>'.$cpf.
											'</td>'.'<td>Aluno Desativado</td>'.'<td>'.$curso.'</td>'.
											'<td>'.$modulo.'</td>'.'<td><a class="btn btn-default btn-xs" href="desativa.php?turma='.$codTurma.'&cod='.$codigo.'&op=2" 
													role="button">Ativar</a></td>';
											echo "</tr>";
										}
									}
									echo '</tbody>
									</table>';
						       	}
						       	elseif (($curso != null) and ($modulo != null)) {
					       		echo '<table class="table">
										<thead>
											<tr>
												<th>Código</th>
												<th>Nome</th>
												<th>CPF</th>
												<th>STATUS</th>
												<th>&nbsp;</th>
											</tr>
										</thead>
								<tbody>';
							       		
								$turma = "SELECT TU.cod_turma, P.cod_pessoas, P.nome_pessoas, P.cpf_pessoas, T.status_pessoa_turma, T.cod_turma
									FROM turma TU, tab_pessoas P, tab_pessoas_turma T
									WHERE TU.cod_curso = '$curso' 
									and TU.cod_modulo = '$modulo' 
									and T.cod_turma = TU.cod_turma 
									and T.cod_pessoas = P.cod_pessoas 

									ORDER BY P.nome_pessoas";
								
								    $procura = mysqli_query($conexao, $turma);
								    while ($resultado = mysqli_fetch_array($procura)) {
								    	$codigo = $resultado['cod_pessoas'];
										$nome = $resultado['nome_pessoas'];
										$cpf = $resultado['cpf_pessoas'];
										$status = $resultado['status_pessoa_turma'];
										$codTurma = $resultado['cod_turma'];
										if ($status == 1) {
											echo '<tr>';
											echo '<td>'.$codigo.'</td>'.'<td>'.$nome.'</td>'.'<td>'.$cpf.
											'</td>'.'<td>'.$status.'</td>'.'<td><a class="btn btn-default btn-xs" 
											href="desativa.php?turma='.$codTurma.'&cod='.$codigo.'&op=1" role="button">Desativar</a></td>';
											echo "</tr>";
										}
									}
									echo '</tbody>
									</table>';
									echo '<div id="tudo"><a class="btn btn-default" href="desativa.php?turma='.$codTurma.'&op=3" 
											role="button">Desativar Tudo</a></div>';
						       	}
						       	elseif (($cursoT != null) and ($moduloT != null)) {
						       		echo '<table class="table">
										<thead>
											<tr>
												<th>Código</th>
												<th>Nome</th>
												<th>CPF</th>
												<th>Curso</th>
												<th>Módulo</th>
											</tr>
										</thead>
										
									<tbody>';
							       		
										$turma = "SELECT TU.cod_turma, P.cod_pessoas, P.nome_pessoas, P.cpf_pessoas, T.status_pessoa_turma, 
										T.cod_turma, C.nome_curso, M.modulo
										FROM turma TU, tab_pessoas P, tab_pessoas_turma T, tab_curso C, tab_modulo M
										WHERE TU.cod_curso = '$cursoT' 
										and TU.cod_modulo = '$moduloT'
										and C.cod_curso = '$cursoT'
										and M.cod_modulo = '$moduloT'
										and T.cod_turma = TU.cod_turma 
										and T.cod_pessoas = P.cod_pessoas 

										ORDER BY P.nome_pessoas";
										
									    $procura = mysqli_query($conexao, $turma);
									    while ($resultado = mysqli_fetch_array($procura)) {
									    	$codigo = $resultado['cod_pessoas'];
											$nome = $resultado['nome_pessoas'];
											$cpf = $resultado['cpf_pessoas'];
											$status = $resultado['status_pessoa_turma'];
											$codTurma = $resultado['cod_turma'];
											$curso = $resultado['nome_curso'];
											$modulo = $resultado['modulo'];

											if ($status == 1) {
												echo '<tr>';
												echo '<td>'.$codigo.'</td>'.'<td>'.$nome.'</td>'.'<td>'.$cpf.
												'</td>'.'<td>'.$curso.'</td>'.'<td>'.$modulo.'</td>';
												echo "</tr>";
											}
										}
										echo '</tbody>
										</table>';
										echo '<div id="tudo"><a class="btn btn-default" href="upTurma.php?curso='.$cursoT.'&modulo='.$moduloT.'&turma='.$codTurma.'" 
													role="button">Atualizar Turma</a></div>';
							       	}
								}
								mysqli_close();
							?>
				</table>
			</div>
		</div>
	</div>

	
</body>
</html>