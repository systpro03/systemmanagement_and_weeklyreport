<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RulesRegulation extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->username == "") {
            redirect('login');
        }
        $this->load->model('Admin_mod', 'admin');
    }
    // public function index() {
    //     $data['files'] = $this->admin->rules_regulations_data();
    //     $this->load->view('_layouts/header');
    //     $this->load->view('menu/rules_regulations', $data);
    //     $this->load->view('_layouts/footer');
    // }
    public function index() {
        // $data['files'] = $this->admin->rules_regulations_data();
        $this->load->view('_layouts/header');
        $this->load->view('menu/rules_regulations');
        $this->load->view('_layouts/footer');
    }
}