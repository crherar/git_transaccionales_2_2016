<?php
session_start();
//print_r(session_id());
// print_r("\n");
// print_r($_SESSION["id_usuario_logueado"]);
// print_r("\n");
// print_r($_SESSION["email"]);
$host = "127.0.0.1";

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
$puerto = 3000;
$email = "";
$id_usuario = "";
if (socket_connect($socket, $host, $puerto))
{
$cabecera = array('formulario' => 'regami',
									'id_usuario_logueado' => $_SESSION["id_usuario_logueado"],
								   'email'=>$_SESSION["email"]);

$amigo = array('id_amigo'=>$_POST["id_amigo"]);
$msg = json_encode(array('cabecera'=>$cabecera,'datos'=>$amigo));//"loginn|".$email."-".$password;
$sock_data = socket_write($socket, $msg, strlen($msg));
//echo "RESPUESTA DEL PYTHON: \n";
$resp = json_decode(socket_read($socket, 1024));
print_r($resp->datos);
}
else
{
	echo "\nLa conexion TCP no se pudo realizar, puerto: ".$puerto;
}
socket_close($socket);
?>
