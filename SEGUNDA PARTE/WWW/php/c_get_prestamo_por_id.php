<?php
session_start();
print_r(session_id());
print_r("\n");
print_r($_SESSION["id_usuario_logueado"]);
print_r("\n");
print_r($_SESSION["email"]);
$host = "127.0.0.1";

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
$puerto = 3000;
$email = "";
$id_usuario = "";
if (socket_connect($socket, $host, $puerto))
{
echo "\nConexion Exitosa, puerto: " . $puerto;
//$msg = "mensaje del CLIENTE 1 desde php!!!";


$cabecera = array('formulario' => 'modpre',
									'id_usuario_logueado' => $_SESSION["id_usuario_logueado"],
									 'email'=>$_SESSION["email"]);

$prestamo = array('id_prestamo'=>$_POST["id_prestamo"]);
$msg = json_encode(array('cabecera'=>$cabecera,'datos'=>$prestamo));//"loginn|".$email."-".$password;

//$sock_data = socket_write($socket, "HOLA MUNDO! 17957132", strlen("HOLA MUNDO! 17957132"));
// echo "ENVIANDO AL PYTHON: \n";
// echo $msg."\n";
$sock_data = socket_write($socket, $msg, strlen($msg));
//echo "RESPUESTA DEL PYTHON: \n";
$resp = json_decode(socket_read($socket, 4096));

$_SESSION["datos"] = $resp->datos;
}
else
{
	echo "\nLa conexion TCP no se pudo realizar, puerto: ".$puerto;
}
socket_close($socket);
?>
