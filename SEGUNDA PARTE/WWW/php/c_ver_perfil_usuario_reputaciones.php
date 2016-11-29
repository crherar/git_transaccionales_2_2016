<?php
session_start();
print_r(session_id());
print_r("\n");
print_r($_SESSION["id_usuario_logueado"]);
print_r("\n");
print_r($_SESSION["email"]);
//print_r("ID USUARIO CLASIFICADO: "+$_POST["id_usuario_clasificado"]);
//echo "datos: \n";
//var_dump($_SESSION["datos"]);
//$_SESSION["resp"] = "";
//var_dump($_SESSION["resp"]);
$host = "127.0.0.1";
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
$puerto = 3000;

if (socket_connect($socket, $host, $puerto))
{
$cabecera = array('formulario' => 'veorep',
									'id_usuario_logueado' => $_SESSION["id_usuario_logueado"],
								  'email'=>$_SESSION["email"]);

$usuario = array('id_usuario_clasificado'=>$_POST["id_usuario_clasificado"]);
var_dump($usuario);
$msg = json_encode(array('cabecera'=>$cabecera,'datos'=>$usuario));//"loginn|".$email."-".$password;

//$sock_data = socket_write($socket, "HOLA MUNDO! 17957132", strlen("HOLA MUNDO! 17957132"));
//echo "ENVIANDO AL PYTHON: \n";
echo $msg."\n";
$sock_data = socket_write($socket, $msg, strlen($msg));
//echo "RESPUESTA DEL PYTHON: \n";
$resp = json_decode(socket_read($socket, 2048));
$_SESSION["datos"] = $resp->datos;
$_SESSION["usuario_perfil"] = $resp->usuario_perfil->nombre." ".$resp->usuario_perfil->apellido." - ".$resp->usuario_perfil->email;
//var_dump($resp);
}
else
{
	echo "\nLa conexion TCP no se pudo realizar, puerto: ".$puerto;
}
socket_close($socket);
