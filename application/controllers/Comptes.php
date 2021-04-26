<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Comptes extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Compte');
		$this->load->model('Client');
		$this->load->model('Operation');
		$this->load->model('Depot');
		$this->load->model('Retrait');
		$this->load->model('Emprunt');
		$this->load->model('Paiement');
	}

	/**
	 * Affiche la liste des comptes clients
	 *
	 * @return Layout
	 */
	public function list()
	{
		$data['comptes'] = $this->Compte->all()->result_array();
		return $this->layout->view('main', 'comptes/liste', $data);
	}

	/**
	 * Affiche les informations d'un compte clients
	 *
	 * @param Int $id - ID du client
	 * @return Layout
	 */
	public function view($id)
	{
		$data['compte']     = $this->Compte->find($id)->row_array();
		$data['client']     = $this->Client->find($id)->row_array();
		$data['operations'] = $this->Operation->find($id)->result_array();
		$data['depots']     = $this->Depot->find($id)->result_array();
		$data['retraits']   = $this->Retrait->find($id)->result_array();
		$data['emprunts']   = $this->Emprunt->find(['compte_client.id_client' => $id])->result_array();
		$data['paiements']  = $this->Paiement->find($id)->result_array();
		
		return $this->layout->view('main', 'comptes/single', $data);
	}

	public function update($id)
	{
		$this->form_validation->set_rules('mot_passe', 'Nouveau de passe', 'trim|required|min_length[6]|max_length[12]');
		
		if ($this->form_validation->run() == TRUE) {
			$this->Compte->update( $id, [
				'mot_passe' => $this->input->post('mot_passe')
			]);
	
			redirect("Comptes/view/{$id}");
		} else {
			$this->session->set_tempdata("alert", [
				"badge"     => "warning",
				"title"     => '<i class="fas fa-ban"></i> Attention',
				"message"   => '<b>Attention!</b> Veuiller contrôler vos entrées <br> <ul type="square">'. validation_errors('<li>', '</li>') .'</ul>'        
			], 2);
			
			$this->view($id);
		}
	}
}

/* End of file Comptes.php */
