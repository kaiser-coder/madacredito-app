<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Compte extends CI_Model {

   /**
    * Affiche la liste de tous les comptes
    *
    * @return Object
    */
   function all()
   {
      return $this->db->select('compte_client.*, client.id, client.nom, client.prenom')
                      ->from('compte_client')
                      ->join('client', 'client.id = compte_client.id_client')
                      ->limit(5, 0)
                      ->get();
   }

   /**
    * Affiche les informations d'un compte
    *
    * @param Int $id - ID du client
    * @return Object
    */
   function find($id)
   {
      return $this->db->select('compte_client.*, admin.pseudo')
                      ->from('compte_client')
                      ->join('client', 'compte_client.id_client = client.id')
                      ->join('admin', 'compte_client.id_admin = admin.id')
                      ->where('client.id', $id)
                      ->get();
   }

   /**
    * Effectue l'insertion
    *
    * @param Array $params
    * @return Void
    */
   function insert($params)
   {
      $this->db->insert('compte_client', $params);
   }

   /**
    * Mets à jour les informations
    *
    * @param Int $id - ID du client
    * @param Array $params
    * @return Void
    */
   function update($id, $params)
   {
      $this->db->set($params)
               ->where('id_client', $id)
               ->update('compte_client');
   }

   /**
    * Permet de vérifier l'existence du compte
    *
    * @param Array $params 
    * @return Object
    **/
   function exist($params)
   {
      return $this->db->select('compte_client.*, client.*')
                      ->from('compte_client')
                      ->join('client', 'compte_client.id_client = client.id')
                      ->where($params)
                      ->get();
   }
}

/* End of file Compte.php */
