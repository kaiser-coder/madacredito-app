<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Paiements extends CI_Controller {

   public function __construct() {
      parent::__construct();
      $this->load->model('Operation');
      $this->load->model('Emprunt');
      $this->load->model('Paiement');
   }

   /**
    * Effectue le paiement d'un emprunt
    *
    * @param Int $id - ID de l'opération
    * @return Void
    */   
   public function register($id)
   {
      // Récupère l'emprunt effectué par le client suivant l'ID de l'opération
      $emprunt = $this->Emprunt->find([
         'id_operation' => $id
      ])->row_array();

      $taux = $emprunt['taux'] / 100;

      // Mode de calcul en fonction des mode de remboursement
      if ($emprunt['mode_remboursement'] != 'A l\'échéance') {

         for ($i=1; $i <= $emprunt['duree_emprunt']; $i++) { 
            // Récupération de la dernière ligne dans la table Paiement
            $lst_paiement = $this->Paiement->last($emprunt['ref'])->row_array();

            // Date début
            $dte_debut = date_create($emprunt['dte_debut']);

            // Calcul de la prochaine date de paiement
            if ($emprunt['unite_emprunt'] == 'mois') {
               $dte_paiement = date_format(date_add(date_add($dte_debut, date_interval_create_from_date_string('1 day')), date_interval_create_from_date_string($i .' months')), 'Y-m-d');
            } else {
               $dte_paiement = date_format(date_add(date_add($dte_debut, date_interval_create_from_date_string('1 day')), date_interval_create_from_date_string($i .' years')), 'Y-m-d');
            }

            //  Calcul de la dette restante
            if($lst_paiement == null) {
               $dette_rest  = $emprunt['capital'];
            } else {
               $dette_rest  = $lst_paiement['dette_debut'] - $lst_paiement['ammortissement_paye'];
            }

            // Calcul de l'intérêt généré par période
            $interet  = $dette_rest * $taux;

            // Calcul des annuités et des ammortissements 
            if ($emprunt['mode_remboursement'] == 'En plusieurs annuités constantes' ) {
               $annuite      = ($emprunt['capital'] * $taux) / (1 - pow((1 + $taux), -$emprunt['duree_emprunt']));
               $nxt_ammort = $annuite - $interet;
            } else {
               $nxt_ammort   = $emprunt['capital'] / $emprunt['duree_emprunt'];
               $annuite  = $nxt_ammort + $interet;
            }

            // Période
            $nxt_periode = $i;

            $this->Paiement->insert([
               'id_operation'        => $id,
               'dte_paiement'        => $dte_paiement,
               'periode'             => $nxt_periode, 
               'dette_debut'         => $dette_rest, 
               'interet_par_periode' => $interet, 
               'ammortissement_paye' => $nxt_ammort, 
               'annuite_versee'      => $annuite, 
               'ref_emprunt'         => $emprunt['ref']
            ]);
         }

      } else {
         $this->Paiement->insert([
            'id_operation'        => $id,
            'dte_paiement'        => $emprunt['dte_fin'],
            'periode'             => '1', 
            'dette_debut'         => $emprunt['capital'], 
            'interet_par_periode' => $emprunt['interet'], 
            'ammortissement_paye' => $emprunt['capital'], 
            'annuite_versee'      => $emprunt['valeur_acquise'], 
            'ref_emprunt'         => $emprunt['ref']
         ]);
      }

      redirect('Comptes/view/'. $emprunt['id_client']);
   }

   /**
    * Effectue le paiement d'un emprunt
    *
    * @param Int $id - ID de l'opération
    * @return Void
    */ 
   public function pay($id)
   {
      $this->Operation->insert([
         'ref'           => uniqid('pa_'),
         'libelle'       => 'Paiement',
         'dte_operation' => date('Y-m-d'),
         'id_admin'      => $this->session->userdata('admin')['id'],
         'id_compte'     => $id
      ]);

      $this->Paiement->update($id, [
         'statut' => 'payé'
      ]);

      redirect('Admins/home');
   }
}

/* End of file Paiements.php */
