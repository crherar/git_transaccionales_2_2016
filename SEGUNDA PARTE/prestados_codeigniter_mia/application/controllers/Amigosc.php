<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amigosc extends CI_Controller {
    
    
    public function index()
    {
         $this->load->model('usuarios'); //ESTO ES EL OBJETO MODELO USUARIOS
         $this->load->model('amigos');
         
         $id_usuario_prestador = $this->session->userdata('id_usuario_logueado');
         $usuarios = $this->usuarios->getUsuarios();
         
         $datos = array();
         foreach($usuarios as $user)  //voy a recorrer a cada uno de los usuarios
         {
             $sonamigos = $this->amigos->sonAmigos($id_usuario_prestador,$user->id);
             
             if(count($sonamigos)>0)
             {
                 $amigo = "SI"; //el usuario logueado es amigo del usuario
             }
             else 
             {
                 $amigo = "NO";//el amigo logueado no es amigo del usuario
             }
             
           $_datos['id'] = $user->id;    //obtengo id del usuario
           $_datos['nombreusuario'] = $user->usuario;//$user->nombre." ".$user->apellido; //obtengo nombre y apellido del usuario y lo concateno
           $_datos['esamigo'] = $amigo; //agrego el la llave al arreglo _$datos si es o no amigo
         
             array_push($datos,$_datos); //agrgo al arreglo $datos, el arreglo $_datos
         }
         $param['datos'] = $datos; //a la llave datos del arreglo $param le paso el arreglo $datos
         $this->load->view('partes/cabecera_principal');
         $this->load->view('navbar');
         $this->load->view('amigos',$param);
         $this->load->view('partes/piePagina');
    }

    
    public function guardarAmistad()
    {
        $this->load->model('amigos'); //cargamos modelo amigos para generar lista de amigos y seleccionar
        
        $id_usuario_prestador = $this->session->userdata('id_usuario_logueado');
        $idusuario = $this->input->post('id'); //id del usuario que se va a agregar como amigo
        $datos['id_amigo1'] = $id_usuario_prestador;
        $datos['id_amigo2'] = $idusuario;
        $this->amigos->guardar($datos);
    }
    
}
?>