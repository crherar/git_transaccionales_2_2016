<?php
class Usuarios extends CI_Model {

 

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
          $this->load->database();
    }
    
    //en cada uno de estos metodos se ejecuta una consulta sql y se retorna el resultado para ser usado en el controlador que se llame el metodo con la linea 
    //$this->load->model('Usuarios') y despues $this->load->registrar($data)
    
    public function registrar($datos) //datos es un arreglo que el insert lo transforma y hace el insert into
    {
        $result = $this->db->insert('usuarios',$datos);
        return $result;
    }
    
    public function getUsuarios()
    {
        $sql = "select * from vwUsuarios order by usuario asc";
        $query = $this->db->query($sql);
        //$query = $this->db->get('vwUsuarios');
        return $query->result();
    }
    
    public function validar($user,$pass)
    {
       
        $sql = "select * from usuarios where correo ="."'".$user."'"." and password ="."'".$pass."'";
        //var_dump($sql);
        $query = $this->db->query($sql);
        return $query->num_rows(); 
    }
    
    public function validarConFacebook($user)
    {
         $sql = "select * from usuarios where correo ="."'".$user."'";
        //var_dump($sql);
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    
    public function getIDusuarioPorCorreo($correo)
    {
        $sql = "select id from usuarios where correo = "."'".$correo."'";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function getIDusuarioNombreApellido($dato)
    {
        $sql = "select id from vwUsuarios where usuario = "."'".$dato."'";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function getNombreApellidoPorID($id)
    {
        $sql = "select usuario from vwUsuarios where id = "."'".$id."'";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function getCorreoPorNombreUsuario($usuario)
    {
        $sql = "select correo from vwUsuarios where usuario = "."'".$usuario."'";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function getCorreoPorIDUsuario($idusuario)
    {
        $sql = "select correo from vwUsuarios where id = "."'".$idusuario."'";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function verificaCorreoYaRegistrado($correo)
    {
        $sql = "select correo from usuarios where correo = "."'".$correo."'";
        //var_dump($sql);
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function updatePassword($email,$pasword)
    {
        $sql = "update usuarios set password = "."'".$pasword."'"." where correo = "."'".$email."'";
        $query = $this->db->query($sql);
        return $query;
    }
}