<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team extends CI_Controller {
	function __construct()
	{
		parent::__construct();
        if ($this->session->username == "") {
            redirect('login');
        }
		$this->load->model('Team_mod', 'team');
	}
    public function index(){
        $this->load->view('_layouts/header');
        $this->load->view('team');
        $this->load->view('_layouts/footer');
    }
    public function team_member()
    {
        $team_members   = $this->team->get_emp_data();
        $emp_data_list  = $this->team->team_members();

        $data['team_members'] = [];

        foreach ($emp_data_list as $key => $value) {
            $emp_id = $value['emp_id'];
            $emp_data = $team_members[$emp_id];

            $data['team_members'][] = [
                'emp_id'     => $emp_data['emp_id'],
                'firstname'  => ucwords(strtolower($emp_data['firstname'])),
                'lastname'   => ucwords(strtolower($emp_data['lastname'])),
                'suffix'     => $emp_data['suffix'],
                'photo'      => !empty($emp_data['photo']) 
                                    ? 'http://172.16.161.34:8080/hrms/' . preg_replace('!^\.\./!', '', $emp_data['photo']) 
                                    : base_url('assets/images/default-user.jpg'),

                'position'   => $emp_data['position'],
                'status'     => $value['status'],
                'team_name'  => $value['team_name'],
                'team_id'    => $value['team_id'],

                // ✅ counts from model query
                'workload_count'       => $value['workload_count'],
                'weekly_report_count'  => $value['weekly_report_count'],
            ];
        }

        echo json_encode($data);
    }

}