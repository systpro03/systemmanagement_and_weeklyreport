<?php
class Location_mod extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('pis', TRUE);
    }

    // public function module_list_implemented($typeofsystem, $start, $length, $order_column, $order_dir, $search_value) {
    //     $this->db->select('sl.id AS location_id, m.module_id AS mod_id, m.mod_name, sb.sub_mod_id, sb.sub_mod_name, m.typeofsystem')
    //             ->from('location_setup sl')
    //             ->join('module_msfl m', 'm.module_id = sl.mod_id')
    //             ->join('module mdl', 'mdl.mod_id = m.module_id', 'left')
    //             ->join('sub_module sb', 'sl.sub_mod_id = sb.sub_mod_id', 'left')
    //             ->where('m.active !=', 'Inactive')
    //             ->where('m.typeofsystem', $typeofsystem)
    //             ->group_by('sl.mod_id');

    //     if (!empty($search_value)) {
    //         $this->db->like('m.mod_name', $search_value);
    //     }

    //     $this->db->order_by($order_column, $order_dir)
    //              ->limit($length, $start);

    //     return $this->db->get()->result_array();
    // }

    // public function get_total_module_list_implemented($typeofsystem, $search_value) {
    //     $this->db->select('sl.id AS location_id, m.module_id AS mod_id, m.mod_name, sb.sub_mod_id, sb.sub_mod_name, m.typeofsystem')
    //             ->from('location_setup sl')
    //             ->join('module_msfl m', 'm.module_id = sl.mod_id')
    //             ->join('module mdl', 'mdl.mod_id = m.module_id', 'left')
    //             ->join('sub_module sb', 'sl.sub_mod_id = sb.sub_mod_id', 'left')
    //             ->where('m.active !=', 'Inactive')
    //             ->where('m.typeofsystem', $typeofsystem)
    //             ->group_by('sl.mod_id');

    //     if (!empty($search_value)) {
    //         $this->db->like('m.mod_name', $search_value);
    //     }

    //     return $this->db->count_all_results();
    // }


    public function module_list_implemented($typeofsystem, $start, $length, $order_column, $order_dir, $search_value)
    {
        $this->db->select('m.module_id AS mod_id, m.mod_name, mdl.submodule_id as sub_mod_id, sb.sub_mod_name, m.typeofsystem, m.mod_abbr');
        $this->db->from('module_msfl m');
        $this->db->join('module mdl', 'mdl.mod_id = m.module_id', 'left');
        $this->db->join('gantt g', 'g.mod_id = m.module_id', 'left');
        $this->db->join('sub_module sb', 'sb.sub_mod_id = mdl.submodule_id', 'left');
        $this->db->join('users', 'users.team_id = m.belong_to', 'left');
        $this->db->where('m.active !=', 'Inactive');
        $this->db->where('mdl.active !=', 'Inactive');
        if ($typeofsystem) {
            $this->db->where('m.typeofsystem', $typeofsystem);
        }
        if (
            ($this->session->userdata('is_admin') === 'No' || $this->session->userdata('is_admin') === null)
            && $this->session->userdata('position') !== 'Manager'
        ) {
            $this->db->where('users.emp_id', $this->session->userdata('emp_id'));
        }

        $this->db->group_by('m.module_id');

        if (!empty($search_value)) {
            $this->db->group_start();
            $this->db->like('m.mod_name', $search_value);
            $this->db->or_like('m.mod_abbr', $search_value);
            $this->db->group_end();
        }

        $this->db->order_by($order_column, $order_dir)
            ->limit($length, $start);

        return $this->db->get()->result_array();
    }

    public function get_total_module_list_implemented($typeofsystem, $search_value)
    {
        $this->db->select('m.module_id AS mod_id, m.mod_name, mdl.submodule_id as sub_mod_id, sb.sub_mod_name, m.typeofsystem, m.mod_abbr');
        $this->db->from('module_msfl m');
        $this->db->join('module mdl', 'mdl.mod_id = m.module_id', 'left');
        $this->db->join('gantt g', 'g.mod_id = m.module_id', 'left');
        $this->db->join('sub_module sb', 'sb.sub_mod_id = mdl.submodule_id', 'left');
        $this->db->join('users', 'users.team_id = m.belong_to', 'left');
        $this->db->where('m.active !=', 'Inactive');
        $this->db->where('mdl.active !=', 'Inactive');
        if ($typeofsystem) {
            $this->db->where('m.typeofsystem', $typeofsystem);
        }
        if (
            ($this->session->userdata('is_admin') === 'No' || $this->session->userdata('is_admin') === null)
            && $this->session->userdata('position') !== 'Manager'
        ) {
            $this->db->where('users.emp_id', $this->session->userdata('emp_id'));
        }
        $this->db->group_by('m.module_id');

        if (!empty($search_value)) {
            $this->db->group_start();
            $this->db->like('m.mod_name', $search_value);
            $this->db->or_like('m.mod_abbr', $search_value);
            $this->db->group_end();
        }

        return $this->db->count_all_results();
    }




    // public function get_location_data($module_id, $start, $length, $order_column, $order_dir, $search_value) {
    //     $this->db->select('sl.*, m.*, sb.*, m.module_id as mod_id');
    //     $this->db->from('location_setup sl');
    //     $this->db->join('module_msfl m', 'm.module_id = sl.mod_id');
    //     $this->db->join('sub_module sb', 'sl.sub_mod_id = sb.sub_mod_id', 'left');
    //     $this->db->where('m.active !=', 'Inactive');
    //     // $this->db->where('sb.status !=', 'Inactive');
    //     $this->db->where('sl.mod_id =', $module_id);
    //     if (!empty($search_value)) {
    //         $this->db->like('dt.company', $search_value);
    //         $this->db->or_like('dt.business_unit', $search_value);
    //         $this->db->or_like('dt.department', $search_value);
    //         $this->db->or_like('m.mod_name', $search_value);
    //         $this->db->or_like('sb.sub_mod_name', $search_value);
    //     }

    //     $this->db->order_by($order_column, $order_dir);
    //     $this->db->limit($length, $start);

    //     return $this->db->get()->result_array();
    // }

    // public function get_total_location_data($module_id, $search_value) {
    //     $this->db->select('sl.*, m.*, sb.*, m.module_id as mod_id');
    //     $this->db->from('location_setup sl');
    //     $this->db->join('module_msfl m', 'm.module_id = sl.mod_id');
    //     $this->db->join('sub_module sb', 'sl.sub_mod_id = sb.sub_mod_id', 'left');
    //     $this->db->where('m.active !=', 'Inactive');
    //     // $this->db->where('sb.status !=', 'Inactive');
    //     $this->db->where('sl.mod_id =', $module_id);
    //     if (!empty($search_value)) {
    //         $this->db->like('dt.company', $search_value);
    //         $this->db->or_like('dt.business_unit', $search_value);
    //         $this->db->or_like('dt.department', $search_value);
    //         $this->db->or_like('m.mod_name', $search_value);
    //         $this->db->or_like('sb.sub_mod_name', $search_value);
    //     }
    //     return $this->db->count_all_results();
    // }

    public function get_location_data($module_id, $start, $length, $order_column, $order_dir, $search_value)
    {
        $this->db->select('m.module_id,sb.sub_mod_id,sb.sub_mod_name, m.mod_name, m.mod_abbr, t.team_name, t.team_id, m.belong_to as belong team, mod.*, g.date_parallel, g.date_implem');
        $this->db->from('gantt g');
        $this->db->join('module_msfl m', 'm.module_id = g.mod_id AND g.team_id =  m.belong_to');
        $this->db->join('module mod', 'mod.mod_id = m.module_id', 'left');
        $this->db->join('sub_module sb', 'sb.mod_id = m.module_id AND sb.sub_mod_id = g.sub_mod_id AND g.mod_id = sb.mod_id', 'left');
        $this->db->join('team t', 't.team_id = m.belong_to', 'left');
        $this->db->where('mod.active', 'Active');
        $this->db->where('m.active !=', 'Inactive');
        $this->db->where('m.typeofsystem', 'new');

        $this->db->where('mod.requested_to_co <>', '');
        $this->db->where('g.mod_id', $module_id);
        
        if (!empty($search_value)) {
            $this->db->group_start();
            $this->db->like('m.mod_name', $search_value);
            $this->db->or_like('sb.sub_mod_name', $search_value);
            $this->db->or_like('m.mod_abbr', $search_value);
            $this->db->group_end();

        }
        $this->db->order_by($order_column, $order_dir);
        $this->db->limit($length, $start);
        // if (!empty($team)) {
        //     $this->db->where('m.belong_to', $team);
        // }

        return $this->db->get()->result_array();
    }

    public function get_total_location_data($module_id, $search_value)
    {
        $this->db->select('m.module_id,sb.sub_mod_id,sb.sub_mod_name, m.mod_name, m.mod_abbr, t.team_name, t.team_id, m.belong_to as belong team,mod.*, g.date_parallel, g.date_implem');
        $this->db->from('gantt g');
        $this->db->join('module_msfl m', 'm.module_id = g.mod_id');
        $this->db->join('module mod', 'mod.mod_id = m.module_id', 'left');
        $this->db->join('sub_module sb', 'sb.mod_id = m.module_id AND sb.sub_mod_id = g.sub_mod_id AND g.mod_id = sb.mod_id', 'left');
        $this->db->join('team t', 't.team_id = m.belong_to', 'left');
        $this->db->where('mod.active', 'Active');
        $this->db->where('m.active !=', 'Inactive');
        $this->db->where('mod.requested_to_co <>', '');
        $this->db->where('g.mod_id', $module_id);
        $this->db->where('m.typeofsystem', 'new');

        if (!empty($search_value)) {
            $this->db->group_start();
            $this->db->like('m.mod_name', $search_value);
            $this->db->or_like('sb.sub_mod_name', $search_value);
            $this->db->or_like('m.mod_abbr', $search_value);
            $this->db->group_end();

        }


        // if (!empty($team)) {
        //     $this->db->where('m.belong_to', $team);
        // }

        return $this->db->count_all_results();
    }

    public function get_location_data_current($module_id, $start, $length, $order_column, $order_dir, $search_value)
    {
        $this->db->select('m.module_id,sb.sub_mod_id,sb.sub_mod_name, m.mod_name, m.mod_abbr, t.team_name, t.team_id, m.belong_to as belong team, g.*, g.date_parallel, g.date_implem');
        $this->db->from('module g');
        $this->db->join('module_msfl m', 'm.module_id = g.mod_id');
        $this->db->join('sub_module sb', 'sb.mod_id = m.module_id AND sb.sub_mod_id = g.submodule_id AND g.mod_id = sb.mod_id', 'left');
        $this->db->join('team t', 't.team_id = m.belong_to', 'left');
        $this->db->where('g.active', 'Active');
        $this->db->where('g.typeofsystem', 'current');
        $this->db->where('g.requested_to_co <>', '');
        $this->db->where('g.mod_id', $module_id);

        if (!empty($search_value)) {
            $this->db->group_start();
            $this->db->like('m.mod_name', $search_value);
            $this->db->or_like('sb.sub_mod_name', $search_value);
            $this->db->or_like('m.mod_abbr', $search_value);
            $this->db->group_end();

        }
        $this->db->order_by($order_column, $order_dir);
        $this->db->limit($length, $start);
        if (!empty($team)) {
            $this->db->where('m.belong_to', $team);
        }

        return $this->db->get()->result_array();
    }

    public function get_total_location_data_current($module_id, $search_value)
    {
        $this->db->select('m.module_id,sb.sub_mod_id,sb.sub_mod_name, m.mod_name, m.mod_abbr, t.team_name, t.team_id, m.belong_to as belong team, mod.*, g.date_parallel, g.date_implem');
        $this->db->from('module g');
        $this->db->join('module_msfl m', 'm.module_id = g.mod_id');
        $this->db->join('sub_module sb', 'sb.mod_id = m.module_id AND sb.sub_mod_id = g.submodule_id AND g.mod_id = sb.mod_id', 'left');
        $this->db->join('team t', 't.team_id = m.belong_to', 'left');
        $this->db->where('g.active', 'Active');
        $this->db->where('g.typeofsystem', 'current');
        $this->db->where('g.requested_to_co <>', '');
        $this->db->where('g.mod_id', $module_id);
        if (!empty($search_value)) {
            $this->db->group_start();
            $this->db->like('m.mod_name', $search_value);
            $this->db->or_like('sb.sub_mod_name', $search_value);
            $this->db->or_like('m.mod_abbr', $search_value);
            $this->db->group_end();

        }
        if (!empty($team)) {
            $this->db->where('m.belong_to', $team);
        }

        return $this->db->count_all_results();
    }

    public function get_setup_location_data($id)
    {
        $this->db->select('*');
        $this->db->from('location_setup');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function setup_location()
    {
        $this->db2->select('c.*,bu.*, dept.*, c.acroname');
        $this->db2->from('locate_company c');
        $this->db2->join('locate_business_unit bu', 'c.company_code = bu.company_code');
        $this->db2->join('locate_department dept', 'c.company_code = dept.company_code AND bu.bunit_code = dept.bunit_code');
        $this->db2->where('c.status', 'active');
        $this->db2->group_by('c.company_code', 'ASC');
        $location = $this->db2->get()->result();

        foreach ($location as &$loc) {
            $this->db2->select('bu.*');
            $this->db2->from('locate_business_unit bu');
            $this->db2->where('bu.company_code', $loc->company_code);
            $this->db2->where('bu.status', 'active');
            $loc->business_unit = $this->db2->get()->result();

            $this->db2->select('dept.*');
            $this->db2->from('locate_department dept');
            $this->db2->where('dept.company_code', $loc->company_code);
            $this->db2->where('dept.status', 'active');
            $loc->department = $this->db2->get()->result();
        }
        return $location;
    }
    public function company($company)
    {
        $this->db2->select('*');
        $this->db2->from('locate_company');
        $this->db2->where('company_code', $company);
        $this->db2->where('status', 'active');
        return $this->db2->get()->row_array();
    }
    public function business_unit($company, $bcode)
    {
        $this->db2->select('*');
        $this->db2->from('locate_business_unit');
        $this->db2->where('bcode', $company . $bcode);
        $this->db2->where('status', 'active');
        return $this->db2->get()->row_array();
    }
    public function department($department)
    {
        $this->db2->select('*');
        $this->db2->from('locate_department');
        $this->db2->where('dcode', $department);
        $this->db2->where('status', 'active');
        return $this->db2->get()->row_array();
    }


    public function submit_location($data)
    {
        $this->db->insert('location_setup', $data);
    }
    public function update_location($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('location_setup', $data);
    }
    public function delete_setup_location($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('location_setup');
    }
}






