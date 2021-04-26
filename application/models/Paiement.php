<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Paiement extends CI_Model {
                
    function last($ref)
    {
        return $this->db->select('*')
                        ->from('paiement')
                        ->where('ref_emprunt', $ref)
                        ->limit(1)
                        ->order_by('id', 'DESC')
                        ->get();
    }

    function insert($params)
    {
        $this->db->insert('paiement', $params);
    }

    function update($id, $params)
    {
        $this->db->set($params)
                 ->update('paiement')
                 ->where('id_operation', $id);
    }

    function view($ref)
    {
        return $this->db->select('*')
                        ->from('paiement')
                        ->where('ref_emprunt', $ref)
                        ->order_by('id_operation', 'DESC')
                        ->get();
    }

    function find($id)
    {
        return $this->db->select('operation.*, paiement.*')
                    ->from('operation')
                    ->join('compte_client', 'operation.id_compte = compte_client.id')
                    ->join('paiement', 'operation.id = paiement.id_operation')
                    ->where('compte_client.id_client', $id)
                    ->get(); 
    }
}

/* End of file Paiement.php */
