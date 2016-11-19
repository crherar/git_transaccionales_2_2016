<?php
session_start();

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
	'id_usuario_logueado' => 26,
                  'email'=>'');


$correo_usuario_prestador = str_pad('matias@gmail.com',40);
$objeto = str_pad('lampara',15);
$correo_usuario_recibidor = str_pad('diego@gmail.com',40);

$prestamo = array('dia_prestamo'=>'13',
                  'mes_prestamo'=>'11',
                  'anio_prestamo'=>'2016',
                  'correo_usuario_prestador'=>$correo_usuario_prestador,
                  'objeto'=>$objeto,
                  'cantidad'=> '1',
                  'correo_usuario_recibidor' => $correo_usuario_recibidor,
                  'dia_devolucion' => '15',
                  'mes_devolucion' => '11',
                  'anio_devolucion' => '2016',
	'estado'=>'0');
$msg = json_encode(array('cabecera'=>$cabecera,'datos'=>$prestamo));//"loginn|".$email."-".$password;

//$sock_data = socket_write($socket, "HOLA MUNDO! 17957132", strlen("HOLA MUNDO! 17957132"));
echo "ENVIANDO AL PYTHON: \n";
echo $msg."\n";
$sock_data = socket_write($socket, $msg, strlen($msg));
echo "RESPUESTA DEL PYTHON: \n";
$resp = socket_read($socket, 1024);
var_dump($resp);


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
