<?php 
class Confidential_mod extends CI_Model
{
    function __construct() {
        parent::__construct();
    }

    public function get_file_details($file_name) {

        $this->db->select('*');
        $this->db->from('confidential_files');
        $this->db->where('file', $file_name);

        if (!empty($_POST['date_filter'])) {
            $dates = explode(' to ', $_POST['date_filter']);
        
            if (count($dates) === 2) {
                $start_date = date('Y-m-d', strtotime($dates[0]));
                $end_date = date('Y-m-d', strtotime($dates[1]));
            } else {
                $start_date = $end_date = date('Y-m-d', strtotime($dates[0]));
            }
        
            $this->db->where("DATE(date) >= ", $start_date);
            $this->db->where("DATE(date) <= ", $end_date);
        }

        if (!empty($_POST['file_name'])) {
            $this->db->like('filename', $_POST['file_name']);
        }
        
        $query = $this->db->get();
        return $query->row();
    }

    public function file_exists($file_name,$path) {
        $this->db->where('file', $file_name);
        $this->db->where('uploaded_to', $path);
        $query = $this->db->get('confidential_files');
        
        return $query->num_rows() > 0;
    }
    public function upload_file($data) {
        $this->db->insert('confidential_files', $data);
    }
    public function delete_file_record($file_name) {
        $this->db->where('file', $file_name);
        $this->db->delete('confidential_files');
    }
}