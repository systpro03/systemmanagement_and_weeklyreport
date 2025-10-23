<?php 
class Login_mod extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->db2 = $this->load->database('pis', TRUE);
    }

    // Get employee details
    public function get_emp($emp_id) {
        $this->db2->select('employee3.name, applicant.photo, employee3.emp_id, employee3.current_status, employee3.position, employee3.*, applicant.*, c.*, b.*, d.*');
        $this->db2->from('employee3');
        $this->db2->join('applicant', 'applicant.app_id = employee3.emp_id');
        $this->db2->join('locate_company c', 'c.company_code = employee3.company_code');
        $this->db2->join('locate_business_unit b', 'b.bunit_code = employee3.bunit_code AND b.company_code = employee3.company_code');
        $this->db2->join('locate_department d', 'd.dept_code = employee3.dept_code AND d.company_code = employee3.company_code AND d.bunit_code = employee3.bunit_code');
        $this->db2->where('employee3.emp_id', $emp_id);
        $this->db2->limit(1);
        $query = $this->db2->get();

        return $query->row_array(); // Fetch a single employee
    }

    // Get user details
    public function get_db_user($emp_id) {
        $this->db->select('users.*, team.*');
        $this->db->from('users');
        $this->db->join('team', 'users.team_id = team.team_id', 'left');
        $this->db->where('emp_id', $emp_id);
        $this->db->where('type', 'Fulltime');
        $this->db->where('is_active', 'Active');
        // $this->db->limit(1);
        $query = $this->db->get();

        return $query->row_array();
    }

    // Validate login credentials
    public function login_data_result($username, $password, $override) {
        if($password === $override ){
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where('username', $username);
            $this->db->where('is_active', 'Active');
            $this->db->where('type', 'Fulltime');
            $this->db->limit(1);
            $query = $this->db->get();
            return $query->row_array();
        }else{
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where('username', $username);
            $this->db->where('password', $password);
            $this->db->where('is_active', 'Active');
            $this->db->where('type', 'Fulltime');
            $this->db->limit(1);
            $query = $this->db->get();
            return $query->row_array();
        }
    }
}
