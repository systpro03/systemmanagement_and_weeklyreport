<?php 
class Task_mod extends CI_Model
{
	function __construct() {
		parent::__construct();
        $this->db2 = $this->load->database('pis', TRUE);
	}
	public function gettasks($date_range,$module, $team, $start, $length, $order_column, $order_dir, $search_value) {
        $this->db->select('dt.*, m.*, sb.*, t.*, dt.task_status, dt.sub_mod_id, m.module_id as mod_id');
        $this->db->from('daily_task dt');
		$this->db->join('team t', 't.team_id = dt.team_id');
        $this->db->join('module_msfl m', 'm.module_id = dt.mod_id');
        $this->db->join('sub_module sb', 'dt.sub_mod_id = sb.sub_mod_id', 'left');
        $this->db->where('m.active !=', 'Inactive');
        // $this->db->where('sb.status !=', 'Inactive');
        if (!empty($search_value)) {
            $this->db->group_start();
            $this->db->like('dt.emp_id', $search_value);
            $this->db->or_like('m.mod_name', $search_value);
            $this->db->or_like('sb.sub_mod_name', $search_value);
            $emp_ids = $this->get_emp_ids_by_name_search($search_value); 
			if (!empty($emp_ids)) {
				$this->db->or_where_in('dt.emp_id', $emp_ids); 
			}
            $this->db->group_end();
        }

        $this->db->order_by($order_column, $order_dir);
        $this->db->limit($length, $start);
		if (!empty($team)) {
            $this->db->where('dt.team_id', $team);
        }
        if (!empty($module)) {
            $this->db->where('dt.mod_id', $module);
		}
        if (!empty($date_range)) {
			$date_range = str_replace('+', ' ', $date_range); 
			$dates = explode(' to ', $date_range);
		
			if (count($dates) === 2) {
				$start_date = date('Y-m-d', strtotime($dates[0]));
				$end_date = date('Y-m-d', strtotime($dates[1]));
				$this->db->where("DATE(dt.date_added) >=", $start_date);
				$this->db->where("DATE(dt.date_added) <=", $end_date);
			}
		}
        return $this->db->get()->result_array();
    }

    public function getTotaltasks($date_range, $module, $team, $search_value) {
        $this->db->select('dt.*, m.*, sb.*, t.*, dt.task_status, dt.sub_mod_id, m.module_id as mod_id');
        $this->db->from('daily_task dt');
		$this->db->join('team t', 't.team_id = dt.team_id');
        $this->db->join('module_msfl m', 'm.module_id = dt.mod_id');
        $this->db->join('sub_module sb', 'dt.sub_mod_id = sb.sub_mod_id', 'left');
        $this->db->where('m.active !=', 'Inactive');
        // $this->db->where('sb.status !=', 'Inactive');
        if (!empty($search_value)) {
            $this->db->group_start();
            $this->db->like('dt.emp_id', $search_value);
            $this->db->or_like('m.mod_name', $search_value);
            $this->db->or_like('sb.sub_mod_name', $search_value);
            $emp_ids = $this->get_emp_ids_by_name_search($search_value); 
			if (!empty($emp_ids)) {
				$this->db->or_where_in('dt.emp_id', $emp_ids); 
            }
            $this->db->group_end();
        }

		if (!empty($team)) {
            $this->db->where('dt.team_id', $team);
		}
        if (!empty($module)) {
            $this->db->where('dt.mod_id', $module);
		}
        if (!empty($date_range)) {
			$date_range = str_replace('+', ' ', $date_range); 
			$dates = explode(' to ', $date_range);
		
			if (count($dates) === 2) {
				$start_date = date('Y-m-d', strtotime($dates[0]));
				$end_date = date('Y-m-d', strtotime($dates[1]));
				$this->db->where("DATE(dt.date_added) >=", $start_date);
				$this->db->where("DATE(dt.date_added) <=", $end_date);
			}
		}
        return $this->db->count_all_results();
    }
    public function get_emp_ids_by_name_search($search_value)
	{
		$this->db2->select('emp_id, name');
		$this->db2->from('employee3');
        $this->db2->like('name', $search_value, 'both');
        $this->db2->limit(1000);
		$query = $this->db2->get();
		
		$emp_ids = [];
		foreach ($query->result_array() as $row) {
			$emp_ids[] = $row['emp_id'];
		}

		return $emp_ids;
	}
	public function add_task($data) {
		$this->db->insert('daily_task', $data);
	}

	public function get_task_data($id) {
		$this->db->select('*');
		$this->db->from('daily_task');
        $this->db->where('task_id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
	public function update_task($data, $id) {
		$this->db->where('task_id', $id);
		$this->db->update('daily_task', $data);
	}
	public function delete_task($id) {
		$this->db->where('task_id', $id);
		$this->db->delete('daily_task');
	}
}