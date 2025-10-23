<?php
class Admin_mod extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('pis', TRUE);
    }

    public function get_employees($search)
    {
        $this->db2->select('emp_id, name');
        $this->db2->where('current_status', 'Active');
        $this->db2->where('company_code', '01');
        $this->db2->where('bunit_code', '01');
        $this->db2->where('dept_code', '13');
        $this->db2->group_start();
        $this->db2->like('emp_id', $search);
        $this->db2->or_like('name', $search);
        $this->db2->group_end();
        $this->db2->limit(10);
        $query = $this->db2->get('employee3');
        return $query->result();
    }

    public function emp_mod($emp_id)
    {
        $this->db2->where('emp_id', $emp_id);
        $this->db2->where('current_status', 'Active');
        $data = $this->db2->get('employee3');
        return $data->row_array();
    }
    public function add_user($data)
    {
        $this->db->insert('users', $data);
        return $this->db->affected_rows();
    }

    public function get_user_list($filter_team, $start, $length, $search_value, $order_column, $order_dir)
    {
        $this->db->select('users.*, team.*');
        $this->db->from('users');
        $this->db->join('team', 'users.team_id = team.team_id');
        $this->db->where('users.is_active', 'Active');
        $this->db->where('users.status', 'Active');


        if (!empty($search_value)) {
            $this->db->group_start()
                ->group_start()
                    ->like('team.team_name', $search_value)
                    ->or_like('users.emp_id', $search_value)
                    ->or_like('users.ip_address', $search_value)
                    ->or_like('users.position', $search_value)
                ->group_end();

            $emp_ids = $this->get_emp_ids_by_name_search($search_value);
            if (!empty($emp_ids)) {
                $this->db->or_where_in('users.emp_id', $emp_ids);
            }

            $this->db->group_end();
        }


        $this->db->order_by($order_column, $order_dir);

        if ($length != -1) {
            $this->db->limit($length, $start);
        }

        if (!empty($filter_team)) {
            $this->db->where('team.team_id', $filter_team);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_emp_ids_by_name_search($search_value)
    {
        $this->db2->select('emp_id, name, position');
        $this->db2->from('employee3');
        // $this->db2->where('current_status', 'Active');
        $this->db2->like('name', $search_value, 'both');
        $this->db2->or_like('position', $search_value, 'both');
        $this->db2->limit(1000);
        $query = $this->db2->get();

        $emp_ids = [];
        foreach ($query->result_array() as $row) {
            $emp_ids[] = $row['emp_id'];
        }

        return $emp_ids;
    }

    public function get_user_count($filter_team, $search_value = null)
    {
        $this->db->select('users.*, team.*');
        $this->db->from('users');
        $this->db->join('team', 'users.team_id = team.team_id');
        $this->db->where('users.is_active', 'Active');
        $this->db->where('users.status', 'Active');
        if (!empty($search_value)) {
            $this->db->group_start()
                ->group_start()
                    ->like('team.team_name', $search_value)
                    ->or_like('users.emp_id', $search_value)
                    ->or_like('users.ip_address', $search_value)
                    ->or_like('users.position', $search_value)
                ->group_end();

            $emp_ids = $this->get_emp_ids_by_name_search($search_value);
            if (!empty($emp_ids)) {
                $this->db->or_where_in('users.emp_id', $emp_ids);
            }

            $this->db->group_end();
        }
        if (!empty($filter_team)) {
            $this->db->where('team.team_id', $filter_team);
        }
        return $this->db->count_all_results();
    }

    public function update_user_content($id)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function update_user($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('users', $data);
    }
    public function reset_password($id, $emp_id)
    {
        $this->db->where('id', $id);
        $this->db->set('password', md5($emp_id));
        $this->db->update('users');
    }
    public function get_file_count_by_directory($directory, $mod_id, $sub_mod_id, $team, $typeofsystem)
    {
        // Define the mapping of directories to their status fields
        $status_fields = [
            'ISR' => 'isr_status',
            'ATTENDANCE' => 'att_status',
            'MINUTES' => 'minute_status',
            'WALKTHROUGH' => 'wt_status',
            'FLOWCHART' => 'flowchart_status',
            'DFD' => 'dfd_status',
            'SYSTEM_PROPOSED' => 'proposed_status',
            'GANTT_CHART' => 'gantt_status',
            'LOCAL_TESTING' => 'local_status',
            'UAT' => 'uat_status',
            'LIVE_TESTING' => 'live_status',
            'USER_GUIDE' => 'guide_status',
            'MEMO' => 'memo_status',
            'BUSINESS_ACCEPTANCE' => 'acceptance_status',
        ];

        if (!array_key_exists($directory, $status_fields)) {
            return 0;
        }

        $status_field = $status_fields[$directory];

        $this->db->select('ss.*');
        $this->db->from('system_files ss');
        $this->db->join('module_msfl mfsl', 'mfsl.module_id = ss.mod_id', 'left');
        $this->db->where('mfsl.active', 'Active');

        if (!empty($typeofsystem)) {
            $this->db->where('ss.typeofsystem', $typeofsystem);
        }
        if (!empty($mod_id)) {
            $this->db->where('ss.mod_id', $mod_id);
        }
        if (!empty($sub_mod_id)) {
            $this->db->where('ss.sub_mod_id', $sub_mod_id);
        }
        if (!empty($team)) {
            $this->db->where('ss.team_id', $team);
        }
        $this->db->where('ss.uploaded_to', $directory);
        $this->db->where($status_field, 'pending');

        $query = $this->db->get();

        return $query->num_rows();

    }


    public function get_module($type, $team)
    {
        $this->db->select('m.module_id as mod_id, m.mod_name, sb.sub_mod_id, sb.sub_mod_name');
        $this->db->from('module_msfl m');
        $this->db->join('sub_module sb', 'm.module_id = sb.mod_id', 'left');
        $this->db->where('m.active', 'Active');

        if ($type) {
            $this->db->where('m.typeofsystem', $type);
        }

        if ($team) {
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

    public function get_module_dat($team)
    {
        $this->db->select('m.module_id as mod_id, m.mod_name, sb.sub_mod_id, sb.sub_mod_name, m.typeofsystem');
        $this->db->from('module_msfl m');
        // $this->db->join('module', 'module.mod_id = m.module_id');
        $this->db->join('sub_module sb', 'm.module_id = sb.mod_id', 'left');
        $this->db->join('users', 'users.team_id = m.belong_to', 'left');
        $this->db->where('m.active', 'Active');
        // $this->db->where('m.mod_status', 'Approve');
        $this->db->order_by('m.mod_name', 'ASC');

        if (($this->session->userdata('is_admin') === 'No' || $this->session->userdata('is_admin') === null) && $this->session->userdata('position') !== 'Manager') {
            $this->db->where('users.emp_id', $this->session->userdata('emp_id'));
        }
        if ($team) {
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

    public function get_module_dat5($team)
    {
        $this->db->select('m.module_id as mod_id, m.mod_name, sb.sub_mod_id, sb.sub_mod_name, m.typeofsystem');
        $this->db->from('module_msfl m');
        $this->db->join('sub_module sb', 'm.module_id = sb.mod_id', 'left');
        $this->db->join('users', 'users.team_id = m.belong_to', 'left');
        $this->db->where('m.active', 'Active');
        // $this->db->where('m.mod_status', 'Approve');

        $this->db->order_by('m.mod_name', 'ASC');
        if ($team) {
            $this->db->where_in('m.belong_to', $team);
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

    public function get_print_module()
    {
        $this->db->select('m.module_id as mod_id, m.mod_name, sb.sub_mod_id, sb.sub_mod_name, m.typeofsystem');
        $this->db->from('module_msfl m');
        $this->db->join('sub_module sb', 'm.module_id = sb.mod_id', 'left');
        $this->db->group_by('m.module_id');
        $this->db->where('m.active !=', 'Inactive');
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

    // public function get_t() {
    //     $this->db->select('*');
    //     $this->db->from('team');
    //     $query = $this->db->get();

    //     return $query->result();

    // }
    public function get_t()
    {
        $this->db->select('team.*');
        $this->db->from('team');
        $this->db->join('users', 'team.team_id = users.team_id', 'LEFT');
        if (($this->session->userdata('is_admin') === 'No' || $this->session->userdata('is_admin') === null) && $this->session->userdata('position') !== 'Manager') {
            $this->db->where('users.emp_id', $this->session->userdata('emp_id'));
        }
        if ($this->session->userdata('is_admin') === 'Yes') {
            $this->db->where('team.team_id !=', '10');
        } else {
            $this->db->where('team.team_id !=', '10');
        }
        $this->db->group_by('team.team_id');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_teams()
    {
        $this->db->select('team.*');
        $this->db->from('team');
        $this->db->join('users', 'team.team_id = users.team_id', 'left');
        if (($this->session->userdata('is_admin') === 'No' || $this->session->userdata('is_admin') === null) && $this->session->userdata('position') !== 'Manager') {
            $this->db->where('users.emp_id', $this->session->userdata('emp_id'));
        }

        if ($this->session->userdata('is_admin') === 'Yes') {
            $this->db->where('team.team_id !=', '10');
        } else {
            $this->db->where('users.team_id !=', '10');
        }

        $this->db->group_by('team.team_id');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_teams5()
    {
        $this->db->select('team.*');
        $this->db->from('team');
        $this->db->join('users', 'team.team_id = users.team_id', 'left');


        if ($this->session->userdata('is_admin') === 'Yes') {
            $this->db->where('team.team_id !=', '10');
        } else {
            $this->db->where('users.team_id !=', '10');
        }

        $this->db->group_by('team.team_id');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_teams_current()
    {
        $this->db->select('team.*');
        $this->db->from('team');
        $this->db->join('users', 'team.team_id = users.team_id', 'LEFT');

        if ($this->session->userdata('is_admin') === 'Yes') {
            $this->db->where('team.team_id !=', '10');
        } else {
            $this->db->where('team.team_id !=', '10');
        }

        $this->db->group_by('team.team_id');
        $query = $this->db->get();
        return $query->result();
    }


    public function getKPI($type, $start, $length, $order_column, $order_dir, $search_value)
    {
        $this->db->select('*');
        $this->db->from('kpi');

        if (!empty($search_value)) {
            $this->db->like('title', $search_value);
            $this->db->or_like('type', $search_value);
        }
        $this->db->where('type', $type);
        $this->db->where('status', 'Active');
        $this->db->order_by($order_column, $order_dir);
        $this->db->limit($length, $start);

        return $this->db->get()->result_array();
    }

    public function getTotalKPI($type, $search_value)
    {
        $this->db->select('*');
        $this->db->from('kpi');

        if (!empty($search_value)) {
            $this->db->like('title', $search_value);
            $this->db->or_like('type', $search_value);

        }
        $this->db->where('type', $type);
        $this->db->where('status', 'Active');
        return $this->db->count_all_results();
    }

    public function get_kpi_data($id)
    {
        $this->db->select('*');
        $this->db->from('kpi');
        $this->db->where('id', $id);
        $this->db->where('status', 'Active');
        return $this->db->get()->row_array();
    }

    public function insertKPI($data)
    {

        $this->db->insert('kpi', $data);
    }

    public function updateKPI($data, $id)
    {

        $this->db->where('id', $id);
        $this->db->update('kpi', $data);
    }

    public function deleteKPI($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('kpi');
    }


    public function admingetModuleMasterfile($team, $typeofsystem, $start, $length, $order_column, $order_dir, $search_value)
    {
        $this->db->select('m.*, t.team_name, sb.*, s.uploaded_to');
        $this->db->from('module_msfl m');
        $this->db->join('module mod', 'mod.mod_id = m.module_id', 'left');
        $this->db->join('system_files s', 's.mod_id = mod.mod_id', 'left');
        $this->db->join('sub_module sb', 'm.module_id = sb.mod_id AND mod.submodule_id = sb.sub_mod_id', 'left');
        $this->db->join('team t', 't.team_id = m.belong_to', 'left');
        $this->db->join('users', 'users.team_id = t.team_id', 'left');
        $this->db->where('m.active', 'Active');
        $this->db->order_by('m.module_id', 'desc');
        // $this->db->where('mod.active !=', 'Inactive');
        if (!empty($typeofsystem)) {
            $this->db->where('m.typeofsystem', $typeofsystem);
        }
        if (!empty($team)) {
            $this->db->where('m.belong_to', $team);
        }
        if (!empty($search_value)) {
            $this->db->group_start();
            $this->db->like('m.mod_name', $search_value);
            $this->db->or_like('m.mod_abbr', $search_value);
            $this->db->or_like('m.typeofsystem', $search_value);
            $this->db->group_end();

        }

        $this->db->group_by('m.module_id');
        $this->db->order_by($order_column, $order_dir);
        $this->db->limit($length, $start);

        return $this->db->get()->result_array();
    }

    public function admingetTotalModuleMasterfile($team, $typeofsystem, $search_value)
    {
        $this->db->select('m.*,t.team_name, sb.*');
        $this->db->from('module_msfl m');
        $this->db->join('module mod', 'mod.mod_id = m.module_id', 'left');
        $this->db->join('system_files s', 's.mod_id = mod.mod_id', 'left');
        $this->db->join('sub_module sb', 'm.module_id = sb.mod_id AND mod.submodule_id = sb.sub_mod_id', 'left');
        $this->db->join('team t', 't.team_id = m.belong_to', 'left');
        $this->db->join('users', 'users.team_id = t.team_id', 'left');
        $this->db->where('m.active', 'Active');
        // $this->db->where('mod.active !=', 'Inactive');
        if (!empty($typeofsystem)) {
            $this->db->where('m.typeofsystem', $typeofsystem);
        }
        if (!empty($team)) {
            $this->db->where('m.belong_to', $team);
        }
        if (!empty($search_value)) {
            $this->db->group_start();
            $this->db->like('m.mod_name', $search_value);
            $this->db->or_like('m.mod_abbr', $search_value);
            $this->db->or_like('m.typeofsystem', $search_value);
            $this->db->group_end();

        }
        $this->db->group_by('m.module_id');
        return $this->db->count_all_results();
    }

    public function show_uploaded_documents_table($mod_id, $start, $length, $order_column, $order_dir, $search_value)
    {
        $this->db->select('s.team_id, s.sub_mod_id,s.typeofsystem, s.mod_id, GROUP_CONCAT(s.uploaded_to SEPARATOR ", ") as uploaded_to, s.file_name');
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

    public function show_data_in_directory($mod_id, $directory, $sub_mod_id, $team_id, $mod_name, $typeofsystem, $start, $length, $order_column, $order_dir, $search_value)
    {
        // Directory to column mapping
        $status_columns = [
            'ISR' => 'isr_status',
            'ATTENDANCE' => 'att_status',
            'MINUTES' => 'minute_status',
            'WALKTHROUGH' => 'wt_status',
            'FLOWCHART' => 'flowchart_status',
            'DFD' => 'dfd_status',
            'SYSTEM_PROPOSED' => 'proposed_status',
            'GANTT_CHART' => 'gantt_status',
            'LOCAL_TESTING' => 'local_status',
            'UAT' => 'uat_status',
            'LIVE_TESTING' => 'live_status',
            'USER_GUIDE' => 'guide_status',
            'MEMO' => 'memo_status',
            'BUSINESS_ACCEPTANCE' => 'acceptance_status',
            'REQUEST_LETTER' => 'letter_status',
            'OTHERS' => 'others'
        ];
        $status_column = isset($status_columns[$directory]) ? $status_columns[$directory] : null;

        $this->db->select('s.team_id, s.sub_mod_id, s.typeofsystem, s.mod_id, s.file_name, s.original_file_name, s.uploaded_to');

        if ($status_column !== null) {
            $this->db->select("s.{$status_column} AS status");
        }

        $this->db->from('system_files s');

        $this->db->where('s.mod_id', $mod_id);
        $this->db->where('s.uploaded_to', $directory);

        if (!empty($sub_mod_id)) {
            $this->db->where('s.sub_mod_id', $sub_mod_id);
        }

        if (!empty($team_id)) {
            $this->db->where('s.team_id', $team_id);
        }

        if (!empty($typeofsystem)) {
            $this->db->where('s.typeofsystem', $typeofsystem);
        }


        if (!empty($search_value)) {
            $this->db->like('s.file_name', $search_value);
        }

        $this->db->order_by($order_column, $order_dir);
        $this->db->limit($length, $start);

        $this->db->group_by('s.file_name');

        return $this->db->get()->result_array();
    }




    public function getModuleMasterfile($team, $typeofsystem, $start, $length, $order_column, $order_dir, $search_value)
    {
        $this->db->select('m.*, users.*, team.team_name');
        $this->db->from('module_msfl m');
        $this->db->join('team', 'm.belong_to = team.team_id', 'left');
        $this->db->join('users', 'users.team_id = team.team_id', 'left');


        $this->db->where('m.active', 'Active');

        if (($this->session->userdata('is_admin') === 'No' || $this->session->userdata('is_admin') === null) && $this->session->userdata('position') !== 'Manager') {
            $this->db->where('users.emp_id', $this->session->userdata('emp_id'));
        }

        if ($typeofsystem) {
            $this->db->where('m.typeofsystem', $typeofsystem);
        }
        if (!empty($team)) {
            $this->db->where('belong_to', $team);
        }
        if (!empty($search_value)) {
            $this->db->group_start();
            $this->db->like('mod_name', $search_value);
            $this->db->or_like('team.team_name', $search_value);
            $this->db->or_like('mod_abbr', $search_value);
            $this->db->group_end();
        }

        $this->db->group_by('m.module_id');
        $this->db->order_by($order_column, $order_dir);
        $this->db->limit($length, $start);

        return $this->db->get()->result_array();
    }


    public function getTotalModuleMasterfile($team, $typeofsystem, $search_value)
    {
        $this->db->select('m.*, users.*, team.team_name');
        $this->db->from('module_msfl m');
        $this->db->join('team', 'm.belong_to = team.team_id', 'left');
        $this->db->join('users', 'users.team_id = team.team_id', 'left');

        $this->db->where('m.active', 'Active');

        if (($this->session->userdata('is_admin') === 'No' || $this->session->userdata('is_admin') === null) && $this->session->userdata('position') !== 'Manager') {
            $this->db->where('users.emp_id', $this->session->userdata('emp_id'));
        }

        if ($typeofsystem) {
            $this->db->where('m.typeofsystem', $typeofsystem);
        }
        if (!empty($team)) {
            $this->db->where('belong_to', $team);
        }
        if (!empty($search_value)) {
            $this->db->group_start();
            $this->db->like('mod_name', $search_value);
            $this->db->or_like('team.team_name', $search_value);
            $this->db->or_like('mod_abbr', $search_value);
            $this->db->group_end();
        }
        $this->db->group_by('m.module_id');

        return $this->db->count_all_results();
    }


    public function get_view_dept_implemented_modules($module_id, $team, $company, $business_unit, $department, $typeofsystem, $start, $length, $order_column, $order_dir, $search_value)
    {
        $this->db->select('m.module_id, m.mod_name, m.mod_abbr, t.team_name, t.team_id, m.belong_to as belong team, mod.*, sb.sub_mod_name, sb.sub_mod_id');
        $this->db->from('module_msfl m');
        $this->db->join('module mod', 'mod.mod_id = m.module_id', 'left');
        $this->db->join('sub_module sb', 'm.module_id = sb.mod_id AND mod.submodule_id = sb.sub_mod_id', 'left');
        $this->db->join('team t', 't.team_id = m.belong_to', 'left');
        $this->db->join('users', 'users.team_id = t.team_id', 'left');
        $this->db->where('m.active !=', 'Inactive');
        $this->db->where('mod.active !=', 'Inactive');
        $this->db->where('mod.requested_to_co <>', '');
        $this->db->where('mod.mod_id', $module_id);

        if (($this->session->userdata('is_admin') === 'No' || $this->session->userdata('is_admin') === null) && $this->session->userdata('position') !== 'Manager') {
            $this->db->where('users.emp_id', $this->session->userdata('emp_id'));
        }
        $this->db->group_by('mod.id');

        if (!empty($search_value)) {
            $this->db->like('m.mod_name', $search_value);
            $this->db->or_like('m.mod_abbr', $search_value);

        }
        $this->db->order_by($order_column, $order_dir);
        $this->db->limit($length, $start);
        if (!empty($typeofsystem)) {
            $this->db->where('m.typeofsystem', $typeofsystem);
        }
        if (!empty($team)) {
            $this->db->where('mod.belong_team', $team);
        }


        if (!empty($company)) {
            $this->db->where('mod.requested_to_co', $company);
        }

        if (!empty($business_unit)) {
            $this->db->where('mod.requested_to_bu', $business_unit);
        }

        if (!empty($department)) {
            $this->db->where('mod.requested_to_dep', $department);
        }

        return $this->db->get()->result_array();
    }
    public function getTotalget_view_dept_implemented_modules($module_id, $team, $company, $business_unit, $department, $typeofsystem, $search_value)
    {
        $this->db->select('m.module_id, m.mod_name, m.mod_abbr, t.team_name, t.team_id, m.belong_to as belong team, mod.*, sb.sub_mod_name, sb.sub_mod_id');
        $this->db->from('module_msfl m');
        $this->db->join('module mod', 'mod.mod_id = m.module_id', 'left');
        $this->db->join('sub_module sb', 'm.module_id = sb.mod_id AND mod.submodule_id = sb.sub_mod_id', 'left');
        $this->db->join('team t', 't.team_id = m.belong_to', 'left');
        $this->db->join('users', 'users.team_id = t.team_id', 'left');
        $this->db->where('m.active !=', 'Inactive');
        $this->db->where('mod.active !=', 'Inactive');
        $this->db->where('mod.requested_to_co <>', '');
        $this->db->where('mod.mod_id', $module_id);
        $this->db->group_by('mod.id');
        if (
            ($this->session->userdata('is_admin') === 'No' || $this->session->userdata('is_admin') === null)
            && $this->session->userdata('position') !== 'Manager'
        ) {
            $this->db->where('users.emp_id', $this->session->userdata('emp_id'));
        }

        if (!empty($search_value)) {
            $this->db->like('m.mod_name', $search_value);
            $this->db->or_like('m.mod_abbr', $search_value);

        }
        if (!empty($typeofsystem)) {
            $this->db->where('m.typeofsystem', $typeofsystem);
        }
        if (!empty($team)) {
            $this->db->where('mod.belong_team', $team);
        }


        if (!empty($company)) {
            $this->db->where('mod.requested_to_co', $company);
        }

        if (!empty($business_unit)) {
            $this->db->where('mod.requested_to_bu', $business_unit);
        }

        if (!empty($department)) {
            $this->db->where('mod.requested_to_dep', $department);
        }

        return $this->db->count_all_results();
    }



    public function getModule($team, $typeofsystem, $start, $length, $order_column, $order_dir, $search_value)
    {
        $this->db->select("
        m.module_id,
        sb.sub_mod_id,
        sb.sub_mod_name,
        m.mod_name,
        m.mod_abbr,
        t.team_name,
        t.team_id,
        m.belong_to AS belong_team,
        mod.*,
        m.module_desc,
        m.mod_status,
        GROUP_CONCAT(DISTINCT gantt.emp_id ORDER BY gantt.emp_id SEPARATOR ',') AS emp_id,
        GROUP_CONCAT(DISTINCT gantt.emp_name ORDER BY gantt.emp_id SEPARATOR ',') AS emp_name
    ");
        $this->db->from('module_msfl m');
        $this->db->join('module mod', 'mod.mod_id = m.module_id', 'left');
        $this->db->join('sub_module sb', 'sb.mod_id = m.module_id', 'left');
        $this->db->join('team t', 't.team_id = m.belong_to', 'left');
        $this->db->join('users', 'users.team_id = t.team_id', 'left');
        $this->db->join('gantt', 'gantt.mod_id = m.module_id', 'left');

        $this->db->where('mod.active', 'Active');
        $this->db->where('mod.requested_to_co <>', '');

        if (
            ($this->session->userdata('is_admin') === 'No' || $this->session->userdata('is_admin') === null)
            && $this->session->userdata('position') !== 'Manager'
        ) {
            $this->db->where('users.emp_id', $this->session->userdata('emp_id'));
        }

        // Additional filters
        if (!empty($typeofsystem)) {
            $this->db->where('m.typeofsystem', $typeofsystem);
        }

        if (!empty($team)) {
            $this->db->where('m.belong_to', $team);
        }

        // Search
        if (!empty($search_value)) {
            $this->db->group_start();
            $this->db->like('m.mod_name', $search_value);
            $this->db->or_like('m.mod_abbr', $search_value);
            $this->db->group_end();
        }

        // Group by module to aggregate employee lists
        $this->db->group_by('m.module_id');

        // Sorting and paging
        $this->db->order_by($order_column, $order_dir);
        $this->db->limit($length, $start);

        return $this->db->get()->result_array();
    }


    public function getTotalModule($team, $typeofsystem, $search_value)
    {
        $this->db->select('m.module_id,sb.sub_mod_id,sb.sub_mod_name, m.mod_name, m.mod_abbr, t.team_name, t.team_id, m.belong_to as belong team, mod.*, m.module_desc');
        $this->db->from('module_msfl m');
        $this->db->join('module mod', 'mod.mod_id = m.module_id', 'left');
        $this->db->join('sub_module sb', 'sb.mod_id = m.module_id', 'left');
        $this->db->join('team t', 't.team_id = m.belong_to', 'left');
        $this->db->join('users', 'users.team_id = t.team_id', 'left');
        $this->db->where('mod.active', 'Active');
        $this->db->where('m.active !=', 'Inactive');
        // $this->db->where('m.mod_status !=', 'Pending');
        $this->db->where('mod.requested_to_co <>', '');
        if (
            ($this->session->userdata('is_admin') === 'No' || $this->session->userdata('is_admin') === null)
            && $this->session->userdata('position') !== 'Manager'
        ) {
            $this->db->where('users.emp_id', $this->session->userdata('emp_id'));
        }
        // if ($this->session->userdata('is_admin') === 'Yes') {
        //     $this->db->where('users.emp_id', $this->session->userdata('emp_id'));
        // }

        $this->db->group_by('m.module_id');
        if (!empty($search_value)) {
            $this->db->group_start();
            $this->db->like('m.mod_name', $search_value);
            $this->db->or_like('m.mod_abbr', $search_value);
            $this->db->group_end();
        }
        if (!empty($typeofsystem)) {
            $this->db->where('m.typeofsystem', $typeofsystem);
        }
        if (!empty($team)) {
            $this->db->where('m.belong_to', $team);
        }

        return $this->db->count_all_results();
    }

    public function insertModule($data)
    {
        $this->db->insert('module', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function insertModuleMsfl($data)
    {
        $this->db->insert('module_msfl', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function updateModule_msfl($data, $id)
    {
        $this->db->where('module_id', $id);
        $this->db->update('module_msfl', $data);
    }
    public function updateModule($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('module', $data);
    }

    public function deleteModuleset($id)
    {
        $this->db->where('id', $id);
        $this->db->set('active', 'Inactive');
        $this->db->update('module');
    }

    public function deleteModule($id)
    {
        $this->db->trans_start();
        $this->db->where('module_id', $id);
        $this->db->set('active', 'Inactive');
        $this->db->update('module_msfl');

        $this->db->where('mod_id', $id);
        $this->db->set('status', 'Inactive');
        $this->db->update('sub_module');

        $this->db->where('mod_id', $id);
        $this->db->set('active', 'Inactive');
        $this->db->update('module');


        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        }
        return true;
    }



    public function getSubModule($mod_id, $start, $length, $order_column, $order_dir, $search_value)
    {
        $this->db->select('*');
        $this->db->from('sub_module');
        $this->db->where('status !=', 'Inactive');
        if (!empty($search_value)) {
            $this->db->like('sub_mod_name', $search_value);
        }
        $this->db->order_by($order_column, $order_dir);
        $this->db->limit($length, $start);

        $this->db->where('mod_id', $mod_id);

        return $this->db->get()->result_array();
    }

    public function getTotalSubModule($mod_id, $search_value)
    {
        $this->db->select('*');
        $this->db->from('sub_module');
        $this->db->where('status !=', 'Inactive');
        if (!empty($search_value)) {
            $this->db->like('sub_mod_name', $search_value);
        }

        $this->db->where('mod_id', $mod_id);
        return $this->db->count_all_results();
    }
    public function insertSubModule($data)
    {
        $this->db->insert('sub_module', $data);
    }

    public function get_module_data($id)
    {
        $this->db->select('mdl.*, t.team_name,m.mod_name, mdl.submodule_id as sub_mod_id');
        $this->db->from('module_msfl m');
        $this->db->join('module mdl', 'mdl.mod_id = m.module_id', 'left');
        $this->db->join('team t', 't.team_id = mdl.belong_team', 'left');
        $this->db->where('m.active !=', 'Inactive');
        $this->db->where('mdl.id', $id);
        $this->db->group_by('mdl.id');

        return $this->db->get()->row_array();
    }
    public function get_module_data_msfl($id)
    {
        $this->db->select('m.*, t.team_name, t.team_id');
        $this->db->from('module_msfl m');
        $this->db->join('team t', 't.team_id = m.belong_to');
        $this->db->where('m.active !=', 'Inactive');
        $this->db->where('m.module_id', $id);
        $this->db->group_by('m.module_id');

        return $this->db->get()->row_array();
    }

    public function get_submodule_data($sub_mod_id)
    {
        $this->db->select('*');
        $this->db->from('sub_module');
        $this->db->where('status !=', 'Inactive');
        $this->db->where('sub_mod_id', $sub_mod_id);
        return $this->db->get()->row_array();
    }
    public function updateSubModule($data, $sub_mod_id)
    {
        $this->db->where('sub_mod_id', $sub_mod_id);
        $this->db->update('sub_module', $data);
    }

    public function deleteSubModule($sub_mod_id)
    {
        $this->db->where('sub_mod_id', $sub_mod_id);
        $this->db->delete('sub_module');
    }


    public function get_current_system_data($team, $module_id, $sub_mod_id, $type, $typeofsystem, $start, $length, $order_column, $order_dir, $search_value)
    {
        $this->db->select('system_files.*, team.*, module_msfl.mod_name, module_msfl.module_id as mod_id');
        $this->db->from('system_files');
        $this->db->join('team', 'team.team_id = system_files.team_id');
        $this->db->join('module_msfl', 'module_msfl.module_id = system_files.mod_id');
        $this->db->where('uploaded_to', $type);
        $this->db->where('system_files.typeofsystem', $typeofsystem);
        $this->db->where('module_msfl.active !=', 'Inactive');

        if ($search_value) {
            $this->db->like('team.team_name', $search_value);
            $this->db->or_like('system_files.file_name', $search_value);
            $this->db->or_like('module_msfl.mod_name', $search_value);
        }

        $columns = ['team_name', 'file_name', 'uploaded_to'];
        $order_column_name = isset($columns[$order_column]) ? $columns[$order_column] : $columns[0];
        $this->db->order_by($order_column_name, $order_dir);
        $this->db->limit($length, $start);

        if ($team) {
            $this->db->where('system_files.team_id', $team);
        }
        if ($module_id) {
            $this->db->where('system_files.mod_id', $module_id);
        }
        if ($sub_mod_id) {
            $this->db->where('system_files.sub_mod_id', $sub_mod_id);
        }

        return $this->db->get()->result_array();
    }

    public function get_new_system_data($team, $module_id, $sub_mod_id, $type, $typeofsystem, $start, $length, $order_column, $order_dir, $search_value)
    {
        $this->db->select('system_files.*, team.*, module_msfl.mod_name, module_msfl.module_id as mod_id');
        $this->db->from('system_files');
        $this->db->join('team', 'team.team_id = system_files.team_id');
        $this->db->join('module_msfl', 'module_msfl.module_id = system_files.mod_id');
        $this->db->where('uploaded_to', $type);
        $this->db->where('system_files.typeofsystem', $typeofsystem);
        $this->db->where('module_msfl.active !=', 'Inactive');

        if ($search_value) {
            $this->db->like('team.team_name', $search_value);
            $this->db->or_like('system_files.file_name', $search_value);
            $this->db->or_like('module_msfl.mod_name', $search_value);
        }

        $columns = ['team_name', 'file_name', 'uploaded_to'];
        $order_column_name = isset($columns[$order_column]) ? $columns[$order_column] : $columns[0];
        $this->db->order_by($order_column_name, $order_dir);

        $this->db->limit($length, $start);
        if ($team) {
            $this->db->where('system_files.team_id', $team);
        }
        if ($module_id) {
            $this->db->where('system_files.mod_id', $module_id);
        }
        if ($sub_mod_id) {
            $this->db->where('system_files.sub_mod_id', $sub_mod_id);
        }
        return $this->db->get()->result_array();
    }



    public function getTotalModuleCurrent($team, $module_id, $sub_mod_id, $search_value = null, $type)
    {
        $this->db->select('COUNT(*) as total, team.*, module_msfl.mod_name, module_msfl.module_id as mod_id');
        $this->db->from('system_files');
        $this->db->join('team', 'team.team_id = system_files.team_id');
        $this->db->join('module_msfl', 'module_msfl.module_id = system_files.mod_id');
        $this->db->where('uploaded_to', $type);
        $this->db->where('system_files.typeofsystem', 'current');
        $this->db->where('module_msfl.active !=', 'Inactive');

        if ($team) {
            $this->db->where('system_files.team_id', $team);
        }
        if ($module_id) {
            $this->db->where('system_files.mod_id', $module_id);
        }
        if ($sub_mod_id) {
            $this->db->where('system_files.sub_mod_id', $sub_mod_id);
        }

        if ($search_value) {
            $this->db->like('team.team_name', $search_value);
            $this->db->or_like('system_files.file_name', $search_value);
        }

        $query = $this->db->get();
        return $query->row()->total;
    }
    public function getTotalModuleNew($team, $module_id, $sub_mod_id, $search_value = null, $type)
    {
        $this->db->select('COUNT(*) as total, team.*, module_msfl.mod_name, module_msfl.module_id as mod_id');
        $this->db->from('system_files');
        $this->db->join('team', 'team.team_id = system_files.team_id');
        $this->db->join('module_msfl', 'module_msfl.module_id = system_files.mod_id');
        $this->db->where('uploaded_to', $type);
        $this->db->where('system_files.typeofsystem', 'new');
        $this->db->where('module_msfl.active !=', 'Inactive');
        if ($team) {
            $this->db->where('system_files.team_id', $team);
        }
        if ($module_id) {
            $this->db->where('system_files.mod_id', $module_id);
        }
        if ($sub_mod_id) {
            $this->db->where('system_files.sub_mod_id', $sub_mod_id);
        }

        if ($search_value) {
            $this->db->like('team.team_name', $search_value);
            $this->db->or_like('system_files.file_name', $search_value);
        }

        $query = $this->db->get();
        return $query->row()->total;
    }

    public function updateModuleStatus($data, $mod_id)
    {
        $this->db->where('module_id', $mod_id);
        $this->db->update('module_msfl', $data);

    }

    public function approved($file_id, $data, $typeofsystem)
    {
        if ($typeofsystem === 'current') {
            $this->db->where('file_id', $file_id);
            $this->db->update('system_files', $data);
        } elseif ($typeofsystem === 'new') {
            $this->db->where('file_id', $file_id);
            $this->db->update('system_files', $data);
        }
    }
    public function backtopending($file_id, $data, $typeofsystem)
    {
        if ($typeofsystem === 'current') {
            $this->db->where('file_id', $file_id);
            $this->db->update('system_files', $data);
        } elseif ($typeofsystem === 'new') {
            $this->db->where('file_id', $file_id);
            $this->db->update('system_files', $data);
        }
    }

    public function get_notifications()
    {
        $this->db->select('system_files.*, team.team_name, m.mod_name, m.module_id as mod_id');
        $this->db->from('system_files');
        $this->db->join('team', 'team.team_id = system_files.team_id');
        $this->db->join('module_msfl m', 'm.module_id = system_files.mod_id');

        $this->db->where('m.active', 'Active');

        $this->db->group_start();
        $this->db->where('isr_status', 'pending');
        $this->db->or_where('att_status', 'pending');
        $this->db->or_where('minute_status', 'pending');
        $this->db->or_where('wt_status', 'pending');
        $this->db->or_where('flowchart_status', 'pending');
        $this->db->or_where('dfd_status', 'pending');
        $this->db->or_where('gantt_status', 'pending');
        $this->db->or_where('proposed_status', 'pending');
        $this->db->or_where('local_status', 'pending');
        $this->db->or_where('uat_status', 'pending');
        $this->db->or_where('live_status', 'pending');
        $this->db->or_where('guide_status', 'pending');
        $this->db->or_where('memo_status', 'pending');
        $this->db->or_where('acceptance_status', 'pending');
        $this->db->or_where('letter_status', 'pending');
        $this->db->group_end();

        $this->db->order_by('system_files.date_uploaded', 'DESC');

        return $this->db->get()->result_array();
    }

    public function get_pending_notification_count()
    {
        $this->db->select('system_files.*, team.team_name, m.mod_name, m.module_id as mod_id');
        $this->db->from('system_files');
        $this->db->join('team', 'team.team_id = system_files.team_id');
        $this->db->join('module_msfl m', 'm.module_id = system_files.mod_id');
        $this->db->where('m.active', 'Active');
        $this->db->group_start();
        $this->db->where('isr_status', 'pending');
        $this->db->or_where('att_status', 'pending');
        $this->db->or_where('minute_status', 'pending');
        $this->db->or_where('wt_status', 'pending');
        $this->db->or_where('flowchart_status', 'pending');
        $this->db->or_where('dfd_status', 'pending');
        $this->db->or_where('gantt_status', 'pending');
        $this->db->or_where('proposed_status', 'pending');
        $this->db->or_where('local_status', 'pending');
        $this->db->or_where('uat_status', 'pending');
        $this->db->or_where('live_status', 'pending');
        $this->db->or_where('guide_status', 'pending');
        $this->db->or_where('memo_status', 'pending');
        $this->db->or_where('acceptance_status', 'pending');
        $this->db->or_where('letter_status', 'pending');
        $this->db->group_end();
        return $this->db->count_all_results();
    }

    public function get_pending_module_count()
    {
        $this->db->select('*');
        $this->db->from('module_msfl');
        $this->db->where('mod_status', 'Pending');
        $this->db->where('active', 'Active');
        return $this->db->count_all_results();
    }

    public function get_pending_module_count_implemented()
    {
        $this->db->select('module_msfl.module_id');
        $this->db->from('module');
        $this->db->join('module_msfl', 'module.mod_id = module_msfl.module_id');
        $this->db->where('module_msfl.mod_status', 'Pending');
        $this->db->where('module.active', 'Active');
        // $this->db->or_where('module_msfl.active', 'Active');
        $this->db->where('module_msfl.typeofsystem', 'new');
        $this->db->group_by('module_msfl.module_id');
        return $this->db->count_all_results();
    }


    public function get_workload_count()
    {
        $this->db->select('*');
        $this->db->from('workload');
        $this->db->where('emp_id', $this->session->userdata('emp_id'));
        $this->db->where('date(date_added)', date('Y-m-d'));
        return $this->db->count_all_results();
    }

    public function get_weekly_count()
    {
        $this->db->select('*');
        $this->db->from('weekly_report');
        $this->db->where('emp_id', $this->session->userdata('emp_id'));
        $this->db->where('date(date_added)', date('Y-m-d'));
        return $this->db->count_all_results();
    }

    public function get_messages()
    {
        $this->db->select('*');
        $this->db->from('messages');
        $this->db->where('receiver_id', $this->session->userdata('emp_id'));

        $this->db->where('date_send >=', date('Y-m-d H:i:s', strtotime('-1 hours')));

        $this->db->order_by('date_send', 'DESC');

        return $this->db->get()->result_array();
    }


    public function get_messages_count()
    {
        $this->db->select('*');
        $this->db->from('messages');
        $this->db->where('receiver_id', $this->session->userdata('emp_id'));
        $this->db->where('date_send >=', date('Y-m-d H:i:s', strtotime('-1 hours')));

        $this->db->order_by('date_send', 'DESC');
        return $this->db->count_all_results();
    }



    public function getCompanyPhone($start, $length, $order_column, $order_dir, $search_value)
    {
        $this->db->select('*');
        $this->db->from('company_phone');

        if (!empty($search_value)) {
            $this->db->group_start();
            $this->db->like('team', $search_value);
            $this->db->or_like('ip_phone', $search_value);
            $this->db->group_end();
        }
        $this->db->order_by($order_column, $order_dir);
        $this->db->limit($length, $start);

        return $this->db->get()->result_array();
    }

    public function totalCompanyPhone($search_value)
    {
        $this->db->select('*');
        $this->db->from('company_phone');

        if (!empty($search_value)) {
            $this->db->group_start();
            $this->db->like('team', $search_value);
            $this->db->or_like('ip_phone', $search_value);
            $this->db->group_end();
        }
        return $this->db->count_all_results();
    }

    public function insertCompany($data)
    {
        $this->db->insert('company_phone', $data);
    }
    public function updateCompany($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('company_phone', $data);
    }


    public function getTeamList($start, $length, $order_column, $order_dir, $search_value)
    {
        $this->db->select('*');
        $this->db->from('team');

        if (!empty($search_value)) {
            $this->db->group_start();
            $this->db->like('team_name', $search_value);
            $this->db->group_end();
        }
        $this->db->order_by($order_column, $order_dir);
        $this->db->limit($length, $start);

        return $this->db->get()->result_array();
    }

    public function totalTeamList($search_value)
    {
        $this->db->select('*');
        $this->db->from('team');

        if (!empty($search_value)) {
            $this->db->group_start();
            $this->db->like('team', $search_value);
            $this->db->group_end();
        }
        return $this->db->count_all_results();
    }

    public function insertTeam($data)
    {
        $this->db->insert('team', $data);
    }
    public function updateTeam($data, $id)
    {
        $this->db->where('team_id', $id);
        $this->db->update('team', $data);
    }
    public function rules_regulations_data($start, $length, $order_column, $order_dir, $search_value)
    {
        $this->db->select('*');
        $this->db->from('rules_regulations');
        if (!empty($search_value)) {
            $this->db->group_start();
            $this->db->like('team_name', $search_value);
            $this->db->or_like('filename', $search_value);
            $this->db->group_end();
        }
        $this->db->order_by($order_column, $order_dir);
        $this->db->limit($length, $start);
        return $this->db->get()->result_array();
    }
    public function rules_regulations_count($search_value)
    {
        $this->db->select('*');
        $this->db->from('rules_regulations');
        if (!empty($search_value)) {
            $this->db->group_start();
            $this->db->like('team_name', $search_value);
            $this->db->or_like('filename', $search_value);
            $this->db->group_end();
        }
        return $this->db->count_all_results();
    }
    public function upload_file($data)
    {
        $this->db->insert('rules_regulations', $data);
    }

    public function getFileById($id)
    {
        return $this->db->get_where('rules_regulations', ['id' => $id])->row_array();
    }

    public function deleteFile($id)
    {
        return $this->db->delete('rules_regulations', ['id' => $id]);
    }


}