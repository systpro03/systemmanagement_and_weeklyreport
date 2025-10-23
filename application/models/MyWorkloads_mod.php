<?php 
class MyWorkloads_mod extends CI_Model
{
    function __construct() {
        parent::__construct();
    }


    public function get_teams() {
        $this->db->select('team.*');
        $this->db->from('team');
        $this->db->join('users', 'team.team_id = users.team_id', 'left');

        $this->db->where('users.emp_id', $this->session->userdata('emp_id'));
        

        if($this->session->userdata('is_admin') === 'Yes') {
            $this->db->where('team.team_id !=', '10');
        } else {
            $this->db->where('users.team_id !=', '10');
        }
        
        $this->db->group_by('team.team_id');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_module_dat($team)
    {
        $this->db->select('m.module_id as mod_id, m.mod_name, sb.sub_mod_id, sb.sub_mod_name, m.typeofsystem');
        $this->db->from('module_msfl m');
        $this->db->join('workload w', 'w.module = m.module_id');
        $this->db->join('weekly_report wr', 'wr.mod_id = m.module_id', 'left');
        $this->db->join('sub_module sb', 'm.module_id = sb.mod_id', 'left');
        $this->db->join('users', 'users.team_id = m.belong_to', 'left');
        $this->db->where('m.active', 'Active');
        $this->db->where('m.mod_status', 'Approve');

        if($team){
            $this->db->where('m.belong_to', $team);
        }

        $this->db->group_start();
            $this->db->where('w.emp_id', $this->session->userdata('emp_id'));
            $this->db->or_where('wr.emp_id', $this->session->userdata('emp_id'));
        $this->db->group_end();

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

    public function get_workloads($team, $module, $status, $limit, $offset)
    {

        $this->db->select('w.*, m.*, sb.*, t.*, w.status as w_status, w.date_added, u.type, m.module_id as mod_id');
        $this->db->from('workload w');
        $this->db->join('module_msfl m', 'm.module_id = w.module', 'LEFT');
        $this->db->join('sub_module sb', 'w.sub_mod = sb.sub_mod_id AND w.module = sb.mod_id', 'LEFT');
        $this->db->join('team t', 't.team_id = w.team_id');
        $this->db->join('users u', 'u.emp_id = w.emp_id AND u.team_id = w.team_id', 'LEFT');
        $this->db->where('w.emp_id', $this->session->userdata('emp_id'));
        $this->db->where('m.active', 'Active');
        $this->db->order_by('w.date_added', 'DESC');
        if ($status !== 'all') {
            $this->db->where('w.status', $status);
        }

        if ($team) {
            $this->db->where('t.team_id', $team);
        }
        if ($module) {
            $this->db->where('m.module_id', $module);
        }

        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_workloads($team, $module, $status)
    {

        $this->db->select('w.*, m.*, sb.*, t.*, w.status as w_status, w.date_added, u.type, m.module_id as mod_id');
        $this->db->from('workload w');
        $this->db->join('module_msfl m', 'm.module_id = w.module', 'LEFT');
        $this->db->join('sub_module sb', 'w.sub_mod = sb.sub_mod_id AND w.module = sb.mod_id', 'LEFT');
        $this->db->join('team t', 't.team_id = w.team_id');
        $this->db->join('users u', 'u.emp_id = w.emp_id AND u.team_id = w.team_id', 'LEFT');
        $this->db->where('w.emp_id', $this->session->userdata('emp_id'));
        $this->db->where('m.active', 'Active');
        if ($status !== 'all') {
            $this->db->where('w.status', $status);
        }
        if ($team) {
            $this->db->where('t.team_id', $team);
        }
        if ($module) {
            $this->db->where('m.module_id', $module);
        }

        return $this->db->count_all_results();
    }

    public function get_tasks($team, $module,$status, $limit, $offset)
    {

        $this->db->select('w.*, m.*, sb.*, t.*, w.weekly_status as task_status, w.date_added, u.type, m.module_id as mod_id');
        $this->db->from('weekly_report w');
        $this->db->join('module_msfl m', 'm.module_id = w.mod_id');
        $this->db->join('sub_module sb', 'w.sub_mod_id = sb.sub_mod_id AND w.mod_id = sb.mod_id', 'LEFT');
        $this->db->join('team t', 't.team_id = w.team_id');
        $this->db->join('users u', 'u.emp_id = w.emp_id AND u.team_id = w.team_id', 'LEFT');
        $this->db->where('w.emp_id', $this->session->userdata('emp_id'));
        $this->db->order_by('w.date_added', 'DESC');
        if ($status !== 'all') {
            $this->db->where('w.weekly_status', $status);
        }

        if ($team) {
            $this->db->where('t.team_id', $team);
        }
        if ($module) {
            $this->db->where('m.module_id', $module);
        }
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_tasks($team, $module, $status)
    {

        $this->db->select('w.*, m.*, sb.*, t.*, w.weekly_status, w.date_added, u.type, m.module_id as mod_id');
        $this->db->from('weekly_report w');
        $this->db->join('module_msfl m', 'm.module_id = w.mod_id', 'LEFT');
        $this->db->join('sub_module sb', 'w.sub_mod_id = sb.sub_mod_id AND w.mod_id = sb.mod_id', 'LEFT');
        $this->db->join('team t', 't.team_id = w.team_id');
        $this->db->join('users u', 'u.emp_id = w.emp_id AND u.team_id = w.team_id', 'LEFT');
        $this->db->where('w.emp_id', $this->session->userdata('emp_id'));
        if ($status !== 'all') {
            $this->db->where('w.weekly_status', $status);
        }
        if ($team) {
            $this->db->where('t.team_id', $team);
        }
        if ($module) {
            $this->db->where('m.module_id', $module);
        }
        return $this->db->count_all_results();
    }
}