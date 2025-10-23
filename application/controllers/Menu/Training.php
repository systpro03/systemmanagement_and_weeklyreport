<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Training extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->username == "") {
            redirect('login');
        }
        $this->load->model('Menu/Training_mod', 'training');
        $this->load->model('Menu/Workload', 'workload');
    }

    public function training_view()
    {
        $this->load->view('_layouts/header');
        $this->load->view('menu/training');
        $this->load->view('_layouts/footer');
    }

    public function get_supervisor()
    {
        $supervisors = $this->training->get_supervisor();
        $employees = [];

        foreach ($supervisors as $sup) {
            $emp_data = $this->workload->get_employees($sup->emp_id);
            if (!empty($emp_data) && isset($emp_data[0]->name)) {
                $employees[] = [
                    'emp_id' => $sup->emp_id,
                    'emp_name' => $emp_data[0]->name
                ];
            }
        }

        echo json_encode($employees);
    }



    public function get_training()
    {
        $training = $this->training->fetch_events();
        $events = [];

        foreach ($training as $event) {
            $team = explode(',', $event['team_id']);
            $name = explode(',', $event['assigned']);
            $module = explode(',', $event['m_id']);
            $emp = $this->workload->get_emp($event['added_by']);
            $sup_name = $this->workload->get_emp($event['sup_assigned']);
            $assigned_names = $this->training->get_assigned($name);
            $team_names = $this->training->get_teamssss($team);
            $mod_names = $this->training->get_modules($module);

            $assigned_ids = implode(',', array_column($assigned_names, 'emp_id'));
            $assigned_names_display = ucwords(strtolower(implode(' | ', array_column($assigned_names, 'name'))));

            $assigned_team_ids = implode(',', array_column($team_names, 'team_id'));
            $assigned_teams_display = implode(' | ', array_column($team_names, 'team_name'));

            $assigned_mod_ids = implode(',', array_column($mod_names, 'module_id'));
            $assigned_mod_display = implode(' | ', array_column($mod_names, 'mod_name'));

            if (strpos($event['date_training'], ' to ') !== false) {
                list($start, $end) = explode(' to ', $event['date_training']);

                $startDate = $start;
                $endDate = date('Y-m-d', strtotime($end . ' +1 day'));

            } else {
                $startDate = $event['date_training'];
                $endDate = null;
            }



            $events[] = [
                'title' => $event['team_name'],
                'start' => $startDate,
                'end' => $endDate,
                'extendedProps' => [
                    'added_by' => ucwords(strtolower($emp['name'])),
                    'mod_name' => $event['mod_name'],
                    'training_loc' => $event['training_loc'],
                    'reasons' => $event['reasons'],
                    'time' => $event['time'],
                    'team_name' => $event['team_name'],
                    'team_id' => $event['team_id'],
                    'mod_id' => $event['mod_id'],
                    'id' => $event['id'],
                    'sup_assigned' => $event['sup_assigned'],
                    'sup_assigned_name' => ucwords(strtolower($sup_name['name'])) ?: 'N/A',
                    'assigned' => $assigned_names_display,
                    'assigned_ids' => $assigned_ids,
                    'team_ids' => $assigned_team_ids,
                    'team_names' => $assigned_teams_display,
                    'mod_ids' => $assigned_mod_ids,
                    'mod_names' => $assigned_mod_display
                ]
            ];
        }

        echo json_encode($events);
    }


    public function add_training()
    {

        $team_id = $this->input->post('team_id');
        $team_name = $this->input->post('team_name');
        $mod_id = $this->input->post('mod_id');
        $training_date = $this->input->post('training_date');
        $time = $this->input->post('time');
        $location = $this->input->post('location');
        $reasons = $this->input->post('reasons');
        $name = $this->input->post('name');
        $supervisor = $this->input->post('supervisor');
        $data = [];
        $data = [
            'team_id' => $team_id,
            'mod_id' => $mod_id,
            'date_training' => $training_date,
            'time' => $time,
            'training_loc' => $location,
            'reasons' => $reasons,
            'date_added' => date('Y-m-d H:i:s'),
            'added_by' => $this->session->emp_id,
            'assigned' => $name,
            'sup_assigned' => $supervisor
        ];
        $this->training->insert_event($data);
        $action = '<b>' . $this->session->name . '</b> updated a training for <b>' . $team_name . '</b>';

        $data1 = array(
            'emp_id' => $this->session->emp_id,
            'action' => $action,
            'date_added' => date('Y-m-d H:i:s'),
        );
        $this->load->model('Logs', 'logs');
        $this->logs->addLogs($data1);

        echo json_encode(['status' => 'success']);
    }
    public function update_training()
    {
        $id = $this->input->post('id');
        $team_id = $this->input->post('team_id');
        $team_name = $this->input->post('team_name');
        $mod_id = $this->input->post('mod_id');
        $training_date = $this->input->post('training_date');
        $time = $this->input->post('time');
        $location = $this->input->post('location');
        $reasons = $this->input->post('reasons');
        $name = $this->input->post('name');
        $supervisor = $this->input->post('supervisor');

        $training = $this->db->get_where('training', ['id' => $id])->row();


        if ((!$training || $this->session->userdata('is_admin') === 'No' || $this->session->userdata('is_admin') === null) && $this->session->userdata('position') !== 'Manager') {

            $this->db->select('training.id');
            $this->db->from('training');
            $this->db->join('users', 'users.team_id = training.team_id', 'left');
            $this->db->where('users.emp_id', $this->session->userdata('emp_id'));
            $this->db->where('training.id', $id);
            $query = $this->db->get();

            if ($query->num_rows() == 0) {
                echo json_encode(['status' => 'error', 'message' => 'Unauthorized, You cant delete others team meeting.']);
                return;
            }
        }


        $data = [
            'team_id' => $team_id,
            'mod_id' => $mod_id,
            'date_training' => $training_date,
            'time' => $time,
            'training_loc' => $location,
            'reasons' => $reasons,
            'date_updated' => date('Y-m-d H:i:s'),
            'assigned' => $name,
            'sup_assigned' => $supervisor
        ];

        $this->training->update_event($data, $id);

        $action = '<b>' . $this->session->name . '</b> updated a training for <b>' . $team_name . '</b>';

        $data1 = array(
            'emp_id' => $this->session->emp_id,
            'action' => $action,
            'date_updated' => date('Y-m-d H:i:s'),
        );
        $this->load->model('Logs', 'logs');
        $this->logs->addLogs($data1);

        echo json_encode(['status' => 'success']);
    }


    public function delete_training()
    {
        $id = $this->input->post('id');
        $team = $this->input->post('team_id');
        $training = $this->db->get_where('training', ['id' => $id], ['team_id' => $team])->row();


        if ((!$training || $this->session->userdata('is_admin') === 'No' || $this->session->userdata('is_admin') === null) && $this->session->userdata('position') !== 'Manager') {

            $this->db->select('training.id');
            $this->db->from('training');
            $this->db->join('users', 'users.team_id = training.team_id', 'left');
            $this->db->join('team', 'team.team_id = users.team_id AND users.emp_id = emp_id');
            $this->db->where('users.emp_id', $this->session->userdata('emp_id'));
            $this->db->where('training.id', $id);
            $this->db->where_in('team.team_id', $team);
            $query = $this->db->get();

            if ($query->num_rows() == 0) {
                echo json_encode(['status' => 'error', 'message' => 'Unauthorized, You cant delete others team meeting.']);
                return;
            }
        }


        $this->training->delete_event($id);
        echo json_encode(['status' => 'success']);
    }

    public function get_upcoming_trainings()
    {
        $date = $this->input->get('date');
        $upcoming_events = $this->training->get_upcoming_trainings($date);

        foreach ($upcoming_events as &$event) {
            $emp_ids = explode(',', $event['assigned']);
            $team_ids = explode(',', $event['team_id']);
            $module = explode(',', $event['m_id']);
            $sup_name = $this->workload->get_emp($event['sup_assigned']);


            $assigned_names = $this->training->get_assigned($emp_ids);
            $team_names = $this->training->get_teamssss($team_ids);
            $mod_names = $this->training->get_modules($module);

            $event['assigned_names'] = ucwords(strtolower(implode(' | ', array_column($assigned_names, 'name'))));
            $event['team_names'] = implode(' | ', array_column($team_names, 'team_name'));
            $event['mod_names'] = implode(' | ', array_column($mod_names, 'mod_name'));
            $event['assigned_sup'] = ucwords(strtolower($sup_name['name']));
        }

        echo json_encode($upcoming_events);
    }

    public function get_previous_trainings()
    {
        $date = $this->input->get('date');
        $previous_events = $this->training->get_previous_trainings($date);

        foreach ($previous_events as &$event) {
            $emp_ids = explode(',', $event['assigned']);
            $team_ids = explode(',', $event['team_id']);
            $module = explode(',', $event['m_id']);
            $sup_name = $this->workload->get_emp($event['sup_assigned']);


            $assigned_names = $this->training->get_assigned($emp_ids);
            $team_names = $this->training->get_teamssss($team_ids);
            $mod_names = $this->training->get_modules($module);

            $event['assigned_names'] = ucwords(strtolower(implode(' | ', array_column($assigned_names, 'name'))));
            $event['team_names'] = implode(' | ', array_column($team_names, 'team_name'));
            $event['mod_names'] = implode(' | ', array_column($mod_names, 'mod_name'));
            $event['assigned_sup'] = ucwords(strtolower($sup_name['name']));
        }

        echo json_encode($previous_events);
    }

    public function get_scheduled_training()
    {
        $date_type = $this->input->post('date_type');
        if ($date_type === 'cur_calendar') {
            $events = $this->training->get_up_trainings();
        } else {
            $events = $this->training->get_prev_trainings();
        }
        echo json_encode($events);
    }


}