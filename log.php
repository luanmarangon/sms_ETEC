
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
	} 
?>

<?php
    include("formata_data.php");
	ini_set("display_errors", "off");
	include("conexao.php");

	$codusuario = $_POST['usuario'];


	$procuraUsuario = "SELECT nome_usuario FROM tab_usuario WHERE cod_usuario = '$codusuario'";
	
	$resulUsuario = mysqli_query($conexao, $procuraUsuario);
	$nomeUsuario = mysqli_fetch_array($resulUsuario);
	$usuario = $nomeUsuario['nome_usuario'];

	

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
</head>
<body>
	
    <script>
    	$('#Tabs a').click(function (e) {
		  e.preventDefault()
		  $(this).tab('show')
		})
    </script>
    
		<!-- Inicio do conteudo -->
		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
			<br/>	
	<h1> Relatório de Logs</h1>
	<h4> Usuario: <?php echo $usuario ?> </h4>
	
	<br/> <br/>
	<a class="btn btn-default" href="javascript:history.go(-1);"> Retornar</a> 

	<a class="btn btn-default" href="javascript:window.print();">Imprimir postagem</a>
	
	<table class="table">
      
      <thead>
        <tr>
          <th width=70>Data de Acesso </th>
          <th width=70>Hora de Acesso</th>
          
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
			
			

			$procuraLog = "SELECT * FROM tab_log WHERE cod_usuario = '$codusuario' ORDER BY 'dt_log'";
			$resultLog = mysqli_query($conexao, $procuraLog);
			while ($log = mysqli_fetch_array($resultLog)) {
				$data = formata_data($log['dt_log']);
				$hora = $log['hr_log'];
				echo " <tr>
				          <td width=70>".$data."</td>
				          <td width=70>".$hora."</td>
				        </tr>";
			}
		}			
			 													
	?>
	 </tbody>
	</table>
				</div>
			</div>
		</div>

	</div> <!--fim do WRAPPER -->
</body>
</html>