<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if ($this->session->username == "") {
            redirect('login');
        }
        $this->load->model('Menu/Member_mod', 'member');
        $this->load->model('Menu/Workload', 'workload');
        $this->load->model('Menu/Structure_mod', 'structure');
    }
    public function member_view()
    {
        $this->load->view('_layouts/header');
        $this->load->view('menu/member');
        $this->load->view('_layouts/footer');
    }
    public function member_list()
    {
        $team = $this->input->post('team');
        $module = $this->input->post('module');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $order = $this->input->post('order');
        $search_value = $this->input->post('search')['value'];
        $order_column = $order[0]['column'];
        $order_dir = $order[0]['dir'];

        $memberlist = $this->member->get_member_list($team, $module, $start, $length, $search_value, $order_column, $order_dir);
        $total_filtered = $this->member->get_member_count($team, $module, $search_value);

        $result = [
            'draw' => $this->input->post('draw'),
            'recordsTotal' => $total_filtered,
            'recordsFiltered' => $total_filtered,
            'data' => []
        ];

        $formatted_data = [];

        $teams = $this->db->where('team_id !=', 10)
            ->get('team')
            ->result_array();

        $colors = [
            'bg-color-1',
            'bg-color-2',
            'bg-color-3',
            'bg-color-4',
            'bg-color-5',
            'bg-color-6',
            'bg-color-7',
            'bg-color-8',
            'bg-color-9'
        ];

        $team_colors = [];
        foreach ($teams as $index => $team_row) {
            $team_colors[strtolower(trim($team_row['team_name']))] = $colors[$index % count($colors)];
        }

        foreach ($memberlist as $value) {
            $team_name = ucwords(strtoupper($value['team_name']));
            $module_name = ucwords(strtolower($value['mod_name'])) . ' [  <strong class="badge bg-info ">' . strtoupper($value['mod_abbr']) . ' </strong> ]';
            $sub_module_name = ucwords(strtolower($value['sub_mod_name']));
            $menu_name = ucwords(strtolower($value['sub_mod_menu']));

            $emp_data = $this->workload->get_emp($value['emp_id']);
            $emp = $this->structure->get_emp($value['emp_id']);

            $image = !empty($emp['photo']) ? ltrim($emp['photo'], '.') : '';

            if ($image === '') {
                $photo = '<img src="http://172.16.161.34:8080/hrms/default.png" alt="No Photo" class="rounded-circle avatar-sm material-shadow">';
            } else {
                $photo = '<img src="http://172.16.161.34:8080/hrms/' . $image . '" class="rounded-circle avatar-xs material-shadow">';
            }

            $contact_no = (!empty($value['contact_no'])) ? $value['contact_no'] :
                '<span class="badge rounded-pill bg-danger-subtle text-danger">No Contact Number</span>';

            $type = ($value['type'] == 'Parttime') ?
                '<span class="badge rounded-pill bg-danger-subtle text-danger">Parttime</span>' :
                '<span class="badge rounded-pill bg-success-subtle text-success">Fulltime</span>';

            if (!isset($formatted_data[$team_name])) {
                $formatted_data[$team_name] = [];
            }

            if (!isset($formatted_data[$team_name][$module_name])) {
                $formatted_data[$team_name][$module_name] = [];
            }

            if (!isset($formatted_data[$team_name][$module_name][$value['emp_id']])) {
                $formatted_data[$team_name][$module_name][$value['emp_id']] = [
                    'name' => $photo . '&nbsp; ' . ucwords(strtolower($emp_data['name'])),
                    'contact_no' => $contact_no,
                    'position' => $emp_data['position'],
                    'type' => $type,
                    'team_color' => $team_colors[strtolower(trim($team_name))] ?: 'bg-white',
                    'sub_modules' => []
                ];
            }

            // Group menus under each sub-module
            $found = false;
            foreach ($formatted_data[$team_name][$module_name][$value['emp_id']]['sub_modules'] as &$sub) {
                if ($sub['name'] === $sub_module_name) {
                    $sub['menus'][] = $menu_name;
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $formatted_data[$team_name][$module_name][$value['emp_id']]['sub_modules'][] = [
                    'name' => $sub_module_name,
                    'menus' => [$menu_name]
                ];
            }
        }

        foreach ($formatted_data as $team_name => $modules) {
            $first_team = true;
            foreach ($modules as $module_name => $employees) {
                $first_module = true;
                foreach ($employees as $employee) {
                    $first_employee = true;
                    foreach ($employee['sub_modules'] as $sub_module) {
                        $first_sub = true;
                        foreach ($sub_module['menus'] as $menu) {
                            $result['data'][] = [
                                'team_name' => $first_team ? $team_name : '',
                                'team_color' => $employee['team_color'],
                                'module' => $first_module ? $module_name : '',
                                'sub_module' => $first_sub ? $sub_module['name'] : '',
                                'menu' => $menu,
                                'name' => $first_employee ? $employee['name'] : '',
                                'contact_no' => $first_employee ? $employee['contact_no'] : '',
                                'position' => $first_employee ? $employee['position'] : '',
                                'type' => $first_employee ? $employee['type'] : ''
                            ];
                            $first_team = false;
                            $first_module = false;
                            $first_employee = false;
                            $first_sub = false;
                        }
                    }
                }
            }
        }

        echo json_encode($result);
    }




}