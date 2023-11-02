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
			$codigo = $_GET['cdelete'];

			$query = "UPDATE tab_usuario SET nivel_usuario = 3 WHERE cod_usuario = $codigo";
			$result = mysqli_query($conexao, $query);
			$result = mysqli_query($strSQL);
			if(!$result) {
				die(header('location:home.php?pagina=confadmin&ok=1'));
			}
			else {
				header('location:home.php?pagina=confadmin&ok=2');
			}
		}
	}
	mysqli_close();
?>