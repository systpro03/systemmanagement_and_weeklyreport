<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gantt extends CI_Controller
{

    private $base_url;
    function __construct()
    {
        parent::__construct($base_url = '');
        if ($this->session->username == "") {
            redirect('login');
        }
        $this->base_url = $base_url;
        $this->load->model('Menu/Gantt_mod', 'gantt');
        $this->load->library('PDF', ['base_url' => base_url()]);
    }
    public function index()
    {
        $this->load->view('_layouts/header');
        $this->load->view('menu/gantt');
        $this->load->view('_layouts/footer');
    }
    public function setup_module_gantt()
    {
        $team = $this->input->post('team');
        $module = $this->gantt->get_module_dat($team);
        echo json_encode($module);
    }
    public function gantt_list()
    {
        $team_id = $this->input->post('team_id');
        $module_id = $this->input->post('module');
        $date_range = $this->input->post('date_range_filter');

        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $order = $this->input->post('order');
        $search_value = $this->input->post('search')['value'];
        $order_column = $order[0]['column'];
        $order_dir = $order[0]['dir'];

        $module = $this->gantt->getGanttData($date_range, $module_id, $team_id, $start, $length, $order_column, $order_dir, $search_value);
        $total_records = $this->gantt->getTotalGantt($date_range, $module_id, $team_id, $search_value);

        $data = [];

        $date_implem = '';
        foreach ($module as $row) {
            if ($row['sub_mod_name'] == null) {
                $sub_module = '<span class="badge bg-info">N/A</span>';
            } else {
                $sub_module = ucwords(strtolower($row['sub_mod_name']));
            }
           if (!empty($row['date_implem'])) {
                $date_range = explode(' to ', $row['date_implem']);
                $target_date = DateTime::createFromFormat('F j, Y', trim($date_range[0]));
                if (!$target_date) {
                    $target_date = DateTime::createFromFormat('Y-m-d', trim($date_range[0]));
                }

                $date_range_start = explode(' to ', $row['date_req']);
                $start_date = DateTime::createFromFormat('F j, Y', trim($date_range_start[0]));
                if (!$start_date) {
                    $start_date = DateTime::createFromFormat('Y-m-d', trim($date_range_start[0]));
                }

                $now = new DateTime();

                if ($target_date && $start_date) {
                    $start_ts  = $start_date->setTime(0, 0)->getTimestamp();
                    $target_ts = $target_date->setTime(0, 0)->getTimestamp();
                    $now_ts    = $now->setTime(0, 0)->getTimestamp();

                    if ($now_ts >= $target_ts) {
                        $progress = 100;
                        $status = '<span class="badge bg-success">Implementation Date Reached</span>';
                        $label_html = '';
                    } elseif ($now_ts <= $start_ts) {
                        $progress = 0;
                        $status = '<span class="badge bg-secondary">Not Started Yet</span>';
                        $label_html = '';
                    } else {
                        $total_seconds   = max(1, $target_ts - $start_ts);
                        $elapsed_seconds = max(0, $now_ts - $start_ts);
                        $progress        = min(100, round(($elapsed_seconds / $total_seconds) * 100));

                        $days_left = ceil(($target_ts - $now_ts) / (60 * 60 * 24));
                        $status = '<span class="badge bg-warning">Approaching Implementation</span>';
                        $label_html = '<div class="label">' . $days_left . ' day' . ($days_left > 1 ? 's' : '') . ' left</div>';
                    }

                    $formatted_target_date = $target_date->format('F d, Y');
                    $date_display = $formatted_target_date;

                    $progress_bar_class = $progress >= 100 ? 'bg-success' : 'bg-info';

                    $date_implem = '
                    <div>
                        ' . $date_display . ' - ' . $status . '
                        <div class="d-flex align-items-center pb-2">
                            <div class="flex-grow-1 mt-1">
                                <div class="progress progress-label">
                                    <div class="progress-bar ' . $progress_bar_class . ' progress-bar-striped progress-bar-animated" 
                                        role="progressbar" 
                                        style="width: ' . $progress . '%;" 
                                        aria-valuenow="' . $progress . '" aria-valuemin="0" aria-valuemax="100">
                                        ' . ($progress < 100 ? $progress . '% ' . $label_html : '') . '
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
                }
            } else {
                $date_implem = '<span class="badge bg-secondary">N/A</span>';
            }

            if ($row['date_parallel'] != null) {
                $date_parallel = $row['date_parallel'];
            } else {
                $date_parallel = '<span class="badge bg-info">N/A</span>';
            }

            if ($row['date_start'] == null) {
                $date_start = '<span class="badge bg-info">N/A</span>';
            } else {
                $date_start = $row['date_start'];
            }
            if ($row['date_end'] == null) {
                $date_end = '<span class="badge bg-info">N/A</span>';
            } else {
                $date_end = $row['date_end'];
            }

            if ($row['date_testing'] == null) {
                $date_testing = '<span class="badge bg-info">N/A</span>';
            } else {
                $date_testing = $row['date_testing'];
            }

            if ($row['date_req'] == null) {
                $date_req = '<span class="badge bg-info">N/A</span>';
            }else{
                $date_req = $row['date_req'];
            }

            $data[] = [
                'team_name' => ucwords(strtolower($row['team_name'])),
                'emp_name' => ucwords(strtolower($row['emp_name'])),
                'mod_name' => ucwords(strtolower($row['mod_name'])) . ' - ' . '<span class="badge bg-info">' . $row['mod_abbr'] . '</span>',
                'sub_mod_name' => $sub_module,
                'desc' => $row['desc'],
                'date_req' => $date_req,
                'date_parallel' => $date_parallel,
                'date_implem' => $date_implem,
                'date_start' => $date_start,
                'date_end' => $date_end,
                'date_testing' => $date_testing,
                'date_added' => date('F d, Y', strtotime($row['date_added'])),
                'action' => '
                    <div class="hstack gap-1 d-flex justify-content-center">
                        <button class="btn btn-sm btn-soft-info waves-effect waves-light" onclick="edit_gantt(' . $row['gantt_id'] . ')" data-bs-toggle="modal" data-bs-target="#edit_submodule"><iconify-icon icon="solar:pen-bold-duotone" class=" align-bottom fs-16"></iconify-icon></button>
                        <button class="btn btn-sm btn-soft-danger waves-effect waves-light" onclick="delete_gantt(' . $row['gantt_id'] . ')"><iconify-icon icon="solar:trash-bin-minimalistic-bold-duotone" class=" align-bottom fs-16"></iconify-icon></button>
                    </div>'
            ];
        }

        $output = [
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => $total_records,
            "recordsFiltered" => $total_records,
            "data" => $data
        ];
        echo json_encode($output);
    }
    public function submit_gantt()
    {
        $team = $this->input->post('team');
        $team_name = $this->input->post('team_name');
        $module_name = $this->input->post('module_name');
        $emp_id = $this->input->post('emp_id');
        $emp_name = $this->input->post('emp_name');
        $module = $this->input->post('module');
        $module_name = $this->input->post('module_name');
        $sub_module = $this->input->post('sub_module');
        $description = $this->input->post('description');
        $date_request = $this->input->post('date_request');
        $date_parallel = $this->input->post('date_parallel');
        $date_implementation = $this->input->post('date_implementation');
        $date_start = $this->input->post('date_start');
        $date_end = $this->input->post('date_end');
        $date_testing = $this->input->post('date_testing');
        $data = [];

        if ($date_request === "" || $date_request === null) {
            $date_request1 = '';
        }else{
            $date_request1 = date('F j, Y', strtotime($date_request));
        }

        if ($date_parallel === "") {
            $date_parallel = '';
        }

        if ($date_implementation === "") {
            $date_implementation = '';
        }

        if ($date_start === "") {
            $date_start = '';
        }

        if ($date_end === "") {
            $date_end = '';
        }


        $data = [
            'team_id' => $team,
            'emp_id' => $emp_id,
            'emp_name' => $emp_name,
            'mod_id' => $module,
            'sub_mod_id' => $sub_module,
            'desc' => $description,
            'date_req' => $date_request1,
            'date_parallel' => $date_parallel,
            'date_implem' => $date_implementation,
            'date_start' => $date_start,
            'date_end' => $date_end,
            'date_added' => date('Y-m-d H:i:s'),
            'date_testing' => $date_testing
        ];
        $this->gantt->submit_gantt($data);

        $action = '<b>' . $this->session->name . '</b> added a gantt for <b>' . $team_name . ' | ' . $module_name . '</b>';

        $data1 = array(
            'emp_id' => $this->session->emp_id,
            'action' => $action,
            'date_added' => date('Y-m-d H:i:s'),
        );
        $this->load->model('Logs', 'logs');
        $this->logs->addLogs($data1);
    }

    public function edit_gantt_content()
    {
        $id = $this->input->post('id');
        $data = $this->gantt->get_gant_data($id);
        echo json_encode($data);
    }

    public function update_gantt()
    {
        $id             = $this->input->post('id');
        $team           = $this->input->post('team');
        $team_name      = $this->input->post('team_name');
        $module_name    = $this->input->post('module_name');
        $emp_id         = $this->input->post('emp_id');
        $emp_name       = $this->input->post('emp_name');
        $module         = $this->input->post('module');
        $sub_module     = $this->input->post('sub_module');
        $description    = $this->input->post('description');
        $date_request   = $this->input->post('date_request');
        $date_parallel  = $this->input->post('date_parallel');
        $date_implementation = $this->input->post('date_implementation');
        $date_start     = $this->input->post('date_start');
        $date_end       = $this->input->post('date_end');
        $date_testing   = $this->input->post('date_testing');

        $data = [];

        if ($date_request === "") {
            $date_request = '';
        } else {
            $date_request = date('F d, Y', strtotime($date_request));
        }

        if ($date_parallel === "") {
            $date_parallel = '';
        }

        if ($date_implementation === "") {
            $date_implementation = '';
        }

        if ($date_start === "") {
            $date_start = '';
        } else {
            $date_start = date('F d, Y', strtotime($date_start));
        }

        if ($date_end === "") {
            $date_end = '';
        } else {
            $date_end = date('F d, Y', strtotime($date_end));
        }

        $data = [
            'team_id' => $team,
            'emp_id' => $emp_id,
            'emp_name' => $emp_name,
            'mod_id' => $module,
            'sub_mod_id' => $sub_module,
            'desc' => $description,
            'date_req' => $date_request,
            'date_parallel' => $date_parallel,
            'date_implem' => $date_implementation,
            'date_start' => $date_start,
            'date_end' => $date_end,
            'date_updated' => date('Y-m-d H:i:s'),
            'date_testing' => $date_testing
        ];
        $this->gantt->update_gantt($data, $id);
        $action = '<b>' . $this->session->name . '</b> updated a gantt for <b>' . $team_name . ' | ' . $module_name . '</b>';

        $data1 = array(
            'emp_id' => $this->session->emp_id,
            'action' => $action,
            'date_updated' => date('Y-m-d H:i:s'),
        );
        $this->load->model('Logs', 'logs');
        $this->logs->addLogs($data1);
    }

    public function delete_gantt()
    {
        $id = $this->input->post('id');
        $this->gantt->delete_gantt($id);
    }

    public function export_pdf()
    {
        $team_id = $this->input->get('team_id');
        $team_name = $this->input->get('team_name');
        $module_name = $this->input->get('module_name');
        $module_id = $this->input->get('module_id');
        $date_range = $this->input->get('date_range');
        $visible_columns = explode(',', $this->input->get('visible_columns'));
        $visible_columns[] = '11';
        if (!empty($team_id) || !empty($module_id) || !empty($date_range)) {

            $gantt_data1 = $this->gantt->getGanttData($date_range, $module_id, $team_id, 0, 10000, 0, 'asc', '');
            usort($gantt_data1, function ($a, $b) {
                return strcmp(strtolower($a['emp_name']), strtolower($b['emp_name']));
            });
            $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
            $logo = FCPATH . 'assets/images/sys.png'; // Absolute path required
            $logo_width = 50;
            $x = 15;
            $y = 10;

            $title = 'IT SYSDEV GANTT CHART';
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
                // 0 => 'Team',
                1 => 'Incharge',
                // 2 => 'Module',
                3 => 'Submodule',
                4 => 'Description',
                5 => 'Requested',
                6 => 'Parallel',
                8 => 'Start',
                9 => 'End',
                10 => 'Testing',
                11 => 'Days',
                7 => 'Implem',


            ];

            $column_widths = [
                // 0 => 20,
                1 => 25,
                // 2 => 20,
                3 => 26,
                4 => 50,
                5 => 22,
                6 => 20,
                8 => 20,
                9 => 20,
                10 => 20,
                11 => 15,
                7 => 25

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
            foreach ($gantt_data1 as $row) {
                $team = $row['emp_name'];
                $emp = ucwords(strtolower($row['emp_name']));
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

                                case 1: // Emp Name
                                    if ($first_task) {
                                        $tbl .= '<td style="' . $style . '">' . $emp_name . '</td>';
                                        $first_task = false;
                                    } else {
                                        $tbl .= '<td style="' . $style . '"></td>';
                                    }
                                    break;

                                case 3:
                                    $tbl .= '<td style="' . $style . '">' . (ucwords(strtolower($entry['sub_mod_name'])) ?: 'n/a') . '</td>';
                                    break;

                                case 4:
                                    $tbl .= '<td style="' . $style . '">' . $entry['desc'] . '</td>';
                                    break;

                                case 5:
                                    $tbl .= '<td style="' . $style . '">' . (!empty($entry['date_req']) ? date('M j, Y', strtotime($entry['date_req'])) : 'n/a') . '</td>';
                                    break;

                                case 6:
                                    $tbl .= '<td style="' . $style . '">' . (!empty($entry['date_parallel']) ? $entry['date_parallel'] : 'n/a') . '</td>';
                                    break;

                                case 7:
                                    if (!empty($entry['date_implem'])) {
                                        $date_range = explode(' to ', $entry['date_implem']);
                                        $format = 'F j, Y';

                                        $target_date = DateTime::createFromFormat($format, trim($date_range[0]));
                                        $today = new DateTime();

                                        if ($target_date && $today) {
                                            $today_ts = $today->setTime(0, 0)->getTimestamp();
                                            $target_ts = $target_date->setTime(0, 0)->getTimestamp();

                                            if ($today_ts >= $target_ts) {
                                                $status = '<span style="color: green;">Implementation Date Reached</span>';
                                                $label_html = '';
                                            } else {
                                                $days_left = ceil(($target_ts - time()) / (60 * 60 * 24));
                                                $status = '<span style="color: blue;">Approaching Implementation</span>';
                                            }

                                            $formatted_target_date = $target_date->format('F d, Y');

                                            $date_implem_html = '
                                        <div>
                                            ' . $formatted_target_date . ' - ' . $status . '
                                        </div>';

                                            $tbl .= '<td style="' . $style . '">' . $date_implem_html . '</td>';
                                        } else {
                                            $tbl .= '<td style="' . $style . '">Invalid Date</td>';
                                        }
                                    } else {
                                        $tbl .= '<td style="' . $style . '">n/a</td>';
                                    }

                                    break;

                                case 8:
                                    $tbl .= '<td style="' . $style . '">' . (!empty($entry['date_start']) ? date('M j, Y', strtotime($entry['date_start'])) : 'n/a') . '</td>';
                                    break;

                                case 9:
                                    $tbl .= '<td style="' . $style . '">' . (!empty($entry['date_end']) ? date('M j, Y', strtotime($entry['date_end'])) : 'n/a') . '</td>';
                                    break;

                                case 10:
                                    if (!empty($entry['date_testing'])) {
                                        $testing_dates = explode(' to ', $entry['date_testing']);
                                        $format_in = 'F j, Y';
                                        $format_out = 'M. j, Y';

                                        $formatted = [];
                                        foreach ($testing_dates as $date) {
                                            $dt = DateTime::createFromFormat($format_in, trim($date));
                                            $formatted[] = $dt ? $dt->format($format_out) : 'Invalid date';
                                        }

                                        $display = count($formatted) === 2
                                            ? $formatted[0] . ' to ' . $formatted[1]
                                            : $formatted[0];

                                        $tbl .= '<td style="' . $style . '">' . $display . '</td>';
                                    } else {
                                        $tbl .= '<td style="' . $style . '">n/a</td>';
                                    }
                                    break;

                                case 11:
                                    if (!empty($entry['date_implem'])) {
                                        $implem_ts = strtotime($entry['date_implem']);
                                        $now_ts = strtotime(date('Y-m-d'));
                                        if ($implem_ts < $now_ts) {
                                            $tbl .= '<td style="color: green; ' . $style . '">Done</td>';
                                        } else {
                                            $days_left = ceil(($implem_ts - $now_ts) / (60 * 60 * 24));
                                            $tbl .= '<td style="' . $style . '"><span style="color: red;">' . $days_left . '</span> | day(s) left</td>';
                                        }
                                    } else {
                                        $tbl .= '<td style="' . $style . '">n/a</td>';
                                    }
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
            $pdf->Output('gantt_report.pdf', 'I');
        }

        $gantt_data = $this->gantt->getGanttData($date_range, $module_id, $team_id, 0, 10000, 0, 'asc', '');
        if (empty($gantt_data)) {

            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->Cell(0, 10, 'No Gantt setup or data available for this module.', 0, 1, 'C');
            $pdf->Output('gantt_report.pdf', 'I');
            return; // End the function early
        }
        usort($gantt_data, function ($a, $b) {
            return strcmp(strtolower($a['emp_name']), strtolower($b['emp_name']));
        });
        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);

        $logo = FCPATH . 'assets/images/sys.png'; // Absolute path required
        $logo_width = 50;
        $x = 15;
        $y = 10;

        $title = 'IT SYSDEV GANTT CHART';
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
            4 => 'Description',
            5 => 'Requested',
            6 => 'Parallel',
            8 => 'Start',
            9 => 'End',
            10 => 'Testing',
            11 => 'Days',
            7 => 'Implem'

        ];

        $column_widths = [
            0 => 20,
            1 => 25,
            2 => 20,
            3 => 26,
            4 => 50,
            5 => 22,
            6 => 20,
            8 => 20,
            9 => 20,
            10 => 20,
            11 => 15,
            7 => 25

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
        foreach ($gantt_data as $row) {
            $team = $row['team_name'];
            $grouped_data[$team][] = $row;
        }

        // Build table body
        foreach ($grouped_data as $team_name => $entries) {
            $rowspan = count($entries); // For future rowspan if needed
            $team_displayed = false;
            $last_emp_name = '';

            foreach ($entries as $entry) {
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

                        case 1: // Emp Name
                            $current_emp = ucwords(strtolower($entry['emp_name']));
                            if ($current_emp != $last_emp_name) {
                                $tbl .= '<td style="' . $style . '">' . $current_emp . '</td>';
                                $last_emp_name = $current_emp;
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

                        case 4:
                            $tbl .= '<td style="' . $style . '">' . $entry['desc'] . '</td>';
                            break;

                        case 5:
                            $tbl .= '<td style="' . $style . '">' . (!empty($entry['date_req']) ? date('M j, Y', strtotime($entry['date_req'])) : 'n/a') . '</td>';
                            break;

                        case 6:
                            $tbl .= '<td style="' . $style . '">' . (!empty($entry['date_parallel']) ? $entry['date_parallel'] : 'n/a') . '</td>';
                            break;

                        case 7:
                            if (!empty($entry['date_implem'])) {
                                $date_range = explode(' to ', $entry['date_implem']);
                                $format = 'F j, Y';

                                $target_date = DateTime::createFromFormat($format, trim($date_range[0]));
                                $today = new DateTime();

                                if ($target_date && $today) {
                                    $today_ts = $today->setTime(0, 0)->getTimestamp();
                                    $target_ts = $target_date->setTime(0, 0)->getTimestamp();

                                    if ($today_ts >= $target_ts) {
                                        $status = '<span style="color: green;">Implementation Date Reached</span>';
                                        $label_html = '';
                                    } else {
                                        $days_left = ceil(($target_ts - time()) / (60 * 60 * 24));
                                        $status = '<span style="color: blue;">Approaching Implementation</span>';
                                    }

                                    $formatted_target_date = $target_date->format('F d, Y');

                                    $date_implem_html = '
                                        <div>
                                            ' . $formatted_target_date . ' - ' . $status . '
                                        </div>';

                                    $tbl .= '<td style="' . $style . '">' . $date_implem_html . '</td>';
                                } else {
                                    $tbl .= '<td style="' . $style . '">Invalid Date</td>';
                                }
                            } else {
                                $tbl .= '<td style="' . $style . '">n/a</td>';
                            }

                            break;

                        case 11:
                            if (!empty($entry['date_implem'])) {
                                $implem_ts = strtotime($entry['date_implem']);
                                $now_ts = strtotime(date('Y-m-d'));
                                if ($implem_ts < $now_ts) {
                                    $tbl .= '<td style="color: green; ' . $style . '">Done</td>';
                                } else {
                                    $days_left = ceil(($implem_ts - $now_ts) / (60 * 60 * 24));
                                    $tbl .= '<td style="' . $style . '">' . '<span style="color: red;">' . $days_left . '</span>' . ' | day(s) left</td>';
                                }
                            } else {
                                $tbl .= '<td style="' . $style . '">n/a</td>';
                            }
                            break;

                        case 8:
                            $tbl .= '<td style="' . $style . '">' . (!empty($entry['date_start']) ? date('M j, Y', strtotime($entry['date_start'])) : 'n/a') . '</td>';
                            break;

                        case 9:
                            $tbl .= '<td style="' . $style . '">' . (!empty($entry['date_end']) ? date('M j, Y', strtotime($entry['date_end'])) : 'n/a') . '</td>';
                            break;

                        case 10:
                            if (!empty($entry['date_testing'])) {
                                $testing_dates = explode(' to ', $entry['date_testing']);
                                $format_in = 'F j, Y';
                                $format_out = 'M. j, Y';

                                $formatted = [];
                                foreach ($testing_dates as $date) {
                                    $dt = DateTime::createFromFormat($format_in, trim($date));
                                    $formatted[] = $dt ? $dt->format($format_out) : 'Invalid date';
                                }

                                $display = count($formatted) === 2
                                    ? $formatted[0] . ' to ' . $formatted[1]
                                    : $formatted[0];

                                $tbl .= '<td style="' . $style . '">' . $display . '</td>';
                            } else {
                                $tbl .= '<td style="' . $style . '">n/a</td>';
                            }
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

    public function export_pdf2()
    {
        $team_id = $this->input->get('team_id');
        $team_name = $this->input->get('team_name');
        $module_id = $this->input->get('module_id');
        $module_name = $this->input->get('module_name');
        $emp_id = explode(',', $this->input->get('emp_id'));

        $gantt_data = $this->gantt->getGanttData2($emp_id, $module_id, $team_id);

        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
        $logo = FCPATH . 'assets/images/sys.png';
        $logo_width = 50;
        $x = 15;
        $y = 10;

        $title = 'IT SYSDEV GANTT CHART';
        $subTitle = "System Generated | " . date('F j, Y');
        $headerTextColor = [0, 0, 0];

        $pdf->SetTitle($title);
        $pdf->setCompression(true);
        $pdf->SetMargins(10, 21, 10);
        $pdf->SetHeaderMargin(15);
        $pdf->SetFooterMargin(13);
        $pdf->setPrintFooter(true);
        $pdf->setFooterFont(['helvetica', '', 7]);
        $pdf->SetFont('helvetica', '', 7);
        $pdf->SetAutoPageBreak(TRUE, 14);

        $pdf->AddPage();

        if (file_exists($logo)) {
            $pdf->Image($logo, $x, $y, $logo_width, 0, 'PNG');
            $pdf->SetFont('helvetica', 'B', 14);
            $pdf->SetTextColorArray($headerTextColor);
            $pageWidth = $pdf->GetPageWidth();
            $titleWidth = $pdf->GetStringWidth($title);
            $titleX = ($pageWidth - $titleWidth) / 2;
            $pdf->SetXY($titleX, $y);
            $pdf->Cell($titleWidth, 5, $title, 0, 1, 'C');

            $pdf->SetFont('helvetica', '', 8);
            $subTitleWidth = $pdf->GetStringWidth($subTitle);
            $subTitleX = ($pageWidth - $subTitleWidth) / 2;
            $pdf->SetX($subTitleX);
            $pdf->Cell($subTitleWidth, 5, $subTitle, 0, 1, 'C');
        }

        $pdf->SetFont('helvetica', '', 10);
        if (empty($gantt_data)) {
            $pdf->SetMargins(10, 20, 10);
            $pdf->SetFont('helvetica', 'B', 15);
            $pdf->Cell(0, 10, 'No Gantt setup or data available for this module.', 0, 1, 'C');
            $pdf->Output('gantt_report.pdf', 'I');
            return;
        }

        $team_name = ($team_name === 'Select Team Name') ? 'n/a' : $team_name;
        $module_name = ($module_name === 'Select Module Name') ? 'n/a' : $module_name;

        $columns = [
            3 => 'Submodule',
            4 => 'Description',
            5 => 'Requested',
            6 => 'Parallel',
            8 => 'Start',
            9 => 'End',
            10 => 'Testing',
            11 => 'Days',
            7 => 'Implem',
        ];

        $column_widths = [
            3 => 26,
            4 => 50,
            5 => 22,
            6 => 20,
            8 => 20,
            9 => 20,
            10 => 20,
            11 => 15,
            7 => 25
        ];

        $total_width = 278;
        $scale_ratio = $total_width / array_sum($column_widths);
        foreach ($column_widths as $k => $w) {
            $column_widths[$k] = round($w * $scale_ratio, 2);
        }

        // Group data by employee
        $grouped_data = [];
        foreach ($gantt_data as $entry) {
            $grouped_data[$entry['emp_name']][] = $entry;
        }

        $tbl = '<h2 style="text-align: center; margin-top:20px; font-family: sans-serif;">' . $team_name . '</h2>';
        $tbl .= '<h3 style="text-align: center;">' . $module_name . '</h3>';

        foreach ($grouped_data as $emp_name => $entries) {
            $tbl .= '<h5 style="text-align: left; margin-top:10px;">Incharge: ' . $emp_name . '</h5>';
            $tbl .= '<table border="1" cellpadding="4"><thead><tr>';
            foreach ($columns as $key => $label) {
                $tbl .= '<th style="background-color:#2f2f2f; color:#ffffff; text-align:center; width:' . $column_widths[$key] . 'mm;">' . $label . '</th>';
            }
            $tbl .= '</tr></thead><tbody>';

            foreach ($entries as $entry) {
                $tbl .= '<tr style="font-size: 8px;" nobr="true">';
                foreach ($columns as $key => $_) {
                    $style = 'width:' . $column_widths[$key] . 'mm;';
                    switch ($key) {
                        case 3:
                            $tbl .= '<td style="' . $style . '">' . (ucwords(strtolower($entry['sub_mod_name'])) ?: 'n/a') . '</td>';
                            break;
                        case 4:
                            $tbl .= '<td style="' . $style . '">' . $entry['desc'] . '</td>';
                            break;
                        case 5:
                            $tbl .= '<td style="' . $style . '">' . (!empty($entry['date_req']) ? date('M j, Y', strtotime($entry['date_req'])) : 'n/a') . '</td>';
                            break;
                        case 6:
                            $tbl .= '<td style="' . $style . '">' . ($entry['date_parallel'] ?: 'n/a') . '</td>';
                            break;
                        case 7:
                            if (!empty($entry['date_implem'])) {
                                $date_range = explode(' to ', $entry['date_implem']);
                                $format = 'F j, Y';

                                $target_date = DateTime::createFromFormat($format, trim($date_range[0]));
                                $today = new DateTime();

                                if ($target_date && $today) {
                                    $today_ts = $today->setTime(0, 0)->getTimestamp();
                                    $target_ts = $target_date->setTime(0, 0)->getTimestamp();

                                    if ($today_ts >= $target_ts) {
                                        $status = '<span style="color: green;">Implementation Date Reached</span>';
                                        $label_html = '';
                                    } else {
                                        $days_left = ceil(($target_ts - time()) / (60 * 60 * 24));
                                        $status = '<span style="color: blue;">Approaching Implementation</span>';
                                    }

                                    $formatted_target_date = $target_date->format('F d, Y');

                                    $date_implem_html = '
                                        <div>
                                            ' . $formatted_target_date . ' - ' . $status . '
                                        </div>';

                                    $tbl .= '<td style="' . $style . '">' . $date_implem_html . '</td>';
                                } else {
                                    $tbl .= '<td style="' . $style . '">Invalid Date</td>';
                                }
                            } else {
                                $tbl .= '<td style="' . $style . '">n/a</td>';
                            }

                            break;
                        case 8:
                            $tbl .= '<td style="' . $style . '">' . (!empty($entry['date_start']) ? date('M j, Y', strtotime($entry['date_start'])) : 'n/a') . '</td>';
                            break;
                        case 9:
                            $tbl .= '<td style="' . $style . '">' . (!empty($entry['date_end']) ? date('M j, Y', strtotime($entry['date_end'])) : 'n/a') . '</td>';
                            break;
                        case 10:
                            if (!empty($entry['date_testing'])) {
                                $dates = explode(' to ', $entry['date_testing']);
                                $formatted = array_map(function ($d) {
                                    $dt = DateTime::createFromFormat('F j, Y', trim($d));
                                    return $dt ? $dt->format('M. j, Y') : 'n/a';
                                }, $dates);
                                $tbl .= '<td style="' . $style . '">' . implode(' to ', $formatted) . '</td>';
                            } else {
                                $tbl .= '<td style="' . $style . '">n/a</td>';
                            }
                            break;
                        case 11:
                            if (!empty($entry['date_implem'])) {
                                $implem_ts = strtotime($entry['date_implem']);
                                $now_ts = strtotime(date('Y-m-d'));
                                if ($implem_ts < $now_ts) {
                                    $tbl .= '<td style="color: green; ' . $style . '">Done</td>';
                                } else {
                                    $days_left = ceil(($implem_ts - $now_ts) / (60 * 60 * 24));
                                    $tbl .= '<td style="' . $style . '">' . '<span style="color: red;">' . $days_left . '</span>' . ' | day(s) left</td>';
                                }
                            } else {
                                $tbl .= '<td style="' . $style . '">n/a</td>';
                            }
                            break;
                        default:
                            $tbl .= '<td style="' . $style . '">n/a</td>';
                    }
                }
                $tbl .= '</tr>';
            }

            $tbl .= '</tbody></table><br><br>';
        }

        $pdf->writeHTML($tbl, true, false, false, false, '');
        $pdf->Output('gantt_report.pdf', 'I');
    }



}