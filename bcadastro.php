  <?php
  	ini_set ("display_errors", "off");
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
		
		 
		include("formata_data.php");
		$cpf = $_POST['cpf'];

		
		include("conexao.php");
		$procura = "SELECT * FROM tab_pessoas WHERE cpf_pessoas = '$cpf'";
		$resultado = mysqli_query($conexao, $procura);
		$confcad = mysqli_fetch_array($resultado);
			$busca['codigo'] = $confcad['cod_pessoas'];
			$busca['nome'] = $confcad['nome_pessoas'];
			$busca['dt_nasc'] = $confcad['dt_nasc'];
			$busca['cel'] = $confcad['cel_pessoas'];
			$busca['email'] = $confcad['email_pessoas'];
			$busca['aceita_email'] = $confcad['aceita_email'];
			$busca['aceita_sms'] = $confcad['aceita_sms'];
			$busca['status'] = $confcad['status'];
		
		echo json_encode($busca);
	}
	mysqli_close();
?>