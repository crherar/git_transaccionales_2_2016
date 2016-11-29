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
$nombre_objeto = str_pad("computador2",15);

echo "\n";
echo "xxx: ".$_SESSION["id_usuario_logueado"];
echo "\n";
echo $_SESSION["email"];
$cabecera = array('formulario' => 'verobj',
									'id_usuario_logueado' => 	$_SESSION["id_usuario_logueado"],
								  'email'=>	$_SESSION["email"]);


echo "\n\n\n cabecera: \n\n\n";
var_dump($cabecera);
//$objeto  = array('nombre_objeto' => $nombre_objeto);
$msg = json_encode(array('cabecera'=>$cabecera,'datos'=>''));//"loginn|".$email."-".$password;
var_dump($msg);
//$sock_data = socket_write($socket, "HOLA MUNDO! 17957132", strlen("HOLA MUNDO! 17957132"));

$sock_data = socket_write($socket, $msg, strlen($msg));
$resp = json_decode(socket_read($socket, 8192));
//var_dump($resp);

//echo "AOSODSPODPSOPDOS";

//var_dump($_SESSION);

$_SESSION["datos"] = $resp->datos;

header("location: vista_administrar_mis_objetos.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);
}
else
{
	echo "\nLa conexion TCP no se pudo realizar, puerto: ".$puerto;
}
socket_close($socket);
?>
