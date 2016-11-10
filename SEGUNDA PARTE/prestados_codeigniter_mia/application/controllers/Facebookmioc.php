<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Facebookmioc extends CI_Controller {

    // public function index()
    // {
        
    // }

    public function fb()
    {
        $this->load->view('partes/fb');
    }
    
    public function fbgit()
    {
        $this->load->view('partes/fbgit');
    }
    
    public function fb2()
    {
        $this->load->view('partes/fb2');
    }
    
    public function activar()
    {
        $this->load->view('partes/actprestados');
    }
    
}
