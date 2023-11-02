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
		<!-- Inicio do conteudo -->
		
		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h1 class="page-header">Configuração dos Administradores <small>Gerencie aqui os administradores do Sistema.</small></h1>		
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div>
							<table class="table">
								<thead>
									<tr>
										<th>Código</th>
										<th>Nome</th>
										<th>Telefone</th>
										<th>Login</th>
										<th>&nbsp;</th>
										<th>&nbsp;</th>
									</tr>
								</thead>
								<tbody>
									<?php
										include("conexao.php");
										if (!$conexao){
											die('<div class="alert alert-danger">
												<button type="button" class="close" data-dismiss="alert">&times;</button>
												<strong>Problema de conexão.</strong> Desculpe, mas não foi possível conectar ao nosso 
												servidor.
												</div>');
										}
										$query = "SELECT cod_usuario, nome_usuario, tel_usuario, email_usuario, nivel_usuario FROM tab_usuario";
										$procura = mysqli_query($conexao,$query);
										while ($resultado = mysqli_fetch_array($procura)) {
											$coduser = $resultado['cod_usuario'];
											$nome = $resultado['nome_usuario'];
											$tel = $resultado['tel_usuario'];
											$email = $resultado['email_usuario'];
											$nivel = $resultado['nivel_usuario'];

											if ($nivel != 3){
												echo '<tr>';
												echo '<td>'.$coduser.'</td>'.'<td>'.$nome.'</td>'.'<td>'.$tel.'</td>'.'<td>'.$email.'</td>'
												.'<td><a href="alteraadmins.php?cod='.$coduser.'">
												<span class="glyphicon glyphicon-erase" aria-hidden="true"></span></a></td>'.
												'<td><a href="excluiadmin.php?cdelete='.$coduser.'"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
												</a></td>';
												echo "</tr>";
											}

										}

										ini_set ("display_errors", "off");
										$ok = $_GET['ok'];
										if ($ok == 1){
											echo '<div class="alert alert-success">
													<button type="button" class="close" data-dismiss="alert">&times;</button>
													<strong>Administrador excluido com sucesso.</strong> 
													</div>';
										}
										elseif ($ok == 2) {
											echo '<div class="alert alert-danger">
											<button type="button" class="close" data-dismiss="alert">&times;</button>
											<strong>Senhas não conferem.</strong> 
											</div>';
										}
										mysqli_close();
									?>
								</tbody>
								
							</table>
						</div>
					</div>				
				</div>
			</div>
		<!-- Fim do conteudo -->
		</div> <!--fim do WRAPPER -->
	</div>
</body>
</html>