<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller
{
    
    //login prueba de fb, imprime datos del usuario
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session', 'lib_login'));
    }
    public function facebook()
    {
        $fb_data = $this->lib_login->facebook();
        // check login data
        if (isset($fb_data['me'])) {
            var_dump($fb_data);
        } else {
            echo '<a href="' . $fb_data['loginUrl'] . '">Login</a>';
        }
    }
}
/* End of file login.php */
/* Location: ./application/controllers/login.php */