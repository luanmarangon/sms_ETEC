<?php 
	$curso = $_GET['curso'];
	$modulo = $_GET['modulo'];
	$turma = $_GET['turma'];

	include("conexao.php");
	if (!$conexao){
		die('<strong>Problema de conexão.</strong> Desculpe, mas não foi possível conectar ao nosso servidor.
			</div>');
	}
	else {
		if (($curso != null) && ($modulo != null) && ($modulo < 3)) {
			$moduloN = $modulo + 1;
			$procuraTurma = "SELECT cod_turma FROM turma WHERE cod_curso = '$curso' and cod_modulo = '$moduloN'";
			$executa = mysqli_query($conexao,$procuraTurma);
			while ($resultado = mysqli_fetch_array($executa)) {
				$turmaN = $resultado['cod_turma'];
			}

			$atualiza = "UPDATE tab_pessoas_turma SET cod_turma=$turmaN WHERE status_pessoa_turma = 1
			and cod_turma = $turma";
			$fazfuncionar = mysqli_query($conexao,$atualiza);

			header('location:home.php?pagina=statusaluno&ok=1');
			
		}
		else {
			header('location:home.php?pagina=statusaluno&ok=2');
		}
	}
	mysqli_close();
?>