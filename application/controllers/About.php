<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        if ($this->session->username == "") {
            redirect('login');
        }
    }

    public function index(){
        $this->load->view('_layouts/header');
		$this->load->view('aboutus');
		$this->load->view('_layouts/footer');
    }

}