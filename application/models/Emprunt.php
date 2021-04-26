<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* function insertion_mois($data1, $data2)
    {   
        $requete_emprunt = "INSERT INTO emprunt(capital, taux, interet, valeur_acquise, duree_emprunt, unite_emprunt, objet, mode_remboursement, statut)
        VALUES(
            ?,?,?,?,?,?,?,?,'En progression'
        )" ;
        $requete_faire_emprunt_mois = "INSERT INTO faire_emprunt(`date_operation`,`date_debut`,`date_fin`,`id_compteClient`,`id_emprunt`, `matricule_Client`)
        VALUES(
        CURDATE(),
        ADDDATE(CURDATE(), 1),
        ADDDATE(ADDDATE(CURDATE(), 1), INTERVAL (SELECT duree_emprunt FROM emprunt WHERE `id_emprunt` = (SELECT `id_emprunt` FROM `emprunt` ORDER BY `id_emprunt` DESC LIMIT 0,1 ))MONTH),
        (SELECT `id_compteClient` FROM `compte_client` JOIN `client` ON `compte_client`.`matricule_Client` = `client`.`matricule_Client` WHERE `compte_client`.`Num_compte` = ?),
        (SELECT `id_emprunt` FROM `emprunt` ORDER BY `id_emprunt` DESC LIMIT 0,1 ),
        (SELECT `matricule_Client` from `compte_client` WHERE `compte_client`.`Num_compte` = ?)
        )";
        $this->db->query($requete_emprunt, $data1);
        $this->db->query($requete_faire_emprunt_mois, $data2);
    }
    function insertion_annee($data1, $data2)
    {   
        $requete_emprunt = "INSERT INTO emprunt(capital, taux, interet, valeur_acquise, duree_emprunt, unite_emprunt, objet, mode_remboursement, statut)
        VALUES(
            ?,?,?,?,?,?,?,?,'En progression'
        )" ;
        $requete_faire_emprunt_annee = "INSERT INTO faire_emprunt(`date_operation`,`date_debut`,`date_fin`,`id_compteClient`,`id_emprunt`, `matricule_Client`)
        VALUES(
        CURDATE(),
        ADDDATE(CURDATE(), 1),
        (SELECT ADDDATE(ADDDATE(CURDATE(), 1), INTERVAL (SELECT duree_emprunt FROM emprunt ORDER BY `id_emprunt` DESC LIMIT 0,1 ) YEAR) AS dte_fin),
        (SELECT `id_compteClient` FROM `compte_client` JOIN `client` ON `compte_client`.`matricule_Client` = `client`.`matricule_Client` WHERE `compte_client`.`Num_compte` = ?),
        (SELECT `id_emprunt` FROM `emprunt` ORDER BY `id_emprunt` DESC LIMIT 0,1 ),
        (SELECT `matricule_Client` from `compte_client` WHERE `compte_client`.`Num_compte` = ?)
        )";

        $this->db->query($requete_emprunt, $data1);
        $this->db->query($requete_faire_emprunt_annee, $data2);
    }
    */


class Emprunt extends CI_Model {

   /**
    * Récupère les emprunts effectués par un client
    *
    * @param Array $params
    * @return Object
    **/
   function find($params)
   {
      return $this->db->select('emprunt.*, operation.*, compte_client.id, compte_client.numero, compte_client.id_client')
                      ->from('operation')
                      ->join('emprunt', 'operation.id = emprunt.id_operation')
                      ->join('compte_client', 'compte_client.id = operation.id_compte')
                      ->where($params)
                      ->get();
   }

   /**
    * Récupère le dernier emprunt inséré
    *
    * @return Object
    */
   function last()
   {
       return $this->db->select('*')
                       ->from('emprunt')
                       ->limit(1, 0)
                       ->order_by('id', 'DESC')
                       ->get();
   }

   /**
    * Effectue l'insertion dans la base de donnée
    *
    * @param Array $params
    * @return Void
    */
   function insert($params)
   {
        $this->db->insert('emprunt', [
            'id_operation'       => $params['id_operation'],
            'capital'            => $params['capital'],
            'taux'               => $params['taux'],
            'interet'            => $params['interet'],
            'valeur_acquise'     => $params['valeur_acquise'],
            'duree_emprunt'      => $params['periode'],
            'unite_emprunt'      => $params['duree'],
            'objet'              => $params['objet'],
            'mode_remboursement' => $params['mode'],
            'dte_debut'          => $params['dte_debut'],
            'dte_fin'            => $params['dte_fin'],
            'statut'             => 'en cours'
        ]);
   }
}

/* End of file Emprunt.php */
