<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Socket{

	var $socket = "";
	var $puerto = "";

	function __construct() {
        $this->socket = socket_create(AF_INET,SOCK_DGRAM,SOL_UDP);
        $this->puerto = 3000;

    }

	public function conectar()
	{
  	$host = "127.0.0.1";
		if (socket_connect($this->socket, $host, $this->puerto))
		{
			return true;
		}
		return false;
	}

	public function enviar($mensaje)
	{
		$respuesta = "";
		if($this->conectar())
		{
			$sock_data = socket_write($this->socket, $mensaje, strlen($mensaje));
			$respuesta =  socket_read($this->socket, 1024);
		}
		return $respuesta;
	}
}
