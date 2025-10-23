<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Weekly extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->username == "") {
            redirect('login');
        }
        $this->load->model('Menu/Weekly_mod', 'weekly');
        $this->load->model('Menu/Workload', 'workload');
        $this->load->library('PDF', ['base_url' => base_url()]);
    }
    public function index()
    {
        $this->load->view('_layouts/header');
        $this->load->view('menu/weekly_report');
        $this->load->view('_layouts/footer');
    }

    public function setup_module_weekly()
    {
        $team = $this->input->post('team');
        $module = $this->weekly->get_module_dat($team);
        echo json_encode($module);
    }
    public function weekly_list()
    {
        $status = $this->input->post('status');
        $team = $this->input->post('team');
        $module = $this->input->post('module');
        $sub_module = $this->input->post('sub_module');
        $date_range = $this->input->post('date_range');

        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $order = $this->input->post('order');
        $search_value = $this->input->post('search')['value'];
        $order_column = $order[0]['column'];
        $order_dir = $order[0]['dir'];

        $weekly = $this->weekly->getweekly($status, $date_range, $team, $module, $sub_module, $start, $length, $order_column, $order_dir, $search_value);
        $total_records = $this->weekly->getTotalweekly($status, $date_range, $team, $module, $sub_module, $search_value);

        $formatted_data = [];

        foreach ($weekly as $row) {
            $emp_data = $this->workload->get_emp($row['emp_id']);
            $emp_id = $row['emp_id'];

            $mod_name = ucwords(strtolower($row['mod_name'])) . ' [ <span class="badge bg-info">' . $row['mod_abbr'] . '</span> ]';
            $sub_mod = $row['sub_mod_id'] != 0 ? ucwords(strtolower($row['sub_mod_name'])) : '<span class="badge bg-secondary">N/A</span>';
            $remarks = !empty($row['remarks']) ? ucwords(strtolower($row['remarks'])) : '<span class="badge bg-secondary">N/A</span>';
            $concerns = !empty($row['concerns']) ? ucwords(strtolower($row['concerns'])) : '<span class="badge bg-secondary">N/A</span>';
            $task = !empty($row['task_workload']) ? ucwords(strtolower($row['task_workload'])) : '<span class="badge bg-secondary">N/A</span>';

            if (!isset($formatted_data[$emp_id])) {
                $formatted_data[$emp_id] = [
                    'name' => ucwords(strtolower($emp_data['name'])),
                    'entries' => []
                ];
            }

            $weekl_id= '';
            $get_logs = $this->weekly->get_logs($row['id']);
            if (!empty($get_logs)) {
                $weekl_id = $get_logs[0]['weekly_id'];
            } else {
                $weekl_id = 0;
            }


            if ($weekl_id != 0) {
                $weekly = ' <button type="button" class="btn btn-soft-warning waves-effect waves-light btn-sm" onclick="show_update_logs(' . $weekl_id . ')" data-bs-toggle="modal" data-bs-target="#show_update">
                            <iconify-icon icon="tdesign:chat-bubble-history-filled" class="label-icon align-bottom fs-16"></iconify-icon>
                        </button>';
            } else {
                $weekly = ' <button type="button" class="btn btn-soft-warning waves-effect waves-light btn-sm" onclick="show_update_weekly(\'' . $row['id'] . '\', \'' . $row['weekly_status'] . '\')" data-bs-toggle="modal" data-bs-target="#show_update_weekly">
                            <iconify-icon icon="tdesign:chat-bubble-history-filled" class="label-icon align-bottom fs-16"></iconify-icon>
                        </button>';
            }

            $formatted_data[$emp_id]['entries'][] = [
                'id' => $row['id'],
                'emp_id' => $row['emp_id'],
                'date_range' => $row['date_range'],
                'module' => $mod_name,
                'sub_mod_name' => $sub_mod,
                'task_workload' => $task,
                'concerns' => $concerns,
                'remarks' => $remarks,
                'weekly_status' => $row['weekly_status'],
                'action' => '
                    <div class="hstack gap-1">
                    '.$weekly.'
                        <button type="button" class="btn btn-soft-secondary waves-effect waves-light btn-sm" onclick="edit_weekly_report_content(' . $row['id'] . ')" data-bs-toggle="modal" data-bs-target="#edit_weekly_report">
                            <iconify-icon icon="solar:pen-bold-duotone" class="label-icon align-bottom fs-16"></iconify-icon>
                        </button>
                        <button type="button" class="btn btn-soft-danger waves-effect waves-light btn-sm" onclick="delete_weekly(' . $row['id'] . ')">
                            <iconify-icon icon="solar:trash-bin-minimalistic-bold-duotone" class="label-icon align-bottom fs-16"></iconify-icon>
                        </button>
                    </div>'
            ];
        }

        $result_data = [];
        $shown_emp_ids = [];

        foreach ($formatted_data as $emp_id => $emp_data) {
            $show_emp = !in_array($emp_id, $shown_emp_ids);

            foreach ($emp_data['entries'] as $entry) {
                $result_data[] = [
                    'id' => $entry['id'],
                    'emp_name' => $show_emp ? $emp_data['name'] : '',
                    'date_range' => $entry['date_range'],
                    'module' => $entry['module'],
                    'sub_mod_name' => $entry['sub_mod_name'],
                    'task_workload' => $entry['task_workload'],
                    'concerns' => $entry['concerns'],
                    'remarks' => $entry['remarks'],
                    'weekly_status' => $entry['weekly_status'],
                    'action' => $entry['action'],
                    'emp_id' => $entry['emp_id'],
                ];
                $show_emp = false;
            }

            $shown_emp_ids[] = $emp_id;
        }

        echo json_encode([
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => $total_records,
            "recordsFiltered" => $total_records,
            "data" => $result_data
        ]);
    }

    public function show_update_logs(){
        $weekly_id = $this->input->post('weekly_id');

        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $order = $this->input->post('order');
        $search_value = $this->input->post('search')['value'];
        $order_column = $order[0]['column'];
        $order_dir = $order[0]['dir'];

        $data_logs = $this->weekly->get_log_data($weekly_id, $start, $length, $order_column, $order_dir, $search_value);
        $data = [];

        foreach ($data_logs as $row) {
            $emp_data = $this->workload->get_emp($row['emp_id']);

            if($row['date_ongoing'] == ''){
                $date_ongoing = '<span class="badge bg-info">N/A</span>';
            }else{
                $date_ongoing = date('F d, Y', strtotime($row['date_ongoing']));
            }

            if($row['date_done'] == ''){
                $date_done = '<span class="badge bg-info">N/A</span>';
            }else{
                $date_done = date('F d, Y', strtotime($row['date_done']));
            }

            $data[] = [
                'date_ongoing' =>  $date_ongoing,
                'date_done' => $date_done,
                'name' => $emp_data['name']
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

    public function show_update_weekly()
    {
        $weekly_id = $this->input->post('weekly_id');
        $weekly_status = $this->input->post('weekly_status');

        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $order = $this->input->post('order');
        $search_value = $this->input->post('search')['value'];
        $order_column = $order[0]['column'];
        $order_dir = $order[0]['dir'];

        $data_logs = $this->weekly->get_log_data_weekly($weekly_id, $start, $length, $order_column, $order_dir, $search_value);
        $data = [];

        foreach ($data_logs as $row) {

            if (!empty($row['date_updated']) && strtotime($row['date_updated']) !== false) {
                $date_updated = date('F d, Y', strtotime($row['date_updated']));
            } else {
                $date_updated = '<span class="badge bg-info">N/A</span>';
            }


            if ($weekly_status === 'Pending') {
                $date_ongoing = '<span class="badge bg-info">N/A</span>';
                $date_done = '<span class="badge bg-info">N/A</span>';
            }

            if ($weekly_status === 'Ongoing') {
                $date_ongoing = $date_updated;
                $date_done = '<span class="badge bg-info">N/A</span>';
            } else {
                $date_ongoing = '<span class="badge bg-info">N/A</span>';
            }

            if ($weekly_status === 'Done') {
                $date_done = $date_updated;
                $date_ongoing = '<span class="badge bg-info">N/A</span>';
            } else {
                $date_done = '<span class="badge bg-info">N/A</span>';
            }

            if (!empty($row['added_by'])) {
                $emp_data = $this->workload->get_emp($row['added_by']);
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


    public function submit_weeklyreport()
    {
        $this->load->model('Menu/Deploy_mod', 'deploy');
        $team_id = $this->input->post('team_id');
        $weekly_report = $this->input->post('weekly_report');

        foreach ($weekly_report as $report) {
            $data = [
                'date_range' => $report['date_range'],
                'team_id' => $team_id,
                'emp_id' => $report['emp_id'],
                'mod_id' => $report['module'],
                'sub_mod_id' => $report['sub_module'],
                'task_workload' => $report['task_workload'],
                'concerns' => $report['concerns'],
                'remarks' => $report['remarks'],
                'weekly_status' => $report['status'],
                'date_added' => date('Y-m-d H:i:s'),
                'added_by' => $this->session->emp_id
            ];
            $this->db->insert('weekly_report', $data);

            $modul = $this->deploy->get_module_name($report['module']);
            $module_name = $modul->mod_name;
            $action = '<b>' . $this->session->name . '</b> added a weekly report to <b>' . $report['emp_name'] . ' | ' . $module_name . '</b>';


            if($report['status'] === 'Ongoing'){
                $date_ongoing = date('Y-m-d H:i:s');
                $date_done = '';
            }else{
                $date_ongoing = '';
            }
            if($report['status'] === 'Done'){
                $date_done = date('Y-m-d H:i:s');
                $date_ongoing = '';
            }else{
                $date_done = '';
            }


            $id = $id = $this->db->insert_id();
            $data1 = array(
                'emp_id' => $this->session->emp_id,
                'action' => $action,
                'date_added' => date('Y-m-d H:i:s'),
                'weekly_id' => $id,
                'date_done' => $date_done,
                'date_ongoing' => $date_ongoing
            );
            $this->load->model('Logs', 'logs');
            $this->logs->addLogs($data1);
        }
    }
    public function edit_weekly_report_content()
    {
        $id = $this->input->post('id');
        $weekly = $this->weekly->edit_weekly_report_content($id);
        echo json_encode($weekly);
    }
    public function update_weeklyreport()
    {
        $id = $this->input->post('id');
        $date_range = $this->input->post('date_range');
        $team = $this->input->post('team');
        $emp_id = $this->input->post('emp_id');
        $emp_name = $this->input->post('emp_name');
        $module = $this->input->post('module');
        $sub_module = $this->input->post('sub_module');
        $task_workload = $this->input->post('task_workload');
        $concerns = $this->input->post('concerns');
        $remarks = $this->input->post('remarks');
        $weekly_status = $this->input->post('weekly_status');

        $data = [
            'date_range' => $date_range,
            'team_id' => $team,
            'mod_id' => $module,
            'sub_mod_id' => $sub_module,
            'task_workload' => $task_workload,
            'concerns' => $concerns,
            'remarks' => $remarks,
            'emp_id' => $emp_id,
            'weekly_status' => $weekly_status,
            'date_updated' => date('Y-m-d H:i:s'),
            'added_by' => $this->session->emp_id
        ];
        $this->weekly->update_weekly($data, $id);
        $action = '<b>' . $this->session->name . '</b> updated a weekly report of <b>' . $emp_name . '</b>';

        if($weekly_status === 'Ongoing'){
            $date_ongoing = date('Y-m-d H:i:s');
            $date_done = '';
        }else{
            $date_ongoing = '';
        }
        if($weekly_status === 'Done'){
            $date_done = date('Y-m-d H:i:s');
            $date_ongoing = '';
        }else{
            $date_done = '';
        }
        $data1 = array(
            'emp_id' => $this->session->emp_id,
            'action' => $action,
            'date_added' => date('Y-m-d H:i:s'),
            'weekly_id' => $id,
            'date_done' => $date_done,
            'date_ongoing' => $date_ongoing
        );
        $this->load->model('Logs', 'logs');
        $this->logs->updateLogs($data1, $id);
    }

    public function update_weekly_status()
    {
        $id = $this->input->post('id');
        $weekly_status = $this->input->post('weekly_status');
        $emp_name = $this->input->post('emp_name');

        $emp_data = $this->workload->get_emp($emp_name);


        $this->db->where('id', $id);
        $this->db->set('weekly_status', $weekly_status);
        $this->db->set('date_updated', date('Y-m-d H:i:s'));
        $this->db->set('added_by', $this->session->emp_id);
        $this->db->update('weekly_report');

        $action = '<b>' . $this->session->name . '</b> updated a weekly report status of <b>' . $emp_data['name'] . '</b> to <b>' . $weekly_status . '</b>';


        if($weekly_status === 'Ongoing'){
            $date_ongoing = date('Y-m-d H:i:s');
            $date_done = '';
        }else{
            $date_ongoing = '';
        }
        if($weekly_status === 'Done'){
            $date_done = date('Y-m-d H:i:s');
            $date_ongoing = '';
        }else{
            $date_done = '';
        }
        $data1 = array(
            'emp_id' => $this->session->emp_id,
            'action' => $action,
            'date_added' => date('Y-m-d H:i:s'),
            'weekly_id' => $id,
            'date_done' => $date_done,
            'date_ongoing' => $date_ongoing
        );
        $this->load->model('Logs', 'logs');
        $this->logs->updateLogs($data1, $id);
    }


    public function delete_weekly()
    {
        $id = $this->input->post('id');
        $this->weekly->delete_weekly($id);


        $action = '<b>' . $this->session->name . '</b> deleted a weekly report';
        $data1 = array(
            'emp_id' => $this->session->emp_id,
            'action' => $action,
            'weekly_id' => $id,
            'date_updated' => date('Y-m-d H:i:s'),
        );
        $this->load->model('Logs', 'logs');
        $this->logs->addLogs($data1);


    }

    public function export_pdf()
    {
        $team_id = $this->input->get('team_id');
        $team_name = $this->input->get('team_name');
        $module_name = $this->input->get('module_name');
        $module_id = $this->input->get('module_id');
        $date_range = $this->input->get('date_range');
        $sub_mod_name = $this->input->get('sub_module_name');
        $sub_module_id = $this->input->get('sub_module_id');
        $status = $this->input->get('status');

        $visible_columns = explode(',', $this->input->get('visible_columns'));
        if (!empty($team_id) || !empty($module_id) || !empty($date_range || !empty($sub_module_id))) {

            $weekly_data1 = $this->weekly->getweekly($status, $date_range, $team_id, $module_id, $sub_module_id, 0, 10000, 0, 'asc', '');

            $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
            $logo = FCPATH . 'assets/images/sys.png'; // Absolute path required
            $logo_width = 50;
            $x = 15;
            $y = 10;

            $title = 'IT SYSDEV WEEKLY REPORT';
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
            // Column definitions
            $columns = [
                0 => 'Incharge',
                2 => 'Module',
                3 => 'Submodule',
                4 => 'Task Workload',
                5 => 'Concerns',
                6 => 'Remarks',
                7 => 'Status'
            ];
            $column_widths = [
                0 => 25,
                2 => 20,
                3 => 26,
                4 => 30,
                5 => 50,
                6 => 30,
                7 => 30,

            ];


            $headers = array_intersect_key($columns, array_flip($visible_columns));

            $total_width = 278;
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
            if ($sub_mod_name == 'Select Sub Module') {
                $sub_mod_name = 'n/a';
            }
            $tbl = '
            <div style="margin-bottom: 10px;">
                <h5 style="text-align: left;">Team: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $team_name . '</h5>
                <h5 style="text-align: left;">Module: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $module_name . '</h5>
                <h5 style="text-align: left;">Date Range: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $date_range . '</h5>
                <h5 style="text-align: left;">Submodule: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $sub_mod_name . '</h5>
            </div>
        ';

            $tbl .= '<table border="1" cellpadding="4"><thead><tr>';

            foreach ($headers as $key => $col) {
                $width = $adjusted_column_widths[$key];
                $tbl .= '<th style="background-color:#2f2f2f; color:#ffffff; text-align:center; width:' . $width . 'mm;">' . $col . '</th>';
            }
            $tbl .= '</tr></thead><tbody>';
            $last_emp_name = '';
            $grouped_data = [];
            foreach ($weekly_data1 as $row) {
                $team = $row['team_name'];
                $grouped_data[$team][] = $row;
            }
            $last_emp_id = null;
            foreach ($grouped_data as $team_name => $entries) {
                foreach ($entries as $entry) {
                    $emp_id = $entry['emp_id'];
                    $emp_data = $this->workload->get_emp($emp_id);
                    $current_emp = ucwords(strtolower($emp_data['name']));

                    $tbl .= '<tr style="font-size: 8px;" nobr="true">';
                    foreach ($headers as $key => $_) {
                        $width = $adjusted_column_widths[$key];
                        $style = 'width:' . $width . 'mm;';

                        switch ($key) {
                            case 0: // Incharge
                                if ($emp_id !== $last_emp_id) {
                                    $tbl .= '<td style="' . $style . '">' . $current_emp . '</td>';
                                    $last_emp_id = $emp_id;
                                } else {
                                    $tbl .= '<td style="' . $style . '"></td>';
                                }
                                break;

                            case 2:
                                $tbl .= '<td style="' . $style . '">' . $entry['mod_abbr'] . '</td>';
                                break;

                            case 3:
                                $tbl .= '<td style="' . $style . '">' . (ucwords(strtolower($entry['sub_mod_name'])) ?: 'n/a') . '</td>';
                                break;

                            case 7:
                                $tbl .= '<td style="' . $style . '">' . $entry['weekly_status'] . '</td>';
                                break;
                            case 5:
                                $tbl .= '<td style="' . $style . '">' . $entry['concerns'] . '</td>';
                                break;

                            case 6:
                                $tbl .= '<td style="' . $style . '">' . (ucwords(strtolower($entry['remarks'])) ?: 'n/a') . '</td>';
                                break;

                            case 4:
                                $tbl .= '<td style="' . $style . '">' . $entry['task_workload'] . '</td>';
                                break;
                        }
                    }

                    $tbl .= '</tr>';
                }
            }

            $tbl .= '</tbody></table>';
            $pdf->writeHTML($tbl, true, false, false, false, '');
            $pdf->Output('weekly_report.pdf', 'I');
        }

        $weekly_data = $this->weekly->getweekly($status, $date_range, $team_id, $module_id, $sub_module_id, 0, 10000, 0, 'asc', '');

        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);

        $logo = FCPATH . 'assets/images/sys.png'; // Absolute path required
        $logo_width = 50;
        $x = 15;
        $y = 10;

        $title = 'IT SYSDEV WEEKLY REPORT';
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
        // Column definitions
        $columns = [
            0 => 'Team',
            1 => 'Incharge',
            2 => 'Module',
            3 => 'Submodule',
            4 => 'Concerns',
            5 => 'Remarks',
            6 => 'Task Workload',
            7 => 'Status',
        ];
        $column_widths = [
            0 => 25,
            1 => 25,
            2 => 20,
            3 => 26,
            4 => 50,
            5 => 30,
            6 => 30,
            7 => 20,

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

        // Build table
        $tbl = '<table border="1" cellpadding="4"><thead><tr>';
        foreach ($headers as $key => $col) {
            $width = $adjusted_column_widths[$key];
            $tbl .= '<th style="background-color:#2f2f2f; color:#ffffff; text-align:center; width:' . $width . 'mm;">' . $col . '</th>';
        }
        $tbl .= '</tr></thead><tbody>';
        $last_emp_name = '';
        $last_team_name = '';

        // Group data by team_name
        $grouped_data = [];
        foreach ($weekly_data as $row) {
            $team = $row['team_name'];
            $grouped_data[$team][] = $row;
        }

        foreach ($grouped_data as $team_name => $entries) {
            $rowspan = count($entries); // For future rowspan if needed
            $team_displayed = false;
            $last_emp_name = '';
            foreach ($entries as $entry) {
                $emp_data = $this->workload->get_emp($entry['emp_id']);
                $tbl .= '<tr style="font-size: 8px;" nobr="true">';

                foreach ($headers as $key => $_) {
                    $width = $adjusted_column_widths[$key];
                    $style = 'width:' . $width . 'mm;';

                    switch ($key) {
                        case 0: // Team Name
                            if (!$team_displayed) {
                                $tbl .= '<td style="' . $style . '" rowspan="' . $rowspan . '">' . ucwords(strtolower($team_name)) . '</td>';
                                $team_displayed = true;
                            }
                            break;
                        case 1:
                            $current_emp = ucwords(strtolower($emp_data['name']));
                            if ($current_emp != $last_emp_name) {
                                $tbl .= '<td style="' . $style . '">' . $current_emp . '</td>';
                                $last_emp_name = $current_emp;
                            } else {
                                $tbl .= '<td style="' . $style . '"></td>';
                            }
                            break;

                        case 2:
                            $tbl .= '<td style="' . $style . '">' . $entry['mod_abbr'] . ' </td>';
                            break;

                        case 3:
                            $tbl .= '<td style="' . $style . '">' . (ucwords(strtolower($entry['sub_mod_name'])) ?: 'n/a') . '</td>';
                            break;

                        case 7:
                            $tbl .= '<td style="' . $style . '">' . $entry['weekly_status'] . '</td>';
                            break;
                        case 5:
                            $tbl .= '<td style="' . $style . '">' . $entry['concerns'] . '</td>';
                            break;

                        case 6:
                            $tbl .= '<td style="' . $style . '">' . (ucwords(strtolower($entry['remarks'])) ?: 'n/a') . '</td>';
                            break;

                        case 4:
                            $tbl .= '<td style="' . $style . '">' . $entry['task_workload'] . '</td>';
                            break;
                    }
                }

                $tbl .= '</tr>';
            }
        }


        $tbl .= '</tbody></table>';
        $pdf->writeHTML($tbl, true, false, false, false, '');
        $pdf->Output('gantt_report.pdf', 'I');

    }
}