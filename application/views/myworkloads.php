<div class="modal fade" id="concernModal" tabindex="-1" aria-labelledby="concernModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title" id="concernModalLabel">Concern Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="fs-13 text-start" id="concernModalBody"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">My List of Workloads | Tasks </h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Workload List </a></li>
                        <li class="breadcrumb-item active">Index<i class="mdi mdi-alpha-x-circle:"></i></li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="col-xl-12">
                <ul class="nav nav-pills arrow-navtabs nav-justified nav-primary" role="tablist">
                    <li class="nav-item">
                        <a id="MyWorkloads" data-bs-target="#workloads-tab" class="nav-link active" data-bs-toggle="tab">
                            <span class="d-flex align-items-center justify-content-center gap-1">
                                <span class="d-none d-sm-block">My Workloads</span>
                                <span class="badge bg-danger workloadcount" style="display: none;"></span>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a id="MyDailyTask" data-bs-target="#tasks-tab" class="nav-link" data-bs-toggle="tab">
                            <span class="d-flex align-items-center justify-content-center gap-1">
                                <span class="d-none d-sm-block">My Weekly | Daily Task</span>
                                <span class="badge bg-danger weeklycount" style="display: none;"></span>
                            </span>
                        </a>
                    </li>
                </ul>

                <hr>
                <div class="d-flex align-items-center flex-grow-1 gap-2 col-md-4 float-end">
                    <select class="form-select" id="team_filter">
                        <option value="">Select Team</option>
                    </select>

                    <select class="form-select" id="module_filter">
                        <option value=""></option>
                    </select>
                    <div class="btn-group" role="group">
                        <button type="button" id="toggle-grid" class="btn btn-soft-info shadow-none active">
                            <i class="ri-grid-fill"></i>
                        </button>
                        <button type="button" id="toggle-list" class="btn btn-soft-info shadow-none">
                            <i class="ri-list-unordered"></i>
                        </button>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="workloads-tab">
                        <ul class="nav nav-pills mt-3">
                            <li class="nav-item">
                                <a id="All" data-status="all" class="nav-link active status" data-bs-toggle="tab">
                                    <span class="d-none d-sm-block">All</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="Pending" data-status="Pending" class="nav-link status" data-bs-toggle="tab">
                                    <span class="d-none d-sm-block">Pending</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="Ongoing" data-status="Ongoing" class="nav-link status" data-bs-toggle="tab">
                                    <span class="d-none d-sm-block">Ongoing</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="Done" data-status="Done" class="nav-link status" data-bs-toggle="tab">
                                    <span class="d-none d-sm-block">Done</span>
                                </a>
                            </li>
                        </ul>
                        <hr>
                        <div class="row">
                            <div id="workload" class="mt-2"></div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="tasks-tab">
                        <ul class="nav nav-pills mt-3">
                            <li class="nav-item">
                                <a id="AllTasks" data-status="AllTasks" class="nav-link active task_stats"
                                    data-bs-toggle="tab">
                                    <span class="d-none d-sm-block">All</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="PendingTasks" data-status="PendingTasks" class="nav-link task_stats"
                                    data-bs-toggle="tab">
                                    <span class="d-none d-sm-block">Pending</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="OngoingTasks" data-status="OngoingTasks" class="nav-link task_stats"
                                    data-bs-toggle="tab">
                                    <span class="d-none d-sm-block">Ongoing</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="DoneTasks" data-status="DoneTasks" class="nav-link task_stats"
                                    data-bs-toggle="tab">
                                    <span class="d-none d-sm-block">Done</span>
                                </a>
                            </li>
                        </ul>
                        <hr>
                        <div class="row">
                            <div id="task" class="mt-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

