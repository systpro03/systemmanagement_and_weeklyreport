<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ServerAddress extends CI_Controller {
	function __construct()
	{
		parent::__construct();
        if ($this->session->username == "") {
            redirect('login');
        }
		$this->load->model('ServerAddress_mod', 'server');
        $this->load->model('Menu/Workload', 'workload');
	}

    public function index(){
        $this->load->view('_layouts/header');
        $this->load->view('serveraddress');
        $this->load->view('_layouts/footer');
    }

    public function server_list()
    {
        $team = $this->input->post('team');
        $module = $this->input->post('module');
        $start = $this->input->post('start') ?: 0;
        $length = $this->input->post('length') ?: 10;
        $order = $this->input->post('order') ?: [];
        $search_value = $this->input->post('search')['value'] ? : '';
    
        $order_column = !empty($order) ? $order[0]['column'] : 'team_id';
        $order_dir = !empty($order) ? $order[0]['dir'] : 'asc';
    
        $serverlist = $this->server->get_server_list($team, $module, $start, $length, $search_value, $order_column, $order_dir);
        $total_filtered = $this->server->get_server_count($team, $module, $search_value);
    
        $result = [
            'draw' => $this->input->post('draw'),
            'recordsTotal' => $total_filtered,
            'recordsFiltered' => $total_filtered,
            'data' => []
        ];
    
        $formatted_data = [];
        
        // Fetch teams and prepare color mapping
        $teams = $this->db->where('team_id !=', 10)
                          ->get('team')
                          ->result_array();
    
        $colors = [
            'bg-color-1', 'bg-color-2', 'bg-color-3', 'bg-color-4',
            'bg-color-5', 'bg-color-6', 'bg-color-7', 'bg-color-8', 'bg-color-9'
        ];
    
        $team_colors = [];
        foreach ($teams as $index => $team) {
            $team_colors[strtoupper(trim($team['team_name']))] = $colors[$index % count($colors)];
        }
    
        foreach ($serverlist as $value) {
            $team_name = ucwords(strtoupper($value['team_name']));
            $module_name = ucwords(strtolower($value['mod_name'])) . 
                           ' [  <strong class="badge bg-info">' . strtoupper($value['mod_abbr']) . ' </strong> ]';
    
            $server = !empty($value['server']) ? $value['server'] :
                      '<span class="badge rounded-pill bg-danger-subtle text-danger">No Contact Number</span>';
    
            if (!isset($formatted_data[$team_name])) {
                $formatted_data[$team_name] = [];
            }
    
            if (!isset($formatted_data[$team_name][$module_name])) {
                $formatted_data[$team_name][$module_name] = [];
            }
    
            $formatted_data[$team_name][$module_name][] = [
                'server_id' => $value['server_id'],
                'server'    => $server,
                'database'  => $value['db_name'],
                'details'  => $value['details'],
                'username'  => $value['username'],
                'password'  => md5($value['password']),
                'location'    => $value['location'],
                'team_color' => $team_colors[$team_name] ?: 'bg-white'
            ];
        }
    
        foreach ($formatted_data as $team_name => $modules) {
            $first_team = true;
            foreach ($modules as $module_name => $servers) {
                $first_module = true;
                foreach ($servers as $server_data) {
                    if($server_data['details'] === ''){
                        $details = '<span class="badge bg-info">N/A</span>';
                    }else{
                        $details = $server_data['details'];
                    }
                    $server_id = isset($server_data['server_id']) ? $server_data['server_id'] : '';

                    $result['data'][] = [
                        'team'      => $first_team ? $team_name : '',
                        'team_color'=> $team_colors[$team_name] ?: 'bg-white',
                        'module'    => $first_module ? $module_name : '',
                        'details'   => $details,
                        'server'    => $server_data['server'],
                        'database'  => $server_data['database'],
                        'username'  => str_repeat('*', strlen($server_data['username'])),
                        'password'  => str_repeat('*', min(15, strlen($server_data['password']))),
                        'location'    => $server_data['location'],
                        'action'    => '

                                    <div class="hstack gap-1">
                                        <button type="button" class="btn btn-soft-secondary waves-effect waves-light btn-sm" onclick="edit_server(' .$server_id . ')" data-bs-toggle="modal" data-bs-target="#editServerModal">
                                            <iconify-icon icon="solar:pen-bold-duotone" class="label-icon align-bottom fs-16"></iconify-icon> 

                                        </button>
                                        <button type="button" class="btn btn-soft-danger waves-effect waves-light btn-sm" onclick="delete_server(' .$server_id . ')">
                                            <iconify-icon icon="solar:trash-bin-minimalistic-bold-duotone" class="label-icon align-bottom fs-16"></iconify-icon>
                                        </button>
                                    </div>
                    
                    '
                        ];
                    $first_team = false;
                    $first_module = false;
                }
            }
        }
    
        echo json_encode($result);
    }
    
    public function submit_server()
    {

        $team       = $this->input->post('team');
        $module     = $this->input->post('module');
        $details    = $this->input->post('details');
        $server     = $this->input->post('server');
        $db_name    = $this->input->post('db_name');
        $username   = $this->input->post('username');
        $password   = $this->input->post('password');
        $location   = $this->input->post('location');
    
    
        $data = [
            'team'      => $team,
            'module'    => $module,
            'details'   => $details,
            'server'    => $server,
            'db_name'   => $db_name,
            'username'  => $username,
            'password'  => md5($password),
            'location'  => $location
        ];
    
        $this->db->insert('server', $data);

    }


    public function edit_server_data(){
        $id = $this->input->post('id');
        $server = $this->server->edit_server($id);
        echo json_encode($server);
    }

    public function update_server()
    {

        $id         = $this->input->post('id');
        $team       = $this->input->post('team');
        $module     = $this->input->post('module');
        $details    = $this->input->post('details');
        $server     = $this->input->post('server');
        $db_name    = $this->input->post('db_name');
        $username   = $this->input->post('username');
        $password   = $this->input->post('password');
        $location   = $this->input->post('location');
    
        $data = [
            'team'      => $team,
            'module'    => $module,
            'details'   => $details,
            'server'    => $server,
            'db_name'   => $db_name,
            'username'  => $username,
            'password'  => md5($password),
            'location'  => $location
        ];
    
        $this->db->where('server_id', $id);
        $updated = $this->db->update('server', $data);
    
        if ($updated) {
            echo json_encode(['status' => 'success', 'message' => 'Server updated successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update server']);
        }
    }

    public function delete_server(){
        $id = $this->input->post('id');
        $this->db->where('server_id', $id);
        $this->db->delete('server');
    }
    
    
    
}