<?php
/*
*http://www.php.net/manual/en/ref.sockets.php
*/

$host = "127.0.0.1";

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
$puerto = 3000;
$email = "";
$id_usuario = "";	
if (socket_connect($socket, $host, $puerto))
{
echo "\nConexion Exitosa, puerto: " . $puerto;
$msg = "mensaje del CLIENTE 2 desde php!!!";

 
$sock_data = socket_write($socket, $msg, strlen($msg));
$resp = socket_read($socket, 1024);
var_dump($resp);

 




$sock_data = socket_write($socket, "DIRPRG /home/alumnos/17957132/", strlen("DIRPRG /home/alumnos/17957132/")); 
$resp = socket_read($socket, 1024);
var_dump($resp);
$mensaje = "TXIN 000020506loginn00matias@gmail.com                        123       ";
$sock_data = socket_write($socket, $mensaje, strlen($mensaje)); 
$resp = socket_read($socket, 1024);
var_dump($resp);


}
else
{
	echo "\nLa conexion TCP no se pudo realizar, puerto: ".$puerto;
}
socket_close($socket);
?>
