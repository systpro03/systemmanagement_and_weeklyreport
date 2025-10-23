<?php 
class Weekly_mod extends CI_Model
{
	function __construct() {
		parent::__construct();
		$this->db2 = $this->load->database('pis', TRUE);
	}
	public function getweekly($status, $date_range, $team, $module, $sub_module, $start, $length, $order_column, $order_dir, $search_value) {
		$this->db->select('wr.*, m.mod_name, sb.sub_mod_name, t.team_name, m.mod_abbr');
		$this->db->from('weekly_report wr');
		$this->db->join('team t', 't.team_id = wr.team_id');
		$this->db->join('module_msfl m', 'm.module_id = wr.mod_id');
		$this->db->join('sub_module sb', 'wr.sub_mod_id = sb.sub_mod_id', 'left');
		$this->db->join('users', 'users.team_id = m.belong_to AND users.is_active = "Active" AND users.status = "Active"');
		$this->db->where('m.active !=', 'Inactive');
		$this->db->order_by('wr.id', 'DESC');

		// if ($this->session->userdata('is_admin') === 'No' || $this->session->userdata('is_admin') === null) {
        //     $this->db->where('m.belong_to', $this->session->userdata('team_id'));
        // }

		if (($this->session->userdata('is_admin') === 'No' || $this->session->userdata('is_admin') === null)  && $this->session->userdata('position') !== 'Manager') {
            $this->db->where('users.emp_id', $this->session->userdata('emp_id'));
        }

		$this->db->group_by('wr.id');
        // $this->db->where('sb.status !=', 'Inactive');
		if (!empty($search_value)) {
			$this->db->group_start();
				$this->db->group_start();
					$this->db->like('t.team_name', $search_value);
					$this->db->or_like('m.mod_name', $search_value);
					$this->db->or_like('sb.sub_mod_name', $search_value);
					$this->db->or_like('wr.task_workload', $search_value);
					$this->db->or_like('wr.remarks', $search_value);
				$this->db->group_end();
				$emp_ids = $this->get_emp_ids_by_name_search($search_value); 
				if (!empty($emp_ids)) {
					$this->db->or_where_in('wr.emp_id', $emp_ids);
				}
			$this->db->group_end();
		}

	
		if (!empty($date_range)) {
			$dates = explode(' to ', $date_range);
			
			if (count($dates) === 2) {
				$start_date = date('Y-m-d', strtotime($dates[0]));
				$end_date = date('Y-m-d', strtotime($dates[1]));
			} else {
				$start_date = $end_date = date('Y-m-d', strtotime($dates[0])); // Single date
			}
		
			$this->db->where("DATE_FORMAT(STR_TO_DATE(SUBSTRING_INDEX(wr.date_range, ' to ', 1), '%M %d, %Y'), '%Y-%m-%d') <= ", $end_date);
			$this->db->where("DATE_FORMAT(STR_TO_DATE(SUBSTRING_INDEX(wr.date_range, ' to ', -1), '%M %d, %Y'), '%Y-%m-%d') >= ", $start_date);
		}
		
		if (!empty($team)) {
			$this->db->where('wr.team_id', $team);
		} 
		if (!empty($module)) {
			$this->db->where('wr.mod_id', $module);
		}
		if (!empty($sub_module)) {
			$this->db->where('wr.sub_mod_id', $sub_module);
		}

		if (!empty($status)) {
            $this->db->where('wr.weekly_status', $status);
        }
		$this->db->order_by($order_column, $order_dir); 
		$this->db->limit($length, $start);
		return $this->db->get()->result_array();
	}
    public function get_emp_ids_by_name_search($search_value)
	{
		$this->db2->select('emp_id');
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

	
	public function getTotalweekly($status, $date_range, $team, $module, $sub_module, $search_value) {
		$this->db->select('wr.*, m.mod_name, sb.sub_mod_name, t.team_name, m.mod_abbr');
		$this->db->from('weekly_report wr');
		$this->db->join('team t', 't.team_id = wr.team_id');
		$this->db->join('module_msfl m', 'm.module_id = wr.mod_id');
		$this->db->join('sub_module sb', 'wr.sub_mod_id = sb.sub_mod_id', 'left');
        $this->db->join('users', 'users.team_id = m.belong_to AND users.is_active = "Active" AND users.status = "Active"');
		$this->db->where('m.active !=', 'Inactive');
		$this->db->order_by('wr.id', 'DESC');
		// if ($this->session->userdata('is_admin') === 'No' || $this->session->userdata('is_admin') === null) {
        //     $this->db->where('m.belong_to', $this->session->userdata('team_id'));
        // }

		if (($this->session->userdata('is_admin') === 'No' || $this->session->userdata('is_admin') === null)  && $this->session->userdata('position') !== 'Manager') {
            $this->db->where('users.emp_id', $this->session->userdata('emp_id'));
        }
        // $this->db->where('sb.status !=', 'Inactive');
		if (!empty($search_value)) {
			$this->db->group_start();
				$this->db->group_start();
					$this->db->like('t.team_name', $search_value);
					$this->db->or_like('m.mod_name', $search_value);
					$this->db->or_like('sb.sub_mod_name', $search_value);
					$this->db->or_like('wr.task_workload', $search_value);
					$this->db->or_like('wr.remarks', $search_value);
				$this->db->group_end();
				$emp_ids = $this->get_emp_ids_by_name_search($search_value); 
				if (!empty($emp_ids)) {
					$this->db->or_where_in('wr.emp_id', $emp_ids);
				}
			$this->db->group_end();
		}
	
		if (!empty($date_range)) {
			$dates = explode(' to ', $date_range);
			
			if (count($dates) === 2) {
				$start_date = date('Y-m-d', strtotime($dates[0]));
				$end_date = date('Y-m-d', strtotime($dates[1]));
			} else {
				$start_date = $end_date = date('Y-m-d', strtotime($dates[0])); // Single date
			}
		
			$this->db->where("DATE_FORMAT(STR_TO_DATE(SUBSTRING_INDEX(wr.date_range, ' to ', 1), '%M %d, %Y'), '%Y-%m-%d') <= ", $end_date);
			$this->db->where("DATE_FORMAT(STR_TO_DATE(SUBSTRING_INDEX(wr.date_range, ' to ', -1), '%M %d, %Y'), '%Y-%m-%d') >= ", $start_date);
		}
		
		if (!empty($team)) {
			$this->db->where('wr.team_id', $team);
		} 
		if (!empty($module)) {
			$this->db->where('wr.mod_id', $module);
		}
		if (!empty($sub_module)) {
			$this->db->where('wr.sub_mod_id', $sub_module);
		}

		if (!empty($status)) {
            $this->db->where('wr.weekly_status', $status);
        }
		$this->db->group_by('wr.id');
	
		return $this->db->count_all_results();
	}
	public function add_weekly($data) {
		$this->db->insert('weekly_report', $data);
	}
	public function edit_weekly_report_content($id){
		$this->db->select('*');
		$this->db->from('weekly_report');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();

	}
	public function update_weekly($data, $id) {
		$this->db->where('id', $id);
		$this->db->update('weekly_report', $data);
	}
	public function delete_weekly($id) {
		$this->db->where('id', $id);
		$this->db->delete('weekly_report');
	}
	public function get_module_dat($team)
    {
        $this->db->select('m.module_id as mod_id, m.mod_name, sb.sub_mod_id, sb.sub_mod_name, m.typeofsystem');
        $this->db->from('module_msfl m');
        $this->db->join('weekly_report', 'weekly_report.mod_id = m.module_id');
        $this->db->join('sub_module sb', 'm.module_id = sb.mod_id', 'left');
        $this->db->join('users', 'users.team_id = m.belong_to', 'left');
        $this->db->where('m.active', 'Active');
		$this->db->where('users.is_active', 'Active');
        $this->db->where('m.mod_status', 'Approve');
        if (($this->session->userdata('is_admin') === 'No' || $this->session->userdata('is_admin') === null)  && $this->session->userdata('position') !== 'Manager') {
            $this->db->where('users.emp_id', $this->session->userdata('emp_id'));
        }
        if($team){
            $this->db->where('m.belong_to', $team);
        }
        $this->db->order_by('m.mod_name', 'ASC');
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

    public function get_logs($id) {
        $this->db->select('*');
        $this->db->from('logs');
        $this->db->where('weekly_id', $id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

	public function get_log_data($weekly_id, $start, $length, $order_column, $order_dir, $search_value)
    {
        $this->db->select('*');
        $this->db->from('logs');
		$this->db->where('weekly_id', $weekly_id);

        if (!empty($search_value)) {
            $this->db->like('date_ongoing', $search_value);
            $this->db->or_like('date_done', $search_value);
        }
        $this->db->order_by($order_column, $order_dir);
        $this->db->limit($length, $start);

        return $this->db->get()->result_array();
    }

    	public function get_log_data_weekly($weekly_id, $start, $length, $order_column, $order_dir, $search_value)
    {
        $this->db->select('*');
        $this->db->from('weekly_report');
		$this->db->where('id', $weekly_id);

        if (!empty($search_value)) {
            $this->db->like('weekly_status', $search_value);
            $this->db->or_like('date_updated', $search_value);
        }
        $this->db->order_by($order_column, $order_dir);
        $this->db->limit($length, $start);

        return $this->db->get()->result_array();
    }
	
}