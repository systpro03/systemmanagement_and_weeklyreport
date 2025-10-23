<?php
class Member_mod extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->db2 = $this->load->database('pis', TRUE);
	}

	// public function get_member_list($team, $module, $start, $length, $search_value, $order_column, $order_dir) {
	// 	$this->db->select('users.emp_id, users.contact_no, users.position, users.type, 
	// 					   team.team_name, 
	// 					   GROUP_CONCAT(DISTINCT msfl.mod_name SEPARATOR ", ") AS mod_name');
	// 	$this->db->from('users');
	// 	$this->db->join('team', 'users.team_id = team.team_id', 'left');
	// 	$this->db->join('module_msfl msfl', 'msfl.belong_to = team.team_id AND team.team_id = users.team_id', 'left');
	// 	$this->db->where('users.status', 'Active');
	// 	$this->db->where('team.team_id !=', '10');
	// 	$this->db->where('msfl.active !=', 'Inactive');

	// 	if (!empty($search_value)) {
	// 		$this->db->group_start()
	// 				 ->like('team.team_name', $search_value)
	// 				 ->or_like('msfl.mod_name', $search_value)
	// 				 ->or_like('users.position', $search_value)
	// 				 ->group_end();

	// 		$emp_ids = $this->get_emp_ids_by_name_search($search_value);
	// 		if (!empty($emp_ids)) {
	// 			$this->db->or_where_in('users.emp_id', $emp_ids);
	// 		}
	// 	}

	// 	if ($team) {
	// 		$this->db->where('team.team_id', $team);
	// 	}
	// 	if ($module) {
	// 		$this->db->where('msfl.module_id', $module);
	// 	}

	// 	$this->db->group_by('users.id'); 
	// 	$this->db->order_by($order_column, $order_dir);
	// 	$this->db->limit($length, $start);

	// 	$query = $this->db->get();
	// 	return $query->result_array();
	// }

	public function get_member_list($team = null, $module = null, $start = 0, $length = 10, $search_value = '')
	{
		$this->db->select(' msfl.mod_name,  t.team_name,  users.contact_no,  users.position,  users.type,  users.emp_id,  sb.sub_mod_name,  msfl.mod_abbr, w.sub_mod_menu');
		$this->db->from('workload w');
		$this->db->join('module_msfl msfl', 'msfl.module_id = w.module', 'inner');
		$this->db->join('team t', 'w.team_id = t.team_id', 'inner');
		$this->db->join('sub_module sb', 'sb.mod_id = w.module AND sb.sub_mod_id = w.sub_mod', 'left');
		$this->db->join('users', 'users.emp_id = w.emp_id AND users.team_id = w.team_id', 'inner');
		$this->db->where('users.is_active', 'Active');
		$this->db->where('msfl.active', 'Active');


		if (!empty($search_value)) {
			$this->db->group_start();
			$this->db->like('t.team_name', $search_value);
			$this->db->or_like('msfl.mod_name', $search_value);
			$this->db->or_like('msfl.mod_abbr', $search_value);
			$this->db->or_like('sb.sub_mod_name', $search_value);
			$this->db->or_like('users.position', $search_value);
			$this->db->or_like('w.sub_mod_menu', $search_value);
			$this->db->group_end();

			$emp_ids = $this->get_emp_ids_by_name_search($search_value);
			if (!empty($emp_ids)) {
				$this->db->or_where_in('users.emp_id', $emp_ids);
			}
		}

		if (!empty($team)) {
			$this->db->where('t.team_id', $team);
		}
		if (!empty($module)) {
			$this->db->where('msfl.module_id', $module);
		}

		$this->db->group_by([
			'w.module',
			'w.sub_mod',
			'w.sub_mod_menu',
			'users.id',
			't.team_id'
		]);

		// Order by team, module, sub-module, position
		$this->db->order_by('t.team_name', 'ASC');
		$this->db->order_by('msfl.mod_name', 'ASC');
		$this->db->order_by('sb.sub_mod_name', 'ASC');
		$this->db->order_by('users.position', 'ASC');

		// Apply limit and offset for pagination
		$this->db->limit($length, $start);

		$query = $this->db->get();

		return $query->result_array();
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

	public function get_member_count($team, $module, $search_value = null)
	{
		$this->db->select(' msfl.mod_name,  t.team_name,  users.contact_no,  users.position,  users.type,  users.emp_id,  sb.sub_mod_name,  msfl.mod_abbr, w.sub_mod_menu');
		$this->db->from('workload w');
		$this->db->join('module_msfl msfl', 'msfl.module_id = w.module', 'inner');
		$this->db->join('team t', 'w.team_id = t.team_id', 'inner');
		$this->db->join('sub_module sb', 'sb.mod_id = w.module AND sb.sub_mod_id = w.sub_mod', 'left');
		$this->db->join('users', 'users.emp_id = w.emp_id AND users.team_id = w.team_id', 'inner');
		$this->db->where('users.is_active', 'Active');
		$this->db->where('msfl.active', 'Active');

		if (!empty($search_value)) {
			$this->db->group_start();
			$this->db->like('t.team_name', $search_value);
			$this->db->or_like('msfl.mod_name', $search_value);
			$this->db->or_like('msfl.mod_abbr', $search_value);
			$this->db->or_like('sb.sub_mod_name', $search_value);
			$this->db->or_like('users.position', $search_value);
			$this->db->or_like('w.sub_mod_menu', $search_value);
			$this->db->group_end();

			$emp_ids = $this->get_emp_ids_by_name_search($search_value);
			if (!empty($emp_ids)) {
				$this->db->or_where_in('users.emp_id', $emp_ids);
			}
		}

		if (!empty($team)) {
			$this->db->where('t.team_id', $team);
		}
		if (!empty($module)) {
			$this->db->where('msfl.module_id', $module);
		}

		$this->db->group_by([
			'w.module',
			'w.sub_mod',
			'w.sub_mod_menu',
			'users.id',
			't.team_id'
		]);

		// Order by team, module, sub-module, position
		$this->db->order_by('t.team_name', 'ASC');
		$this->db->order_by('msfl.mod_name', 'ASC');
		$this->db->order_by('sb.sub_mod_name', 'ASC');
		$this->db->order_by('users.position', 'ASC');
		return $this->db->count_all_results();
	}
}