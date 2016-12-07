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



$cabecera = array('formulario' => 'actrep',
									'id_usuario_logueado' => $_SESSION["id_usuario_logueado"],
								  'email'=>$_SESSION["email"]);

$reputacion  = array('id_usuario_clasificado' => $_SESSION["datos"]->id_usuario_clasificado,
										 'clasificacion' => $_POST["clasificacion"],
									 	 'comentario' => $_POST["comentario"],
									 		'id_reputacion'=>$_SESSION["datos"]->id_reputacion);
$msg = json_encode(array('cabecera'=>$cabecera,'datos'=>$reputacion));//"loginn|".$email."-".$password;

//$sock_data = socket_write($socket, "HOLA MUNDO! 17957132", strlen("HOLA MUNDO! 17957132"));

$sock_data = socket_write($socket, $msg, strlen($msg));
$resp = json_decode(socket_read($socket, 1024));
$_SESSION["datos"] = $resp->datos;
if($resp->datos == "01")
	{
	$_SESSION["resp"] = "Reputación actualizada correctamente";
	header("location: c_ver_mis_amigos.php");
	}
if($resp->datos == "02")
	{
		$_SESSION["resp"] = "Error al guardar";
	header("location: vista_registrar_reputacion.php");
}
}
else
{
	echo "\nLa conexion TCP no se pudo realizar, puerto: ".$puerto;
}
socket_close($socket);
?>
