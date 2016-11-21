<?php
session_start();
//print_r(session_id());
// print_r("\n");
// print_r($_SESSION["id_usuario_logueado"]);
// print_r("\n");
// print_r($_SESSION["email"]);
$host = "127.0.0.1";

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
$puerto = 3000;
$email = "";
$id_usuario = "";
if (socket_connect($socket, $host, $puerto))
{
//echo "\nConexion Exitosa, puerto: " . $puerto;
//$msg = "mensaje del CLIENTE 1 desde php!!!";

//echo "\n en c_get_objeto_por_id \n";
$cabecera = array('formulario' => 'regami',
									'id_usuario_logueado' => $_SESSION["id_usuario_logueado"],
								   'email'=>$_SESSION["email"]);

$amigo = array('id_amigo'=>$_POST["id_amigo"]);
$msg = json_encode(array('cabecera'=>$cabecera,'datos'=>$amigo));//"loginn|".$email."-".$password;

//$sock_data = socket_write($socket, "HOLA MUNDO! 17957132", strlen("HOLA MUNDO! 17957132"));
//echo "ENVIANDO AL PYTHON: \n";
//echo $msg."\n";
$sock_data = socket_write($socket, $msg, strlen($msg));
//echo "RESPUESTA DEL PYTHON: \n";
$resp = json_decode(socket_read($socket, 1024));
print_r($resp->datos);
//var_dump($resp);
// if($resp->datos !="02")
// 	{
// 		 $_SESSION["datos"] = $resp->datos;
// 		//$_SESSION["nombre_objeto"] = $resp->datos->nombre;
// 		//$_SESSION["id_objeto"] = $resp->datos->id_objeto;
// 		echo $resp->datos->nombre;
// 	//header("location: vista_actualizar_objeto.php");
// }
// if($res->datos == "02")
// 	echo "02";
//var_dump($resp->datos->nombre);


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
