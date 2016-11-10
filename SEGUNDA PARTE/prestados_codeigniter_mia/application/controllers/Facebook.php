<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Facebook extends CI_Controller {

 public function __construct(){
  parent::__construct();

        // Usar site_url y asi hacer redirect en este controlador.
        $this->load->helper('url');
 }

 public function login(){

  $this->load->library('facebook'); // toma el appId y el pass desde la libreria config
        
        //si hay problemas con la libreria... definir de la sig. manera 

        // OR
        // You can pass different one like this
        //$this->load->library('facebook', array(
        //    'appId' => 'APP_ID',
        //    'secret' => 'SECRET',
        //    ));

  $user = $this->facebook->getUser();
        
        if ($user) {
            try {
                $data['user_profile'] = $this->facebook->api('/me');
                } 
            catch (FacebookApiException $e) {$user = null;}
            }
            
            else {$this->facebook->destroySession();}

        if ($user) {

            $data['logout_url'] = site_url('facebook/logout'); // Logs off 
        
            
            // Otra opcion ... desloguear desde facebook
            // $data['logout_url'] = $this->facebook->getLogoutUrl();
            } 
        
        else {
            $data['login_url'] = $this->facebook->getLoginUrl(array(
                'redirect_uri' => site_url('facebook/login'), 
                'scope' => array("email") //duda 
            ));
        }
        $this->load->view('login_fb',$data); //cambiar nombre vista

 }

    public function logout(){

        $this->load->library('facebook');

        // Logs off de la app
        $this->facebook->destroySession();
        redirect('facebook/login');
    }

}