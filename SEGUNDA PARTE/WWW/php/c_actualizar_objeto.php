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
$nombre_objeto = str_pad($_SESSION["datos"]->nombre_objeto,15);


$cabecera = array('formulario' => 'actobj',
									'id_usuario_logueado' => $_SESSION["id_usuario_logueado"],
									'email'=>$_SESSION["email"]);

$objeto  = array('id_objeto' =>$_SESSION["datos"]->id_objeto,
									'nombre_objeto' => str_pad($_POST["nombre_objeto"],15));

$msg = json_encode(array('cabecera'=>$cabecera,'datos'=>$objeto));//"loginn|".$email."-".$password;

//$sock_data = socket_write($socket, "HOLA MUNDO! 17957132", strlen("HOLA MUNDO! 17957132"));

$sock_data = socket_write($socket, $msg, strlen($msg));
$resp = json_decode(socket_read($socket, 1024));
if($resp->datos == "01")
	{
	$_SESSION["resp"] = "Objeto actualizado correctamente";
	header("location: c_ver_mis_objetos.php");
	}
if($resp->datos == "02")
	{
		$_SESSION["resp"] = "Error al actualizar";
	header("location: vista_actualizar_objeto.php");
}
//var_dump($resp);
//var_dump($_SESSION);

/*
$sock_data = socket_write($socket, "loginn", strlen("DIRPRG /home/alumnos/17957132/"));
$resp = socket_read($socket, 1024);
var_dump($resp);
$mensaje = "TXIN 000020506loginn00matias@gmail.com                        123       ";
$sock_data = socket_write($socket, $mensaje, strlen($mensaje));
$resp = socket_read($socket, 1024);
var_dump($resp);
*/

}
else
{
	echo "\nLa conexion TCP no se pudo realizar, puerto: ".$puerto;
}
socket_close($socket);
?>
