<?php

session_start();
print_r(session_id());
print_r("\n");
print_r($_SESSION["id_usuario_logueado"]);
print_r("\n");
print_r($_SESSION["email"]);
$host = "127.0.0.1";

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
$socket_tnr = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
$puerto = 3000;
$email = "";
$id_usuario = "";
if (socket_connect($socket, $host, $puerto) && socket_connect($socket_tnr, $host, $puerto))
{
echo "\nConexion Exitosa, puerto: " . $puerto;
//$msg = "mensaje del CLIENTE 1 desde php!!!";


echo "\n";
echo "xxx: ".$_SESSION["id_usuario_logueado"];
echo "\n";
echo $_SESSION["email"];

$cabecera = array('formulario' => 'tnrami',
									'id_usuario_logueado' => 	$_SESSION["id_usuario_logueado"],
								  'email'=>	$_SESSION["email"]);
									$msg = json_encode(array('cabecera'=>$cabecera,'datos'=>''));//"loginn|".$email."-".$password;
									$sock_data = socket_write($socket_tnr, $msg, strlen($msg));
									$resp = json_decode(socket_read($socket_tnr, 1024));
									$_SESSION["tnrami"] = $resp->datos;

$cabecera = array('formulario' => 'verami',
									'id_usuario_logueado' => 	$_SESSION["id_usuario_logueado"],
								  'email'=>	$_SESSION["email"]);

$msg = json_encode(array('cabecera'=>$cabecera,'datos'=>''));//"loginn|".$email."-".$password;
$sock_data = socket_write($socket, $msg, strlen($msg));
$resp = json_decode(socket_read($socket, 8192));
$_SESSION["datos"] = $resp->datos;

header("location: vista_administrar_mis_amigos.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);
}
else
{
	echo "\nLa conexion TCP no se pudo realizar, puerto: ".$puerto;
}
socket_close($socket);
?>
