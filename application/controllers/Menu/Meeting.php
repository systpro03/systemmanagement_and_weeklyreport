<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Meeting extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if ($this->session->username == "") {
            redirect('login');
        }
        $this->load->model('Menu/Meeting_mod', 'meeting');
        $this->load->model('Menu/Workload', 'workload');
        $this->load->model('Menu/Training_mod', 'training');
    }
    public function index()
    {
        $this->load->view('_layouts/header');
        $this->load->view('menu/meeting_sched');
        $this->load->view('_layouts/footer');
    }
    public function get_meeting()
    {
        $meeting = $this->meeting->fetch_events();

        $events = [];
        foreach ($meeting as $event) {

            $team = explode(',', $event['team_id']);
            $emp = $this->workload->get_emp($event['added_by']);
            $module = explode(',', $event['m_id']);



            $team_names = $this->training->get_teamssss($team);
            $mod_names = $this->training->get_modules($module);


            $assigned_team_ids = implode(',', array_column($team_names, 'team_id'));
            $assigned_teams_display = implode(' | ', array_column($team_names, 'team_name'));


            $assigned_mod_ids = implode(',', array_column($mod_names, 'module_id'));
            $assigned_mod_display = implode(' | ', array_column($mod_names, 'mod_name'));

            if ($assigned_mod_display == '') {
                $assigned_mod_display = 'No Module Assigned | Team Meeting';
            }

            $events[] = [
                'title' => $event['team_name'],
                'start' => $event['date_meeting'],
                'extendedProps' => [
                    'added_by' => $emp['name'],
                    'mod_name' => $event['mod_name'],
                    'location' => $event['location'],
                    'reasons' => $event['reasons'],
                    'time' => $event['time'],
                    'team_name' => $event['team_name'],
                    'team_id' => $event['team_id'],
                    'mod_id' => $event['mod_id'],
                    'id' => $event['id'],
                    'mod_ids' => $assigned_mod_ids,
                    'mod_names' => $assigned_mod_display,
                    'team_ids' => $assigned_team_ids,
                    'team_names' => $assigned_teams_display
                ]
            ];
        }
        echo json_encode($events);
    }

    public function add_meeting()
    {

        $team_id = $this->input->post('team_id');
        $team_name = $this->input->post('team_name');
        $mod_id = $this->input->post('mod_id');
        $date_meeting = $this->input->post('date_meeting');
        $time = $this->input->post('time');
        $location = $this->input->post('location');
        $reasons = $this->input->post('reasons');
        $data = [];
        $data = [
            'team_id' => $team_id,
            'mod_id' => $mod_id,
            'date_meeting' => $date_meeting,
            'time' => $time,
            'location' => $location,
            'reasons' => $reasons,
            'date_added' => date('Y-m-d H:i:s'),
            'added_by' => $this->session->emp_id
        ];
        $this->meeting->insert_event($data);
        $action = '<b>' . $this->session->name . '</b> updated a meeting for <b>' . $team_name . '</b>';

        $data1 = array(
            'emp_id' => $this->session->emp_id,
            'action' => $action,
            'date_added' => date('Y-m-d H:i:s'),
        );
        $this->load->model('Logs', 'logs');
        $this->logs->addLogs($data1);

        echo json_encode(['status' => 'success']);
    }
    public function update_meeting()
    {
        $id = $this->input->post('id');
        $team_id = $this->input->post('team_id');
        $team_name = $this->input->post('team_name');
        $mod_id = $this->input->post('mod_id');
        $date_meeting = $this->input->post('date_meeting');
        $time = $this->input->post('time');
        $location = $this->input->post('location');
        $reasons = $this->input->post('reasons');


        $meeting = $this->db->get_where('meeting_sched', ['id' => $id])->row();
        if ((!$meeting || $this->session->userdata('is_admin') === 'No' || $this->session->userdata('is_admin') === null) && $this->session->userdata('position') !== 'Manager') {

            $this->db->select('meeting_sched.id');
            $this->db->from('meeting_sched');
            $this->db->join('users', 'users.team_id = meeting_sched.team_id', 'left');
            $this->db->where('users.emp_id', $this->session->userdata('emp_id'));
            $this->db->where('meeting_sched.id', $id);
            $query = $this->db->get();

            if ($query->num_rows() == 0) {
                echo json_encode(['status' => 'error', 'message' => 'Unauthorized, You cant delete others team meeting.']);
                return;
            }
        }

        $data = [
            'team_id' => $team_id,
            'mod_id' => $mod_id,
            'date_meeting' => $date_meeting,
            'time' => $time,
            'location' => $location,
            'reasons' => $reasons,
            'date_updated' => date('Y-m-d H:i:s')
        ];
        $this->meeting->update_event($data, $id);

        $action = '<b>' . $this->session->name . '</b> updated a meeting for <b>' . $team_name . '</b>';

        $data1 = array(
            'emp_id' => $this->session->emp_id,
            'action' => $action,
            'date_updated' => date('Y-m-d H:i:s'),
        );
        $this->load->model('Logs', 'logs');
        $this->logs->addLogs($data1);

        echo json_encode(['status' => 'success']);
    }


    public function delete_meeting()
    {
        $id = $this->input->post('id');
        $team = $this->input->post('team_id');


        $meeting = $this->db->get_where('meeting_sched', ['id' => $id], ['team_id' => $team])->row();
        if ((!$meeting || $this->session->userdata('is_admin') === 'No' || $this->session->userdata('is_admin') === null) && $this->session->userdata('position') !== 'Manager') {

            $this->db->select('meeting_sched.id');
            $this->db->from('meeting_sched');
            $this->db->join('users', 'users.team_id = meeting_sched.team_id', 'left');
            $this->db->join('team', 'team.team_id = users.team_id AND users.emp_id = emp_id');
            $this->db->where('users.emp_id', $this->session->userdata('emp_id'));
            $this->db->where('meeting_sched.id', $id);
            $this->db->where_in('team.team_id', $team);
            $query = $this->db->get();

            if ($query->num_rows() == 0) {
                echo json_encode(['status' => 'error', 'message' => 'Unauthorized, You can`t delete others team meeting.']);
                return;
            }
        }


        $delete = $this->meeting->delete_event($id);

        if ($delete) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete the event.']);
        }
    }


    public function get_upcoming_meetings()
    {
        $date = $this->input->get('date');
        $upcoming_events = $this->meeting->get_upcoming_meetings($date);

        foreach ($upcoming_events as &$event) {
            $team_ids = !empty($event['team_id']) ? explode(',', $event['team_id']) : [];
            $module_ids = !empty($event['m_id']) ? explode(',', $event['m_id']) : [];
            $team_names_arr = $this->training->get_teamssss($team_ids);
            $module_names_arr = $this->training->get_modules($module_ids);
            $team_names = array_column($team_names_arr, 'team_name');
            $formatted_mod_names = [];
            
            foreach ($module_names_arr as $mod) {
                if (!empty($mod['mod_name'])) {
                    $formatted_mod_names[] = ucwords(strtolower($mod['mod_name']));
                }
            }




            $event['team_names'] = !empty($team_names) ? implode(' | ', $team_names) : '';
            $event['mod_names'] = !empty($formatted_mod_names) ? implode(' | ', $formatted_mod_names) : '';
        }
        unset($event);


        echo json_encode($upcoming_events);
    }

    public function get_previous_meetings()
    {
        $date = $this->input->get('date');
        $previous_events = $this->meeting->get_previous_meetings($date);
        foreach ($previous_events as &$event) {
            $team_ids = !empty($event['team_id']) ? explode(',', $event['team_id']) : [];
            $module_ids = !empty($event['m_id']) ? explode(',', $event['m_id']) : [];
            $team_names_arr = $this->training->get_teamssss($team_ids);
            $module_names_arr = $this->training->get_modules($module_ids);
            $team_names = array_column($team_names_arr, 'team_name');
            $formatted_mod_names = [];
            foreach ($module_names_arr as $mod) {
                if (!empty($mod['mod_name'])) {
                    $formatted_mod_names[] = ucwords(strtolower($mod['mod_name']));
                }
            }
            $event['team_names'] = !empty($team_names) ? implode(' | ', $team_names) : '';
            $event['mod_names'] = !empty($formatted_mod_names) ? implode(' | ', $formatted_mod_names) : '';
        }
        unset($event);

        echo json_encode($previous_events);
    }

    public function get_scheduled_meeting()
    {
        $date_type = $this->input->post('date_type');
        if ($date_type === 'cur_calendar') {
            $events = $this->meeting->get_up_meetings();
        } else {
            $events = $this->meeting->get_prev_meetings();
        }
        echo json_encode($events);
    }



}