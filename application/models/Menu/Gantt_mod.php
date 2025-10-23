<?php 
class Gantt_mod extends CI_Model
{
	function __construct() {
		parent::__construct();
	}
	public function getGanttData($date_range, $module_id, $team_id, $start, $length, $order_column, $order_dir, $search_value) {
		$this->db->select('
			g.id as gantt_id, 
			g.team_id as t_id, 
			g.date_implem,
			t.team_id as team_id_alias, 
			t.team_name,
			m.id as m_id, 
			m.mod_id, 
			msfl.mod_name,
			sm.sub_mod_name,       
			g.date_parallel,
			g.date_start,
			g.date_end,
			g.date_testing,
			g.emp_name,
			g.desc,
			g.date_req,
			g.date_added,
			msfl.mod_abbr
		');
		$this->db->from('gantt g');
		$this->db->join('team t', 'g.team_id = t.team_id', 'left');
		$this->db->join('module m', 'g.mod_id = m.mod_id', 'left');
		$this->db->join('module_msfl msfl', 'msfl.module_id = g.mod_id', 'left');
		$this->db->join('sub_module sm', 'm.mod_id = sm.mod_id and g.sub_mod_id = sm.sub_mod_id', 'left');
		$this->db->join('users', 'users.team_id = t.team_id');
		$this->db->join('workload', 'workload.module = msfl.module_id', 'left');
		$this->db->where('users.is_active', 'Active');
		$this->db->where('msfl.active', 'Active');
        if (($this->session->userdata('is_admin') === 'No' || $this->session->userdata('is_admin') === null) 
            && $this->session->userdata('position') !== 'Manager') {
            $this->db->where('users.emp_id', $this->session->userdata('emp_id'));
			// $this->db->where('workload.emp_id', $this->session->userdata('emp_id'));
			// $this->db->where('g.emp_id', $this->session->userdata('emp_id'));
        }
		// if ($this->session->userdata('is_admin') === 'Yes') {
        //     $this->db->where('users.emp_id', $this->session->userdata('emp_id'));
        // }
		$this->db->order_by('g.date_implem', 'desc');
		$this->db->group_by('g.id');
	
        // $this->db->where('sm.status', 'Active');
		if (!empty($search_value)) {
			$this->db->group_start()
					 ->like('t.team_name', $search_value)
					 ->or_like('g.emp_name', $search_value)
					 ->or_like('g.desc', $search_value)
					 ->or_like('g.date_req', $search_value)
					 ->or_like('msfl.mod_name', $search_value)
					 ->or_like('sm.sub_mod_name', $search_value)
					 ->group_end();
		}
		if (!empty($team_id)) {
			$this->db->where('g.team_id', $team_id);
		}
		if (!empty($module_id)) {
			$this->db->where('g.mod_id', $module_id);
		}
		if (!empty($date_range) && is_string($date_range)) {
			$dates = explode(' to ', $date_range);
		
			if (count($dates) === 2) {
				$start_date = date('Y-m-d', strtotime($dates[0]));
				$end_date = date('Y-m-d', strtotime($dates[1]));
			} else {
				$start_date = $end_date = date('Y-m-d', strtotime($dates[0]));
			}
		
			$this->db->where("DATE(g.date_added) >= ", $start_date);
			$this->db->where("DATE(g.date_added) <= ", $end_date);
		}
		
		
		$this->db->order_by($order_column, $order_dir);
		$this->db->limit($length, $start);
		return $this->db->get()->result_array();
	}
	
	public function getTotalGantt($date_range, $module_id, $team_id, $search_value) {
		$this->db->select('
			g.id as gantt_id, 
			g.team_id as t_id, 
			g.date_implem,
			t.team_id as team_id_alias, 
			t.team_name,
			m.id as m_id, 
			m.mod_id, 
			msfl.mod_name,
			sm.sub_mod_name,       
			g.date_parallel,
			g.date_start,
			g.date_end,
			g.date_testing,
			g.emp_name,
			g.desc,
			g.date_req,
			g.date_added,
			msfl.mod_abbr
		');
		$this->db->from('gantt g');
		$this->db->join('team t', 'g.team_id = t.team_id', 'left');
		$this->db->join('module m', 'g.mod_id = m.mod_id', 'left');
		$this->db->join('module_msfl msfl', 'msfl.module_id = g.mod_id', 'left');
		$this->db->join('sub_module sm', 'm.mod_id = sm.mod_id and g.sub_mod_id = sm.sub_mod_id', 'left');
		$this->db->join('users', 'users.team_id = t.team_id');
		$this->db->join('workload', 'workload.module = msfl.module_id', 'left');
		$this->db->where('users.is_active', 'Active');
		$this->db->where('msfl.active !=', 'Inactive');
        if (($this->session->userdata('is_admin') === 'No' || $this->session->userdata('is_admin') === null) 
            && $this->session->userdata('position') !== 'Manager') {
            $this->db->where('users.emp_id', $this->session->userdata('emp_id'));
			// $this->db->where('workload.emp_id', $this->session->userdata('emp_id'));
        }

		// if ($this->session->userdata('is_admin') === 'Yes') {
        //     $this->db->where('users.emp_id', $this->session->userdata('emp_id'));
        // }
		$this->db->order_by('g.date_implem', 'desc');
		$this->db->group_by('g.id');
	
        // $this->db->where('sm.status', 'Active');
		if (!empty($search_value)) {
			$this->db->group_start()
					 ->like('t.team_name', $search_value)
					 ->or_like('g.emp_name', $search_value)
					 ->or_like('g.desc', $search_value)
					 ->or_like('g.date_req', $search_value)
					 ->or_like('msfl.mod_name', $search_value)
					 ->or_like('sm.sub_mod_name', $search_value)
					 ->group_end();
		}
		if (!empty($team_id)) {
			$this->db->where('g.team_id', $team_id);
		}
		if (!empty($module_id)) {
			$this->db->where('g.mod_id', $module_id);
		}
		if (!empty($date_range) && is_string($date_range)) { // ✅ Ensure it's a string
			$dates = explode(' to ', $date_range);
		
			if (count($dates) === 2) {
				$start_date = date('Y-m-d', strtotime($dates[0]));
				$end_date = date('Y-m-d', strtotime($dates[1]));
			} else {
				$start_date = $end_date = date('Y-m-d', strtotime($dates[0])); // Single date
			}
		
			$this->db->where("DATE(g.date_added) >= ", $start_date);
			$this->db->where("DATE(g.date_added) <= ", $end_date);
		}
		
		
		
		return $this->db->count_all_results();
	}
	
	public function submit_gantt($data) {
		$this->db->insert('gantt', $data);
	}
	public function update_gantt($data, $id) {
		$this->db->where('id', $id);
		$this->db->update('gantt', $data);
	}
	public function delete_gantt($id) {
		$this->db->where('id', $id);
		$this->db->delete('gantt');
	}

	public function get_gant_data($id) {
		$this->db->select('g.*');
		$this->db->from('gantt g');
        $this->db->where('g.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

	public function get_module_dat($team)
    {
        $this->db->select('m.module_id as mod_id, m.mod_name, sb.sub_mod_id, sb.sub_mod_name, m.typeofsystem');
        $this->db->from('module_msfl m');
        $this->db->join('gantt', 'gantt.mod_id = m.module_id');
        $this->db->join('sub_module sb', 'm.module_id = sb.mod_id', 'left');
        $this->db->join('users', 'users.team_id = m.belong_to', 'left');
        $this->db->where('m.active', 'Active');
		$this->db->where('users.is_active', 'Active');
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


	public function getGanttData2($emp_id, $module_id, $team_id) {
		$this->db->select('
			g.id as gantt_id, 
			g.team_id as t_id, 
			g.date_implem,
			t.team_id as team_id_alias, 
			t.team_name,
			m.id as m_id, 
			m.mod_id, 
			msfl.mod_name,
			sm.sub_mod_name,       
			g.date_parallel,
			g.date_start,
			g.date_end,
			g.date_testing,
			g.emp_name,
			g.desc,
			g.date_req,
			g.date_added,
			msfl.mod_abbr
		');
		$this->db->from('gantt g');
		$this->db->join('team t', 'g.team_id = t.team_id', 'left');
		$this->db->join('module m', 'g.mod_id = m.mod_id', 'left');
		$this->db->join('module_msfl msfl', 'msfl.module_id = g.mod_id', 'left');
		$this->db->join('sub_module sm', 'm.mod_id = sm.mod_id and g.sub_mod_id = sm.sub_mod_id', 'left');
		$this->db->join('users', 'users.team_id = t.team_id', 'left');
		$this->db->join('workload', 'workload.module = msfl.module_id', 'left');
		$this->db->where('users.is_active', 'Active');
		$this->db->where('msfl.active', 'Active');
        if (($this->session->userdata('is_admin') === 'No' || $this->session->userdata('is_admin') === null) 
            && $this->session->userdata('position') !== 'Manager') {
            $this->db->where('users.emp_id', $this->session->userdata('emp_id'));
			$this->db->where('workload.emp_id', $this->session->userdata('emp_id'));
        }

		$this->db->order_by('g.date_implem', 'asc');
		$this->db->group_by('g.id');
	
    
		if (!empty($team_id)) {
			$this->db->where('g.team_id', $team_id);
		}
		if (!empty($module_id)) {
			$this->db->where_in('g.mod_id', $module_id);
		}
		if (!empty($emp_id)) {
			$this->db->where_in('g.emp_id', $emp_id);
		}
		
		return $this->db->get()->result_array();
	}
}