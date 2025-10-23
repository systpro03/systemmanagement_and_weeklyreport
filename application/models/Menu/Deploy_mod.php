<?php 
class Deploy_mod extends CI_Model
{
	function __construct() {
		parent::__construct();
	}

    public function get_implementation_data( $team,$module,$typeofsystem, $start, $length, $order_column, $order_dir, $search_value) {
        $this->db->select('m.*, t.team_name, GROUP_CONCAT(DISTINCT s.uploaded_to SEPARATOR ", ") as uploaded_to, msfl.mod_name, msfl.mod_abbr');
        $this->db->from('module m');
        $this->db->join('module_msfl msfl', 'msfl.module_id = m.mod_id');
        // $this->db->join('system_files s', 's.mod_id = m.mod_id AND s.business_unit = CONCAT(m.requested_to_co, m.requested_to_bu)', 'left');
        $this->db->join('system_files s', 's.mod_id = m.mod_id', 'left');
        $this->db->join('team t', 's.team_id = t.team_id');
        $this->db->join('users', 'users.team_id = t.team_id', 'left');
        $this->db->where('m.active !=', 'Inactive');
        $this->db->where('users.is_active', 'Active');
        $this->db->where('m.typeofsystem', $typeofsystem);
        if (($this->session->userdata('is_admin') === 'No' || $this->session->userdata('is_admin') === null) 
            && $this->session->userdata('position') !== 'Manager') {
            $this->db->where('users.emp_id', $this->session->userdata('emp_id'));
        }
		// if ($this->session->userdata('is_admin') === 'Yes') {
        //     $this->db->where('users.emp_id', $this->session->userdata('emp_id'));
        // }
        // $this->db->group_by('m.id');
        $this->db->group_by(['m.mod_id', 'm.requested_to_co', 'm.requested_to_bu']);

        if (!empty($search_value)) {
            $this->db->group_start(); 
            $this->db->like('msfl.mod_name', $search_value);
            $this->db->or_like('t.team_name', $search_value);
            $this->db->or_like('m.date_request', $search_value);
            $this->db->or_like('m.bu_name', $search_value);
            $this->db->or_like('s.uploaded_to', $search_value);
            $this->db->group_end(); 
        }

        if ($team) {
			$this->db->where('t.team_id', $team);
		}
		if ($module) {
			$this->db->where('msfl.module_id', $module);
		}
    
        $this->db->order_by($order_column, $order_dir);
        $this->db->limit($length, $start);
        return $this->db->get()->result_array();
    }
    
    public function get_total_implementation_data($team,$module,$typeofsystem, $search_value) {
        $this->db->select('m.*, t.team_name, GROUP_CONCAT(DISTINCT s.uploaded_to SEPARATOR ", ") as uploaded_to, msfl.mod_name, , msfl.mod_abbr');
        $this->db->from('module m');
        $this->db->join('module_msfl msfl', 'msfl.module_id = m.mod_id');
        $this->db->join('system_files s', 's.mod_id = m.mod_id', 'left');
        // $this->db->join('system_files s', 's.mod_id = m.mod_id AND s.business_unit = CONCAT(m.requested_to_co, m.requested_to_bu)', 'left');

        $this->db->join('team t', 's.team_id = t.team_id');
        $this->db->join('users', 'users.team_id = t.team_id', 'left');
        $this->db->where('m.active !=', 'Inactive');
        $this->db->where('users.is_active', 'Active');
        $this->db->where('m.typeofsystem', $typeofsystem);
        if (($this->session->userdata('is_admin') === 'No' || $this->session->userdata('is_admin') === null) 
            && $this->session->userdata('position') !== 'Manager') {
            $this->db->where('users.emp_id', $this->session->userdata('emp_id'));
        }
		// if ($this->session->userdata('is_admin') === 'Yes') {
        //     $this->db->where('users.emp_id', $this->session->userdata('emp_id'));
        // }
        // $this->db->group_by('m.id');
        $this->db->group_by(['m.mod_id', 'm.requested_to_co', 'm.requested_to_bu']);

        if (!empty($search_value)) {
            $this->db->group_start(); 
            $this->db->like('msfl.mod_name', $search_value);
            $this->db->or_like('t.team_name', $search_value);
            $this->db->or_like('m.date_request', $search_value);
            $this->db->or_like('m.bu_name', $search_value);
            $this->db->or_like('s.uploaded_to', $search_value);
            $this->db->group_end(); 
        }
        if ($team) {
			$this->db->where('t.team_id', $team);
		}
		if ($module) {
			$this->db->where('msfl.module_id', $module);
		}

        return $this->db->count_all_results();
    }

    public function get_remaining_data($mod_id, $start, $length, $order_column, $order_dir, $search_value) {
        $this->db->select('s.team_id, s.sub_mod_id,s.typeofsystem, s.mod_id, GROUP_CONCAT(s.uploaded_to SEPARATOR ", ") as uploaded_to');
        $this->db->from('system_files s');
        $this->db->where('s.mod_id', $mod_id);
        $this->db->group_by('s.mod_id');
        
        if (!empty($search_value)) {
            $this->db->like('s.uploaded_to', $search_value);
        }

        $this->db->order_by($order_column, $order_dir);
        $this->db->limit($length, $start);
        return $this->db->get()->result_array();
    }
    public function get_module_name($mod_id) {
        $this->db->select('mod_name');
        $this->db->from('module_msfl');
        $this->db->where('active !=', 'Inactive');
        $this->db->where('module_id', $mod_id);
        return $this->db->get()->row();
    }
}
