<?php 
class Logs extends CI_Model
{
    function __construct() {
        parent::__construct();
    }
    public function getLogs($start, $length, $order_column, $order_dir, $search_value)
    {
        $this->db->select('*');
        $this->db->from('logs');
        $this->db->order_by('id', 'desc');

        if (!empty($search_value)) {
            $this->db->group_start();
            $this->db->like('action', $search_value);
            $this->db->group_end();
        }
        $this->db->order_by($order_column, $order_dir);
        $this->db->limit($length, $start);

        return $this->db->get()->result_array();
    }

    public function getTotalLogs($search_value)
    {
        $this->db->select('*');
        $this->db->from('logs');
        $this->db->order_by('id', 'desc');

        if (!empty($search_value)) {
            $this->db->group_start();
            $this->db->like('action', $search_value);
            $this->db->group_end();
        }
        return $this->db->count_all_results();
    }

    public  function addLogs($data1) {
        $this->db->insert('logs', $data1);
    }

    public function updateLogs($data1, $id) {
        $this->db->where('weekly_id', $id);
        $this->db->set('weekly_id', $id);
        return $this->db->update('logs', $data1);
    }
}