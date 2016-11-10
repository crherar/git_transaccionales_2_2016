<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testapipwc extends CI_Controller {

    public function login()
    {

      
      try
      {
            //AHORA
            $correo_usuario = 'matialvarezs@gmail.com';
            $password_usuario = sha1('123');   //obtengo el dato password del json

            $this->load->model('usuarios');
            $count = $this->usuarios->validar($correo_usuario,$password_usuario);
            $id_usuario_logueado = 0;
        
            if($count>0)
            {
                
                $logueado = $this->usuarios->getIDusuarioPorCorreo($correo_usuario);
                foreach($logueado as $log)
                {
                $id_usuario_logueado = $log->id;
                }
                $resp['respuesta'] = 1;
                $resp['id'] = $id_usuario_logueado;
                //$this->session->set_userdata('id_usuario_logueado', $id_usuario_logueado);
                print_r(json_encode($resp));
            }
            
            else
            {
                //$resultado['mensaje'] = "Usuario o contraseña incorrecta";
                 print_r(json_encode($resp));
            }
      }
            catch(Exception $e)
      {
          print_r("false");
      }
          //de esta forma siempre para obtener los datos que son obtenidos, obviamente solo si son necesarios
          //*********************************************
          // desde aqui la logica para verificar el login.......
          // los print_r(); son necesarios en caso que sea para guardar,editar o eliminar datosla respuesta es para el control de errores
          //true=> no hay errores
          //false => error
          //con eso en el caso de una app movil se muestra el mensaje con Toast(.....))
 
    }
    
    public function guardarAmistad()
    {

          try
            {
              $this->load->model('amigos'); //cargamos modelo amigos para generar lista de amigos y seleccionar
              $id_usuario_prestador = 15;
              $id_amigo = 1;
              //$id_usuario_prestador = $this->session->userdata('id_usuario_logueado');
              $datos['id_amigo1'] = $id_usuario_prestador;
              $datos['id_amigo2'] = $id_amigo;
              $this->amigos->guardar($datos);    
                
                
                //aqui va el codigo que ya esta hecho
             print_r("true");    
            }
      
        catch(Exception $e)
        {
            print_r("false");
        }
    }
    
    public function obtenerAmigos(){
        
        if($this->input->post()==null){
        die;
        }

        $raw = $this->input->post(); //obtengo todos los datos que vienen el el json por post
        $this->data =  json_decode($raw['json']); //guardo en la variable data el json decodificado de los datos
        
    try
    {    
          $id_usuario_prestador = $this->data->id_usuario_logueado;//$this->session->userdata('id_usuario_logueado');    
          $this->load->model('Usuarios'); //ESTO ES EL OBJETO MODELO USUARIOS
          $this->load->model('Amigos');
          $usuarios = $this->Usuarios->getUsuarios();
        
         $datos = array();
         foreach($usuarios as $user)  //voy a recorrer a cada uno de los usuarios
         {
              $sonamigos = $this->Amigos->sonAmigos($id_usuario_prestador,$user->id);  
            // $sonamigos = $this->amigos->sonAmigos($id_usuario_prestador,$user->id);         
                                                                                               
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
        // $param['datos'] = $datos; //a la llave datos del arreglo $param le paso el arreglo $datos
         print_r(json_encode($datos));
    }
    
     catch(Exception $e)
     {
            print_r("false");
     }
   }
    
    public function clasifUsuarios(){



        $id_usuario_prestador = 1;
    try
    {    
        $aquien = 'matias';                             //cambiar a json
        $datos['clasificacion'] = 'clasif';
        $datos['comentario'] = 'coment';
        $this->load->model('usuarios');
        $idaquien = $this->usuarios->getIDusuarioNombreApellido($aquien);
        $datos['usuario_id'] = $idaquien[0]->id;
        $this->load->model('clasifusuarios');
        $this->clasifusuarios->guarda($datos);
    //  if{}
    //  else{}
        print_r("true");
    }
    
     catch(Exception $e)
     {
            print_r("false");
     }
   }        
    
    public function guardarUsuario(){

        try
        {
        $data = array();
 
        
        $data['nombre'] = 'nmbre';
        $data['apellido'] = 'apellido';
        $data['correo'] = 'correo';
        $data['password'] = sha1('password');
        $data['es_usuario'] = 1;
        $data['es_invitado'] = 0;
        $this->load->model('usuarios'); //cargo el modelo uusarios
        
 
        $esta_registrado = $this->usuarios->verificaCorreoYaRegistrado($data['correo']);
        if(count($esta_registrado) == 0)
        {
            $resultado = $this->usuarios->registrar($data); //ejecuto el metodo registrar del modelo usuarios
            if($resultado) //el metodo registrar retorna un booleano
            {
              print_r("registrado");
            }
            else
            {
              print_r("error de registro");
            }
        }
        else
        {
             print_r("ya_registrado");
        }

        }
        catch(Exception $e)
        {
            print_r("false");
        }
     }
    
    
    public function actualizarContrasenia(){
        

        
    try
    {    
        $email = 'matialvarezs@gmail.com';
        //$pass = $this->input->post('password');
        $password = sha1('123');
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
    
     catch(Exception $e)
     {
            print_r("false");
     }
   }
    
     
    
    public function guardarPrestamo(){
        if($this->input->post()==null){
        die;
        }

        $raw = $this->input->post(); //obtengo todos los datos que vienen el el json por post
        $this->data =  json_decode($raw['json']); //guardo en la variable data el json decodificado de los datos
        
        try
        {
        $usuario_seleccionado = $this->data->quien_recibe;
        $this->load->model('usuarios');
        $id = $this->usuarios->getIDusuarioNombreApellido($usuario_seleccionado);
        $op['id_usuario_recibidor'] = $id[0]->id;
        $op['id_usuario_prestador'] = $this->data->id_usuario_logueado;
        $this->load->model('oprestamos');
        $idoprest = $this->oprestamos->registrar($op);
        
        foreach($idoprest as $idop)
        {
            $datos['prestado_id'] = $idop->id;
        }

        $datos['fecha_prestamo'] = date('Y-m-d',strtotime($this->data->fecha_prestamo));
        $datos['tipo_prestamo'] = $this->tipo_prestamo;
        $datos['cantidad'] = $this->data->cantidad;
        $datos['estado'] = 0;
        $datos['fecha_devolucion']  =  date('Y-m-d',strtotime($this->data->fecha_devolucion));

        $this->load->model('prestamos');
        $result = $this->prestamos->registrar($datos);
        echo "true";
        }
        catch(Exception $e)
        {
             echo "false";
        }
   }
    
    public function eliminarPrestamo(){
        
        if($this->input->post()==null){
        die;
        }

        $raw = $this->input->post(); //obtengo todos los datos que vienen el el json por post
        $this->data =  json_decode($raw['json']); //guardo en la variable data el json decodificado de los datos
        
    try
    {    
        //$idPrestamo = $this->data->idPrestamo;
        //$idOPrestamo = $this->data->idOPrestamo;
        
        $this->load->model('prestamos');
        $this->load->model('oprestamos');
        $datap['id'] = $this->data->idprestamo;
        //$datap['id'] = this->data->idprestamo;
        $dataop['id'] = $this->data->idOPrestamo;
        $this->prestamos->eliminar($datap);
        $this->oprestamos->eliminar($dataop);
        print_r("true");
    }
    
     catch(Exception $e)
     {
            print_r("false");
     }
   }
    
    public function marcarPrestamosPendiente(){

        if($this->input->post()==null){
        die;
        }

        $raw = $this->input->post(); //obtengo todos los datos que vienen el el json por post
        $this->data =  json_decode($raw['json']); //guardo en la variable data el json decodificado de los datos
        
    try
    {    
        $this->load->model('prestamos');  // cargo el modelo prestamos
        $id_usuario_prestador = $this->data->id_usuario_logueado; //obtengo el id del usuario logueado
        $idPrestamo = array('id'=>$this->data->id_prestamo); //obtengo de la vista la id del prestamo que se quiere pasar de pendiente a devuelto
        var_dump($idPrestamo['id']); //imprimo para probar el contennido
        
        //$param['datos'] = $this->Prestamos->getPrestamosPendientes($id_usuario_prestador); //creo que esta linea esta demas
        $this->prestamos->marcarPendiente($idPrestamo['id']);  //ejecuto el metodo get..... para cambiar el estado del prestamo
        print_r("true");
    }
    
     catch(Exception $e)
     {
            print_r("false");
     }
   }
    
    public function marcarPrestamosDevuelto(){
        if($this->input->post()==null){
        die;
        }

        $raw = $this->input->post(); //obtengo todos los datos que vienen el el json por post
        $this->data =  json_decode($raw['json']); //guardo en la variable data el json decodificado de los datos
        
    try
    {    
        //en este metodo se hace el proceso inverso que en el metodo pendientes, un prestamo de devuelto se cambia a pendiente
        $this->load->model('prestamos');
        $id_usuario_prestador = $this->data->id_usuario_logueado;
        $idPrestamo = array('id'=>$this->data->id_prestamo);
        var_dump($idPrestamo['id']);
        //$param['datos'] = $this->Prestamos->getPrestamosDevueltos($id_usuario_prestador);
        //return $idPrestamo;
        $this->prestamos->marcarDevuelto($idPrestamo['id']);
       // $this->load->view('navbar');

       // $this->load->view('prestamos_devueltos',$param);
    }
    
     catch(Exception $e)
     {
            print_r("false");
     }
   }        
    
    public function actualizarPrestamo(){

        if($this->input->post()==null){
        die;
        }

        $raw = $this->input->post(); //obtengo todos los datos que vienen el el json por post
        $this->data =  json_decode($raw['json']); //guardo en la variable data el json decodificado de los datos
        
    try
    {    
        $id_usuario_prestador = $this->data->id_usuario_logueado;
        $usuario_seleccionado = $this->data->quien_recibe;
        var_dump($usuario_seleccionado);
        $this->load->model('usuarios');
        $id = $this->usuarios->getIDusuarioNombreApellido($usuario_seleccionado);
        //var_dump($id);
        $idPrestamo = $this->data->idPrestamo;
        $idOPrestamo = $this->data->idOPrestamo;
     
        $datactop['id_usuario_prestador'] = $id_usuario_prestador;
        $datactop['id_usuario_recibidor'] = $id[0]->id;
        $whereop = array('id'=>$idOPrestamo);
        $this->load->model('oprestamos');
        $this->oprestamos->actualizar($datactop,$whereop);
     
        
        $datos['fecha_prestamo'] = date('Y-m-d',strtotime($this->data->fecha_prestamo));
        $datos['tipo_prestamo'] = $this->data->tipo_prestamo;
        $datos['cantidad'] = $this->data->cantidad;
    
        $datos['fecha_devolucion'] = date('Y-m-d',strtotime($this->data->fecha_devolucion));
      
        $wherep = array('id'=>$idPrestamo);
        $this->load->model('prestamos');
        $this->prestamos->actualizar($datos,$wherep);
    }
    
     catch(Exception $e)
     {
            print_r("false");
     }
   }        
    

    
      

    
    
    public function guardarFeedback(){
        
        if($this->input->post()==null){
        die;
        }

        $raw = $this->input->post(); //obtengo todos los datos que vienen el el json por post
        $this->data =  json_decode($raw['json']); //guardo en la variable data el json decodificado de los datos
        
    try
    {    
        $datos['usuario_id'] = $this->data->id_usuario_logueado;
        $datos['clasificacion'] = $this->data->clasificacion;
        $datos['comentario'] = $this->data->comentario;
        $this->load->model('feedback');
        $resultado = $this->feedback->registrar($datos);
        
        if($resultado)
        {
             print_r("true");
             //$this->load->view('navbar');
           //  $this->load->view('registro_feedbacks',$res);
        }
        else
        {
         print_r("false");
        //$this->load->view('partes/cabecera_principal');
        //$this->load->view('navbar');
        //$this->load->view('registro_feedbacks',$res);
        //$this->load->view('partes/piePagina');
       }
    }
     catch(Exception $e)
     {
            print_r("false");
     }
   }
    
    
  
}
?>