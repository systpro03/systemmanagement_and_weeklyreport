<?php
class File_mod_new extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('pis', TRUE);
    }
    public function get_file_details($file_name, $team, $module, $sub_module, $business_unit, $department = NULL)
    {


        $this->db->select('ss.*, mfsl.mod_abbr, ss.date, t.team_name, mfsl.mod_name, t.team_id');
        $this->db->from('system_files ss');
        $this->db->join('module_msfl mfsl', 'mfsl.module_id = ss.mod_id', 'left');
        $this->db->join('team t', 't.team_id = ss.team_id', 'left');
        $this->db->where('mfsl.active', 'Active');

        $this->db->where('ss.file_name', $file_name);
        if ($team) {
            $this->db->where('ss.team_id', $team);
        }
        if ($module) {
            $this->db->where('ss.mod_id', $module);
        }
        if ($sub_module) {
            $this->db->where('ss.sub_mod_id', $sub_module);
        }
        if ($business_unit) {
            $this->db->where('ss.business_unit', $business_unit);
        }
        if ($department) {
            $this->db->where('ss.department', $department);
        }

        if (!empty($_GET['date'])) {
            $dates = explode(' to ', $_GET['date']);

            if (count($dates) === 2) {
                $start_date = date('Y-m-d', strtotime($dates[0]));
                $end_date = date('Y-m-d', strtotime($dates[1]));
            } else {
                $start_date = $end_date = date('Y-m-d', strtotime($dates[0])); // Single date
            }

            $this->db->where("DATE_FORMAT(STR_TO_DATE(SUBSTRING_INDEX(ss.date, ' to ', 1), '%M %d, %Y'), '%Y-%m-%d') <= ", $end_date);
            $this->db->where("DATE_FORMAT(STR_TO_DATE(SUBSTRING_INDEX(ss.date, ' to ', -1), '%M %d, %Y'), '%Y-%m-%d') >= ", $start_date);
        }


        $this->db->where('ss.typeofsystem', 'new');
        $query = $this->db->get();
        return $query->row();
    }


    public function get_departments($bcode)
    {
        $this->db2->select('dept.*');
        $this->db2->from('locate_department dept');
        $this->db2->join('locate_business_unit b', 'dept.bunit_code = b.bunit_code');
        $this->db2->where('dept.status', 'active');
        $this->db2->where("CONCAT(dept.company_code, b.bunit_code) = ", $bcode, false);
        $this->db2->group_by('dept.dept_code', 'asc');
        $query = $this->db2->get();

        return $query->result();
    }


    // public function get_business_units(){

    //     $this->db2->select('c.*, b.*');
    //     $this->db2->from('locate_company c');
    //     $this->db2->join('locate_business_unit b', 'c.company_code = b.company_code');
    //     $this->db2->where('c.status', 'active');
    //     $this->db2->where('b.status', 'active');
    //     $this->db2->order_by('b.business_unit', 'ASC');
    //     $this->db2->group_by('b.bcode', 'ASC');
    //     $business_unit = $this->db2->get()->result();

    //     foreach ($business_unit as &$bu) {
    //         $this->db2->select('*');
    //         $this->db2->from('locate_department d');
    //         $this->db2->where('d.bunit_code', $bu->bunit_code);
    //         $bu->buData = $this->db2->get()->result();
    //     }
    //     return $business_unit;
    // }

    public function get_business_units()
    {
        $this->db2->select('c.*, b.*');
        $this->db2->from('locate_company c');
        $this->db2->join('locate_business_unit b', 'c.company_code = b.company_code');
        $this->db2->where('c.status', 'active');
        $this->db2->where('b.status', 'active');
        $this->db2->order_by('b.business_unit');
        $this->db2->group_by('b.bcode');

        $business_unit = $this->db2->get()->result();
        foreach ($business_unit as &$bu) {
            $this->db2->select('*');
            $this->db2->from('locate_department d');
            $this->db2->where('d.bunit_code', $bu->bunit_code);
            $this->db2->where('d.company_code', $bu->company_code);
            $bu->buData = $this->db2->get()->result();

            $this->db->select('m.mod_name, mdl.*');
            $this->db->from('module mdl');
            $this->db->join('module_msfl m', 'mdl.mod_id = m.module_id', 'left');
            $this->db->where('m.active !=', 'Inactive');
            $this->db->where('mdl.requested_to_co', $bu->company_code);
            $this->db->where('mdl.requested_to_bu', $bu->bunit_code);
            $bu->modules = $this->db->get()->result();
        }

        return $business_unit;
    }


    public function get_business_units_filter($bus)
    {
        $this->db2->select('c.*, b.*');
        $this->db2->from('locate_company c');
        $this->db2->join('locate_business_unit b', 'c.company_code = b.company_code');
        $this->db2->where('c.status', 'active');
        $this->db2->where('b.status', 'active');
        if ($bus) {
            $this->db2->where('b.bcode', $bus);
        }


        $this->db2->order_by('b.business_unit');
        $this->db2->group_by('b.bcode');

        $business_unit = $this->db2->get()->result();
        foreach ($business_unit as &$bu) {
            $this->db2->select('*');
            $this->db2->from('locate_department d');
            $this->db2->where('d.bunit_code', $bu->bunit_code);
            $this->db2->where('d.company_code', $bu->company_code);
            $bu->buData = $this->db2->get()->result();

            $this->db->select('m.mod_name, mdl.*');
            $this->db->from('module mdl');
            $this->db->join('module_msfl m', 'mdl.mod_id = m.module_id', 'left');
            $this->db->where('m.active !=', 'Inactive');
            $this->db->where('mdl.requested_to_co', $bu->company_code);
            $this->db->where('mdl.requested_to_bu', $bu->bunit_code);
            $bu->modules = $this->db->get()->result();
        }

        return $business_unit;
    }

    public function get_module_new($team)
    {
        $this->db->select('mdl.mod_id, m.mod_name, sb.sub_mod_id, sb.sub_mod_name');
        $this->db->from('module mdl');
        $this->db->join('module_msfl m', 'mdl.mod_id = m.module_id', 'left');
        $this->db->join('sub_module sb', 'm.module_id = sb.mod_id', 'left');
        $this->db->where('m.typeofsystem', 'new');
        $this->db->where('mdl.active', 'Active');
        $this->db->order_by('m.mod_name', 'ASC');
        if ($team) {
            $this->db->where('m.belong_to', $team);
        }

        $this->db->group_by('m.module_id');

        // if ($this->session->userdata('is_admin') === 'No' || $this->session->userdata('is_admin') === null) {
        //     $this->db->where('m.belong_to', $this->session->userdata('team_id'));
        // }


        $modules = $this->db->get()->result();

        foreach ($modules as &$module) {
            $this->db->select('sb.sub_mod_id, sb.sub_mod_name');
            $this->db->from('sub_module sb');
            // $this->db->join('module m', 'm.mod_id = sb.mod_id AND m.submodule_id = sb.sub_mod_id');
            $this->db->where('sb.mod_id', $module->mod_id);
            $this->db->where('sb.status !=', 'Inactive');
            $module->submodules = $this->db->get()->result();
        }
        return $modules;
    }

    public function get_files_by_name($folder_name)
    {
        $this->db->select('file_name');
        $this->db->from('system_files');
        $this->db->where('uploaded_to', $folder_name);
        $this->db->where('typeofsystem', 'new');
        $query = $this->db->get();

        return $query->result_array();
    }
    public function upload_file($data)
    {
        $this->db->insert('system_files', $data);
    }

    public function file_exists_new($file_name, $team, $module, $sub_mod_id, $path)
    {
        $this->db->where('file_name', $file_name);
        $this->db->where('team_id', $team);
        $this->db->where('mod_id', $module);
        $this->db->where('sub_mod_id', $sub_mod_id);
        $this->db->where('uploaded_to', $path);
        $this->db->where('typeofsystem', 'new');
        $query = $this->db->get('system_files');

        return $query->num_rows() > 0;
    }

    public function users_team_belong_to($emp_id, $team) {
        $this->db->select('emp_id');
        $this->db->from('users');
        $this->db->join('team', 'team.team_id = users.team_id AND users.emp_id = emp_id');
        $this->db->where('users.emp_id', $this->session->userdata('emp_id'));
        $this->db->where('team.team_id', $team);
        $this->db->where('users.is_active', 'Active');
        $query = $this->db->get();
        return $query->num_rows() > 0;
    }

    public function delete_file_record($file_name, $uploaded_to)
    {
        $fields = [
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
            'BUSINESS_ACCEPTANCE' => 'acceptance_status'
        ];
        if (array_key_exists($uploaded_to, $fields)) {
            $status_field = $fields[$uploaded_to];

            $this->db->where('file_name', $file_name);
            $this->db->where($status_field, 'pending');
            $this->db->where('typeofsystem', 'new');
            $this->db->delete('system_files');

            return $this->db->affected_rows() > 0;
        }

        return false;
    }



    public function get_teams()
    {
        $this->db->select('*');
        $this->db->from('team');
        $this->db->where('team_id !=', '10');
        $query = $this->db->get();

        return $query->result_array();
    }
    // public function get_modules($team) {
    //     $this->db->select('*');
    //     $this->db->from('module_msfl');
    //     $this->db->join('module', 'module_msfl.module_id = module.mod_id');
    //     $this->db->where('module_msfl.active', 'Active');
    //     $this->db->where('module.typeofsystem', 'new');
    //     $this->db->where('module_msfl.mod_status', 'Approve');
    //     if($team){
    //         $this->db->where('module_msfl.belong_to', $team);
    //     }
    //     $this->db->group_by('module_msfl.module_id', 'ASC');
    //     $query = $this->db->get();

    //     return $query->result_array();
    // }


    public function get_modules($team)
    {
        $this->db->select('*');
        $this->db->from('module mdl');
        $this->db->join('module_msfl m', 'mdl.mod_id = m.module_id', 'left');
        $this->db->join('sub_module sb', 'm.module_id = sb.mod_id', 'left');
        $this->db->where('m.typeofsystem', 'new');
        $this->db->where('m.active !=', 'Inactive');

        if ($team) {
            $this->db->where('m.belong_to', $team);
        }

        $this->db->group_by('m.module_id');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_sub_modules()
    {
        $this->db->select('*');
        $this->db->from('sub_module');
        // $this->db->where('mod_id', $sb);
        $this->db->where('status !=', 'Inactive');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function check_files_exist($team, $module, $sub_mod_id, $previous_directory)
    {
        $this->db->where('team_id', $team);
        $this->db->where('mod_id', $module);
        $this->db->where('sub_mod_id', $sub_mod_id);
        $this->db->where('uploaded_to', $previous_directory);
        return $this->db->count_all_results('system_files');
    }

    public function get_pending_files($team, $module, $sub_mod_id, $previous_directories)
    {
        $this->db->where('team_id', $team);
        $this->db->where('mod_id', $module);
        $this->db->where('sub_mod_id', $sub_mod_id);
        $this->db->where('typeofsystem', 'new');

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

        $this->db->group_start(); // Start OR condition grouping
        foreach ($previous_directories as $prev_directory) {
            if (isset($status_fields[$prev_directory])) {
                $this->db->or_where($status_fields[$prev_directory], 'pending');
            }
        }
        $this->db->group_end(); // Close OR condition grouping

        return $this->db->get('system_files')->result_array();
    }


    public function get_pending_files2($team, $module, $sub_mod_id, $previous_directory)
    {
        $this->db->where('team_id', $team);
        $this->db->where('mod_id', $module);
        $this->db->where('sub_mod_id', $sub_mod_id);
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

        if (isset($status_fields[$previous_directory])) {
            $this->db->where($status_fields[$previous_directory], 'pending');
        }

        return $this->db->get('system_files')->result_array();
    }

    public function is_directory_approved($team, $module, $sub_module, $directory)
    {
        $status_field_map = [
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

        if (!isset($status_field_map[$directory])) {
            return false;
        }

        $this->db->select($status_field_map[$directory]);
        $this->db->where('team_id', $team);
        $this->db->where('mod_id', $module);
        $this->db->where('sub_mod_id', $sub_module);
        $this->db->where('uploaded_to', $directory);
        $this->db->order_by('date_uploaded', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('system_files');

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->{$status_field_map[$directory]} === 'Approve';
        }

        return false;
    }




}