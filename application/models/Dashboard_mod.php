<?php 
class Dashboard_mod extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->db2 = $this->load->database('pis', TRUE);
    }

    public function programmers() {
        $this->db->select('COUNT(*) as total');
        $this->db->from('users');
        $this->db->where('position', 'Programmer');
        $this->db->where('type', 'Fulltime');
        $this->db->where('is_active', 'Active');
        $query = $this->db->get();
    
        $result = $query->row_array();
        return $result['total'];
    }
    
    public function analysts() {
        $this->db->select('COUNT(*) as total');
        $this->db->from('users');
        $this->db->where('position', 'System Analyst');
        $this->db->where('type', 'Fulltime');
        $this->db->where('is_active', 'Active');
        $query = $this->db->get();
    
        $result = $query->row_array();
        return $result['total'];
    }
    
    public function rms() {
        $this->db->select('COUNT(*) as total');
        $this->db->from('users');
        $this->db->where('position', 'RMS');
        $this->db->where('type', 'Fulltime');
        $this->db->where('is_active', 'Active');
        $query = $this->db->get();
    
        $result = $query->row_array();
        return $result['total'];
    }

    public function my_workloads() {
        $this->db->select('COUNT(*) as total');
        $this->db->from('workload');
        $this->db->where('emp_id', $this->session->emp_id);
        $query = $this->db->get();
    
        $result = $query->row_array();
        return $result['total'];
    }
    

    // public function get_birthday_list($positions, $month) {
    //     $this->db2->select('a.birthdate, e.emp_id, a.firstname, a.lastname, a.photo, a.suffix');
    //     $this->db2->from('employee3 e');
    //     $this->db2->join('applicant a', 'a.app_id = e.emp_id', 'inner');
    //     $this->db2->where([
    //         'e.company_code' => '01',
    //         'e.bunit_code' => '01',
    //         'e.dept_code' => '13',
    //         'e.section_code' => '02',
    //         'e.current_status' => 'Active'
    //     ]);

    //     $this->db2->where_in('e.sub_section_code', ['01', '02']);
    //     $this->db2->where_in('e.position', $positions);
    //     $this->db2->where_not_in('e.emp_id', [
    //         '04316-2017', '05137-2022', '25077-2013', 
    //         '28541-2013', '00207-2023', '00203-2023', 
    //         '05011-2023', '04143-2023', '09662-2015', '23188-2013', '01075-2016', '01074-2016','14444-2013', '00344-2025'
    //     ]);
    //     $this->db2->where('MONTH(a.birthdate)', $month);
    //     $this->db2->order_by('DAY(a.birthdate)', 'asc');
        
    //     $query = $this->db2->get();
        
    //     return $query->result_array();
    // }

    public function get_birthday_list($month) {
        $users = $this->get_users_for_bdays();
        $emp_ids = array_column($users, 'emp_id');
        $this->db2->select('a.birthdate, e.emp_id, a.firstname, a.lastname, a.photo, a.suffix');
        $this->db2->from('employee3 e');
        $this->db2->join('applicant a', 'a.app_id = e.emp_id', 'inner');
    
        if (!empty($emp_ids)) {
            $this->db2->where_in('e.emp_id', $emp_ids);
        }
    
        // $this->db2->where_in('e.sub_section_code', ['', '01', '02']);
        // $this->db2->where_in('e.position', $positions);
        $this->db2->where('MONTH(a.birthdate)', $month);
        $this->db2->order_by('DAY(a.birthdate)', 'asc');
    
        $query = $this->db2->get();
    
        return $query->result_array();
    }
    
    public function get_users_for_bdays(){
        $this->db->select('emp_id');
        $this->db->from('users');
        $this->db->where('type', 'Fulltime');
        $this->db->where('is_active', 'Active');
        $query = $this->db->get();
        
        return $query->result_array();
    }
    
    

    public function update_password($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('users', $data);
    }

    public function getFileCountsByType($types, $typeofsystem) {
        $this->db->select('system_files.uploaded_to, COUNT(*) as count');
        $this->db->from('system_files');
        $this->db->join('module_msfl msfl', 'system_files.mod_id = msfl.module_id');
        $this->db->where_in('system_files.uploaded_to', $types);
        $this->db->where('system_files.typeofsystem', $typeofsystem);
        $this->db->where('msfl.active', 'Active');
        // $this->db->where('msfl.belong_to', $this->session->userdata('team_id'));
    
        $this->db->group_by('system_files.uploaded_to');
        $query = $this->db->get();
        return $query->result_array();
    }


    public function team_members(){
        $this->db->select('users.*, team.team_name');
        $this->db->from('users');
        $this->db->join('team', 'users.team_id = team.team_id');
        $this->db->where('users.type', 'Fulltime');
        $this->db->where('users.is_active', 'Active');
        $this->db->where('users.team_id', $this->session->userdata('team_id'));
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
    
    
    
}