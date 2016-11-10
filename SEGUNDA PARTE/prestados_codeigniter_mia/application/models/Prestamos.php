<?php
class Prestamos extends CI_Model {

 

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
          $this->load->database();
    }
    
    public function registrar($datos)
    {
        $result = $this->db->insert('prestamos',$datos);
        return $result;
    }
    
    public function marcarDevuelto($idprestamo)
    {
        $sql = "update prestamos set estado = 1 where id = "."'".$idprestamo."'";
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function marcarPendiente($idprestamo)
    {
        $sql = "update prestamos set estado = 0 where id = "."'".$idprestamo."'";
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function getPrestamosPendientes($id_usuario_prestador)
    {
        $sql = "select p.id as idPrestamo,p.prestado_id as idOPrestamo,cast(p.fecha_prestamo as date) as fecha_prestamo,p.tipo_prestamo,p.cantidad,concat(u.nombre,' ',u.apellido) as quienrecibe,cast(p.fecha_devolucion as date) as fecha_devolucion,DATEDIFF( p.fecha_devolucion, NOW( ) ) AS total_dias from prestamos p,op_prestamos op,usuarios u where p.estado = 0 and op.id_usuario_prestador = " ."'".$id_usuario_prestador."'". " and p.prestado_id = op.id and u.id = op.id_usuario_recibidor order by cast(p.fecha_prestamo as date) desc";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    public function getPrestamosDevueltos($id_usuario_prestador)
    {
        $sql = "select p.id as idPrestamo,cast(p.fecha_prestamo as date) as fecha_prestamo,p.tipo_prestamo,p.cantidad,concat(u.nombre,' ',u.apellido) as quienrecibe,cast(p.fecha_devolucion as date) as fecha_devolucion from prestamos p,op_prestamos op,usuarios u where p.estado = 1 and op.id_usuario_prestador = " ."'".$id_usuario_prestador."'". " and p.prestado_id = op.id and u.id = op.id_usuario_recibidor order by cast(p.fecha_prestamo as date) desc";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    public function actualizar($datos,$where)
    {
        //var_dump($datos);
       $this->db->update('prestamos',$datos,$where);
    }
    
    public function eliminar($data)
    {
        $this->db->delete('prestamos',$data);
    }
    
   public function getTodos()
    {
        $sql = "SELECT p.fecha_prestamo, op.id_usuario_prestador, op.id_usuario_recibidor, p.tipo_prestamo, p.cantidad, p.fecha_devolucion, DATEDIFF( p.fecha_devolucion, NOW( ) ) AS total_dias
                FROM prestamos p, op_prestamos op
                WHERE op.id = p.prestado_id order by p.fecha_prestamo desc";
        $query = $this->db->query($sql);
        return $query->result();
    }
}