<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->username == "") {
            redirect('login');
        }
        $this->load->model('Menu/Location_mod', 'location');
    }
    public function index() {
        $this->load->view('_layouts/header');
        $this->load->view('menu/setup_location');
        $this->load->view('_layouts/footer');
    }


    public function module_list_implemented() {
        
        $typeofsystem = $this->input->post('typeofsystem');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $order = $this->input->post('order');
        $search_value = $this->input->post('search')['value'];
        $order_column = $order[0]['column'];
        $order_dir = $order[0]['dir'];


        $location_setup = $this->location->module_list_implemented($typeofsystem, $start, $length, $order_column, $order_dir, $search_value);
        $data = [];
    
        foreach ($location_setup as $row) {
            if($row['typeofsystem'] == 'current') {
                $type = '<span class="badge bg-success">'.$row['typeofsystem'].'</span>';
            }else{
                $type = '<span class="badge bg-danger ">'.$row['typeofsystem'].'</span>';
            }
            $data[] = [
                'module'           => ucwords(strtolower($row['mod_name'])). ' [ ' . '<span class="badge bg-info">'.$row['mod_abbr'].' </span> ]',
                'type'             => $type,
                'action'           => '
                    <div class="hstack gap-1 justify-content-center">
                        <button type="button" class="btn btn-soft-secondary btn-label waves-effect waves-light btn-sm" onclick="module_list_implemented_modal(' . $row['mod_id'] . ', \''.$row['typeofsystem'].'\')" data-bs-toggle="modal" data-bs-target="#module_list_implemented_modal">
                            <iconify-icon icon="ri:list-view" class="label-icon align-bottom fs-16 me-2"></iconify-icon> View Data
                        </button>
                    </div>
                '
            ];
        }
        
        $total_records = $this->location->get_total_module_list_implemented($typeofsystem, $search_value);

        $output = [
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => $total_records,
            "recordsFiltered" => $total_records,
            "data" => $data
        ];
        echo json_encode($output);
    }




    public function setup_location_list() {

        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $order = $this->input->post('order');
        $search_value = $this->input->post('search')['value'];
        $order_column = $order[0]['column'];
        $order_dir = $order[0]['dir'];
        $module_id = $this->input->post('mod_id');
        $typeofsystem = $this->input->post('typeofsystem');

        if ($typeofsystem === 'new') {
            $location_setup = $this->location->get_location_data($module_id, $start, $length, $order_column, $order_dir, $search_value);
            $data = [];
        
            foreach ($location_setup as $row) {
    
                $company        = $this->location->company($row['requested_to_co']);
                $business_unit  = $this->location->business_unit($row['requested_to_bu'], $row['requested_to_dep']);
                $department     = $this->location->department($row['requested_to_dep']);
    
                $sub_mod_name = !empty($row['sub_mod_name']) 
                ? ucwords(strtolower($row['sub_mod_name'])) 
                : '<span class="badge bg-secondary">N/A</span>';
            
                $others = !empty($row['others']) 
                    ? ucwords(strtolower($row['others'])) 
                    : '<span class="badge bg-secondary">N/A</span>';

                $date_parallel = !empty($row['date_parallel']) 
                    ? date('F j, Y', strtotime($row['date_parallel'])) 
                    : '<span class="badge bg-secondary">N/A</span>';

                $date_implem = !empty($row['date_implem']) 
                    ? date('F j, Y', strtotime($row['date_implem'])) 
                    : '<span class="badge bg-secondary">N/A</span>';

                $dept_name = !empty($department['dept_name']) 
                ? ucwords(strtolower($department['dept_name'])) 
                : '<span class="badge bg-secondary">N/A</span>';
            
                $data[] = [
                    'company'          => ucwords(strtolower( $company['company'])),
                    'business_unit'    => ucwords(strtolower( $business_unit['business_unit'])),
                    'department'       => $dept_name,
                    'module'           => ucwords(strtolower( $row['mod_name'])),
                    'sub_module'       => $sub_mod_name,
                    'date_parallel'    => $date_parallel,
                    'date_implem'      => $date_implem,
                    'remarks'          => $others
                ];
            }
            
            $total_records = $this->location->get_total_location_data($module_id, $search_value);
            $output = [
                "draw" => intval($this->input->post('draw')),
                "recordsTotal" => $total_records,
                "recordsFiltered" => $total_records,
                "data" => $data
            ];
            echo json_encode($output);

        }else{
            $location_setup = $this->location->get_location_data_current($module_id, $start, $length, $order_column, $order_dir, $search_value);
            $data = [];
        
            foreach ($location_setup as $row) {
    
                $company        = $this->location->company($row['requested_to_co']);
                $business_unit  = $this->location->business_unit($row['requested_to_co'],$row['requested_to_bu']);
                $department     = $this->location->department($row['requested_to_dep']);
    
                $sub_mod_name = !empty($row['sub_mod_name']) 
                ? ucwords(strtolower($row['sub_mod_name'])) 
                : '<span class="badge bg-secondary">N/A</span>';
            
                $others = !empty($row['others']) 
                    ? ucwords(strtolower($row['others'])) 
                    : '<span class="badge bg-secondary">N/A</span>';

                $date_parallel = !empty($row['date_parallel']) 
                    ? date('F j, Y', strtotime($row['date_parallel'])) 
                    : '<span class="badge bg-secondary">N/A</span>';

                $date_implem = !empty($row['date_implem']) 
                    ? date('F j, Y', strtotime($row['date_implem'])) 
                    : '<span class="badge bg-secondary">N/A</span>';

                $dept_name = !empty($department['dept_name']) 
                    ? ucwords(strtolower($department['dept_name'])) 
                    : '<span class="badge bg-secondary">N/A</span>';
                $data[] = [
                    'company'          => ucwords(strtolower( $company['company'])),
                    'business_unit'    => ucwords(strtolower( $business_unit['business_unit'])),
                    'department'       =>  $dept_name,
                    'module'           => ucwords(strtolower( $row['mod_name'])),
                    'sub_module'       => $sub_mod_name,
                    'date_parallel'    => $date_parallel,
                    'date_implem'      => $date_implem,
                    'remarks'          => $others
                ];
            }
            
            $total_records = $this->location->get_total_location_data_current($module_id, $search_value);
            $output = [
                "draw" => intval($this->input->post('draw')),
                "recordsTotal" => $total_records,
                "recordsFiltered" => $total_records,
                "data" => $data
            ];
            echo json_encode($output);
        }


    }

    public function setup_location()
    {
        $loc = $this->location->setup_location();
        echo json_encode($loc);
    }
    public function submit_location()
    {
        $company            = $this->input->post('company');
        $company_name       = $this->input->post('company_name');
        $business_unit      = $this->input->post('business_unit');
        $business_unit_name = $this->input->post('business_unit_name');
        $department         = $this->input->post('department');
        $module             = $this->input->post('module');
        $sub_module         = $this->input->post('sub_module');
        $date_parallel      = $this->input->post('date_parallel');
        $date_online        = $this->input->post('date_online');
        $remarks            = $this->input->post('remarks');

        $data = [];
        $data = [
            'company'            => $company,
            'business_unit'      => $business_unit,
            'department'         => $department,
            'mod_id'             => $module,
            'sub_mod_id'         => $sub_module,
            'date_parallel'      => $date_parallel,
            'date_online'        => $date_online,
            'remarks'            => $remarks,
            'date_added'         => date('Y-m-d H:i:s')
        ];
        $this->location->submit_location($data);
        $action = '<b>' . $this->session->name. '</b> setup a location implemented to <b>'.$company_name.' | '.$business_unit_name.'</b>';

        $data1 = array(
            'emp_id' => $this->session->emp_id,
            'action' => $action,
            'date_added' => date('Y-m-d H:i:s'),
        );
        $this->load->model('Logs', 'logs');
        $this->logs->addLogs($data1);
    }
    public function edit_setup_location_content() {
        $id = $this->input->post('id');
        $data = $this->location->get_setup_location_data($id);
        echo json_encode($data);
    }
    public function update_location()
    {
        $id                 = $this->input->post('id');
        $company            = $this->input->post('company');
        $company_name       = $this->input->post('company_name');
        $business_unit      = $this->input->post('business_unit');
        $business_unit_name = $this->input->post('business_unit_name');
        $department         = $this->input->post('department');
        $module             = $this->input->post('module');
        $sub_module         = $this->input->post('sub_module');
        $date_parallel      = $this->input->post('date_parallel');
        $date_online        = $this->input->post('date_online');
        $remarks            = $this->input->post('remarks');

        $data = [];
        $data = [
            'company'            => $company,
            'business_unit'      => $business_unit,
            'department'         => $department,
            'mod_id'             => $module,
            'sub_mod_id'         => $sub_module,
            'date_parallel'      => $date_parallel,
            'date_online'        => $date_online,
            'remarks'            => $remarks,
            'date_updated'       => date('Y-m-d H:i:s')
        ];
        $this->location->update_location($data, $id );
        $action = '<b>' . $this->session->name. '</b> updated setup location implemented to <b>'.$company_name.' | '.$business_unit_name.'</b>';

        $data1 = array(
            'emp_id' => $this->session->emp_id,
            'action' => $action,
            'date_updated' => date('Y-m-d H:i:s'),
        );
        $this->load->model('Logs', 'logs');
        $this->logs->addLogs($data1);
    }
    public function delete_setup_location() {
        $id = $this->input->post('id');
        $this->location->delete_setup_location($id);
    }
}