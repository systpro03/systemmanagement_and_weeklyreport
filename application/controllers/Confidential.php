
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Confidential extends CI_Controller {
	function __construct()
	{
		parent::__construct();
        if ($this->session->username == "") {
            redirect('login');
        }
        $this->load->model('Confidential_mod', 'confidential_mod');
	}
    public function confidential(){
        $this->load->view('_layouts/header');
        $this->load->view('admin/confidential_files');
        $this->load->view('_layouts/footer');
    }
    public function get_confidential_folders(){
        $folder_path = FCPATH . 'UploadedFiles/CONFIDENTIAL';
        $user = 'Programming';
        $pass = 'Djlouei04';
        
        if (!is_dir($folder_path)) {
            echo json_encode(['error' => 'Folder path does not exist.']);
            return;
        }
        $folders = glob($folder_path . '/*', GLOB_ONLYDIR);
        $folders_ = $this->get_directories($folders);
        
        echo json_encode($folders_);
    }
    private function get_directories($folders) {
        $folder_data = [];
        $custom_order = ['CONFIDENTIAL_FILES', 'OTHERS'];
        foreach ($folders as $folder) {
            $entry = basename($folder);

            if (in_array($entry, $custom_order)) {  
                $file_data = $this->get_file_count($folder);
                
                $folder_data[] = [
                    'name' => $entry,
                    'path' => $folder,
                    'modified' => date("Y-m-d H:i:s", filemtime($folder)),
                    'file_count' => $file_data['count'],
                    'matched_files' => $file_data['matched_files'],
                    'size' => $this->get_folder_size($folder)
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
    private function get_file_count($folder_path) {
        $file_count = 0;
        $matched_files = [];
        $files = scandir($folder_path);
        
        foreach ($files as $file) {
            if ($file != "." && $file != "..") {
                $file_path = $folder_path . '/' . $file;
                if (is_file($file_path)) {
                    $file_detail = $this->confidential_mod->get_file_details($file);
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
    
    private function get_folder_size($folder_path) {
        $total_size = 0;
        $files = scandir($folder_path);
    
        foreach ($files as $file) {
            if ($file != "." && $file != "..") {
                $file_path = $folder_path . '/' . $file;
                
                if (is_file($file_path)) {
                    $file_detail = $this->confidential_mod->get_file_details($file);
                    if ($file_detail) {
                        $total_size += filesize($file_path);
                    }
                } elseif (is_dir($file_path)) {
                    $total_size += $this->get_folder_size($file_path);
                }
            }
        }
        return $total_size;
    }

    public function view_folder_modal_confidential() {

        $folder_name   = $this->input->post('folder_name');
        $folder_path = FCPATH . 'UploadedFiles/CONFIDENTIAL/' . $folder_name;
        $matched_files = $this->get_matched_files($folder_path);
        $data = [
            'matched_files' => $matched_files
        ];
    
        echo json_encode($data);
    }

    private function get_matched_files($folder_path) {
        $matched_files = [];
        $files = glob($folder_path . '/*');
        foreach ($files as $file) {
            if (is_file($file)) {
                $file_detail = $this->confidential_mod->get_file_details(basename($file));

                if ($file_detail) {
                    $matched_files[] = [
                        'name' => basename($file),
                        'path' => $file,
                        'size' => filesize($file),
                        'modified' => date("M d, Y", filemtime($file)),
                        'uploaded_by' => $file_detail->uploaded_by,
                        'filename' => $file_detail->filename
                    ];
                }
            }
        }
        return $matched_files;
    }
    

    public function upload_file() {
        $directory_order = ['CONFIDENTIAL_FILES', 'OTHERS'];
    
        $response   = ['success' => false, 'message' => ''];
        $path       = $this->input->post('directory');
        $filename   = $this->input->post('filename');
        $date       = $this->input->post('date_');
    
        $current_index = array_search($path, $directory_order);
    
        if ($current_index === false) {
            $response['message'] = 'Invalid directory selected.';
            echo json_encode($response);
            return;
        }
    
        $folder_path = FCPATH . 'UploadedFiles/CONFIDENTIAL/' . DIRECTORY_SEPARATOR . $path;
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
            'video' => 100 * 1024 * 1024
        ];
    
        $allowed_image_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $allowed_pdf_types = ['application/pdf'];
        $allowed_video_types = ['video/mp4', 'video/avi', 'video/quicktime', 'video/x-matroska'];
    
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
            } else {
                $response['message'] .= "File '{$original_file_name}' is not a supported format. ";
                continue;
            }
    
            if ($file_size > $max_size_limits[$file_category]) {
                $response['message'] .= "File '{$original_file_name}' exceeds the maximum size of " . 
                                        ($max_size_limits[$file_category] / (1024 * 1024)) . "MB. ";
                continue;
            }
    
            $file_name = $path . '_' . date('Y-m-d_his_A') . '_' . $original_file_name;
    
            $file_exists_db = $this->confidential_mod->file_exists($file_name, $path);
            $file_path = $folder_path . DIRECTORY_SEPARATOR . $file_name;
    
            if ($file_exists_db || file_exists($file_path)) {
                $response['message'] .= "File '{$file_name}' already exists. ";
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
    
                $data = [
                    'filename' => $filename,
                    'uploaded_to' => $path,
                    'file' => $uploaded_data['file_name'],
                    'uploaded_by' => $this->session->emp_id,
                    'date' => $date
                ];
    
                $this->confidential_mod->upload_file($data);
    
                $action = '<b>' . $this->session->name . '</b> uploaded a file to <b>' . $path . ' | ' . $uploaded_data['file_name'] . '</b>';
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


    public function delete_file() {
        $folder_name = $this->input->post('folder_name');
        $file_name   = $this->input->post('file_name');
        
        $file_path = FCPATH . 'UploadedFiles/CONFIDENTIAL/' . $folder_name . '/' . $file_name;

        if (file_exists($file_path)) {
            if (unlink($file_path)) {
                $this->confidential_mod->delete_file_record($file_name);
                $action = '<b>' . $this->session->name. '</b> deleted a file from <b>'.$folder_name .' | '.$file_name.' | current</b>';
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
    }

    
    public function open_confidential_image($folder_name, $image) {
        $image = preg_replace('/[^\x20-\x7E]/', '', $image); // Clean filename
        $folder_path = FCPATH . 'UploadedFiles/CONFIDENTIAL/' . $folder_name . '/'. $image;

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
    
        ob_clean();  // Clear output buffer to prevent corruption
        flush();      // Flush system output buffer
        readfile($folder_path);
    }
    
    public function open_confidential_pdf($folder_name, $pdf){
        $folder_path = FCPATH . 'UploadedFiles/CONFIDENTIAL/' . $folder_name . '/'. $pdf;
        header('Content-Type: application/pdf');
        readfile($folder_path);
    }
    public function open_confidential_docx($folder_name, $docx){
        $folder_path = FCPATH . 'UploadedFiles/CONFIDENTIAL/' . $folder_name . '/'. $docx;
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        readfile($folder_path);
    }
    public function open_confidential_xlsx($folder_name, $xlsx){
        $folder_path = FCPATH . 'UploadedFiles/CONFIDENTIAL/' . $folder_name . '/'. $xlsx;
        header('Content-Type: application/vnd.openxmlformatsofficedocument.spreadsheetml.sheet');
        readfile($folder_path);
    }
    public function open_confidential_csv($folder_name, $csv){
        $csv = urldecode($csv);
        $folder_path = FCPATH . 'UploadedFiles/CONFIDENTIAL/' . $folder_name . '/' . $csv;
        

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
    public function open_confidential_txt($folder_name, $txt){
        $folder_path = FCPATH . 'UploadedFiles/CONFIDENTIAL/' . $folder_name . '/'. $txt;
        header('Content-Type: text/plain');
        readfile($folder_path);
    }
    public function open_confidential_audio($folder_name, $audio){
        $folder_path = FCPATH . 'UploadedFiles/CONFIDENTIAL/' . $folder_name . '/'. $audio;
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

    public function open_confidential_video($folder_name, $video) {
        $folder_path = FCPATH . 'UploadedFiles/CONFIDENTIAL/' . $folder_name . '/' . $video;
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
    

    
}