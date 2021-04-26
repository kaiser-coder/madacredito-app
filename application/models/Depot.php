<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Depot extends CI_Model {

   function insert($params)
   {
      $this->db->insert('depot', $params);
   }

   function find($id)
   {
      return $this->db->select('operation.*, depot.*')
                     ->from('operation')
                     ->join('compte_client', 'operation.id_compte = compte_client.id')
                     ->join('depot', 'operation.id = depot.id_operation')
                     ->where('compte_client.id_client', $id)
                     ->get();
   }
}

/* End of file Depot.php */
