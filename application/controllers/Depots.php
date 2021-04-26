<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Depots extends CI_controller {
   private $my_config = [
      array(
         "field" => "numero",
         "label" => "Numero de compte",
         "rules" => "trim|required"
      ),
      array(
         "field" => "mot_passe",
         "label" => "Mot de passe",
         "rules" => "trim"
      ),
      array(
         "field" => "nom",
         "label" => "Nom du client",
         "rules" => "trim|required"
      ),
      array(
         "field" => "prenom",
         "label" => "Prenom du client",
         "rules" => "trim|required"
      ),
      array(
         "field" => "nom_porteur",
         "label" => "Nom du porteur",
         "rules" => "trim"
      ),
      array(
         "field" => "prenom_porteur",
         "label" => "Prénom du porteur",
         "rules" => "trim"
      ),
      array(
         "field" => "montant",
         "label" => "Montant du dépôt",
         "rules" => "trim|required|numeric"
      )
   ];

   public function __construct() {
      parent::__construct();
      $this->load->model('Operation');
      $this->load->model('Compte');
      $this->load->model('Depot');
   }

   /**
    * Récupère le compte client
    *
    * @param Array
    * @return Array|Boolean
    */
    private function account($data)
    {
      $account = $this->Compte->exist([
         "numero"    => $data["numero"],
         "nom"       => $data["nom"],
         "prenom"    => $data["prenom"],
         "mot_passe" => $pass = $data["mot_passe"] != '' ? $data['mot_passe'] : null
      ]);

      if($account->num_rows() === 1){
         return $account->row_array();
      }

      return FALSE;
    }

   /**
    * Effectue l'enegistrement de l'operation
    *
    * @return Layout
    */
   public function register()
   {
      $post_data = $this->input->post();
   
      $this->form_validation->set_rules($this->my_config);
      
      if ($this->form_validation->run() == TRUE) {

         // Vérifie l'existence du compte

         if ( $this->account($post_data) ) {
            $compte = $this->account($post_data);

            // Enregistrement de l'operation
            $this->Operation->insert([
               "ref"           => uniqid('dep_'),
               "libelle"       => "Dépôt",
               "dte_operation" => date('Y-m-d'),
               "id_admin"      => $this->session->userdata('admin')['id'],
               "id_compte"     => $compte["id"]
            ]);
            
            // Récupère l'ID la dernière opération effectuée
            $lst_id = $this->db->insert_id();

            // Effectue le dépôt 
            $this->Depot->insert([
               "id_operation"   => $lst_id,
               "montant"        => $post_data["montant"],
               'porteur'        => $json = isset($post_data["nom_porteur"], $post_data["prenom_porteur"]) ? json_encode(array(
                  "nom_porteur"    => $post_data["nom_porteur"],
                  "prenom_porteur" => $post_data["prenom_porteur"]
               )) : null
            ]);

            // Modifie la somme dans le compte
            $this->Compte->update($compte["id_client"], [
               "solde" => $compte["solde"] + $post_data["montant"]
            ]);

            $this->session->set_tempdata("alert", [
               "badge"     => "success",
               "title"     => '<i class="fas fa-check"></i> Succès de l\'operation',
               "message"   => '<b>Succès!</b> Le dépôt dans le compte ayant le numéro <b>'. $compte["numero"] .'</b> appartenant à <b>'. $compte["nom"] .' '. $compte["prenom"] .'</b> vient d\'être effectué avec succès'       
            ], 2);

            redirect('Comptes/view/'. $compte["id_client"]);

         } else {
            $this->session->set_tempdata("alert", [
               "badge"     => "danger",
               "title"     => '<i class="fas fa-ban"></i> Echec de l\'operation',
               "message"   => "<b>Echec!</b> Les informations du client et le compte ne correspondent pas - Le numéro du compte ne correpond pas avec le reste des informations"      
            ], 2);
         }
      } else {
         $this->session->set_tempdata("alert", [
				"badge"     => "warning",
				"title"     => '<i class="fas fa-ban"></i> Attention',
				"message"   => '<b>Attention!</b> Veuiller contrôler vos entrées <br> <ul type="square">'. validation_errors('<li>', '</li>') .'</ul>'        
			], 2);
      }
      
      return $this->layout->view('main', 'operations/depot');
   }

}

/* End of file Depots.php */
