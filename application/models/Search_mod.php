<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Search_mod extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('pis', TRUE);
    }
    public function get_emp_ids_by_name_search($search_value)
    {
        $this->db2->select('emp_id');
        $this->db2->from('employee3');
        $this->db2->where('current_status', 'Active');
        $search_value = str_replace('_', ' ', $search_value);
        $words = preg_split('/\s+/', $search_value);

        if (!empty($words)) {
            $this->db2->group_start();
            foreach ($words as $word) {
                $this->db2->like('name', $word, 'both');
            }
            $this->db2->group_end();
        }
$this->db2->like('name', $word, 'both');

        $this->db2->limit(1000);
        $query = $this->db2->get();

        $emp_ids = [];
        foreach ($query->result_array() as $row) {
            $emp_ids[] = $row['emp_id'];
        }

        return $emp_ids;
    }



    public function get_files_by_directory($dirName, $fileNameSearch, $limit = 10, $offset = 0)
    {


        $this->db->select('ss.*, mfsl.mod_abbr,t.team_name, mfsl.mod_name, mfsl.module_desc, ms.sub_mod_name');
        $this->db->from('system_files ss');
        $this->db->join('module_msfl mfsl', 'mfsl.module_id = ss.mod_id', 'left');
        $this->db->join('sub_module ms', 'ms.sub_mod_id = ss.sub_mod_id', 'left');
        $this->db->join('team t', 't.team_id = ss.team_id', 'left');
        $this->db->join('users', 'users.emp_id = ss.uploaded_by');

        $this->db->group_start();

        if (!empty($dirName)) {
            $this->db->like('ss.uploaded_to', $dirName);
        }

        
        if (!empty($fileNameSearch)) {
            $this->db->or_like('ss.file_name', $fileNameSearch);
            $this->db->or_like('ss.original_file_name', $fileNameSearch);
            $this->db->or_like('mfsl.mod_abbr', $fileNameSearch);
            $this->db->or_like('mfsl.typeofsystem', $fileNameSearch);
            $this->db->or_like('t.team_name', $fileNameSearch);
            $user = $this->get_emp_ids_by_name_search($fileNameSearch);
            if (!empty($user)) {
                $this->db->or_where_in('ss.uploaded_by', $user);
            }
        }

        $this->db->group_end();


        $this->db->where('mfsl.active', 'Active');
        $this->db->order_by('ss.date_uploaded', 'DESC');
        $this->db->group_by('ss.file_id');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }

    public function count_files_by_directory($dirName, $fileNameSearch)
    {
        $this->db->select('ss.*, mfsl.mod_abbr, t.team_name, mfsl.mod_name, mfsl.module_desc, ms.sub_mod_name');
        $this->db->from('system_files ss');
        $this->db->join('module_msfl mfsl', 'mfsl.module_id = ss.mod_id', 'left');
        $this->db->join('sub_module ms', 'ms.sub_mod_id = ss.sub_mod_id', 'left');
        $this->db->join('team t', 't.team_id = ss.team_id', 'left');
        $this->db->join('users', 'users.emp_id = ss.uploaded_by');
        

        if (!empty($dirName)) {
            $this->db->like('ss.uploaded_to', $dirName);
        }

        if (!empty($fileNameSearch)) {
            $this->db->group_start();
            $this->db->or_like('ss.file_name', $fileNameSearch);
            $this->db->or_like('ss.original_file_name', $fileNameSearch);
            $this->db->or_like('mfsl.mod_abbr', $fileNameSearch);
            $this->db->or_like('mfsl.typeofsystem', $fileNameSearch);
            $this->db->or_like('t.team_name', $fileNameSearch);

            $user = $this->get_emp_ids_by_name_search($fileNameSearch);
            if (!empty($user)) {
                $this->db->or_where_in('ss.uploaded_by', $user);
            }
             $this->db->group_end();
        }

        $this->db->where('mfsl.active', 'Active');
        $this->db->order_by('ss.date_uploaded', 'DESC');
        $this->db->group_by('ss.file_id');
        return $this->db->count_all_results();
    }

    public function search_workloads_and_weekly_report($keyword, $limit = 10, $offset = 0)
    {
        $this->db->select('w.*, mfsl.mod_abbr, mfsl.mod_name, sb.sub_mod_name, t.team_name, wr.task_workload, wr.concerns, wr.remarks as wr_remarks, wr.weekly_status, wr.date_range, users.type');
        $this->db->from('workload w');
        $this->db->join('module_msfl mfsl', 'mfsl.module_id = w.module', 'left');
        $this->db->join('sub_module sb', 'sb.sub_mod_id = w.sub_mod', 'left');
        $this->db->join('weekly_report wr', 'wr.mod_id = w.module AND wr.emp_id = w.emp_id', 'left');
        $this->db->join('team t', 't.team_id = w.team_id ', 'left');
        $this->db->join('users', '(users.emp_id = w.emp_id AND t.team_id = users.team_id) OR (wr.emp_id = users.emp_id)', 'left');


        if (!empty($keyword)) {
            $this->db->group_start();
            $this->db->like('wr.task_workload', $keyword);
            $this->db->or_like('wr.concerns', $keyword);
            $this->db->or_like('wr.remarks', $keyword);
            $this->db->or_like('w.add_pos', $keyword);
            $this->db->or_like('w.desc', $keyword);
            $this->db->or_like('w.user_type', $keyword);
            $this->db->or_like('mfsl.mod_name', $keyword);
            $this->db->or_like('mfsl.mod_abbr', $keyword);
            $this->db->or_like('sb.sub_mod_name', $keyword);
            $this->db->or_like('t.team_name', $keyword);

            $user = $this->get_emp_ids_by_name_search($keyword);
            if (!empty($user)) {
                $this->db->or_where_in('w.emp_id', $user);
            }
            $this->db->group_end();
        }

        $this->db->where('mfsl.active', 'Active');
        $this->db->order_by('wr.date_added', 'DESC');
        $this->db->group_by('w.id');

        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }

    public function count_search_workloads_and_weekly_report($keyword)
    {


        $this->db->select('w.*, mfsl.mod_abbr, mfsl.mod_name, sb.sub_mod_name, t.team_name, wr.task_workload, wr.concerns, wr.remarks as wr_remarks, wr.weekly_status, wr.date_range, users.type');
        $this->db->from('workload w');
        $this->db->join('module_msfl mfsl', 'mfsl.module_id = w.module', 'left');
        $this->db->join('sub_module sb', 'sb.sub_mod_id = w.sub_mod', 'left');
        $this->db->join('weekly_report wr', 'wr.mod_id = w.module AND wr.emp_id = w.emp_id', 'left');
        $this->db->join('team t', 't.team_id = w.team_id', 'left');
        $this->db->join('users', '(users.emp_id = w.emp_id AND t.team_id = users.team_id) OR (wr.emp_id = users.emp_id)', 'left');


        if (!empty($keyword)) {
            $this->db->group_start();
            $this->db->like('wr.task_workload', $keyword);
            $this->db->or_like('wr.concerns', $keyword);
            $this->db->or_like('wr.remarks', $keyword);
            $this->db->or_like('w.add_pos', $keyword);
            $this->db->or_like('w.desc', $keyword);
            $this->db->or_like('w.user_type', $keyword);
            $this->db->or_like('mfsl.mod_name', $keyword);
            $this->db->or_like('mfsl.mod_abbr', $keyword);
            $this->db->or_like('sb.sub_mod_name', $keyword);
            $this->db->or_like('t.team_name', $keyword);

            $user = $this->get_emp_ids_by_name_search($keyword);
            if (!empty($user)) {
                $this->db->or_where_in('w.emp_id', $user);
            }
            $this->db->group_end();
        }

        $this->db->where('mfsl.active', 'Active');
        $this->db->order_by('wr.date_added', 'DESC');
        $this->db->group_by('w.id');

        return $this->db->count_all_results();
    }


    public function get_server_address($server)
    {
        $this->db->select('s.*');
        $this->db->from('server as s');
        $this->db->where('s.server', $server);
        $query = $this->db->get();
        return $query->row();
    }

    public function search_server($server, $limit = 10, $offset = 0)
    {
        
        $this->db->select('s.*, mfsl.mod_abbr, mfsl.mod_name, t.team_name');
        $this->db->from('server s');
        $this->db->join('module_msfl mfsl', 'mfsl.module_id = s.module', 'left');
        $this->db->join('team t', 't.team_id = s.team', 'left');
        
        $this->db->where('s.server', $server);
        $this->db->group_by('s.server_id');

        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }

    public function count_search_server($server)
    {
        $this->db->select('s.*, mfsl.mod_abbr, mfsl.mod_name, t.team_name');
        $this->db->from('server s');
        $this->db->join('module_msfl mfsl', 'mfsl.module_id = s.module', 'left');
        $this->db->join('team t', 't.team_id = s.team', 'left');
        $this->db->where('s.server', $server);

        $this->db->group_by('s.server_id');
        return $this->db->count_all_results();
    }


public function module_description($key)
{
    $this->db->select('m.*');
    $this->db->from('module_msfl as m');
    $this->db->like('m.module_desc', $key);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->row();
    }
    return null;
}



    public function search_module_desc($module_desc, $limit = 10, $offset = 0){
        $this->db->select('*');
        $this->db->from('module_msfl');
        $this->db->like('module_desc', $module_desc);
        $this->db->group_by('module_id');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }

    public function count_search_module_desc($module_desc){
        $this->db->select('*');
        $this->db->from('module_msfl');
        $this->db->like('module_desc', $module_desc);
        $this->db->group_by('module_id');
        return $this->db->count_all_results();
    }


}