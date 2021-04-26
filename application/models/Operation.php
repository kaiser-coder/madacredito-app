<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Operation extends CI_Model {

   /**
    * Récupère toutes les opérations effectués
    *
    * @return Object
    */
   function all()
   {
      return $this->db->select('operation.*, compte_client.*, admin.pseudo')
                      ->from('operation')
                      ->join('admin', 'admin.id = operation.id_admin')
                      ->join('compte_client', 'compte_client.id = operation.id_compte')
                      ->order_by('dte_operation', 'DESC')
                      ->get();
   }

   /**
    * Récupère la dernière opération effectué
    *
    * @return Object
    */
   function last()
   {
      return $this->db->select("*")
                      ->from("operation")
                      ->order_by("id", "DESC")
                      ->limit(1, 0)
                      ->get();
   }

   /**
    * Effectue l'insertion d'une opération
    *
    * @param Array $params
    */
   function insert($params)
   {
      $this->db->insert("operation", $params);
   }

   /**
    * Affiche les opérations éffectués via un compte
    *
    * @param Int $id - ID du client
    * @return Object
    */
   function find($id)
   {
      return $this->db->select('operation.*, admin.pseudo')
                     ->from('operation')
                     ->join('compte_client', 'operation.id_compte = compte_client.id')
                     ->join('admin', 'operation.id_admin = admin.id')
                     ->where('compte_client.id_client', $id)
                     ->get();
   }
}

/* End of file Operation.php */
