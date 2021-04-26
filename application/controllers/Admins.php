<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admins extends CI_Controller {

    private $my_config = [
        "login" => [
            array(
                "field" => "pseudo",
                "label" => "Identifiant",
                "rules" => "trim|required"
            ),
            array(
                "field" => "mot_passe",
                "label" => "Mot de passe",
                "rules" => "trim|required|min_length[6]"
            )
        ],
        "store" => [
            array(
                "field" => "nom",
                "label" => "Nom",
                "rules" => "trim|required"
            ),
            array(
                "field" => "prenom",
                "label" => "Prenom",
                "rules" => "trim|required"
            ),
            array(
                "field" => "pseudo",
                "label" => "Identifiant",
                "rules" => "trim|required"
            ),
            array(
                "field" => "mot_passe",
                "label" => "Mot de passe",
                "rules" => "trim|required|min_length[6]"
            ),
            array(
                "field" => "mot_passe",
                "label" => "Confirmation mot de passe",
                "rules" => "trim|required|matches[mot_passe]"
            )
        ]
    ];

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin');
        $this->load->helper('date');
    }

    /**
     * Affiche la page d'accueil
     * 
     * @return Layout
     **/
    public function home()
    {
        $this->load->model('Operation');
        $data['operations'] = $this->Operation->all()->result_array();
        return $this->layout->view('main', 'admins/home', $data);
    }

    /**
     * Affiche la page d'authentification
     *
     * @return Layout
     */
    public function login()
    {
        return $this->load->view("admins/login");
    }

    /**
     * Vérifie les informations de l'administrateur et connecte à l'applicaton
     *
     * @return Void
     */
    public function auth()
    {
        $post_data = $this->input->post();
        $this->form_validation->set_rules($this->my_config["login"]);

        if ($this->form_validation->run() == TRUE) {

            $query = $this->db->where([
                "pseudo"    => $post_data["pseudo"],
                "mot_passe" => $post_data["mot_passe"]
            ])->get("admin");

            if ($query->num_rows() == 1) {

                $admin = $query->row_array();
    
                $this->session->set_userdata('admin', $admin );
                $this->session->set_userdata('status', 'connecte');

                $this->db->where('id', $admin["id"])->set([
                    "lst_connexion" => date('Y-m-d - h: i'),
                    "etat"          => 'connecte'
                ])->update("admin");      
                
                redirect('Admins/home');
                
            } else {

                $this->session->set_tempdata("alert", [
                    "badge"     => "warning",
                    "title"     => '<i class="fas fa-ban"></i> Echec de l\'operation',
                    "message"   => '<b>Attention!</b> Le informations fournis pour la connexion sont incorrects'       
                ], 2);

                $this->login();
            }
            
        } else {
            $this->session->set_tempdata("alert", [
				"badge"     => "warning",
				"title"     => '<i class="fas fa-ban"></i> Attention',
				"message"   => '<b>Attention!</b> Veuiller contrôler vos entrées <br> <ul type="square">'. validation_errors('<li>', '</li>') .'</ul>'        
            ], 2);
            
            $this->login();
        }
    }

    /**
     * Déconnecte l'administrateur
     *
     * @return Void
     */
    public function logout()
    {   
        $this->db->where('id', $this->session->userdata('admin')['id'])->set([
            "lst_deconnexion" => date('Y-m-d - h: i'),
            "etat"            => 'deconnecte'
        ])->update("admin"); 

        $this->session->unset_userdata(['admin', 'status']);
        redirect('Admins/login');
    }

    /**
     * Affiche la liste des administrateurs de l'application
     *
     * @return Layout
     */
    public function list()
    {
        $data['admins'] = $this->Admin->all()->result_array();
        return $this->layout->view('main', 'admins/liste', $data);
    }

    /**
     * Affiche le formulaire d'ajout d'un nouvel administrateur
     *
     * @return Layout
     */
    public function add()
    {
        return $this->layout->view('main', 'admins/nouveau');
    }

    /**
     * Effectue l'enregistrement d'un nouvel administrateur
     *
     * @return Void
     */
    public function store()
    {
        $post_data = $this->input->post();
        $this->form_validation->set_rules($this->my_config["store"]);
        
        if ($this->form_validation->run() == TRUE) {

            unset($post_data['conf_mot_passe']);
            $post_data["dte_ajout"] = date("Y-m-d");
            
            $this->Admin->insert($post_data);
            redirect("Admins/list");

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
     * Affiche le formulaire d'edition
     *
     * @return Layout
     */
    public function edit()
    {
        $id = $this->session->userdata('admin')['id'];
        $data['admin'] = $this->Admin->find($id)->row_array();
        return $this->layout->view('main', 'admins/maj', $data);
    }

    /**
     * Enregistre les informations mis à jour
     *
     * @param Int $id - ID de l'administrateur
     * @return Void
     */
    public function update($id)
    {
        $post_data = $this->input->post();
        unset($post_data['password_confirm']);

        $this->Admin->update($post_data);
        $this->view($id);
    }
}

/* End of file Admins.php */