<?php 
class Structure_mod extends CI_Model
{
	function __construct() {
		parent::__construct();
        $this->db2 = $this->load->database('pis', TRUE);
	}

    public function get_employees_by_positions($positions) {
        $this->db2->select('
            e.name, 
            a.photo, 
            e.position
        ');
        $this->db2->from('employee3 e');
        $this->db2->join('applicant a', 'a.app_id = e.emp_id', 'inner');
        $this->db2->join('application_details ad', 'ad.app_id = a.app_id', 'inner');

        $this->db2->where([
            'e.company_code' => '01',
            'e.bunit_code' => '01',
            'e.dept_code' => '13',
            'e.section_code' => '02',
            'e.current_status' => 'active'
        ]);
        $this->db2->where_in('e.sub_section_code', ['', '01', '02']);
        $this->db2->where_in('e.position', $positions);
        $this->db2->where_in('e.current_status', 'Active');
        $this->db2->where_not_in('e.emp_id', [
            '04316-2017', '05137-2022', '25077-2013', 
            '28541-2013', '00207-2023', '00203-2023', 
            '05011-2023', '04143-2023', '09662-2015', '23188-2013', '01075-2016', '01074-2016'
        ]);

        $this->db2->order_by('ad.date_hired', 'ASC');
        $query = $this->db2->get();
        return $query->result_array();
    }
    public function programmers(){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('position','Programmer');
        $this->db->where('type', 'Fulltime');
        $this->db->where('is_active', 'Active');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function analysts(){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('position','System Analyst');
        $this->db->where('type', 'Fulltime');
        $this->db->where('is_active', 'Active');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function rms(){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('position','RMS');
        $this->db->where('type', 'Fulltime');
        $this->db->where('is_active', 'Active');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_emp($emp_id = null){
        $this->db2->select('
            e.name, 
            a.photo, 
            ad.date_hired
        ');
        $this->db2->from('employee3 e');
        $this->db2->join('applicant a', 'a.app_id = e.emp_id');
        $this->db2->join('application_details ad', 'ad.app_id = a.app_id');
        

        if ($emp_id) {
            $this->db2->where('e.emp_id', $emp_id);
        }
        $this->db2->where('e.current_status', 'Active');
        $this->db2->order_by('ad.date_hired', 'ASC');
        $query = $this->db2->get();
        return $emp_id ? $query->row_array() : $query->result_array();
    }
    
    
    
    
}
