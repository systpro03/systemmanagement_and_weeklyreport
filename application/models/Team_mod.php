<?php 
class Team_mod extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->db2 = $this->load->database('pis', TRUE);
    }

    public function get_users_for_bdays(){
        $this->db->select('emp_id');
        $this->db->from('users');
        $this->db->where('type', 'Fulltime');
        $this->db->where('is_active', 'Active');
        $query = $this->db->get();
        
        return $query->result_array();
    }
    public function get_emp_data() {
        $users = $this->get_users_for_bdays();
        $emp_ids = array_column($users, 'emp_id');
    
        $this->db2->select('e.emp_id, a.firstname, a.lastname, a.photo, a.suffix, e.position'); 
        $this->db2->from('employee3 e');
        $this->db2->join('applicant a', 'a.app_id = e.emp_id', 'inner');
    
        if (!empty($emp_ids)) {
            $this->db2->where_in('e.emp_id', $emp_ids);
        }
    
        $query = $this->db2->get();
        $result = $query->result_array();
    
        $employees = [];
        foreach ($result as $emp) {
            $employees[$emp['emp_id']] = $emp;
        }
    
        return $employees;
    }

    public function team_members()
    {
        $this->db->select('
            users.emp_id,
            team.team_id,
            users.status,
            team.team_name,
            COUNT(DISTINCT w.id) AS workload_count,
            COUNT(DISTINCT wr.id) AS weekly_report_count
        ');
        $this->db->from('users');
        $this->db->join('team', 'users.team_id = team.team_id');
        $this->db->join('workload w', 'users.emp_id = w.emp_id', 'left');
        $this->db->join('weekly_report wr', 'users.emp_id = wr.emp_id', 'left');
        $this->db->where('users.type', 'Fulltime');
        $this->db->where('users.is_active', 'Active');
        $this->db->where('users.team_id', $this->session->userdata('team_id'));
        $this->db->group_by('users.emp_id');

        $query = $this->db->get();
        return $query->result_array();
    }

}