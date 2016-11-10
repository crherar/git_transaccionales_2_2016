<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feedbackc extends CI_Controller {

    public function index()
    {
        $this->load->model('feedback');
        $datos['clasif1'] = $this->feedback->cantidadPorCategoria(1);
        $datos['clasif2'] = $this->feedback->cantidadPorCategoria(2);
        $datos['clasif3'] = $this->feedback->cantidadPorCategoria(3);
        $datos['clasif4'] = $this->feedback->cantidadPorCategoria(4);
        $datos['clasif5'] = $this->feedback->cantidadPorCategoria(5);
        $param['data'] = $this->feedback->getDatos();
        $param['clasificaciones'] = $datos;
        $param['id'] = $this->session->userdata('id_usuario_logueado');
        
        
        $this->load->view('partes/cabecera_principal');
        if($param['id'] != null)
        $this->load->view('navbar');
        $this->load->view('index_feedback',$param);
        $this->load->view('forms/frm_datos_clasificacion_prestados');
        $this->load->view('forms/frm_datos_guardados_ok');
        $this->load->view('partes/piePagina');
    }
    
    // public function verFeedbacks()
    // {
    //     $this->load->model('feedback');
        
    //     $datos['clasif1'] = $this->feedback->cantidadPorCategoria(1);
    //     $datos['clasif2'] = $this->feedback->cantidadPorCategoria(2);
    //     $datos['clasif3'] = $this->feedback->cantidadPorCategoria(3);
    //     $datos['clasif4'] = $this->feedback->cantidadPorCategoria(4);
    //     $datos['clasif5'] = $this->feedback->cantidadPorCategoria(5);
    //     $param['data'] = $this->feedback->getDatos();
    //     $param['clasificaciones'] = $datos;
    //     $param['id'] = $this->session->userdata('id_usuario_logueado');
    //     $this->load->view('ver_feedbacks',$param);
    //           $this->load->view('forms/frm_datos_clasificacion_prestados');
    //     $this->load->view('forms/frm_datos_guardados_ok');
    //     $this->load->view('partes/piePagina');
        
    // }
    public function guardar()
    {
        $datos['usuario_id'] = $this->session->userdata('id_usuario_logueado');
        $datos['clasificacion'] = $this->input->post('clasificacion');
        $datos['comentario'] = $this->input->post('comentario');
        $this->load->model('feedback');
        $resultado = $this->feedback->registrar($datos);
        
        if($resultado)
        {
             $res['mensaje'] = "Usuario guardado correctamente";
             $this->load->view('navbar');
           //  $this->load->view('registro_feedbacks',$res);
        }
        else
        {
        $res['mensaje'] = "Error al guardar";
        $this->load->view('partes/cabecera_principal');
        $this->load->view('navbar');
       // $this->load->view('registro_feedbacks',$res);
        $this->load->view('partes/piePagina');
        }
    }
}