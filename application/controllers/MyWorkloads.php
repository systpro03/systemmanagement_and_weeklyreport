<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyWorkloads extends CI_Controller {
	function __construct()
	{
		parent::__construct();
        if ($this->session->username == "") {
            redirect('login');
        }
		$this->load->model('MyWorkloads_mod', 'myWorkload');
	}

    public function index(){
        $this->load->view('_layouts/header');
        $this->load->view('myworkloads');
        $this->load->view('_layouts/footer');
    }

    public function get_team()
    {
        $module = $this->myWorkload->get_teams();
        echo json_encode($module);
    }


    public function setup_module_dat()
    {
        $team = $this->input->post('team');
        $module = $this->myWorkload->get_module_dat($team);
        echo json_encode($module);
    }

    public function fetch_workloads()
    {
        $team = $this->input->get('team', true) ?: '';
        $module = $this->input->get('module', true) ?: '';
        $status = $this->input->get('status', true) ?: 'all';
        $view   = $this->input->get('view', true) ?: 'grid';

        $page = (int) $this->input->get('page', true) ?: 1;
        $limit = 12;
        $offset = ($page - 1) * $limit;

        $workloads = $this->myWorkload->get_workloads($team, $module, $status, $limit, $offset);

        $total_workloads = $this->myWorkload->count_workloads($team, $module, $status);
        $total_pages = max(1, ceil($total_workloads / $limit));
    
        if (empty($workloads)) {
            echo '<div class="alert alert-info text-center text-primary"><iconify-icon icon="fluent:box-multiple-search-24-filled" width="80" height="80"></iconify-icon><h6 class="mt-2">No workload has been added yet in '.$status.'.. </h6></div>';
            return;
        }
        $html = '';
        $badgeClass = '';
        if ($view === 'grid') {
            $html = '<div class="row">';
            foreach ($workloads as $workload) {

                $new = '';
                if(date('Y-m-d', strtotime($workload->date_added)) == date('Y-m-d')) {
                    $new = '<div class="text-start">
                                <span class="me-auto fs-6 ribbon-three ribbon-three-info">
                                    <span><b>New</b></span>
                                </span>
                            </div>';
                }

                $badgeClass = 'bg-warning';
                $icon = '<iconify-icon icon="solar:hourglass-line-bold-duotone" width="25" height="25"></iconify-icon>';
                if ($workload->w_status === 'Pending') {
                    $badgeClass = 'bg-danger';
                    $icon = '<iconify-icon icon="ic:round-pending-actions" width="24" height="24"></iconify-icon>';
                } elseif ($workload->w_status === 'Done') {
                    $badgeClass = 'bg-success';
                    $icon = '<iconify-icon icon="tdesign:task-checked-filled" width="25" height="25"></iconify-icon>';
                }
                $html .= '
                <div class="col-md-4" data-aos="zoom-in-up"> 
                    <div class="card joblist-card ribbon-box right" style="box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.35);">
                        <div class="card-body">  
                            ' . $new . '
                            <div class="d-flex mb-4">
                                <div class="avatar-sm">
                                    <div class="avatar-title ' . $badgeClass . ' rounded">
                                        '.$icon.'
                                    </div>
                                </div>
                                <div class="ms-3 flex-grow-1">
                                    <a href="#!">
                                    <h5 class="job-title fw-bold fs-15">' . htmlspecialchars(ucwords(strtolower($workload->mod_name))) . ' | ' . htmlspecialchars(ucwords(strtolower($workload->sub_mod_name))) . '</h5>
                                    </a>
                                    <p class="company-name text-muted mb-0 fs-12">' . htmlspecialchars($workload->team_name) . '</p>
                                </div>
                            </div>
                            <div class="d-flex mb-1">
                                <span class="fw-bold me-2" style="min-width: 90px;">Menu:</span>
                                <span class="text-muted fs-11 flex-grow-1">' . 
                                    (!empty($workload->sub_mod_menu) 
                                        ? htmlspecialchars($workload->sub_mod_menu) 
                                        : '<span class="badge bg-secondary-subtle text-muted">N/A</span>') . 
                                '</span>
                            </div>

                                <div class="d-flex mb-1">
                                    <span class="fw-bold me-2" style="min-width: 90px;">Concerns:</span>
                                        <span class="text-muted fs-11 flex-grow-1">
                                        ' . (!empty($workload->desc) 
                                            ? '<a href="#!" class="text-muted concern-link text-truncate-two-lines" 
                                                >
                                                    ' . htmlspecialchars($workload->desc, ENT_QUOTES) . '
                                            </a> <small href="#!" data-bs-toggle="modal" class="text-danger fw-bold concern-link" style="cursor: pointer;"
                                                data-bs-target="#concernModal" 
                                                data-concerns="' . htmlspecialchars($workload->desc, ENT_QUOTES) . '">( see more...)</small>' 
                                            : '<span class="badge bg-secondary-subtle text-muted">N/A</span>') . '
                                        </span>
                                </div>

                            <div class="d-flex mb-1">
                                <span class="fw-bold me-2" style="min-width: 90px;">Remarks:</span>
                                <span class="text-muted fs-11 flex-grow-1">' . 
                                    (!empty($workload->remarks) 
                                        ? htmlspecialchars($workload->remarks) 
                                        : '<span class="badge bg-secondary-subtle text-muted">N/A</span>') . 
                                '</span>
                            </div>
                        </div>
                        <div class="card-footer border-top-dashed text-muted">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-1 fs-11">
                                <div><i class="ri-briefcase-2-line align-bottom me-1"></i> <span class="job-type">' . $workload->type . '</span></div>
                                <div><i class="ri-map-pin-2-line align-bottom me-1"></i> <span class="job-location">' . $this->session->hrms_position . '</span></div>
                                <div><i class="ri-book-3-line align-bottom me-1"></i> <span class="badge ' . $badgeClass . '">' . htmlspecialchars($workload->w_status) . '</span></div>
                                <div><i class="ri-time-line align-bottom me-1"></i> <span class="job-postdate">' . date('M d, Y', strtotime($workload->date_added)) . '</span></div>
                            </div>
                        </div>
                    </div>
                </div>';
            
            }
            $html .= '</div>';
        }
        if ($view === 'list') {
            $html = '<div class="list-group" >';
            foreach ($workloads as $workload) {

                $new = '';
                if (date('Y-m-d', strtotime($workload->date_added)) == date('Y-m-d')) {
                    $new = '<span class="badge bg-info text-white ms-2">New</span>';
                }
                $badgeClass = 'bg-warning';
                $icon = '<iconify-icon icon="solar:hourglass-line-bold-duotone" width="18" height="18"></iconify-icon>';
                if ($workload->w_status === 'Pending') {
                    $badgeClass = 'bg-danger';
                    $icon = '<iconify-icon icon="ic:round-pending-actions" width="18" height="18"></iconify-icon>';
                } elseif ($workload->w_status === 'Done') {
                    $badgeClass = 'bg-success';
                    $icon = '<iconify-icon icon="tdesign:task-checked-filled" width="18" height="18"></iconify-icon>';
                }

                $html .= '
                <article class="list-group-item p-0 mb-3 border rounded shadow-sm overflow-hidden" data-aos="zoom-in-up">
                    <div class="p-3">
                        <div class="d-flex align-items-start">
                            <div class="me-3">
                                <span class="avatar-title '.$badgeClass.' rounded-circle p-2">
                                    '.$icon.'
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="fw-bold mb-1">'.htmlspecialchars(ucwords(strtolower($workload->mod_name))).' | '.htmlspecialchars(ucwords(strtolower($workload->sub_mod_name))).' '.$new.'</h5>
                                <p class="text-muted mb-2 small">
                                    <i class="ri-team-line me-1"></i>'.htmlspecialchars($workload->team_name).' | 
                                    <i class="ri-time-line me-1"></i>'.date('F d, Y', strtotime($workload->date_added)).'
                                </p>

                                <div class="mb-1"><strong>Menu:</strong> '.
                                    (!empty($workload->sub_mod_menu) 
                                        ? htmlspecialchars($workload->sub_mod_menu) 
                                        : '<span class="badge bg-secondary-subtle text-muted">N/A</span>') . 
                                '</div>

                                <div class="mb-1"><strong>Concerns:</strong> '.
                                    (!empty($workload->desc) 
                                        ? '<span class="text-muted">'.ucwords(strtolower($workload->desc)).'</span>' 
                                        : '<span class="badge bg-secondary-subtle text-muted">N/A</span>') . 
                                '</div>

                                <div class="mb-1"><strong>Remarks:</strong> '.
                                    (!empty($workload->remarks) 
                                        ? htmlspecialchars($workload->remarks) 
                                        : '<span class="badge bg-secondary-subtle text-muted">N/A</span>') . 
                                '</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light border-top d-flex justify-content-between align-items-center flex-wrap gap-2 small">
                        <span><i class="ri-briefcase-2-line me-1"></i>'.$workload->type.'</span>
                        <span><i class="ri-map-pin-2-line me-1"></i>'.$this->session->hrms_position.'</span>
                        <span><i class="ri-book-3-line me-1"></i><span class="badge '.$badgeClass.'">'.htmlspecialchars($workload->w_status).'</span></span>
                        <span><i class="ri-time-line me-1"></i>'.date('F d, Y', strtotime($workload->date_added)).'</span>
                    </div>
                </article>';
            }
            $html .= '</div>';
        }

        $prev_page = max(1, $page - 1);
        $next_page = min($total_pages, $page + 1);
    
        $pagination = '<div class="d-flex justify-content-center mt-3">';
        if ($page > 1) {
            $pagination .= '<a href="javascript:void(0);" class="btn btn-primary btn-sm mx-1 pagination-link workload" data-page="' . $prev_page . '">Prev</a>';
        }
        $pagination .= '<span class="mx-2 text-muted">Page ' . $page . ' of ' . $total_pages . '</span>';
        if ($page < $total_pages) {
            $pagination .= '<a href="javascript:void(0);" class="btn btn-primary btn-sm mx-1 pagination-link workload" data-page="' . $next_page . '">Next</a>';
        }
        $pagination .= '</div>';
        ?>
        <script>
            document.addEventListener('click', function (event) {
                const link = event.target.closest('.concern-link');
                if (link) {
                    const concerns = link.getAttribute('data-concerns');
                    const modalBody = document.getElementById('concernModalBody');
                    modalBody.innerHTML = concerns ? concerns.replace(/\n/g, '<br>') : 'No concerns provided.';
                }
            });
        </script>
        <?php
        echo $html . $pagination;
    }
    public function fetch_tasks()
    {
        $team = $this->input->get('team', true) ?: '';
        $module = $this->input->get('module', true) ?: '';
        $s = $this->input->get('task_stats');
        $view   = $this->input->get('view', true) ?: 'grid';

        $page = (int) $this->input->get('page', true) ?: 1;
        $limit = 12;
        $offset = ($page - 1) * $limit;
    
        $status = '';
        if ($s == 'AllTasks') {
            $status = 'all';
        } elseif ($s == 'PendingTasks') {
            $status = 'Pending';
        } elseif ($s == 'OngoingTasks') {
            $status = 'Ongoing';
        } elseif ($s == 'DoneTasks') {
            $status = 'Done';
        }
    
        $tasks = $this->myWorkload->get_tasks($team, $module, $status, $limit, $offset);
        $total_tasks = $this->myWorkload->count_tasks($team, $module,$status);
        $total_pages = max(1, ceil($total_tasks / $limit));
    
        if (empty($tasks)) {
            echo '<div class="alert alert-info text-center text-primary">
                    <iconify-icon icon="fluent:box-multiple-search-24-filled" width="80" height="80"></iconify-icon>
                    <h6 class="mt-2">No daily task has been added yet in ' . htmlspecialchars($status) . '.</h6>
                  </div>';
            return;
        }

        $html = '';
        $badgeClass = '';
        if ($view === 'grid') {
            $html = '<div class="row">';
            foreach ($tasks as $workload) {

                $badgeClass = 'bg-warning';
                $icon = '<iconify-icon icon="solar:hourglass-line-bold-duotone" width="25" height="25"></iconify-icon>';
                if ($workload->weekly_status === 'Pending') {
                    $badgeClass = 'bg-danger';
                    $icon = '<iconify-icon icon="ic:round-pending-actions" width="24" height="24"></iconify-icon>';
                } elseif ($workload->weekly_status === 'Done') {
                    $badgeClass = 'bg-success';
                    $icon = '<iconify-icon icon="tdesign:task-checked-filled" width="25" height="25"></iconify-icon>';
                }


                $new = '';
                if(date('Y-m-d', strtotime($workload->date_added)) == date('Y-m-d')) {
                    $new = '<div class="text-start">
                                <span class="me-auto fs-6 ribbon-three  ribbon-three-info">
                                    <span><b>New</b></span>
                                </span>
                            </div>';
                }


                $html .= '
                    <div class="col-md-4" data-aos="zoom-in-up"> 
                        <div class="card joblist-card ribbon-box right" style="box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.35);">
                            <div class="card-body ">  
                                ' . $new . '
                                <div class="d-flex mb-4">
                                    <div class="avatar-sm">
                                        <div class="avatar-title ' . $badgeClass . ' rounded">
                                            '.$icon.'
                                        </div>
                                    </div>
                                    <div class="ms-3 flex-grow-1">
                                        <a href="#!">
                                            <h5 class="job-title fw-bold fs-15">' . htmlspecialchars(ucwords(strtolower($workload->mod_name))) . ' | ' . htmlspecialchars(ucwords(strtolower($workload->sub_mod_name))) . '</h5>
                                        </a>
                                        <p class="company-name text-muted mb-0 fs-12">' . htmlspecialchars($workload->team_name) . '</p>
                                    </div>
                                </div>
                                <div class="d-flex mb-1">
                                    <span class="fw-bold me-2" style="min-width: 90px;">Menu:</span>
                                    <span class="text-muted fs-11 flex-grow-1 text-break" style="word-wrap: break-word; overflow-wrap: break-word;">' . 
                                        (!empty($workload->task_workload) 
                                            ? htmlspecialchars($workload->task_workload) 
                                            : '<span class="badge bg-secondary-subtle text-muted">N/A</span>') . 
                                    '</span>
                                </div>

                                <div class="d-flex mb-1">
                                    <span class="fw-bold me-2" style="min-width: 90px;">Concerns:</span>
                                        <span class="text-muted fs-11 flex-grow-1">
                                        ' . (!empty($workload->concerns) 
                                            ? '<a href="#!" class="text-muted concern-link text-truncate-two-lines" 
                                                >
                                                    ' . htmlspecialchars($workload->concerns, ENT_QUOTES) . '
                                            </a> <small href="#!" data-bs-toggle="modal" class="text-danger fw-bold concern-link" style="cursor: pointer;"
                                                data-bs-target="#concernModal" 
                                                data-concerns="' . htmlspecialchars($workload->concerns, ENT_QUOTES) . '">( see more...)</small>' 
                                            : '<span class="badge bg-secondary-subtle text-muted">N/A</span>') . '
                                        </span>
                                </div>
                                <div class="d-flex mb-1">
                                    <span class="fw-bold me-2" style="min-width: 90px;">Remarks:</span>
                                    <span class="text-muted fs-11 flex-grow-1">' . 
                                        (!empty($workload->remarks) 
                                            ? htmlspecialchars($workload->remarks) 
                                            : '<span class="badge bg-secondary-subtle text-muted">N/A</span>') . 
                                    '</span>
                                </div>
                            </div>
                            <div class="card-footer border-top-dashed text-muted">
                                <div class="d-flex justify-content-between align-items-center flex-wrap gap-1 fs-10">
                                    <div><i class="ri-briefcase-2-line align-bottom me-1"></i> <span class="job-type">' . $workload->type . '</span></div>
                                    <div><i class="ri-map-pin-2-line align-bottom me-1"></i> <span class="job-location">' . $this->session->hrms_position . '</span></div>
                                    <div><i class="ri-book-3-line align-bottom me-1"></i> <span class="badge ' . $badgeClass . '">' . htmlspecialchars($workload->weekly_status) . '</span></div>
                                    <div><i class="ri-time-line align-bottom me-1"></i> <span class="job-postdate">' . date('M d, Y', strtotime($workload->date_added)) . '</span></div>
                                </div>
                            </div>
                        </div>
                    </div>';
            }
            $html .= '</div>';
        }

        if ($view === 'list') {
        $html = '<div class="list-group" >';
        foreach ($tasks as $workload) {

            // Check if new
            $new = '';
            if (date('Y-m-d', strtotime($workload->date_added)) == date('Y-m-d')) {
                $new = '<span class="badge bg-info text-white ms-2">New</span>';
            }

            // Badge & icon
            $badgeClass = 'bg-warning';
            $icon = '<iconify-icon icon="solar:hourglass-line-bold-duotone" width="20" height="20"></iconify-icon>';
            if ($workload->weekly_status === 'Pending') {
                $badgeClass = 'bg-danger';
                $icon = '<iconify-icon icon="ic:round-pending-actions" width="20" height="20"></iconify-icon>';
            } elseif ($workload->weekly_status === 'Done') {
                $badgeClass = 'bg-success';
                $icon = '<iconify-icon icon="tdesign:task-checked-filled" width="20" height="20"></iconify-icon>';
            }

            $html .= '
            <article class="list-group-item p-0 mb-3 border rounded shadow-sm overflow-hidden" data-aos="zoom-in-up">
                <div class="p-3" >
                    <div class="d-flex align-items-start">
                        <div class="me-3">
                            <span class="avatar-title '.$badgeClass.' rounded-circle p-2">
                                '.$icon.'
                            </span>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="fw-bold mb-1">'.htmlspecialchars(ucwords(strtolower($workload->mod_name))).' | '.htmlspecialchars(ucwords(strtolower($workload->sub_mod_name))).' '.$new.'</h5>
                            <p class="text-muted mb-2 small">
                                <i class="ri-team-line me-1"></i>'.htmlspecialchars($workload->team_name).' | 
                                <i class="ri-time-line me-1"></i>'.date('M d, Y', strtotime($workload->date_added)).'
                            </p>

                            <div class="mb-1"><strong>Menu:</strong> '.
                                (!empty($workload->task_workload) 
                                    ? htmlspecialchars($workload->task_workload) 
                                    : '<span class="badge bg-secondary-subtle text-muted">N/A</span>') . 
                            '</div>

                            <div class="mb-1"><strong>Concerns:</strong> '.
                                (!empty($workload->concerns) 
                                    ? '<a href="#!" class="text-muted concern-link">'.ucwords(strtolower($workload->concerns)).'</a>
                                        ' 
                                    : '<span class="badge bg-secondary-subtle text-muted">N/A</span>') . 
                            '</div>

                            <div class="mb-1"><strong>Remarks:</strong> '.
                                (!empty($workload->remarks) 
                                    ? htmlspecialchars($workload->remarks) 
                                    : '<span class="badge bg-secondary-subtle text-muted">N/A</span>') . 
                            '</div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light border-top d-flex justify-content-between align-items-center flex-wrap gap-2 small">
                    <span><i class="ri-briefcase-2-line me-1"></i>'.$workload->type.'</span>
                    <span><i class="ri-map-pin-2-line me-1"></i>'.$this->session->hrms_position.'</span>
                    <span><i class="ri-book-3-line me-1"></i><span class="badge '.$badgeClass.'">'.htmlspecialchars($workload->weekly_status).'</span></span>
                    <span><i class="ri-time-line me-1"></i>'.date('F d, Y', strtotime($workload->date_added)).'</span>
                </div>
            </article>';
        }
        $html .= '</div>';
    }

    
        $prev_page = max(1, $page - 1);
        $next_page = min($total_pages, $page + 1);
    
        $pagination = '<div class="d-flex justify-content-center mt-3">';
        if ($page > 1) {
            $pagination .= '<a href="javascript:void(0);" class="btn btn-primary btn-sm mx-1 pagination-link task" data-page="' . $prev_page . '">Prev</a>';
        }
        $pagination .= '<span class="mx-2 text-muted">Page ' . $page . ' of ' . $total_pages . '</span>';
        if ($page < $total_pages) {
            $pagination .= '<a href="javascript:void(0);" class="btn btn-primary btn-sm mx-1 pagination-link task" data-page="' . $next_page . '">Next</a>';
        }
        $pagination .= '</div>';
    
        ?>
        <script>
            document.addEventListener('click', function (event) {
                const link = event.target.closest('.concern-link');
                if (link) {
                    const concerns = link.getAttribute('data-concerns');
                    const modalBody = document.getElementById('concernModalBody');
                    modalBody.innerHTML = concerns ? concerns.replace(/\n/g, '<br>') : 'No concerns provided.';
                }
            });
        </script>
        <?php
        echo $html . $pagination;
    }
}