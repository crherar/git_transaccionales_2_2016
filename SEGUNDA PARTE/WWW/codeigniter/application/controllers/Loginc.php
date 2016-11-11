<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loginc extends CI_Controller {

	function __construct() {
	        parent::__construct();
	        $this->load->library('Socket');

	    }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		
		$this->load->view('login');
	}

	public function iniciar_sesion()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		var_dump($email);
		var_dump($password);
		$this->socket->enviar(str_pad($email,40)+"-"+str_pad($password,15));
//$this->socket->enviar();
		//$this->load->library('../controllers/Socketc');
	}
}