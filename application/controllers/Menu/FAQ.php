<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FAQ extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->username == "") {
            redirect('login');
        }
        // $this->load->model('Menu/File_mod_current', 'file_mod');
    }
    public function index() {
        $this->load->view('_layouts/header');
        $this->load->view('menu/faq');
        $this->load->view('_layouts/footer');
    }
}