<?php
class Feedback extends CI_Model {

 

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
          $this->load->database();
    }
    
    public function registrar($datos)
    {
        $query = $this->db->insert('feedbacks',$datos);
        return $query;
    }
    
    public function getDatos()
    {
        $sql = "select u.usuario,f.clasificacion,f.comentario,f.fecha from vwUsuarios u,feedbacks f where u.id = f.usuario_id order by f.fecha desc";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function cantidadPorCategoria($clasificacion)
    {
        $sql = "select * from feedbacks where clasificacion = "."'".$clasificacion."'";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
}