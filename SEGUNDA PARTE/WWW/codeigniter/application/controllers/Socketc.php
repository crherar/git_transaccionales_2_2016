<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Socket{

    public function __construct() {
		$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		$puerto = 3000;
    }

	public function conectar()
	{
  	$host = "127.0.0.1";
		if (socket_connect($socket, $host, $puerto))
		{
			return true;
		}
		return false;
	}

	public function enviar($mensaje)
	{
		if(conectar())
		{
			$sock_data = socket_write($socket, $msg, strlen($msg));
			return socket_read($socket, 1024);
		}
	}
}
// defined('BASEPATH') OR exit('No direct script access allowed');
//
// class Socketc extends CI_Controller {
//
// 	/**
// 	 * Index Page for this controller.
// 	 *
// 	 * Maps to the following URL
// 	 * 		http://example.com/index.php/welcome
// 	 *	- or -
// 	 * 		http://example.com/index.php/welcome/index
// 	 *	- or -
// 	 * Since this controller is set as the default controller in
// 	 * config/routes.php, it's displayed at http://example.com/
// 	 *
// 	 * So any other public methods not prefixed with an underscore will
// 	 * map to /index.php/welcome/<method_name>
// 	 * @see https://codeigniter.com/user_guide/general/urls.html
// 	 */
// 	$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
// 	$puerto = 3000;
// 	public function conectar()
// 	{
// 		$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
// 		$puerto = 3000;
//   	$host = "127.0.0.1";
// 		if (socket_connect($socket, $host, $puerto))
// 		{
// 			return true;
// 		}
// 		return false;
// 	}
//
// 	public function enviar($mensaje)
// 	{
// 		if(conectar())
// 		{
// 			$sock_data = socket_write($socket, $msg, strlen($msg));
// 			return socket_read($socket, 1024);
// 		}
// 	}
// }
