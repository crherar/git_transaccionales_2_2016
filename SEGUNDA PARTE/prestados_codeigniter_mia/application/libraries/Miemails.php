<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Miemails
{
 
    public function __construct()
    {
        // Do something with $params
     //   $this->load->library('email');
    }
    
    public function enviarCorreoPrestamoNuevo($id_usuario_prestador,$usuario_recibidor,$cantidad,$cosa,$fecha_prestamo,$fecha_devolucion)
    {
    
    
    // $this->email->initialize(array(
    //       'protocol' => 'smtp',
    //       'smtp_host' => 'smtp.gmail.com',
    //       'smtp_user' => 'prestados.app',
    //       'smtp_pass' => 'prestados123',
    //       'smtp_port' => 587,
    //       'crlf' => "\r\n",
    //       'newline' => "\r\n"
    //           ));

    
       // $this->load->library('email');
        $this->email->from('prestados.app@gmail.com', 'Prestados App');
        $this->email->to($para); 
    //    $this->email->cc('another@another-example.com'); 
     //  $this->email->bcc('them@their-example.com'); 

        $asunto = "Aviso nuevo prestamo - App prestados";
        $this->load->model('Usuarios');
        $this->Usuarios->getNombreApellidoPorID($id_usuario_prestador);
        $usuario_prestador = "";
        $this->email->subject($asunto);
        $mensaje = $usuario_prestador." te ha hecho el siguiente prestamo: ".$cantidad." ".$cosa." el dia ".$fecha_prestamo. " con fecha devolucion ".$fecha_devolucion." Te llegará un correo recordatorio para la devolucion. \n \n Prestados App";
        $this->email->message('Testing the email class.');	

        $this->email->send();


      echo $this->email->print_debugger();
    }
    
    function sendMail()
    {
        $config = Array(
      'protocol' => 'smtp',
      'smtp_host' => 'ssl://smtp.googlemail.com',
      'smtp_port' => 465,
      'smtp_user' => 'prestados.app@gmail.com', // change it to yours
      'smtp_pass' => 'prestados123', // change it to yours
      'mailtype' => 'html',
      'charset' => 'iso-8859-1',
      'wordwrap' => TRUE
     );

      $message = '';
      $this->load->library('email', $config);
      $this->email->set_newline("\r\n");
      $this->email->from('prestados.app@gmail.com'); // change it to yours
      $this->email->to('matialvarezs@gmail.com');// change it to yours
      $this->email->subject('Resume from JobsBuddy for your Job posting');
      $this->email->message($message);
      if($this->email->send())
     {
      echo 'Email sent.';
     }
     else
    {
     show_error($this->email->print_debugger());
    }

}
}

//prestados.app@gmail.com / prestados123