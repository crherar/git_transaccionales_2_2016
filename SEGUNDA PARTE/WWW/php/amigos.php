<?php
session_start();


$host = "127.0.0.1";

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
$puerto = 3000;
$email = "";
$id_usuario = "";
if (socket_connect($socket, $host, $puerto))
{
echo "\nConexion Exitosa, puerto: " . $puerto;
//$msg = "mensaje del CLIENTE 1 desde php!!!";
$email = str_pad("matias@gmail.com",40);
$password = str_pad("123",10);
$cabecera = array('formulario' => 'verami',
									'id_usuario_logueado' => 9,
								  'email'=>'');

$usuario = array('id_usuario_logueado'=>9);
$msg =  json_encode(array('cabecera'=>$cabecera,'datos'=>''));//"verami|9";

//$sock_data = socket_write($socket, "HOLA MUNDO! 17957132", strlen("HOLA MUNDO! 17957132"));

$sock_data = socket_write($socket, $msg, strlen($msg));
$resp = socket_read($socket, 1024);
var_dump($resp);
}
else
{
	echo "\nLa conexion TCP no se pudo realizar, puerto: ".$puerto;
}
socket_close($socket);
?>
