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
		
		include("conexao.php");
	} 
	
	if ($_POST['cadcurso']!=null) {
		$var = $_POST['cadcurso'];
		if (!$conexao){
			die('<strong>Problema de conexão.</strong> Desculpe, mas não foi possível conectar ao nosso servidor.
				</div>');
		}
		else{
			$inserirCurso = "insert into tab_curso values ('','$var')";
			$insercaoCurso = mysqli_query($conexao,$inserirCurso);
			if(!$insercaoCurso){
				die(header('location:home.php?pagina=curso&ok=2'));
			}
			else{
				mysqli_close($conexao);
				header('location:home.php?pagina=curso&ok=1');
			}
		}
	}
	elseif (($_POST['curso']!=null)&&($_POST['modulo']!=null)) {
		$curso = $_POST['curso'];
		$modulo = $_POST['modulo'];

		if (!$conexao){
			die('<strong>Problema de conexão.</strong> Desculpe, mas não foi possível conectar ao nosso servidor.
				</div>');
		}
		else{
			$inserirTurma = "insert into turma values ('','$curso','$modulo')";
			$insercaoTurma = mysqli_query($conexao,$inserirTurma);
			if (!$inserirTurma) {
				die(
				header('location:home.php?pagina=curso&ok=2'));
			}
			else{
				mysqli_close($conexao);
				header('location:home.php?pagina=curso&ok=1');
			}
		}
	}
	else {
		header('location:home.php?pagina=curso&ok=2');
	}
	mysqli_close();
?>