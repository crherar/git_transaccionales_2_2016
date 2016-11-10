<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loginc extends CI_Controller {




	public function index()
	{
		$this->load->helper('url');
     	$this->load->view('login');
     	$this->load->view('forms/frm_recuperar_contrasenia');
     	$this->load->view('partes/script_abajo_login');
     	$this->load->view('partes/piePagina');

	}
	

	
        public function login()
        {
            $user = $this->input->post("usuario");
            $pass = sha1($this->input->post('password'));
            $this->load->model('usuarios');
            $count = $this->usuarios->validar($user,$pass);
            $id_usuario_logueado = 0;
        
            if($count>0)
            {
                $bots['bootstrap'] = "paper";
                $logueado = $this->usuarios->getIDusuarioPorCorreo($user);
                
                foreach($logueado as $log)
                {
                $id_usuario_logueado = $log->id;
                }
                $resp['respuesta'] = 1;
                $resp['id'] = $id_usuario_logueado;
                $this->session->set_userdata('id_usuario_logueado', $id_usuario_logueado);
                print_r(json_encode($resp));
            }
            else
            {
                 $resp['respuesta'] = 0;
                //$resultado['mensaje'] = "Usuario o contraseña incorrecta";
                 print_r(json_encode($resp));
            }
        }


        public function loginFacebook()
        {
            $user = $this->input->post("usuario");
            $pass = sha1($this->input->post('password'));
            $this->load->model('usuarios');
            $count = $this->usuarios->validarConFacebook($user);
            $id_usuario_logueado = 0;
        
            if($count>0)
            {
                $bots['bootstrap'] = "paper";
                $logueado = $this->usuarios->getIDusuarioPorCorreo($user);
                
                foreach($logueado as $log)
                {
                $id_usuario_logueado = $log->id;
                }
                  $this->session->set_userdata('id_usuario_logueado', $id_usuario_logueado);
                echo "1";
            }
            else
            {
                $resultado['mensaje'] = "Usuario o contraseña incorrecta";
                echo "0";
            }
        }        
//         public function login_fb(){
// 		$this->load->library('facebook'); // Automatically picks appId and secret from config
//         // OR
//         // You can pass different one like this
//         //$this->load->library('facebook', array(
//         //    'appId' => 'APP_ID',
//         //    'secret' => 'SECRET',
//         //    ));
// 		$user = $this->facebook->getUser();
        
//         if ($user) {
//             try {
//                 $data['user_profile'] = $this->facebook->api('/me');
//             	} 
//             catch (FacebookApiException $e) {
//                 $user = null;
//             	}
        	
//         }
        
//         else {
//             // Solves first time login issue. (Issue: #10)
//             //$this->facebook->destroySession();
//         }
        
//         if ($user) {// direccion logout x
//             $data['logout_url'] = site_url('welcome/logout'); // Logs off application
//             // Logs off FB!
//             // $data['logout_url'] = $this->facebook->getLogoutUrl();
//         } 
        
//         else {
//             $data['login_url'] = $this->facebook->getLoginUrl(array(
//                 'redirect_uri' => site_url('welcome/login_fb'), 
//                 'scope' => array("email") // permissions here
//             ));
//         }
//         $this->load->view('login_fb',$data);
//         }
}