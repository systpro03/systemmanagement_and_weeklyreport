<?php
class Meeting_mod extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function fetch_events()
    {
        $this->db->select('ms.*, t.team_name, m.mod_name, ms.time, ms.team_id, m.module_id as mod_id, ms.id, ms.mod_id as m_id');
        $this->db->from('meeting_sched ms');
        $this->db->join('team t', 'ms.team_id = t.team_id');
        $this->db->join('module_msfl m', 'ms.mod_id = m.module_id', 'left');
        // $this->db->where('ms.date_meeting >= CURDATE()');
        // $this->db->group_start();
        $this->db->where('m.active !=', 'Inactive');
        $this->db->or_where('ms.mod_id IS NULL');
        $this->db->or_where('ms.mod_id', '');
        // $this->db->group_end();
        $query = $this->db->get();
        return $query->result_array();
    }


    public function insert_event($data)
    {
        $this->db->insert('meeting_sched', $data);
    }
    public function update_event($data, $id)
    {
        $this->db->where('id', $id);
        // $this->db->where('added_by', $this->session->userdata('emp_id'));
        $this->db->update('meeting_sched', $data);
    }
    public function delete_event($id)
    {
        $this->db->where('id', $id);
        // $this->db->where('added_by', $this->session->userdata('emp_id'));

        if ($this->db->delete('meeting_sched')) {
            return true;
        } else {
            return false;
        }
    }

    public function get_upcoming_meetings($date)
    {
        $this->db->select('ms.*, t.team_name, m.mod_name, ms.time, ms.team_id, m.module_id as mod_id, ms.id, ms.mod_id as m_id');
        $this->db->from('meeting_sched ms');
        $this->db->join('team t', 'ms.team_id = t.team_id');
        $this->db->join('module_msfl m', 'ms.mod_id = m.module_id', 'left');

        $this->db->where('ms.date_meeting >= CURDATE()');

        if ($date) {
            $this->db->where('ms.date_meeting', date('Y-m-d', strtotime($date)));
        } else {
            $this->db->group_start();
            $this->db->where('m.active !=', 'Inactive');
            $this->db->or_where('ms.mod_id IS NULL', null, false);
            $this->db->or_where('ms.mod_id', '');
            $this->db->group_end();
        }

        $this->db->order_by('ms.date_meeting', 'ASC');
        return $this->db->get()->result_array();
    }

    public function get_previous_meetings($date)
    {
        $this->db->select('ms.*, t.team_name, m.mod_name, ms.time, ms.team_id, m.module_id as mod_id, ms.id, ms.mod_id as m_id');
        $this->db->from('meeting_sched ms');
        $this->db->join('team t', 'ms.team_id = t.team_id');
        $this->db->join('module_msfl m', 'ms.mod_id = m.module_id', 'left');

        $this->db->where('ms.date_meeting < CURDATE()');

        if ($date) {
            $this->db->where('ms.date_meeting', date('Y-m-d', strtotime($date)));
            // $this->db->where('ms.mod_id IS NOT NULL', null, false);
            // $this->db->where('ms.mod_id !=', '');
        } else {
            $this->db->group_start();
            $this->db->where('m.active !=', 'Inactive');
            $this->db->or_where('ms.mod_id IS NULL', null, false);
            $this->db->or_where('ms.mod_id', '');
            $this->db->group_end();
        }

        $this->db->order_by('ms.date_meeting', 'DESC');
        return $this->db->get()->result_array();
    }


    public function get_up_meetings()
    {
        $this->db->select('date_meeting');
        $this->db->from('meeting_sched ms');
        $this->db->join('team t', 'ms.team_id = t.team_id');
        $this->db->join('module_msfl m', 'ms.mod_id = m.module_id', 'left');

        $this->db->where('ms.date_meeting >= CURDATE()');

        // Group to correctly combine active module OR null/blank mod_id
        $this->db->group_start();
        $this->db->where('m.active !=', 'Inactive');
        $this->db->or_where('ms.mod_id IS NULL', null, false);
        $this->db->or_where('ms.mod_id', '');
        $this->db->group_end();

        $this->db->group_by('ms.date_meeting');
        $this->db->order_by('ms.date_meeting', 'ASC');
        return $this->db->get()->result_array();
    }

    public function get_prev_meetings()
    {
        $this->db->select('date_meeting');
        $this->db->from('meeting_sched ms');
        $this->db->join('team t', 'ms.team_id = t.team_id');
        $this->db->join('module_msfl m', 'ms.mod_id = m.module_id', 'left');

        $this->db->where('ms.date_meeting < CURDATE()');


        $this->db->group_start();
        $this->db->where('m.active !=', 'Inactive');
        $this->db->or_where('ms.mod_id IS NULL', null, false);
        $this->db->or_where('ms.mod_id', '');
        $this->db->group_end();
        $this->db->group_by('ms.date_meeting');
        $this->db->order_by('ms.date_meeting', 'DESC');
        return $this->db->get()->result_array();
    }

}