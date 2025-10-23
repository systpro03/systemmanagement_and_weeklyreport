<?php 
class ServerAddress_mod extends CI_Model
{
    function __construct() {
        parent::__construct();
    }

    public function get_server_list($team, $module, $start, $length, $search_value, $order_column, $order_dir) {
		$this->db->select('s.*,t.team_name, msfl.mod_name, msfl.mod_abbr');
		$this->db->from('server s');
		$this->db->join('module_msfl msfl', 'msfl.module_id = s.module', 'left');
		$this->db->join('team t', 's.team = msfl.belong_to AND s.team = t.team_id', 'left');
		$this->db->where('msfl.active','Active');
		// $this->db->group_by(['s.module']);
		if (!empty($search_value)) {
			$this->db->group_start()
					 ->like('t.team_name', $search_value)
					 ->or_like('msfl.mod_name', $search_value)
					 ->or_like('s.details', $search_value)
					 ->or_like('msfl.mod_abbr', $search_value)
					 ->or_like('s.server', $search_value)
					 ->or_like('s.db_name', $search_value)
					 ->or_like('s.location', $search_value)
					 ->group_end();
		}
	
		if ($team) {
			$this->db->where('t.team_id', $team);
		}
		if ($module) {
			$this->db->where('msfl.module_id', $module);
		}
	
		$this->db->order_by('t.team_id', 'asc');
		$this->db->limit($length, $start);
	
		$query = $this->db->get();
		return $query->result_array();
	}

    public function get_server_count($team, $module, $search_value = null) {
		$this->db->select('s.*,t.team_name, msfl.mod_name, msfl.mod_abbr');
		$this->db->from('server s');
		$this->db->join('module_msfl msfl', 'msfl.module_id = s.module', 'left');
		$this->db->join('team t', 's.team = msfl.belong_to AND s.team = t.team_id', 'left');
		$this->db->where('msfl.active','Active');
		$this->db->group_by(['s.module']);
		if (!empty($search_value)) {
			$this->db->group_start()
					 ->like('t.team_name', $search_value)
					 ->or_like('msfl.mod_name', $search_value)
					 ->or_like('s.details', $search_value)
					 ->or_like('msfl.mod_abbr', $search_value)
					 ->or_like('s.server', $search_value)
					 ->or_like('s.db_name', $search_value)
					 ->or_like('s.location', $search_value)
					 ->group_end();
		}
	
		if ($team) {
			$this->db->where('t.team_id', $team);
		}
		if ($module) {
			$this->db->where('msfl.module_id', $module);
		}
        return $this->db->count_all_results();
    }

    public function edit_server($id){
		$this->db->select('*');
		$this->db->from('server');
        $this->db->where('server_id', $id);
        $query = $this->db->get();
        return $query->row_array();

	}
}