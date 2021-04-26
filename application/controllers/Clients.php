<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Clients extends CI_Controller {

	private $my_config = [
		array(
			"field" => "nom",
			"label" => "Nom",
			"rules" => "trim|required"
		),
		array(
			"field" => "prenom",
			"label" => "Prénom",
			"rules" => "trim|required"
		),
		array(
			"field" => "sexe",
			"label" => "Genre",
			"rules" => "trim|required|in_list[M,F]"
		),
		array(
			"field" => "dte_naissance",
			"label" => "Date de naissance",
			"rules" => "trim|required"
		),
		array(
			"field" => "adresse",
			"label" => "Adresse",
			"rules" => "trim|required"
		),
		array(
			"field" => "cin",
			"label" => "Cin",
			"rules" => "trim|required|integer"
		),
		array(
			"field" => "profession",
			"label" => "Profession",
			"rules" => "trim|required"
		),
		array(
			"field" => "lieu_travail",
			"label" => "Lieu de travail",
			"rules" => "trim|required"
		),
		array(
			"field" => "email",
			"label" => "E-mail",
			"rules" => "trim|required|valid_email"
		),
		array(
			"field" => "contact",
			"label" => "Numéro de téléphone",
			"rules" => "trim|required"
		)
	];

	public function __construct() {
		parent::__construct();
		$this->load->model('Client');
		$this->load->model('Compte');
		$this->load->helper('Array');
	}

	/**
	 * Génère un numéro de compte aléatoire
	 *
	 * @return String - Numéro de compte généré
	 */
	 private function generate_number()
	 {
		 $char = 'AZERTYUIOPQSDFGHJKLMWXCVBN';
		 $nbr = '0123456789';
		 $arr1 = array();
		 $arr2 = array();
 
		 for ($i=0; $i < 5; $i++) { 
			 $arr1[$i] = substr(str_shuffle($char), 25);
		 }
 
		 for ($i=0; $i < 2; $i++) { 
			 $arr2[$i] = substr(str_shuffle($nbr), 9);
		 }
 
		 return $arr1[0].''.$arr1[1].''.$arr1[2].''.$arr1[3].''.$arr2[0].''.$arr2[1];
	 } 
 
	
	/**
	 * Affiche la liste des clients
	 *
	 * @return Layout
	 **/
	public function list()
	{
		$data["clients"] = $this->Client->all()->result_array();
		return $this->layout->view('main', 'clients/liste', $data);
	}

	/**
	 * Affiche le dossier d'un client - ses informations ainsi que les
	 * emprunts effectués
	 *
	 * @param Int $id - ID du client
	 * @return layout
	 **/
	public function view($id)
	{  
		$data['client'] = $this->Client->find($id)->row_array();
		return $this->layout->view('main', 'comptes/single', $data);
	}

	/**
	 * Affiche le formulaire d'ajout des clients
	 *
	 * @return Void
	 */
	public function add()
	{
		return $this->layout->view('main', 'clients/nouveau');
	}

	/**
	 * Enregistre les informations du nouveau client
	 *
	 * @return void
	 */
	public function store()
	{
		$post_data = $this->input->post();
		$this->form_validation->set_rules($this->my_config);
		
		if ($this->form_validation->run() == TRUE) {

			$clients = $this->Client->exist(array('cin' => $post_data['cin']));

			if($clients->num_rows() == 0){

				$this->Client->insert(elements(array('nom', 'prenom', 'sexe', 'dte_naissance', 'adresse', 'cin', 'profession', 'lieu_travail', 'contact', 'email'), $post_data));
				$client = $this->Client->last()->row_array();

				do {
					$number = $this->generate_number();
					$query  = $this->db->where("numero", $number)->get("compte_client");
					if($query->num_rows() == 0) {
						$bool = FALSE;
					} else {
						$bool = TRUE;
					}
				} while ($bool === TRUE);

				$this->Compte->insert([
					'id_client'    => $client['id'],
					'mot_passe'    => $pass = $post_data["mot_passe"] != '' ? $post_data["mot_passe"] : null,
					'dte_creation' => date('%Y-%m-%d'),
					'numero'       => $number,
					'id_admin'     => $this->session->userdata('admin')['id']
				]);
				
				$this->session->set_tempdata("alert", [
					"badge"     => 'success',
					"title"     => '<i class="fas fa-check"></i> Succès',
					"message"   => "<b>Succès!</b> Le nouveau client <b>{$client['nom']} {$client['prenom']}</b> a été correctement inséré"        
				], 2);

				redirect('Clients/list');
				
			} else {
				$this->session->set_tempdata("alert", [
					"badge"     => "warning",
					"title"     => '<i class="fas fa-ban"></i> Attention',
					"message"   => "<b>Attention!</b> Ce client existe déjà"        
				], 2);

				$this->add();
			}
		} else {
			$this->session->set_tempdata("alert", [
				"badge"     => "warning",
				"title"     => '<i class="fas fa-ban"></i> Attention',
				"message"   => '<b>Attention!</b> Veuiller contrôler vos entrées <br> <ul type="square">'. validation_errors('<li>', '</li>') .'</ul>'        
			], 2);

			$this->add();
		}
		
	}

	/**
	 * Affiche le formulaire de mise à jour des clients
	 *
	 * @param Int $id - ID du client
	 * @return Layout
	 **/
	public function edit($id)
	{
		$data['client'] = $this->Client->find($id)->row_array();
		return $this->layout->view('main', 'clients/maj', $data);
	}

	/**
	 * Mets à jour les informations du client 
	 *
	 * @return Layout
	 **/
	public function update()
	{
		$post_data = $this->input->post();
		$this->form_validation->set_rules($this->my_config);
		
		if ($this->form_validation->run() == TRUE) {
			
			$this->Client->update($post_data);

			$this->session->set_tempdata("alert", [
				"badge"     => 'success',
				"title"     => '<i class="fas fa-check"></i> Succès',
				"message"   => "<b>Succès!</b> La mise à jour a été correctement effectuée"        
			], 2);

			redirect('Clients/list');

		} else {
			$this->edit($post_data["id"]);
		}
		
	}
}

/* End of file Clients.php */
