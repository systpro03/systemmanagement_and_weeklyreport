<div class="modal fade" id="add_system_gantt" tabindex="-1" aria-labelledby="add_system_gantt" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" style="width: 655px">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title">GANTT | SETUP SYSTEM</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <label for="team_name" class="col-sm-3 col-form-label">Team:</label>
                    <input type="hidden" id="emp_id" class="form-control hidden">
                    <div class="col-sm-9">
                        <select class="form-select mb-3" id="team">
                            <option></option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="team_name" class="col-sm-3 col-form-label">Incharge:</label>
                    <div class="col-sm-9">
                        <select class="form-select mb-3" id="incharge">
                            <option></option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="name" class="col-sm-3 col-form-label">System | Module:</label>
                    <div class="col-sm-9">
                        <select class="form-select mb-3" id="module">
                            <option></option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="name" class="col-sm-3 col-form-label">Sub | Module:</label>
                    <div class="col-sm-9">
                        <select class="form-select mb-3" id="sub_module">
                            <option></option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="name" class="col-sm-3 col-form-label">Description:</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="description" style="height: 70px"
                            placeholder="Description"></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Date Request:</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" id="date_request" class="form-control" placeholder="Select Date Request"
                                data-provider="flatpickr" data-date-format="F j, Y" />
                            <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Date Implementation:</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" id="date_implementation" class="form-control"
                                placeholder="Select Date Implementation" data-provider="flatpickr"
                                data-date-format="F j, Y" data-range-date="true" />
                            <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Date Start | Coding:</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" id="date_start" class="form-control" placeholder="Select Date Start"
                                data-provider="flatpickr" data-date-format="F j, Y" />
                            <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Date End | Coding:</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" id="date_end" class="form-control" placeholder="Select Date End"
                                data-provider="flatpickr" data-date-format="F j, Y" />
                            <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Date Testing:</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" id="date_testing" class="form-control" placeholder="Select Date Testing"
                                data-provider="flatpickr" data-date-format="F j, Y" data-range-date="true" />
                            <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Date Parallel:</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" id="date_parallel" class="form-control"
                                placeholder="Select Date Parallel" data-provider="flatpickr" data-date-format="F j, Y"
                                data-range-date="true" />
                            <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="submit_gantt()">Submit</button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_system_gantt" tabindex="-1" aria-labelledby="edit_system_gantt" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" style="width: 655px;">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title">EDIT GANTT | SETUP SYSTEM</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <label for="team_name" class="col-sm-3 col-form-label">Team:</label>
                    <input type="hidden" id="edit_emp_id" class="form-control hidden">
                    <input type="hidden" id="edit_id" class="form-control hidden">
                    <div class="col-sm-9">
                        <select class="form-select mb-3" id="edit_team">
                            <option></option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="team_name" class="col-sm-3 col-form-label">Incharge:</label>
                    <div class="col-sm-9">
                        <select class="form-select mb-3" id="edit_incharge">
                            <option></option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="name" class="col-sm-3 col-form-label">System | Module:</label>
                    <div class="col-sm-9">
                        <select class="form-select mb-3" id="edit_module">
                            <option></option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="name" class="col-sm-3 col-form-label">Sub | Module:</label>
                    <div class="col-sm-9">
                        <select class="form-select mb-3" id="edit_sub_module">
                            <option></option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="name" class="col-sm-3 col-form-label">Description:</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="edit_description" style="height: 70px"
                            placeholder="Description"></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Date Request:</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" id="edit_date_request" class="form-control"
                                placeholder="Select Date Request" data-provider="flatpickr" data-date-format="F j, Y" />
                            <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Date Implementation:</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" id="edit_date_implementation" class="form-control"
                                placeholder="Select Date Implementation" data-provider="flatpickr"
                                data-date-format="F j, Y" data-range-date="true" />
                            <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Date Start | Coding:</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" id="edit_date_start" class="form-control" placeholder="Select Date Start"
                                data-provider="flatpickr" data-date-format="F j, Y" />
                            <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Date End | Coding:</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" id="edit_date_end" class="form-control" placeholder="Select Date End"
                                data-provider="flatpickr" data-date-format="F j, Y" />
                            <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Date Testing:</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" id="edit_date_testing" class="form-control"
                                placeholder="Select Date Testing" data-provider="flatpickr" data-date-format="F j, Y"
                                data-range-date="true" />
                            <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Date Parallel:</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" id="edit_date_parallel" class="form-control"
                                placeholder="Select Date Parallel" data-provider="flatpickr" data-date-format="F j, Y"
                                data-range-date="true" />
                            <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="update_gantt()">Submit</button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Gantt Setup </h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Gantt </a></li>
                        <li class="breadcrumb-item active">Index<i class="mdi mdi-alpha-x-circle:"></i></li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-12">
            <div class="alert alert-info border-0 d-flex align-items-center" role="alert">
                <i class="ri-information-line align-middle me-2 fs-4"></i>
                <div class="flex-grow-1">
                    <strong>Note:</strong>
                    If no records are displayed in the Gantt chart that you added, ensure that the corresponding data has a workload assigned and the module has a company or business unit implemented. 
                    Only items with workload entries will appear in the Gantt chart.
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-12">
        <div class="card">
            <div class="card-header border-1">
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <div class="d-flex align-items-center flex-grow-1 gap-2">
                        <div class="input-group">
                            <input type="text" id="date_range_report" class="form-control" placeholder="Date Range"
                                data-provider="flatpickr" data-date-format="F j, Y" data-range-date="true" />
                            <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                        </div>
                        <select class="form-select" id="team_filter" style="width: 150px; height: auto;">
                            <option value="">Select Team</option>
                        </select>

                        <select class="form-select" id="module_filter" style="width: 150px; height: auto;">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="ms-2">
                        <?php
                        if ($this->session->userdata('position') != 'Manager' && $this->session->userdata('position') != 'Programmer') { ?>
                            <button class="btn btn-primary waves-effect waves-light add-btn" data-bs-toggle="modal"
                                data-bs-target="#add_system_gantt">
                                <i class="ri-add-line align-bottom me-1"></i> Add Gantt | System
                            </button>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="dropdown">
                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="columnDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false"> Column Visibility</button>
                    <ul class="dropdown-menu" aria-labelledby="columnDropdown" id="columnSelectorDropdown"
                        data-simplebar style="max-height: 300px;">
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="0" checked>
                                Team</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="1" checked>
                                Incharge</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="2" checked>
                                Module</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="3" checked>
                                Sub Module</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="4" checked>
                                Description</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="5" checked>
                                Date Requested</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="6" checked>
                                Date Parallel</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="7" checked>
                                Date Implementation</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="8" checked>
                                Date Start</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="9" checked>
                                Date End</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="10"
                                    checked> Testing Date</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="11"
                                    checked> Added Date</label></li>

                        <?php
                        if ($this->session->userdata('position') != 'Manager' && $this->session->userdata('position') != 'Programmer') { ?>
                            <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="12"
                                        checked> Action</label></li>
                            <?php
                        }
                        ?>

                    </ul>
                    <!-- <button id="generate_report" class="btn btn-danger btn-sm ms-1">Generate Report</button> -->
                    <button onclick="export_gantt_pdf()" target="_blank" class="btn btn-sm btn-danger ms-1">
                        Generate Report
                    </button>
                </div>
                <div class="tab-content">
                    <div class="mt-2 tab-pane active" id="System Analyst" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover compact" id="gantt_list" width="100%">
                                <thead class="table-info text-center text-uppercase">
                                    <tr>
                                        <th>Team</th>
                                        <th>Incharge</th>
                                        <th>Module</th>
                                        <th>Sub Module</th>
                                        <th>Description</th>
                                        <th>Date Requested</th>
                                        <th>Date Parallel</th>
                                        <th>Date Implementation</th>
                                        <th>Start Coding</th>
                                        <th>End Coding</th>
                                        <th>Testing Date</th>
                                        <th>Added</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var table = $('#gantt_list').DataTable({
        "processing": true,
        "serverSide": true,
        "destroy": true,
        "responsive": true,
        // "stateSave": true,
        // "scrollY": "400px",
        // "scrollX": true,
        // "scrollCollapse": true,
        "lengthMenu": [[10, 25, 50, 100, 10000], [10, 25, 50, 100, "Max"]],
        "pageLength": 10,
        "ajax": {
            "url": "<?php echo base_url('gantt_list'); ?>",
            "type": "POST",
            "data": function (d) {
                d.team_id = $('#team_filter').val();
                d.module = $('#module_filter').val();
                d.date_range_filter = $('#date_range_report').val();
            }
        },
        "columns": [
            { "data": "team_name" },
            { "data": "emp_name" },
            { "data": "mod_name" },
            { "data": "sub_mod_name" },
            { "data": "desc" },
            { "data": 'date_req' },
            { "data": 'date_parallel' },
            { "data": 'date_implem' },
            { "data": 'date_start' },
            { "data": 'date_end' },
            { "data": 'date_testing' },
            { "data": 'date_added' },
            {
                "data": "action",
                "visible": <?= ($_SESSION['position'] != 'Programmer' && $_SESSION['position'] != 'Manager') ? 'true' : 'false'; ?>
            }

        ],
        "columnDefs": [
            { "className": "text-start", "targets": ['_all'] },
        ],
    });
    $('#columnSelectorDropdown').on('click', function (e) {
        e.stopPropagation();
    });
    $('#columnSelectorDropdown .column-toggle').each(function () {
        let columnIdx = $(this).val();
        $(this).prop('checked', table.column(columnIdx).visible());
    });

    $('#columnSelectorDropdown .column-toggle').on('change', function () {
        let columnIdx = $(this).val();
        let isChecked = $(this).prop('checked');
        table.column(columnIdx).visible(isChecked);
    });

    $(document).ready(function () {
        $('#team, #team_filter, #edit_team').select2({ placeholder: 'Select Team', allowClear: true, minimumResultsForSearch: Infinity });
        $('#incharge, #edit_incharge').select2({ placeholder: 'Select Incharge', allowClear: true, minimumResultsForSearch: Infinity });
        $('#module_filter, #module, #edit_module').select2({ placeholder: 'Module Name | System', allowClear: true, minimumResultsForSearch: Infinity });
        $('#sub_module, #edit_sub_module').select2({ placeholder: 'Sub Module Name', allowClear: true, minimumResultsForSearch: Infinity });
    });

    $.ajax({
        url: '<?php echo base_url('get_team') ?>',
        type: 'POST',
        success: function (response) {
            teamData = JSON.parse(response);
            $('#team, #team_filter, #edit_team').empty().append('<option value="">Select Team Name</option>');
            teamData.forEach(function (team) {
                $('#team, #team_filter, #edit_team').append('<option value="' + team.team_id + '">' + team.team_name + '</option>');
            });
        }
    });
    let membersData = [];
    $('#incharge, #edit_incharge').prop('disabled', true);

    $('#team, #edit_team').change(function () {
        var team_id = $(this).val();
        $.ajax({
            url: '<?php echo base_url('setup_workload') ?>',
            type: 'POST',
            data: { team_id: team_id },
            success: function (response) {
                membersData = JSON.parse(response);
                $('#incharge, #edit_incharge').empty().append('<option value="">Select Name</option>');
                $('#incharge, #edit_incharge').prop('disabled', true);

                if (membersData.length > 0) {
                    membersData.forEach(function (member) {
                        $('#incharge, #edit_incharge').append('<option value="' + member.emp_id + '">' + member.emp_name + '</option>');
                    });

                    $('#incharge, #edit_incharge').prop('disabled', false);
                }
            }
        });
    });
    $('#incharge, #edit_incharge').change(function () {
        var selectedEmpId = $(this).val();
        var selectedMember = membersData.find(member => member.emp_id == selectedEmpId);

        if (selectedMember) {
            $('#emp_id, #edit_emp_id').val(selectedEmpId);
        } else {
            $('#emp_id, #edit_emp_id').val('');
        }
    });

    $('#team_filter, #module_filter, #date_range_report').change(function () {
        $('#gantt_list').DataTable().ajax.reload();
    });

    $('#date_range_report').change(function () {
        table.ajax.reload();
    });

    loadModule();
    function loadModule() {
        $.ajax({
            url: '<?php echo base_url('Admin/setup_module_dat') ?>',
            type: 'POST',
            data: {
                team: $('#team').val() || $('#edit_team').val()
            },
            success: function (response) {
                moduleData = JSON.parse(response);
                $('#module, #edit_module').empty().append('<option value="">Select Module Name</option>');
                $('#sub_module, #edit_sub_module').empty().append('<option value="">Select Sub Module</option>');
                $('#sub_module, #edit_sub_module').prop('disabled', true);

                moduleData.forEach(function (module) {
                    $('#module, #edit_module').append('<option value="' + module.mod_id + '">' + module.mod_name + '</option>');
                });
            }
        });
    }

    loadModuleFilter();
    function loadModuleFilter() {
        $.ajax({
            url: '<?php echo base_url('Menu/Gantt/setup_module_gantt') ?>',
            type: 'POST',
            data: {
                team: $('#team_filter').val()
            },
            success: function (response) {
                moduleData = JSON.parse(response);
                $('#module_filter').empty().append('<option value="">Select Module Name</option>');
                moduleData.forEach(function (module) {
                    $('#module_filter').append('<option value="' + module.mod_id + '">' + module.mod_name + '</option>');
                });
            }
        });
    }
    $('#team_filter').change(function () {
        loadModuleFilter();
    });
    $('#team, #team_filter, #edit_team').change(function () {
        loadModule();
    });
    $('#team_filter').change(function () {
        loadModuleFilter();
    });
    $('#module, #edit_module').change(function () {
        var selectedModuleId = $(this).val();
        $('#sub_module, #edit_sub_module').empty().append('<option value="">Select Sub Module</option>');
        $('#sub_module, #edit_sub_module').prop('disabled', true);

        var selectedModule = moduleData.find(module => module.mod_id == selectedModuleId);

        if (selectedModule && selectedModule.submodules.length > 0) {
            selectedModule.submodules.forEach(function (subModule) {
                $('#sub_module, #edit_sub_module').append('<option value="' + subModule.sub_mod_id + '">' + subModule.sub_mod_name + '</option>');
            });
            $('#sub_module, #edit_sub_module').prop('disabled', false);
        }
    });

    $('#add_system_gantt').on('hidden.bs.modal', function () {
        $('#team').val("").trigger('change');
        $('#incharge').val("").trigger('change');
        $('#module').val("").trigger('change');
        $('#sub_module').val("").trigger('change');
        $('#description, #date_request, #date_parallel, #date_implementation, #date_start, #date_end').val("");
    });
    function submit_gantt() {
        var team = $('#team').val();
        var team_name = $('#team option:selected').text();
        var module_name = $('#module option:selected').text();
        var emp_id = $('#emp_id').val();
        var emp_name = $('#incharge option:selected').text();
        var module = $('#module').val();
        var sub_module = $('#sub_module').val();
        var description = $('#description').val();
        var date_request = $('#date_request').val();
        var date_parallel = $('#date_parallel').val();
        var date_implementation = $('#date_implementation').val();
        var date_start = $('#date_start').val();
        var date_end = $('#date_end').val();
        var date_testing = $('#date_testing').val();

        var implementationDate = new Date(date_implementation);
        var startDate = new Date(date_start);
        var endDate = new Date(date_end);

        if (team == '' || emp_id == '' || module == '' || description == '' || date_request == '' || date_implementation == '') {

            toastr.options = {
                progressBar: true,
                positionClass: "toast-top-left",
                timeOut: 5000,
                extendedTimeOut: 2000,
            };

            toastr.error(`Please fill up the required fields`);

            $('#description, #date_request, #date_implementation').each(function () {
                let $input = $(this);
                let isEmpty = !$input.val();

                $input.removeClass('is-invalid');

                if ($input.hasClass('select2-hidden-accessible')) {
                    const $select2 = $input.next('.select2-container');
                    $select2.removeClass('is-invalid');

                    if (isEmpty) {
                        $select2.addClass('is-invalid');
                    }
                } else {
                    if (isEmpty) {
                        $input.addClass('is-invalid');
                    }
                }
            });
            return;
        }


        if (startDate > implementationDate) {
            toastr.error(`Date Start Coding cannot be later than Date Implementation.`);
            $('#date_start').addClass('is-invalid');
            return;
        } else {
            $('#date_start').removeClass('is-invalid');
        }

        if (endDate > implementationDate) {
            toastr.error(`Date End Coding cannot be later than Date Implementation.`);
            $('#date_end').addClass('is-invalid');
            return;
        } else {
            $('#date_end').removeClass('is-invalid');
        }

        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to add this data?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, add it!',
            cancelButtonText: 'No, cancel!',
            showLoaderOnConfirm: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo base_url('submit_gantt') ?>',
                    type: 'POST',
                    data: {
                        team: team,
                        team_name: team_name,
                        module_name: module_name,
                        emp_name: emp_name,
                        emp_id: emp_id,
                        module: module,
                        sub_module: sub_module,
                        description: description,
                        date_request: date_request,
                        date_parallel: date_parallel,
                        date_implementation: date_implementation,
                        date_start: date_start,
                        date_end: date_end,
                        date_testing: date_testing
                    },
                    success: function (response) {
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 5000,
                            extendedTimeOut: 2000,
                        };

                        toastr.success(`Gantt was successfully added`);
                        $('#add_system_gantt').modal('hide');
                        var table = $('#gantt_list').DataTable();
                        var currentPage = table.page();

                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                        }, false);
                    }
                });
            }
        });
    }

    function edit_gantt(id) {
        $.ajax({
            url: '<?php echo base_url('edit_gantt_content') ?>',
            type: 'POST',
            data: { id: id },
            success: function (response) {
                let data = JSON.parse(response);

                $('#edit_team').val(data.team_id).trigger('change');
                $('#edit_id').val(data.id);
                $('#edit_system_gantt').modal('show');
                setTimeout(function () {
                    $('#edit_emp_id').val(data.emp_id);
                    $('#edit_incharge').val(data.emp_id).trigger('change');
                    $('#edit_module').val(data.mod_id).trigger('change');
                    $('#edit_sub_module').val(data.sub_mod_id).trigger('change');
                    $('#edit_description').val(data.desc);

                    $('#edit_date_parallel').val(data.date_parallel);
                    $('#edit_date_implementation').val(data.date_implem);
                    $('#edit_date_testing').val(data.date_testing);
                    $('#edit_date_request').val(data.date_req);
                    $('#edit_date_start').val(data.date_start);
                    $('#edit_date_end').val(data.date_end);


                    flatpickr("#edit_date_request");
                    flatpickr("#edit_date_start");
                    flatpickr("#edit_date_end");

                    flatpickr("#edit_date_parallel", {
                        mode: "range"
                    });
                    flatpickr("#edit_date_implementation", {
                        mode: "range"
                    });
                    flatpickr("#edit_date_testing", {
                        mode: "range"
                    });
                }, 800);
            }
        });
    }
    function update_gantt() {
        var id = $('#edit_id').val();
        var team = $('#edit_team').val();
        var team_name = $('#edit_team option:selected').text();
        var module_name = $('#edit_module option:selected').text();
        var emp_id = $('#edit_emp_id').val();
        var emp_name = $('#edit_incharge option:selected').text();
        var module = $('#edit_module').val();
        var sub_module = $('#edit_sub_module').val();
        var description = $('#edit_description').val();
        var date_request = $('#edit_date_request').val();
        var date_parallel = $('#edit_date_parallel').val();
        var date_implem = $('#edit_date_implementation').val();
        var date_start = $('#edit_date_start').val();
        var date_end = $('#edit_date_end').val();
        var date_testing = $('#edit_date_testing').val();


        if (team == '' || emp_id == '' || module == '' || description == '' || date_request == '' || date_implementation == '') {

            toastr.options = {
                progressBar: true,
                positionClass: "toast-top-left",
                timeOut: 5000,
                extendedTimeOut: 2000,
            };

            toastr.error(`Please fill up the required fields`);

            $('#edit_description, #edit_date_request, #edit_date_implementation').each(function () {
                let $input = $(this);
                let isEmpty = !$input.val();

                $input.removeClass('is-invalid');

                if ($input.hasClass('select2-hidden-accessible')) {
                    const $select2 = $input.next('.select2-container');
                    $select2.removeClass('is-invalid');

                    if (isEmpty) {
                        $select2.addClass('is-invalid');
                    }
                } else {
                    if (isEmpty) {
                        $input.addClass('is-invalid');
                    }
                }
            });


            return;
        }

        var implementationDate = new Date(date_implem);
        var startDate = new Date(date_start);
        var endDate = new Date(date_end);
        if (startDate > implementationDate) {
            toastr.options = {
                progressBar: true,
                positionClass: "toast-top-left",
                timeOut: 5000,
                extendedTimeOut: 2000,
            };
            toastr.error(`Date Start Coding cannot be later than Date Implementation.`);
            $('#edit_date_start').addClass('is-invalid');
            return;
        } else {
            $('#edit_date_start').removeClass('is-invalid');
        }

        if (endDate > implementationDate) {
            toastr.options = {
                progressBar: true,
                positionClass: "toast-top-left",
                timeOut: 5000,
                extendedTimeOut: 2000,
            };
            toastr.error(`Date End Coding cannot be later than Date Implementation.`);
            $('#edit_date_end').addClass('is-invalid');
            return;
        } else {
            $('#edit_date_end').removeClass('is-invalid');
        }

        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to update this data?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update it!',
            cancelButtonText: 'No, cancel!',
            showLoaderOnConfirm: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo base_url('update_gantt') ?>',
                    type: 'POST',
                    data: {
                        id: id,
                        team: team,
                        team_name: team_name,
                        module_name: module_name,
                        emp_name: emp_name,
                        emp_id: emp_id,
                        module: module,
                        sub_module: sub_module,
                        description: description,
                        date_request: date_request,
                        date_parallel: date_parallel,
                        date_implementation: date_implem,
                        date_start: date_start,
                        date_end: date_end,
                        date_testing: date_testing

                    },
                    success: function (response) {
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 5000,
                            extendedTimeOut: 2000,

                        };

                        toastr.success(
                            `Gantt was successfully updated`,
                        );
                        $('#edit_system_gantt').modal('hide');
                        var table = $('#gantt_list').DataTable();
                        var currentPage = table.page();

                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                        }, false);
                    }
                });
            }
        });
    }
    function delete_gantt(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to delete this data?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            showLoaderOnConfirm: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo base_url('delete_gantt') ?>',
                    type: 'POST',
                    data: { id: id },
                    success: function (response) {
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 5000,
                            extendedTimeOut: 2000,

                        };

                        toastr.success(
                            `Gantt was successfully deleted`,
                        );
                        var table = $('#gantt_list').DataTable();
                        var currentPage = table.page();

                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                        }, false);
                    },
                });
            }
        });
    }
    function export_gantt_pdf() {
        const visible_columns = [];
        $('#columnSelectorDropdown .column-toggle:checked').each(function () {
            visible_columns.push(parseInt($(this).val()));
        });

        const team_id = $('#team_filter').val();
        const team_name = $('#team_filter option:selected').text();
        const module_id = $('#module_filter').val();
        const module_name = $('#module_filter option:selected').text();
        const date_range = $('#date_range_report').val();

        const query = $.param({
            visible_columns: visible_columns.join(','),
            team_id: team_id,
            team_name: team_name,
            module_id: module_id,
            module_name: module_name,
            date_range: date_range
        });

        window.open("<?= base_url('Menu/gantt/export_pdf?') ?>" + query, '_blank');
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        flatpickr.defaultConfig.allowInput = true;
        flatpickr.defaultConfig.dateFormat = "Y-m-d";
        flatpickr.defaultConfig.altInput = true;
        flatpickr.defaultConfig.altFormat = "F j, Y";
        flatpickr.defaultConfig.disableMobile = true;
        flatpickr.defaultConfig.mode = "range";

        flatpickr("[data-provider='flatpickr']");
    });
</script>