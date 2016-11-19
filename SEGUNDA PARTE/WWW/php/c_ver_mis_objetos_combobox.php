<?php
session_start();

$host = "127.0.0.1";

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
$puerto = 3000;
$email = "";
$id_usuario = "";
if (socket_connect($socket, $host, $puerto))
{
echo "\nConexion Exitosa, puerto: " . $puerto;
//$msg = "mensaje del CLIENTE 1 desde php!!!";
$nombre_objeto = str_pad("computador2",15);


$cabecera = array('formulario' => 'cbxobj',
									'id_usuario_logueado' => $_SESSION["id_usuario_logueado"],
									 'email'=>$_SESSION["email"]);

//$objeto  = array('nombre_objeto' => $nombre_objeto);
$msg = json_encode(array('cabecera'=>$cabecera,'datos'=>''));//"loginn|".$email."-".$password;
var_dump(array('cabecera'=>$cabecera,'datos'=>''));
echo "ENVIADO AL PYTHON \n";
var_dump($msg);
echo "\n";
//$sock_data = socket_write($socket, "HOLA MUNDO! 17957132", strlen("HOLA MUNDO! 17957132"));

$sock_data = socket_write($socket, $msg, strlen($msg));

$resp = socket_read($socket, 1024);
echo "<pre>";
echo "RECIBIDO DEL PYTHON \n";
var_dump(json_decode($resp));
//echo get_object_vars($resp);
//var_dump($resp[0]['formulario']);
echo "\n";


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

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>
		</title>
	</head>
	<body>
		<?php print_r($_SESSION); ?>
		hola mundo
	</body>
</html>
