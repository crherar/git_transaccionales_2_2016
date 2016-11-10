<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Welcome extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
        $this->load->helper('url');
	}
	
	public function login(){
		$this->load->library('facebook'); // Automatically picks appId and secret from config
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
            catch (FacebookApiException $e) {
                $user = null;
            	}
        	
        }
        
        else {
            // Solves first time login issue. (Issue: #10)
            //$this->facebook->destroySession();
        }
        
        if ($user) {// direccion logout x
            $data['logout_url'] = site_url('welcome/logout'); // Logs off application
            // Logs off FB!
            // $data['logout_url'] = $this->facebook->getLogoutUrl();
        } 
        
        else {
            $data['login_url'] = $this->facebook->getLoginUrl(array(
                'redirect_uri' => site_url('welcome/login_fb'), 
                'scope' => array("email") // permissions here
            ));
        }
        $this->load->view('login_fb',$data);
	}
	
	
	public function get_userWithEmail() { //funcion para retornar el id de FB + nombre + email 
        if ( $this->session ) {

        // Graph API to request user data
        $request = ( new FacebookRequest( $this->session, 'GET', '/me?fields=id,name,email' ) )->execute();
    
        // Get response as an array
        $user = $request->getGraphObject()->asArray();
    
        return $user; // guardar en bdd
    }
        return false;
    }
	
	
	
    public function logout(){
        $this->load->library('facebook');
        // Logs off session from website
        $this->facebook->destroySession();
        // Make sure you destory website session as well.
        redirect('welcome/login_fb');
    }
}
