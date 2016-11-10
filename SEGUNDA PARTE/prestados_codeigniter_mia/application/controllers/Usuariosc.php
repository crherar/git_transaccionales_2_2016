<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuariosc extends CI_Controller {
    
    
    public function index()
    {
         $id = $this->session->userdata('id_usuario_logueado');
             //  var_dump($id);
       // var_dump($this->config->item('id_usuario_logueado'));
       // $this->load->view('registro_usuarios');
    }
    
    public function registrar()
    {
         $res['mensaje'] = "";
         $this->load->view('registro_usuarios',$res);
    }
    
    public function guardar()
    {
        $data = array();
        $data['nombre'] = $this->input->post('nombre');
        $data['apellido'] = $this->input->post('apellido');
        $data['correo'] = $this->input->post('correo');
        $data['password'] = sha1($this->input->post('password'));
        $data['es_usuario'] = 1;
        $data['es_invitado'] = 0;
        $this->load->model('usuarios'); //cargo el modelo uusarios
        
        //siempre se hace lo mismo, primero se llama el modelo como objecto y despues se ejecuta el metodo
        //he visto en algunas partes que en los controladores tienen un contructo, noce si ahi se podran cargar como global
        //los modelos para poder usarlo en cualquier metodo
        $esta_registrado = $this->usuarios->verificaCorreoYaRegistrado($data['correo']);
        if(count($esta_registrado) == 0)
        {
            $resultado = $this->usuarios->registrar($data); //ejecuto el metodo registrar del modelo usuarios
            if($resultado) //el metodo registrar retorna un booleano
            {
              print_r("ok");
            }
            else
            {
              print_r("error");
            }
        }
        else
        {
             print_r("ya_registrado");
        }
    }
    

    public function actualizarContrasenia()
    {
        $email = $this->input->post('email');
        $pass = $this->input->post('password');
        $password = sha1($this->input->post('password'));
        $this->load->model('usuarios');
        $result = $this->usuarios->updatePassword($email,$password);
        
        if($result)
        {
         
            print_r("ok");
        }
        else
        {
            print_r("error");
        }
    }
    
     public function correoDeUsuario()
     {
         $this->load->model('usuarios');
         $quien_recibe = $this->input->post('quien_recibe');
         $correo_recibe = $this->usuarios->getCorreoPorNombreUsuario($quien_recibe);
         $id_usuario_prestador = $this->session->userdata('id_usuario_logueado');
         $nombre_usuario_prestador = $this->usuarios->getNombreApellidoPorID($id_usuario_prestador);
         $datos['nombre'] = $nombre_usuario_prestador[0]->usuario;
         $datos['correo_recibidor'] = $correo_recibe[0]->correo;
         $correo_presta = $this->usuarios->getCorreoPorIDUsuario($id_usuario_prestador);
         $datos['correo_prestador'] = $correo_presta[0]->correo;
         echo json_encode($datos);
     }
     
     public function cerrarSesionPrestados()
     {
          $this->session->set_userdata('id_usuario_logueado', 0);
     }
    
}