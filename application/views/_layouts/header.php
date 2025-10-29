<?php
$page = basename($_SERVER['REQUEST_URI']);
?>
<!doctype html>
<?php
$emp_id = $this->session->userdata('emp_id');
$position = $this->session->userdata('position');
$month = date('m');
$today = date('Y-m-d');
$year = date('Y');

// Define seasonal date ranges
$horror_start = $year . '-10-15';
$horror_end   = $year . '-11-04';

// Default sidebar image
$sidebar_image = 'img-2';

// Apply seasonal themes
if ($today >= $horror_start && $today <= $horror_end) {
    $sidebar_image = 'halloween';
} elseif ($month === '12') {
    $sidebar_image = 'christmas';
} elseif ($month === '02') {
    $sidebar_image = 'lovely';
} else {
    $sidebar_image = 'img-2';
}
// Determine layout type
if ($position == 'Programmer' && $emp_id != '03553-2013' && $emp_id != '03399-2013') {
    // Horizontal layout for specific programmers
    echo '<html lang="en"  data-layout="horizontal" data-topbar="dark" data-sidebar="dark" data-sidebar-size="lg" data-bs-theme="light" data-sidebar-image="' . $sidebar_image . '" data-preloader="disable" data-layout-width="fluid" data-layout-position="fixed" data-layout-style="horizontal" data-sidebar-visibility="show">';
} else {
    // Vertical layout for everyone else
    echo '<html lang="en" data-layout="vertical" data-topbar="dark" data-sidebar="dark" data-sidebar-size="lg" data-bs-theme="light" data-sidebar-image="' . $sidebar_image . '" data-preloader="disable" data-layout-width="fluid" data-layout-position="fixed" data-layout-style="vertical" data-sidebar-visibility="show">';
}
?>


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8" />
    <title>Corporate IT Sysdev</title>
    <link rel="shortcut icon" href="assets/images/it.jpg" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Layout config Js -->
    <script src="<?php echo base_url(); ?>assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?php echo base_url(); ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/css/select2.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?php echo base_url(); ?>assets/css/datatable.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo base_url(); ?>assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/css/buttons.css" rel="stylesheet" type="text/css" />

    <!-- custom Css-->
    <link href="<?php echo base_url(); ?>assets/css/custom.min.css" rel="stylesheet" type="text/css" />

    <script src="<?php echo base_url(); ?>assets/js/iconify.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery3.6.0.js"></script>

    <!-- <script src="<?php echo base_url(); ?>assets/js/responsive.js"></script> -->

    <link href="<?php echo base_url(); ?>assets/jquery-ui.min.css" rel="stylesheet" type="text/css">
    <script src="<?php echo base_url(); ?>assets/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/jquery-ui.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/datatable2.1.8.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/datatable/buttons.css">
    <script src="<?php echo base_url(); ?>assets/js/datatable/buttons.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/datatable/buttons5.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/datatable/jszip.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/datatable/pdfmake.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/datatable/vfsfonts.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/datatable/html5.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/datatable/colvis.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/datatable/responsive.js"></script>
    <link href="<?php echo base_url(); ?>assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dropzone.css" type="text/css" />

    <!-- Filepond css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/filepond.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/filepond-image-preview.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/flatpickr.css">
    <script src="<?php echo base_url(); ?>assets/js/flatpickr.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/fullcalendar.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/toastify.css">
    <script src="<?php echo base_url(); ?>assets/js/toastify.js"></script>

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/toastr.css">
    <!-- Toastr JS -->
    <script src="<?php echo base_url(); ?>assets/js/toastr.js"></script>


    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/libs/glightbox/css/glightbox.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/libs/aos/aos.css" />
    <script src="<?php echo base_url(); ?>assets/libs/glightbox/js/glightbox.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/libs/isotope-layout/isotope.pkgd.min.js"></script>

</head>

