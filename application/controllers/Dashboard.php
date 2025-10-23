<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct()
	{
		parent::__construct();
        if ($this->session->username == "") {
            redirect('login');
        }


		$this->load->model('Dashboard_mod', 'dashboard');
		$this->load->model('Admin_mod', 'admin');
        
	}
	public function index(){


		$programmers_count = $this->dashboard->programmers();
		$analysts_count = $this->dashboard->analysts();
		$others_count = $this->dashboard->rms();   

		$my_workloads = $this->dashboard->my_workloads(); 

		$data['programmers_count'] = $programmers_count;
		$data['analysts_count'] = $analysts_count;
		$data['others_count'] = $others_count;
		$data['my_workloads'] = $my_workloads;


		$team_members = $this->dashboard->get_emp_data();
		$emp_data_list = $this->dashboard->team_members();
		
		$data['team_members'] = [];
		
		foreach ($emp_data_list as $key => $value) {
			$emp_id = $value['emp_id'];
			$emp_data = $team_members[$emp_id];
			$data['team_members'][] = [
				'emp_id'     => $emp_id,
				'firstname'  => ucwords(strtolower($emp_data['firstname'])),
				'lastname'   => ucwords(strtolower($emp_data['lastname'])),
				'suffix'     => $emp_data['suffix'],
				'photo' => !empty($emp_data['photo']) 
					? 'http://172.16.161.34:8080/hrms/' . preg_replace('!^\.\./!', '', $emp_data['photo']) 
					: base_url('assets/images/default-user.jpg'),

				'position'   => $emp_data['position'],
				'status'     => $value['status'],
				'team_name'  => $value['team_name'],
				'contact_no' => $value['contact_no']
			];
		}


		$this->load->view('_layouts/header');
		$this->load->view('dashboard', $data);
		$this->load->view('_layouts/footer');
	}

	public function get_birthdays() {
		$month = $this->input->get('month');
	
		// $positions = [
		// 	'System Programmer I', 
		// 	'System Programmer II', 
		// 	'System Programmer III',
		// 	'System Analyst I', 
		// 	'System Analyst II', 
		// 	'System Analyst III',
		// 	'Tech Support Technician I', 
		// 	'Tech Support Technician II', 
		// 	'Tech Support Technician III',
		// 	'Office Clerk I',
		// 	'Section Head',
		// 	'Jr. Supervisor'
		// ];
	
		$birthday_list = $this->dashboard->get_birthday_list($month);
	
		if ($birthday_list) {
			echo json_encode(['status' => 'success', 'data' => $birthday_list]);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'No data found']);
		}
	}


	public function profile(){
		$this->load->view('_layouts/header');
		$this->load->view('profile');
		$this->load->view('_layouts/footer');
	}

	public function update_password(){
		$id 		= $this->input->post('id');
		$username 	= $this->input->post('username');
		$password 	= md5($this->input->post('password'));
		$data = array(
			'password' => $password,
			'username' => $username
		);
		$this->dashboard->update_password($id, $data);
		$this->session->set_userdata('username', $username);
		$this->session->set_userdata('password', $password);
	}


	public function getChartData() {
		$type = $this->input->post('type');
		$typeofsystem = $this->input->post('typeofsystem');
	
		$types = $type === 'new' 
			? ['ISR', 'ATTENDANCE', 'MINUTES', 'WALKTHROUGH', 'FLOWCHART', 'DFD', 'SYSTEM_PROPOSED','GANTT_CHART', 'LOCAL_TESTING', 'UAT', 'LIVE_TESTING', 'USER_GUIDE', 'MEMO', 'BUSINESS_ACCEPTANCE', 'REQUEST_LETTER', 'OTHERS']
			: ['ISR', 'ATTENDANCE', 'MINUTES', 'WALKTHROUGH', 'FLOWCHART', 'DFD', 'SYSTEM_PROPOSED', 'GANTT_CHART', 'LOCAL_TESTING', 'UAT', 'LIVE_TESTING', 'USER_GUIDE', 'MEMO', 'BUSINESS_ACCEPTANCE', 'REQUEST_LETTER', 'OTHERS'];
	
		$data = $this->dashboard->getFileCountsByType($types, $typeofsystem);
	
		usort($data, function($a, $b) use ($types) {
			return array_search($a['uploaded_to'], $types) - array_search($b['uploaded_to'], $types);
		});
	
		$chartData = [];
		$labels = [];
		$colors = [
			'rgba(255, 0, 0, 0.9)',
			'rgba(255, 102, 0, 0.9)',
			'rgba(255, 255, 0, 0.9)',
			'rgba(0, 204, 0, 0.9)',
			'rgba(0, 204, 255, 0.9)',
			'rgba(0, 51, 255, 0.9)',
			'rgba(153, 51, 255, 0.9)',
			'rgba(255, 0, 255, 0.9)',
			'rgba(255, 51, 153, 0.9)',
			'rgba(255, 153, 204, 0.9)',
			'rgba(102, 255, 0, 0.9)',
			'rgba(255, 204, 0, 0.9)',
			'rgba(0, 153, 255, 0.9)',
			'rgba(102, 0, 204, 0.9)'
		];
	
		foreach ($data as $item) {
			$chartData[] = $item['count'];
			$labels[] = $item['uploaded_to'];
		}
	
		echo json_encode([
			'chartData' => $chartData,
			'labels' => $labels,
			'colors' => $colors
		]);
	}
	

	public function list_company_phone_dashboard(){
		$start          = $this->input->post('start');
        $length         = $this->input->post('length');
        $order          = $this->input->post('order');
        $search_value   = $this->input->post('search')['value'];
        $order_column   = $order[0]['column'];
        $order_dir      = $order[0]['dir'];

        $logs = $this->admin->getCompanyPhone($start, $length, $order_column, $order_dir, $search_value);
        $data = [];
    
        foreach ($logs as $row) {

            $data[] = [
                'team'        => $row['team'],
                'ip_phone'    => $row['ip_phone']
            ];
        }
        $total_records = $this->admin->totalCompanyPhone($search_value);

        $output = [
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => $total_records,
            "recordsFiltered" => $total_records,
            "data" => $data
        ];
        echo json_encode($output);
	}
}
