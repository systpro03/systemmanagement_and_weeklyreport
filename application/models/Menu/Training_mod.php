<?php
class Training_mod extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('pis', TRUE);
    }

    public function get_supervisor()
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('is_supervisor', 'Yes');
        $query = $this->db->get();
        return $query->result();
    }
    public function fetch_events()
    {
        $this->db->select('ms.*, t.team_name, m.mod_name, ms.time, m.module_id as mod_id, ms.mod_id as m_id, ms.id');
        $this->db->from('training ms');
        $this->db->join('team t', 'ms.team_id = t.team_id');
        $this->db->join('module_msfl m', 'ms.mod_id = m.module_id', 'left');
        // $this->db->where('ms.date_training >= CURDATE()');
        $this->db->where('m.active !=', 'Inactive');
        $this->db->or_where('ms.mod_id IS NULL');
        $this->db->or_where('ms.mod_id', '');
        $query = $this->db->get();
        return $query->result_array();
    }


    public function insert_event($data)
    {
        $this->db->insert('training', $data);
    }
    public function update_event($data, $id)
    {
        $this->db->where('id', $id);
        // $this->db->where('added_by', $this->session->userdata('emp_id'));
        $this->db->update('training', $data);
    }

    public function delete_event($id)
    {
        $this->db->where('id', $id);
        // $this->db->where('added_by', $this->session->userdata('emp_id'));
        $this->db->delete('training');
    }

    public function get_upcoming_trainings($date)
    {
        $this->db->select('ms.*, t.team_name, m.mod_name, ms.time, m.module_id as mod_id, ms.mod_id as m_id, ms.id, ms.team_id as team_id');
        $this->db->from('training ms');
        $this->db->join('team t', 'ms.team_id = t.team_id');
        $this->db->join('module_msfl m', 'ms.mod_id = m.module_id', 'left');

        // If a specific date is given: include events whose end date (or single date) is >= that date
        if ($date) {
            $this->db->where("
                (
                    CASE 
                        WHEN ms.date_training LIKE '%to%' THEN 
                            (
                                STR_TO_DATE(SUBSTRING_INDEX(ms.date_training, ' to ', 1), '%Y-%m-%d') <= '{$date}'
                                AND STR_TO_DATE(SUBSTRING_INDEX(ms.date_training, ' to ', -1), '%Y-%m-%d') >= '{$date}'
                            )
                        ELSE 
                            STR_TO_DATE(ms.date_training, '%Y-%m-%d') = '{$date}'
                    END
                )
            ", null, false);
        }
        else {
            // No specific date: include events where today is less than or equal to the end or single date
            $this->db->where("
            (
                CASE 
                    WHEN ms.date_training LIKE '%to%' 
                        THEN STR_TO_DATE(SUBSTRING_INDEX(ms.date_training, ' to ', -1), '%Y-%m-%d') 
                    ELSE STR_TO_DATE(ms.date_training, '%Y-%m-%d') 
                END
            ) >= CURDATE()
        ");

            // Include only active modules or unassigned
            $this->db->group_start();
            $this->db->where('m.active !=', 'Inactive');
            $this->db->or_where('ms.mod_id IS NULL', null, false);
            $this->db->or_where('ms.mod_id', '');
            $this->db->group_end();
        }

        $this->db->order_by("STR_TO_DATE(SUBSTRING_INDEX(ms.date_training, ' to ', 1), '%Y-%m-%d')", 'ASC', false);

        return $this->db->get()->result_array();
    }


    public function get_previous_trainings($date)
    {
        $this->db->select('ms.*, t.team_name, m.mod_name, ms.time, m.module_id as mod_id, ms.mod_id as m_id, ms.id, ms.team_id as team_id');
        $this->db->from('training ms');
        $this->db->join('team t', 'ms.team_id = t.team_id');
        $this->db->join('module_msfl m', 'ms.mod_id = m.module_id', 'left');

        if ($date) {
            $this->db->where("
            STR_TO_DATE(
                CASE 
                    WHEN ms.date_training LIKE '%to%' 
                        THEN SUBSTRING_INDEX(ms.date_training, ' to ', 1)
                    ELSE ms.date_training
                END, '%Y-%m-%d'
            ) = ", $date);
        } else {
            $this->db->where("
            STR_TO_DATE(
                CASE 
                    WHEN ms.date_training LIKE '%to%' 
                        THEN SUBSTRING_INDEX(ms.date_training, ' to ', -1)
                    ELSE ms.date_training
                END, '%Y-%m-%d'
            ) < CURDATE()
        ");

            // Only include active modules or unassigned
            $this->db->group_start();
            $this->db->where('m.active !=', 'Inactive');
            $this->db->or_where('ms.mod_id IS NULL', null, false);
            $this->db->or_where('ms.mod_id', '');
            $this->db->group_end();
        }

        $this->db->order_by("STR_TO_DATE(SUBSTRING_INDEX(ms.date_training, ' to ', 1), '%Y-%m-%d')", 'DESC', false);
        $this->db->limit(20);

        return $this->db->get()->result_array();
    }

    public function get_assigned($emp_id)
    {
        $this->db2->select('*');
        $this->db2->from('employee3');
        $this->db2->where_in('emp_id', $emp_id);
        $query = $this->db2->get();
        return $query->result_array();
    }
    public function get_teamssss($team_id)
    {
        $this->db->select('*');
        $this->db->from('team');
        $this->db->where_in('team_id', $team_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_modules($module)
    {
        if (empty($module))
            return [];
        $this->db->select('*');
        $this->db->from('module_msfl');

        if ($module) {
            $this->db->where_in('module_id', $module);
        }
        // $this->db->where_in('module_id', $module);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_up_trainings()
    {
        $this->db->select('date_training');
        $this->db->from('training ms');
        $this->db->join('team t', 'ms.team_id = t.team_id');
        $this->db->join('module_msfl m', 'ms.mod_id = m.module_id', 'left');

        $this->db->where("
        (
                CASE 
                    WHEN ms.date_training LIKE '%to%' 
                        THEN STR_TO_DATE(SUBSTRING_INDEX(ms.date_training, ' to ', -1), '%Y-%m-%d') 
                    ELSE STR_TO_DATE(ms.date_training, '%Y-%m-%d') 
                END
            ) >= CURDATE()
        ");

        $this->db->group_start();
        $this->db->where('m.active !=', 'Inactive');
        $this->db->or_where('ms.mod_id IS NULL', null, false);
        $this->db->or_where('ms.mod_id', '');
        $this->db->group_end();

        $this->db->order_by("STR_TO_DATE(SUBSTRING_INDEX(ms.date_training, ' to ', 1), '%Y-%m-%d')", 'ASC', false);

        return $this->db->get()->result_array();
    }


    public function get_prev_trainings()
    {
        $this->db->select('date_training');
        $this->db->from('training ms');
        $this->db->join('team t', 'ms.team_id = t.team_id');
        $this->db->join('module_msfl m', 'ms.mod_id = m.module_id', 'left');

                $this->db->where("
        (
                CASE 
                    WHEN ms.date_training LIKE '%to%' 
                        THEN STR_TO_DATE(SUBSTRING_INDEX(ms.date_training, ' to ', -1), '%Y-%m-%d') 
                    ELSE STR_TO_DATE(ms.date_training, '%Y-%m-%d') 
                END
            ) < CURDATE()
        ");


        $this->db->group_start();
        $this->db->where('m.active !=', 'Inactive');
        $this->db->or_where('ms.mod_id IS NULL', null, false);
        $this->db->or_where('ms.mod_id', '');
        $this->db->group_end();

        $this->db->order_by("STR_TO_DATE(SUBSTRING_INDEX(ms.date_training, ' to ', 1), '%Y-%m-%d')", 'DESC', false);
        return $this->db->get()->result_array();
    }
}