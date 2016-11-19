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
//$msg = "mensaje del CLIENTE 1 desde php!!!";
//echo $_POST["email"];
//echo $_POST["password"];

$cabecera = array('formulario' => 'loginn',
									'id_usuario_logueado' => 0,
								  'email'=>'');

$email = str_pad("matias@gmail.com",40);
$password = str_pad("123",10);
// $email = str_pad("matias@gmail.com",40);
// $password = str_pad("123",10);

$logueo  = array('email' => $email,
									'password' => $password);

$msg = json_encode(array('cabecera'=>$cabecera,'datos'=>$logueo));
//$msg = "loginn|".$email."-".$password;

//$sock_data = socket_write($socket, "HOLA MUNDO! 17957132", strlen("HOLA MUNDO! 17957132"));

$sock_data = socket_write($socket, $msg, strlen($msg));
$resp = json_decode(socket_read($socket, 1024));

var_dump($resp);
echo "id:".$resp->cabecera->id_usuario_logueado."\n";
echo "email:".$resp->cabecera->email."\n";

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
