<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apic extends CI_Controller {
    
    public function index()
    {
        $this->load->view('partes/cabecera_principal');
        $this->load->view('metodosapi');
    }
}