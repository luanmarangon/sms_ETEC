<?php
			ini_set("display_errors", "off");
			$cod = $_POST['cod'];
			$nome = $_POST['nome'];
			$email = $_POST['email'];
			$cel = $_POST['cel'];
			$nivel = $_POST['nivelAcesso'];
			$senha = $_POST['senha'];
			$confsenha = $_POST['confsenha'];

			include("conexao.php");
			if (!$conexao){
				die('<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Problema de conexão.</strong> Desculpe, mas não foi possível conectar ao nosso servidor.
					</div>');
			}
			else{
				if ($senha!=$confsenha){
				header('location:alteraadmins.php?cod='.$cod.'&ok=3');
				}
				elseif ($senha == null){
					$query = "UPDATE tab_usuario SET nome_usuario = '$nome', tel_usuario = '$cel', 
					email_usuario ='$email', nivel_usuario = '$nivel' WHERE cod_usuario = '$cod'";
					$result = mysqli_query($conexao, $query);
					if (!$result) {
						die(header('location:alteraadmins.php?cod='.$cod.'&ok=1'));
					}
					else{
						header('location:alteraadmins.php?cod='.$cod.'&ok=2');	
					}	
				}
				else {
					$senha1=md5($senha);
					$query = "UPDATE tab_usuario SET nome_usuario = '$nome', tel_usuario = '$cel', 
					email_usuario ='$email', senha_usuario = '$senha1', nivel_usuario = '$nivel' 
					WHERE cod_usuario = '$cod'";
					$result = mysqli_query($conexao, $query);
					if (!$result) {
						die(header('location:alteraadmins.php?cod='.$cod.'&ok=1'));
					}
					else{
						header('location:alteraadmins.php?cod='.$cod.'&ok=2');
					}
				}
			}
			mysqli_close();
?>