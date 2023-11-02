<?php 
//exemplo de data (seria o valor do campo data que vem do banco)
//aqui utilizo a função date do php para pegar a data atual e simular um valor data
$data = date('Y-m-d');

//função que formata a data
function formata_data($data)
{
 //recebe o parâmetro e armazena em um array separado por -
 $data = explode('-',$data);
 
 //armazena na variavel data os valores do vetor data e concatena /
 $data = $data[2].'/'.$data[1].'/'.$data[0];

 //retorna a string da ordem correta, formatada
 return $data;
}

$data_banco = date('d/m/Y');

function banco_data($data_banco)
{
	$data_banco = explode('/', $data_banco);

	$data_banco = $data_banco[2].'-'.$data_banco[1].'-'.$data_banco[0];

return $data_banco;
}


//mostra a string
// echo $data.'<br><br>';

//mostra a string formatada pela função
// echo formata_data($data);
?>
