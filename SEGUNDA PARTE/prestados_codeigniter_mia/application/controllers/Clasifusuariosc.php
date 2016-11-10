<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clasifusuariosc extends CI_Controller {

    
    public function index()
    {
        $this->load->view('clasif_usuarios');
    }
    
    public function guardar()
    {
        $aquien = $this->input->post('aquien');
        $datos['clasificacion'] = $this->input->post('clasificacion');
        $datos['comentario'] = $this->input->post('comentario');
        $this->load->model('usuarios');
        $idaquien = $this->usuarios->getIDusuarioNombreApellido('matias');
        $datos['usuario_id'] = $idaquien[0]->id;
        $this->load->model('clasifusuarios');
        $this->clasifusuarios->guarda($datos);
    }
    
}