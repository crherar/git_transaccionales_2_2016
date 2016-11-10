<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Funemail extends CI_Controller {

          //como no sabía donde ponerlo, pusi aqui enviar emails...
public function send_now()
{
    $this->load->library('email');

    $this->email->from('prestados.app@gmail.com', 'Prestados App');
    $this->email->to('matialvarezs@gmail.com');
    $this->email->cc('n.arellano.t@gmail.com');
    
    $this->email->subject('Bienvenido a Prestados!!');
    $this->email->message('Te damos la bienvenida a Prestados App. </p>Ten el registro de las cosas que prestas en linea, actualiza lo que prestas y la forma en que lo devuelven!!
                            </p><strong>Que esperas para empesar a prestar cosas!!</strong>');

    $this->email->send();
}
//ahí está mi enviar emails
}