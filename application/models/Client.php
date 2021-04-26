<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Model {
   /**
    * Récupère la liste des clients
    *
    * @return Object
    */
   function all(){
      return $this->db->limit(5, 0)
                      ->get('client');
   }

   /**
    * Effectue l'insertion
    *
    * @param Array $params - Les données du nouveau client
    * @return Void
    */
   function insert($params){
      return $this->db->insert('client', $params);
   }

   /**
    * Récupère les informations d'un client
    *
    * @param Int $id - ID du client
    * @return Object
    **/
   function find($id)
   {
      return $this->db->select('client.*')
                      ->from('client')
                      ->where('id = ', $id)
                      ->get();
   }

   /**
    * Effectue la mise à jour des données
    *
    * @param Array $params - Les données à enregistrer
    * @return Void
    **/
   function update($params)
   {
      $this->db->set($params)
               ->where('id =', $params['id'])
               ->update('client');
   }

   /**
    * Récupère la dernier client inséré
    *
    * @return Object
    */
   function last()
   {
      return $this->db->select('*')
                      ->from('client')
                      ->order_by('id', 'DESC')
                      ->limit(1, 0)
                      ->get();
   }

   /**
    * Recherche un client
    *
    * @param Array $params
    * @return Object
    */
   function exist($params) {
      return $this->db->where($params)
                      ->get("client");
   }

}

/* End of file Client.php */

