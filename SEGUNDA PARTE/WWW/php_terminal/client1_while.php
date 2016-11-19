<?php
/*
*http://www.php.net/manual/en/ref.sockets.php
*/

$host = "127.0.0.1";

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
$puerto = 3000;
$email = "";
$id_usuario = "";	
$count = 0;
while($count < 100){
if (socket_connect($socket, $host, $puerto))
{
echo "\nConexion Exitosa, puerto: " . $puerto;
$msg = "mensaje del CLIENTE 1 desde php!!!";


//$sock_data = socket_write($socket, "HOLA MUNDO! 17957132", strlen("HOLA MUNDO! 17957132")); 

$sock_data = socket_write($socket, $msg, strlen($msg));
$resp = socket_read($socket, 1024);
var_dump($resp);
echo "count: "+$count+"\n";
$count++;
}


 

 
else
{
	echo "\nLa conexion TCP no se pudo realizar, puerto: ".$puerto;
}
$count++;
socket_close($socket);
}

//socket_close($socket);
?>
