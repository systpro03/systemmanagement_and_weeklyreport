<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->username == "") {
            redirect('login');
        }
        $this->load->model('Admin_mod', 'admin');
        $this->load->model('Menu/Workload', 'workload');
        $this->load->model('Menu/Gantt_mod', 'gantt');
        $this->load->library('PDF', ['base_url' => base_url()]);
        $this->load->model('Menu/Structure_mod', 'structure');

        $user_id = $this->session->userdata('id');
        $query = $this->db->get_where('users', ['id' => $user_id]);
        $user = $query->row();

        if ($user) {
            if ($this->session->userdata('is_admin') != $user->is_admin) {
                $this->session->set_userdata('is_admin', $user->is_admin);
            }
            if ($this->session->userdata('is_supervisor') != $user->is_supervisor) {
                $this->session->set_userdata('is_supervisor', $user->is_supervisor);
            }
            if ($this->session->userdata('team_id') != $user->team_id) {
                $this->session->set_userdata('team_id', $user->team_id);
            }
            if ($this->session->userdata('position') != $user->position) {
                $this->session->set_userdata('position', $user->position);
            }
        }
    }
    public function add_user_view()
    {
        $this->load->view('_layouts/header');
        $this->load->view('admin/add_user');
        $this->load->view('_layouts/footer');
    }
    public function user_list()
    {
        $filter_team = $this->input->post('filter_team');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $order = $this->input->post('order');
        $search_value = $this->input->post('search')['value'];
        $order_column = $order[0]['column'];
        $order_dir = $order[0]['dir'];
        $userlist = $this->admin->get_user_list($filter_team, $start, $length, $search_value, $order_column, $order_dir);
        $total_filtered = $this->admin->get_user_count($filter_team, $search_value);

        $result = [
            'draw' => $this->input->post('draw'),
            'recordsTotal' => $total_filtered,
            'recordsFiltered' => $total_filtered,
            'data' => []
        ];

        foreach ($userlist as $value) {
            $emp_data = $this->workload->get_emp($value['emp_id']);

            $button = '<button href="#" class="btn btn-sm btn-soft-info waves-effect waves-light" onclick="update_user_content(\'' . $value['id'] . '\', \'' . ucwords(strtolower($emp_data['name'])) . '\')" data-bs-toggle="modal" data-bs-target="#updateUser"><iconify-icon icon="solar:pen-new-round-bold-duotone" class="label-icon align-bottom fs-16"></iconify-icon></button>
                    <button type="button" class="btn btn-soft-danger waves-effect waves-light btn-sm" onclick="reset_password(' . $value['id'] . ', \'' . $value['emp_id'] . '\')"><iconify-icon icon="tabler:refresh-alert" class="label-icon align-bottom fs-16"></iconify-icon></button>
                    <button type="button" class="btn btn-soft-danger waves-effect waves-light btn-sm" onclick="delete_user(' . $value['id'] . ')"><iconify-icon icon="solar:trash-bin-minimalistic-bold-duotone" class="label-icon align-bottom fs-16"></iconify-icon></button>
                        </button>';
            $type = '';
            if ($value['type'] == 'Parttime') {
                $type = '<span class="badge rounded-pill bg-danger-subtle text-danger">Parttime</span>';
            } else {
                $type = '<span class="badge rounded-pill bg-success-subtle text-success">Fulltime</span>';
            }
            $contact_no = '';

            if ($value['contact_no'] == null || $value['contact_no'] == '') {
                $contact_no = '<span class="badge rounded-pill bg-danger-subtle text-danger">No Contact Number</span>';
            } else {
                $contact_no = $value['contact_no'];
            }
            $is_admin = '';
            $is_supervisor = '';
            $is_manager_key = '';
            if ($value['is_admin'] == 'Yes' && $value['type'] == 'Fulltime') {
                $is_admin = '<div class="form-check form-switch form-switch-secondary text-center">
                                <input class="form-check-input" type="checkbox" role="switch" 
                                onclick="update_admin_disable(' . $value['id'] . ',\'' . $value['emp_id'] . '\')" checked>
                             </div>';
            } else if ($value['type'] == 'Fulltime') {
                $is_admin = '<div class="form-check form-switch form-switch-secondary text-center">
                                <input class="form-check-input" type="checkbox" role="switch" 
                                onclick="update_admin_enable(' . $value['id'] . ', \'' . $value['emp_id'] . '\')">
                             </div>';
            }


            if ($value['is_supervisor'] == 'Yes' && $value['type'] == 'Fulltime') {
                $is_supervisor = '<div class="form-check form-switch form-switch-warning text-center">
                                <input class="form-check-input" type="checkbox" role="switch" 
                                onclick="update_sup_disable(' . $value['id'] . ',\'' . $value['emp_id'] . '\')" checked>
                             </div>';
            } else if ($value['type'] == 'Fulltime') {
                $is_supervisor = '<div class="form-check form-switch form-switch-warning text-center">
                                <input class="form-check-input" type="checkbox" role="switch" 
                                onclick="update_sup_enable(' . $value['id'] . ', \'' . $value['emp_id'] . '\')">
                             </div>';
            }
            $emp_no = ltrim($emp_data['emp_no'], '0');
            if ($value['is_manager_key'] == 'Yes' && $value['type'] == 'Fulltime') {
                $is_manager_key = '<div class="form-check form-switch form-switch-danger text-center">
                                <input class="form-check-input" type="checkbox" role="switch" 
                                onclick="update_key_disable(' . $value['id'] . ',\'' . $value['emp_id'] . '\',\'' . $emp_no . '\')" checked>
                             </div>';
            } else if ($value['type'] == 'Fulltime') {
                $is_manager_key = '<div class="form-check form-switch form-switch-danger text-center">
                                <input class="form-check-input" type="checkbox" role="switch" 
                                onclick="update_key_enable(' . $value['id'] . ', \'' . $value['emp_id'] . '\',\'' . $emp_no . '\')">
                             </div>';
            }


            $emp = $this->structure->get_emp($value['emp_id']);

            $image = !empty($emp['photo']) ? ltrim($emp['photo'], '.') : '';

            if ($image === '') {
                $photo = '<img src="http://172.16.161.34:8080/hrms/default.png" alt="No Photo" class="rounded-circle avatar-sm material-shadow">';
            } else {
                $photo = '<img src="http://172.16.161.34:8080/hrms/' . $image . '" class="rounded-circle avatar-sm material-shadow">';
            }



            $result['data'][] = [
                'team_name' => ucwords(strtolower($value['team_name'])),
                'emp_id' => $value['emp_id'],
                'name'           => '
                    <div class="d-flex align-items-start">
                        ' . $photo . '
                        <div class="ms-2">
                            <div class="fw-semibold">' . ucwords(strtolower($emp_data['name'])) . '</div>
                            <div class="text-muted small">' . htmlspecialchars($emp_data['position']) . '</div>
                        </div>
                    </div>',
                'contact_no' => $contact_no,
                'ip_address' => $value['ip_address'],
                'position' => $emp_data['position'],
                'type' => $type,
                'is_admin' => $is_admin,
                'is_supervisor' => $is_supervisor,
                'is_manager_key' => $is_manager_key,
                'action' => $button
            ];
        }

        echo json_encode($result);
    }
    public function update_admin_enable()
    {
        $id = $this->input->post('id');
        $emp = $this->input->post('emp_id');

        $this->db->set('is_admin', 'Yes');
        $this->db->where('id', $id);
        $this->db->update('users');

    }

    public function update_admin_disable()
    {
        $id = $this->input->post('id');
        $emp = $this->input->post('emp_id');

        $this->db->set('is_admin', 'No');
        $this->db->where('id', $id);
        $this->db->update('users');

    }

    public function update_sup_enable()
    {
        $id = $this->input->post('id');
        $emp = $this->input->post('emp_id');

        $this->db->set('is_supervisor', 'Yes');
        $this->db->where('id', $id);
        $this->db->update('users');

    }

    public function update_sup_disable()
    {
        $id = $this->input->post('id');
        $emp = $this->input->post('emp_id');

        $this->db->set('is_supervisor', 'No');
        $this->db->where('id', $id);
        $this->db->update('users');

    }

    public function update_key_enable()
    {
        $id = $this->input->post('id');
        $emp = $this->input->post('emp_id');
        $emp_no = $this->input->post('emp_no');

        $this->db->set('is_manager_key', 'Yes');
        $this->db->set('manager_key', $emp_no);
        $this->db->where('id', $id);
        $this->db->update('users');

    }

    public function update_key_disable()
    {
        $id = $this->input->post('id');
        $emp = $this->input->post('emp_id');

        $this->db->set('is_manager_key', 'No');
        $this->db->set('manager_key', '');
        $this->db->where('id', $id);
        $this->db->update('users');

    }

    public function delete_user()
    {
        $id = $this->input->post('id');

        $this->db->set('is_active', 'Inactive');
        $this->db->set('status', 'Inactive');
        $this->db->where('id', $id);
        return $this->db->update('users');
    }



    public function search()
    {
        $search = $this->input->get('query', TRUE);
        $employees = $this->admin->get_employees($search);
        $data = [];

        foreach ($employees as $employee) {
            $data[] = [
                'emp_id' => $employee->emp_id,
                'name' => $employee->name,
            ];
        }
        echo json_encode($data);
    }

    public function emp_data()
    {
        $emp_id = $this->input->post('emp_id', TRUE);
        $data = $this->admin->emp_mod($emp_id);

        $result = [
            'emp_id' => $data['emp_id'],
            'name' => $data['name']
        ];
        echo json_encode($result);
    }
    public function add_user()
    {
        $team = $this->input->post('team_id');
        $emp_id = $this->input->post('emp_id');
        $position = $this->input->post('position');
        $is_parttime = $this->input->post('is_parttime');
        $contact_no = $this->input->post('contact_no');
        $ip_address = $this->input->post('ip_address');
        $type = '';
        if ($is_parttime == 'Parttime') {
            $type = 'Parttime';
        } else {
            $type = 'Fulltime';
        }

        $data = [];
        $data = [
            'team_id' => $team,
            'emp_id' => $emp_id,
            'username' => $emp_id,
            'contact_no' => $contact_no,
            'position' => $position,
            'date_added' => date('Y-m-d H:i:s'),
            'password' => md5($emp_id),
            'type' => $type,
            'ip_address' => $ip_address

        ];
        $this->admin->add_user($data);
    }
    public function update_user_content()
    {
        $id = $this->input->post('id');
        $user = $this->admin->update_user_content($id);
        echo json_encode($user);
    }
    public function update_user()
    {
        $id = $this->input->post('id');
        $team = $this->input->post('team_id');
        $position = $this->input->post('position');
        $is_parttime = $this->input->post('type');
        $contact_no = $this->input->post('contact_no');
        $ip_address = $this->input->post('ip_address');
        $data = [];
        $data = [
            'team_id' => $team,
            'position' => $position,
            'type' => $is_parttime,
            'contact_no' => $contact_no,
            'ip_address' => $ip_address

        ];
        $this->admin->update_user($data, $id);
    }

    public function reset_password()
    {
        $id = $this->input->post('id');
        $emp_id = $this->input->post('emp_id');
        $this->admin->reset_password($id, $emp_id);
    }
    public function get_team()
    {
        $module = $this->admin->get_teams();
        echo json_encode($module);
    }

    public function get_team5()
    {
        $module = $this->admin->get_teams5();
        echo json_encode($module);
    }

    public function get_team_current()
    {
        $module = $this->admin->get_teams_current();
        echo json_encode($module);
    }

    public function get_t()
    {
        $module = $this->admin->get_t();
        echo json_encode($module);
    }

    public function kpi_view()
    {
        $this->load->view('_layouts/header');
        $this->load->view('admin/kpi_list');
        $this->load->view('_layouts/footer');

    }

    public function kpi_list()
    {

        $type = $this->input->post('type');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $order = $this->input->post('order');
        $search_value = $this->input->post('search')['value'];
        $order_column = $order[0]['column'];
        $order_dir = $order[0]['dir'];

        $kpi = $this->admin->getKPI($type, $start, $length, $order_column, $order_dir, $search_value);
        $data = [];

        foreach ($kpi as $row) {
            $data[] = [
                'title' => $row['title'],
                'description' => $row['description'],
                'type' => '<span class="badge rounded-pill bg-success-subtle text-success">' . $row['type'] . '</span>',
                'action' => '
                    <div class="hstack gap-1">
                        <button type="button" class="btn btn-soft-secondary btn-label waves-effect waves-light btn-sm" onclick="edit_kpi(' . $row['id'] . ') " data-bs-toggle="modal" data-bs-target="#edit_kpi"><iconify-icon icon="solar:pen-bold-duotone" class="label-icon align-bottom fs-16 me-2"></iconify-icon> Edit</button>
                        <button type="button" class="btn btn-soft-danger btn-label waves-effect waves-light btn-sm" onclick="delete_kpi(' . $row['id'] . ')"><iconify-icon icon="solar:trash-bin-minimalistic-bold-duotone" class="label-icon align-bottom fs-16 me-2"></iconify-icon> Delete</button>

                    </div>
                '

            ];
        }
        $total_records = $this->admin->getTotalKPI($type, $search_value);

        $output = [
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => $total_records,
            "recordsFiltered" => $total_records,
            "data" => $data
        ];
        echo json_encode($output);
    }

    public function create_kpi()
    {

        $title = $this->input->post('title');
        $type = $this->input->post('type');
        $description = $this->input->post('description');

        $data = [
            'title' => $title,
            'type' => $type,
            'description' => $description,
            'date_added' => date('Y-m-d H:i:s'),
        ];

        $this->admin->insertKPI($data);

    }
    public function edit_kpi()
    {
        $id = $this->input->post('id');
        $row = $this->admin->get_kpi_data($id);

        echo '<div class="mb-3">
            <label for="title" class="col-form-label">Title:</label>
                <input type="text" class="form-control" id="ktitle" name="title" value="' . htmlspecialchars($row['title']) . '"/>
            </div>
            <div class="mb-3">
                <label for="type" class="col-form-label">Type:</label>
                <select class="form-select mb-3" name="type" id="type_edit">';
        $selected = ($row['type']) ? 'selected' : '';
        echo '<option value="' . htmlspecialchars($row['type']) . '" ' . $selected . '>' . htmlspecialchars($row['type']) . '</option>';
        echo '    </select>
            </div>
            <div class="mb-3">
                <label for="desc" class="col-form-label">Description:</label>
                <textarea class="form-control" id="description" style="height: 210px" name="description">' . htmlspecialchars($row['description']) . '</textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="submiteditedKPI(' . $id . ')">Submit</button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
            </div>';

    }
    public function update_kpi()
    {

        $id = $this->input->post('id');
        $title = $this->input->post('title');
        $type = $this->input->post('type');
        $description = $this->input->post('description');

        $data = [
            'title' => $title,
            'type' => $type,
            'description' => $description,
            'date_updated' => date('Y-m-d H:i:s'),
        ];

        $this->admin->updateKPI($data, $id);
    }

    public function delete_kpi()
    {
        $id = $this->input->post('id');
        $this->admin->deleteKPI($id);
    }


    public function module_view()
    {
        $this->load->view('_layouts/header');
        $this->load->view('admin/add_module');
        $this->load->view('_layouts/footer');

    }

    public function admin_module_view()
    {
        $this->load->view('_layouts/header');
        $this->load->view('admin/approve_module');
        $this->load->view('_layouts/footer');

    }

    public function admin_module_list()
    {

        $typeofsystem = $this->input->post('typeofsystem');
        $team = $this->input->post('team');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $order = $this->input->post('order');
        $search_value = $this->input->post('search')['value'];
        $order_column = $order[0]['column'];
        $order_dir = $order[0]['dir'];

        $module = $this->admin->admingetModuleMasterfile($team, $typeofsystem, $start, $length, $order_column, $order_dir, $search_value);
        $data = [];

        foreach ($module as $row) {
            switch ($row['mod_status']) {
                case 'Pending':
                    $mod_status = '<span class="badge bg-warning">' . $row['mod_status'] . '</span>';
                    break;
                case 'Approve':
                    $mod_status = '<span class="badge bg-success">' . $row['mod_status'] . '</span>';
                    break;
            }

            $action = '<div class="hstack gap-1 d-flex justify-content-center">';
            if ($row['mod_status'] === 'Pending') {
                $action .= '
                    <button type="button" class="btn btn-soft-info waves-effect waves-light btn-sm" onclick="approve_new_module(' . $row['module_id'] . ')"><iconify-icon icon="ri:thumb-up-fill" class="label-icon align-bottom fs-16 "></iconify-icon></button>
                    <button type="button" class="btn btn-soft-info waves-effect waves-light btn-sm" onclick="view_dept_implemented_module(' . $row['module_id'] . ', \'' . addslashes($row['mod_name']) . '\', \'' . $row['belong_to'] . '\', \'' . $row['sub_mod_id'] . '\', \'' . $row['sub_mod_name'] . '\', \'' . $row['typeofsystem'] . '\')" data-bs-toggle="modal" data-bs-target="#view_dept_implemented_modules">Show Implemented</button>
                    <button type="button" class="btn btn-soft-primary waves-effect waves-light btn-sm" onclick="show_uploaded_documents(' . $row['module_id'] . ', \'' . addslashes($row['mod_name']) . '\')" data-bs-toggle="modal" data-bs-target="#show_uploaded_documents">
                    <iconify-icon icon="line-md:uploading-loop" class="label-icon align-bottom fs-20"></iconify-icon> Progress
                    </button>';
            } elseif ($row['mod_status'] === 'Approve' && $this->has_remaining_files($row)) {
                // Approved, but uploads still incomplete – show "Progress"
                $action .= '
                    <button type="button" class="btn btn-soft-danger waves-effect waves-light btn-sm" onclick="recall_new_module(' . $row['module_id'] . ')"><iconify-icon icon="tabler:refresh-alert" class="label-icon align-bottom fs-16"></iconify-icon> </button>
                    <button type="button" class="btn btn-soft-info waves-effect waves-light btn-sm" onclick="view_dept_implemented_module(' . $row['module_id'] . ', \'' . addslashes($row['mod_name']) . '\', \'' . $row['belong_to'] . '\', \'' . $row['sub_mod_id'] . '\', \'' . $row['sub_mod_name'] . '\', \'' . $row['typeofsystem'] . '\')" data-bs-toggle="modal" data-bs-target="#view_dept_implemented_modules">Show Implemented</button>
                    <button type="button" class="btn btn-soft-primary waves-effect waves-light btn-sm" onclick="show_uploaded_documents(' . $row['module_id'] . ', \'' . addslashes($row['mod_name']) . '\')" data-bs-toggle="modal" data-bs-target="#show_uploaded_documents">
                        <iconify-icon icon="line-md:uploading-loop" class="label-icon align-bottom fs-20"></iconify-icon> Progress
                    </button>';
            } else {
                // Approved and all files uploaded – show "Done"
                $action .= '
                    <button type="button" class="btn btn-soft-danger waves-effect waves-light btn-sm" onclick="recall_new_module(' . $row['module_id'] . ')"><iconify-icon icon="tabler:refresh-alert" class="label-icon align-bottom fs-16"></iconify-icon> </button>
                    <button type="button" class="btn btn-soft-info waves-effect waves-light btn-sm" onclick="view_dept_implemented_module(' . $row['module_id'] . ', \'' . addslashes($row['mod_name']) . '\', \'' . $row['belong_to'] . '\', \'' . $row['sub_mod_id'] . '\', \'' . $row['sub_mod_name'] . '\', \'' . $row['typeofsystem'] . '\')" data-bs-toggle="modal" data-bs-target="#view_dept_implemented_modules">Show Implemented</button>
                    <button type="button" class="btn btn-soft-primary waves-effect waves-light btn-sm" onclick="show_uploaded_documents(' . $row['module_id'] . ', \'' . addslashes($row['mod_name']) . '\')" data-bs-toggle="modal" data-bs-target="#show_uploaded_documents">
                        <iconify-icon icon="famicons:checkmark-done-circle-outline" class="label-icon align-bottom fs-20"></iconify-icon> Done
                    </button>';
            }

            $action .= '</div>';



            if ($row['typeofsystem'] === 'new') {
                $type = '<span class="badge bg-danger">New</span>';
            } elseif ($row['typeofsystem'] === 'current') {
                $type = '<span class="badge bg-secondary">Existing</span>';
            } else {
                $type = '<span class="badge bg-info">N/A</span>';
            }
            $data[] = [
                'team_name' => $row['team_name'],
                'mod_name' => ucwords(strtolower($row['mod_name'])),
                'mod_abbr' => $row['mod_abbr'],
                'mod_status' => $mod_status,
                'typeofsystem' => $type,
                'module_desc' => $row['module_desc'] ?: '<span class="badge bg-danger">No Description</span>',
                'action' => $action
            ];
        }

        $total_records = $this->admin->admingetTotalModuleMasterfile($team, $typeofsystem, $search_value);
        $output = [
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => $total_records,
            "recordsFiltered" => $total_records,
            "data" => $data
        ];
        echo json_encode($output);
    }


    private function has_remaining_files($row)
    {
        $directory_current = ['ISR', 'ATTENDANCE', 'MINUTES', 'WALKTHROUGH', 'FLOWCHART', 'DFD', 'SYSTEM_PROPOSED', 'GANTT_CHART', 'LOCAL_TESTING', 'UAT', 'LIVE_TESTING', 'USER_GUIDE', 'MEMO', 'BUSINESS_ACCEPTANCE', 'REQUEST_LETTER', 'OTHERS'];
        $directory_new = ['ISR', 'ATTENDANCE', 'MINUTES', 'WALKTHROUGH', 'FLOWCHART', 'DFD', 'SYSTEM_PROPOSED','GANTT_CHART', 'LOCAL_TESTING', 'UAT', 'LIVE_TESTING', 'USER_GUIDE', 'MEMO', 'BUSINESS_ACCEPTANCE'];

        $directories = ($row['typeofsystem'] === 'current') ? $directory_current : $directory_new;
        $uploaded_to_list = !empty($row['uploaded_to']) ? array_map('trim', explode(',', $row['uploaded_to'])) : [];

        $remaining_directories = array_filter($directories, function ($dir) use ($uploaded_to_list) {
            return !in_array($dir, $uploaded_to_list, true);
        });

        return count($remaining_directories) > 0;
    }


    public function show_uploaded_documents_table()
    {
        $mod_id = $this->input->post('mod_id');
        $mod_name = $this->input->post('mod_name');

        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));
        $order = $this->input->post('order');
        $search_value = $this->input->post('search')['value'];
        $order_column = $order[0]['column'];
        $order_dir = $order[0]['dir'];

        $remaining_directories = $this->admin->show_uploaded_documents_table($mod_id, $start, $length, $order_column, $order_dir, $search_value);

        $data = [];
        $directory_current = ['ISR', 'ATTENDANCE', 'MINUTES', 'WALKTHROUGH', 'FLOWCHART', 'DFD', 'SYSTEM_PROPOSED', 'GANTT_CHART', 'LOCAL_TESTING', 'UAT', 'LIVE_TESTING', 'USER_GUIDE', 'MEMO', 'BUSINESS_ACCEPTANCE', 'REQUEST_LETTER', 'OTHERS'];
        $directory_new = ['ISR', 'ATTENDANCE', 'MINUTES', 'WALKTHROUGH', 'FLOWCHART', 'DFD', 'SYSTEM_PROPOSED','GANTT_CHART', 'LOCAL_TESTING', 'UAT', 'LIVE_TESTING', 'USER_GUIDE', 'MEMO', 'BUSINESS_ACCEPTANCE'];

        foreach ($remaining_directories as $row) {
            $directories = ($row['typeofsystem'] === 'current') ? $directory_current : $directory_new;
            $uploaded_to_list = !empty($row['uploaded_to']) ? array_map('trim', explode(',', $row['uploaded_to'])) : [];

            foreach ($directories as $directory) {
                $is_uploaded = in_array($directory, $uploaded_to_list, true);

                $data[] = [
                    'directory' => $directory,
                    'status' => $is_uploaded
                        ? '<span class="badge bg-success">Uploaded</span>'
                        : '<span class="badge bg-danger">Not Yet Uploaded</span>',
                    'action' => '<div class="justify-content-center">
                <button type="button" class="btn btn-soft-secondary btn-sm waves-effect waves-light btn-sm"  
                    onclick="show_data_in_directory(' . $mod_id . ', \'' . $directory . '\', \'' . $row['sub_mod_id'] . '\', \'' . $row['team_id'] . '\', \'' . $row['typeofsystem'] . '\', \'' . $mod_name . '\')" 
                    data-bs-toggle="modal" data-bs-target="#show_data_in_directory" '
                        . ($is_uploaded ? '' : 'disabled') . '>
                    <iconify-icon icon="line-md:cloud-alt-upload-filled-loop" class="label-icon align-bottom fs-16"></iconify-icon>  Show Files
                </button>
            </div>'
                ];
            }
        }

        $total_records = count($data);
        $output = [
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => $total_records,
            "recordsFiltered" => $total_records,
            "data" => $data
        ];

        echo json_encode($output);
    }

    public function show_data_in_directory()
    {
        $mod_id = $this->input->post('mod_id');
        $directory = $this->input->post('directory');
        $sub_mod_id = $this->input->post('sub_mod_id');
        $team_id = $this->input->post('team_id');
        $typeofsystem = $this->input->post('typeofsystem');
        $mod_name = $this->input->post('mod_name');

        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));
        $order = $this->input->post('order');
        $search_value = $this->input->post('search')['value'];
        $order_column = $order[0]['column'];
        $order_dir = $order[0]['dir'];

        $show_data = $this->admin->show_data_in_directory($mod_id, $directory, $sub_mod_id, $team_id, $mod_name, $typeofsystem, $start, $length, $order_column, $order_dir, $search_value);

        $data = [];

        foreach ($show_data as $row) {

            if ($row['status']== 'Pending') {
                $status = 'bg-warning';
                $ribbon = 'Pending';
            } elseif ($row['status']== 'Approve') {
                $status = 'bg-success';
                $ribbon = 'Approved';
            } else {
                $status = 'bg-info';
                $ribbon = 'N/a';
            }

            $file = pathinfo($row['file_name']);
            $file_extension = strtolower(pathinfo($row['file_name'], PATHINFO_EXTENSION));

                    if (in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif', 'jfif'])) {
                        $filedata = '
                        <div class="position-relative d-inline-block m-1" style="width: 150px;" title="' . $row['file_name'] . '" data-bs-toggle="tooltip" data-bs-placement="top">
                            <a style="white-space: normal; word-break: break-word;"  target="_blank">
                                <img src="' . base_url('open_image/' . $row['uploaded_to'] . '/' . $row['file_name']) . '" class="img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;" />
                            </a>
                            <div class="ribbon ' . $status . '" style=" position: absolute; cursor: pointer; top: 0; right: 0;  padding: 2px 8px; border-top-right-radius: 8px; border-bottom-left-radius: 8px; color: #fff;" onclick="previewFileModal(\'' . base_url('open_image/' . $row['uploaded_to'] . '/' . $row['file_name']) . '\')">
                                ' . $ribbon . '
                            </div>
                        </div>';

                        $filedat = '<a class="btn btn-sm btn-secondary waves-effect waves-light material-shadow-none"  onclick="previewFileModal(\'' . base_url('open_image/' . $row['uploaded_to'] . '/' . $row['file_name']) . '\')"><iconify-icon icon="basil:image-solid" class="align-middle" width="20" height="20"></iconify-icon></a>';
                    } elseif (in_array($file_extension, ['pdf'])) {
                        $filedata = '
                        <div class="position-relative d-inline-block m-1" style="width: 150px;" title="' . $row['file_name'] . '" data-bs-toggle="tooltip" data-bs-placement="top">
                        <a style="white-space: normal; word-break: break-word;"  target="_blank">
                        <embed src="' . base_url('open_pdf/' . $row['uploaded_to'] . '/' . $row['file_name']) . '"  style="width: 150px; height: 150px" /></a>
                        <div class="ribbon ' . $status . '" style=" position: absolute; cursor: pointer; top: 0; right: 0;  padding: 2px 8px; border-top-right-radius: 8px; border-bottom-left-radius: 8px; color: #fff;" onclick="previewFileModal(\'' . base_url('open_pdf/' . $row['uploaded_to'] . '/' . $row['file_name']) . '\')">
                                ' . $ribbon . '
                            </div>
                        </div>';
                        $filedat = '<a class="btn btn-sm btn-danger waves-effect waves-light material-shadow-none" onclick="previewFileModal(\'' . base_url('open_pdf/' . $row['uploaded_to'] . '/' . $row['file_name']) . '\')" ><iconify-icon icon="fluent:document-pdf-24-filled" class="align-middle" width="20" height="20"></iconify-icon> </a>';
                    } elseif (in_array($file_extension, ['doc', 'docx'])) {
                        $filedata = '
                        <div class="position-relative d-inline-block m-1" style="width: 150px;" title="' . $row['file_name'] . '" data-bs-toggle="tooltip" data-bs-placement="top">
                        <a style="white-space: normal; word-break: break-word;"  target="_blank">
                        <iconify-icon icon="tabler:file-type-docx" class="align-bottom text-info" style="font-size: 150px;"></iconify-icon>
                        <div class="ribbon ' . $status . '" style=" position: absolute; cursor: pointer; top: 0; right: 0;  padding: 2px 8px; border-top-right-radius: 8px; border-bottom-left-radius: 8px; color: #fff;" onclick="previewFileModal(\'' . base_url('open_docx/' . $row['uploaded_to'] . '/' . $row['file_name']) . '\')">
                                ' . $ribbon . '
                            </div>
                        </div>';
                        $filedat = '<a class="btn btn-sm btn-info waves-effect waves-light material-shadow-none" onclick="previewFileModal(\'' . base_url('open_docx/' . $row['uploaded_to'] . '/' . $row['file_name']) . '\')" ><iconify-icon icon="ri:file-word-fill" class="align-middle" width="20" height="20"></iconify-icon></a>';
                    } elseif (in_array($file_extension, ['mp3', 'wav', 'ogg'])) {
                        $filedata = '
                        <div class="position-relative d-inline-block m-1" style="width: 150px;" title="' . $row['file_name'] . '" data-bs-toggle="tooltip" data-bs-placement="top">
                        <a style="white-space: normal; word-break: break-word;"  target="_blank">
                        <audio controls style="width: 150px; height: 150px;">
                            <source src="' . base_url('open_audio/' . $row['uploaded_to'] . '/' . $row['file_name']) . '">
                            Your browser does not support the audio element.
                        </audio>
                        <div class="ribbon ' . $status . '" style=" position: absolute; cursor: pointer; top: 0; right: 0;  padding: 2px 8px; border-top-right-radius: 8px; border-bottom-left-radius: 8px; color: #fff;" onclick="previewFileModal(\'' . base_url('open_audio/' . $row['uploaded_to'] . '/' . $row['file_name']) . '\')">
                                ' . $ribbon . '
                            </div>
                        </div>';
                        $filedat = '<a class="btn btn-sm btn-primary waves-effect waves-light material-shadow-none" onclick="previewFileModal(\'' . base_url('open_audio/' . $row['uploaded_to'] . '/' . $row['file_name']) . '\')" ><iconify-icon icon="gridicons:audio" class="align-middle" width="20" height="20"></iconify-icon></a>';
                    } elseif (in_array($file_extension, ['mp4', 'mkv', 'avi', 'x-matroska'])) {
                        $filedata = '
                        <div class="position-relative d-inline-block m-1" style="width: 150px;" title="' . $row['file_name'] . '" data-bs-toggle="tooltip" data-bs-placement="top">
                        <a style="white-space: normal; word-break: break-word;"  target="_blank">
                        <video controls style="width: 150px; height: 150px;">
                            <source src="' . base_url('open_video/' . $row['uploaded_to'] . '/' . $row['file_name']) . '">
                            Your browser does not support the video tag.
                        </video>
                        <div class="ribbon ' . $status . '" style=" position: absolute; cursor: pointer; top: 0; right: 0;  padding: 2px 8px; border-top-right-radius: 8px; border-bottom-left-radius: 8px; color: #fff;" onclick="previewFileModal(\'' . base_url('open_video/' . $row['uploaded_to'] . '/' . $row['file_name']) . '\')">
                                ' . $ribbon . '
                            </div>
                        </div>';
                        $filedat = '<a class="btn btn-sm btn-primary waves-effect waves-light material-shadow-none" onclick="previewFileModal(\'' . base_url('open_video/' . $row['uploaded_to'] . '/' . $row['file_name']) . '\')" ><iconify-icon icon="lets-icons:video-fill" class="align-middle" width="20" height="20"></iconify-icon></a>';
                    } elseif (in_array($file_extension, ['csv'])) {
                        $filedata = '
                        <div class="position-relative d-inline-block m-1" style="width: 150px;" title="' . $row['file_name'] . '" data-bs-toggle="tooltip" data-bs-placement="top">
                        <a style="white-space: normal; word-break: break-word;"   target="_blank">
                        <iconify-icon icon="bi:filetype-csv" class="align-bottom text-success" style="font-size: 150px;"></iconify-icon>
                        <div class="ribbon ' . $status . '" style=" position: absolute; cursor: pointer; top: 0; right: 0;  padding: 2px 8px; border-top-right-radius: 8px; border-bottom-left-radius: 8px; color: #fff;" onclick="previewFileModal(\'' . base_url('open_csv/' . $row['uploaded_to'] . '/' . $row['file_name']) . '\')">
                                ' . $ribbon . '
                            </div>
                        </div>';
                        $filedat = '<a class="btn btn-sm btn-dark waves-effect waves-light material-shadow-none" onclick="previewFileModal(\'' . base_url('open_csv/' . $row['uploaded_to'] . '/' . $row['file_name']) . '\')" ><iconify-icon icon="teenyicons:csv-solid" class="align-middle" width="20" height="20"></iconify-icon></a>';
                    } elseif (in_array($file_extension, ['txt'])) {
                        $filedata = '
                        <div class="position-relative d-inline-block m-1" style="width: 150px;" title="' . $row['file_name'] . '" data-bs-toggle="tooltip" data-bs-placement="top">
                        <a style="white-space: normal; word-break: break-word;"  target="_blank">
                        <iframe src="' . base_url('open_txt/' . $row['uploaded_to'] . '/' . $row['file_name']) . '" style="width: 150px; height: 150px"></iframe>
                        <div class="ribbon ' . $status . '" style=" position: absolute; cursor: pointer; top: 0; right: 0;  padding: 2px 8px; border-top-right-radius: 8px; border-bottom-left-radius: 8px; color: #fff;" onclick="previewFileModal(\'' . base_url('open_txt/' . $row['uploaded_to'] . '/' . $row['file_name']) . '\')">
                                ' . $ribbon . '
                            </div>
                        </div>';
                        $filedat = '<a class="btn btn-sm btn-dark waves-effect waves-light material-shadow-none" onclick="previewFileModal(\'' . base_url('open_txt/' . $row['uploaded_to'] . '/' . $row['file_name']) . '\')" ><iconify-icon icon="grommet-icons:document-txt" class="align-middle" width="20" height="20"></iconify-icon></a>';
                    } elseif (in_array($file_extension, ['xlsx'])) {
                        $filedata = '
                        <div class="position-relative d-inline-block m-1" style="width: 150px;" title="' . $row['file_name'] . '" data-bs-toggle="tooltip" data-bs-placement="top">
                        <a style="white-space: normal; word-break: break-word;"  target="_blank">
                         <iconify-icon icon="ri:file-excel-2-line" class="align-bottom text-success" style="font-size: 150px;"></iconify-icon>
                         <div class="ribbon ' . $status . '" style=" position: absolute; cursor: pointer; top: 0; right: 0;  padding: 2px 8px; border-top-right-radius: 8px; border-bottom-left-radius: 8px; color: #fff;" onclick="previewFileModal(\'' . base_url('open_xlsx/' . $row['uploaded_to'] . '/' . $row['file_name']) . '\')">
                                ' . $ribbon . '
                            </div>
                        </div>';
                        $filedat = '<a class="btn btn-sm btn-success waves-effect waves-light material-shadow-none" onclick="previewFileModal(\'' . base_url('open_xlsx/' . $row['uploaded_to'] . '/' . $row['file_name']) . '\')"> <iconify-icon icon="teenyicons:ms-excel-solid" class="align-middle" width="20" height="20"></iconify-icon></a>';
                    }



            $data[] = [
                'filename' => $filedata,
                'original_file_name' => $row['original_file_name'] ?: '<span class="badge bg-info">N/A</span>',
                // 'status' => $status,
            ];
        }

        $total_records = count($data);
        $output = [
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => $total_records,
            "recordsFiltered" => $total_records,
            "data" => $data
        ];

        echo json_encode($output);
    }

    public function module_list()
    {
        $typeofsystem = $this->input->post('typeofsystem');
        $team = $this->input->post('team');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $order = $this->input->post('order');
        $search_value = $this->input->post('search')['value'];
        $order_column = $order[0]['column'];
        $order_dir = $order[0]['dir'];

        $module = $this->admin->getModule($team, $typeofsystem, $start, $length, $order_column, $order_dir, $search_value);
        $data = [];

        foreach ($module as $row) {
           $emp_id = implode(',', array_map('trim', explode(',', $row['emp_id']))); // Ensure clean CSV


            $action = '
                <div class="hstack gap-1 d-flex justify-content-center">

                    <button type="button" class="btn btn-soft-primary waves-effect waves-light btn-sm" onclick="view_dept_implemented_module(' . $row['mod_id'] . ', \'' . addslashes($row['mod_name']) . '\', \'' . $row['team_id'] . '\', \'' . $row['sub_mod_id'] . '\', \'' . $row['sub_mod_name'] . '\', \'' . $row['typeofsystem'] . '\')" data-bs-toggle="modal" data-bs-target="#view_dept_implemented_modules">
                            <iconify-icon icon="solar:checklist-minimalistic-bold-duotone" class="label-icon align-bottom fs-16"></iconify-icon>See more
                    </button>
                    <button type="button" class="btn btn-soft-danger waves-effect waves-light btn-sm" 
                        onclick="export_pdf(' . $row['team_id'] . ', \'' . addslashes($row['team_name']) . '\', \'' . $row['mod_id'] . '\', \'' . addslashes($row['mod_name']) . '\', \'' . $emp_id . '\')">
                        <iconify-icon icon="mdi:file-pdf-box" class="label-icon align-bottom fs-16"></iconify-icon> PDF
                    </button>
                    ';

            $action .= '</div>';
            $status = '';
            $bu_name = '';
            if ($row['mod_status'] === 'Approve') {
                $status = '<span class="badge bg-success">' . $row['mod_status'] . '</span>';
            } elseif ($row['mod_status'] === 'Pending') {
                $status = '<span class="badge bg-warning text-dark" onclick="see_why_pending()" style="cursor: pointer;">
                            ' . $row['mod_status'] . ' <small><u>(see why...)</u></small>
                        </span>';
            }


            if ($typeofsystem === 'new') {
                if ($row['bu_name'] !== null && $row['bu_name'] !== "") {
                    $bu_name = '<span class="badge bg-primary">' . ucwords(strtolower($row['bu_name'])) . '</span>';
                } else {
                    $bu_name = '<span class="badge bg-info">N/A</span>';
                }
            } else {
                if ($row['bu_name'] !== null && $row['bu_name'] !== "") {
                    $bu_name = '<span class="badge bg-primary">' . ucwords(strtolower($row['bu_name'])) . '</span>';
                } else {
                    $bu_name = '<span class="badge bg-info">N/A</span>';
                }
            }

            $data[] = [
                'team_name' => $row['team_name'],
                'mod_name' => ucwords(strtolower($row['mod_name'])) . ' [ ' . '<span class="badge bg-info">' . $row['mod_abbr'] . ' </span> ]',
                'status' => $status,
                'bu_name' => $bu_name,
                'module_desc' => $row['module_desc'] ?: '<span class="badge bg-info">No Description</span>',
                'action' => $action
            ];
        }

        $total_records = $this->admin->getTotalModule($team, $typeofsystem, $search_value);

        $output = [
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => $total_records,
            "recordsFiltered" => $total_records,
            "data" => $data
        ];
        echo json_encode($output);
    }


    public function admin_view_dept_implemented_modules()
    {
        $module_id = $this->input->post('mod_id');
        $typeofsystem = $this->input->post('typeofsystem');
        $team = $this->input->post('team');
        $company = $this->input->post('requested_to_co');
        $business_unit = $this->input->post('requested_to_bu');
        $department = $this->input->post('requested_to_dep');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $order = $this->input->post('order');
        $search_value = $this->input->post('search')['value'];
        $order_column = $order[0]['column'];
        $order_dir = $order[0]['dir'];

        $module = $this->admin->get_view_dept_implemented_modules($module_id, $team, $company, $business_unit, $department, $typeofsystem, $start, $length, $order_column, $order_dir, $search_value);
        $data = [];

        foreach ($module as $row) {
            $action = '
                <div class="hstack gap-1 d-flex justify-content-center">
                    <button type="button" class="btn btn-soft-info waves-effect waves-light btn-sm" onclick="edit_view_dept_implemented_modules(' . $row['id'] . ')" data-bs-toggle="modal" data-bs-target="#edit_module">
                        <iconify-icon icon="solar:pen-bold-duotone" class="label-icon align-bottom fs-16 me-2"></iconify-icon>
                    </button>
                    <button type="button" class="btn btn-soft-danger waves-effect waves-light btn-sm" onclick="deleteModuleset(' . $row['id'] . ')">
                        <iconify-icon icon="solar:trash-bin-minimalistic-bold-duotone" class="label-icon align-bottom fs-16 me-2"></iconify-icon>
                    </button>';
            if ($typeofsystem === 'new' && $row['status'] === 'Pending') {
                $action .= '
                    <button type="button" class="btn btn-soft-success waves-effect waves-light btn-sm" onclick="approve_new_module(' . $row['module_id'] . ')">
                        <iconify-icon icon="ri:thumb-up-fill" class="label-icon align-bottom fs-16 me-2"></iconify-icon>
                    </button>';
            } elseif ($typeofsystem === 'new' && $row['status'] === 'Approve') {
                $action .= '
                    <button type="button" class="btn btn-soft-danger waves-effect waves-light btn-sm" onclick="recall_new_module(' . $row['module_id'] . ')">
                        <iconify-icon icon="tabler:refresh-alert" class="label-icon align-bottom fs-16 me-2"></iconify-icon> 
                    </button>';
            }

            $action .= '</div>';
            $status = '';
            $bu_name = '';
            if ($row['status'] === 'Approve') {
                $status = '<span class="badge bg-success">' . $row['status'] . '</span>';
            } elseif ($row['status'] === 'Pending') {
                $status = '<span class="badge bg-warning">' . $row['status'] . '</span>';
            }

            if ($typeofsystem === 'new') {
                if ($row['bu_name'] !== null && $row['bu_name'] !== "") {
                    $bu_name = $row['bu_name'];
                } else {
                    $bu_name = '<span class="badge bg-info">N/A</span>';
                }
            } else {
                if ($row['bu_name'] !== null && $row['bu_name'] !== "") {
                    $bu_name = $row['bu_name'];
                } else {
                    $bu_name = '<span class="badge bg-info">N/A</span>';
                }
            }

            if ($row['date_implem'] == null) {
                $date_implem = '<span class="badge bg-info">N/A</span>';
            } else {
                $date_implem = date('F d, Y', strtotime($row['date_implem']));
            }
            if ($row['date_request'] == null) {
                $date_request = '<span class="badge bg-info">N/A</span>';
            } else {
                $date_request = date('F d, Y', strtotime($row['date_request']));
            }

            if ($row['date_parallel'] == null) {
                $date_parallel = '<span class="badge bg-info">N/A</span>';
            } else {
                $date_parallel = date('F d, Y', strtotime($row['date_parallel']));
            }

            if ($row['others'] == null || $row['others'] == '') {
                $others = '<span class="badge bg-info">N/A</span>';
            } else {
                $others = ucwords(strtolower($row['others']));
            }

            if ($row['sub_mod_name'] == null || $row['sub_mod_name'] == '') {
                $sub_mod_name = '<span class="badge bg-info">N/A</span>';
            } else {
                $sub_mod_name = ucwords(strtolower($row['sub_mod_name']));
            }

            $data[] = [
                'bu_name' => '<span class="badge bg-secondary">' . $bu_name . '</span>',
                'sub_mod_name' => $sub_mod_name,
                'date_requested' => $date_request,
                'date_parallel' => $date_parallel,
                'date_implem' => $date_implem,
                'others' => $others,
                // 'status'              => $status,
                // 'action'              => $action
            ];
        }

        $total_records = $this->admin->getTotalget_view_dept_implemented_modules($module_id, $team, $company, $business_unit, $department, $typeofsystem, $search_value);

        $output = [
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => $total_records,
            "recordsFiltered" => $total_records,
            "data" => $data
        ];
        echo json_encode($output);
    }
    public function view_dept_implemented_modules()
    {
        $module_id = $this->input->post('mod_id');
        $typeofsystem = $this->input->post('typeofsystem');
        $team = $this->input->post('team');
        $company = $this->input->post('requested_to_co');
        $business_unit = $this->input->post('requested_to_bu');
        $department = $this->input->post('requested_to_dep');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $order = $this->input->post('order');
        $search_value = $this->input->post('search')['value'];
        $order_column = $order[0]['column'];
        $order_dir = $order[0]['dir'];

        $module = $this->admin->get_view_dept_implemented_modules($module_id, $team, $company, $business_unit, $department, $typeofsystem, $start, $length, $order_column, $order_dir, $search_value);
        $data = [];

        foreach ($module as $row) {
            $action = '
                <div class="hstack gap-1 d-flex justify-content-center">
                    <button type="button" class="btn btn-soft-info waves-effect waves-light btn-sm" onclick="edit_view_dept_implemented_modules(' . $row['id'] . ')" data-bs-toggle="modal" data-bs-target="#edit_module">
                        <iconify-icon icon="solar:pen-bold-duotone" class="label-icon align-bottom fs-16 me-2"></iconify-icon>
                    </button>
                    <button type="button" class="btn btn-soft-danger waves-effect waves-light btn-sm" onclick="deleteModuleset(' . $row['id'] . ')">
                        <iconify-icon icon="solar:trash-bin-minimalistic-bold-duotone" class="label-icon align-bottom fs-16 me-2"></iconify-icon>
                    </button>';
            if ($typeofsystem === 'new' && $row['status'] === 'Pending') {
                $action .= '
                    <button type="button" class="btn btn-soft-success waves-effect waves-light btn-sm" onclick="approve_new_module(' . $row['module_id'] . ')">
                        <iconify-icon icon="ri:thumb-up-fill" class="label-icon align-bottom fs-16 me-2"></iconify-icon>
                    </button>
                    <button type="button" class="btn btn-soft-info waves-effect waves-light btn-sm" onclick="show_uploaded_documents(' . $row['module_id'] . ')">
                        <iconify-icon icon="line-md:uploading-loop" class="label-icon align-bottom fs-16 me-2"></iconify-icon>
                    </button>';
            } elseif ($typeofsystem === 'new' && $row['status'] === 'Approve') {
                $action .= '
                    <button type="button" class="btn btn-soft-danger waves-effect waves-light btn-sm" onclick="recall_new_module(' . $row['module_id'] . ')">
                        <iconify-icon icon="tabler:refresh-alert" class="label-icon align-bottom fs-16 me-2"></iconify-icon> 
                    </button>';
            }

            $action .= '</div>';
            $status = '';
            $bu_name = '';
            if ($row['status'] === 'Approve') {
                $status = '<span class="badge bg-success">' . $row['status'] . '</span>';
            } elseif ($row['status'] === 'Pending') {
                $status = '<span class="badge bg-warning">' . $row['status'] . '</span>';
            }

            if ($typeofsystem === 'new') {
                if ($row['bu_name'] !== null && $row['bu_name'] !== "") {
                    $bu_name = $row['bu_name'];
                } else {
                    $bu_name = '<span class="badge bg-info">N/A</span>';
                }
            } else {
                if ($row['bu_name'] !== null && $row['bu_name'] !== "") {
                    $bu_name = $row['bu_name'];
                } else {
                    $bu_name = '<span class="badge bg-info">N/A</span>';
                }
            }

            if ($row['date_implem'] == null) {
                $date_implem = '<span class="badge bg-info">N/A</span>';
            } else {
                $date_implem = date('F d, Y', strtotime($row['date_implem']));
            }
            if ($row['date_request'] == null) {
                $date_request = '<span class="badge bg-info">N/A</span>';
            } else {
                $date_request = date('F d, Y', strtotime($row['date_request']));
            }

            if ($row['date_parallel'] == null) {
                $date_parallel = '<span class="badge bg-info">N/A</span>';
            } else {
                $date_parallel = date('F d, Y', strtotime($row['date_parallel']));
            }

            if ($row['others'] == null || $row['others'] == '') {
                $others = '<span class="badge bg-info">N/A</span>';
            } else {
                $others = ucwords(strtolower($row['others']));
            }

            if ($row['sub_mod_name'] == null || $row['sub_mod_name'] == '') {
                $sub_mod_name = '<span class="badge bg-info">N/A</span>';
            } else {
                $sub_mod_name = ucwords(strtolower($row['sub_mod_name']));
            }

            $data[] = [
                'bu_name' => '<span class="badge bg-secondary">' . $bu_name . '</span>',
                'sub_mod_name' => $sub_mod_name,
                'date_requested' => $date_request,
                'date_parallel' => $date_parallel,
                'date_implem' => $date_implem,
                'others' => $others,
                // 'status'              => $status,
                'action' => $action
            ];
        }

        $total_records = $this->admin->getTotalget_view_dept_implemented_modules($module_id, $team, $company, $business_unit, $department, $typeofsystem, $search_value);

        $output = [
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => $total_records,
            "recordsFiltered" => $total_records,
            "data" => $data
        ];
        echo json_encode($output);
    }

    public function add_module()
    {
        $mod_name = $this->input->post('mod_name');
        $mod = $this->input->post('mod');
        $submodule = $this->input->post('sub_module');
        $typeofsystem = $this->input->post('typeofsystem');
        $date_request = $this->input->post('date_request');
        $co = $this->input->post('co');
        $bcode = $this->input->post('bcode');
        $dep = $this->input->post('dep');

        $company = $this->input->post('company');
        $business_unit = $this->input->post('business_unit');
        $department = $this->input->post('department');

        $team = $this->input->post('team');
        $date_implem = $this->input->post('date_implem');
        $date_parallel1 = $this->input->post('date_parallel');
        $date_parallel2 = $this->input->post('date_parallel_2');
        $other_details = $this->input->post('other_details');


        $emp_id             = $this->input->post('emp_id');
        $emp_name           = $this->input->post('emp_name');
        $description        = $this->input->post('description');
        $date_implementation = $this->input->post('date_implementation');
        $date_start         = $this->input->post('date_start');
        $date_end           = $this->input->post('date_end');
        $date_testing       = $this->input->post('date_testing');

        $data1 = [];

        if ($date_request === "") {
            $date_request = null;
        } else {
            $date_request = date('Y-m-d', strtotime($date_request));
            $date_request2 = $date_request;
        }

        if ($date_implem === "") {
            $date_implem = null;
        }
        if ($date_parallel1 === "") {
            $date_parallel1 = null;
        }
        if ($date_parallel2 === "") {
            $date_parallel2 = null;
        }
        if ($co === "") {
            $co = null;
        }

        if ($bcode === "") {
            $bcode = null;
        }
        if ($dep === "") {
            $dep = null;
        }

        if ($typeofsystem === "new") {
            $status = 'Pending';
        } else {
            $status = 'Approve';
        }

        if ($date_implementation === "") {
            $date_implementation = null;
        }

        if ($date_start === "") {
            $date_start = null;
        }

        if ($date_end === "") {
            $date_end = null;
        }
        $data = [
            'mod_id' => $mod_name,
            'submodule_id' => $submodule,
            'typeofsystem' => $typeofsystem,
            'requested_to_co' => $co,
            'requested_to_bu' => $bcode,
            'requested_to_dep' => $dep,
            'bu_name' => $company . ' | ' . $business_unit . ' | ' . $department,
            'date_request' => $date_request,
            'belong_team' => $team,
            'status' => $status,
            'date_added' => date('Y-m-d H:i:s'),
            'date_implem' => $date_implem,
            'date_parallel' => $date_parallel1,
            'others' => $other_details
        ];
        $this->admin->insertModule($data);

        $data1 = [
            'team_id' => $team,
            'emp_id' => $emp_id,
            'emp_name' => $emp_name,
            'mod_id' => $mod_name,
            'sub_mod_id' => $submodule,
            'desc' => $description,
            'date_req' => $date_request2,
            'date_parallel' => $date_parallel2,
            'date_implem' => $date_implementation,
            'date_start' => $date_start,
            'date_end' => $date_end,
            'date_added' => date('Y-m-d H:i:s'),
            'date_testing' => $date_testing
        ];
        if($typeofsystem === 'new') {
            $this->gantt->submit_gantt($data1);
        }

        $action = '<b>' . $this->session->name . '</b> added a module implemented | Gantt also created <b>' . $mod . ' for ' . $company . ' | ' . $business_unit . ' | ' . $department . ' </b>';

        $data1 = array(
            'emp_id' => $this->session->emp_id,
            'action' => $action,
            'date_added' => date('Y-m-d H:i:s'),
        );
        $this->load->model('Logs', 'logs');
        $this->logs->addLogs($data1);
    }

    public function edit_module()
    {
        $id = $this->input->post('id');
        $row = $this->admin->get_module_data($id);

        echo '<div class="mb-2">
                <div class="row mb-2">
                    <label for="title" class="col-sm-3 col-form-label">Team Name</label>
                    <div class="col-md-9">
                        <select id="edit_team_" class="form-select" aria-label="Team">
                            <option value="' . htmlspecialchars($row['belong_team']) . '">' . $row['team_name'] . '</option>
                        </select>
                    </div>
                </div>
                
                <div class="row mb-2">
                    <label for="title" class="col-sm-3 col-form-label">Module Name:</label>
                    <div class="col-md-9">
                        <select id="edit_mod_id" class="form-select">
                            <option value="' . htmlspecialchars($row['mod_id']) . '"></option>
                        </select>
                        <input type="hidden" class="form-control" id="edit_mod_id" name="mod_id" value="' . htmlspecialchars($row['mod_id']) . '"/>
                    </div>
                </div>
                
                <div class="row mb-2">
                    <label for="title" class="col-sm-3 col-form-label">Sub Module:</label>
                    <div class="col-md-9">
                        <select id="edit_sub_mod_id" class="form-select">
                            <option value="' . htmlspecialchars($row['sub_mod_id']) . '"></option>
                        </select>
                        <input type="hidden" class="form-control" id="edit_sub_mod" name="edit_sub_mod_id" value="' . $row['sub_mod_id'] . '"/>
                    </div>
                </div>
                
                <div class="row mb-2">
                    <label class="col-sm-3 col-form-label">Date Request:</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input type="date" id="edit_date_request" class="form-control" readonly placeholder="Select Date Request" data-provider="flatpickr" value="' . $row['date_request'] . '" />
                            <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                        </div>
                    </div>
                </div>
                
                <div class="row mb-2">
                    <label for="title" class="col-sm-3 col-form-label">Company</label>
                    <div class="col-md-9">
                        <select id="edit_co" class="form-select">
                            <option value="' . htmlspecialchars($row['requested_to_co']) . '"></option>
                        </select>
                    </div>
                </div>
                
                <div class="row mb-2">
                    <label for="title" class="col-sm-3 col-form-label">Business Unit</label>
                    <div class="col-md-9">
                        <select id="edit_bu" class="form-select">
                            <option value="' . htmlspecialchars($row['requested_to_bu']) . '"></option>
                        </select>
                    </div>
                </div>
                
                <div class="row mb-2">
                    <label for="title" class="col-sm-3 col-form-label">Department</label>
                    <div class="col-md-9">
                        <select id="edit_dept" class="form-select">
                            <option value="' . htmlspecialchars($row['requested_to_dep']) . '"></option>
                        </select>
                    </div>
                </div>';

        if ($row['typeofsystem'] === 'current') {
            echo '
                    <div class="row mb-2">
                        <label class="col-sm-3 col-form-label">Date Implem:</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input type="date" id="edit_date_implem" class="form-control" readonly placeholder="Select Date Implemented" data-provider="flatpickr" value="' . $row['date_implem'] . '" />
                                <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label class="col-sm-3 col-form-label">Date Parallel:</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input type="date" id="edit_date_parallel" class="form-control" readonly placeholder="Select Date Parallel" data-provider="flatpickr" value="' . $row['date_parallel'] . '" />
                                <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                            </div>
                        </div>
                    </div>';
        }
        echo '<div class="row mb-2">
                        <label for="edit_other_details" class="col-sm-3 col-form-label">Other Details:</label>
                        <div class="col-md-9">
                            <textarea class="form-control" id="edit_other_details" name="edit_other_details" rows="5">'
            . htmlspecialchars($row['others']) .
            '</textarea>
                        </div>
                    </div>
        
                    </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="submiteditedmodule(' . $row['id'] . ')">Submit</button>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#view_dept_implemented_modules">Back To List</button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
            </div>';

        ?>
        <script>
            flatpickr("#edit_date_request, #edit_date_implem, #edit_date_parallel");
            $('#edit_co').select2({ placeholder: 'Select Company', allowClear: true, minimumResultsForSearch: Infinity });
            $('#edit_bu').select2({ placeholder: 'Select Business Unit', allowClear: true, minimumResultsForSearch: Infinity });
            $('#edit_dept').select2({ placeholder: 'Select Department', allowClear: true, minimumResultsForSearch: Infinity });

            $('#edit_team_').select2({ placeholder: 'Select Team', allowClear: true, minimumResultsForSearch: Infinity });
            $('#edit_mod_id').select2({ placeholder: 'Select Module Name', allowClear: true, minimumResultsForSearch: Infinity });
            $('#edit_sub_mod_id').select2({ placeholder: 'Select Sub Module Name', allowClear: true, minimumResultsForSearch: Infinity });
            $.ajax({
                url: '<?php echo base_url('get_team') ?>',
                type: 'POST',
                success: function (response) {
                    const teamData = JSON.parse(response);
                    const existingTeam = $('#edit_team_').val();
                    $('#edit_team_').empty().append('<option value="">Select Team Name</option>');
                    teamData.forEach(function (team) {
                        const selected = (team.team_id === existingTeam) ? 'selected' : '';
                        $('#edit_team_').append('<option value="' + team.team_id + '" ' + selected + '>' + team.team_name + '</option>');
                    });
                }
            });
            $.ajax({
                url: '<?php echo base_url('setup_location'); ?>',
                type: 'POST',
                success: function (response) {
                    companyData = JSON.parse(response);

                    const selectedCompany = $('#edit_co').val();
                    const selectedBusinessUnit = $('#edit_bu').val();
                    const selectedDepartment = $('#edit_dept').val();

                    $('#edit_co').empty().append('<option value="">Select Company</option>');
                    $('#edit_bu').empty().append('<option value="">Select Business Unit</option>').prop('disabled', true);
                    $('#edit_dept').empty().append('<option value="">Select Department</option>').prop('disabled', true);

                    companyData.forEach(function (company) {
                        const selected = (company.company_code === selectedCompany) ? 'selected' : '';
                        $('#edit_co').append('<option value="' + company.company_code + '" ' + selected + '>' + company.acroname + '</option>');
                    });

                    if (selectedCompany) {
                        loadBusinessUnits(selectedCompany, selectedBusinessUnit);
                    }
                    if (selectedBusinessUnit) {
                        loadDepartments(selectedCompany, selectedBusinessUnit, selectedDepartment);
                    }
                },
            });
            load_mod();
            function load_mod() {
                $.ajax({
                    url: '<?php echo base_url('Admin/setup_module_dat') ?>',
                    type: 'POST',
                    data: {
                        team: $('#edit_team_').val()
                    },
                    success: function (response) {
                        moduleData = JSON.parse(response);
                        const selectedMod = $('#edit_mod_id').val();
                        const selectedSubMod = $('#edit_sub_mod').val();

                        $('#edit_mod_id').empty().append('<option value="">Select Module Name</option>');
                        $('#edit_sub_mod_id').empty().append('<option value="">Select Sub Module</option>');
                        $('#edit_sub_mod_id').prop('disabled', true);

                        moduleData.forEach(function (module) {
                            const selected = (module.mod_id == selectedMod) ? 'selected' : '';
                            $('#edit_mod_id').append('<option value="' + module.mod_id + '" ' + selected + '>' + module.mod_name + '</option>');
                        });

                        if (selectedMod) {
                            $('#edit_mod_id').trigger('change');
                        }
                    }
                });
            }

            $('#edit_team_').change(function () {
                load_mod();
            });

            $('#edit_mod_id').change(function () {
                var selectedModuleId = $(this).val();
                var selectedSubModId = $('#edit_sub_mod').val(); // Use the hidden input field value

                $('#edit_sub_mod_id').empty().append('<option value="">Select Sub Module</option>');
                $('#edit_sub_mod_id').prop('disabled', true);

                var selectedModule = moduleData.find(module => module.mod_id == selectedModuleId);

                if (selectedModule && selectedModule.submodules.length > 0) {
                    selectedModule.submodules.forEach(function (subModule) {
                        const selected = (subModule.sub_mod_id == selectedSubModId) ? 'selected' : '';
                        $('#edit_sub_mod_id').append(
                            '<option value="' + subModule.sub_mod_id + '" ' + selected + '>' + subModule.sub_mod_name + '</option>'
                        );
                    });

                    $('#edit_sub_mod_id').prop('disabled', false);
                }
            });


            $('#edit_co').change(function () {
                var companyCode = $(this).val();
                $('#edit_bu').empty().append('<option value="">Select Business Unit</option>').prop('disabled', true);
                $('#edit_dept').empty().append('<option value="">Select Department</option>').prop('disabled', true);
                if (companyCode) {
                    loadBusinessUnits(companyCode, '');
                }
            });

            function loadBusinessUnits(companyCode, selectedBusinessUnit) {
                var selectedCompany = companyData.find(company => company.company_code == companyCode);
                if (selectedCompany && selectedCompany.business_unit) {
                    $('#edit_bu').empty().append('<option value="">Select Business Unit</option>');

                    selectedCompany.business_unit.forEach(function (bu) {
                        const selected = (bu.bunit_code === selectedBusinessUnit) ? 'selected' : '';
                        $('#edit_bu').append('<option value="' + bu.bunit_code + '" ' + selected + '>' + bu.business_unit + '</option>');
                    });

                    $('#edit_bu').prop('disabled', false);
                    if (selectedBusinessUnit) {
                        loadDepartments(companyCode, selectedBusinessUnit, '');
                    }
                }
            }

            $('#edit_bu').change(function () {
                var companyCode = $('#edit_co').val();
                var businessUnitCode = $(this).val();
                $('#edit_dept').empty().append('<option value="">Select Department</option>').prop('disabled', true);
                if (businessUnitCode) {
                    loadDepartments(companyCode, businessUnitCode, '');
                }
            });

            function loadDepartments(companyCode, businessUnitCode, selectedDepartment) {
                var selectedCompany = companyData.find(company => company.company_code == companyCode);
                if (selectedCompany && selectedCompany.department) {
                    $('#edit_dept').empty().append('<option value="">Select Department</option>');

                    selectedCompany.department
                        .filter(dept => dept.bunit_code == businessUnitCode)
                        .forEach(function (dept) {
                            const selected = (dept.dcode === selectedDepartment) ? 'selected' : '';
                            $('#edit_dept').append('<option value="' + dept.dcode + '" ' + selected + '>' + dept.dept_name + '</option>');
                        });

                    $('#edit_dept').prop('disabled', false);
                }
            }


        </script>
        <?php
    }
    public function update_module_msfl()
    {
        $id = $this->input->post('id');
        $mod_name = $this->input->post('mod_name');
        $mod_abbr = $this->input->post('mod_abbr');
        $team = $this->input->post('team');
        $typeofsystem = $this->input->post('typeofsystem');
        $module_desc = $this->input->post('module_desc');
        if ($typeofsystem == 'current') {
            $mod_status = 'Approve';
        } else {
            $mod_status = 'Pending';
        }
        $data = [
            'mod_name' => $mod_name,
            'mod_abbr' => $mod_abbr,
            'belong_to' => $team,
            'typeofsystem' => $typeofsystem,
            'mod_status' => $mod_status,
            'module_desc' => $module_desc,
        ];

        $this->admin->updateModule_msfl($data, $id);

        $this->db->set('typeofsystem', $typeofsystem);
        $this->db->where('mod_id', $id);
        $this->db->update('module');

        $action = '<b>' . $this->session->name . '</b> updated a module <b>' . $mod_name . ' to masterfile </b>';

        $data1 = array(
            'emp_id' => $this->session->emp_id,
            'action' => $action,
            'date_added' => date('Y-m-d H:i:s'),
        );
        $this->load->model('Logs', 'logs');
        $this->logs->addLogs($data1);
    }
    public function update_module()
    {
        $id = $this->input->post('id');
        $co = $this->input->post('co');
        $bcode = $this->input->post('bcode');
        $dep = $this->input->post('dep');

        $company = $this->input->post('company');
        $business_unit = $this->input->post('business_unit');
        $department = $this->input->post('department');

        $date_request = $this->input->post('date_request');
        $date_implem = $this->input->post('date_implem');
        $date_parallel = $this->input->post('date_parallel');
        $team = $this->input->post('team');
        $other_details = $this->input->post('other_details');

        $mod = $this->input->post('mod');
        $sub_mod = $this->input->post('sub_mod');

        if ($date_request === "") {
            $date_request = '';
        } else {
            $date_request = date('Y-m-d', strtotime($date_request));
        }

        if ($date_implem === "") {
            $date_implem = '';
        }

        if ($date_parallel === "") {
            $date_parallel = '';
        }

        if ($co === "") {
            $co = null;
        }

        if ($bcode === "") {
            $bcode = null;
        }

        if ($dep === "") {
            $dep = null;
        }

        $data = [
            'bu_name' => $company . ' | ' . $business_unit . ' | ' . $department,
            'date_request' => $date_request,
            'date_implem' => $date_implem,
            'date_parallel' => $date_parallel,
            'date_updated' => date('Y-m-d H:i:s'),
            'belong_team' => $team,
            'requested_to_co' => $co,
            'requested_to_bu' => $bcode,
            'requested_to_dep' => $dep,
            'others' => $other_details,
            'submodule_id' => $sub_mod,
        ];

        $this->admin->updateModule($data, $id);

        $action = '<b>' . $this->session->name . '</b> updated a module implemented for <b> ' . $mod . ' to ' . $company . ' | ' . $business_unit . ' | ' . $department . ' </b>';

        $data1 = array(
            'emp_id' => $this->session->emp_id,
            'action' => $action,
            'date_added' => date('Y-m-d H:i:s'),
        );
        $this->load->model('Logs', 'logs');
        $this->logs->addLogs($data1);


    }
    public function deleteModuleset()
    {
        $id = $this->input->post('id');
        $this->admin->deleteModuleset($id);
    }

    public function delete_module()
    {
        $id = $this->input->post('id');
        $this->admin->deleteModule($id);
    }

    public function approve_new_module()
    {
        $mod_id = $this->input->post('id');
        $data = [
            'module_id' => $mod_id,
            'mod_status' => 'Approve'
        ];
        $this->admin->updateModuleStatus($data, $mod_id);

        $this->db->set('status', 'Approve');
        $this->db->where('mod_id', $mod_id);
        $this->db->update('module');
    }
    public function recall_new_module()
    {
        $mod_id = $this->input->post('id');
        $data = [
            'module_id' => $mod_id,
            'mod_status' => 'Pending'
        ];
        $this->admin->updateModuleStatus($data, $mod_id);

        $this->db->set('status', 'Pending');
        $this->db->where('mod_id', $mod_id);
        $this->db->update('module');
    }


    // Module MAsterfile Start ======================================================================================
    public function view_module_msfl()
    {
        echo '
        <div class="mb-3 col-md-4 ">
            <select class="form-select gap-2" id="team_filter">
                <option value=""></option>
            </select>
        </div>
        <div class="d-flex align-items-center float-end mb-3">
                <div class="flex-shrink-0">';
        if ($this->session->userdata('position') != 'Manager') {
            echo '<div class="d-flex flex-wrap gap-2">
                        <button class="btn btn-primary waves-effect waves-light add-btn" data-bs-toggle="modal" data-bs-target="#add_module_msfl"><i class="ri-add-line align-bottom me-1"></i> Add Module </button>
                    </div>';
        }
        echo '</div>
            </div>

            <ul class="nav nav-pills arrow-navtabs nav-primary bg-light mb-4" role="tablist">
                <li class="nav-item">
                    <a id="all" aria-expanded="false" class="nav-link active typeofsys" data-bs-toggle="tab" >
                        <span class="d-block d-sm-none"><iconify-icon icon="ri:list-settings-line" class="fs-25"></iconify-icon></span>
                        <span class="d-none d-sm-block">All Module | System</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="current" aria-expanded="false" class="nav-link typeofsys" data-bs-toggle="tab" >
                        <span class="d-block d-sm-none"><iconify-icon icon="ri:list-settings-line" class="fs-25"></iconify-icon></span>
                        <span class="d-none d-sm-block">Current Module | System</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="new" aria-expanded="true" class="nav-link typeofsys" data-bs-toggle="tab" >
                        <span class="d-block d-sm-none"><iconify-icon icon="ri:chat-new-fill" class="fs-25"></iconify-icon></span>
                        <span class="d-none d-sm-block">New Module | System <span
                                    class="badge badge-pill bg-danger ncount" style="display: none;"></span></span>
                    </a>
                </li>
            </ul>
            <hr>
            <table class="table table-bordered table-striped table-hover" id="module_masterfile">
                <thead class="table-info">
                    <tr>
                        <th>Module Name</th>
                        <th>Team</th>
                        <th>Module Abbreviation</th>
                        <th>Module Status</th>
                        <th width="35%">Module Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>';
        ?>
        <script>
            $(document).ready(function () {
                $('#team_filter').select2({ placeholder: 'Filter Team', allowClear: true, minimumResultsForSearch: Infinity });
            });


            $.ajax({
                url: '<?php echo base_url('get_team') ?>',
                type: 'POST',
                success: function (response) {
                    teamData = JSON.parse(response);
                    teamData.forEach(function (team) {
                        $('#team_filter').append('<option value="' + team.team_id + '">' + team.team_name + '</option>');
                    });
                }
            });
            $(document).on('change', '#team_filter', function () {
                $('#module_masterfile').DataTable().ajax.reload();
            });

        </script>
        <script>
            $(document).ready(function () {

                var typeofsys = "all";
                var table = null;
                load_module_msfl(typeofsys);

                $("a.typeofsys").click(function () {
                    $("a.btn-primary").removeClass('btn-primary').addClass('btn-secondary');
                    $(this).addClass('btn-primary');
                    typeofsys = this.id;
                    load_module_msfl(typeofsys);
                });
                function load_module_msfl(typeofsys) {
                    if (table) {
                        table.destroy();
                    }
                    var table = $('#module_masterfile').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "destroy": true,
                        "responsive": true,
                        'lengthMenu': [[10, 25, 50, 100, 10000], [10, 25, 50, 100, "Max"]],
                        'pageLength': 10,
                        "ajax": {
                            "url": "<?= base_url('module_masterfile') ?>",
                            "dataType": "json",
                            "type": "POST",
                            "data": function (d) {
                                d.typeofsystem = typeofsys !== "all" ? typeofsys : null;
                                d.team = $('#team_filter').val();
                            }
                        },
                        "columns": [
                            { "data": 'mod_name' },
                            { "data": 'team_name' },
                            { "data": 'mod_abbr' },
                            { "data": 'mod_status' },
                            { "data": 'module_desc' },
                            {
                                "data": 'action',
                                "visible": <?= ($_SESSION['position'] != 'Manager') ? 'true' : 'false'; ?>
                            }
                        ],
                        "columnDefs": [
                            { "className": "text-start", "targets": ['_all'] },
                            { "className": "text-justify", "targets": [4] }
                        ],
                    });
                }
            });
        </script>
        <?php

    }
    public function module_masterfile()
    {
        $typeofsystem = $this->input->post('typeofsystem');
        $team = $this->input->post('team');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $order = $this->input->post('order');
        $search_value = $this->input->post('search')['value'];
        $order_column = $order[0]['column'];
        $order_dir = $order[0]['dir'];

        $module = $this->admin->getModuleMasterfile($team, $typeofsystem, $start, $length, $order_column, $order_dir, $search_value);
        $data = [];

        foreach ($module as $row) {

            // if ($row['mod_status'] == 'Pending') {
            //     $mod_status = '<span class="badge bg-warning">' . $row['mod_status'] . '</span>';
            // } elseif ($row['mod_status'] == 'Approve') {
            //     $mod_status = '<span class="badge bg-success">' . $row['mod_status'] . '</span>';
            // }

            if ($row['mod_status'] === 'Approve') {
                $mod_status = '<span class="badge bg-success">' . $row['mod_status'] . '</span>';
            } elseif ($row['mod_status'] === 'Pending') {
                $mod_status = '<span class="badge bg-warning text-dark" onclick="see_why_pending()" style="cursor: pointer;">
                            ' . $row['mod_status'] . ' <small><u>(see why...)</u></small>
                        </span>';
            }
            if ($row['module_desc'] === null || $row['module_desc'] === '') {
                $module_desc = '<span class="badge bg-secondary">No Description</span>';
            } else {
                $module_desc = $row['module_desc'];
            }

            $data[] = [
                'mod_name' => ucwords(strtolower($row['mod_name'])),
                'team_name' => ucwords(strtolower($row['team_name'])),
                'mod_abbr' => $row['mod_abbr'],
                'mod_status' => $mod_status,
                'module_desc' => $module_desc,
                'action' => '
                    <div class="hstack gap-1 d-flex justify-content-center">
                        <button type="button" class="btn btn-soft-primary waves-effect waves-light btn-sm" onclick="view_submodule(' . $row['module_id'] . ',\'' . addslashes($row['mod_name']) . '\')" data-bs-toggle="modal" data-bs-target="#submodule">
                            <iconify-icon icon="solar:checklist-minimalistic-bold-duotone" class="align-bottom fs-16"></iconify-icon>
                        </button>
                        <button class="btn btn-sm btn-info edit-btn" onclick="edit_module_msfl(' . $row['module_id'] . ')" data-bs-toggle="modal" data-bs-target="#edit_module_msfl">
                            <iconify-icon icon="solar:pen-bold-duotone" class="align-bottom fs-16"></iconify-icon>
                        </button>
                        <button type="button" class="btn btn-soft-danger waves-effect waves-light btn-sm" onclick="delete_module_msfl(' . $row['module_id'] . ')">
                            <iconify-icon icon="solar:trash-bin-minimalistic-bold-duotone" class="align-bottom fs-16 "></iconify-icon>
                        </button>
                    </div>'

            ];
        }
        $total_records = $this->admin->getTotalModuleMasterfile($team, $typeofsystem, $search_value);
        $output = [
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => $total_records,
            "recordsFiltered" => $total_records,
            "data" => $data
        ];
        echo json_encode($output);
    }
    public function add_module_msfl()
    {
        $mod_name = $this->input->post('mod_name');
        $mod_abbr = $this->input->post('mod_abbr');
        $typeofsystem = $this->input->post('typeofsystem');
        $team = $this->input->post('team');
        $module_desc = $this->input->post('module_desc');
        $mod_status = '';
        if ($typeofsystem == 'current') {
            $mod_status = 'Approve';
        } else {
            $mod_status = 'Pending';
        }
        $data = [
            'mod_name' => $mod_name,
            'mod_abbr' => $mod_abbr,
            'typeofsystem' => $typeofsystem,
            'belong_to' => $team,
            'mod_status' => $mod_status,
            'module_desc' => $module_desc
        ];

        $this->admin->insertModuleMsfl($data);

        $action = '<b>' . $this->session->name . '</b> added a module <b>' . $mod_name . ' to masterfile </b>';

        $data1 = array(
            'emp_id' => $this->session->emp_id,
            'action' => $action,
            'date_added' => date('Y-m-d H:i:s'),
        );
        $this->load->model('Logs', 'logs');
        $this->logs->addLogs($data1);

    }
    public function edit_module_msfl()
    {
        $mod_id = $this->input->post('mod_id');
        $row = $this->admin->get_module_data_msfl($mod_id);

        echo '<div class="mb-3">
                    <div class="mb-2">
                        <label for="title" class="col-form-label">Team Name</label>
                        <select id="edit_team_" class="form-select" aria-label="Team">
                            <option value="' . htmlspecialchars($row['belong_to']) . '">' . htmlspecialchars($row['team_name']) . '</option>
                        </select>
                    </div>

                    <label for="title" class="col-form-label">Module Name:</label>
                    <input type="text" class="form-control" id="edit_mod_name" name="mod_name" value="' . htmlspecialchars($row['mod_name']) . '"/>
                    <input type="hidden" class="form-control" id="edit_mod_id" name="mod_id" value="' . htmlspecialchars($mod_id) . '"/>
                </div>

                <div class="mb-3">
                    <label for="title" class="col-form-label">Module Abbreviation:</label>
                    <input type="text" class="form-control" id="edit_mod_abbr" name="mod_abbr" value="' . htmlspecialchars($row['mod_abbr']) . '"/>
                </div>

                <div class="mb-3">
                    <label for="title" class="col-form-label">Module Description:</label>
                    <textarea class="form-control" id="edit_module_desc" name="edit_module_desc" rows="8">' . htmlspecialchars($row['module_desc']) . '</textarea>
                </div>

                <div class="mb-3">
                    <label for="typeofsystem" class="col-sm-3 col-form-label">Type of System:</label>
                        <select name="type" class="form-select" id="type_">
                            <option value="current" ' . ($row['typeofsystem'] == 'current' ? 'selected' : '') . '>Current</option>
                            <option value="new" ' . ($row['typeofsystem'] == 'new' ? 'selected' : '') . '>New</option>
                        </select>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="submiteditedmodule_msfl(' . htmlspecialchars($mod_id) . ')">Submit</button>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#module_msfl">Back To Masterfile</button>
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                </div>';
        ?>
        <script>
            $(document).ready(function () {
                $('#type_').select2({ placeholder: 'Select Type of System', allowClear: true, minimumResultsForSearch: Infinity });
                $('#edit_team_, #e').select2({ placeholder: 'Select Team', allowClear: true, minimumResultsForSearch: Infinity });
            });

            $.ajax({
                url: '<?php echo base_url('get_team') ?>',
                type: 'POST',
                success: function (response) {
                    const teamData = JSON.parse(response);
                    const existingTeam = $('#edit_team_').val();
                    $('#edit_team_').empty().append('<option value="">Select Team Name</option>');
                    teamData.forEach(function (team) {
                        const selected = (team.team_id === existingTeam) ? 'selected' : '';
                        $('#edit_team_').append('<option value="' + team.team_id + '" ' + selected + '>' + team.team_name + '</option>');
                    });
                    $('#edit_team_').trigger('change');
                }
            });
        </script>
        <?php
    }
    //End Module MAsterfile Start ======================================================================================


    public function view_submodule()
    {
        $mod_id = $this->input->post('mod_id');

        echo '<div class="d-flex align-items-center float-end mb-3">
                <div class="flex-shrink-0">
                    <div class="d-flex flex-wrap gap-2">';
                        if ($this->session->userdata('position') != 'Manager') {
                            echo '<button class="btn btn-primary btn-sm waves-effect waves-light add-btn" data-bs-toggle="modal"
                                            data-bs-target="#add_submodule" onclick="add_submodule_content(' . $mod_id . ')"><i class="ri-add-line align-bottom me-1"></i> Add Sub
                                            Module </button>';
                        }
                    echo '</div>
                </div>
            </div>
            <table class="table table-bordered" id="submodule_list">
                <thead class="table-primary">
                <tr>
                    <th>Submodule Name</th>
                    <th>Action</th>
                </tr>
                </thead>
            </table>';

        ?>
        <script>
            $(document).ready(function () {
                var table = $('#submodule_list').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "destroy": true,
                    "responsive": true,
                    'lengthMenu': [[8, 25, 50, 100, 10000], [8, 25, 50, 100, "Max"]],
                    'pageLength': 8,
                    "ajax": {
                        "url": "<?= base_url('submodule_list') ?>",
                        "dataType": "json",
                        "type": "POST",
                        "data": {
                            "mod_id": <?= $mod_id ?>
                        }
                    },
                    "columns": [
                        { "data": 'sub_mod_name' },
                        { "data": 'action' },
                    ],
                    "columnDefs": [
                        { "className": "text-start", "targets": ['_all'] },
                    ],
                });
            });
        </script>
        <?php

    }
    public function submodule_list()
    {
        $mod_id = $this->input->post('mod_id');

        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $order = $this->input->post('order');
        $search_value = $this->input->post('search')['value'];
        $order_column = $order[0]['column'];
        $order_dir = $order[0]['dir'];

        $module = $this->admin->getSubModule($mod_id, $start, $length, $order_column, $order_dir, $search_value);
        $data = [];

        foreach ($module as $row) {
            $data[] = [
                'sub_mod_name' => ucwords(strtolower($row['sub_mod_name'])),
                'action' => '
                    <div class="hstack gap-1 d-flex justify-content-center">
                        <button class="btn btn-sm btn-info edit-btn" onclick="edit_submodule_modal(' . $row['sub_mod_id'] . ')" data-bs-toggle="modal" data-bs-target="#edit_submodule">
                            <iconify-icon icon="solar:pen-bold-duotone" class="label-icon align-bottom fs-16 me-2"></iconify-icon> Edit
                        </button>
                        <button class="btn btn-sm btn-danger edit-btn" onclick="delete_submodule(' . $row['sub_mod_id'] . ', \'' . addslashes($row['sub_mod_name']) . '\')">
                            <iconify-icon icon="solar:trash-bin-minimalistic-bold-duotone" class="label-icon align-bottom fs-16 me-2"></iconify-icon> Delete
                        </button>
                    </div>'

            ];
        }
        $total_records = $this->admin->getTotalSubModule($mod_id, $search_value);

        $output = [
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => $total_records,
            "recordsFiltered" => $total_records,
            "data" => $data
        ];
        echo json_encode($output);
    }

    public function add_submodule_content()
    {
        $mod_id = $this->input->post('mod_id');

        echo '<div class="mb-3">
                    <label for="title" class="col-form-label">Sub Module Name:</label>
                    <input type="text" class="form-control" id="sub_mod_name1">
                    <input type="hidden" class="form-control" id="mod_id" value="' . $mod_id . '">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="add_submodule()">Submit</button>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#submodule">Back To List</button>
                </div>';
    }

    public function insert_submodule()
    {
        $sub_mod_name = $this->input->post('sub_mod_name');
        $mod_id = $this->input->post('mod_id');

        $data = [
            'sub_mod_name' => $sub_mod_name,
            'mod_id' => $mod_id,
            'date_added' => date('Y-m-d H:i:s'),
        ];

        $this->admin->insertSubModule($data);

        $action = '<b>' . $this->session->name . '</b> added a submodule <b>' . $sub_mod_name . ' to masterfile </b>';

        $data1 = array(
            'emp_id' => $this->session->emp_id,
            'action' => $action,
            'date_added' => date('Y-m-d H:i:s'),
        );
        $this->load->model('Logs', 'logs');
        $this->logs->addLogs($data1);
    }

    public function edit_submodule_content()
    {
        $sub_mod_id = $this->input->post('sub_mod_id');

        $row = $this->admin->get_submodule_data($sub_mod_id);

        echo '<div class="mb-3">
                    <label for="title" class="col-form-label">Sub Module Name:</label>
                    <input type="text" class="form-control" id="edit_sub_mod_name" value="' . htmlspecialchars($row['sub_mod_name']) . '">
                    <input type="hidden" class="form-control" id="sub_mod_id" value="' . $row['sub_mod_id'] . '">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="submiteditedsubmodule(' . $row['sub_mod_id'] . ')">Submit</button>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#submodule">Back To List</button>
                </div>';

    }
    public function update_submodule()
    {
        $sub_mod_id = $this->input->post('sub_mod_id');
        $sub_mod_name = $this->input->post('sub_mod_name');

        $data = [
            'sub_mod_name' => $sub_mod_name,
            'date_updated' => date('Y-m-d H:i:s'),
        ];

        $this->admin->updateSubModule($data, $sub_mod_id);
        $action = '<b>' . $this->session->name . '</b> updated a submodule <b>' . $sub_mod_name . ' to masterfile </b>';

        $data1 = array(
            'emp_id' => $this->session->emp_id,
            'action' => $action,
            'date_added' => date('Y-m-d H:i:s'),
        );
        $this->load->model('Logs', 'logs');
        $this->logs->addLogs($data1);
    }

    public function delete_submodule()
    {
        $sub_mod_id = $this->input->post('sub_mod_id');
        $sub_mod_name = $this->input->post('sub_mod_name');
        $this->admin->deleteSubModule($sub_mod_id);
        $action = '<b>' . $this->session->name . '</b> deleted a submodule <b>' . $sub_mod_name . ' to masterfile </b>';

        $data1 = array(
            'emp_id' => $this->session->emp_id,
            'action' => $action,
            'date_added' => date('Y-m-d H:i:s'),
        );
        $this->load->model('Logs', 'logs');
        $this->logs->addLogs($data1);

    }

    public function request()
    {
        $data['team']   = $this->input->get('team');
        $data['mod']    = $this->input->get('mod');
        $data['uploaded'] = $this->input->get('uploaded');

    
        $this->load->view('_layouts/header');
        $this->load->view('admin/request', $data);
        $this->load->view('_layouts/footer');

    }

    public function typeofsystem_data()
    {
        $type = $this->input->post('type');
        $typeofsystem = $this->input->post('system');

        $team = $this->input->post('team');
        $module_id = $this->input->post('module');
        $sub_mod_id = $this->input->post('sub_module');


        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $order = $this->input->post('order');
        $search_value = isset($this->input->post('search')['value']) ? $this->input->post('search')['value'] : '';

        $order_column = isset($order[0]['column']) ? $order[0]['column'] : 0;
        $order_dir = isset($order[0]['dir']) ? $order[0]['dir'] : 'asc';



        $data = [];
        if ($typeofsystem === 'current') {
            $current = $this->admin->get_current_system_data($team, $module_id, $sub_mod_id, $type, $typeofsystem, $start, $length, $order_column, $order_dir, $search_value);

            foreach ($current as $row) {
                $status = '';
                switch ($type) {
                    case 'ISR':
                        $status = $row['isr_status'];
                        break;
                    case 'ATTENDANCE':
                        $status = $row['att_status'];
                        break;
                    case 'MINUTES':
                        $status = $row['minute_status'];
                        break;
                    case 'WALKTHROUGH':
                        $status = $row['wt_status'];
                        break;
                    case 'FLOWCHART':
                        $status = $row['flowchart_status'];
                        break;
                    case 'DFD':
                        $status = $row['dfd_status'];
                        break;
                    case 'SYSTEM_PROPOSED':
                        $status = $row['proposed_status'];
                        break;
                    case 'GANTT_CHART':
                        $status = $row['gantt_status'];
                        break;
                    case 'LOCAL_TESTING':
                        $status = $row['local_status'];
                        break;
                    case 'UAT':
                        $status = $row['uat_status'];
                        break;
                    case 'LIVE_TESTING':
                        $status = $row['live_status'];
                        break;
                    case 'USER_GUIDE':
                        $status = $row['guide_status'];
                        break;
                    case 'MEMO':
                        $status = $row['memo_status'];
                        break;
                    case 'BUSINESS_ACCEPTANCE':
                        $status = $row['acceptance_status'];
                        break;
                }
                $status_badge = '';
                if ($status === 'Approve') {
                    $status_badge = '<span class="badge bg-success">' . $status . '</span>';
                } elseif ($status === 'Pending') {
                    $status_badge = '<span class="badge bg-warning">' . $status . '</span>';
                }


                $file_info = pathinfo($row['file_name']);
                $extension = strtolower($file_info['extension']);

                if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'jfif'])) {
                    $filedata = '<a title="'.$row['file_name'].'" data-bs-toggle="tooltip" data-bs-placement="top" class="btn btn-sm btn-outline-secondary " style="white-space: normal; word-break: break-word;" onclick="previewFileModal(\'' . base_url('open_image/' . $row['uploaded_to'] . '/' . $row['file_name']) . '\')" target="_blank">
                        <img src="' . base_url('open_image/' . $row['uploaded_to'] . '/' . $row['file_name']) . '" style="width: 100px; height: 100px; background-size: cover; background-repeat: no-repeat !important;" /></a>';
                    
                }elseif(in_array($extension, ['pdf'])) {
                    $filedata = '<a title="'.$row['file_name'].'" data-bs-toggle="tooltip" data-bs-placement="top" class="btn btn-sm btn-outline-secondary " style="white-space: normal; word-break: break-word;" onclick="previewFileModal(\'' . base_url('open_pdf/' . $row['uploaded_to'] . '/' . $row['file_name']) . '\')" target="_blank">
                    <embed src="' . base_url('open_pdf/' . $row['uploaded_to'] . '/' . $row['file_name']) . '"  style="width: 100px; height: 100px" /></a>';
                    
                }elseif(in_array($extension, ['doc', 'docx'])) {
                    $filedata = '<a title="'.$row['file_name'].'" data-bs-toggle="tooltip" data-bs-placement="top" class="btn btn-sm btn-outline-secondary " style="white-space: normal; word-break: break-word;" onclick="previewFileModal(\'' . base_url('open_docx/' . $row['uploaded_to'] . '/' . $row['file_name']) . '\')" target="_blank">
                    <iconify-icon icon="tabler:file-type-docx" class="align-bottom text-info" style="font-size: 100px;"></iconify-icon></a>'; $filedat = '<a class="btn btn-sm btn-info waves-effect waves-light material-shadow-none" onclick="previewFileModal(\'' . base_url('open_docx/' . $row['uploaded_to'] . '/' . $row['file_name']) . '\')" ><iconify-icon icon="ri:file-word-fill" class="align-middle" width="20" height="20"></iconify-icon></a>';
                }elseif(in_array($extension, ['mp3', 'wav', 'ogg'])) {
                    $filedata = '<a title="'.$row['file_name'].'" data-bs-toggle="tooltip" data-bs-placement="top" class="btn btn-sm btn-outline-secondary " style="white-space: normal; word-break: break-word;" onclick="previewFileModal(\'' . base_url('open_audio/' . $row['uploaded_to'] . '/' . $row['file_name']) . '\')" target="_blank">
                    <audio controls style="width: 100px; height: 100px;">
                        <source src="' . base_url('open_audio/' . $row['uploaded_to'] . '/' . $row['file_name']) . '">
                        Your browser does not support the audio element.
                    </audio></a>';
                    
                }elseif(in_array($extension, ['mp4', 'mkv', 'avi', 'x-matroska'])) {
                    $filedata = '<a title="'.$row['file_name'].'" data-bs-toggle="tooltip" data-bs-placement="top" class="btn btn-sm btn-outline-secondary " style="white-space: normal; word-break: break-word;" onclick="previewFileModal(\'' . base_url('open_video/' . $row['uploaded_to'] . '/' . $row['file_name']) . '\')" target="_blank">
                    <video controls style="width: 100px; height: 100px;">
                        <source src="' . base_url('open_video/' . $row['uploaded_to'] . '/' . $row['file_name']) . '">
                        Your browser does not support the video tag.
                    </video></a>';
                    
                }elseif(in_array($extension, ['csv'])) {
                    $filedata = '<a title="'.$row['file_name'].'" data-bs-toggle="tooltip" data-bs-placement="top" class="btn btn-sm btn-outline-secondary " style="white-space: normal; word-break: break-word;" onclick="previewFileModal(\'' . base_url('open_csv/' . $row['uploaded_to'] . '/' . $row['file_name']) . '\')"  target="_blank">
                    <iconify-icon icon="bi:filetype-csv" class="align-bottom text-success" style="font-size: 100px;"></iconify-icon></a>';
                    
                }elseif(in_array($extension, ['txt'])) {
                    $filedata = '<a title="'.$row['file_name'].'" data-bs-toggle="tooltip" data-bs-placement="top" class="btn btn-sm btn-outline-secondary " style="white-space: normal; word-break: break-word;" onclick="previewFileModal(\'' . base_url('open_txt/' . $row['uploaded_to'] . '/' . $row['file_name']) . '\')" target="_blank">
                    <iframe src="' . base_url('open_txt/' . $row['uploaded_to'] . '/' . $row['file_name']) . '" style="width: 100px; height: 100px"></iframe></a>';
                    
                }elseif(in_array($extension, ['xlsx'])) {
                    $filedata = '<a title="'.$row['file_name'].'" data-bs-toggle="tooltip" data-bs-placement="top" class="btn btn-sm btn-outline-secondary " style="white-space: normal; word-break: break-word;" onclick="previewFileModal(\'' . base_url('open_xlsx/' . $row['uploaded_to'] . '/' . $row['file_name']) . '\')" target="_blank">
                        <iconify-icon icon="ri:file-excel-2-line" class="align-bottom text-success" style="font-size: 100px;"></iconify-icon></a>';
                    
                }

                $data[] = [
                    'team_name' => ucwords(strtolower($row['team_name'])),
                    'file_name' => $filedata,
                    'mod_name' => ucwords(strtolower($row['mod_name'])),
                    // 'uploaded_to' => $row['uploaded_to'],
                    'status' => $status_badge,
                    'action' => '
                        <div class="hstack gap-1 d-flex justify-content-center">' .
                        ($status === 'Pending' ?
                            '<button type="button" class="btn btn-soft-primary waves-effect waves-light btn-sm" onclick="approved(' . $row['file_id'] . ', \'' . $type . '\', \'' . $typeofsystem . '\', \'' . $row['mod_id'] . '\')">' .
                            '<iconify-icon icon="ri:thumb-up-fill" class="align-bottom fs-16"></iconify-icon></button>'
                            :
                            '<button type="button" class="btn btn-soft-danger waves-effect waves-light btn-sm" onclick="backtopending(' . $row['file_id'] . ', \'' . $type . '\', \'' . $typeofsystem . '\', \'' . $row['mod_id'] . '\')">' .
                            '<iconify-icon icon="tabler:refresh-alert" class="align-bottom fs-16"></iconify-icon></button>') .
                        '</div>'
                ];
            }

            $total_records = $this->admin->getTotalModuleCurrent($team, $module_id, $sub_mod_id, $search_value, $type);
        }


        if ($typeofsystem === 'new') {
            $new = $this->admin->get_new_system_data($team, $module_id, $sub_mod_id, $type, $typeofsystem, $start, $length, $order_column, $order_dir, $search_value);
            foreach ($new as $row) {
                $status = '';
                switch ($type) {
                    case 'ISR':
                        $status = $row['isr_status'];
                        break;
                    case 'ATTENDANCE':
                        $status = $row['att_status'];
                        break;
                    case 'MINUTES':
                        $status = $row['minute_status'];
                        break;
                    case 'WALKTHROUGH':
                        $status = $row['wt_status'];
                        break;
                    case 'FLOWCHART':
                        $status = $row['flowchart_status'];
                        break;
                    case 'DFD':
                        $status = $row['dfd_status'];
                        break;
                    case 'SYSTEM_PROPOSED':
                        $status = $row['proposed_status'];
                        break;
                    case 'GANTT_CHART':
                        $status = $row['gantt_status'];
                        break;
                    case 'LOCAL_TESTING':
                        $status = $row['local_status'];
                        break;
                    case 'UAT':
                        $status = $row['uat_status'];
                        break;
                    case 'LIVE_TESTING':
                        $status = $row['live_status'];
                        break;
                    case 'USER_GUIDE':
                        $status = $row['guide_status'];
                        break;
                    case 'MEMO':
                        $status = $row['memo_status'];
                        break;
                    case 'BUSINESS_ACCEPTANCE':
                        $status = $row['acceptance_status'];
                        break;
                }

                $status_badge = '';
                if ($status === 'Approve') {
                    $status_badge = '<span class="badge bg-success">' . $status . '</span>';
                } elseif ($status === 'Pending') {
                    $status_badge = '<span class="badge bg-warning">' . $status . '</span>';
                }

                $file_info = pathinfo($row['file_name']);
                $extension = strtolower($file_info['extension']);

                if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'jfif'])) {
                    $filedata = '<a title="'.$row['file_name'].'" data-bs-toggle="tooltip" data-bs-placement="top" class="btn btn-sm btn-outline-secondary " style="white-space: normal; word-break: break-word;" onclick="previewFileModal(\'' . base_url('open_image/' . $row['uploaded_to'] . '/' . $row['file_name']) . '\')" target="_blank">
                        <img src="' . base_url('open_image/' . $row['uploaded_to'] . '/' . $row['file_name']) . '" style="width: 100px; height: 100px; background-size: cover; background-repeat: no-repeat !important;" /></a>';
                    
                } elseif (in_array($extension, ['pdf'])) {
                    $fileUrl = base_url('open_pdf/' . $row['uploaded_to'] . '/' . $row['file_name']);
                    $filedata = '
                        <div class="pdf-btn-outline" 
                            title="'.$row['file_name'].'" 
                            data-bs-toggle="tooltip" 
                            data-bs-placement="top" 
                            onclick="previewFileModal(\'' . $fileUrl . '\')">
                            
                            <embed src="' . $fileUrl . '" class="pdf-embed"/>
                        </div>
                        <style>
                            .pdf-btn-outline {
                                display: inline-block;
                                cursor: pointer;
                                border: 1px solid #0d6efd;   /* Bootstrap primary */
                                border-radius: .5rem;        /* rounded corners */
                                padding: 4px;
                                transition: all 0.2s ease-in-out;
                                background-color: transparent;
                            }
                            .pdf-btn-outline:hover {
                                background-color: #0d6efd;   /* Bootstrap primary */
                                color: #fff;
                                box-shadow: 0 0 6px rgba(13,110,253,.6);
                            }
                            .pdf-embed {
                                width: 110px;
                                height: 110px;
                                pointer-events: none;
                                border-radius: .3rem;
                            }
                        </style>';
                }
                elseif(in_array($extension, ['doc', 'docx'])) {
                    $filedata = '<a title="'.$row['file_name'].'" data-bs-toggle="tooltip" data-bs-placement="top" class="btn btn-sm btn-outline-secondary " style="white-space: normal; word-break: break-word;" onclick="previewFileModal(\'' . base_url('open_docx/' . $row['uploaded_to'] . '/' . $row['file_name']) . '\')" target="_blank">
                    <iconify-icon icon="tabler:file-type-docx" class="align-bottom text-info" style="font-size: 100px;"></iconify-icon></a>'; $filedat = '<a class="btn btn-sm btn-info waves-effect waves-light material-shadow-none" onclick="previewFileModal(\'' . base_url('open_docx/' . $row['uploaded_to'] . '/' . $row['file_name']) . '\')" ><iconify-icon icon="ri:file-word-fill" class="align-middle" width="20" height="20"></iconify-icon></a>';
                }elseif(in_array($extension, ['mp3', 'wav', 'ogg'])) {
                    $filedata = '<a title="'.$row['file_name'].'" data-bs-toggle="tooltip" data-bs-placement="top" class="btn btn-sm btn-outline-secondary " style="white-space: normal; word-break: break-word;" onclick="previewFileModal(\'' . base_url('open_audio/' . $row['uploaded_to'] . '/' . $row['file_name']) . '\')" target="_blank">
                    <audio controls style="width: 100px; height: 100px;">
                        <source src="' . base_url('open_audio/' . $row['uploaded_to'] . '/' . $row['file_name']) . '">
                        Your browser does not support the audio element.
                    </audio></a>';
                    
                }elseif(in_array($extension, ['mp4', 'mkv', 'avi', 'x-matroska'])) {
                    $filedata = '<a title="'.$row['file_name'].'" data-bs-toggle="tooltip" data-bs-placement="top" class="btn btn-sm btn-outline-secondary " style="white-space: normal; word-break: break-word;" onclick="previewFileModal(\'' . base_url('open_video/' . $row['uploaded_to'] . '/' . $row['file_name']) . '\')" target="_blank">
                    <video controls style="width: 100px; height: 100px;">
                        <source src="' . base_url('open_video/' . $row['uploaded_to'] . '/' . $row['file_name']) . '">
                        Your browser does not support the video tag.
                    </video></a>';
                    
                }elseif(in_array($extension, ['csv'])) {
                    $filedata = '<a title="'.$row['file_name'].'" data-bs-toggle="tooltip" data-bs-placement="top" class="btn btn-sm btn-outline-secondary " style="white-space: normal; word-break: break-word;" onclick="previewFileModal(\'' . base_url('open_csv/' . $row['uploaded_to'] . '/' . $row['file_name']) . '\')"  target="_blank">
                    <iconify-icon icon="bi:filetype-csv" class="align-bottom text-success" style="font-size: 100px;"></iconify-icon></a>';
                    
                }elseif(in_array($extension, ['txt'])) {
                    $filedata = '<a title="'.$row['file_name'].'" data-bs-toggle="tooltip" data-bs-placement="top" class="btn btn-sm btn-outline-secondary " style="white-space: normal; word-break: break-word;" onclick="previewFileModal(\'' . base_url('open_txt/' . $row['uploaded_to'] . '/' . $row['file_name']) . '\')" target="_blank">
                    <iframe src="' . base_url('open_txt/' . $row['uploaded_to'] . '/' . $row['file_name']) . '" style="width: 100px; height: 100px"></iframe></a>';
                    
                }elseif(in_array($extension, ['xlsx'])) {
                    $filedata = '<a title="'.$row['file_name'].'" data-bs-toggle="tooltip" data-bs-placement="top" class="btn btn-sm btn-outline-secondary " style="white-space: normal; word-break: break-word;" onclick="previewFileModal(\'' . base_url('open_xlsx/' . $row['uploaded_to'] . '/' . $row['file_name']) . '\')" target="_blank">
                        <iconify-icon icon="ri:file-excel-2-line" class="align-bottom text-success" style="font-size: 100px;"></iconify-icon></a>';
                    
                }

                $file_link = '';
                $data[] = [
                    'team_name' => ucwords(strtolower($row['team_name'])),
                    'file_name' => $filedata,
                    'mod_name' => ucwords(strtolower($row['mod_name'])),
                    // 'uploaded_to' => $row['uploaded_to'],
                    'status' => $status_badge,
                    'action' => '
                        <div class="hstack gap-1 d-flex justify-content-center">' .
                        ($status === 'Pending' ?
                            '<button type="button" class="btn btn-soft-primary waves-effect waves-light btn-sm" onclick="approved(' . $row['file_id'] . ', \'' . $type . '\', \'' . $typeofsystem . '\', \'' . $row['mod_id'] . '\')">' .
                            '<iconify-icon icon="ri:thumb-up-fill" class=" align-bottom fs-16"></iconify-icon></button>'
                            :
                            '<button type="button" class="btn btn-soft-danger waves-effect waves-light btn-sm" onclick="backtopending(' . $row['file_id'] . ', \'' . $type . '\', \'' . $typeofsystem . '\', \'' . $row['mod_id'] . '\')">' .
                            '<iconify-icon icon="tabler:refresh-alert" class=" align-bottom fs-16"></iconify-icon></button>') .
                        '</div>'
                ];
            }

            $total_records = $this->admin->getTotalModuleNew($team, $module_id, $sub_mod_id, $search_value, $type);
        }

        $output = [
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => $total_records,
            "recordsFiltered" => $total_records,
            "data" => $data
        ];
        echo json_encode($output);
    }
    public function get_directory_counts()
    {
        $directories = [
            'ISR',
            'ATTENDANCE',
            'MINUTES',
            'WALKTHROUGH',
            'FLOWCHART',
            'DFD',
            'SYSTEM_PROPOSED',
            'GANTT_CHART',
            'LOCAL_TESTING',
            'UAT',
            'LIVE_TESTING',
            'USER_GUIDE',
            'MEMO',
            'BUSINESS_ACCEPTANCE',
            'REQUEST_LETTER',
            'OTHERS'
        ];

        $counts = [];
        $team = $this->input->post('team');
        $mod_id = $this->input->post('module');
        $sub_mod_id = $this->input->post('sub_module');
        $typeofsystem = $this->input->post('typeofsystem');

        $totalCurrentPending = 0;
        $totalNewPending = 0;

        foreach ($directories as $directory) {
            $count = $this->admin->get_file_count_by_directory($directory, $mod_id, $sub_mod_id, $team, $typeofsystem);
            $counts[$directory] = $count;

            // Separate counts for current and new systems
            if ($typeofsystem === 'current') {
                $totalCurrentPending += $count;
            } elseif ($typeofsystem === 'new') {
                $totalNewPending += $count;
            }
        }

        // Add aggregated counts for the frontend
        $counts['current_pending'] = $totalCurrentPending;
        $counts['new_pending'] = $totalNewPending;

        echo json_encode($counts);
    }


    public function setup_module()
    {
        $type = $this->input->post('typeofsystem');
        $team = $this->input->post('team');
        $module = $this->admin->get_module($type, $team);
        echo json_encode($module);
    }

    public function setup_module_dat()
    {
        $team = $this->input->post('team');
        $module = $this->admin->get_module_dat($team);
        echo json_encode($module);
    }

    public function setup_module_dat5()
    {
        $team = $this->input->post('team');
        $module = $this->admin->get_module_dat5($team);
        echo json_encode($module);
    }

    public function approved()
    {
        $file_id = $this->input->post('file_id');
        $type = $this->input->post('type');
        $typeofsystem = $this->input->post('typeofsystem');
        $mod_id = $this->input->post('mod_id');

        $status_field = '';

        if ($typeofsystem === 'current') {
            switch ($type) {
                case 'ISR':
                    $status_field = 'isr_status';
                    break;
                case 'ATTENDANCE':
                    $status_field = 'att_status';
                    break;
                case 'MINUTES':
                    $status_field = 'minute_status';
                    break;
                case 'WALKTHROUGH':
                    $status_field = 'wt_status';
                    break;
                case 'FLOWCHART':
                    $status_field = 'flowchart_status';
                    break;
                case 'DFD':
                    $status_field = 'dfd_status';
                    break;
                case 'SYSTEM_PROPOSED':
                    $status_field = 'proposed_status';
                    break;
                case 'GANTT_CHART':
                    $status_field = 'gantt_status';
                    break;
                case 'LOCAL_TESTING':
                    $status_field = 'local_status';
                    break;
                case 'UAT':
                    $status_field = 'uat_status';
                    break;
                case 'LIVE_TESTING':
                    $status_field = 'live_status';
                    break;
                case 'USER_GUIDE':
                    $status_field = 'guide_status';
                    break;
                case 'MEMO':
                    $status_field = 'memo_status';
                    break;
                case 'BUSINESS_ACCEPTANCE':
                    $status_field = 'acceptance_status';
                    break;
            }
        }
        if ($typeofsystem === 'new') {
            switch ($type) {
                case 'ISR':
                    $status_field = 'isr_status';
                    break;
                case 'ATTENDANCE':
                    $status_field = 'att_status';
                    break;
                case 'MINUTES':
                    $status_field = 'minute_status';
                    break;
                case 'WALKTHROUGH':
                    $status_field = 'wt_status';
                    break;
                case 'FLOWCHART':
                    $status_field = 'flowchart_status';
                    break;
                case 'DFD':
                    $status_field = 'dfd_status';
                    break;
                case 'SYSTEM_PROPOSED':
                    $status_field = 'proposed_status';
                    break;
                case 'GANTT_CHART':
                    $status_field = 'gantt_status';
                    break;
                case 'LOCAL_TESTING':
                    $status_field = 'local_status';
                    break;
                case 'UAT':
                    $status_field = 'uat_status';
                    break;
                case 'LIVE_TESTING':
                    $status_field = 'live_status';
                    break;
                case 'USER_GUIDE':
                    $status_field = 'guide_status';
                    break;
                case 'MEMO':
                    $status_field = 'memo_status';
                    break;
                case 'BUSINESS_ACCEPTANCE':
                    $status_field = 'acceptance_status';
                    break;
            }
        }

        // if($type == 'LIVE_TESTING'){
        //     $this->db->set('implem_type', '1');
        //     $this->db->where('mod_id', $mod_id);
        //     $this->db->update('module');
        // }
        $update_data = [
            $status_field => 'Approve'
        ];

        $this->admin->approved($file_id, $update_data, $typeofsystem);  // Pass typeofsystem to the model
    }

    public function backtopending()
    {
        $file_id = $this->input->post('file_id');
        $type = $this->input->post('type');
        $typeofsystem = $this->input->post('typeofsystem');
        $mod_id = $this->input->post('mod_id');
        $status_field = '';

        if ($typeofsystem === 'current') {
            switch ($type) {
                case 'ISR':
                    $status_field = 'isr_status';
                    break;
                case 'ATTENDANCE':
                    $status_field = 'att_status';
                    break;
                case 'MINUTES':
                    $status_field = 'minute_status';
                    break;
                case 'WALKTHROUGH':
                    $status_field = 'wt_status';
                    break;
                case 'FLOWCHART':
                    $status_field = 'flowchart_status';
                    break;
                case 'DFD':
                    $status_field = 'dfd_status';
                    break;
                case 'SYSTEM_PROPOSED':
                    $status_field = 'proposed_status';
                    break;
                case 'GANTT_CHART':
                    $status_field = 'gantt_status';
                    break;
                case 'LOCAL_TESTING':
                    $status_field = 'local_status';
                    break;
                case 'UAT':
                    $status_field = 'uat_status';
                    break;
                case 'LIVE_TESTING':
                    $status_field = 'live_status';
                    break;
                case 'USER_GUIDE':
                    $status_field = 'guide_status';
                    break;
                case 'MEMO':
                    $status_field = 'memo_status';
                    break;
                case 'BUSINESS_ACCEPTANCE':
                    $status_field = 'acceptance_status';
                    break;
            }
        }
        if ($typeofsystem === 'new') {
            switch ($type) {
                case 'ISR':
                    $status_field = 'isr_status';
                    break;
                case 'ATTENDANCE':
                    $status_field = 'att_status';
                    break;
                case 'MINUTES':
                    $status_field = 'minute_status';
                    break;
                case 'WALKTHROUGH':
                    $status_field = 'wt_status';
                    break;
                case 'FLOWCHART':
                    $status_field = 'flowchart_status';
                    break;
                case 'DFD':
                    $status_field = 'dfd_status';
                    break;
                case 'SYSTEM_PROPOSED':
                    $status_field = 'proposed_status';
                    break;
                case 'GANTT_CHART':
                    $status_field = 'gantt_status';
                    break;
                case 'LOCAL_TESTING':
                    $status_field = 'local_status';
                    break;
                case 'UAT':
                    $status_field = 'uat_status';
                    break;
                case 'LIVE_TESTING':
                    $status_field = 'live_status';
                    break;
                case 'USER_GUIDE':
                    $status_field = 'guide_status';
                    break;
                case 'MEMO':
                    $status_field = 'memo_status';
                    break;
                case 'BUSINESS_ACCEPTANCE':
                    $status_field = 'acceptance_status';
                    break;
            }
        }

        // if($type == 'LIVE_TESTING'){
        //     $this->db->set('implem_type', '0');
        //     $this->db->where('mod_id', $mod_id);
        //     $this->db->update('module');
        // }

        $update_data = [
            $status_field => 'Pending'
        ];

        $this->admin->backtopending($file_id, $update_data, $typeofsystem);
    }

    public function fetch_notifications()
    {
        $notifications = $this->admin->get_notifications();
        echo json_encode($notifications);
    }
    public function get_notification_count()
    {
        $count = $this->admin->get_pending_notification_count();
        echo json_encode(['count' => $count]);
    }
    public function get_module_count()
    {
        $count = $this->admin->get_pending_module_count();
        $count2 = $this->admin->get_pending_module_count_implemented();
        echo json_encode([
            'count' => $count,
            'count2' => $count2
        ]);
    }

    public function get_workload_count()
    {
        $count = $this->admin->get_workload_count();
        echo json_encode(['count' => $count]);
    }

    public function get_weekly_count()
    {
        $count = $this->admin->get_weekly_count();
        echo json_encode(['count' => $count]);
    }

    public function fetch_messages()
    {
        $messages = $this->admin->get_messages();

        foreach ($messages as &$msg) {
            $emp = $this->workload->get_emp($msg['sender_id']);

            $msg['name'] = $emp['name'];
        }

        echo json_encode($messages);
    }


    public function get_messages_count()
    {
        $count = $this->admin->get_messages_count();
        echo json_encode(['count' => $count]);
    }

    public function generate_pdf()
    {
        $modules = $this->admin->get_print_module();

        // Initialize the PDF object
        $pdf = new PDF('P', PDF_UNIT, 'LETTER', true, 'UTF-8', false);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
        $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));
        $pdf->SetMargins(10, 30, 10);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $pdf->AddPage();
        $pdf->setPrintFooter(true);
        $pdf->setFooterFont(array('', '', 8));

        $pdf->SetFont('helvetica', '', 10);

        $html = '
        <table border="1" cellpadding="5" cellspacing="0" width="100%">
            <thead>
                <tr nobr="true">
                    <th style="text-align:center; width:33.4%;">MODULE</th>
                    <th style="text-align:center; width:33.3%;">TYPE</th>
                    <th style="text-align:center; width:33.3%;">SUBMODULE</th>
                </tr>
            </thead>
            <tbody>';

        foreach ($modules as $module) {
            $html .= '<tr nobr="true">';
            $html .= '<td width:33%;>' . $module->mod_name . '</td>';
            $html .= '<td width:34%;>' . $module->typeofsystem . '</td>';

            if (!empty($module->submodules)) {
                $submodules = '';
                foreach ($module->submodules as $submodule) {
                    $submodules .= $submodule->sub_mod_name . '<br>'; // Concatenate submodule names with line break
                }
                $html .= '<td width:33%;>' . $submodules . '</td>';
            } else {
                $html .= '<td width:34%;></td>';
            }

            $html .= '</tr>';
        }

        $html .= '</tbody></table>';

        // Output HTML content to the PDF
        $pdf->writeHTML($html, true, false, false, false, '');

        // Output the generated PDF
        $pdf->Output('MODULE|SUBMODULE.pdf', 'I');
    }

    public function company_phone_view()
    {
        $this->load->view('_layouts/header');
        $this->load->view('admin/company_phone');
        $this->load->view('_layouts/footer');

    }

    public function list_company_phone()
    {

        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $order = $this->input->post('order');
        $search_value = $this->input->post('search')['value'];
        $order_column = $order[0]['column'];
        $order_dir = $order[0]['dir'];

        $logs = $this->admin->getCompanyPhone($start, $length, $order_column, $order_dir, $search_value);
        $data = [];

        foreach ($logs as $row) {

            $data[] = [
                'team' => $row['team'],
                'ip_phone' => $row['ip_phone'],
                'action' => '
                                <div class="hstack gap-1 d-flex justify-content-center">
                                    <button type="button" class="btn btn-soft-info waves-effect waves-light btn-sm" onclick="edit_company_phone(' . $row['id'] . ', \'' . addslashes($row['team']) . '\', \'' . $row['ip_phone'] . '\')" data-bs-toggle="modal" data-bs-target="#edit_setup_company_phone">
                                        <iconify-icon icon="solar:pen-bold-duotone" class="label-icon align-bottom fs-16"></iconify-icon>
                                    </button>
                                    <button type="button" class="btn btn-soft-danger waves-effect waves-light btn-sm" onclick="delete_company_phone(' . $row['id'] . ')">
                                        <iconify-icon icon="solar:trash-bin-minimalistic-bold-duotone" class="label-icon align-bottom fs-16"></iconify-icon>
                                    </button>
                                </div>'
            ];
        }
        $total_records = $this->admin->totalCompanyPhone($search_value);

        $output = [
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => $total_records,
            "recordsFiltered" => $total_records,
            "data" => $data
        ];
        echo json_encode($output);
    }

    public function add_company_phone()
    {
        $desc = $this->input->post('description');
        $ip = $this->input->post('ip_phone');
        $data = array(
            'team' => $desc,
            'ip_phone' => $ip,
        );
        $this->admin->insertCompany($data);
    }
    public function update_company_phone()
    {
        $desc = $this->input->post('description');
        $ip = $this->input->post('ip_phone');
        $id = $this->input->post('id');
        $data = array(
            'team' => $desc,
            'ip_phone' => $ip,
        );
        $this->admin->updateCompany($data, $id);
    }

    public function delete_company_phone()
    {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('company_phone');
    }



    public function team_list()
    {

        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $order = $this->input->post('order');
        $search_value = $this->input->post('search')['value'];
        $order_column = $order[0]['column'];
        $order_dir = $order[0]['dir'];

        $team_data = $this->admin->getTeamList($start, $length, $order_column, $order_dir, $search_value);
        $data = [];

        foreach ($team_data as $row) {
            $status = '';
            if ($row['status'] == 'Active') {
                $status = '<span class="badge bg-success">' . $row['status'] . '</span>';
            } else {
                $status = '<span class="badge bg-danger">' . $row['status'] . '</span>';
            }
            $data[] = [
                'team_name' => $row['team_name'],
                'status' => $status,
                'action' => '
                                <div class="hstack gap-1 d-flex justify-content-center">
                                    <button type="button" class="btn btn-soft-info waves-effect waves-light btn-sm" onclick="edit_team(' . $row['team_id'] . ', \'' . addslashes($row['team_name']) . '\', \'' . $row['status'] . '\')" data-bs-toggle="modal" data-bs-target="#edit_team">
                                        <iconify-icon icon="solar:pen-bold-duotone" class="label-icon align-bottom fs-16"></iconify-icon>
                                    </button>
                                    <button type="button" class="btn btn-soft-danger waves-effect waves-light btn-sm" onclick="delete_team(' . $row['team_id'] . ')">
                                        <iconify-icon icon="solar:trash-bin-minimalistic-bold-duotone" class="label-icon align-bottom fs-16"></iconify-icon>
                                    </button>
                                </div>'
            ];
        }
        $total_records = $this->admin->totalTeamList($search_value);

        $output = [
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => $total_records,
            "recordsFiltered" => $total_records,
            "data" => $data
        ];
        echo json_encode($output);
    }

    public function add_team()
    {
        $team_name = $this->input->post('team');
        $status = $this->input->post('status');
        $data = array(
            'team_name' => $team_name,
            'status' => $status,
        );
        $this->admin->insertTeam($data);
    }
    public function update_team()
    {
        $team_name = $this->input->post('team');
        $status = $this->input->post('status');
        $id = $this->input->post('id');
        $data = array(
            'team_name' => $team_name,
            'status' => $status,
        );
        $this->admin->updateTeam($data, $id);
    }

    public function delete_team()
    {
        $id = $this->input->post('id');
        $this->db->where('team_id', $id);
        $this->db->delete('team');
    }

    public function setup_rules_regulation_view()
    {
        // $data['files'] = $this->admin->rules_regulations_data();
        $this->load->view('_layouts/header');
        $this->load->view('admin/setup_rules_regulation');
        $this->load->view('_layouts/footer');
    }
    public function setup_rules_regulation_list()
    {
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $order = $this->input->post('order');
        $search_value = $this->input->post('search')['value'];
        $order_column = $order[0]['column'];
        $order_dir = $order[0]['dir'];

        $rules_data = $this->admin->rules_regulations_data($start, $length, $order_column, $order_dir, $search_value);
        $data = [];

        foreach ($rules_data as $row) {
            $file_ext = strtolower(pathinfo($row['filename'], PATHINFO_EXTENSION));
            $file_url = base_url('rules_regulations/' . $row['filename']);
            $file_display = '';

            if (in_array($file_ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                $file_display = '<img src="' . htmlspecialchars($file_url) . '" alt="Uploaded Image" class="img-thumbnail" width="100">';
            } elseif ($file_ext === 'pdf') {
                $file_display = '
                    <embed src="' . htmlspecialchars($file_url) . '" type="application/pdf" width="300" height="120">
                    <br>
                    <a href="' . htmlspecialchars($file_url) . '" target="_blank" class="btn btn-sm btn-primary">
                        <i class="fas fa-file-pdf"></i> Open PDF
                    </a>';
            } else {
                $file_display = '
                    <a href="' . htmlspecialchars($file_url) . '" target="_blank" class="btn btn-sm btn-secondary">
                        Download
                    </a>';
            }

            $data[] = [
                'team_name' => htmlspecialchars($row['team_name']),
                'filename' => htmlspecialchars($row['filename']),
                'image' => $file_display,
                'action' => '
                    <div class="hstack gap-1 d-flex justify-content-center">
                        <button type="button" class="btn btn-soft-danger waves-effect waves-light btn-sm" 
                            onclick=" deleteFile(' . intval($row['id']) . ', \'' . $row['filename'] . '\')">
                            <iconify-icon icon="solar:trash-bin-minimalistic-bold-duotone" class="label-icon align-bottom fs-16"></iconify-icon>
                        </button>
                    </div>'
            ];
        }

        $total_records = $this->admin->rules_regulations_count($search_value);

        $output = [
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => $total_records,
            "recordsFiltered" => $total_records,
            "data" => $data
        ];

        echo json_encode($output);
    }



    public function upload_file_rules_regulations()
    {
        $response = ['success' => false, 'message' => ''];
        $team = $this->security->xss_clean($this->input->post('team', TRUE));
        $teamName = $this->security->xss_clean($this->input->post('team_name', TRUE));

        $folder_path = './rules_regulations/';
        if (!is_dir($folder_path)) {
            mkdir($folder_path, 0777, true);
        }

        $config['upload_path'] = $folder_path;
        $config['allowed_types'] = 'pdf|doc|docx|png|jpg|jpeg';
        $config['max_size'] = 51200; // 50MB

        $this->load->library('upload', $config);

        $uploaded_files = $_FILES['file'];
        $files_count = count($uploaded_files['name']);
        $success_count = 0;

        for ($i = 0; $i < $files_count; $i++) {
            $_FILES['single_file']['name'] = $uploaded_files['name'][$i];
            $_FILES['single_file']['type'] = $uploaded_files['type'][$i];
            $_FILES['single_file']['tmp_name'] = $uploaded_files['tmp_name'][$i];
            $_FILES['single_file']['error'] = $uploaded_files['error'][$i];
            $_FILES['single_file']['size'] = $uploaded_files['size'][$i];

            $this->upload->initialize($config);

            if ($this->upload->do_upload('single_file')) {
                $success_count++;
                $uploaded_data = $this->upload->data();

                $data = [
                    'team_id' => $team,
                    'team_name' => $teamName,
                    'filename' => $uploaded_data['file_name'],
                ];

                $this->admin->upload_file($data);
            }
        }

        if ($success_count === $files_count) {
            $response['success'] = true;
            $response['message'] = 'Files uploaded successfully.';
        } else {
            $response['message'] = 'Some files failed to upload.';
        }

        echo json_encode($response);
    }

    public function delete_file($id)
    {

        $file = $this->admin->getFileById($id);
        if (!$file) {
            echo json_encode(['success' => false, 'message' => 'File not found']);
            return;
        }

        $file_path = FCPATH . 'rules_regulations/' . $file['filename'];
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        if ($this->admin->deleteFile($id)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete from database']);
        }
    }

    public function confidential()
    {
        $this->load->view('_layouts/header');
        $this->load->view('admin/confidential_files');
        $this->load->view('_layouts/footer');
    }





}


