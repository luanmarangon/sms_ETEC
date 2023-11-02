<?php 
$db['server'] = 'localhost';
$db['user'] = 'root';
$db['password'] = '';
$db['dbname'] = 'db_sms';

// $db['server'] = 'mysql.hostinger.com.br';
// $db['user'] = 'u300488052_tcc';
// $db['password'] = 'tcc2015';
// $db['dbname'] = 'u300488052_dbsms';

$conexao = mysqli_connect($db['server'],$db['user'],$db['password'],$db['dbname']);
