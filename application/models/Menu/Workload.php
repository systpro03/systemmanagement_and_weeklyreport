<?php 
class Workload extends CI_Model
{
	function __construct() {
		parent::__construct();
        $this->db2 = $this->load->database('pis', TRUE);
	}


    public function get_module_dat($team)
    {
        $this->db->select('m.module_id as mod_id, m.mod_name, sb.sub_mod_id, sb.sub_mod_name, m.typeofsystem');
        $this->db->from('module_msfl m');
        $this->db->join('workload', 'workload.module = m.module_id', 'left');
        $this->db->join('sub_module sb', 'm.module_id = sb.mod_id', 'left');
        $this->db->join('users', 'users.team_id = m.belong_to', 'left');
        $this->db->where('m.active', 'Active');
        $this->db->order_by('m.mod_name', 'ASC');
        // $this->db->where('m.mod_status', 'Approve');
        if (($this->session->userdata('is_admin') === 'No' || $this->session->userdata('is_admin') === null)  && $this->session->userdata('position') !== 'Manager') {
            $this->db->where('users.emp_id', $this->session->userdata('emp_id'));
        }
        if($team){
            $this->db->where('m.belong_to', $team);
        }
        $this->db->group_by('m.module_id');

        $modules = $this->db->get()->result();
    
        foreach ($modules as &$module) {
            $this->db->select('sb.sub_mod_id, sb.sub_mod_name');
            $this->db->from('sub_module sb');
            $this->db->where('sb.status !=', 'Inactive');

            $this->db->where('sb.mod_id', $module->mod_id);
            $module->submodules = $this->db->get()->result();
        }
        return $modules;
    }

    public function getWorkloads($date_range,$team, $module,$status, $start, $length, $order_column, $order_dir, $search_value) {
        $this->db->distinct();
        $this->db->select('w.*, sb.sub_mod_name, sb.sub_mod_id, t.team_name, msfl.mod_name, msfl.mod_abbr, w.id');
        $this->db->from('workload w');
        $this->db->join('module m', 'm.mod_id = w.module', 'LEFT');
        $this->db->join('module_msfl msfl', 'msfl.module_id = w.module', 'LEFT');
        $this->db->join('sub_module sb', 'w.sub_mod = sb.sub_mod_id AND w.module = sb.mod_id', 'LEFT');
        $this->db->join('team t', 't.team_id = w.team_id');
        $this->db->join('users', 'users.team_id = msfl.belong_to', 'left');
        $this->db->where('users.is_active', 'Active');
        $this->db->where('msfl.active ', 'Active');
        if (($this->session->userdata('is_admin') === 'No' || $this->session->userdata('is_admin') === null)  && $this->session->userdata('position') !== 'Manager') {
            $this->db->where('users.emp_id', $this->session->userdata('emp_id'));
        }
        $this->db->order_by('w.id', 'DESC');
        $this->db->group_by('w.id');

        if (!empty($search_value)) {
            $this->db->group_start();
            $this->db->like('t.team_name', $search_value);
            $this->db->or_like('w.user_type', $search_value);
            $this->db->or_like('w.module', $search_value);
            $this->db->or_like('sb.sub_mod_name', $search_value);
            $this->db->or_like('msfl.mod_abbr', $search_value);
            $emp_ids = $this->get_emp_ids_by_name_search($search_value);
			if (!empty($emp_ids)) {
				$this->db->or_where_in('w.emp_id', $emp_ids);
			}
            $this->db->group_end();

        }
        if (!empty($status)) {
            $this->db->where('w.status', $status);
        }
        if (!empty($team)) {
            $this->db->where('t.team_id', $team);
        }
        if (!empty($module)) {
            $this->db->where('w.module', $module);
        }

        if (!empty($date_range)) {
			$date_range = str_replace('+', ' ', $date_range); 
			$dates = explode(' to ', $date_range);
		
			if (count($dates) === 2) {
				$start_date = date('Y-m-d', strtotime($dates[0]));
				$end_date = date('Y-m-d', strtotime($dates[1]));
				$this->db->where("DATE(w.date_added) >=", $start_date);
				$this->db->where("DATE(w.date_added) <=", $end_date);
			}
		}

        $this->db->order_by($order_column, $order_dir);
        $this->db->limit($length, $start);

        return $this->db->get()->result_array();
    }

