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
$nombre = str_pad($_POST["nombre"],20);
$apellido = str_pad($_POST["apellido"],20);
$email = str_pad($_POST["email"],40);
$password = str_pad($_POST["password"],10);

$cabecera = array('formulario' => 'regusr',
									'id_usuario_logueado' => $_SESSION["id_usuario_logueado"],
									 'email'=>$_SESSION["email"]);

$usuario  = array('nombre' => $nombre,
									'apellido' => $apellido,
									'email' => $email,
									'password' => $password);
$msg = json_encode(array('cabecera'=>$cabecera,'datos'=>$usuario));//"loginn|".$email."-".$password;

//$sock_data = socket_write($socket, "HOLA MUNDO! 17957132", strlen("HOLA MUNDO! 17957132"));

$sock_data = socket_write($socket, $msg, strlen($msg));
$resp = json_decode(socket_read($socket, 1024));

if($resp->datos == "01")
{
	$_SESSION["resp"] = "Usuario registrado correctamente, ahora puede iniciar sesión";
	header("location: vista_login.php");
}

if($resp->datos == "02")
{
	$_SESSION["resp"] = "Usuario ya registrado";
	header("location: vista_registrar_usuario.php");
}
//var_dump($resp);


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
