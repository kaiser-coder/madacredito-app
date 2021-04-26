<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Emprunts extends CI_Controller {

	private $my_config = [
		array(
			"field" => "numero",
			"label" => "Numéro de compte",
			"rules" => "trim|required"
		),
		array(
			"field" => "mot_passe",
			"label" => "Mot de passe du compte",
			"rules" => "trim"
		),
		array(
			"field" => "objet",
			"label" => "Objet",
			"rules" => "trim|required"
		),
		array(
			"field" => "capital",
			"label" => "Capital",
			"rules" => "trim|required"
		),
		array(
			"field" => "taux",
			"label" => "Taux",
			"rules" => "trim|required"
		),
		array(
			"field" => "periode",
			"label" => "Période",
			"rules" => "trim|required"
		),
		array(
			"field" => "duree",
			"label" => "Durée",
			"rules" => "trim|required"
		),
		array(
			"field" => "mode",
			"label" => "Mode",
			"rules" => "trim|required"
		),
	];

   public function __construct() {
      parent::__construct();
      $this->load->model('Emprunt');
      $this->load->model('Compte');
      $this->load->model('Operation');
	}
	
	public function list()
	{
		$data['emprunts'] = $this->Emprunt->all()->result_array();
      return $this->layout->view('main', 'emprunts/liste', $data);
	}

   /**
    * Affiche la liste des emprunts réalisés par chaque client
    *
    * @param Int $number - Numéro du compte client
    * @return 
    **/
   public function view($number)
   {
      $data['emprunts'] = $this->Emprunt->find($number)->result_array();
      return $this->layout->view('main', 'emprunts/single', $data);
	}
	
	/**
	 * Calcule les intérêt générés par l'emprunt
	 *
	 * @param Int $c - Capital
	 * @param Int $n - Période
	 * @param Double $t - Taux de l'emprunt
	 * @return Double
	 */
	private function i($c, $n, $t){
		$c = (int) $c;
		$n = (int) $n;
		$t = (double) $t;
		return (double) $c * ($t/100) * $n;
	}

	/**
	 * Calcule la valeur acquise totale générée par l'emprunt
	 *
	 * @param Int $c - Capital
	 * @param Int $n - Période
	 * @param Double $t - Taux de l'emprunt
	 * @return Double
	 */
	private function va($c, $n, $t)
	{
		$c = (int) $c;
		$n = (int) $n;
		$t = (double) $t;
		return (double) $c * pow((1 + ($t/100)), $n);
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
         "numero"    => $data['numero'],
         "mot_passe" => $pass = $data['mot_passe'] != '' ? $data['mot_passe'] : null
      ]);

      if($account->num_rows() === 1){
         return $account->row_array();
      }

      return FALSE;
    }
	
   /**
    * Enregistre les informations du nouvel emprunt
    *
    * @return Void
    */
   public function store()
   {
		$post_data = $this->input->post();

		// Vérification de l'existence du compte
		$compte = $this->account($post_data);

		$this->form_validation->set_rules($this->my_config);

		if ($this->form_validation->run() == TRUE) {
			
			if ($compte) {
				// Vérification si l'emprunt a déjà été effectuer ultérieurement par le compte
				$emprunt = $this->Emprunt->find([
					'numero' => $post_data['numero'],
					'statut' => 'en cours'
				]);

				if($emprunt->num_rows() == 0) {
					// Calcul de la valeur acquise et de l'intérêt
					$interet        = $this->i($post_data['capital'], $post_data['periode'], $post_data['taux']);
					$valeur_acquise = $this->va($post_data['capital'], $post_data['periode'], $post_data['taux']);
					
					$data = array();

					foreach ($post_data as $key => $value) {
						$data[$key] = $value;
					}
					
					$today                 = date_create(date('Y-m-d'));
					$data['dte_operation'] = date('Y-m-d');
					$data['dte_debut']     = date_format(date_add($today, date_interval_create_from_date_string('1 day')), 'Y-m-d');

					if($post_data['unite'] == 'mois') {
						$data['dte_fin']       = date_format(date_add(date_add($today, date_interval_create_from_date_string('1 day')), date_interval_create_from_date_string($post_data['periode'] .' months')), 'Y-m-d');
					} else {
						$data['dte_fin']       = date_format(date_add(date_add($today, date_interval_create_from_date_string('1 day')), date_interval_create_from_date_string($post_data['periode'] .' years')), 'Y-m-d');
					}

					// Enregistrement
					$this->db->insert('operation', [
						'ref'           => uniqid('em_'),
						'libelle'       => 'Emprunt',
						'dte_operation' => date('Y-m-d'),
						'id_admin'      => $this->session->userdata('admin')['id'],
						'id_compte'     => $compte['id']
					]);

					$lst_id = $this->db->insert_id();

					$data['id_operation']   = $lst_id;
					$data['valeur_acquise'] = $valeur_acquise;
					$data['interet']        = $interet;

					$this->Emprunt->insert($data);
					 
					// Mise à jour du solde
					$this->Compte->update($compte['id_client'], [
						'solde' => $compte['solde'] + $post_data['capital'],
					]);

					$this->session->set_tempdata("alert", [
						"badge"     => "success",
						"title"     => '<i class="fas fa-ban"></i> Operation effectué',
						"message"   => "<b>Succès!</b> L'emprunt a été correctement effectué au nom de {$compte['nom']} {$compte['prenom']}"      
					], 2);

					redirect('Operations/paiement/'. $lst_id);
					
				} else {
					$this->session->set_tempdata("alert", [
						"badge"     => "danger",
						"title"     => '<i class="fas fa-ban"></i> Echec de l\'operation',
						"message"   => "<b>Echec!</b> Il existe encore un emprunt en cours appartenant à <b>{$compte['nom']} {$compte['prenom']}</b>"      
					], 2);
				}

			} else {
				$this->session->set_tempdata("alert", [
               "badge"     => "warning",
               "title"     => '<i class="fas fa-ban"></i> Echec de l\'operation',
               "message"   => "<b>Attention!</b> Les informations du client et le compte ne correspondent pas - Le numéro du compte ne correpond pas avec le reste des informations ou le compte n'existe peut-être pas"      
            ], 2);
			}
		} else {
			$this->session->set_tempdata("alert", [
				"badge"     => "warning",
				"title"     => '<i class="fas fa-ban"></i> Attention',
				"message"   => '<b>Attention!</b> Veuiller contrôler vos entrées <br> <ul type="square">'. validation_errors('<li>', '</li>') .'</ul>'        
			], 2);
		}

		return $this->layout->view('main', 'operations/emprunt');
   }

}

/* End of file Emprunts.php */
