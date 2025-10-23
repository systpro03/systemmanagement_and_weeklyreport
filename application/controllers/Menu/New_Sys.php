<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class New_Sys extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->username == "") {
            redirect('login');
        }
        $this->load->model('Menu/File_mod_new', 'file_mod');
        $this->load->model('Admin_mod', 'admin');
        $this->load->model('Menu/Deploy_mod', 'deploy');
    }
    public function index() {
        $this->load->view('_layouts/header');
        $this->load->view('menu/new_system');
        $this->load->view('_layouts/footer');
    }
    
    public function get_new_folders() {
        $team = $this->input->post('team');
        $module = $this->input->post('module');
        $sub_module = $this->input->post('sub_module');
        $bu_filter = $this->input->post('bu_filter');
        
    
        $folder_path = FCPATH . 'UploadedFiles';

        if (!is_dir($folder_path)) {
            echo json_encode(['error' => 'Folder path does not exist.']);
            return;
        }
        
        $folders = glob($folder_path . '/*', GLOB_ONLYDIR);
        $folders_ = $this->get_directories($folders, $team, $module, $sub_module, $bu_filter);
        
        echo json_encode($folders_);
    }
    
    private function get_directories($folders, $team, $module, $sub_module, $bu_filter) {
        $folder_data = [];
        $custom_order = ['ISR', 'ATTENDANCE', 'MINUTES', 'WALKTHROUGH', 'FLOWCHART', 'DFD','SYSTEM_PROPOSED', 'LOCAL_TESTING', 'UAT', 'LIVE_TESTING', 'USER_GUIDE', 'MEMO', 'BUSINESS_ACCEPTANCE'];
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
        
        usort($folder_data, function($a, $b) use ($custom_order) {
            $index_a = array_search($a['name'], $custom_order);
            $index_b = array_search($b['name'], $custom_order);
            return $index_a - $index_b;
        });
        
        return $folder_data;
    }

    private function get_file_count($folder_path, $team, $module, $sub_module, $bu_filter) {
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
    

    private function get_folder_size($folder_path, $team, $module, $sub_module, $bu_filter) {
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
    
    // private function get_matched_files($folder_path, $team, $module, $sub_module, $business_unit, $department) {
    //     $matched_files = [];
    //     $files = glob($folder_path . '/*');

    //     foreach ($files as $file) {
    //         if (is_file($file)) {
    //             $file_detail = $this->file_mod->get_file_details(basename($file), $team, $module, $sub_module, $business_unit, $department);

    //             if ($file_detail) {
    //                 $matched_files[] = [
    //                     'name' => basename($file),
    //                     'path' => $file,
    //                     'size' => filesize($file),
    //                     'modified' => date("M d, Y", filemtime($file)),
    //                     'uploaded_by' => $file_detail->uploaded_by,
    //                 ];
    //             }
    //         }
    //     }
    //     return $matched_files;
    // }

    private function get_matched_files($folder_path, $team, $module, $sub_module, $business_unit, $department) {
        $status_fields = [
            'ISR'                   => 'isr_status',
            'ATTENDANCE'            => 'att_status',
            'MINUTES'               => 'minute_status',
            'WALKTHROUGH'           => 'wt_status',
            'FLOWCHART'             => 'flowchart_status',
            'DFD'                   => 'dfd_status',
            'SYSTEM_PROPOSED'       => 'proposed_status',
            'LOCAL_TESTING'         => 'local_status',
            'UAT'                   => 'uat_status',
            'LIVE_TESTING'          => 'live_status',
            'USER_GUIDE'            => 'guide_status',
            'MEMO'                  => 'memo_status',
            'BUSINESS_ACCEPTANCE'   => 'acceptance_status'
        ];
    
        $matched_files = [];
        $files = glob($folder_path . '/*');
    
        foreach ($files as $file) {
            if (is_file($file)) {
                $file_detail = $this->file_mod->get_file_details(basename($file), $team, $module, $sub_module, $business_unit, $department);
    
                if ($file_detail) {
                    $file_name = strtoupper(basename($file)); 
                    $status_key = '';

                    foreach ($status_fields as $key => $status_field) {
                        if (strpos($file_name, $key) !== false) {
                            $status_key = $status_field;
                            break;
                        }
                    }
                    $matched_files[] = [
                        'name'        => basename($file),
                        'path'        => $file,
                        'size'        => filesize($file),
                        'modified'    => date("M d, Y", filemtime($file)),
                        'uploaded_by' => $file_detail->uploaded_by,
                        'status' => $status_key ? (isset($file_detail->$status_key) ? $file_detail->$status_key : 'Unknown') : 'Not Found',
                        'mod_abbr' => $file_detail->mod_abbr,
                        'date'        => $file_detail->date ? : '',
                        'filename'    => $file_detail->original_file_name ? : '',

                    ];
                }
            }
        }
    
        return $matched_files;
    }

    public function view_new_folder_modal() {

        $folder_name = $this->input->get('folder_name');
        $team = $this->input->get('team');
        $module = $this->input->get('module');
        $sub_module = $this->input->get('sub_module');
        $business_unit = $this->input->get('bu_filter');
        $department = $this->input->get('department');
        
        // $bu_filter = $this->input->get('bu_filter');
    
        $folder_path = FCPATH . 'UploadedFiles/' . $folder_name;
    
        $matched_files = $this->get_matched_files($folder_path, $team, $module, $sub_module, $business_unit, $department);
        $data = [
            'matched_files' => $matched_files
        ];
    
        echo json_encode($data);
    }
    
    public function setup_module_new()
    {        
        $team = $this->input->post('team_id');
        $module = $this->file_mod->get_module_new($team);
        echo json_encode($module);
    }

    public function business_unit() {
        $bu = $this->file_mod->get_business_units();
        echo json_encode($bu);
    }
    public function department() {
        $bcode = $this->input->post('business_unit');
        $bu = $this->file_mod->get_departments($bcode);
        echo json_encode($bu);
    }

    public function add_new_module() {
        $mod_name       = $this->input->post('mod_name');
        $mod_abbr       = $this->input->post('mod_abbr');
        $typeofsystem   = $this->input->post('typeofsystem');
        $date_request   = $this->input->post('date_request');
        $bcode          = $this->input->post('bcode');
        $business_unit  = $this->input->post('business_unit');
        $manager_key    = $this->input->post('manager_key');
        
        
        if ($manager_key && !$this->validate_manager_key($manager_key)) {
            $response['success'] = false;
            $response['message'] = "Invalid manager's key.";
            echo json_encode($response);
            return;
        }else{
            $data = [
                'mod_name'      => $mod_name,
                'mod_abbr'      => $mod_abbr,
                'typeofsystem'  => $typeofsystem,
                'status'        => 'Approve',
                'date_added'    => date('Y-m-d H:i:s'),
                'date_request'  => date('Y-m-d', strtotime($date_request)),
                'requested_to'  => $bcode,
                'bu_name' => $business_unit
            ];
        
            $insert = $this->admin->insertModule($data);
            if ($insert) {
                $response['success'] = true;
                $response['message'] = 'Module added successfully.';
            } else {
                $response['error'] = true;
                $response['message'] = 'Failed to add module.';
            }
        
            echo json_encode($response);
        }

    }
    



    public function delete_file_new() {
        $folder_name = $this->input->post('folder_name');
        $file_name   = $this->input->post('file_name');
        $module      = $this->input->post('module');
        

        $file_path = FCPATH . 'UploadedFiles/' . $folder_name . '/' . $file_name;
    
        if($module != ''){
            if (file_exists($file_path)) {
                if ($this->file_mod->delete_file_record($file_name, $folder_name)) {
                    if (unlink($file_path)) {
    
                        if($folder_name == 'LIVE_TESTING'){
                            $this->db->set('date_implem', '');
                            $this->db->where('mod_id', $module);
                            $this->db->update('module');
                        }
    
                        $action = '<b>' . $this->session->name . '</b> deleted a file in <b>' . $folder_name . ' | ' . $file_name . '</b>';
                        $log_data = [
                            'emp_id'       => $this->session->emp_id,
                            'action'       => $action,
                            'date_updated' => date('Y-m-d H:i:s'),
                        ];
                        $this->load->model('Logs', 'logs');
                        $this->logs->addLogs($log_data);
        
                        echo json_encode(['success' => true]);
                    } else {
                        echo json_encode(['success' => false, 'error' => 'Failed to delete the file from the file system.']);
                    }
                } else {
                    echo json_encode(['success' => false, 'error' => 'File cannot be deleted because it is already Approved. Please upload a new file']);
                }
            } else {
                echo json_encode(['success' => false, 'error' => 'File does not exist.']);
            }
        }else{
            echo json_encode(['success' => false, 'error' => 'Opps!!! Select a module first before deleting a file.']);
        }
    }
    


    public function upload_new_files() {
        $response        = ['success' => false, 'message' => ''];
        $directory_order = ['ISR', 'ATTENDANCE', 'MINUTES', 'WALKTHROUGH', 'FLOWCHART', 'DFD','SYSTEM_PROPOSED', 'LOCAL_TESTING', 'UAT', 'LIVE_TESTING', 'USER_GUIDE', 'MEMO', 'BUSINESS_ACCEPTANCE'];

        $selected_directory = $this->input->post('directory');
        $team               = $this->input->post('file_team');
        $module             = $this->input->post('file_module');
        $moduleName         = $this->input->post('file_module_name');
        $sub_module         = $this->input->post('file_sub_module');
        $business_unit      = $this->input->post('business_unit');
        $department         = $this->input->post('department');
        $bu_name            = $this->input->post('bu_name');
        $dept_name          = $this->input->post('dept_name');
        $isr                = $this->input->post('isr');
        $manager_key        = $this->input->post('manager_key');
        $date_implem        = $this->input->post('date_implem');
        $date_              = $this->input->post('date_');
        
        if ($dept_name === 'Select Department') {
            $dept_name = '';
        }
    
        if ($bu_name === 'Select Business Unit') {
            $bu_name = '';
        }

        $current_index = array_search($selected_directory, $directory_order);

        if ($current_index === false) {
            $response['message'] = 'Invalid directory selected.';
            echo json_encode($response);
            return;
        }
        
        $previous_directories = array_slice($directory_order, 0, $current_index);
        
        $pending_directories = [];
        foreach ($previous_directories as $directory) {
            $pending_in_directory = $this->file_mod->get_pending_files($team, $module, $sub_module, [$directory]);
            if ($pending_in_directory) {
                $pending_directories[] = $directory;
            }
        }
        
        if($manager_key != ''){
            if (!$manager_key || !$this->validate_manager_key($manager_key)) {
                $response['error'] = 'invalid_key';
                $response['message'] = 'The manager\'s key you entered is incorrect.';
                echo json_encode($response);
                return;
            }
        }
        
        if (!empty($pending_directories)) {
            $pending_list = implode(', ', $pending_directories);
        
            if (!$manager_key || !$this->validate_manager_key($manager_key)) {
                $response['message'] = "Approve pending files in the following directories before proceeding to \"$selected_directory\": $pending_list.";
                echo json_encode($response);
                return;
            } else {
                $response['pending'] = "Notice: There are pending files in the following directories: $pending_list.";
                $response['pending_warning'] = true;
            }
        }
        
        $has_pending_directories = !empty($pending_directories);
        
        if (!$manager_key || !$this->validate_manager_key($manager_key) || $has_pending_directories) {
            foreach ($previous_directories as $previous_directory) {
                $previous_files_exist = $this->file_mod->check_files_exist($team, $module, $sub_module, $previous_directory);
                if (!$previous_files_exist) {
                    $response['message'] = "Please upload files to the \"$previous_directory\" directory before proceeding to \"$selected_directory\".";
                    echo json_encode($response);
                    return;
                }
            }
        }
        

        $folder_path = FCPATH . 'UploadedFiles/' . $selected_directory;
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
            'audio'    => 15 * 1024 * 1024,
        ];

        $allowed_image_types    = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $allowed_pdf_types      = ['application/pdf'];
        $allowed_video_types    = ['video/mp4', 'video/avi', 'video/quicktime', 'video/x-matroska'];
        $allowed_doc_types      = ['application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
        $allowed_audio_types    = ['audio/mpeg', 'audio/wav', 'audio/x-wav', 'audio/aac', 'audio/mp4', 'audio/x-m4a'];

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

            if($isr){
                $file_name = $selected_directory . '_'. $isr .'_' . $moduleName . '_' . date('Y-m-d_his_A') . '_' .  $bu_name . '_' . $dept_name . '_' . $original_file_name;
            }else{
                $file_name = $selected_directory . '_' . $moduleName . '_' . date('Y-m-d_his_A') . '_' .  $bu_name . '_' . $dept_name . '_' . $original_file_name;
            }
            $file_exists_db = $this->file_mod->file_exists_new($file_name, $team, $module, $sub_module, $selected_directory);
    
            $file_path = $folder_path . '\\' . $file_name;
            if ($file_exists_db || file_exists($file_path)) {
                $response['message'] = "File '{$file_name}' already exists in the directory.";
                continue;
            }
    
            $_FILES['file']['name'] = $file_name;
            $_FILES['file']['type'] = $uploaded_files['type'][$i];
            $_FILES['file']['tmp_name'] = $uploaded_files['tmp_name'][$i];
            $_FILES['file']['error'] = $uploaded_files['error'][$i];
            $_FILES['file']['size'] = $uploaded_files['size'][$i];
    
            $this->upload->initialize($config);
            if ($this->upload->do_upload('file')) {
                $success_count++;
    
                $uploaded_data = $this->upload->data();

                $status_fields = [
                    'ISR'                   => 'isr_status',
                    'ATTENDANCE'            => 'att_status',
                    'MINUTES'               => 'minute_status',
                    'WALKTHROUGH'           => 'wt_status',
                    'FLOWCHART'             => 'flowchart_status',
                    'DFD'                   => 'dfd_status',
                    'SYSTEM_PROPOSED'       => 'proposed_status',
                    'LOCAL_TESTING'         => 'local_status',
                    'UAT'                   => 'uat_status',
                    'LIVE_TESTING'          => 'live_status',
                    'USER_GUIDE'            => 'guide_status',
                    'MEMO'                  => 'memo_status',
                    'BUSINESS_ACCEPTANCE'   => 'acceptance_status'
                ];
            
                $statuses = array_fill_keys(array_values($status_fields), null);
            
                if (empty($manager_key)) {
                    if ($current_index > 0) {
                        for ($i = 0; $i < $current_index; $i++) {
                            $previous_directory = $directory_order[$i];
                            if (isset($status_fields[$previous_directory])) {
                                $statuses[$status_fields[$previous_directory]] = 'Approve';
                            }
                        }
                    }
                } 

                if (isset($status_fields[$selected_directory])) {
                    $statuses[$status_fields[$selected_directory]] = 'Pending';
                }

                if ($selected_directory == 'LIVE_TESTING'){
                    // $this->db->set('implem_type', '1');
                    $this->db->set('date_implem', $date_implem);
                    $this->db->where('mod_id', $module);
                    $this->db->update('module');
                }

                $data = array_merge([
                    'team_id'       => $team,
                    'mod_id'        => $module,
                    'sub_mod_id'    => $sub_module,
                    'uploaded_to'   => $selected_directory,
                    'file_name'     => $uploaded_data['file_name'],
                    'original_file_name' => $original_file_name,
                    'date_uploaded' => date('Y-m-d H:i:s'),
                    'typeofsystem'  => 'new',
                    'business_unit' => $business_unit,
                    'department'    => $department,
                    'uploaded_by' => $this->session->emp_id,
                    'date'        => $date_
                ], $statuses);
    
                $this->file_mod->upload_file($data);


                $modul = $this->deploy->get_module_name($module);
                $module_name = $modul->mod_name;
                
                if($manager_key){
                    $action = '<b>' . $this->session->name. '</b> uploaded a file to <b>'.$selected_directory.' | '.$module_name.' | new | With a managers key</b>';
                }else{
                    $action = '<b>' . $this->session->name. '</b> uploaded a file to <b>'.$selected_directory.' | '.$module_name.' | new</b>';
                }

                $data1 = array(
                    'emp_id' => $this->session->emp_id,
                    'action' => $action,
                    'date_added' => date('Y-m-d H:i:s'),
                );
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
    private function validate_manager_key($key) {
        $query = $this->db->select('manager_key')
                          ->from('users')
                          ->where('is_manager_key', 'Yes')
                          ->where('manager_key', $key)
                          ->get();
        return $query->num_rows() > 0;
    }
    
    
    
    

    public function get_filter_options_new()
    {
        $bus  = $this->input->post('business_unit');
        $team = $this->input->post('team');
        $sb   = $this->input->post('module');
        
        $teams = $this->file_mod->get_teams();
        $modules = $this->file_mod->get_modules($team);
        $sub_modules = $this->file_mod->get_sub_modules();
        $bu = $this->file_mod->get_business_units_filter($bus);

    
        echo json_encode([
            'teams' => $teams,
            'modules' => $modules,
            'sub_modules' => $sub_modules,
            'bu' => $bu, 
        ]);
    }

    public function open_new_image($folder_name, $image){
        
        $image = preg_replace('/[^\x20-\x7E]/', '', $image); // Clean filename
        // $folder_path = realpath("//172.16.42.144/system/{$folder_name}/{$image}");
        $folder_path = FCPATH . 'UploadedFiles/' . $folder_name . '/'. $image;

        $extension = pathinfo($folder_path, PATHINFO_EXTENSION);
        
        switch (strtolower($extension)) {
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
        }
        readfile($folder_path);
    }
    public function open_new_pdf($folder_name, $pdf){
         $folder_path = FCPATH . 'UploadedFiles/' . $folder_name . '/'. $pdf;
        header('Content-Type: application/pdf');
        readfile($folder_path);
    }
    public function open_new_docx($folder_name, $docx){
         $folder_path = FCPATH . 'UploadedFiles/' . $folder_name . '/'. $docx;
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        readfile($folder_path);
    }
    public function open_new_xlsx($folder_name, $xlsx){
         $folder_path = FCPATH . 'UploadedFiles/' . $folder_name . '/'. $xlsx;
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        readfile($folder_path);
    }
    public function open_new_csv($folder_name, $csv){
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
    public function open_new_txt($folder_name, $txt){
         $folder_path = FCPATH . 'UploadedFiles/' . $folder_name . '/'. $txt;
        header('Content-Type: text/plain');
        readfile($folder_path);
    }
    public function open_new_audio($folder_name, $audio){
         $folder_path = FCPATH . 'UploadedFiles/' . $folder_name . '/'. $audio;
        $extension = pathinfo($audio, PATHINFO_EXTENSION);
    
        switch(strtolower($extension)) {
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
}
