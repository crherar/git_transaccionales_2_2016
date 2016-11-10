<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prestamosc extends CI_Controller{
    
    
     
    //public $id_usuario_prestador = 0;
    
    // public function registrar()
    // {
        
    //     $this->load->model('usuarios');
    //     $datos = $this->usuarios->getUsuarios();
    //     $nombres = array();
    //     //var_dump($datos);
    //     foreach($datos as $dat)
    //     {
    //       //  var_dump($dat->nombre." ".$dat->apellido);
    //         array_push($nombres,$dat->nombre." ".$dat->apellido);
    //       //var_dump($nombres);
    
    //       $data['dat'] = array($nombres);
    //     }
    //   //redirect('prestamosc');   
    //   $this->load->view('registro_prestamos',$data);
    // }
    
    
    public function index()
    {
        $this->load->model('usuarios');
        $datos = $this->usuarios->getUsuarios();
        //var_dump($datos);
       // return;
        $nombres = array();
        //var_dump($datos);
        foreach($datos as $dat)
        {
           // echo $dat->usuario;
          //  var_dump($dat->nombre." ".$dat->apellido);
           array_push($nombres,$dat->usuario);
          //var_dump($nombres);
    
         // $param['dat'] = array($nombres);
        }
        //var_dump($nombres);
        //return;
        $param['dat'] =  $nombres;
       // var_dump($param['dat']);
        
        // $this->input->post("id_usuario_log");
        $this->load->model('prestamos');
        $id_usuario_prestador = $this->session->userdata('id_usuario_logueado');
        //print_r($id_usuario_prestador);
        //return;
        $param['datos'] = $this->prestamos->getPrestamosPendientes($id_usuario_prestador);
       //var_dump( $param['datos']);
        // $response_navbar = $this->load->view('navbar');
        // $response_index_prestamos = $this->load->view('index_prestamos',$param);
        // $response_clasif_usuarios = $this->load->view('forms/frm_datos_clasificacion_usuarios');
        // $response_pie_pagina = $this->load->view('partes/piePagina');
        $this->load->view('partes/cabecera_principal');
        $this->load->view('navbar');
        $this->load->view('index_prestamos',$param);
        $this->load->view('forms/frm_datos_clasificacion_usuarios');
        $this->load->view('partes/piePagina');
       // print_r(json_encode($param['datos']));
       // print_r($response_navbar." ".$response_index_prestamos." ".$response_clasif_usuarios." ".$response_pie_pagina);
    }
    
    public function verDevueltos()
    {
        $this->load->model('prestamos');
        $id_usuario_prestador = $this->session->userdata('id_usuario_logueado');
        $param['datos'] = $this->prestamos->getPrestamosDevueltos($id_usuario_prestador);
        $this->load->view('partes/cabecera_principal');
        $this->load->view('navbar');
        $this->load->view('prestamos_devueltos',$param);
        $this->load->view('partes/piePagina');
    }
    
    public function verPendientes()
    {
         //  redirect('prestamosc/index');
                 $this->load->model('usuarios');
        $datos = $this->usuarios->getUsuarios();
        $nombres = array();
        //var_dump($datos);
        foreach($datos as $dat)
        {
          //  var_dump($dat->nombre." ".$dat->apellido);
          array_push($nombres,$dat->usuario);
           //var_dump($nombres);
    
          
        }
        
          $param['dat'] = array($nombres);
        $this->load->model('prestamos');
        $id_usuario_prestador = $this->session->userdata('id_usuario_logueado');
        $param['datos'] = $this->prestamos->getPrestamosPendientes($id_usuario_prestador);
        $this->load->view('partes/cabecera_principal');
        $this->load->view('navbar');
        $this->load->view('index_prestamos',$param);
        $this->load->view('forms/frm_datos_clasificacion_usuarios');
        $this->load->view('partes/piePagina');
    }
    
    public function devueltos()
    {
        //en este metodo se hace el proceso inverso que en el metodo pendientes, un prestamo de devuelto se cambia a pendiente
        $this->load->model('prestamos');
        $id_usuario_prestador = $this->session->userdata('id_usuario_logueado');
        $idPrestamo = array('id'=>$this->input->post('id'));
        var_dump($idPrestamo['id']);
        //$param['datos'] = $this->Prestamos->getPrestamosDevueltos($id_usuario_prestador);
        //return $idPrestamo;
        $this->prestamos->marcarDevuelto($idPrestamo['id']);
       // $this->load->view('navbar');
         redirect('prestamosc/verPendientes');   
       // $this->load->view('prestamos_devueltos',$param);
    }
    
    public function pendientes()
    {
        $this->load->model('prestamos');  // cargo el modelo prestamos
        $id_usuario_prestador = $this->session->userdata('id_usuario_logueado'); //obtengo el id del usuario logueado
        $idPrestamo = array('id'=>$this->input->post('id')); //obtengo de la vista la id del prestamo que se quiere pasar de pendiente a devuelto
        var_dump($idPrestamo['id']); //imprimo para probar el contennido
        
        //$param['datos'] = $this->Prestamos->getPrestamosPendientes($id_usuario_prestador); //creo que esta linea esta demas
        $this->prestamos->marcarPendiente($idPrestamo['id']);  //ejecuto el metodo get..... para cambiar el estado del prestamo
         redirect('prestamosc/verDevueltos'); //redirecciono al controlador prestamosc y metodo verDevueltos
         //redirect('prestamosc');
    }
    
    
    // public function actualizarOprestamo()
    // {
    //     $id_usuario_prestador = $this->session->userdata('id_usuario_logueado');
    //     $usuario_seleccionado = $this->input->post('quien_recibe');
    //     var_dump($usuario_seleccionado);
    //     $this->load->model('Usuarios');
    //     $id = $this->Usuarios->getIDusuarioNombreApellido($usuario_seleccionado);
        
    //     $idPrestamo = $this->input->post('idPrestamo');
    //     $idOPrestamo = $this->input->post('idOPrestamo');
    //   //  var_dump($idPrestamo);
    //   //  var_dump($idOPrestamo);
    //     $datactop['id_usuario_prestador'] = $id_usuario_prestador;
    //     $datactop['id_usuario_recibidor'] = $id[0]->id;
    //     $whereop = array('id'=>$idOPrestamo);
    //     $this->load->model('Oprestamos');
    //     $this->Oprestamos->actualizar($datactop,$whereop);
    // }
    
    public function actualizarPrestamo()
    {
    //    $ret=$this->input->post();
      // var_dump($ret);
        $id_usuario_prestador = $this->session->userdata('id_usuario_logueado');
        $usuario_seleccionado = $this->input->post('quien_recibe');
        var_dump($usuario_seleccionado);
        $this->load->model('usuarios');
        $id = $this->usuarios->getIDusuarioNombreApellido($usuario_seleccionado);
        //var_dump($id);
        $idPrestamo = $this->input->post('idPrestamo');
        $idOPrestamo = $this->input->post('idOPrestamo');
     
        $datactop['id_usuario_prestador'] = $id_usuario_prestador;
        $datactop['id_usuario_recibidor'] = $id[0]->id;
        $whereop = array('id'=>$idOPrestamo);
        $this->load->model('oprestamos');
        $this->oprestamos->actualizar($datactop,$whereop);
     
        
        $datos['fecha_prestamo'] = date('Y-m-d',strtotime($this->input->post('fecha_prestamo')));
        $datos['tipo_prestamo'] = $this->input->post('tipo_prestamo');
        $datos['cantidad'] = $this->input->post('cantidad');
    
        $datos['fecha_devolucion'] = date('Y-m-d',strtotime($this->input->post('fecha_devolucion')));
      
        $wherep = array('id'=>$idPrestamo);
        $this->load->model('prestamos');
        $this->prestamos->actualizar($datos,$wherep);
        
 
    }
    
    public function dialog()
    {
        $this->load->view('dialog');
    }
    
    
    public function guardar()
    {
        
    //     	       var postData = {
  		//       fecha_prestamo : fecha_prestamo,
  		//       tipo_prestamo : tipo_prestamo,
  		//       cantidad : cantidad,
  		//       quien_recibe: quien_recibe,
  		//       fecha_devolucion :fecha_devolucion 
  		//   };
  		  
        try
        {
        $usuario_seleccionado = $this->input->post('quien_recibe');
        $this->load->model('usuarios');
        $id = $this->usuarios->getIDusuarioNombreApellido($usuario_seleccionado);
        $op['id_usuario_recibidor'] = $id[0]->id;
        $op['id_usuario_prestador'] = $this->session->userdata('id_usuario_logueado');
        $this->load->model('oprestamos');
        $idoprest = $this->oprestamos->registrar($op);
        
        foreach($idoprest as $idop)
        {
            $datos['prestado_id'] = $idop->id;
        }

        $datos['fecha_prestamo'] = date('Y-m-d',strtotime($this->input->post('fecha_prestamo')));
        $datos['tipo_prestamo'] = $this->input->post('tipo_prestamo');
        $datos['cantidad'] = $this->input->post('cantidad');
        $datos['estado'] = 0;
        $datos['fecha_devolucion']  =  date('Y-m-d',strtotime($this->input->post('fecha_devolucion')));

        $this->load->model('prestamos');
        $result = $this->prestamos->registrar($datos);
        echo "true";
        }
        catch(Exception $e)
        {
            echo $e;
        }
        
        //***********************
        //DESDE AQUI EMPIEZA EL CODIGO QUE EJECUTA EL METODO PARA ENVIAR CORREO DE AVISO DEL PRESTAMO
        
        //$this->load->view('navbar');
        //$this->load->view('index_prestamos',$param);
        
  //      $this->load->library('miemails');
    //    $this->miemails->enviarCorreoPrestamoNuevo($this->session->userdata('id_usuario_logueado'),$usuario_seleccionado,$datos['cantidad'],$datos['tipo_prestamo'],$datos['fecha_prestamo'],$datos['fecha_devolucion']);
       // var_dump($id_usuario);
       //   $this->enviarCorreoPrestamoNuevo($this->session->userdata('id_usuario_logueado'),$usuario_seleccionado,$datos['cantidad'],$datos['tipo_prestamo'],$datos['fecha_prestamo'],$datos['fecha_devolucion']);
    
        
        
      //  redirect('prestamosc');
        
        //HASTA AQUI EL CODIGO PARA ENVIAR CORREO
    }
    
    public function eliminarPrestamo()
    {
        $idPrestamo = $this->input->post('idPrestamo');
        $idOPrestamo = $this->input->post('idOPrestamo');
        
        $this->load->model('prestamos');
        $this->load->model('oprestamos');
        $datap['id'] = $idprestamo;
        $dataop['id'] = $idOPrestamo;
        $this->prestamos->eliminar($datap);
        $this->oprestamos->eliminar($dataop);
    }
    
 
 
    //   public function sendemail()
    //   {   
    //   // Email configuration
    //   $config = Array(
    //      'protocol' => 'smtp',
    //      'smtp_host' => 'ssl://smtp.gmail.com',
    //      'smtp_port' => 465,
    //      'smtp_user' => 'prestados.app@gmail.com', // change it to yours
    //      'smtp_pass' => 'prestados123', // change it to yours
    //      'mailtype' => 'html',
    //      'charset' => 'iso-8859-1',
    //      //'wordwrap' => TRUE
    //   ); 
     
    //   $this->load->library('email');
    //   $this->email->initialize($config);
    //   $this->email->from('prestados.app@gmail.com', "Prestados App");
    //   $this->email->to("matialvarezs@gmail.com");
    //   //$this->email->cc("testcc@domainname.com");
    //   $this->email->subject("This is test subject line");
    //   $this->email->message("Mail sent test message...");
    //   $this->email->send();
    //   $data['message'] = "Sorry Unable to send email..."; 
    //   if($this->email->send()){     
    //   $data['message'] = "Mail sent...";   
    //   } 
    //   var_dump($this->email->send());
    //   var_dump($data);    
    //   var_dump($this->email->print_debugger());
    //   // forward to index page
    //  // $this->load->view('index', $data);  
    //  }
 
 
    // public function enviarCorreoPrestamoNuevo($id_usuario_prestador,$usuario_recibidor,$cantidad,$cosa,$fecha_prestamo,$fecha_devolucion)
    // {
    
    //      $this->load->model('Usuarios');
    //      $para = $this->Usuarios->getCorreoPorNombreUsuario($usuario_recibidor); 
    //      $this->email->initialize(array(
    //       'protocol' => 'smtp',
    //       'smtp_host' => 'smtp.gmail.com',
    //       'smtp_user' => 'prestados.app',
    //       'smtp_pass' => 'prestados123',
    //       'smtp_port' => 587,
    //       'crlf' => "\r\n",
    //       'newline' => "\r\n"
    //           ));
    // //   $this->email->smtp_host('smpt.gmail.com');
    // //   $this->email->smtp_pass('prestados123');
    //   // $this->load->library('email');
    //     $this->email->from('prestados.app@gmail.com', 'Prestados App');
    //     $this->email->to('matialvarezs@gmail.com'); 
    // //    $this->email->cc('another@another-example.com'); 
    //  //  $this->email->bcc('them@their-example.com'); 

    //     $asunto = "Aviso nuevo prestamo - App prestados";
        
    //     $usuario_prestador = $this->Usuarios->getNombreApellidoPorID($id_usuario_prestador);
        
    //     $this->email->subject($asunto);
    //     $mensaje = $usuario_prestador." te ha hecho el siguiente prestamo: ".$cantidad." ".$cosa." el dia ".$fecha_prestamo. " con fecha devolucion ".$fecha_devolucion." Te llegará un correo recordatorio para la devolucion. \n \n Prestados App";
    //     $this->email->message('Testing the email class.');	

    //     $this->email->send();


    //   echo $this->email->print_debugger();
    // }
}