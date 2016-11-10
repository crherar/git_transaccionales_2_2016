<?php
class Oprestamos extends CI_Model {

 

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
          $this->load->database();
    }
    
    public function registrar($datos)
    {
        $this->db->insert('op_prestamos',$datos);
        $sql = "select max(id) as id from op_prestamos";
        $result = $this->db->query($sql);
        return $result->result();
    }
    
    public function actualizar($datos,$where)
    {
        var_dump($datos);
        $query =$this->db->update('op_prestamos',$datos,$where);
        return $query;
    }
    
    public function eliminar($data)
    {
        $this->db->delete('op_prestamos',$data);
    }
}