<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Retrait extends CI_Model {

   function insert($params)
   {
      $this->db->insert('retrait', $params);
   }

   function find($id)
   {
      return $this->db->select('operation.*, retrait.*')
                     ->from('operation')
                     ->join('compte_client', 'operation.id_compte = compte_client.id')
                     ->join('retrait', 'operation.id = retrait.id_operation')
                     ->where('compte_client.id_client', $id)
                     ->get();
   }
}

/* End of file Retrait.php */
