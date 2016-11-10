<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prestamos_pendientesc extends CI_Controller{
    
    
    public function todos()
    {
        $this->load->model('usuarios');
        $this->load->model('prestamos');
        $data = $this->prestamos->getTodos();
        $datos = array();
        
        foreach($data as $dat)
        {

            $prestador = $this->usuarios->getNombreApellidoPorID($dat->id_usuario_prestador);
            $recibidor = $this->usuarios->getNombreApellidoPorID($dat->id_usuario_recibidor);
            $correo_presta = $this->usuarios->getCorreoPorIDUsuario($dat->id_usuario_prestador);
            $correo_recibe = $this->usuarios->getCorreoPorIDUsuario($dat->id_usuario_recibidor);
 
                    if(count($prestador)>0)
                    {
                       $temp['prestador'] = $prestador[0]->usuario;
                      
                    }
                    else
                    { 
                       $temp['prestador'] = "";
                      
                    }
                    
                    if(count($correo_presta)>0)
                    {
                       $temp['correo_prestador'] = $correo_presta[0]->correo;
                    }
                    else
                    {
                       $temp['correo_prestador'] = "";
                    }
                    if(count($recibidor)>0)
                    {
                       $temp['recibidor'] = $recibidor[0]->usuario;
                       
                    }
                    else
                    {
                      $temp['recibidor'] = "";
                      
                    }
                    if(count($correo_recibe)>0)
                    {
                      $temp['correo_recibidor'] = $correo_recibe[0]->correo;
                    }
                    else
                    {
                       $temp['correo_recibidor']  = "";
                    }
                    $temp['fecha_prestamo'] = $dat->fecha_prestamo;
                    $temp['fecha_devolucion'] = $dat->fecha_devolucion;
                    $temp['tipo_prestamo'] = $dat->tipo_prestamo;
                    $temp['cantidad'] = $dat->cantidad;
                    $temp['fecha_devolucion'] = $dat->fecha_devolucion;
                    $temp['total_dias'] = $dat->total_dias;
                    array_push($datos,$temp);
        }
      echo json_encode($datos);
      //$param['datas'] = $datos;
      //$this->load->view('pendientes/tbl_prestamos_pendientes',$param);
    }
    
    public function correoAutomatico()
    {
        $this->load->view('correos_automatico_php');
    }
}