<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Search extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->username == "") {
            redirect('login');
        }

        $this->load->model('Search_mod', 'search');
        $this->load->model('Menu/Workload', 'workload');
        $this->load->model('Menu/Structure_mod', 'structure');
    }

    public function index()
    {
        $this->load->view('_layouts/header');
        $this->load->view('admin/search_results');
        $this->load->view('_layouts/footer');
    }

    private function is_directory_name($dirName)
    {
        $this->db->select('*');
        $this->db->from('directory');
        $this->db->where('dir_name', $dirName);
        $query = $this->db->get();
        return $query->num_rows() > 0;
    }

    public function search_files()
    {
        $key = $this->input->post('keyword', TRUE);
        $keyword = str_replace(' ', '_', $key);
        $base_url = base_url();
        $server = '';
        $desc = '';
        if (empty($key)) {
            echo json_encode(['status' => 'error', 'message' => 'Please enter a search term.']);
            return;
        }

        $serverRecord = $this->search->get_server_address($key);
        if ($serverRecord) {
            $server = $serverRecord->server;
        }

        if ($this->is_directory_name($keyword)) {
            $dirName = str_replace(' ', '_', $keyword);
            $fileNameSearch = $keyword;
        }else{
            $dirName = '';
            $fileNameSearch = $key;
        }

        $module_desc = $this->search->module_description($fileNameSearch);

        if ($module_desc !== null) {
            $desc = $module_desc->module_desc;
            $module_description = $this->search->count_search_module_desc($desc);
        } else {
            $desc = null;
            $module_description = 0;
        }


        $page = (int) $this->input->post('page');
        if ($page < 1){
            $page = 1;
        }
        $per_page = 12;
        $offset = ($page - 1) * $per_page;

        if (empty($fileNameSearch) && empty($server) && empty($desc)) {
            echo json_encode(['status' => 'error', 'message' => 'Please enter a search term.']);
            return;
        }
        // $module_description = $this->search->count_search_module_desc($desc);
        $server_count       = $this->search->count_search_server($server);
        $total_results1     = $this->search->count_files_by_directory($dirName, $fileNameSearch);
        $workload_count     = $this->search->count_search_workloads_and_weekly_report($fileNameSearch);
        $total_results      = $total_results1 + $workload_count + $server_count + $module_description;

        if ($total_results === 0) {
            echo json_encode([
                'status' => 'error',
                'message' => 'No results found. Please search a valid file.'
            ]);
            return;
        }

        $results = [];
        $workload_results = [];
        $server_results = [];
        $module_desc_results = [];

        if ($offset < $total_results1) {
            // Files first
            $results = $this->search->get_files_by_directory($dirName, $fileNameSearch, $per_page, $offset);

            $remaining = $per_page - count($results);

            if ($remaining > 0) {
                $workload_results = $this->search->search_workloads_and_weekly_report($fileNameSearch, $remaining, 0);
                $remaining -= count($workload_results);

                if ($remaining > 0) {
                    $module_desc_results = $this->search->search_module_desc($fileNameSearch, $remaining, 0);
                    $remaining -= count($module_desc_results);
                }

                if ($remaining > 0) {
                    $server_results = $this->search->search_server($server, $remaining, 0);
                }
            }

        } elseif ($offset < $total_results1 + $workload_count) {
            // Workloads
            $workload_offset   = $offset - $total_results1;
            $workload_results  = $this->search->search_workloads_and_weekly_report($fileNameSearch, $per_page, $workload_offset);

            $remaining = $per_page - count($workload_results);

            if ($remaining > 0) {
                $module_desc_results = $this->search->search_module_desc($fileNameSearch, $remaining, 0);
                $remaining -= count($module_desc_results);
            }

            if ($remaining > 0) {
                $server_results = $this->search->search_server($server, $remaining, 0);
            }

        } elseif ($offset < $total_results1 + $workload_count + $module_description) {
            // Module description
            $module_offset       = $offset - $total_results1 - $workload_count;
            $module_desc_results = $this->search->search_module_desc($fileNameSearch, $per_page, $module_offset);

            $remaining = $per_page - count($module_desc_results);

            if ($remaining > 0) {
                $server_results = $this->search->search_server($server, $remaining, 0);
            }

        } else {
            // Server
            $server_offset  = $offset - $total_results1 - $workload_count - $module_description;
            $server_results = $this->search->search_server($server, $per_page, $server_offset);
}


        $output = '';
        foreach ($results as $file) {
            $emp_data = $this->workload->get_emp($file->uploaded_by);

            $ext = strtolower(pathinfo($file->file_name, PATHINFO_EXTENSION));
            $folder = rawurlencode($file->uploaded_to);
            $filename = rawurlencode($file->file_name);
            $date = date('F j, Y', strtotime($file->date_uploaded));

            $file_desc = ($file->file_desc == '' || $file->file_desc == null)
                ? '<span class="badge bg-primary">N/A</span>'
                : $file->file_desc;

            $original_file_name = ($file->original_file_name == '' || $file->original_file_name == null)
                ? '<span class="badge bg-primary">Filename not added</span>'
                : $file->original_file_name;

            $modalUrl = '';
            $preview = '';

            switch ($ext) {
                case 'jpg':
                case 'jpeg':
                case 'png':
                case 'gif':
                case 'jfif':
                    $modalUrl = base_url("open_image/{$folder}/{$filename}");
                    $preview = "<img src='{$base_url}open_image/{$folder}/{$filename}' 
                            alt='" . htmlspecialchars($file->original_file_name) . "' 
                            class='img-fluid rounded' style='width:530px; height:280px;'>";
                    break;
                case 'mp4':
                case 'webm':
                case 'ogg':
                    $modalUrl = base_url("open_video/{$folder}/{$filename}");
                    $preview = "<video controls class='rounded' style='width:530px; height:280px;'>
                                <source src='{$base_url}open_video/{$folder}/{$filename}' type='video/{$ext}'>
                                Your browser does not support the video tag.
                            </video>";
                    break;
                case 'mp3':
                case 'm4a':
                case 'wav':
                    $modalUrl = base_url("open_audio/{$folder}/{$filename}");
                    $preview = "<audio controls style='width:530px; height:280px;'>
                                <source src='{$base_url}open_audio/{$folder}/{$filename}' type='audio/{$ext}'>
                                Your browser does not support the audio element.
                            </audio>";
                    break;
                case 'pdf':
                    $modalUrl = base_url("open_pdf/{$folder}/{$filename}");
                    $preview = "<iframe src='{$base_url}open_pdf/{$folder}/{$filename}' 
                            style='width:530px; height:280px;' class='rounded'></iframe>";
                    break;
                case 'docx':
                    $modalUrl = base_url("open_docx/{$folder}/{$filename}");
                    $preview = "<div style='width:530px; height:280px; display:flex; align-items:center; justify-content:center;'>
                                <iconify-icon icon='tabler:file-type-docx' class='align-bottom text-info' style='font-size: 200px;'></iconify-icon>
                            </div>";
                    break;
                case 'xlsx':
                    $modalUrl = base_url("open_xlsx/{$folder}/{$filename}");
                    $preview = "<div style='width:530px; height:280px; display:flex; align-items:center; justify-content:center;'>
                                <iconify-icon icon='ri:file-excel-2-line' class='align-bottom text-success' style='font-size: 200px;'></iconify-icon>
                            </div>";
                    break;
                case 'csv':
                    $modalUrl = base_url("open_csv/{$folder}/{$filename}");
                    $preview = "<div style='width:530px; height:280px; display:flex; align-items:center; justify-content:center;'>
                                <iconify-icon icon='bi:filetype-csv' class='align-bottom text-success' style='font-size: 200px;'></iconify-icon>
                            </div>";
                    break;
                case 'txt':
                    $modalUrl = base_url("open_txt/{$folder}/{$filename}");
                    $preview = "<iframe src='{$base_url}open_txt/{$folder}/{$filename}' 
                            style='width:530px; height:280px;' class='rounded'></iframe>";
                    break;
            }

            if($file->sub_mod_name == null || $file->sub_mod_name == '') {
                $sub_mod_name = '<span class="badge bg-secondary">N/A</span>';
            }else{
                $sub_mod_name = htmlspecialchars($file->sub_mod_name);
            }

            $output .= "
            <div class='mb-4 file-card' onclick=\"previewFileModal('{$modalUrl}')\" style='cursor:pointer;'>
                <h5 class='mb-1 mt-2'>
                    <a href='javascript:void(0);'>{$original_file_name}</a>
                </h5>
                <p class='text-success mb-2'>" . htmlspecialchars($file->uploaded_to) . "</p>
                
                <div class='d-flex flex-column flex-sm-row'>
                    <div class='flex-shrink-0'>
                        {$preview}
                    </div>
                    <div class='flex-grow-1 ms-sm-3 mt-2 mt-sm-0'>
                        <p class='text-muted mb-1'><strong>Team :</strong> " . htmlspecialchars($file->team_name) . "</p>
                        <p class='text-muted mb-1'><strong>Uploaded by:</strong> " . htmlspecialchars($emp_data['name']) . "</p>
                        <p class='text-muted mb-1'><strong>Date:</strong> {$date}</p>
                        <p class='text-muted mb-1'><strong>Module:</strong> " . htmlspecialchars($file->mod_name) . " <span class='badge bg-primary'>{$file->typeofsystem}</span></p>
                        <p class='text-muted mb-1'><strong>Submodule:</strong> " . $sub_mod_name . "</p>
                        <div class='border border-dashed my-3'></div>
                        <small class='fst-italic d-block mb-2 text-wrap text-break'>{$file->file_name}</small>
                        <div>
                            <i class='ri-information-line align-middle me-1'></i>
                            <strong class='text-danger fs-11'>File Description:</strong>
                            <div class='text-wrap text-break fs-10'>{$file_desc}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class='border border-dashed mt-2 mb-4'></div>";
        }

        $output_workloads = '';
        foreach ($workload_results as $w) {
            $emp_data = $this->workload->get_emp($w->emp_id);


            $emp = $this->structure->get_emp($w->emp_id);

            $image = !empty($emp['photo']) ? ltrim($emp['photo'], '.') : '';

            if ($image === '') {
                $photo = '<img src="http://172.16.161.34:8080/hrms/default.png" alt="No Photo" class="rounded-circle avatar-sm material-shadow">';
            } else {
                $photo = '<img src="http://172.16.161.34:8080/hrms/' . $image . '" class="rounded-circle avatar-sm material-shadow">';
            }


            $sub_mod_name = $w->sub_mod_name ?: '<span class="badge bg-secondary">N/A</span>';
            $task_workload = $w->task_workload ?: '<span class="badge bg-secondary">N/A</span>';
            $concerns = $w->concerns ?: '<span class="badge bg-secondary">N/A</span>';
            $remarks = $w->wr_remarks ?: '<span class="badge bg-secondary">N/A</span>';
            $workload_remarks = $w->remarks ?: '<span class="badge bg-secondary">N/A</span>';
            $description = $w->desc ?: '<span class="badge bg-secondary">N/A</span>';
            $status = $w->status ?: '<span class="badge bg-secondary">N/A</span>';
            $weekly_status = $w->weekly_status ?: '<span class="badge bg-secondary">N/A</span>';

            if($w->type == 'Parttime') {
                $type = '<span class="badge bg-warning">Part-time</span>';
            }else{
                $type = '<span class="badge bg-primary">Full-time</span>';
            }

            $output_workloads .= "
            <article class='mb-5 p-4 rounded-3 shadow-lg bg-white'>
                <header class='mb-4'>
                    <h4 class='fw-bold text-dark mb-2'>
                        <i class='fas fa-briefcase text-primary me-2'></i> 
                        {$w->mod_name}
                        <small class='text-muted'>[ <strong class='text-primary'>{$w->mod_abbr}</strong> ]</small>
                    </h4>
                    <h6 class='text-secondary mb-1'>
                        <i class='fas fa-user me-1 text-dark'></i> 
                        Assigned to: <span class='fw-semibold text-dark'>&nbsp; {$photo} &nbsp; {$emp_data['name']}</span> 
                        [ <strong class='text-primary'>" . htmlspecialchars($emp_data['position']) . "</strong> ]
                    </h6>
                    <h6 class='text-secondary'>
                        <i class='fas fa-users me-1 text-dark'></i> 
                        Team: <span class='fw-semibold text-dark'>{$w->team_name}</span> - 
                        <strong class='text-primary'>{$type}</strong>
                    </h6>
                </header>

                <div class='row g-4'>
                    <div class='col-md-6'>
                        <section class='h-100 p-4 bg-primary bg-opacity-10 border-start border-4 border-primary rounded-3 shadow-sm'>
                            <h5 class='fw-bold text-primary mb-3'>
                                <i class='fas fa-tasks me-2'></i> Workload Details
                            </h5>
                            <div class='mb-3'>
                                <span class='badge rounded-pill bg-info text-dark px-3 py-2'>
                                    <i class='fas fa-info-circle me-1'></i> Status: {$status}
                                </span>
                            </div>
                            <ul class='list-unstyled mb-0'>
                                <li class='mb-2'><strong>Submodule:</strong> {$sub_mod_name}</li>
                                <li class='mb-2'><strong>Position:</strong> " . htmlspecialchars($w->add_pos ?: 'N/A') . "</li>
                                <li class='mb-2'><strong>Description:</strong> {$description}</li>
                                <li><strong>Remarks:</strong> {$workload_remarks}</li>
                            </ul>
                        </section>
                    </div>
                    <div class='col-md-6'>
                        <section class='h-100 p-4 bg-success bg-opacity-10 border-start border-4 border-success rounded-3 shadow-sm'>
                            <h5 class='fw-bold text-success mb-3'>
                                <i class='fas fa-newspaper me-2'></i> Weekly Report Update
                            </h5>
                            <div class='mb-3'>
                                <span class='badge rounded-pill bg-success px-3 py-2'>
                                    <i class='fas fa-check-circle me-1'></i> Weekly Status: {$weekly_status}
                                </span>
                            </div>
                            <ul class='list-unstyled mb-0'>
                                <li class='mb-2'><strong>Task Workload:</strong> {$task_workload}</li>
                                <li class='mb-2'><strong>Concerns:</strong> {$concerns}</li>
                                <li class='mb-2'><strong>Remarks:</strong> {$remarks}</li>
                                <li><strong>Date:</strong> {$w->date_range}</li>
                            </ul>
                        </section>
                    </div>
                </div>
                <footer class='mt-4 text-muted small d-flex justify-content-end'>
                    <i class='far fa-clock me-1'></i> Added on " . date('M d, Y', strtotime($w->date_added ?: 'now')) . "
                </footer>
            </article>";
        }
        $output_server = '<div class="row g-4">';
        foreach ($server_results as $s) {
            $output_server .= "
            <div class='col-md-4'>
                <div class='card shadow-sm border-0 rounded-3 h-100 notification-card'>
                    <div class='card-header bg-light d-flex align-items-center border-0 rounded-top-3'>
                        <i class='fas fa-server text-primary fs-4 me-2'></i>
                        <h5 class='mb-0 fw-bold text-dark flex-grow-1'>{$s->server}</h5>
                        <span class='badge bg-info text-white'>{$s->mod_abbr}</span>
                    </div>
                    <div class='card-body'>
                        <p class='mb-2'>
                            <i class='fas fa-layer-group me-2 text-secondary'></i>
                            <span class='fw-semibold text-dark'>{$s->mod_name}</span>
                        </p>
                        <p class='mb-2'>
                            <i class='fas fa-users me-2 text-primary'></i>
                            <span class='fw-semibold text-dark'>{$s->team_name}</span>
                        </p>
                        <p class='mb-2'>
                            <i class='fas fa-info-circle me-2 text-success'></i>
                            <span class='text-secondary'>{$s->details}</span>
                        </p>
                        <p class='mb-0'>
                            <i class='fas fa-map-marker-alt me-2 text-danger'></i>
                            <span class='text-secondary'>{$s->location}</span>
                        </p>
                    </div>
                </div>
            </div>";
        }
        $output_server .= '</div>';

        $output_server .= "
        <style>
            .notification-card {
                transition: all 0.25s ease-in-out;
            }
            .notification-card:hover {
                background: #f8f9fa;
                transform: translateY(-4px);
                box-shadow: 0 8px 18px rgba(0,0,0,0.12) !important;
            }
        </style>";


        $module_desc_output = '';

        foreach ($module_desc_results as $md) {
            $module_desc_output .= '
            <div class="row g-4">
                <div class="col-md-12 mb-3">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h5 class="card-title text-primary mb-2">
                                ' . htmlspecialchars($md->mod_name) . ' 
                                <small class="badge bg-info ms-2">' . htmlspecialchars($md->mod_abbr) . '</small>
                            </h5>
                            <p class="card-text text-muted" style="text-align:justify;">
                                ' . $md->module_desc . '
                            </p>
                        </div>
                    </div>
                </div>
            </div>';
        }




        $total_pages = ceil($total_results / $per_page);
        $max_links = 10;
        $pagination_html = '<nav><ul class="pagination justify-content-center mt-4">';
        $prev_page = max($page - 1, 1);
        $pagination_html .= "<li class='page-item " . ($page == 1 ? "disabled" : "") . "'>
        <a class='page-link search-page' href='#' data-page='{$prev_page}'>Previous</a></li>";
        $start = max($page - floor($max_links / 2), 1);
        $end = min($start + $max_links - 1, $total_pages);
        if ($end - $start + 1 < $max_links) {
            $start = max($end - $max_links + 1, 1);
        }
        if ($start > 1) {
            $pagination_html .= "<li class='page-item'><a class='page-link search-page' href='#' data-page='1'>1</a></li>";
            if ($start > 2) {
                $pagination_html .= "<li class='page-item disabled'><span class='page-link'>...</span></li>";
            }
        }
        for ($i = $start; $i <= $end; $i++) {
            $active = ($i == $page) ? 'active' : '';
            $pagination_html .= "<li class='page-item {$active}'><a class='page-link search-page' href='#' data-page='{$i}'>{$i}</a></li>";
        }
        if ($end < $total_pages) {
            if ($end < $total_pages - 1) {
                $pagination_html .= "<li class='page-item disabled'><span class='page-link'>...</span></li>";
            }
            $pagination_html .= "<li class='page-item'><a class='page-link search-page' href='#' data-page='{$total_pages}'>{$total_pages}</a></li>";
        }
        $next_page = min($page + 1, $total_pages);
        $pagination_html .= "<li class='page-item " . ($page == $total_pages ? "disabled" : "") . "'>
        <a class='page-link search-page' href='#' data-page='{$next_page}'>Next</a></li>";
        $pagination_html .= '</ul></nav>';

        echo json_encode([
            'status' => 'success',
            'html' => $output . $output_workloads . $output_server . $module_desc_output . $pagination_html
        ]);
    }


}
