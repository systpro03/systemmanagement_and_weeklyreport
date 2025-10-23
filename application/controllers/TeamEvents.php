<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TeamEvents extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        if ($this->session->username == "") {
            redirect('login');
        }

    }
    public function index(){
        $this->load->view('_layouts/header');
        $this->load->view('team_events');
        $this->load->view('_layouts/footer');
    }

    public function get_directories()
    {
        $folderPath = FCPATH . 'TeamEvents/';

        if (!is_dir($folderPath)) {
            echo json_encode(['error' => 'Directory not found']);
            return;
        }

        $directories = array_filter(scandir($folderPath), function($item) use ($folderPath) {
            return is_dir($folderPath . $item) && $item !== '.' && $item !== '..';
        });

        echo json_encode(array_values($directories));
    }



    public function create_folder()
    {
        $folderName = $this->input->post('folderName');
        $folderPath = FCPATH . 'TeamEvents/' . $folderName;

        if (!$folderName) {
            echo json_encode(['status' => 'error', 'message' => 'Folder name is required.']);
            return;
        }
        if (!is_dir(FCPATH . 'TeamEvents/')) {
            mkdir(FCPATH . 'TeamEvents/', 777, true);
        }

        if (!is_dir($folderPath)) {
            if (mkdir($folderPath, 777, true)) {
                echo json_encode(['status' => 'success', 'message' => 'Folder created successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to create folder.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Folder already exists.']);
        }
    }
    public function sysdev_upload_file()
    {

        ini_set('memory_limit', '1024M');

        
        $folderName = $this->input->post('folderName');
        $response = ['success' => false, 'message' => ''];
    
        $folderPath = FCPATH . 'TeamEvents/' . $folderName;
        if (!is_dir($folderPath)) {
            if (!mkdir($folderPath, 0755, true)) {
                $response['message'] = 'Failed to create directory: ' . $folderPath;
                echo json_encode($response);
                return;
            }
        }
        chmod($folderPath, 0775); 
    
        $config['upload_path'] = $folderPath;
        $config['allowed_types'] = '*';
        $config['max_size'] = 5000000000;
    
        $this->load->library('upload', $config);
    
        $uploaded_files = $_FILES['file'];
        $files_count = count($uploaded_files['name']);
        $success_count = 0;
    
        for ($i = 0; $i < $files_count; $i++) {
            $_FILES['file']['name'] = $uploaded_files['name'][$i];
            $_FILES['file']['type'] = $uploaded_files['type'][$i];
            $_FILES['file']['tmp_name'] = $uploaded_files['tmp_name'][$i];
            $_FILES['file']['error'] = $uploaded_files['error'][$i];
            $_FILES['file']['size'] = $uploaded_files['size'][$i];
    
            $this->upload->initialize($config);
    
            if ($this->upload->do_upload('file')) {
                $success_count++;
            } else {
                $response['message'] .= $this->upload->display_errors('', '') . "<br>";
            }
        }

    
        if ($success_count === $files_count) {
            $response['success'] = true;
            $response['message'] = 'All files uploaded successfully.';
        } elseif ($success_count > 0) {
            $response['success'] = true;
            $response['message'] .= "Partial success: $success_count out of $files_count files uploaded.";
        }
    
        echo json_encode($response);
    }
    
    
    public function sysdev_delete_files()
    {
        $response = ['success' => false, 'message' => ''];
        $selectedFiles = $this->input->post('files');
        $selectedFiles = json_decode($selectedFiles, true);
    
        $deletedFiles = [];
        $failedFiles = [];
    
        foreach ($selectedFiles as $fileUrl) {
            $filePath = str_replace(base_url(), '', $fileUrl);
            $fullPath = FCPATH . $filePath;
            $fullPath = realpath($fullPath);
    
            if ($fullPath && file_exists($fullPath) && is_file($fullPath)) {
                if (unlink($fullPath)) {
                    $deletedFiles[] = basename($fullPath);
                } else {
                    $failedFiles[] = basename($fullPath);
                }
            } else {
                $failedFiles[] = basename($fileUrl);
            }
        }
    
        if (!empty($deletedFiles)) {
            $response['success'] = true;
            $response['message'] = count($deletedFiles) . ' file(s) successfully deleted.';
        }
    
        if (!empty($failedFiles)) {
            $response['message'] .= ' Failed to delete ' . count($failedFiles) . ' file(s): ' . implode(', ', $failedFiles);
        }
    
        echo json_encode($response);
    }
    

    public function get_images_directory() {
        set_time_limit(5); 
        $folder_path = FCPATH . 'TeamEvents/';
        if (!is_dir($folder_path)) {
            echo json_encode(['error' => 'Folder path does not exist.']);
            return;
        }
        $folders = glob($folder_path . '/*');
        $folder_names = [];

        foreach ($folders as $folder) {
            $folder_name = basename($folder);
            $images = glob($folder . '/*.{jpg,JPG,jpeg,png,gif}', GLOB_BRACE);
            $folder_names[] = [
                'name' => $folder_name,
                'images' => array_map(function ($img) use ($folder_name) {
                    return 'http://'.$_SERVER['HTTP_HOST'].'/itsystem/TeamEvents/' . $folder_name . '/' . basename($img);
                }, $images)
            ];
        }
        echo json_encode($folder_names);
    }
}