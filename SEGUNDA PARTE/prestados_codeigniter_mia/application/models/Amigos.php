<?php
class Amigos extends CI_Model {

        function __construct()
        {

        parent::__construct();
        $this->load->database();
        }
    
    public function sonAmigos($id_usario_logueado,$id_amigo)
    {
        $sql = "select * from amigos where id_amigo1 ="."'".$id_usario_logueado."'"." and id_amigo2 ="."'".$id_amigo."'";
        $query = $this->db->query($sql); //le digo que ejecute el sql
        return $query->result(); //retorna el resultado de la consulta
    }
    
    public function guardar($datos)
    {
        $query = $this->db->insert('amigos',$datos); //eso guarda en la bdd, para que funcione, cada llave del arreglo en este caso $datos, tiene que ser el nombre de las columnas de la tabla
       return $query;
        
    }
    
}