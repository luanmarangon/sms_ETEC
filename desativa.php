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
		$cod = $_SESSION['codigo'];

		include("conexao.php");
		if (!$conexao){
			die('Erro');
		}
		else {
			$turma = $_GET['turma'];
			$pessoa  = $_GET['cod'];
			$operacao = $_GET['op'];

			if ($operacao == 1) {
				$query = "UPDATE tab_pessoas_turma SET status_pessoa_turma = 2 WHERE cod_pessoas = '$pessoa' AND
						cod_turma = '$turma'";
				$result = mysqli_query($conexao, $query);
				if(!$result) {
					die(header('location:home.php?pagina=statusaluno&mostra=2'));
				}
				else {
					header('location:home.php?pagina=statusaluno&mostra=1');
				}
			}
			elseif ($operacao == 2) {
				$query = "UPDATE tab_pessoas_turma SET status_pessoa_turma = 1 WHERE cod_pessoas = '$pessoa' AND
						cod_turma = '$turma'";
				$result = mysqli_query($conexao, $query);
				if(!$result) {
					die(header('location:home.php?pagina=statusaluno&mostra=2&ErroocorreAqui'));
				}
				else {
					header('location:home.php?pagina=statusaluno&mostra=1');
				}
			}
			elseif ($operacao == 3) {
				$query = "UPDATE tab_pessoas_turma SET status_pessoa_turma = 2 WHERE cod_turma = '$turma'";
				$result = mysqli_query($conexao, $query);
				if(!$result) {
					die(header('location:home.php?pagina=statusaluno&mostra=2'));
				}
				else {
					header('location:home.php?pagina=statusaluno&mostra=1');
				}
			}
		}
	}
	mysqli_close();
?>