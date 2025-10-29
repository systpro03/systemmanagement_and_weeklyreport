<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_ctrl extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('Login_mod','login');
        $this->load->model('Dashboard_mod', 'dashboard');
    } 

    public function index()
    {

        if ($this->session->username != "") {
            redirect('dashboard');
        }

        $month = date('m');
        $day = date('d');
        $today = date('Y-m-d');
        $view = 'auth/login';

        $year = date('Y');
        $horror_start = $year . '-10-15';
        $horror_end   = $year . '-11-03';

        if ($today >= $horror_start && $today <= $horror_end) {
            $view = 'auth/login_horror';
        } elseif ($month === '12') {
            $view = 'auth/login_christmas';
        } elseif ($month === '02') {
            $view = 'auth/login_horror';
        } else {
            $view = 'auth/login';
        }

        $this->load->view($view);
    }


    public function session_expire(){
        $this->session->sess_destroy();
        $this->load->view('auth/session_expired');
    }

    public function get_birthdays() {
		$month = $this->input->get('month');

		$birthday_list = $this->dashboard->get_birthday_list($month);
	
		if ($birthday_list) {
			echo json_encode(['status' => 'success', 'data' => $birthday_list]);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'No data found']);
		}
	}

    public function login_data() {

        $username = $this->security->xss_clean($this->input->post('username'));
        $password = $this->security->xss_clean($this->input->post('password'));

        $override = $this->security->xss_clean(md5('or'));

        $hashed_password = md5($password);
        $user = $this->login->login_data_result($username, $hashed_password, $override);
        if ($user) {
            $emp_id = $user['emp_id'];

            $employee = $this->login->get_emp($emp_id);

            if ($employee) {
                $user_details = $this->login->get_db_user($emp_id);

                if ($user_details) {
                    if ($employee['current_status'] === "Inactive") {
                        $this->session->set_flashdata('message', 'This account is deactivated');
                        $this->session->set_flashdata('message_type', 'error');
                        redirect('login');
                    }
                    $this->session->set_userdata([
                        'id'             => $user_details['id'],
                        'emp_id'         => $employee['emp_id'],
                        'username'       => $user_details['username'],
                        'name'           => $employee['name'],
                        'status'         => $user_details['status'],
                        'current_status' => $employee['current_status'],
                        'position'       => $user_details['position'],
                        'hrms_position'  => $employee['position'],
                        'firstname'      => $employee['firstname'],
                        'lastname'       => $employee['lastname'],
                        'emp_type'       => $employee['emp_type'],
                        'dept_name'      => $employee['dept_name'],
                        'company'        => $employee['company'],
                        'business'       => $employee['business_unit'],
                        'photo'          => ltrim($employee['photo'], '.'),
                        'is_admin'       => $user_details['is_admin'],
                        'is_supervisor'  => $user_details['is_supervisor'],
                        'is_rms'         => $user_details['is_rms'],
                        'team_name'      => $user_details['team_name'],
                        'team_id'        => $user_details['team_id']
                    ]);

                    $this->session->set_flashdata('SUCCESSMSG', 'Login successful');
                    $action = '<b>' . $employee['name']. ' | '.$employee['position'].'</b> has a logged IN</b>';

                    $data1 = array(
                        'emp_id' => $employee['emp_id'],
                        'action' => $action,
                        'date_added' => date('Y-m-d H:i:s'),
                    );
                    $this->load->model('Logs', 'logs');
                    $this->logs->addLogs($data1);

                    redirect('dashboard');
                }
            }
        } else {
            $this->session->set_flashdata('message', 'Invalid username or password');
            $this->session->set_flashdata('message_type', 'error');
        }

        redirect('login');
    }
    
    public function logout_data()
    {
        if (empty($this->session->id)) {
            redirect('login');
        } else {
            $action = '<b>' . $this->session->name . ' | ' . $this->session->hrms_position . '</b> has logged OUT</b>';

            $data1 = array(
                'emp_id'       => $this->session->emp_id,
                'action'       => $action,
                'date_updated' => date('Y-m-d H:i:s'),
            );
            $this->load->model('Logs', 'logs');
            $this->logs->addLogs($data1);

            $this->session->set_flashdata('message', 'You have successfully logged out');
            $this->session->set_flashdata('message_type', 'success');

            $this->session->sess_destroy();
            redirect('login');

            // $this->load->view('auth/login');
        }
    }

    
}