    public function getTotalWorkloads($date_range, $team, $module, $status, $search_value) {
        $this->db->distinct();
        $this->db->select('w.*, sb.sub_mod_name, sb.sub_mod_id, t.team_name, msfl.mod_name, msfl.mod_abbr');
        $this->db->from('workload w');
        $this->db->join('module m', 'm.mod_id = w.module', 'LEFT');
        $this->db->join('module_msfl msfl', 'msfl.module_id = w.module', 'LEFT');
        $this->db->join('sub_module sb', 'w.sub_mod = sb.sub_mod_id AND w.module = sb.mod_id', 'LEFT');
        $this->db->join('team t', 't.team_id = w.team_id');
        $this->db->join('users', 'users.team_id = msfl.belong_to', 'left');
        $this->db->where('msfl.active ', 'Active');
        if (($this->session->userdata('is_admin') === 'No' || $this->session->userdata('is_admin') === null) 
            && $this->session->userdata('position') !== 'Manager') {
            $this->db->where('users.emp_id', $this->session->userdata('emp_id'));
        }
        $this->db->order_by('w.id', 'DESC');
        $this->db->group_by('w.id');
        if (!empty($search_value)) {
            $this->db->group_start();
            $this->db->like('t.team_name', $search_value);
            $this->db->or_like('w.user_type', $search_value);
            $this->db->or_like('w.module', $search_value);
            $this->db->or_like('sb.sub_mod_name', $search_value);
            $this->db->or_like('msfl.mod_abbr', $search_value);
            $emp_ids = $this->get_emp_ids_by_name_search($search_value);
			if (!empty($emp_ids)) {
				$this->db->or_where_in('w.emp_id', $emp_ids);
			}
            $this->db->group_end();
        }
        // $this->db->where('w.status', $status);
        if (!empty($status)) {
            $this->db->where('w.status', $status);
        }
        if (!empty($team)) {
            $this->db->where('t.team_id', $team);
        }
        if (!empty($module)) {
            $this->db->where('w.module', $module);
        }
        if (!empty($date_range)) {
			$date_range = str_replace('+', ' ', $date_range); 
			$dates = explode(' to ', $date_range);
		
			if (count($dates) === 2) {
				$start_date = date('Y-m-d', strtotime($dates[0]));
				$end_date = date('Y-m-d', strtotime($dates[1]));
				$this->db->where("DATE(w.date_added) >=", $start_date);
				$this->db->where("DATE(w.date_added) <=", $end_date);
			}
		}
        return $this->db->count_all_results();
    }
    public function get_emp_ids_by_name_search($search_value)
	{
		$this->db2->select('emp_id, name');
		$this->db2->from('employee3');
        $this->db2->where('current_status', 'Active');
        $this->db2->like('name', $search_value, 'both');
        $this->db2->limit(1000);
		$query = $this->db2->get();
		
		$emp_ids = [];
		foreach ($query->result_array() as $row) {
			$emp_ids[] = $row['emp_id'];
		}

		return $emp_ids;
	}


    public function get_members_by_team($team_id)
    {
        $this->db->select('t.team_name, u.emp_id, u.position');
        $this->db->from('team t');
        $this->db->join('users u', 't.team_id = u.team_id');
        $this->db->where('t.team_id', $team_id);
        $this->db->where('u.is_active', 'Active');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_members_by_team2($team_ids)
    {
        $this->db->select('t.team_name, u.emp_id, u.position');
        $this->db->from('team t');
        $this->db->join('users u', 't.team_id = u.team_id');
        $this->db->where_in('t.team_id', $team_ids);
        $this->db->where('u.is_active', 'Active');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_members($team_id)
    {
        $this->db->select('t.team_name, u.emp_id, u.position');
        $this->db->from('team t');
        $this->db->join('users u', 't.team_id = u.team_id');
        $this->db->where('t.team_id', $team_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_employees($emp_id) {
        $this->db2->select('*');
        $this->db2->from('employee3');
        $this->db2->where('emp_id', $emp_id);
        $query = $this->db2->get();
        return $query->result();
    }

    public function get_emp($emp_id) {
        $this->db2->select('*');
        $this->db2->from('employee3');
        $this->db2->where('current_status', 'Active');
        $this->db2->where('emp_id', $emp_id);
        $query = $this->db2->get();
        return $query->row_array();
    }

    public function get_module($team)
    {
        $this->db->select('m.module_id as mod_id, m.mod_name, sb.sub_mod_id, sb.sub_mod_name, m.typeofsystem');
        $this->db->from('module_msfl m');
        $this->db->join('sub_module sb', 'm.module_id = sb.mod_id', 'left');
        $this->db->group_by('m.module_id');
        $this->db->where('m.mod_status', 'Approve');
        $this->db->where('m.active !=', 'Inactive');
        $this->db->where('m.belong_to', $team);
        if (($this->session->userdata('is_admin') === 'No' || $this->session->userdata('is_admin') === null || $this->session->userdata('is_admin') === 'Yes')  && $this->session->userdata('position') !== 'Manager') {
            $this->db->where('m.belong_to', $this->session->userdata('team_id'));
        }
        $modules = $this->db->get()->result();
    
        foreach ($modules as &$module) {
            $this->db->select('sb.sub_mod_id, sb.sub_mod_name');
            $this->db->from('sub_module sb');
            $this->db->where('sb.mod_id', $module->mod_id);
            $this->db->where('sb.status !=', 'Inactive');
            $module->submodules = $this->db->get()->result();
        }
        return $modules;
    }

    public function get_workload_by_id($id) {
        $this->db->select('w.*, sb.*, t.*, w.status, msfl.module_id as mod_id, msfl.*');
        $this->db->from('workload w');
        // $this->db->join('module m', 'm.mod_id = w.module', 'LEFT');
        $this->db->join('module_msfl msfl', 'msfl.module_id = w.module', 'LEFT');
        $this->db->join('sub_module sb', 'w.sub_mod = sb.sub_mod_id AND w.module = sb.mod_id', 'LEFT');
        $this->db->join('team t', 't.team_id = w.team_id');
        $this->db->where('msfl.active !=', 'Inactive');
        $this->db->where('w.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
    

    public function get_log_data_workload($workload_id, $start, $length, $order_column, $order_dir, $search_value)
    {
        $this->db->select('*');
        $this->db->from('workload');
		$this->db->where('id', $workload_id);

        if (!empty($search_value)) {
            $this->db->like('status', $search_value);
            $this->db->or_like('date_updated', $search_value);
        }
        $this->db->order_by($order_column, $order_dir);
        $this->db->limit($length, $start);

        return $this->db->get()->result_array();
    }

}