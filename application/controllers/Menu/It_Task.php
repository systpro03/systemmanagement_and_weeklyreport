<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class It_Task extends CI_Controller {

    function __construct() {
		parent::__construct();
        if ($this->session->username == "") {
            redirect('login');
        }
        $this->load->model('Menu/Task_mod', 'task');
        $this->load->model('Menu/Workload', 'workload');
	}

	public function index()
	{
		$this->load->view('_layouts/header');
		$this->load->view('menu/it_task');
		$this->load->view('_layouts/footer');

	}
    public function it_task_list() {

        $team           = $this->input->post('team');
        $module         = $this->input->post('module');
        $date_range     = $this->input->post('date_range');
        $start          = $this->input->post('start');
        $length         = $this->input->post('length');
        $order          = $this->input->post('order');
        $search_value   = $this->input->post('search')['value'];
        $order_column   = $order[0]['column'];
        $order_dir      = $order[0]['dir'];

        $task = $this->task->gettasks($date_range, $module, $team, $start, $length, $order_column, $order_dir, $search_value);
        $data = [];
    
        foreach ($task as $row) {
            if($row['sub_mod_id'] == 0){
                $sub_mod_name = '<span class="badge bg-info">NA</span>';
            }else{
                $sub_mod_name = ucwords(strtolower( $row['sub_mod_name']));
            }

            $emp_data = $this->workload->get_emp($row['emp_id']);

            $data[] = [
                'task_id'           => $row['task_id'],
                'emp_name'          => ucwords(strtolower( $emp_data['name'])),
                'module'            => ucwords(strtolower( $row['mod_name'])),
                'sub_mod_name'      => $sub_mod_name,
                'desc'              => ucwords(strtolower( $row['desc'])),
                'concerns'          => ucwords(strtolower( $row['concerns'])),
                'remarks'           => ucwords(strtolower( $row['remarks'])),
                'task_status'       => $row['task_status'],
                'action' => '
                    <div class="hstack gap-1">
                        <button type="button" class="btn btn-soft-secondary waves-effect waves-light btn-sm" onclick="edit_task_content(' . $row['task_id'] . ')" data-bs-toggle="modal" data-bs-target="#edit_task">
                            <iconify-icon icon="solar:pen-bold-duotone" class="label-icon align-bottom fs-16"></iconify-icon>
                        </button>
                        <button type="button" class="btn btn-soft-danger waves-effect waves-light btn-sm" onclick="delete_task(' . $row['task_id'] . ')">
                            <iconify-icon icon="solar:trash-bin-minimalistic-bold-duotone" class="label-icon align-bottom fs-16"></iconify-icon>
                        </button>
                    </div>
                '
            ];
        }
        
        $total_records = $this->task->getTotaltasks($date_range, $module, $team, $search_value);

        $output = [
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => $total_records,
            "recordsFiltered" => $total_records,
            "data" => $data
        ];
        echo json_encode($output);
    }
    public function submit_task(){
        $team               = $this->input->post('team');
        $emp_name           = $this->input->post('emp_name');
        $emp_id             = $this->input->post('emp_id');
        $module             = $this->input->post('module');
        $sub_module         = $this->input->post('sub_module');
        $desc               = $this->input->post('desc');
        $concerns           = $this->input->post('concern');
        $remarks            = $this->input->post('remarks');
        $status             = $this->input->post('task_status');
        $data = [];
        $data = [
            'team_id'       => $team,
            'emp_id'        => $emp_id,
            'mod_id'        => $module,
            'sub_mod_id'    => $sub_module,
            'desc'          => $desc,
            'concerns'      => $concerns,
            'remarks'       => $remarks,
            'task_status'   => $status,
            'date_added'    => date('Y-m-d H:i:s')
        ];
        $this->task->add_task($data);
        $action = '<b>' . $this->session->name. '</b> added a task to <b>'.$emp_name.'</b>';

        $data1 = array(
            'emp_id' => $this->session->emp_id,
            'action' => $action,
            'date_added' => date('Y-m-d H:i:s'),
        );
        $this->load->model('Logs', 'logs');
        $this->logs->addLogs($data1);
        
    }

	public function edit_task_content() {
        $id = $this->input->post('task_id');
        $data = $this->task->get_task_data($id);
        echo json_encode($data);
    }
    public function update_task_content(){
        $id                 = $this->input->post('task_id');
        $team               = $this->input->post('team');
        $emp_name           = $this->input->post('emp_name');
        $emp_id             = $this->input->post('emp_id');
        $module             = $this->input->post('module');
        $sub_module         = $this->input->post('sub_module');
        $desc               = $this->input->post('desc');
        $concerns           = $this->input->post('concern');
        $remarks            = $this->input->post('remarks');
        $status             = $this->input->post('task_status');
        $data = [];
        $data = [
            'team_id'       => $team,
            'emp_id'        => $emp_id,
            'mod_id'        => $module,
            'sub_mod_id'    => $sub_module,
            'desc'          => $desc,
            'concerns'      => $concerns,
            'remarks'       => $remarks,
            'task_status'   => $status,
            'date_updated'  => date('Y-m-d H:i:s')
        ];
        $this->task->update_task($data, $id);
        $action = '<b>' . $this->session->name. '</b> updated a task to <b>'.$emp_name.'</b>';

        $data1 = array(
            'emp_id' => $this->session->emp_id,
            'action' => $action,
            'date_updated' => date('Y-m-d H:i:s'),
        );
        $this->load->model('Logs', 'logs');
        $this->logs->addLogs($data1);
    }

    public function update_task_status(){
        $id             = $this->input->post('id');
        $task_status    = $this->input->post('task_status');
        $emp_name       = $this->input->post('emp_name');

        $this->db->where('task_id', $id);
        $this->db->set('task_status', $task_status);
        $this->db->update('daily_task');

        $action = '<b>' . $this->session->name. '</b> updated a daily task report status of <b>'.$emp_name.'</b> to <b>'.$task_status.'</b>';

        $data1 = array(
            'emp_id' => $this->session->emp_id,
            'action' => $action,
            'date_added' => date('Y-m-d H:i:s'),
        );
        $this->load->model('Logs', 'logs');
        $this->logs->addLogs($data1);


    }

    public function delete_task(){
        $id = $this->input->post('task_id');
        $this->task->delete_task($id);
    }
}