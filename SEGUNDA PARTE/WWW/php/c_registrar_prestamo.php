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
echo "\nConexion Exitosa, puerto: " . $puerto."\n";
//$msg = "mensaje del CLIENTE 1 desde php!!!";


$cabecera = array('formulario' => 'regpre',
									'id_usuario_logueado' => $_SESSION["id_usuario_logueado"],
									 'email'=>$_SESSION["email"]);


$correo_usuario_prestador = str_pad($_SESSION["email"],40);
$objeto = str_pad($_POST["nombre_objeto"],15);
$correo_usuario_recibidor = str_pad($_POST["usuario_recibidor"],40);
list($dia_prestamo,$mes_prestamo, $anio_prestamo) = split('[/.-]', $_POST["fecha_prestamo"]);
list($dia_devolucion,$mes_devolucion, $anio_devolucion) = split('[/.-]', $_POST["fecha_devolucion"]);
//$fecha_prestamo = date_parse($_POST["fecha_prestamo"]);
//$fecha_devolucion = date_parse($_POST["fecha_devolucion"]);
//print_r($fecha_prestamo);
//print_r($fecha_devolucion);
//print_r("\n\n\n".$_POST["fecha_prestamo"]."\n\n\n");
//print_r("\n\n\n".$_POST["fecha_devolucion"]."\n\n\n");

// $prestamo = array('dia_prestamo'=>strval($fecha_prestamo["day"]),
//                   'mes_prestamo'=>strval($fecha_prestamo["month"]),
//                   'anio_prestamo'=>strval($fecha_prestamo["year"]),
//                   'correo_usuario_prestador'=>$correo_usuario_prestador,
//                   'objeto'=>$objeto,
//                   'cantidad'=> $_POST["cantidad"],
//                   'correo_usuario_recibidor' => $correo_usuario_recibidor,
//                   'dia_devolucion' => strval($fecha_devolucion["day"]),
//                   'mes_devolucion' => strval($fecha_devolucion["month"]),
//                   'anio_devolucion' => strval($fecha_devolucion["year"]),
// 	'estado'=>'0');

$prestamo = array('dia_prestamo'=>$dia_prestamo,
                  'mes_prestamo'=>$mes_prestamo,
                  'anio_prestamo'=>$anio_prestamo,
                  'correo_usuario_prestador'=>$correo_usuario_prestador,
                  'objeto'=>$objeto,
                  'cantidad'=> $_POST["cantidad"],
                  'correo_usuario_recibidor' => $correo_usuario_recibidor,
                  'dia_devolucion' => $dia_devolucion,
                  'mes_devolucion' => $mes_devolucion,
                  'anio_devolucion' => $anio_devolucion,
	'estado'=>'0');

$msg = json_encode(array('cabecera'=>$cabecera,'datos'=>$prestamo));//"loginn|".$email."-".$password;
var_dump($msg);
//$sock_data = socket_write($socket, "HOLA MUNDO! 17957132", strlen("HOLA MUNDO! 17957132"));
//echo "ENVIANDO AL PYTHON: \n";
//echo $msg."\n";
$sock_data = socket_write($socket, $msg, strlen($msg));
echo "RESPUESTA DEL PYTHON: \n";
$resp = json_decode(socket_read($socket, 1024));
//var_dump($resp);
if($resp->datos == "01")
{
$_SESSION["resp"] = "Prestamo registrado correctamente";
header("location: c_ver_prestamos_pendientes.php");
}

if($resp->datos == "02")
{
$_SESSION["resp"] = "Error al guardar";
header("location: vista_registrar_prestamo.php");
}
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
