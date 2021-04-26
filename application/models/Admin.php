<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Model {

    /**
     * Affiche la liste de tous les adminsitrateurs
     *
     * @return Object
     */
    function all(){
        return $this->db->get('admin');
    }
    
    /**
     * Récupère les informations d'un administrateur
     *
     * @param Int $id
     * @return Object
     */
    function find($id){
        return $this->db->select('*')
                        ->from('admin')
                        ->where('id', $id)
                        ->get();
    }

    /**
     * Effectue l'insertion
     *
     * @param Array $params
     * @return Void
     */
    function insert($params){
        $this->db->insert('admin', $params);
    }

    /**
     * Effectue la mise à jour des inforations d'un client
     *
     * @param Array $params
     * @return Void
     */
    function update($params){
        $this->db->set($params)
                 ->where('id', $params['id'])
                 ->update('admin');
    }
}

/* End of file Admin.php */
