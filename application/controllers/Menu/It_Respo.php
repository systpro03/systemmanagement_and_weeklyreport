<?php
defined('BASEPATH') or exit('No direct script access allowed');

class It_Respo extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if ($this->session->username == "") {
            redirect('login');
        }
        $this->load->model('Menu/Workload', 'workload');
        $this->load->model('Menu/File_mod_current', 'file_mod');
        $this->load->model('Menu/Deploy_mod', 'deploy');
        $this->load->library('PDF', ['base_url' => base_url()]);
    }

    public function index()
    {
        $this->load->view('_layouts/header');
        $this->load->view('menu/it_respo');
        $this->load->view('_layouts/footer');

    }

    public function setup_module_workload()
    {
        $team = $this->input->post('team');
        $module = $this->workload->get_module_dat($team);
        echo json_encode($module);
    }

    public function workload_list()
    {
        $status = $this->input->post('status');
        $team = $this->input->post('team');
        $module = $this->input->post('module');
        $date_range = $this->input->post('date_range');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $order = $this->input->post('order');
        $search_value = $this->input->post('search')['value'];
        $order_column = $order[0]['column'];
        $order_dir = $order[0]['dir'];

        $workload = $this->workload->getWorkloads($date_range, $team, $module, $status, $start, $length, $order_column, $order_dir, $search_value);
        $total_records = $this->workload->getTotalWorkloads($date_range, $team, $module, $status, $search_value);

        $result = [
            'draw' => $this->input->post('draw'),
            'recordsTotal' => $total_records,
            'recordsFiltered' => $total_records,
            'data' => []
        ];

        $formatted_data = [];

        foreach ($workload as $row) {
            $team_name = ucwords(strtolower($row['team_name']));
            $module_name = ucwords(strtolower($row['mod_name'])) . ' [ <span class="badge bg-info">' . strtoupper($row['mod_abbr']) . '</span> ]';

            $sub_mod_name = !empty($row['sub_mod_name']) ? ucwords(strtolower($row['sub_mod_name'])) : '<span class="badge bg-secondary">N/A</span>';
            $sub_mod_menu = !empty($row['sub_mod_menu']) ? ucwords(strtolower($row['sub_mod_menu'])) : '<span class="badge bg-secondary">N/A</span>';
            $description = !empty($row['desc']) ? ucwords(strtolower($row['desc'])) : '<span class="badge bg-secondary">N/A</span>';
            $remarks = !empty($row['remarks']) ? ucwords(strtolower($row['remarks'])) : '<span class="badge bg-secondary">N/A</span>';

            $emp_data = $this->workload->get_emp($row['emp_id']);
            $add_pos = !empty($row['add_pos']) ? ucwords(strtolower($row['add_pos'])) : '<span class="badge bg-secondary">N/A</span>';

            if (!isset($formatted_data[$team_name])) {
                $formatted_data[$team_name] = [];
            }

            if (!isset($formatted_data[$team_name][$module_name])) {
                $formatted_data[$team_name][$module_name] = [];
            }

            if (!isset($formatted_data[$team_name][$module_name][$row['emp_id']])) {
                $formatted_data[$team_name][$module_name][$row['emp_id']] = [
                    'name' => ucwords(strtolower($emp_data['name'])),
                    'position' => $emp_data['position'],
                    'add_pos' => $add_pos,
                    'status' => $row['status'],
                    'modules' => []
                ];
            }

            $weekly = ' <button type="button" class="btn btn-soft-warning waves-effect waves-light btn-sm" onclick="show_update_workload(\'' . $row['id'] . '\', \'' . $row['status'] . '\')" data-bs-toggle="modal" data-bs-target="#show_update_workload">
                <iconify-icon icon="tdesign:chat-bubble-history-filled" class="label-icon align-bottom fs-16"></iconify-icon>
            </button>';

            $formatted_data[$team_name][$module_name][$row['emp_id']]['modules'][] = [
                'sub_mod_name' => $sub_mod_name,
                'sub_mod_menu' => $sub_mod_menu,
                'description' => $description,
                'status' => $row['status'],
                'id' => $row['id'],
                'remarks' => $remarks,
                'date_added' => date('F j, Y', strtotime($row['date_added'])),
                'action' => '
                    <div class="hstack gap-1">
                    '.$weekly.'
                        <button type="button" class="btn btn-soft-secondary btn-sm" onclick="edit_workload_content(' . $row['id'] . ')" data-bs-toggle="modal" data-bs-target="#edit_workload">
                            <iconify-icon icon="solar:pen-bold-duotone" class="align-bottom fs-16"></iconify-icon>
                        </button>
                        <button type="button" class="btn btn-soft-danger btn-sm" onclick="delete_workload(' . $row['id'] . ')">
                            <iconify-icon icon="solar:trash-bin-minimalistic-bold-duotone" class="align-bottom fs-16"></iconify-icon>
                        </button>
                    </div>'
            ];
        }

        $shown_emp_ids = []; // Track displayed employee IDs

        foreach ($formatted_data as $team_name => $modules) {
            foreach ($modules as $module_name => $employees) {
                foreach ($employees as $emp_id => $employee) {
                    $show_employee = !in_array($emp_id, $shown_emp_ids);

                    foreach ($employee['modules'] as $mod) {
                        $result['data'][] = [
                            'id' => $mod['id'],
                            'team_name' => $team_name,
                            'module' => $module_name,
                            'sub_mod_name' => $mod['sub_mod_name'],
                            'sub_mod_menu' => $mod['sub_mod_menu'],
                            'description' => $mod['description'],
                            'remarks' => $mod['remarks'],
                            'date_added' => $mod['date_added'],
                            'user_type' => $show_employee ? '<span class="badge bg-primary">' . $employee['position'] . '</span>' : '',
                            'emp_id' => $show_employee ? $employee['name'] : '',
                            'add_pos' => $show_employee ? $employee['add_pos'] : '',
                            'status' => $mod['status'],
                            'action' => $mod['action']
                        ];
                        $show_employee = false; // after first module, hide employee info
                    }

                    // Mark this emp_id as shown
                    if (!in_array($emp_id, $shown_emp_ids)) {
                        $shown_emp_ids[] = $emp_id;
                    }
                }
            }
        }

        echo json_encode($result);
    }

    public function setup_workload()
    {
        $team_id = $this->input->post('team_id');
        $members = $this->workload->get_members_by_team($team_id);

        foreach ($members as &$member) {
            $emp_data = $this->workload->get_employees($member->emp_id);
            if (!empty($emp_data) && isset($emp_data[0]->name)) {
                $member->emp_name = $emp_data[0]->name;
                $member->position = $emp_data[0]->position;
            }
        }
        echo json_encode($members);
    }

    public function setup_workload2()
    {
        $team_ids = $this->input->post('team_ids');

        if (empty($team_ids)) {
            echo json_encode([]);
            return;
        }

        $members = $this->workload->get_members_by_team2($team_ids);
        $employees = [];
        foreach ($members as $member) {
            $emp_data = $this->workload->get_employees($member->emp_id);
            if (!empty($emp_data) && isset($emp_data[0]->name)) {
                $employees[$member->emp_id] = $emp_data[0]->name;
            }
        }

        echo json_encode(array_values(array_map(function ($id, $name) {
            return ['emp_id' => $id, 'emp_name' => $name];
        }, array_keys($employees), $employees)));
    }
    public function setup_module()
    {
        $team = $this->input->post('team');
        $module = $this->workload->get_module($team);
        echo json_encode($module);
    }

    public function submit_workload()
    {
        $team_id = $this->input->post('team_id');
        $workloads = $this->input->post('workloads');

        foreach ($workloads as $workload) {
            $data = [
                'team_id' => $team_id,
                'emp_id' => $workload['emp_id'],
                'user_type' => $workload['position'],
                'add_pos' => $workload['add_pos'],
                'module' => $workload['module_id'],
                'sub_mod' => $workload['sub_module'],
                'sub_mod_menu' => $workload['sub_module_menu'],
                'desc' => $workload['description'],
                'remarks' => $workload['remarks'],
                'status' => $workload['status'],
                'date_added' => date('Y-m-d H:i:s'),
                'added_by' => $this->session->emp_id
            ];
            $this->db->insert('workload', $data);

            $modul = $this->deploy->get_module_name($workload['module_id']);
            $module_name = $modul->mod_name;
            $action = '<b>' . $this->session->name . '</b> added a workload to <b>' . $workload['emp_name'] . ' | ' . $module_name . '</b>';

            $data1 = [
                'emp_id' => $this->session->emp_id,
                'action' => $action,
                'date_added' => date('Y-m-d H:i:s'),
            ];
            $this->load->model('Logs', 'logs');
            $this->logs->addLogs($data1);
        }
    }


    public function edit_workload_content()
    {
        $id = $this->input->post('id');
        $data = $this->workload->get_workload_by_id($id);
        echo json_encode($data);
    }
    public function submit_updated_workload()
    {
        $id = $this->input->post('id');

        $team_id = $this->input->post('team_id');
        $emp_id = $this->input->post('emp_id');
        $emp_name = $this->input->post('emp_name');
        $position = $this->input->post('position');
        $add_pos = $this->input->post('add_pos');
        $module_id = $this->input->post('module_id');
        $sub_module = $this->input->post('sub_module');
        $sub_module_menu = $this->input->post('sub_module_menu');
        $description = $this->input->post('description');
        $remarks = $this->input->post('remarks');
        $status = $this->input->post('status');

        if($status === 'Ongoing'){
            $date_ongoing = date('Y-m-d H:i:s');
            $date_done = '';
        }else{
            $date_ongoing = '';
        }
        if($status === 'Done'){
            $date_done = date('Y-m-d H:i:s');
            $date_ongoing = '';
        }else{
            $date_done = '';
        }

        $data = array(
            'team_id' => $team_id,
            'emp_id' => $emp_id,
            'user_type' => $position,
            'add_pos' => $add_pos,
            'module' => $module_id,
            'sub_mod' => $sub_module,
            'sub_mod_menu' => $sub_module_menu,
            'desc' => $description,
            'remarks' => $remarks,
            'status' => $status,
            'date_updated' => date('Y-m-d H:i:s'),
            'updated_by' => $this->session->emp_id,
            'date_done' => $date_done,
            'date_ongoing' => $date_ongoing
        );
        $this->db->where('id', $id);
        $this->db->update('workload', $data);

        $modul = $this->deploy->get_module_name($module_id);
        $module_name = $modul->mod_name;
        $action = '<b>' . $this->session->name . '</b> updated a workload to <b>' . $emp_name . ' | ' . $module_name . '</b>';

        $data1 = array(
            'emp_id' => $this->session->emp_id,
            'action' => $action,
            'date_updated' => date('Y-m-d H:i:s'),
        );
        $this->load->model('Logs', 'logs');
        $this->logs->addLogs($data1);
    }

    public function update_workload_status()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $emp_name = $this->input->post('emp_name');

        if($status === 'Ongoing'){
            $date_ongoing = date('Y-m-d H:i:s');
            $date_done = '';
        }else{
            $date_ongoing = '';
        }
        if($status === 'Done'){
            $date_done = date('Y-m-d H:i:s');
            $date_ongoing = '';
        }else{
            $date_done = '';
        }


        $this->db->where('id', $id);
        $this->db->set('status', $status);
        $this->db->set('updated_by', $this->session->emp_id);
        $this->db->set('date_done', $date_done);
        $this->db->set('date_ongoing', $date_ongoing);
        $this->db->update('workload');

        $action = '<b>' . $this->session->name . '</b> updated a workload report status of <b>' . $emp_name . '</b> to <b>' . $status . '</b>';

        $data1 = array(
            'emp_id' => $this->session->emp_id,
            'action' => $action,
            'date_added' => date('Y-m-d H:i:s'),
        );
        $this->load->model('Logs', 'logs');
        $this->logs->addLogs($data1);
    }
    public function delete_workload()
    {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('workload');
    }
    
        public function show_update_workload()
    {
        $workload_id = $this->input->post('workload_id');
        $status = $this->input->post('status');

        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $order = $this->input->post('order');
        $search_value = $this->input->post('search')['value'];
        $order_column = $order[0]['column'];
        $order_dir = $order[0]['dir'];

        $data_logs = $this->workload->get_log_data_workload($workload_id, $start, $length, $order_column, $order_dir, $search_value);
        $data = [];

        foreach ($data_logs as $row) {

            if (!empty($row['date_done']) && strtotime($row['date_done']) !== false) {
                $date_updated = date('F d, Y', strtotime($row['date_done']));
            } else if (!empty($row['date_ongoing']) && strtotime($row['date_ongoing']) !== false) {
                $date_updated = date('F d, Y', strtotime($row['date_ongoing']));
            } else {
                $date_updated = '<span class="badge bg-info">N/A</span>';
            }


            if ($status === 'Pending') {
                $date_ongoing = '<span class="badge bg-info">N/A</span>';
                $date_done = '<span class="badge bg-info">N/A</span>';
            }

            if ($status === 'Ongoing') {
                $date_ongoing = $date_updated;
                $date_done = '<span class="badge bg-info">N/A</span>';
            } else {
                $date_ongoing = '<span class="badge bg-info">N/A</span>';
            }

            if ($status === 'Done') {
                $date_done = $date_updated;
                $date_ongoing = '<span class="badge bg-info">N/A</span>';
            } else {
                $date_done = '<span class="badge bg-info">N/A</span>';
            }

            if (!empty($row['updated_by'])) {
                $emp_data = $this->workload->get_emp($row['updated_by']);
                $emp_name = !empty($emp_data['name']) ? $emp_data['name'] : '<span class="badge bg-info">N/A</span>';
            } else {
                $emp_name = '<span class="badge bg-info">N/A</span>';
            }

            $data[] = [
                'date_ongoing' => $date_ongoing,
                'date_done' => $date_done,
                'name' => $emp_name
            ];
        }
        $total_records = count($data_logs);

        $output = [
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => $total_records,
            "recordsFiltered" => $total_records,
            "data" => $data
        ];
        echo json_encode($output);

    }

    public function export_pdf()
    {
        $team_id = $this->input->get('team_id');
        $team_name = $this->input->get('team_name');
        $module_name = $this->input->get('module_name');
        $module_id = $this->input->get('module_id');
        $status = $this->input->get('status');
        $date_range = $this->input->get('date_range');

        $visible_columns = explode(',', $this->input->get('visible_columns'));
        $visible_columns[] = '10';
        if (!empty($team_id) || !empty($module_id) || !empty($date_range)) {

            $workload = $this->workload->getWorkloads($date_range, $team_id, $module_id, $status, 0, 10000, 0, 'asc', '');


            $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
            $logo = FCPATH . 'assets/images/sys.png'; // Absolute path required
            $logo_width = 50;
            $x = 15;
            $y = 10;

            $title = 'IT SYSDEV WORKLOAD';
            $subTitle = "System Generated | " . date('F j, Y');
            $headerTextColor = [0, 0, 0];

            // PDF settings
            $pdf->SetTitle($title);
            $pdf->setCompression(true);
            $pdf->SetMargins(10, 25, 10);
            $pdf->SetHeaderMargin(10);
            $pdf->SetFooterMargin(13);
            $pdf->setPrintFooter(true);
            $pdf->setFooterFont(['helvetica', '', 7]);
            $pdf->SetFont('helvetica', '', 7);
            $pdf->SetAutoPageBreak(TRUE, 14);

            // Add first page
            $pdf->AddPage();

            // Draw header on first page
            if (file_exists($logo)) {
                $pdf->Image($logo, $x, $y, $logo_width, 0, 'PNG');

                $pdf->SetFont('helvetica', 'B', 14);
                $pdf->SetTextColorArray($headerTextColor);
                $pageWidth = $pdf->GetPageWidth();
                $titleWidth = $pdf->GetStringWidth($title);
                $titleX = ($pageWidth - $titleWidth) / 2;
                $pdf->SetXY($titleX, $y);
                $pdf->Cell($titleWidth, 5, $title, 0, 1, 'C');

                $pdf->SetFont('helvetica', '', 9);
                $subTitleWidth = $pdf->GetStringWidth($subTitle);
                $subTitleX = ($pageWidth - $subTitleWidth) / 2;
                $pdf->SetX($subTitleX);
                $pdf->Cell($subTitleWidth, 5, $subTitle, 0, 1, 'C');
            }
            if (empty($workload)) {

                $pdf->SetFont('helvetica', 'B', 12);
                $pdf->Cell(0, 10, 'No workload setup or data available for this workload.', 0, 1, 'C');
                $pdf->Output('workload_report.pdf', 'I');
                return;
            }

            // Column definitions
            $columns = [
                0 => 'Name',
                1 => 'Position',
                2 => 'Other Position',
                3 => 'Module',
                4 => 'Submodule',
                5 => 'Sub Menu',
                6 => 'Description',
                7 => 'Remarks',
                8 => 'Status',
                9 => 'Added',


            ];

            $column_widths = [
                0 => 25,
                1 => 25,
                2 => 20,
                3 => 20,
                4 => 20,
                5 => 22,
                6 => 35,
                7 => 35,
                8 => 15,
                9 => 20,

            ];

            // Filter visible headers
            $headers = array_intersect_key($columns, array_flip($visible_columns));

            // Compute total width and scale factor
            $total_width = 278; // A4 Landscape with ~20mm margins
            $total_default_width = array_sum(array_intersect_key($column_widths, $headers));
            $scaling_ratio = $total_width / $total_default_width;

            $adjusted_column_widths = [];
            foreach ($headers as $key => $_) {
                $base = isset($column_widths[$key]) ? $column_widths[$key] : 15;
                $adjusted_column_widths[$key] = round($base * $scaling_ratio, 2);
            }

            if ($team_name == 'Select Team Name') {
                $team_name = 'n/a';
            }
            if ($module_name == 'Select Module Name') {
                $module_name = 'n/a';
            }
            if ($date_range == '') {
                $date_range = 'n/a';
            }
            // Build header section above table
            $tbl = '
                <div style="margin-bottom: 10px;">
                    <h5 style="text-align: left;">Team: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $team_name . '</h5>
                    <h5 style="text-align: left;">Module: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $module_name . '</h5>
                    <h5 style="text-align: left;">Date Range: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $date_range . '</h5>
                </div>
            ';
            // Build table
            $tbl .= '<table border="1" cellpadding="4"><thead><tr>';
            foreach ($headers as $key => $col) {
                $width = $adjusted_column_widths[$key];
                $tbl .= '<th style="background-color:#2f2f2f; color:#ffffff; text-align:center; width:' . $width . 'mm;">' . $col . '</th>';
            }
            $tbl .= '</tr></thead><tbody>';
            $last_emp_name = '';
            // Group data by team_name
            $grouped_data = [];
            foreach ($workload as $row) {

                $emp_name = $this->workload->get_emp($row['emp_id']);
                ;
                $team = $emp_name['name'];
                $emp = ucwords(strtolower($emp_name['name']));
                $grouped_data[$team][$emp][] = $row;
            }
            foreach ($grouped_data as $team_name => $employees) {
                foreach ($employees as $emp_name => $tasks) {
                    $first_task = true;

                    foreach ($tasks as $entry) {
                        $tbl .= '<tr style="font-size: 8px;" nobr="true">';

                        foreach ($headers as $key => $_) {
                            $width = $adjusted_column_widths[$key];
                            $style = 'width:' . $width . 'mm;';

                            switch ($key) {

                                case 0: // Emp Name
                                    if ($first_task) {
                                        $tbl .= '<td style="' . $style . '">' . $emp_name . '</td>';
                                        $first_task = false;
                                    } else {
                                        $tbl .= '<td style="' . $style . '"></td>';
                                    }
                                    break;
                                case 1:
                                    $tbl .= '<td style="' . $style . '">' . (ucwords(strtolower($entry['user_type'])) ?: 'n/a') . '</td>';
                                    break;
                                case 2:
                                    $tbl .= '<td style="' . $style . '">' . (ucwords(strtolower($entry['add_pos'])) ?: 'n/a') . '</td>';
                                    break;

                                case 3:
                                    $tbl .= '<td style="' . $style . '">' . $entry['mod_abbr'] . '</td>';
                                    break;

                                case 4:
                                    $tbl .= '<td style="' . $style . '">' . $entry['sub_mod_name'] . '</td>';
                                    break;

                                case 5:
                                    $tbl .= '<td style="' . $style . '">' . (!empty($entry['sub_mod_menu']) ? $entry['sub_mod_menu'] : 'n/a') . '</td>';
                                    break;
                                case 6:
                                    $tbl .= '<td style="' . $style . '">' . (!empty($entry['desc']) ? $entry['desc'] : 'n/a') . '</td>';
                                    break;

                                case 7:
                                    $tbl .= '<td style="' . $style . '">' . (!empty($entry['remarks']) ? $entry['remarks'] : 'n/a') . '</td>';
                                    break;

                                case 8:
                                    $tbl .= '<td style="' . $style . '">' . $entry['status'] . '</td>';
                                    break;

                                case 9:
                                    $tbl .= '<td style="' . $style . '">' . (!empty($entry['date_added']) ? date('M j, Y', strtotime($entry['date_added'])) : 'n/a') . '</td>';
                                    break;
                                default:
                                    $tbl .= '<td style="' . $style . '">n/a</td>';
                            }
                        }

                        $tbl .= '</tr>';
                    }
                }
            }

            $tbl .= '</tbody></table>';
            $pdf->writeHTML($tbl, true, false, false, false, '');
            $pdf->Output('workload.pdf', 'I');
        }

        $workload = $this->workload->getWorkloads($date_range, $team_id, $module_id, $status, 0, 10000, 0, 'asc', '');


        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
        $logo = FCPATH . 'assets/images/sys.png'; // Absolute path required
        $logo_width = 50;
        $x = 15;
        $y = 10;

        $title = 'IT SYSDEV WORKLOAD';
        $subTitle = "System Generated | " . date('F j, Y');
        $headerTextColor = [0, 0, 0];

        // PDF settings
        $pdf->SetTitle($title);
        $pdf->setCompression(true);
        $pdf->SetMargins(10, 25, 10);
        $pdf->SetHeaderMargin(10);
        $pdf->SetFooterMargin(13);
        $pdf->setPrintFooter(true);
        $pdf->setFooterFont(['helvetica', '', 7]);
        $pdf->SetFont('helvetica', '', 7);
        $pdf->SetAutoPageBreak(TRUE, 14);

        // Add first page
        $pdf->AddPage();

        // Draw header on first page
        if (file_exists($logo)) {
            $pdf->Image($logo, $x, $y, $logo_width, 0, 'PNG');

            $pdf->SetFont('helvetica', 'B', 14);
            $pdf->SetTextColorArray($headerTextColor);
            $pageWidth = $pdf->GetPageWidth();
            $titleWidth = $pdf->GetStringWidth($title);
            $titleX = ($pageWidth - $titleWidth) / 2;
            $pdf->SetXY($titleX, $y);
            $pdf->Cell($titleWidth, 5, $title, 0, 1, 'C');

            $pdf->SetFont('helvetica', '', 9);
            $subTitleWidth = $pdf->GetStringWidth($subTitle);
            $subTitleX = ($pageWidth - $subTitleWidth) / 2;
            $pdf->SetX($subTitleX);
            $pdf->Cell($subTitleWidth, 5, $subTitle, 0, 1, 'C');
        }


        if (empty($workload)) {

            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->Cell(0, 10, 'No workload setup or data available for this workload.', 0, 1, 'C');
            $pdf->Output('workload_report.pdf', 'I');
            return;
        }
        // Column definitions
        $columns = [
            0 => 'Name',
            1 => 'Position',
            2 => 'Other Position',
            3 => 'Module',
            4 => 'Submodule',
            5 => 'Sub Menu',
            6 => 'Description',
            7 => 'Remarks',
            8 => 'Status',
            9 => 'Added',


        ];

        $column_widths = [
            0 => 25,
            1 => 28,
            2 => 20,
            3 => 20,
            4 => 20,
            5 => 22,
            6 => 35,
            7 => 35,
            8 => 12,
            9 => 20,

        ];

        // Filter visible headers
        $headers = array_intersect_key($columns, array_flip($visible_columns));

        // Compute total width and scale factor
        $total_width = 278; // A4 Landscape with ~20mm margins
        $total_default_width = array_sum(array_intersect_key($column_widths, $headers));
        $scaling_ratio = $total_width / $total_default_width;

        $adjusted_column_widths = [];
        foreach ($headers as $key => $_) {
            $base = isset($column_widths[$key]) ? $column_widths[$key] : 15;
            $adjusted_column_widths[$key] = round($base * $scaling_ratio, 2);
        }

        $tbl = '<table border="1" cellpadding="4"><thead><tr>';
        foreach ($headers as $key => $col) {
            $width = $adjusted_column_widths[$key];
            $tbl .= '<th style="background-color:#2f2f2f; color:#ffffff; text-align:center; width:' . $width . 'mm;">' . $col . '</th>';
        }
        $tbl .= '</tr></thead><tbody>';
        $last_emp_name = '';
        // Group data by team_name
        $grouped_data = [];
        foreach ($workload as $row) {

            $emp_name = $this->workload->get_emp($row['emp_id']);
            ;
            $team = $emp_name['name'];
            $emp = ucwords(strtolower($emp_name['name']));
            $grouped_data[$team][$emp][] = $row;
        }
        foreach ($grouped_data as $team_name => $employees) {
            foreach ($employees as $emp_name => $tasks) {
                $first_task = true;

                foreach ($tasks as $entry) {
                    $tbl .= '<tr style="font-size: 8px;" nobr="true">';

                    foreach ($headers as $key => $_) {
                        $width = $adjusted_column_widths[$key];
                        $style = 'width:' . $width . 'mm;';

                        switch ($key) {

                            case 0: // Emp Name
                                if ($first_task) {
                                    $tbl .= '<td style="' . $style . '">' . $emp_name . '</td>';
                                    $first_task = false;
                                } else {
                                    $tbl .= '<td style="' . $style . '"></td>';
                                }
                                break;
                            case 1:
                                $tbl .= '<td style="' . $style . '">' . (ucwords(strtolower($entry['user_type'])) ?: 'n/a') . '</td>';
                                break;
                            case 2:
                                $tbl .= '<td style="' . $style . '">' . (ucwords(strtolower($entry['add_pos'])) ?: 'n/a') . '</td>';
                                break;

                            case 3:
                                $tbl .= '<td style="' . $style . '">' . $entry['mod_abbr'] . '</td>';
                                break;

                            case 4:
                                $tbl .= '<td style="' . $style . '">' . $entry['sub_mod_name'] . '</td>';
                                break;

                            case 5:
                                $tbl .= '<td style="' . $style . '">' . (!empty($entry['sub_mod_menu']) ? $entry['sub_mod_menu'] : 'n/a') . '</td>';
                                break;
                            case 6:
                                $tbl .= '<td style="' . $style . '">' . (!empty($entry['desc']) ? $entry['desc'] : 'n/a') . '</td>';
                                break;

                            case 7:
                                $tbl .= '<td style="' . $style . '">' . (!empty($entry['remarks']) ? $entry['remarks'] : 'n/a') . '</td>';
                                break;

                            case 8:
                                $tbl .= '<td style="' . $style . '">' . $entry['status'] . '</td>';
                                break;

                            case 9:
                                $tbl .= '<td style="' . $style . '">' . (!empty($entry['date_added']) ? date('M j, Y', strtotime($entry['date_added'])) : 'n/a') . '</td>';
                                break;
                            default:
                                $tbl .= '<td style="' . $style . '">n/a</td>';
                        }
                    }

                    $tbl .= '</tr>';
                }
            }
        }

        $tbl .= '</tbody></table>';
        $pdf->writeHTML($tbl, true, false, false, false, '');
        $pdf->Output('workload.pdf', 'I');
    }

}
