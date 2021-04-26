<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Operations extends CI_Controller {

   public function __construct() {
      parent::__construct();
      $this->load->model('Compte');
   }

   /**
    * Affiche le formulaire de dépôt
    *
    * @param Int $id - ID du client
    * @return Layout
    **/
   public function depot($id = null)
   {
      if(isset($id)) {
         $data['compte'] = $this->Compte->exist(['id_client' => $id])->row_array(); 
         return $this->layout->view('main', 'operations/depot', $data);
      } else {
         return $this->layout->view('main', 'operations/depot');
      }
   }

   /**
    * Affiche le formulaire de retrait
    *
    * @param In $id - ID du client
    * @return Layout
    **/
   public function retrait($id = null)
   {
      if(isset($id)) {
         $data['compte'] = $this->Compte->exist(['id_client' => $id])->row_array(); 
         return $this->layout->view('main', 'operations/retrait', $data);
      } else {
         return $this->layout->view('main', 'operations/retrait');
      }
   }

   /**
    * Affiche le formulaire de prêt
    *
    * @return Layout
    **/
   public function emprunt()
   {
      return $this->layout->view('main', 'operations/emprunt');
   }

   /**
    * Redirige vers le contrôleur de paiement
    *
    * @param Int $id - ID de l'opération
    * @return Layout
    **/
   public function paiement($id)
   {
      redirect('Paiements/register/'. $id);
   }
}

/* End of file Operations.php */