<body>
    
    <!-- Begin page -->
    <div id="layout-wrapper">
        <header id="page-topbar" style="border-bottom: 5px solid rgb(255, 190, 11,1)">
            <div class="layout-width">
                <div class="navbar-header">
                    <div class="d-flex">
                        <button type="button"
                            class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger shadow-none"
                            id="topnav-hamburger-icon">
                            <span class="hamburger-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </button>
                        <div class="navbar-brand-box horizontal-logo">
                            <a href="<?php echo base_url('dashboard'); ?>" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="http://172.16.161.34:8080/hrms/<?= $this->session->userdata('photo'); ?>"
                                        height="20" class="rounded-circle avatar-sm" />
                                </span>
                                <span class="logo-lg">
                                    <img src="assets/images/auth.png" alt="" style="  height: 70px; width: 150px" />
                                </span>
                            </a>
                        </div>
                    </div>
                    <div id="birthday-marquee" class="header-marquee"></div>
                    <div class="d-flex align-items-center">
                        <div class="dropdown topbar-head-dropdown ms-1 header-item">
                            <button type="button"
                                class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shadow-none"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class='bx bx-category-alt fs-22'></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg p-0 dropdown-menu-end">
                                <div class="p-3 border-top-0 border-start-0 border-end-0 border-dashed border">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0 fw-semibold fs-15"> TEAM GALLERY </h6>
                                        </div>
                                        <div class="col-auto">
                                            <a href="<?php echo base_url('team_events'); ?>"
                                                class="btn btn-sm btn-soft-info shadow-none"> View All Image Files
                                                <i class="ri-arrow-right-s-line align-middle"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ms-1 header-item d-none d-sm-flex">
                            <button type="button"
                                class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shadow-none"
                                data-toggle="fullscreen">
                                <i class='bx bx-fullscreen fs-22'></i>
                            </button>
                        </div>
                        <div class="ms-1 header-item d-none d-sm-flex">
                            <button type="button"
                                class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode shadow-none">
                                <i class='bx bx-moon fs-22'></i>
                            </button>
                        </div>

                        <?php if ($this->session->userdata('is_supervisor') == 'Yes' || $this->session->userdata('emp_id') == '01022-2014') { ?>
                            <div class="dropdown topbar-head-dropdown ms-1 header-item" id="notificationDropdown">
                                <button type="button"
                                    class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shadow-none  bell"
                                    id="page-header-notifications-dropdown" data-bs-toggle="dropdown"
                                    data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                                    <iconify-icon icon="line-md:bell-filled-loop" class="fs-22"></iconify-icon><span
                                        class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger allcount">0</span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                    aria-labelledby="page-header-notifications-dropdown">

                                    <div class="dropdown-head bg-secondary bg-pattern rounded-top">
                                        <div class="p-3">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h6 class="m-0 fs-16 fw-semibold text-white"> Notifications </h6>
                                                </div>
                                                <div class="col-auto dropdown-tabs">
                                                    <span class="badge bg-light-subtle text-body fs-13 allcount"> </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="px-2 pt-2">
                                            <ul class="nav nav-tabs dropdown-tabs nav-tabs-custom" data-dropdown-tabs="true"
                                                id="notificationItemsTab" role="tablist">
                                                <li class="nav-item waves-effect waves-light">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#all-noti-tab"
                                                        role="tab" aria-selected="true"> Requests <span
                                                            class="badge badge-pill bg-danger rcount"
                                                            style="display: none;"></span>
                                                    </a>
                                                </li>
                                                <li class="nav-item waves-effect waves-light">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#module-approval"
                                                        role="tab" aria-selected="true"> Module Approval <span
                                                            class="badge badge-pill bg-danger mcount"
                                                            style="display: none;"></span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="tab-content position-relative">
                                        <div class="tab-pane fade show active py-2 ps-2" id="all-noti-tab" role="tabpanel"
                                            data-simplebar="" style="max-height: 400px;">
                                            <div class="pe-2"></div>
                                            <div class="my-3 text-center view-all">
                                                <a href="<?php echo base_url(); ?>request" type="button"
                                                    class="btn btn-soft-success waves-effect waves-light">View Requests
                                                    <i class="ri-arrow-right-line align-middle"></i></a>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade show py-2 ps-2" id="module-approval" role="tabpanel"
                                            data-simplebar="" style="max-height: 400px;">
                                            <div class="pe-2"></div>
                                            <div class="my-3 text-center view-all">
                                                <a href="<?php echo base_url(); ?>admin_module_view" type="button"
                                                    class="btn btn-soft-success waves-effect waves-light">View Module
                                                    Approval
                                                    <i class="ri-arrow-right-line align-middle"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if ($this->session->userdata('position') == 'Programmer') { ?>
                            <div class="dropdown topbar-head-dropdown ms-1 header-item" id="notificationDropdown">
                                <button type="button"
                                    class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shadow-none"
                                    data-bs-toggle="dropdown"
                                    data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                                    <iconify-icon icon="streamline-plump:task-list-edit-remix" class="fs-22"></iconify-icon><span
                                        class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger all_workload_count">0</span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                    aria-labelledby="page-header-notifications-dropdown">

                                    <div class="dropdown-head bg-secondary bg-pattern rounded-top">
                                        <div class="p-3">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h6 class="m-0 fs-16 fw-semibold text-white"> Notifications </h6>
                                                </div>
                                                <div class="col-auto dropdown-tabs">
                                                    <span class="badge bg-light-subtle text-body fs-13 all_workload_count"> </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="px-2 pt-2">
                                            <ul class="nav nav-tabs dropdown-tabs nav-tabs-custom" data-dropdown-tabs="true"
                                                id="notificationItemsTab" role="tablist">
                                                <li class="nav-item waves-effect waves-light">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#all-noti-tab"
                                                        role="tab" aria-selected="true"> Workloads 
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="tab-content position-relative">
                                        <div class="tab-pane fade show active py-2 ps-2" id="all-noti-tab" role="tabpanel"
                                            data-simplebar="" style="max-height: 400px;">
                                            <div class="pe-2"></div>
                                            <div class="my-3 text-center view-all">
                                                <a href="<?php echo base_url(); ?>my_workloads" type="button"
                                                    class="btn btn-soft-success waves-effect waves-light">View Workload | Tasks
                                                    <i class="ri-arrow-right-line align-middle"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="dropdown topbar-head-dropdown ms-1 header-item" id="notificationDropdown">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shadow-none" id="messages" data-bs-toggle="modal" data-bs-target="#chat_modal" aria-haspopup="true" aria-expanded="false">
                            <!-- <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shadow-none" id="messages" aria-haspopup="true" aria-expanded="false" onclick="warnUnencryptedChats()"> -->
                                <iconify-icon icon="line-md:chat-round-dots-twotone" class='fs-25'></iconify-icon><span class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger unseen-badge" id="total-unseen-count"></span>
                            </button>
                        </div>

                        <div class="ms-1 header-item d-none d-sm-flex">
                            <a href="<?php echo base_url('aboutus'); ?>" type="button"
                                class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode shadow-none">
                                <iconify-icon icon="carbon:dns-services" class="fs-23"></iconify-icon>
                            </a>
                        </div>

                        <div class="dropdown ms-sm-3 header-item topbar-user">
                            <button type="button" class="btn shadow-none" id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                style="width: 280px">
                                <span class="d-flex align-items-center">
                                    <img class="rounded-circle header-profile-user avatar-sm"
                                        src="http://172.16.161.34:8080/hrms/<?= $this->session->userdata('photo'); ?>"
                                        alt="Header Avatar" />
                                    <span class="text-start ms-xl-2">
                                        <span
                                            class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"><?php echo ucwords(strtolower($this->session->userdata('name'))) ?></span>
                                        <span class="d-none d-xl-block ms-1 fs-11 user-name-sub-text fw-bold"><i><?php echo $this->session->userdata('emp_id'); ?>
                                                - <?php echo $this->session->userdata('hrms_position'); ?></i></span>
                                    </span>
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                            <h6 class="dropdown-header">
                                Welcome <?php echo ucwords(strtolower($this->session->userdata('name'))) ?>!
                            </h6>

                            <a class="dropdown-item" href="<?php echo base_url('profile'); ?>">
                                <i class="mdi mdi-account-circle text-muted fs-12 align-middle me-1"></i>
                                <span class="align-middle fs-10">Profile</span>
                            </a>

                            <a class="dropdown-item d-flex align-items-center" 
                                href="javascript:void(0);" 
                                data-bs-toggle="modal" 
                                data-bs-target="#chat_modal">
                                <i class="mdi mdi-message text-muted fs-12 align-middle me-2"></i>
                                <span class="align-middle me-1 fs-10">Message</span>
                                <span class="badge bg-danger rounded-pill unseen-badge" id="total-unseen-count2"></span>
                            </a>

                            <a class="dropdown-item" href="<?php echo base_url(); ?>logout">
                                <i class="mdi mdi-logout-variant text-muted fs-12 align-middle me-1"></i>
                                <span class="align-middle fs-10" data-key="t-logout">Logout</span>
                            </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="app-menu navbar-menu">
            <div class="navbar-brand-box">
                <a href="<?php echo base_url('dashboard'); ?>" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="http://172.16.161.34:8080/hrms/<?= $this->session->userdata('photo'); ?>" height="20"
                            class="rounded-circle avatar-sm" />
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/auth.png" alt="" style=" height: 70px; width: 150px" />
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                    id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>
            <div id="scrollbar">
                <div class="container-fluid">
                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">HOME</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link <?php echo ($page == 'dashboard') ? 'active' : ''; ?>"
                                href="<?php echo base_url('dashboard'); ?>">
                                <iconify-icon icon="solar:widget-2-bold-duotone"
                                    class="fs-25"></iconify-icon>&nbsp;&nbsp;&nbsp;&nbsp; <span class="fs-12">Dashboard
                                </span>
                            </a>
                        </li>

                        <?php
                        if ($this->session->userdata('is_admin') == 'Yes') {
                            ?>
                            <li class="nav-item">
                                <a class="nav-link menu-link <?php echo in_array($page, ['kpi_view', 'add_user_view', 'company_phone_view', 'setup_rules_regulation_view']) ? 'active' : ''; ?>"
                                    href="#sidebarLayouts" data-bs-toggle="collapse" role="button"
                                    aria-expanded="<?php echo in_array($page, ['kpi_view', 'add_user_view', 'company_phone_view', 'setup_rules_regulation_view']) ? 'true' : 'false'; ?>"
                                    aria-controls="sidebarLayouts">
                                    <iconify-icon icon="solar:shield-bold-duotone"
                                        class="fs-25"></iconify-icon>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span class="fs-12">Admin Setup</span>
                                </a>
                                <div class="collapse menu-dropdown <?php echo in_array($page, ['kpi_view', 'add_user_view', 'company_phone_view', 'setup_rules_regulation_view']) ? 'show' : ''; ?>"
                                    id="sidebarLayouts">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="<?php echo base_url('kpi_view'); ?>"
                                                class="nav-link fs-11 <?php echo ($page == 'kpi_view') ? 'active' : ''; ?>">
                                                &nbsp;&nbsp;&nbsp;&nbsp;KPI Setup</a>
                                            <!-- <a href="<?php echo base_url('admin_module_view'); ?>" class="nav-link fs-11 <?php echo ($page == 'admin_module_view') ? 'active' : ''; ?>"> &nbsp;&nbsp;&nbsp;&nbsp;Approve Module</a> -->
                                            <!-- <a href="<?php echo base_url('request'); ?>" class="nav-link fs-11 <?php echo ($page == 'request') ? 'active' : ''; ?>"> &nbsp;&nbsp;&nbsp;&nbsp;Request Approval</a> -->
                                            <a href="<?php echo base_url('add_user_view'); ?>"
                                                class="nav-link fs-11 <?php echo ($page == 'add_user_view') ? 'active' : ''; ?>">
                                                &nbsp;&nbsp;&nbsp;&nbsp;Add Team Member</a>
                                            <a href="<?php echo base_url('company_phone_view'); ?>"
                                                class="nav-link fs-11 <?php echo ($page == 'company_phone_view') ? 'active' : ''; ?>">
                                                &nbsp;&nbsp;&nbsp;&nbsp;Company Phone | Team Setup</a>
                                            <a href="<?php echo base_url('setup_rules_regulation_view'); ?>"
                                                class="nav-link fs-11 <?php echo ($page == 'setup_rules_regulation_view') ? 'active' : ''; ?>">
                                                &nbsp;&nbsp;&nbsp;&nbsp;Setup Rules | Regulation</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <?php
                        }
                        ?>

                        <?php
                        if ($this->session->userdata('is_supervisor') == 'Yes') {
                            ?>
                            <li class="nav-item">
                                <a class="nav-link menu-link <?php echo in_array($page, ['request', 'admin_module_view', 'confidential', 'index']) ? 'active' : ''; ?>"
                                    href="#supervisoryAccount" data-bs-toggle="collapse" role="button"
                                    aria-expanded="<?php echo in_array($page, ['request', 'admin_module_view', 'confidential', 'index']) ? 'true' : 'false'; ?>"
                                    aria-controls="supervisoryAccount">
                                    <iconify-icon icon="ic:twotone-supervised-user-circle"
                                        class="fs-25"></iconify-icon>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span class="fs-12">Supervisory Account</span><span
                                        class="badge badge-pill bg-danger new_alert" style="display: none;">New</span>
                                </a>
                                <div class="collapse menu-dropdown <?php echo in_array($page, ['request', 'admin_module_view', 'confidential', 'index']) ? 'show' : ''; ?>"
                                    id="supervisoryAccount">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="<?php echo base_url('admin_module_view'); ?>"
                                                class="nav-link fs-11 <?php echo ($page == 'admin_module_view') ? 'active' : ''; ?>">
                                                &nbsp;&nbsp;&nbsp;&nbsp;Module Approval <span
                                                    class="badge badge-pill bg-danger mcount"
                                                    style="display: none;"></span></a>
                                            <a href="<?php echo base_url('request'); ?>"
                                                class="nav-link fs-11 <?php echo ($page == 'request') ? 'active' : ''; ?>">
                                                &nbsp;&nbsp;&nbsp;&nbsp;Request Approval <span
                                                    class="badge badge-pill bg-danger rcount"
                                                    style="display: none;"></span></a>
                                            <a href="<?php echo base_url('confidential'); ?>"
                                                class="nav-link fs-11 <?php echo ($page == 'confidential') ? 'active' : ''; ?>">
                                                &nbsp;&nbsp;&nbsp;&nbsp;Confidential Files</a>
                                            <a href="<?php echo base_url('index'); ?>"
                                                class="nav-link fs-11 <?php echo ($page == 'index') ? 'active' : ''; ?>">
                                                &nbsp;&nbsp;&nbsp;&nbsp;Quick Search</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <?php
                        }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link menu-link <?php echo ($page == 'structure') ? 'active' : ''; ?>"
                                href="<?php echo base_url('structure'); ?>">
                                <iconify-icon icon="solar:layers-bold-duotone"
                                    class="fs-25"></iconify-icon>&nbsp;&nbsp;&nbsp;&nbsp; <span
                                    class="fs-12">Organization Structure </span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link <?php echo ($page == 'rules_view') ? 'active' : ''; ?>"
                                href="<?php echo base_url('rules_view'); ?>">
                                <iconify-icon icon="solar:shield-warning-bold-duotone"
                                    class="fs-25"></iconify-icon>&nbsp;&nbsp;&nbsp;&nbsp; <span class="fs-12">Rules |
                                    Regulations </span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link <?php echo ($page == 'kpi') ? 'active' : ''; ?>"
                                href="<?php echo base_url('kpi'); ?>">
                                <iconify-icon icon="solar:notebook-bold-duotone"
                                    class="fs-25"></iconify-icon>&nbsp;&nbsp;&nbsp;&nbsp; <span class="fs-12">Key
                                    Personnel Indicator </span>
                            </a>
                        </li>

                        <?php
                        $position = $this->session->userdata('position');

                        if ($position == 'System Analyst') { ?>
                            <li class="menu-title"><span data-key="t-menu">SYSTEM ANALYST MENU </span></li>
                            <?php
                        } else if ($position == 'Programmer') { ?>
                                <li class="menu-title"><span data-key="t-menu">PROGRAMMER MENU </span></li>
                            <?php
                        } else if ($position == 'RMS') { ?>
                                    <li class="menu-title"><span data-key="t-menu">RMS MENU </span></li>
                            <?php
                        } else { ?>
                                    <li class="menu-title"><span data-key="t-menu">MANAGERIAL MENU </span></li>
                        <?php } ?>


                        <li class="nav-item">
                            <a class="nav-link menu-link <?php echo ($page == 'server_address') ? 'active' : ''; ?>"
                                href="<?php echo base_url('server_address'); ?>">
                                <iconify-icon icon="solar:server-path-line-duotone"
                                    class="fs-25"></iconify-icon>&nbsp;&nbsp;&nbsp;&nbsp; <span class="fs-12">System
                                    Server Address </span>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link menu-link <?php echo ($page == 'member_view') ? 'active' : ''; ?>"
                                href="<?php echo base_url('member_view'); ?>">
                                <iconify-icon icon="file-icons:microsoft-access"
                                    class="fs-25"></iconify-icon>&nbsp;&nbsp;&nbsp;&nbsp; <span class="fs-12">Member
                                </span>
                            </a>
                        </li>

                        <?php
                        if ($this->session->userdata('position') == 'System Analyst' || $this->session->userdata('position') == 'RMS') {
                            ?>
                            <li class="nav-item">
                                <a class="nav-link menu-link <?php echo ($page == 'module_view') ? 'active' : ''; ?>"
                                    href="<?php echo base_url('module_view'); ?>">
                                    <iconify-icon icon="pepicons-print:list-circle-filled"
                                        class="fs-25"></iconify-icon>&nbsp;&nbsp;&nbsp;&nbsp; <span class="fs-12">Add Module
                                        | System </span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menu-link <?php echo ($page == 'it_responsibilities') ? 'active' : ''; ?>"
                                    href="<?php echo base_url('it_responsibilities'); ?>">
                                    <iconify-icon icon="solar:bug-bold-duotone"
                                        class="fs-25"></iconify-icon>&nbsp;&nbsp;&nbsp;&nbsp; <span class="fs-12">IT
                                        Responsibilities | Workload </span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menu-link <?php echo ($page == 'weekly_view') ? 'active' : ''; ?>"
                                    href="<?php echo base_url('weekly_view'); ?>">
                                    <iconify-icon icon="solar:folder-path-connect-bold-duotone"
                                        class="fs-25"></iconify-icon>&nbsp;&nbsp;&nbsp;&nbsp; <span class="fs-12">Weekly |
                                        DailyReport </span>
                                </a>
                            </li>

                            <li class="nav-item">

                                <a class="nav-link menu-link <?php echo in_array($page, ['existing_sys', 'new_sys']) ? 'active' : ''; ?>"
                                    href="#sidebarLayouts2" data-bs-toggle="collapse" role="button"
                                    aria-expanded="<?php echo in_array($page, ['existing_sys']) ? 'true' : 'false'; ?>"
                                    aria-controls="sidebarLayouts">
                                    <iconify-icon icon="solar:cpu-bolt-bold-duotone"
                                        class="fs-25"></iconify-icon>&nbsp;&nbsp;&nbsp;&nbsp; <span class="fs-12">Current |
                                        New System </span>
                                </a>

                                <div class="collapse menu-dropdown <?php echo in_array($page, ['existing_sys', 'new_sys']) ? 'show' : ''; ?>"
                                    id="sidebarLayouts2">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="<?php echo base_url('existing_sys'); ?>"
                                                class="nav-link fs-11 <?php echo ($page == 'existing_sys') ? 'active' : ''; ?>">
                                                &nbsp;&nbsp;&nbsp;&nbsp;Current System | Module</a>
                                            <a href="<?php echo base_url('new_sys'); ?>"
                                                class="nav-link fs-11 <?php echo ($page == 'new_sys') ? 'active' : ''; ?>">
                                                &nbsp;&nbsp;&nbsp;&nbsp;New System | Module</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link menu-link <?php echo ($page == 'deployment_view') ? 'active' : ''; ?>"
                                    href="<?php echo base_url('deployment_view'); ?>">
                                    <iconify-icon icon="solar:folder-check-bold-duotone"
                                        class="fs-25"></iconify-icon>&nbsp;&nbsp;&nbsp;&nbsp; <span class="fs-12">Deployment
                                        System </span>
                                </a>
                            </li>

                            <?php
                        }
                        ?>



                        <?php
                        if ($this->session->userdata('position') == 'Programmer' && $this->session->userdata('emp_id') == '03553-2013' || $this->session->userdata('emp_id') == '03399-2013') {
                            ?>
                            <li class="nav-item">
                                <a class="nav-link menu-link <?php echo ($page == 'module_view') ? 'active' : ''; ?>"
                                    href="<?php echo base_url('module_view'); ?>">
                                    <iconify-icon icon="pepicons-print:list-circle-filled"
                                        class="fs-25"></iconify-icon>&nbsp;&nbsp;&nbsp;&nbsp; <span class="fs-12">Add Module
                                        | System </span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menu-link <?php echo ($page == 'it_responsibilities') ? 'active' : ''; ?>"
                                    href="<?php echo base_url('it_responsibilities'); ?>">
                                    <iconify-icon icon="solar:bug-bold-duotone"
                                        class="fs-25"></iconify-icon>&nbsp;&nbsp;&nbsp;&nbsp; <span class="fs-12">IT
                                        Responsibilities | Workload </span>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link menu-link <?php echo ($page == 'weekly_view') ? 'active' : ''; ?>"
                                    href="<?php echo base_url('weekly_view'); ?>">
                                    <iconify-icon icon="solar:folder-path-connect-bold-duotone"
                                        class="fs-25"></iconify-icon>&nbsp;&nbsp;&nbsp;&nbsp; <span class="fs-12">Weekly |
                                        DailyReport </span>
                                </a>
                            </li>


                            <li class="nav-item">

                                <a class="nav-link menu-link <?php echo in_array($page, ['existing_sys', 'new_sys']) ? 'active' : ''; ?>"
                                    href="#sidebarLayouts2" data-bs-toggle="collapse" role="button"
                                    aria-expanded="<?php echo in_array($page, ['existing_sys']) ? 'true' : 'false'; ?>"
                                    aria-controls="sidebarLayouts">
                                    <iconify-icon icon="solar:cpu-bolt-bold-duotone"
                                        class="fs-25"></iconify-icon>&nbsp;&nbsp;&nbsp;&nbsp; <span class="fs-12">Current |
                                        New System </span>
                                </a>

                                <div class="collapse menu-dropdown <?php echo in_array($page, ['existing_sys', 'new_sys']) ? 'show' : ''; ?>"
                                    id="sidebarLayouts2">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="<?php echo base_url('existing_sys'); ?>"
                                                class="nav-link fs-11 <?php echo ($page == 'existing_sys') ? 'active' : ''; ?>">
                                                &nbsp;&nbsp;&nbsp;&nbsp;Current System | Module</a>
                                            <a href="<?php echo base_url('new_sys'); ?>"
                                                class="nav-link fs-11 <?php echo ($page == 'new_sys') ? 'active' : ''; ?>">
                                                &nbsp;&nbsp;&nbsp;&nbsp;New System | Module</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link menu-link <?php echo ($page == 'deployment_view') ? 'active' : ''; ?>"
                                    href="<?php echo base_url('deployment_view'); ?>">
                                    <iconify-icon icon="solar:folder-check-bold-duotone"
                                        class="fs-25"></iconify-icon>&nbsp;&nbsp;&nbsp;&nbsp; <span class="fs-12">Deployment
                                        System </span>
                                </a>
                            </li>

                            <?php
                        }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link menu-link <?php echo ($page == 'gantt_view') ? 'active' : ''; ?>"
                                href="<?php echo base_url('gantt_view'); ?>">
                                <iconify-icon icon="solar:align-bottom-bold-duotone"
                                    class="fs-25"></iconify-icon>&nbsp;&nbsp;&nbsp;&nbsp; <span class="fs-12">Gantt
                                    Chart </span>
                            </a>
                        </li>

                        <!-- <li class="nav-item">
                                <a class="nav-link menu-link <?php echo ($page == 'setup_location_view') ? 'active' : ''; ?>"
                                    href="<?php echo base_url('setup_location_view'); ?>">
                                    <iconify-icon icon="solar:map-point-wave-bold-duotone"
                                        class="fs-25"></iconify-icon>&nbsp;&nbsp;&nbsp;&nbsp; <span class="fs-12">Setup
                                        Location </span>
                                </a>
                            </li> -->



                        <?php
                        if ($this->session->userdata('position') == 'System Analyst' || $this->session->userdata('position') == 'RMS') {
                            ?>

                            <!-- <li class="nav-item">
                                <a class="nav-link menu-link <?php echo ($page == 'it_task_view') ? 'active' : ''; ?>"
                                    href="<?php echo base_url('it_task_view'); ?>">
                                    <iconify-icon icon="solar:bill-bold-duotone"
                                        class="fs-25"></iconify-icon>&nbsp;&nbsp;&nbsp;&nbsp; <span class="fs-12">IT
                                        Daily Task </span>
                                </a>
                            </li> -->



                            <li class="nav-item">
                                <a class="nav-link menu-link <?php echo ($page == 'meeting_schedule') ? 'active' : ''; ?>"
                                    href="<?php echo base_url('meeting_schedule'); ?>">
                                    <iconify-icon icon="solar:checklist-minimalistic-bold-duotone"
                                        class="fs-25"></iconify-icon>&nbsp;&nbsp;&nbsp;&nbsp; <span class="fs-12">Meeting
                                        Scheduled </span>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link menu-link <?php echo ($page == 'training_view') ? 'active' : ''; ?>"
                                    href="<?php echo base_url('training_view'); ?>">
                                    <iconify-icon icon="fluent:task-list-square-settings-20-filled"
                                        class="fs-25"></iconify-icon>&nbsp;&nbsp;&nbsp;&nbsp; <span class="fs-12">Training |
                                        Fieldwork </span>
                                </a>
                            </li>

                            <?php
                        }
                        ?>

                        <?php
                        if ($this->session->userdata('position') != 'Manager') {
                            ?>
                            <li class="nav-item">
                                <a class="nav-link menu-link <?php echo ($page == 'my_workloads') ? 'active' : ''; ?>"
                                    href="<?php echo base_url('my_workloads'); ?>">
                                    <iconify-icon icon="solar:clipboard-list-bold-duotone"
                                        class="fs-25"></iconify-icon>&nbsp;&nbsp;&nbsp;&nbsp; <span class="fs-12">My
                                        Workloads | Tasks </span>
                                </a>
                            </li>

                            <?php
                        }
                        ?>

                        <?php
                        if ($this->session->userdata('is_admin') == 'Yes' || $this->session->userdata('emp_id') == '02483-2023') {
                            ?>
                            <li class="nav-item">
                                <a class="nav-link menu-link <?php echo ($page == 'logs') ? 'active' : ''; ?>"
                                    href="<?php echo base_url('logs'); ?>">
                                    <iconify-icon icon="solar:database-bold-duotone"
                                        class="fs-25"></iconify-icon>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <span class="fs-12"> Activity Logs</span>
                                </a>
                            </li>
                            <?php
                        }
                        ?>




                        <!-- <li class="nav-item">
                                <a class="nav-link menu-link <?php echo ($page == 'aboutus') ? 'active' : ''; ?>"
                                    href="<?php echo base_url('aboutus'); ?>">
                                    <iconify-icon icon="mdi:about"
                                        class="fs-25"></iconify-icon>&nbsp;&nbsp;&nbsp;&nbsp; <span class="fs-12">About us
                                    </span>
                                </a>
                            </li> -->



                        <!-- <li class="nav-item">
                                <a class="nav-link menu-link <?php echo ($page == 'faq_view') ? 'active' : ''; ?>"
                                    href="<?php echo base_url('chat'); ?>">
                                    <iconify-icon icon="fluent-color:chat-multiple-16"
                                        class="fs-25"></iconify-icon>&nbsp;&nbsp;&nbsp;&nbsp; <span class="fs-12">Chat
                                    </span>
                                </a>
                            </li> -->


                        <!-- Managerial Access -->
                        <?php
                        if ($this->session->userdata('position') == 'Manager') { ?>

                            <li class="nav-item">
                                <a class="nav-link menu-link <?php echo ($page == 'module_view') ? 'active' : ''; ?>"
                                    href="<?php echo base_url('module_view'); ?>">
                                    <iconify-icon icon="pepicons-print:list-circle-filled"
                                        class="fs-25"></iconify-icon>&nbsp;&nbsp;&nbsp;&nbsp; <span class="fs-12"> Modules |
                                        System </span>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link menu-link <?php echo ($page == 'gantt_view') ? 'active' : ''; ?>"
                                    href="<?php echo base_url('gantt_view'); ?>">
                                    <iconify-icon icon="solar:align-bottom-bold-duotone"
                                        class="fs-25"></iconify-icon>&nbsp;&nbsp;&nbsp;&nbsp; <span class="fs-12">Gantt
                                        Chart </span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link menu-link <?php echo ($page == 'deployment_view') ? 'active' : ''; ?>"
                                    href="<?php echo base_url('deployment_view'); ?>">
                                    <iconify-icon icon="solar:folder-check-bold-duotone"
                                        class="fs-25"></iconify-icon>&nbsp;&nbsp;&nbsp;&nbsp; <span class="fs-12">Deployment
                                    </span>
                                </a>
                            </li>

                            <!-- <li class="nav-item">
                                <a class="nav-link menu-link <?php echo ($page == 'setup_location_view') ? 'active' : ''; ?>"
                                    href="<?php echo base_url('setup_location_view'); ?>">
                                    <iconify-icon icon="solar:map-point-wave-bold-duotone"
                                        class="fs-25"></iconify-icon>&nbsp;&nbsp;&nbsp;&nbsp; <span class="fs-12">Setup
                                        Location </span>
                                </a>
                            </li> -->

                            <li class="nav-item">
                                <a class="nav-link menu-link <?php echo ($page == 'it_responsibilities') ? 'active' : ''; ?>"
                                    href="<?php echo base_url('it_responsibilities'); ?>">
                                    <iconify-icon icon="solar:bug-bold-duotone"
                                        class="fs-25"></iconify-icon>&nbsp;&nbsp;&nbsp;&nbsp; <span class="fs-12">IT
                                        Responsibilities | Workload </span>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link menu-link <?php echo in_array($page, ['existing_sys', 'new_sys']) ? 'active' : ''; ?>"
                                    href="#sidebarLayouts2" data-bs-toggle="collapse" role="button"
                                    aria-expanded="<?php echo in_array($page, ['existing_sys']) ? 'true' : 'false'; ?>"
                                    aria-controls="sidebarLayouts">
                                    <iconify-icon icon="solar:cpu-bolt-bold-duotone"
                                        class="fs-25"></iconify-icon>&nbsp;&nbsp;&nbsp;&nbsp; <span class="fs-12">Current |
                                        New System </span>
                                </a>

                                <div class="collapse menu-dropdown <?php echo in_array($page, ['existing_sys', 'new_sys']) ? 'show' : ''; ?>"
                                    id="sidebarLayouts2">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="<?php echo base_url('existing_sys'); ?>"
                                                class="nav-link fs-11 <?php echo ($page == 'existing_sys') ? 'active' : ''; ?>">
                                                &nbsp;&nbsp;&nbsp;&nbsp;Current System | Module</a>
                                            <a href="<?php echo base_url('new_sys'); ?>"
                                                class="nav-link fs-11 <?php echo ($page == 'new_sys') ? 'active' : ''; ?>">
                                                &nbsp;&nbsp;&nbsp;&nbsp;New System | Module</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <?php
                        }
                        ?>


                        <li class="nav-item">
                            <a class="nav-link menu-link <?php echo ($page == 'team_view') ? 'active' : ''; ?>"
                                href="<?php echo base_url('team_view'); ?>">
                                <iconify-icon icon="streamline-logos:microsoft-teams-logo-solid"
                                    class="fs-25"></iconify-icon>&nbsp;&nbsp;&nbsp;&nbsp; <span class="fs-12">Team
                                </span><span class="badge badge-pill bg-danger">New</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link <?php echo ($page == 'faq_view') ? 'active' : ''; ?>"
                                href="<?php echo base_url('faq_view'); ?>">
                                <iconify-icon icon="solar:question-square-bold-duotone"
                                    class="fs-25"></iconify-icon>&nbsp;&nbsp;&nbsp;&nbsp; <span class="fs-12">FAQ
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
            <div class="sidebar-background"></div>
        </div>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <!-- <div class="page-content" style="background: url(<?php echo base_url(); ?>assets/images/b.jpg); background-size: cover; background-repeat: no-repeat; background-attachment: fixed;"> -->
            <div class="page-content">
                