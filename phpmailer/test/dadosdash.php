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

	 	$procura = "SELECT PT.cod_turma, T.cod_curso, T.cod_modulo, C.nome_curso, M.modulo 
		FROM tab_sms_pessoas_turma SPT, tab_pessoas_turma PT, turma T, tab_curso C, tab_modulo M 
		WHERE SPT.cod_sms = '$idSMS' 
		and PT.cod_tab_pessoas_turma = SPT.tab_pessoas_turma 
		and T.cod_turma = PT.cod_turma 
		and C.cod_curso = T.cod_curso 
		and M.cod_modulo = T.cod_modulo 

		ORDER BY C.nome_curso";
		$executa = mysqli_query($conexao, $procura);
		while ($result = mysqli_fetch_array($executa)) {
			$cursoSMS = $result['nome_curso'];
			$moduloSMS = $result['modulo'];
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

	 	$turma = "SELECT PT.cod_turma, T.cod_curso, T.cod_modulo, C.nome_curso, M.modulo 
		FROM tab_pessoas_turma_email PTE, tab_pessoas_turma PT, turma T, tab_curso C, tab_modulo M 
		WHERE PTE.cod_email = '$idEmail'
		and PT.cod_tab_pessoas_turma = PTE.cod_tab_pessoas_turma 
		and T.cod_turma = PT.cod_turma 
		and C.cod_curso = T.cod_curso 
		and M.cod_modulo = T.cod_modulo 

		ORDER BY C.nome_curso";
		$executa = mysqli_query($conexao, $turma);
		while ($result = mysqli_fetch_array($executa)) {
			$cursoEmail = $result['nome_curso'];
			$moduloEmail = $result['modulo'];
		}
	 }
	 mysqli_close();
?>