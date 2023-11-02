<?php
	ini_set ("display_errors", "off");
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
		$nivel = $_SESSION['nivel'];

		include("conexao.php");
		if (!$conexao){
			die('Erro');
		}
		else {
			$nome = $_POST['nome'];
			$email = $_POST['email'];
			$cel = $_POST['cel'];
			$nivel = $_POST['nivelAcesso'];
			$senha = $_POST['senha'];
			$confsenha = $_POST['confsenha'];


			if ($senha == null) {
				$query = "UPDATE tab_usuario SET nome_usuario = '$nome', tel_usuario = '$cel', 
				email_usuario = '$email' WHERE cod_usuario = '$cod'";
				$result = mysqli_query($conexao, $query);
				if(!$result){
					if ($nivel == 1) {
						die(header('location:perfil.php?ok=1'));
					}
					else {
						die(header('location:perfil2.php?ok=1'));
					}
				}
				else{
					if ($nivel == 1) {
						header('location:perfil.php?ok=2');	
					}
					else {
						header('location:perfil2.php?ok=2');
					}
				}
			
			// mysqli_close($conexao);
			}

			elseif ($senha!=$confsenha) {
				if ($nivel == 1) {
					header('location:perfil.php?ok=3');
				}
				else {
					header('location:perfil2.php?ok=3');
				}
			}
			else {
				$senha1=md5($senha);
				$query = "UPDATE tab_usuario SET nome_usuario = '$nome', tel_usuario = '$cel', 
				email_usuario ='$email', senha_usuario = '$senha1' WHERE cod_usuario = '$cod'";
				$result = mysqli_query($conexao, $query);
				if (!$result){
					if ($nivel == 1) {
						die(header('location:perfil.php?ok=1'));
					}
					else {
						die(header('location:perfil2.php?ok=1'));
					}
				}
				else{
					if ($nivel == 1) {
						header('location:perfil.php?ok=2');	
					}
					else {
						header('location:perfil2.php?ok=2');
					}
				}
				// mysqli_close($conexao);
			}
		}
	}
	mysqli_close();
?>