<script>
    $(document).ready(function () {
        $('#team_filter').select2({
            placeholder: 'Select Team',
            allowClear: true,
        });

        $('#module_filter').select2({
            placeholder: 'Module Name | System',
            allowClear: true,
        });
        let currentView = 'grid';
        function loadWorkloads(status, page = 1) {
            $('#workload').html('<div class="text-center text-primary"><iconify-icon icon="svg-spinners:bars-rotate-fade" width="40" height="40"></iconify-icon></div>');
            $.ajax({
                url: '<?php echo base_url("fetch_workloads"); ?>',
                method: 'GET',
                data: {
                    status: status,
                    page: page,
                    team: $('#team_filter').val(),
                    module: $('#module_filter').val(),
                    view: currentView
                },
                success: function (response) {
                    $('#workload').html(response);
                }
            });
        }

        function loadTasks(task_stats, page = 1) {
            $('#task').html('<div class="text-center text-primary"><iconify-icon icon="svg-spinners:bars-rotate-fade" width="40" height="40"></iconify-icon></div>');
            $.ajax({
                url: '<?php echo base_url("fetch_tasks"); ?>',
                method: 'GET',
                data: {
                    task_stats: task_stats,
                    page: page,
                    team: $('#team_filter').val(),
                    module: $('#module_filter').val(),
                    view: currentView
                },
                success: function (response) {
                    $('#task').html(response);
                }
            });
        }

        function getCurrentStatus() {
            return $('.nav-link.status.active').data('status') || 'all';
        }

        function getCurrentTaskStatus() {
            return $('.nav-link.task_stats.active').data('status') || 'AllTasks';
        }

        function loadModule() {
            $.ajax({
                url: '<?php echo base_url("MyWorkloads/setup_module_dat"); ?>',
                type: 'POST',
                data: {
                    team: $('#team_filter').val()
                },
                success: function (response) {
                    const moduleData = JSON.parse(response);
                    $('#module_filter').empty().append('<option value="">Select Module Name</option>');
                    moduleData.forEach(function (module) {
                        $('#module_filter').append('<option value="' + module.mod_id + '">' + module.mod_name + '</option>');
                    });
                }
            });
        }

        $.ajax({
            url: '<?php echo base_url("MyWorkloads/get_team"); ?>',
            type: 'POST',
            success: function (response) {
                const teamData = JSON.parse(response);
                $('#team_filter').empty().append('<option value="">Select Team Name</option>');
                teamData.forEach(function (team) {
                    $('#team_filter').append('<option value="' + team.team_id + '">' + team.team_name + '</option>');
                });
            }
        });

        $('#team_filter').change(function () {
            loadModule();
        });

        $('#team_filter, #module_filter').change(function () {
            loadWorkloads(getCurrentStatus(), 1);
            loadTasks(getCurrentTaskStatus(), 1);
        });

        $('.nav-link.status').on('click', function (e) {
            e.preventDefault();
            $('.nav-link.status').removeClass('active');
            $(this).addClass('active');
            const status = $(this).data('status');
            loadWorkloads(status, 1);
        });

        $(document).on('click', '.pagination-link.workload', function (e) {
            e.preventDefault();
            const status = getCurrentStatus();
            const page = $(this).data('page');
            loadWorkloads(status, page);
        });

        $('.nav-link.task_stats').on('click', function (e) {
            e.preventDefault();
            $('.nav-link.task_stats').removeClass('active');
            $(this).addClass('active');
            const task_stats = $(this).data('status');
            loadTasks(task_stats, 1);
        });

        $(document).on('click', '.pagination-link.task', function (e) {
            e.preventDefault();
            const task_stats = $('.nav-link.task_stats.active').data('status') || 'AllTasks';
            const page = $(this).data('page');
            loadTasks(task_stats, page);
        });

        loadModule();
        loadWorkloads('all');
        loadTasks('AllTasks', 1);


        $('#toggle-grid').on('click', function () {
            currentView = 'grid';
            $('#toggle-list').removeClass('active btn-primary').addClass('btn-outline-secondary');
            $(this).removeClass('btn-outline-primary').addClass('btn-primary active');
            loadWorkloads(getCurrentStatus(), 1);
            loadTasks(getCurrentTaskStatus(), 1);
        });

        $('#toggle-list').on('click', function () {
            currentView = 'list';
            $('#toggle-grid').removeClass('active btn-primary').addClass('btn-outline-secondary');
            $(this).removeClass('btn-outline-secondary').addClass('btn-primary active');
            loadWorkloads(getCurrentStatus(), 1);
            loadTasks(getCurrentTaskStatus(), 1);
        });

    });
</script>
<script>
    document.addEventListener('shown.bs.tab', function () {
        AOS.refreshHard();
        AOS.init({
            once: false,
            duration: 500
        });
    });



</script>