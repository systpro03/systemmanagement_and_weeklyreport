<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Existing_System extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if ($this->session->username == "") {
            redirect('login');
        }
        $this->load->model('Menu/File_mod_current', 'file_mod');
        $this->load->model('Menu/File_mod_new', 'file_mod_new');
        $this->load->model('Menu/Deploy_mod', 'deploy');
        $this->load->model('Menu/Workload', 'workload');
    }
    public function index()
    {
        $this->load->view('_layouts/header');
        $this->load->view('menu/existing_system');
        $this->load->view('_layouts/footer');
    }

    public function get_dir()
    {
        $dir = $this->file_mod->get_dir();
        echo json_encode($dir);
    }


    public function get_folders()
    {
        $team = $this->input->post('team');
        $module = $this->input->post('module');
        $sub_module = $this->input->post('sub_module');
        $bu_filter = $this->input->post('bu_filter');

        $folder_path = FCPATH . 'UploadedFiles';  // Correct local path for CI3

        if (!is_dir($folder_path)) {
            echo json_encode(['error' => 'Folder path does not exist.']);
            return;
        }

        $folders = glob($folder_path . '/*', GLOB_ONLYDIR);
        $folders_ = $this->get_directories($folders, $team, $module, $sub_module, $bu_filter);

        echo json_encode($folders_);
    }


    private function get_directories($folders, $team, $module, $sub_module, $bu_filter)
    {
        $folder_data = [];
        $custom_order = ['ISR', 'ATTENDANCE', 'MINUTES', 'WALKTHROUGH', 'FLOWCHART', 'DFD', 'SYSTEM_PROPOSED', 'GANTT_CHART', 'LOCAL_TESTING', 'UAT', 'LIVE_TESTING', 'USER_GUIDE', 'MEMO', 'BUSINESS_ACCEPTANCE', 'REQUEST_LETTER', 'OTHERS'];
        // $query = $this->db->select('dir_name')->order_by('dir_id', 'ASC')->get('directory');
        // $custom_order = array_column($query->result_array(), 'dir_name');
        foreach ($folders as $folder) {
            $entry = basename($folder);

            if (in_array($entry, $custom_order)) {
                $file_data = $this->get_file_count($folder, $team, $module, $sub_module, $bu_filter);

                $folder_data[] = [
                    'name' => $entry,
                    'path' => $folder,
                    'modified' => date("Y-m-d H:i:s", filemtime($folder)),
                    'file_count' => $file_data['count'],
                    'matched_files' => $file_data['matched_files'],
                    'size' => $this->get_folder_size($folder, $team, $module, $sub_module, $bu_filter)
                ];
            }
        }

        usort($folder_data, function ($a, $b) use ($custom_order) {
            $index_a = array_search($a['name'], $custom_order);
            $index_b = array_search($b['name'], $custom_order);
            return $index_a - $index_b;
        });

        return $folder_data;
    }

    private function get_file_count($folder_path, $team, $module, $sub_module, $bu_filter)
    {
        $file_count = 0;
        $matched_files = [];
        $files = scandir($folder_path);

        foreach ($files as $file) {
            if ($file != "." && $file != "..") {
                $file_path = $folder_path . '/' . $file;
                if (is_file($file_path)) {
                    $file_detail = $this->file_mod->get_file_details($file, $team, $module, $sub_module, $bu_filter);
                    if ($file_detail) {
                        $file_count++;
                        $matched_files[] = $file;
                    }
                }
            }
        }

        return [
            'count' => $file_count,
            'matched_files' => $matched_files
        ];
    }

    private function get_folder_size($folder_path, $team, $module, $sub_module, $bu_filter)
    {
        $total_size = 0;
        $files = scandir($folder_path);

        foreach ($files as $file) {
            if ($file != "." && $file != "..") {
                $file_path = $folder_path . '/' . $file;

                if (is_file($file_path)) {
                    $file_detail = $this->file_mod->get_file_details($file, $team, $module, $sub_module, $bu_filter);
                    if ($file_detail) {
                        $total_size += filesize($file_path);
                    }
                } elseif (is_dir($file_path)) {
                    $total_size += $this->get_folder_size($file_path, $team, $module, $sub_module, $bu_filter);
                }
            }
        }

        return $total_size;
    }

    private function get_matched_files($folder_path, $team, $module, $sub_module, $business_unit, $department)
    {
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
            'REQUEST_LETTER' => 'letter_status',
            'OTHERS' => 'others'
        ];

        $matched_files = [];
        $files = glob($folder_path . '/*');

        foreach ($files as $file) {
            if (is_file($file)) {
                $file_detail = $this->file_mod->get_file_details(basename($file), $team, $module, $sub_module, $business_unit);

                if ($file_detail) {
                    // Extract file type based on file name prefix or criteria
                    $file_name = strtoupper(basename($file));
                    $status_key = '';

                    // Match the file name with status field keys
                    foreach ($status_fields as $key => $status_field) {
                        if (strpos($file_name, $key) !== false) {
                            $status_key = $status_field;
                            break;
                        }
                    }

                    $matched_files[] = [
                        'name' => basename($file),
                        'path' => $file,
                        'size' => filesize($file),
                        'modified' => date("M d, Y", filemtime($file)),
                        'uploaded_by' => $file_detail->uploaded_by,
                        'status' => $status_key ? (isset($file_detail->$status_key) ? $file_detail->$status_key : 'Unknown') : 'Not Found',
                        'mod_abbr' => $file_detail->mod_abbr,
                        'date' => $file_detail->date ?: '',
                        'filename' => $file_detail->original_file_name

                    ];
                }
            }
        }

        return $matched_files;
    }

    public function view_folder_modal()
    {

        $folder_name = $this->input->get('folder_name');
        $team = $this->input->get('team');
        $module = $this->input->get('module');
        $sub_module = $this->input->get('sub_module');
        $business_unit = $this->input->get('business_unit');
        $department = $this->input->get('department');

        $folder_path = FCPATH . 'UploadedFiles/' . $folder_name;

        $matched_files = $this->get_matched_files($folder_path, $team, $module, $sub_module, $business_unit, $department);
        $data = [
            'matched_files' => $matched_files
        ];

        echo json_encode($data);
    }


    public function view_folder_modal_server()
    {
        $folder_name = $this->input->get('folder_name');
        $team = $this->input->get('team');
        $module = $this->input->get('module');
        $sub_module = $this->input->get('sub_module');
        $business_unit = $this->input->get('business_unit');
        $department = $this->input->get('department');

        $draw = $this->input->get('draw');
        $start = $this->input->get('start');
        $length = $this->input->get('length');
        $search_value = $this->input->get('search')['value'];

        $folder_path = FCPATH . 'UploadedFiles/' . $folder_name;
        $files = glob($folder_path . '/*');

        // Prepare matched files
        $all_files = [];
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
            'REQUEST_LETTER' => 'letter_status',
            'OTHERS' => 'others'
        ];

        foreach ($files as $file) {
            if (is_file($file)) {
                $file_name = strtoupper(basename($file));
                $file_detail = $this->file_mod->get_file_details(basename($file), $team, $module, $sub_module, $business_unit, $department);
                if ($file_detail) {
                    $status_key = '';
                    foreach ($status_fields as $key => $field) {
                        if (strpos($file_name, $key) !== false) {
                            $status_key = $field;
                            break;
                        }
                    }
                    if($file_detail->$status_key === 'Pending') {
                        $status = 'bg-warning';
                        $ribbon = 'Pending';
                    }elseif($file_detail->$status_key === 'Approve') {
                        $status = 'bg-success';
                        $ribbon = 'Approved';
                    }else{
                        $status = 'bg-info';
                        $ribbon = 'N/a';
                    }
                    
                    if($file_detail->original_file_name == '' || $file_detail->original_file_name == null){
                        $filename = '<span class="badge bg-info">N/A</span>';
                    }else{
                        $filename = ucwords(strtolower($file_detail->original_file_name));
                    }

                    $emp_data = $this->workload->get_emp($file_detail->uploaded_by);


                    $file_extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));

                    if (in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif', 'jfif'])) {
                        $filedata = '
                        <div class="position-relative d-inline-block m-1" style="width: 150px;" title="'.$file_detail->file_name.'" data-bs-toggle="tooltip" data-bs-placement="top">
                            <a style="white-space: normal; word-break: break-word;"  target="_blank">
                                <img src="' . base_url('open_image/' . $folder_name . '/' . basename($file)) . '" class="img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;" />
                            </a>
                            <div class="ribbon '.$status.'" style=" position: absolute; cursor: pointer; top: 0; right: 0;  padding: 2px 8px; border-top-right-radius: 8px; border-bottom-left-radius: 8px; color: #fff;" onclick="previewFileModal(\'' . base_url('open_image/' . $folder_name . '/' . basename($file)) . '\')">
                                '.$ribbon.'
                            </div>
                        </div>';
                        
                        $filedat = '<a class="btn btn-sm btn-secondary waves-effect waves-light material-shadow-none"  onclick="previewFileModal(\'' . base_url('open_image/' . $folder_name . '/' . basename($file)) . '\')"><iconify-icon icon="basil:image-solid" class="align-middle" width="20" height="20"></iconify-icon></a>';
                    }elseif(in_array($file_extension, ['pdf'])) {
                        $filedata = '
                        <div class="position-relative d-inline-block m-1" style="width: 150px;" title="'.$file_detail->file_name.'" data-bs-toggle="tooltip" data-bs-placement="top">
                        <a style="white-space: normal; word-break: break-word;"  target="_blank">
                        <embed src="' . base_url('open_pdf/' . $folder_name . '/' . basename($file)) . '"  style="width: 150px; height: 150px" /></a>
                        <div class="ribbon '.$status.'" style=" position: absolute; cursor: pointer; top: 0; right: 0;  padding: 2px 8px; border-top-right-radius: 8px; border-bottom-left-radius: 8px; color: #fff;" onclick="previewFileModal(\'' . base_url('open_pdf/' . $folder_name . '/' . basename($file)) . '\')">
                                '.$ribbon.'
                            </div>
                        </div>';
                        $filedat = '<a class="btn btn-sm btn-danger waves-effect waves-light material-shadow-none" onclick="previewFileModal(\'' . base_url('open_pdf/' . $folder_name . '/' . basename($file)) . '\')" ><iconify-icon icon="fluent:document-pdf-24-filled" class="align-middle" width="20" height="20"></iconify-icon> </a>';
                    }elseif(in_array($file_extension, ['doc', 'docx'])) {
                        $filedata = '
                        <div class="position-relative d-inline-block m-1" style="width: 150px;" title="'.$file_detail->file_name.'" data-bs-toggle="tooltip" data-bs-placement="top">
                        <a style="white-space: normal; word-break: break-word;"  target="_blank">
                        <iconify-icon icon="tabler:file-type-docx" class="align-bottom text-info" style="font-size: 150px;"></iconify-icon>
                        <div class="ribbon '.$status.'" style=" position: absolute; cursor: pointer; top: 0; right: 0;  padding: 2px 8px; border-top-right-radius: 8px; border-bottom-left-radius: 8px; color: #fff;" onclick="previewFileModal(\'' . base_url('open_docx/' . $folder_name . '/' . basename($file)) . '\')">
                                '.$ribbon.'
                            </div>
                        </div>';
                        $filedat = '<a class="btn btn-sm btn-info waves-effect waves-light material-shadow-none" onclick="previewFileModal(\'' . base_url('open_docx/' . $folder_name . '/' . basename($file)) . '\')" ><iconify-icon icon="ri:file-word-fill" class="align-middle" width="20" height="20"></iconify-icon></a>';
                    }elseif(in_array($file_extension, ['mp3', 'wav', 'ogg'])) {
                        $filedata = '
                        <div class="position-relative d-inline-block m-1" style="width: 150px;" title="'.$file_detail->file_name.'" data-bs-toggle="tooltip" data-bs-placement="top">
                        <a style="white-space: normal; word-break: break-word;"  target="_blank">
                        <audio controls style="width: 150px; height: 150px;">
                            <source src="' . base_url('open_audio/' . $folder_name . '/' . basename($file)) . '">
                            Your browser does not support the audio element.
                        </audio>
                        <div class="ribbon '.$status.'" style=" position: absolute; cursor: pointer; top: 0; right: 0;  padding: 2px 8px; border-top-right-radius: 8px; border-bottom-left-radius: 8px; color: #fff;" onclick="previewFileModal(\'' . base_url('open_audio/' . $folder_name . '/' . basename($file)) . '\')">
                                '.$ribbon.'
                            </div>
                        </div>';
                        $filedat = '<a class="btn btn-sm btn-primary waves-effect waves-light material-shadow-none" onclick="previewFileModal(\'' . base_url('open_audio/' . $folder_name . '/' . basename($file)) . '\')" ><iconify-icon icon="gridicons:audio" class="align-middle" width="20" height="20"></iconify-icon></a>';
                    }elseif(in_array($file_extension, ['mp4', 'mkv', 'avi', 'x-matroska'])) {
                        $filedata = '
                        <div class="position-relative d-inline-block m-1" style="width: 150px;" title="'.$file_detail->file_name.'" data-bs-toggle="tooltip" data-bs-placement="top">
                        <a style="white-space: normal; word-break: break-word;"  target="_blank">
                        <video controls style="width: 150px; height: 150px;">
                            <source src="' . base_url('open_video/' . $folder_name . '/' . basename($file)) . '">
                            Your browser does not support the video tag.
                        </video>
                        <div class="ribbon '.$status.'" style=" position: absolute; cursor: pointer; top: 0; right: 0;  padding: 2px 8px; border-top-right-radius: 8px; border-bottom-left-radius: 8px; color: #fff;" onclick="previewFileModal(\'' . base_url('open_video/' . $folder_name . '/' . basename($file)) . '\')">
                                '.$ribbon.'
                            </div>
                        </div>';
                        $filedat = '<a class="btn btn-sm btn-primary waves-effect waves-light material-shadow-none" onclick="previewFileModal(\'' . base_url('open_video/' . $folder_name . '/' . basename($file)) . '\')" ><iconify-icon icon="lets-icons:video-fill" class="align-middle" width="20" height="20"></iconify-icon></a>';
                    }elseif(in_array($file_extension, ['csv'])) {
                        $filedata = '
                        <div class="position-relative d-inline-block m-1" style="width: 150px;" title="'.$file_detail->file_name.'" data-bs-toggle="tooltip" data-bs-placement="top">
                        <a style="white-space: normal; word-break: break-word;"   target="_blank">
                        <iconify-icon icon="bi:filetype-csv" class="align-bottom text-success" style="font-size: 150px;"></iconify-icon>
                        <div class="ribbon '.$status.'" style=" position: absolute; cursor: pointer; top: 0; right: 0;  padding: 2px 8px; border-top-right-radius: 8px; border-bottom-left-radius: 8px; color: #fff;" onclick="previewFileModal(\'' . base_url('open_csv/' . $folder_name . '/' . basename($file)) . '\')">
                                '.$ribbon.'
                            </div>
                        </div>';
                        $filedat = '<a class="btn btn-sm btn-dark waves-effect waves-light material-shadow-none" onclick="previewFileModal(\'' . base_url('open_csv/' . $folder_name . '/' . basename($file)) . '\')" ><iconify-icon icon="teenyicons:csv-solid" class="align-middle" width="20" height="20"></iconify-icon></a>';
                    }elseif(in_array($file_extension, ['txt'])) {
                        $filedata = '
                        <div class="position-relative d-inline-block m-1" style="width: 150px;" title="'.$file_detail->file_name.'" data-bs-toggle="tooltip" data-bs-placement="top">
                        <a style="white-space: normal; word-break: break-word;"  target="_blank">
                        <iframe src="' . base_url('open_txt/' . $folder_name . '/' . basename($file)) . '" style="width: 150px; height: 150px"></iframe>
                        <div class="ribbon '.$status.'" style=" position: absolute; cursor: pointer; top: 0; right: 0;  padding: 2px 8px; border-top-right-radius: 8px; border-bottom-left-radius: 8px; color: #fff;" onclick="previewFileModal(\'' . base_url('open_txt/' . $folder_name . '/' . basename($file)) . '\')">
                                '.$ribbon.'
                            </div>
                        </div>';
                        $filedat = '<a class="btn btn-sm btn-dark waves-effect waves-light material-shadow-none" onclick="previewFileModal(\'' . base_url('open_txt/' . $folder_name . '/' . basename($file)) . '\')" ><iconify-icon icon="grommet-icons:document-txt" class="align-middle" width="20" height="20"></iconify-icon></a>';
                    }elseif(in_array($file_extension, ['xlsx'])) {
                        $filedata = '
                        <div class="position-relative d-inline-block m-1" style="width: 150px;" title="'.$file_detail->file_name.'" data-bs-toggle="tooltip" data-bs-placement="top">
                        <a style="white-space: normal; word-break: break-word;"  target="_blank">
                         <iconify-icon icon="ri:file-excel-2-line" class="align-bottom text-success" style="font-size: 150px;"></iconify-icon>
                         <div class="ribbon '.$status.'" style=" position: absolute; cursor: pointer; top: 0; right: 0;  padding: 2px 8px; border-top-right-radius: 8px; border-bottom-left-radius: 8px; color: #fff;" onclick="previewFileModal(\'' . base_url('open_xlsx/' . $folder_name . '/' . basename($file)) . '\')">
                                '.$ribbon.'
                            </div>
                        </div>';
                        $filedat = '<a class="btn btn-sm btn-success waves-effect waves-light material-shadow-none" onclick="previewFileModal(\'' . base_url('open_xlsx/' . $folder_name . '/' . basename($file)) . '\')"> <iconify-icon icon="teenyicons:ms-excel-solid" class="align-middle" width="20" height="20"></iconify-icon></a>';
                    }
                    
                    $emp_id = $this->file_mod_new->users_team_belong_to($file_detail->uploaded_by, $file_detail->team_id);
                    if ($emp_id) {
                    $edit = '
                        <div class="d-flex gap-2">
                            <a class="btn btn-sm btn-outline-secondary waves-effect waves-light material-shadow-none"
                            onclick="openEditDateModal(\'' . $folder_name . '\', \'' . $file_detail->file_name . '\', \'' . ($file_detail->date ?: '') . '\', \'' . ($file_detail->original_file_name ?: '') . '\', \'' . ($file_detail->file_desc ?: '') . '\')">
                                Edit
                            </a>';

                        $edit .= '
                        <a class="btn btn-sm btn-outline-danger waves-effect waves-light material-shadow-none"
                        onclick="deleteFile(\'' . $folder_name . '\', \'' . $file_detail->file_name . '\', \'' . ($file_detail->mod_id ?: '') . '\')">
                            Delete
                        </a>';
                        $edit .= '</div>';
                    }else{
                        $edit = '
                        <div class="d-flex gap-2">
                            <a class="btn btn-sm btn-light waves-effect waves-light material-shadow-none" disabled>
                                Edit
                            </a>';
                        $edit .= '
                        <a class="btn btn-sm btn-light waves-effect waves-light material-shadow-none" disabled>
                            Delete
                        </a>';
                        $edit .= '</div>';
                    }



                    $file_info = [
                        'file_id' => $file_detail->file_id, 
                        'name' => $filedata,
                        'path' => $filedat,
                        'size' => filesize($file),
                        'modified' => date("M d, Y", filemtime($file)),
                        'uploaded_by' => ucwords(strtolower($emp_data['name'])),
                        // 'status' => $status_key ? ($file_detail->$status_key ?: 'Unknown') : 'Not Found',
                        'mod_abbr' =>ucwords(strtolower($file_detail->mod_name)) . ' - ' . '<span class="badge bg-info">' . $file_detail->mod_abbr . '</span>',
                        'date' => $file_detail->date ?: '<span class="badge bg-info">N/A</span>',
                        'filename' => $filename,
                        'team_name' => $file_detail->team_name,
                        'file_desc' => $file_detail->file_desc ?: '<span class="badge bg-info">N/A</span>',
                        'edit' => $edit
                    ];

                    // Optional: filter by search term
                    if ($search_value) {
                        if (stripos($file_info['name'], $search_value) !== false || stripos($file_info['uploaded_by'], $search_value) !== false) {
                            $all_files[] = $file_info;
                        }
                    } else {
                        $all_files[] = $file_info;
                    }

                    usort($all_files, function($a, $b) {
                        if ($a['file_id'] == $b['file_id']) {
                            return 0;
                        }
                        return ($a['file_id'] < $b['file_id']) ? 1 : -1;
                    });

                }
            }
        }

        $total = count($all_files);
        $data = array_slice($all_files, $start, $length);

        echo json_encode([
            'draw' => intval($draw),
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $data
        ]);
    }



    public function update_file_date()
    {
        $folderName = $this->input->post('folder_name');
        $fileName = $this->input->post('file_name');
        $newDate = $this->input->post('new_date');
        $original_file_name = $this->input->post('original_file_name');
        $file_desc = $this->input->post('file_desc');

        $data = [
            'date' => $newDate,
            'original_file_name' => $original_file_name,
            'file_desc' => $file_desc
        ];

        $this->db->where('uploaded_to', $folderName);
        $this->db->where('file_name', $fileName);
        if ($this->db->update('system_files', $data)) {
            echo json_encode(['status' => 'success', 'date' => $newDate]);
        }
    }

    public function setup_module_current()
    {
        $team = $this->input->post('team');
        $module = $this->file_mod->get_module_current($team);
        echo json_encode($module);
    }
    public function delete_file()
    {
        $folder_name = $this->input->post('folder_name');
        $file_name = $this->input->post('file_name');
        $module = $this->input->post('module');

        $file_path = FCPATH . 'UploadedFiles/' . $folder_name . '/' . $file_name;

        if ($module != '') {
            if (file_exists($file_path)) {
                if (unlink($file_path)) {
                    if ($folder_name == 'LIVE_TESTING') {
                        $this->db->set('date_implem', '');
                        $this->db->where('mod_id', $module);
                        $this->db->update('module');
                    }
                    $this->file_mod->delete_file_record($file_name);

                    $action = '<b>' . $this->session->name . '</b> deleted a file from <b>' . $folder_name . ' | ' . $file_name . ' | current</b>';
                    $data1 = array(
                        'emp_id' => $this->session->emp_id,
                        'action' => $action,
                        'date_updated' => date('Y-m-d H:i:s'),
                    );
                    $this->load->model('Logs', 'logs');
                    $this->logs->addLogs($data1);

                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'error' => 'Unable to delete file.']);
                }
            } else {
                echo json_encode(['success' => false, 'error' => 'File does not exist.']);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'Opps!!! Select a module first before deleting a file.']);
        }
    }

    public function upload_file()
    {

        $directory_order = ['ISR', 'ATTENDANCE', 'MINUTES', 'WALKTHROUGH', 'FLOWCHART', 'DFD', 'SYSTEM_PROPOSED', 'GANTT_CHART', 'LOCAL_TESTING', 'UAT', 'LIVE_TESTING', 'USER_GUIDE', 'MEMO', 'BUSINESS_ACCEPTANCE', 'REQUEST_LETTER', 'OTHERS'];

        $response = ['success' => false, 'message' => ''];
        $path = $this->input->post('directory');
        $team = $this->input->post('file_team');
        $module = $this->input->post('file_module');
        $moduleName = $this->input->post('file_module_name');
        $sub_mod_id = $this->input->post('file_sub_module');
        $business_unit = $this->input->post('business_unit');
        $bu_name = $this->input->post('bu_name');
        $dept_name = $this->input->post('dept_name');
        $department = $this->input->post('department');
        $isr = $this->input->post('isr');
        $date_implem = $this->input->post('date_implem');
        $date_ = $this->input->post('date_');
        $file_desc = $this->input->post('file_desc');
        $data_file_name = $this->input->post('data_file_name');

        
        $current_index = array_search($path, $directory_order);
        if ($dept_name === 'Select Department') {
            $dept_name = '';
        }
        if ($bu_name === 'Select Business Unit') {
            $bu_name = '';
        }
        if ($current_index === false) {
            $response['message'] = 'Invalid directory selected.';
            echo json_encode($response);
            return;
        }

        if ($current_index > 0) {
            $previous_directory = $directory_order[$current_index - 1];
            $this->file_mod->approve_directory($team, $module, $sub_mod_id, $previous_directory);
        }

        $folder_path = FCPATH . 'UploadedFiles/' . $path;

        $config['upload_path'] = $folder_path;
        $config['allowed_types'] = '*';
        $config['max_size'] = 5000000000;

        $this->load->library('upload', $config);

        $uploaded_files = $_FILES['file'];
        $files_count = count($uploaded_files['name']);
        $success_count = 0;


        $max_size_limits = [
            'image' => 10 * 1024 * 1024,
            'pdf' => 50 * 1024 * 1024,
            'video' => 100 * 1024 * 1024,
            'document' => 10 * 1024 * 1024,
            'audio' => 15 * 1024 * 1024,
        ];

        $allowed_image_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $allowed_pdf_types = ['application/pdf'];
        $allowed_video_types = ['video/mp4', 'video/avi', 'video/quicktime', 'video/x-matroska'];
        $allowed_doc_types = ['application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
        $allowed_audio_types = ['audio/mpeg', 'audio/wav', 'audio/x-wav', 'audio/aac', 'audio/mp4', 'audio/x-m4a'];

        for ($i = 0; $i < $files_count; $i++) {

            $original_file_name = $uploaded_files['name'][$i];

            $file_size = $uploaded_files['size'][$i];
            $file_type = $uploaded_files['type'][$i];

            if (in_array($file_type, $allowed_image_types)) {
                $file_category = 'image';
            } elseif (in_array($file_type, $allowed_pdf_types)) {
                $file_category = 'pdf';
            } elseif (in_array($file_type, $allowed_video_types)) {
                $file_category = 'video';
            } elseif (in_array($file_type, $allowed_doc_types)) {
                $file_category = 'document';
            } elseif (in_array($file_type, $allowed_audio_types)) {
                $file_category = 'audio';
            } else {
                $response['message'] = "File '{$original_file_name}' is not a supported format.";
                continue;
            }


            if ($file_size > $max_size_limits[$file_category]) {
                $response['message'] = "File '{$original_file_name}' exceeds the maximum size of " . ($max_size_limits[$file_category] / (1024 * 1024)) . "MB. Please upload a file " . ($max_size_limits[$file_category] / (1024 * 1024)) . "MB or smaller.";
                continue;
            }

            if ($isr) {
                $file_name = $path . '_' . $isr . '_' . $moduleName . '_' . date('Y-m-d_his_A') . '_' . $bu_name . '_' . $dept_name . '_' . $original_file_name;
            } else {
                $file_name = $path . '_' . $moduleName . '_' . date('Y-m-d_his_A') . '_' . $bu_name . '_' . $dept_name . '_' . $original_file_name;
            }

            $file_exists_db = $this->file_mod->file_exists($file_name, $team, $module, $sub_mod_id, $path);

            $file_path = $folder_path . '/' . $file_name;
            if ($file_exists_db || file_exists($file_path)) {
                $response['message'] = "File '{$file_name}' already exists in the directory.";
                continue;
            }

            $_FILES['file'] = [
                'name' => $file_name,
                'type' => $uploaded_files['type'][$i],
                'tmp_name' => $uploaded_files['tmp_name'][$i],
                'error' => $uploaded_files['error'][$i],
                'size' => $uploaded_files['size'][$i],
            ];


            $this->upload->initialize($config);
            if ($this->upload->do_upload('file')) {
                $success_count++;

                $uploaded_data = $this->upload->data();

                $status_fields = [
                    'ISR'               => 'isr_status',
                    'ATTENDANCE'        => 'att_status',
                    'MINUTES'           => 'minute_status',
                    'WALKTHROUGH'       => 'wt_status',
                    'FLOWCHART'         => 'flowchart_status',
                    'DFD'               => 'dfd_status',
                    'SYSTEM_PROPOSED'   => 'proposed_status',
                    'GANTT_CHART'       => 'gantt_status',
                    'LOCAL_TESTING'     => 'local_status',
                    'UAT'               => 'uat_status',
                    'LIVE_TESTING'      => 'live_status',
                    'USER_GUIDE'        => 'guide_status',
                    'MEMO'              => 'memo_status',
                    'BUSINESS_ACCEPTANCE' => 'acceptance_status',
                    'REQUEST_LETTER'    => 'letter_status',
                    'OTHERS'            => 'others'
                ];

                $statuses = array_fill_keys(array_values($status_fields), null);

                for ($j = 0; $j < $current_index; $j++) {
                    $previous_directory = $directory_order[$j];
                    if (isset($status_fields[$previous_directory])) {
                        $statuses[$status_fields[$previous_directory]] = 'Approve';
                    }
                }

                if (isset($status_fields[$path])) {
                    $statuses[$status_fields[$path]] = 'Approve';
                }

                if ($path == 'LIVE_TESTING') {
                    // $this->db->set('implem_type', '1');
                    $this->db->set('date_implem', $date_implem);
                    $this->db->where('mod_id', $module);
                    $this->db->update('module');
                }

                if($data_file_name == '') {
                    $d = $original_file_name;
                }else{
                    $d = $data_file_name;
                }
                
                $data = array_merge([
                    'team_id' => $team,
                    'mod_id' => $module,
                    'sub_mod_id' => $sub_mod_id,
                    'uploaded_to' => $path,
                    'file_name' => $uploaded_data['file_name'],
                    'original_file_name' => $d,
                    'date_uploaded' => date('Y-m-d H:i:s'),
                    'typeofsystem' => 'current',
                    'business_unit' => $business_unit,
                    'department' => $department,
                    'uploaded_by' => $this->session->emp_id,
                    'date' => $date_,
                    'file_desc' => $file_desc,
                ], $statuses);

                $this->file_mod->upload_file($data);

                $modul = $this->deploy->get_module_name($module);
                $module_name = $modul->mod_name;
                $action = '<b>' . $this->session->name . '</b> uploaded a file to <b>' . $path . ' | ' . $module_name . ' | current</b>';
                $data1 = [
                    'emp_id' => $this->session->emp_id,
                    'action' => $action,
                    'date_added' => date('Y-m-d H:i:s'),
                ];
                $this->load->model('Logs', 'logs');
                $this->logs->addLogs($data1);
            }
        }
        if ($success_count === $files_count) {
            $response['success'] = true;
            $response['message'] = 'Files uploaded successfully.';
        }
        echo json_encode($response);
    }


    private function validate_manager_key($key)
    {
        $valid_key = 'current';
        return $key === $valid_key;
    }


    public function business_unit_current()
    {
        $bu = $this->file_mod->get_business_units();
        echo json_encode($bu);
    }
    public function department_current()
    {
        $bcode = $this->input->post('business_unit');

        $bu = $this->file_mod->get_departments($bcode);
        echo json_encode($bu);
    }

    public function get_filter_options()
    {
        $bus = $this->input->post('business_unit');
        $team = $this->input->post('team');

        $teams = $this->file_mod->get_teams();
        $modules = $this->file_mod->get_modules($team);
        $sub_modules = $this->file_mod->get_sub_modules();
        $bu = $this->file_mod_new->get_business_units_filter($bus);


        echo json_encode([
            'teams' => $teams,
            'modules' => $modules,
            'sub_modules' => $sub_modules,
            'bu' => $bu,
        ]);
    }

    public function open_image($folder_name, $image)
    {
        $image = preg_replace('/[^\x20-\x7E]/', '', $image); // Clean filename
        // $folder_path = realpath("//172.16.42.144/system/{$folder_name}/{$image}");
        $folder_path = FCPATH . 'UploadedFiles/' . $folder_name . '/' . $image;

        $extension = strtolower(pathinfo($folder_path, PATHINFO_EXTENSION));

        switch ($extension) {
            case 'jpg':
            case 'jpeg':
                header('Content-Type: image/jpeg');
                break;
            case 'png':
                header('Content-Type: image/png');
                break;
            case 'gif':
                header('Content-Type: image/gif');
                break;
            case 'jfif':
                header('Content-Type: image/jfif');
                break;
            default:
                header("HTTP/1.0 415 Unsupported Media Type");
                echo "Error: Unsupported image type.";
                exit;
        }

        ob_clean();
        flush();
        readfile($folder_path);
    }

    public function open_pdf($folder_name, $pdf)
    {
        $folder_path = FCPATH . 'UploadedFiles/' . $folder_name . '/' . $pdf;
        header('Content-Type: application/pdf');
        readfile($folder_path);
    }
    public function open_docx($folder_name, $docx)
    {
        $folder_path = FCPATH . 'UploadedFiles/' . $folder_name . '/' . $docx;
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        readfile($folder_path);
    }
    public function open_xlsx($folder_name, $xlsx)
    {
        $folder_path = FCPATH . 'UploadedFiles/' . $folder_name . '/' . $xlsx;
        header('Content-Type: application/vnd.openxmlformatsofficedocument.spreadsheetml.sheet');
        readfile($folder_path);
    }
    public function open_csv($folder_name, $csv)
    {
        $csv = urldecode($csv);
        $folder_path = FCPATH . 'UploadedFiles/' . $folder_name . '/' . $csv;


        header('Content-Type: text/csv');
        header('Content-Disposition: inline; filename="' . basename($csv) . '"');
        header('Pragma: no-cache');
        header('Expires: 0');

        $file = fopen($folder_path, 'r');
        if ($file) {
            while (($line = fgets($file)) !== false) {
                echo $line;
            }
            fclose($file);
        }

    }
    public function open_txt($folder_name, $txt)
    {
        $folder_path = FCPATH . 'UploadedFiles/' . $folder_name . '/' . $txt;
        header('Content-Type: text/plain');
        readfile($folder_path);
    }
    public function open_audio($folder_name, $audio)
    {
        $folder_path = FCPATH . 'UploadedFiles/' . $folder_name . '/' . $audio;
        $extension = pathinfo($audio, PATHINFO_EXTENSION);

        switch (strtolower($extension)) {
            case 'mp3':
                $content_type = 'audio/mpeg';
                break;
            case 'wav':
                $content_type = 'audio/wav';
                break;
            case 'ogg':
                $content_type = 'audio/ogg';
                break;
            default:
                $content_type = 'application/octet-stream'; // Fallback content type
                break;
        }

        header('Content-Type: ' . $content_type);
        readfile($folder_path);
    }

    public function open_video($folder_name, $video)
    {
        $folder_path = FCPATH . 'UploadedFiles/' . $folder_name . '/' . $video;
        $extension = pathinfo($video, PATHINFO_EXTENSION);

        switch (strtolower($extension)) {
            case 'mp4':
                $content_type = 'video/mp4';
                break;
            case 'webm':
                $content_type = 'video/webm';
                break;
            case 'ogg':
                $content_type = 'video/ogg';
                break;
            default:
                $content_type = 'application/octet-stream'; // Fallback content type
                break;
        }

        header('Content-Type: ' . $content_type);
        header('Content-Length: ' . filesize($folder_path));
        readfile($folder_path);
        exit;
    }


    public function get_isr_request()
    {
        $requestnumber = $this->input->post('requestnumber');
        $requests = $this->file_mod->get_isr_requests($requestnumber);

        $filtered_requests = array_filter($requests, function ($request) use ($requestnumber) {
            return $request->requestnumber == $requestnumber;
        });

        echo json_encode($filtered_requests);
    }
}