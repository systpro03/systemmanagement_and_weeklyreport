<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Structure extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
        if ($this->session->username == "") {
            redirect('login');
        }
		$this->load->model('Menu/Structure_mod', 'structure');
		$this->load->model('Menu/Workload', 'workload');
	}


	public function index()
	{
		$programmers = $this->structure->programmers();
		$analysts    = $this->structure->analysts();
		$others      = $this->structure->rms();

		$mapWithEmpData = function ($item) {
			$emp_data = $this->structure->get_emp($item['emp_id']);

			$item['name']       = $emp_data && !empty($emp_data['name']) 
									? ucwords(strtolower($emp_data['name'])) 
									: 'N/A';

			$item['photo']      = $emp_data && !empty($emp_data['photo']) 
									? ltrim($emp_data['photo'], '.') 
									: 'default.png';

			$item['date_hired'] = $emp_data && !empty($emp_data['date_hired']) 
									? $emp_data['date_hired'] 
									: null;

			return $item;
		};

		$data['programmers'] = array_map($mapWithEmpData, $programmers);
		$data['analysts']    = array_map($mapWithEmpData, $analysts);
		$data['others']      = array_map($mapWithEmpData, $others);


		$sortByDate = function ($a, $b) {
			$a_date = !empty($a['date_hired']) ? strtotime($a['date_hired']) : 0;
			$b_date = !empty($b['date_hired']) ? strtotime($b['date_hired']) : 0;
			return $a_date - $b_date;
		};

		usort($data['programmers'], $sortByDate);
		usort($data['analysts'], $sortByDate);
		usort($data['others'], $sortByDate);


		$this->load->view('_layouts/header');
		$this->load->view('menu/structure', $data);
		$this->load->view('_layouts/footer');
	}
}
