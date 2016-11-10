<?php
class Clasifusuarios extends CI_Model {

        function __construct()
        {

        parent::__construct();
        $this->load->database();
        }
        
        public function guarda($data)
        {
            $query = $this->db->insert('clasif_usuarios',$data);
            return $query;
        }
}