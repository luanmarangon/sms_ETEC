
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

	$codcurso = $_POST['curso'];

	$codmodulo = $_POST['modulo'];

	$procuraCurso = "SELECT nome_curso FROM tab_curso WHERE cod_curso = '$codcurso'";
	
	$resulCurso = mysqli_query($conexao, $procuraCurso);
	$nomecurso = mysqli_fetch_array($resulCurso);
	$curso = $nomecurso['nome_curso'];

	$procuraModulo = "SELECT modulo FROM tab_modulo WHERE cod_modulo = '$codmodulo'";
	$resulModulo = mysqli_query($conexao, $procuraModulo);
	$nmodulo = mysqli_fetch_array($resulModulo);
	$modulo = $nmodulo['modulo'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Trabalho de TCC</title>

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
			<br/>	
	<h1> Relatório de Alunos. </h1>
	<h4> Curso: <?php echo $curso ?> </h4>
	<h4> Modulo: <?php echo $modulo ?> </h4>
	<br/> <br/>
	<a class="btn btn-default" href="javascript:history.go(-1);"> Retornar</a> 

	<a class="btn btn-default" href="javascript:window.print();">Imprimir postagem</a>
	
	<table class="table">
      
      <thead>
        <tr>
          <th>Nome</th>
          <th>Celular</th>
          <th>E-mail</th>
        </tr>
      </thead>
      <tbody>
      
	<?php
		if (!$conexao){
			die('<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Problema de conexão.</strong> Desculpe, mas não foi possível conectar ao nosso servidor.
				</div>');
		}
		else  {
			
			

			$procuraTurma = "SELECT cod_turma FROM turma WHERE cod_curso = '$codcurso' AND cod_modulo = '$codmodulo'";
				

			$resulTurma = mysqli_query($conexao, $procuraTurma);
			while ($turma = mysqli_fetch_array($resulTurma)) {
				$codTurma = $turma['cod_turma'];
				$procuraTP = "SELECT cod_tab_pessoas_turma, cod_pessoas FROM tab_pessoas_turma WHERE cod_turma = '$codTurma'";
				$resulTP = mysqli_query($conexao, $procuraTP);
				while ($TP = mysqli_fetch_array($resulTP)) {							
					$pessoaTurma = $TP['cod_tab_pessoas_turma'];
					$codPessoa = $TP['cod_pessoas'];		
				    $procuraPessoas = "SELECT * FROM tab_pessoas WHERE cod_pessoas = '$codPessoa'";
					$resultPessoas = mysqli_query($conexao, $procuraPessoas);
							
					while ($dados = mysqli_fetch_array($resultPessoas)) {
						$nome = $dados['nome_pessoas'];
						$fone = $dados['cel_pessoas'];
						$email = $dados['email_pessoas'];
						echo "							        
					        <tr>
          	                    <td>".$nome."</td>
					            <td>".$fone."</td>
				                <td>".$email."</td>
					        </tr>";
					} 
				}
			}
		}			 												
		echo "</tbody>
		</table>";				
					
				
			
		 ?>
				</div>
			</div>
		</div>

	</div> <!--fim do WRAPPER -->
</body>
</html>