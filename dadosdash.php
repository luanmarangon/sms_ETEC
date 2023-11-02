<?php
	ini_set("display_errors", "off");
	include ("conexao.php");
	if (!$conexao) {
	 	$conn = 2;
	 }
	 else { 
	 	$query = "SELECT controleSMS FROM tab_controlesms WHERE cod_controleSMS = 1";
	 	$executa = mysqli_query($conexao, $query);
	 	while ($result = mysqli_fetch_array($executa)){
	 		$totalSMS = $result['controleSMS'];
	 	} 
	 	
	 	$query = "SELECT * FROM tab_sms_pessoas_turma";
	 	$result = mysqli_query($conexao, $query);
	 	$contSMS = mysqli_num_rows($result);

	 	
	 	$query = "SELECT * FROM tab_pessoas_turma_email";
	 	$result = mysqli_query($conexao, $query);
	 	$contEmail = mysqli_num_rows($result);

	 	

	 	$query = "SELECT MAX(cod_sms) FROM tab_sms";
	 	$executa = mysqli_query($conexao, $query);
	 	while ($result = mysqli_fetch_array($executa)) {
	 		$idSMS = $result[0];
	 	}

	 	$query = "SELECT mensagem_sms, dt_sms, hr_sms FROM tab_sms WHERE cod_sms = $idSMS";
	 	$executa = mysqli_query($conexao, $query);
	 	while ($result = mysqli_fetch_array($executa)) {
	 		$msgSMS = $result['mensagem_sms'];
	 		$dt_sms = $result['dt_sms'];
	 		$hr_sms = $result['hr_sms'];
	 	}

	 	$query = "SELECT MAX(cod_email) FROM tab_email";
	 	$executa = mysqli_query($conexao, $query);
	 	while ($result = mysqli_fetch_array($executa)) {
	 		$idEmail = $result[0];
	 	}

	 	$query = "SELECT mensagem_email, dt_envio, hr_envio FROM tab_email WHERE cod_email = $idEmail";
	 	$executa = mysqli_query($conexao, $query);
	 	while ($result = mysqli_fetch_array($executa)) {
	 		$msgEmail = $result['mensagem_email'];
	 		$dt_email = $result['dt_envio'];
	 		$hr_email = $result['hr_envio'];
	 	}

	 	$query = "SELECT MAX(cod_log) FROM tab_log";
	 	$executa = mysqli_query($conexao, $query);
	 	while ($result = mysqli_fetch_array($executa)) {
	 		$codIni = $result[0];
	 	}

	 	$codFin = $codIni - 2;
	 	$k = 0;

	 	for ($i=$codFin; $i <= $codIni ; $i++) { 
	 		$procura = "SELECT L.dt_log, L.hr_log, L.cod_log, U.nome_usuario
	 		FROM tab_log L, tab_usuario U
	 		WHERE L.cod_log = '$i'
	 		and L.cod_usuario = U.cod_usuario

	 		ORDER BY L.cod_log";
	 		$executa = mysqli_query($conexao, $procura);
	 		while ($result = mysqli_fetch_array($executa)) {
	 			$codigo[$k] = $result['cod_log'];
	 			$usuario[$k] = $result['nome_usuario'];
	 			$dt_log[$k] = $result['dt_log'];
	 			$hr_log[$k] = $result['hr_log'];
	 		}
	 		$k++;
	 	} 
	 }
	 mysqli_close();
?>