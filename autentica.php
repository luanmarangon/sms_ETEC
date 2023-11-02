<?php

	//verificação do login
	session_start();
	ini_set ("display_errors", "off");
	$login = $_POST['login'];
	$var = md5($_POST['senha']);
	include("conexao.php");
						
	if(($login!=null)&&($var!=null)){
		if (!$conexao){
			die('<div>
			 <strong>Problema de conexão.</strong> Desculpe, mas não foi possível conectar ao nosso servidor.
			 </div>');
		}
		
		else{
			$query = "SELECT * FROM tab_usuario	WHERE email_usuario ='$login'";
			$resultado = mysqli_query($conexao, $query);
			$confemail=mysqli_fetch_array($resultado);
			$cod = $confemail['cod_usuario'];
			$nome = $confemail['nome_usuario'];
			$login = $confemail['email_usuario'];
			$senha = $confemail['senha_usuario'];
			$nivel = $confemail['nivel_usuario'];
			if ($login==NULL){
				header('location:index.php?no=1');
			}
			elseif ($senha!=$var) {
				header('location:index.php?no=1');														
			}
			else{
				$_SESSION['codigo'] = $cod;
				$_SESSION['nome'] = $nome;
				$_SESSION['login'] = $login;
				$_SESSION['senha'] = $senha;
				$_SESSION['nivel'] = $nivel;
				$dt_log = date("Y/m/d");
				$hr_log = date("H:i:s");
				$clog = "insert into tab_log values('','$dt_log','$hr_log','$cod')";
				$ilog = mysqli_query($conexao,$clog);
				if ($nivel == 1){
					header('location:home.php?sistema');
				}
				elseif ($nivel == 2) {
					header('location:home2.php?sistema');
				}
				else {
					header('location:index.php?no=1');
				}
			}
		}
		mysqli_close();
	}
	else{
		header('location:index.php?Preencha todos os campos');
	}
	mysqli_close();
?>
