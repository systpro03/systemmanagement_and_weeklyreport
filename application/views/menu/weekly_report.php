<div class="modal fade zoomIn" id="show_update" tabindex="-1" aria-labelledby="showUpdateLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title" id="showUpdateLabel">STATUS UPDATE INFORMATION</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-sm table-striped align-middle text-center mb-0" id="update_logs">
                        <thead class="table-info">
                            <tr>
                                <th>DATE ONGOING</th>
                                <th>DATE DONE</th>
                                <th>UPDATED BY</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade zoomIn" id="show_update_weekly" tabindex="-1" aria-labelledby="showUpdateLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title" id="showUpdateLabel">STATUS UPDATE INFORMATION</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-sm table-striped align-middle text-center mb-0" id="update_logs_weekly">
                        <thead class="table-info">
                            <tr>
                                <th>DATE ONGOING</th>
                                <th>DATE DONE</th>
                                <th>UPDATED BY</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>


<div class="modal fade zoomIn" id="create_weekly_report" tabindex="-1" aria-labelledby="create_workloadLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable modal-xl" style="max-width: 98%;">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title">SETUP WEEKLY | DAILY REPORT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-info border-0 d-flex align-items-center" role="alert">
                        <i class="ri-information-line align-middle me-2 fs-4"></i>
                        <div class="flex-grow-1">
                            <strong>Note:</strong> You may create multiple reports entries for team members per team
                            before submitting.
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <!-- Team Selection (Fixed) -->
                <div class="row mb-3">
                    <label for="team_id" class="col-sm-2 col-form-label">Team Name:</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="team" style="width: 100%;">
                            <option value=""></option>
                        </select>
                    </div>
                </div>

                <!-- Table-Style Form Inputs -->
                <div class="table-responsive">
                    <table class="table align-middle text-nowrap compact table-striped" id="workload_table">
                        <thead class="table-info">
                            <tr>
                                <th width="16%">Date | Date Range</th>
                                <th width="15%">Name</th>
                                <th width="12%">Module</th>
                                <th width="12%">Sub Module</th>
                                <th width="12%">Task | Workload</th>
                                <th width="13%">Concerns</th>
                                <th width="10%">Remarks</th>
                                <th width="12%">Status <span style="color:red">*</span></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="weekly_body">
                            <!-- Rows will be dynamically appended -->
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-success" id="add_row_btn">+ Add New Report</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="submit_weeklyreport()">Submit</button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- edit weekly report -->
<div class="modal fade zoomIn" id="edit_weekly_report" tabindex="-1" aria-labelledby="edit_weekly_report"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" style="width: 765px">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title">UPDATE WEEKLY | DAILY REPORT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <label for="team_name" class="col-sm-3 col-form-label">Date Range:</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="date" id="edit_date_range_report" class="form-control" readonly=""
                                placeholder="Date Range" data-provider="flatpickr" data-date-format="F d, Y"
                                data-range-date="true" />
                            <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="team_name" class="col-sm-3 col-form-label">Team Name:</label>
                    <div class="col-sm-9">
                        <select class="form-select mb-3" id="edit_team" style="width: 100%; height: 508px">
                            <option value=""></option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="name" class="col-sm-3 col-form-label">Name:</label>
                    <input type="hidden" id="edit_emp_id">
                    <input type="hidden" id="edit_id">
                    <div class="col-sm-9">
                        <select class="form-select select2 mb-3" id="edit_name"></select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="module" class="col-sm-3 col-form-label">Module:</label>
                    <div class="col-sm-9">
                        <select class="form-select select2 mb-3" id="edit_module"></select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="sub_module" class="col-sm-3 col-form-label">System Sub Module:</label>
                    <div class="col-sm-9">
                        <select class="form-select select2 mb-3" id="edit_sub_module"></select>

                    </div>
                </div>
                <div class="row mb-3">
                    <label for="task" class="col-sm-3 col-form-label">Task | Workload:</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="edit_task_workload" rows="3"></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="task" class="col-sm-3 col-form-label">Concerns:</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="edit_concerns" rows="10"></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="remarks" class="col-sm-3 col-form-label">Remarks:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="edit_remarks" autocomplete="off">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="status" class="col-sm-3 col-form-label">Status:</label>
                    <div class="col-sm-9">
                        <select class="form-select mb-3" id="edit_weekly_status">
                            <option></option>
                            <option value="Pending">PENDING</option>
                            <option value="Ongoing">ONGOING</option>
                            <option value="Done">DONE</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="update_weeklyreport()">Submit</button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Weekly | Daily Report </h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Weekly </a></li>
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
                    <strong>Note:</strong> You may create multiple reports entries for team members per team before
                    submitting.
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
                            <input type="date" id="date_range_filter" class="form-control" readonly=""
                                placeholder="Date Range" data-provider="flatpickr" data-date-format="F j, Y"
                                data-range-date="true" />
                            <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                        </div>
                        <select class="form-select" id="team_filter" style="width: 150px;">
                            <option value="">Select Team</option>
                        </select>
                        <select class="form-select" id="module_filter" style="width: 150px;">
                            <option value="">Module</option>
                        </select>
                        <select class="form-select" id="sub_module_filter" style="width: 150px;">
                            <option value="">Sub Module</option>
                        </select>
                    </div>
                    <div class="ms-3">
                        <button class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal"
                            data-bs-target="#create_weekly_report"><i class="ri-add-fill align-bottom me-1"></i> Add
                            Daily Report</button>

                    </div>
                </div>
            </div>
            <div class="card-body">
                <ul class="nav nav-pills arrow-navtabs nav-primary bg-light " role="tablist">
                    <li class="nav-item">
                        <a id="All" aria-expanded="false" class="nav-link active status" data-bs-toggle="tab">
                            <span class="d-block d-sm-none"><iconify-icon icon="solar:danger-square-bold-duotone"
                                    class="fs-25"></iconify-icon></span>
                            <span class="d-none d-sm-block">All</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a id="Pending" aria-expanded="false" class="nav-link status" data-bs-toggle="tab">
                            <span class="d-block d-sm-none"><iconify-icon icon="solar:danger-square-bold-duotone"
                                    class="fs-25"></iconify-icon></span>
                            <span class="d-none d-sm-block">Pending</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a id="Ongoing" aria-expanded="true" class="nav-link status" data-bs-toggle="tab">
                            <span class="d-block d-sm-none"><iconify-icon icon="solar:hourglass-line-bold-duotone"
                                    class="fs-25"></iconify-icon></span>
                            <span class="d-none d-sm-block">Ongoing</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a id="Done" aria-expanded="true" class="nav-link status" data-bs-toggle="tab">
                            <span class="d-block d-sm-none"><iconify-icon icon="solar:folder-check-bold-duotone"
                                    class="fs-25"></iconify-icon></span>
                            <span class="d-none d-sm-block">Done</span>
                        </a>
                    </li>
                </ul>
                <hr>
                <div class="dropdown">
                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="columnDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false"> Column Visibility</button>
                    <ul class="dropdown-menu" aria-labelledby="columnDropdown" id="columnSelectorDropdown"
                        data-simplebar style="max-height: 300px;">
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="0" checked> Incharge</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="1" checked> Date Range</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="2" checked> Module</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="3" checked> Sub Module</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="4" checked> Task</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="5" checked> Concerns</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="6" checked> Remarks</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="7" checked> Status</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="8" checked> Action</label></li>
                    </ul>
                    <button onclick="export_weekly_pdf()" class="btn btn-danger btn-sm ms-1">Generate Report</button>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover dt-responsive compact" id="weekly_report">
                        <thead class="table-info text-center text-uppercase">
                            <tr>
                                <th>Incharge</th>
                                <th>Date Range</th>
                                <th>Module</th>
                                <th>Submodule</th>
                                <th width="17%">Task</th>
                                <th width="17%">Concerns</th>
                                <th width="10%">Remarks</th>
                                <th>Status</th>
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
<script>
    let rowCount = 0;
    let membersData = [];

    $(document).ready(function () {
        const select2Config = {
            placeholder: 'Select',
            allowClear: true,
            dropdownParent: $('#create_weekly_report')
        };

        function initializeRowSelect2(rowId) {
            $(`#team, #name_${rowId}, #module_${rowId}, #sub_module_${rowId}, #weekly_status_${rowId}`).select2(select2Config);
        }

        function populateNameDropdown(rowId) {
            const nameSelect = $(`#name_${rowId}`);
            nameSelect.empty().append('<option value="">Select Name</option>');

            membersData.forEach(member => {
                nameSelect.append(`<option value="${member.emp_id}">${member.emp_name}</option>`);
            });

            nameSelect.prop('disabled', membersData.length === 0);
        }

        function populateModuleDropdown(rowId) {
            const $module = $(`#module_${rowId}`);
            $module.empty().append('<option value="">Select Module Name</option>');
            moduleData.forEach(function (module) {
                $module.append(`<option value="${module.mod_id}">${module.mod_name}</option>`);
            });
            $(`#sub_module_${rowId}`).empty().append('<option value="">Select Sub Module</option>').prop('disabled', true);
        }

        function addWorkloadRow() {
            const rowId = rowCount++;
            const row = $(`
            <tr data-rowid="${rowId}">
                <td>
                    <div class="input-group">
                        <input type="date" id="date_range_report_${rowId}" name="date_range[]" class="form-control" readonly=""
                            placeholder="Date Range" data-provider="flatpickr" data-date-format="F d, Y"
                            data-range-date="true" />
                        <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                    </div>

                </td>
                <td>
                    <select class="form-select" id="name_${rowId}" name="name[]"></select>
                    <input type="hidden" name="emp_id[]" id="emp_id_${rowId}">
                </td>
                <td><select class="form-select" id="module_${rowId}" name="module[]"></select></td>
                <td><select class="form-select" id="sub_module_${rowId}" name="sub_module[]"></select></td>
                <td><textarea class="form-control" id="task_workload_${rowId}" name="task_workload[]" rows="5"></textarea></td>
                <td><textarea class="form-control" id="concerns_${rowId}" name="concerns[]" rows="5"></textarea></td>
                <td><input type="text" class="form-control" id="remarks_${rowId}" name="remarks[]" autocomplete="off"></td>
                <td>
                    <select class="form-select" id="weekly_status_${rowId}" name="weekly_status[]">
                        <option></option>
                        <option value="Pending">PENDING</option>
                        <option value="Ongoing">ONGOING</option>
                        <option value="Done">DONE</option>
                    </select>
                </td>
                <td><button type="button" class="btn btn-danger remove-row-btn">×</button></td>
            </tr>
        `);

            $('#weekly_body').append(row);
            initializeRowSelect2(rowId);
            populateNameDropdown(rowId);
            populateModuleDropdown(rowId);

            flatpickr(`#date_range_report_${rowId}`, {
                mode: 'range',
                dateFormat: 'F d, Y',
                altInput: true,
                altFormat: 'F d, Y',
                disableMobile: true
            });
        }

        $('#add_row_btn').on('click', function () {
            addWorkloadRow();
            toastr.options = {
                progressBar: true,
                positionClass: "toast-top-left",
                timeOut: 5000,
                extendedTimeOut: 2000,
            };
            toastr.success(
                `A new row has been successfully added.`,
            );
        });

        $(document).on('click', '.remove-row-btn', function () {
            $(this).closest('tr').remove();

            toastr.options = {
                progressBar: true,
                positionClass: "toast-top-left",
                timeOut: 5000,
                extendedTimeOut: 2000,
            };
            toastr.success(
                `Added row has been successfully removed.`,
            );

        });

        $('#team').change(function () {
            const team_id = $(this).val();
            $.ajax({
                url: '<?php echo base_url('setup_workload') ?>',
                type: 'POST',
                data: { team_id: team_id },
                success: function (response) {
                    membersData = JSON.parse(response);
                    load_mod1();
                    for (let i = 0; i < rowCount; i++) {
                        if ($(`#name_${i}`).length) {
                            populateNameDropdown(i);
                            // populateModuleDropdown(i);
                        }
                    }
                }
            });
        });
        let moduleData = [];

        function load_mod1() {
            $.ajax({
                url: '<?php echo base_url('Admin/setup_module_dat') ?>',
                type: 'POST',
                data: {
                    team: $('#team').val()
                },
                success: function (response) {
                    moduleData = JSON.parse(response);
                    $('#sub_module').prop('disabled', true);

                    moduleData.forEach(function (module) {
                        $('#module').append(`<option value="${module.mod_id}">${module.mod_name}</option>`);
                    });
                    for (let i = 0; i < rowCount; i++) {
                        if ($(`#module_${i}`).length) {
                            populateModuleDropdown(i);
                        }
                    }
                }
            });
        }

        $(document).on('change', 'select[id^="module_"]', function () {
            const rowId = this.id.split('_')[1];
            const selectedModuleId = $(this).val();

            const $subModule = $(`#sub_module_${rowId}`);
            console.log($subModule);
            $subModule.empty().append('<option value="">Select Sub Module</option>').prop('disabled', true);

            const selectedModule = moduleData.find(m => m.mod_id == selectedModuleId);
            if (selectedModule && selectedModule.submodules.length > 0) {
                selectedModule.submodules.forEach(sub => {
                    $subModule.append(`<option value="${sub.sub_mod_id}">${sub.sub_mod_name}</option>`);
                });
                $subModule.prop('disabled', false);
            }
        });

        function resetWorkloadForm() {
            $('#team').val('').trigger('change');
            $('#weekly_body').empty();
            rowCount = 0;
            addWorkloadRow();
        }

        $('#create_weekly_report').on('hidden.bs.modal', function () {
            resetWorkloadForm();
        });

        addWorkloadRow();
    });
</script>
<script>
    $(document).ready(function () {
        $('#edit_team, #team_filter').select2({ placeholder: 'Select Team', allowClear: true, });
        $('#edit_name').select2({ placeholder: 'Select Name | Incharge', allowClear: true });
        $('#edit_module, #module_filter').select2({ placeholder: 'Module Name | System', allowClear: true });
        $('#edit_sub_module, #sub_module_filter').select2({ placeholder: 'Sub Module Name | System', allowClear: true });
        $('#edit_weekly_status').select2({ placeholder: 'Weekly Status', allowClear: true });
    });

    var status = "All";
    var table = null;

    load_weekly_report(status);
    $("a.status").click(function () {
        $("a.btn-primary").removeClass('btn-primary').addClass('btn-secondary');
        $(this).addClass('btn-primary');
        status = this.id;
        load_weekly_report(status);
    });

    function load_weekly_report(status) {
        if (table) {
            table.destroy();

        }

        table = $('#weekly_report').DataTable({
            "processing": true,
            "serverSide": true,
            "destroy": true,
            "responsive": true,
            "lengthMenu": [[10, 25, 50, 100, 10000], [10, 25, 50, 100, "Max"]],
            "pageLength": 10,
            "ajax": {
                "url": "<?php echo base_url('weekly_list'); ?>",
                "type": "POST",
                "data": function (d) {
                    d.team = $('#team_filter').val();
                    d.module = $('#module_filter').val();
                    d.sub_module = $('#sub_module_filter').val();
                    d.date_range = $('#date_range_filter').val();
                    d.status = status !== "All" ? status : null;
                },
            },
            "columns": [
                { "data": "emp_name" },
                { "data": "date_range" },
                { "data": "module" },
                { "data": "sub_mod_name" },
                { "data": "task_workload" },
                { "data": "concerns" },
                { "data": "remarks" },
                { "data": "weekly_status",
                    "render": function (data, type, row) {
                        return `
                            <select class="form-control form-select form-select-sm weekly-status-dropdown" data-id="${row.id}" data-emp="${row.emp_id}" style="width: 95px;">
                                <option value="" ${data === '' ? 'selected' : ''}></option>
                                <option value="Pending" ${data === 'Pending' ? 'selected' : ''}>Pending</option>
                                <option value="Ongoing" ${data === 'Ongoing' ? 'selected' : ''}>Ongoing</option>
                                <option value="Done" ${data === 'Done' ? 'selected' : ''}>Done</option>
                            </select>
                        `;
                    }
                },
                { "data": 'action' }
            ],
            "columnDefs": [
                { "className": "text-start", "targets": ['_all'] },
            ]
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
    }

    $('#weekly_report').on('change', '.weekly-status-dropdown', function () {
        var weeklyStatus = $(this).val();
        var rowId = $(this).data('id');
        var emp_name = $(this).data('emp');
        $.ajax({
            url: "<?php echo base_url('update_weekly_status'); ?>",
            type: "POST",
            data: {
                id: rowId,
                weekly_status: weeklyStatus,
                emp_name: emp_name
            },
            success: function () {
                toastr.options = {
                    progressBar: true,
                    positionClass: "toast-top-left",
                    timeOut: 5000,
                    extendedTimeOut: 2000,

                };

                toastr.success(
                    `Weekly Report status was successfully updated`,
                );
                $('#weekly_report').DataTable().ajax.reload(null, false);

            },
        });
    });



    $('#team_filter, #module_filter, #sub_module_filter, #date_range_filter').change(function () {
        table.ajax.reload();
    });


    $.ajax({
        url: '<?php echo base_url('get_team') ?>',
        type: 'POST',
        success: function (response) {
            teamData = JSON.parse(response);
            $('#team, #edit_team, #team_filter').empty().append('<option value="">Select Team Name</option>');
            teamData.forEach(function (team) {
                $('#team, #edit_team, #team_filter').append('<option value="' + team.team_id + '">' + team.team_name + '</option>');
            });
        }
    });

    $('#edit_team').change(function () {
        var team_id = $(this).val();
        $.ajax({
            url: '<?php echo base_url('setup_workload') ?>',
            type: 'POST',
            data: { team_id: team_id },
            success: function (response) {
                membersData = JSON.parse(response);
                $('#edit_name').empty().append('<option value="">Select Name</option>');
                $('#edit_name').prop('disabled', true);

                if (membersData.length > 0) {
                    membersData.forEach(function (member) {
                        $('#edit_name').append('<option value="' + member.emp_id + '">' + member.emp_name + '</option>');
                    });

                    $('#edit_name').prop('disabled', false);
                }
            }
        });
    });
    $(document).on('change', 'select[id^="name_"]', function () {
        const rowId = this.id.split('_')[1];
        const selectedEmpId = $(this).val();
        const selectedMember = membersData.find(m => m.emp_id == selectedEmpId);
        if (selectedMember) {
            $(`#emp_id_${rowId}`).val(selectedEmpId);
        } else {

            $(`#emp_id_${rowId}`).val('');
        }
    });

    load_mod();
    function load_mod() {
        $.ajax({
            url: '<?php echo base_url('Admin/setup_module_dat') ?>',
            type: 'POST',
            data:
            {
                team: $('#edit_team').val()
            },
            success: function (response) {
                moduleData = JSON.parse(response);
                $('#edit_module').empty().append('<option value="">Select Module Name</option>');
                $('#edit_sub_module').empty().append('<option value="">Select Sub Module</option>');
                $('#edit_sub_module').prop('disabled', true);

                moduleData.forEach(function (module) {
                    $('#edit_module').append('<option value="' + module.mod_id + '">' + module.mod_name + '</option>');
                });
            }
        });
    }


    function load_modFilter() {
        $.ajax({
            url: '<?php echo base_url('Menu/Weekly/setup_module_weekly') ?>',
            type: 'POST',
            data:
            {
                team: $('#team_filter').val()
            },
            success: function (response) {
                moduleData = JSON.parse(response);
                $('#module_filter').empty().append('<option value="">Select Module Name</option>');
                $('#sub_module_filter').empty().append('<option value="">Select Sub Module</option>');
                $('#sub_module_filter').prop('disabled', true);
                moduleData.forEach(function (module) {
                    $('#module_filter').append('<option value="' + module.mod_id + '">' + module.mod_name + '</option>');
                });
            }
        });
    }
    load_modFilter();

    $('#team_filter').change(function () {
        load_modFilter();
    });
    $('#edit_team').change(function () {
        load_mod();
    });

    $('#edit_module, #module_filter').change(function () {
        var selectedModuleId = $(this).val();
        $('#edit_sub_module, #sub_module_filter').empty().append('<option value="">Select Sub Module</option>');
        $('#edit_sub_module, #sub_module_filter').prop('disabled', true);

        var selectedModule = moduleData.find(module => module.mod_id == selectedModuleId);

        if (selectedModule && selectedModule.submodules.length > 0) {
            selectedModule.submodules.forEach(function (subModule) {
                $('#edit_sub_module, #sub_module_filter').append('<option value="' + subModule.sub_mod_id + '">' + subModule.sub_mod_name + '</option>');
            });
            $('#edit_sub_module, #sub_module_filter').prop('disabled', false);

        }
    });

    function submit_weeklyreport() {
        var team_id = $('#team').val();
        var weekly_report = [];

        let isValid = true;

        $('#weekly_body tr').each(function () {
            const row = $(this);
            const rowId = row.data('rowid');

            const date_range = row.find(`#date_range_report_${rowId}`).val();
            const emp_id = row.find(`#emp_id_${rowId}`).val();
            const emp_name = $(`#name_${rowId} option:selected`).text();
            const module = row.find(`#module_${rowId}`).val();
            const sub_module = row.find(`#sub_module_${rowId}`).val();
            const task_workload = row.find(`#task_workload_${rowId}`).val();
            const concerns = row.find(`#concerns_${rowId}`).val();
            const remarks = row.find(`#remarks_${rowId}`).val();
            const status = row.find(`#weekly_status_${rowId}`).val();

            // Basic validation
            if (!date_range || !team_id || !emp_id || !module || !concerns || !status || !task_workload) {
                isValid = false;

                row.find(`#date_range_report_${rowId}, #name_${rowId}, #emp_id_${rowId}, #module_${rowId}, #task_workload_${rowId}, #concerns_${rowId}, #weekly_status_${rowId}`).each(function () {
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
            } else {
                weekly_report.push({
                    date_range,
                    emp_id,
                    emp_name,
                    module,
                    sub_module,
                    task_workload,
                    concerns,
                    remarks,
                    status
                });
            }
        });

        if (!team_id || !isValid || weekly_report.length === 0) {
            toastr.options = {
                progressBar: true,
                positionClass: "toast-top-left",
                timeOut: 5000,
                extendedTimeOut: 2000
            };
            toastr.error(`Please fill up the required fields.`);
            return;
        }

        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to add this report?',
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
                    url: '<?php echo base_url('submit_weeklyreport') ?>',
                    type: 'POST',
                    data: {
                        team_id: team_id,
                        weekly_report: weekly_report
                    },
                    success: function (response) {
                        toastr.success(`Weekly Report was successfully added.`);
                        $('#create_weekly_report').modal('hide');

                        const table = $('#weekly_report').DataTable();
                        const currentPage = table.page();

                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                        }, false);
                    }
                });
            }
        });
    }

    function edit_weekly_report_content(id) {
        $.ajax({
            url: '<?php echo base_url('edit_weekly_report_content') ?>',
            type: 'POST',
            data: { id: id },
            success: function (response) {
                let data = JSON.parse(response);

                $('#edit_id').val(data.id);
                $('#edit_team').val(data.team_id).trigger('change');
                let flatpickrInstance = $('#edit_date_range_report')[0]._flatpickr;
                if (flatpickrInstance) {
                    flatpickrInstance.setDate(data.date_range.split(' to '));
                } else {
                    $('#edit_date_range_report').val(data.date_range);
                }
                $('#edit_weekly_report').modal('show');
                setTimeout(function () {
                    $('#edit_emp_id').val(data.emp_id);
                    $('#edit_name').val(data.emp_id).trigger('change');
                    $('#edit_module').val(data.mod_id).trigger('change');
                    $('#edit_sub_module').val(data.sub_mod_id).trigger('change');

                    $('#edit_task_workload').val(data.task_workload);
                    $('#edit_concerns').val(data.concerns);
                    $('#edit_remarks').val(data.remarks);
                    $('#edit_weekly_status').val(data.weekly_status).trigger('change');
                }, 800);
            }
        });
    }

    function update_weeklyreport() {
        var date_range = $('#edit_date_range_report').val();
        var team = $('#edit_team').val();
        var id = $('#edit_id').val();
        var emp_id = $('#edit_name').val();
        var emp_name = $('#edit_name option:selected').text();
        var module = $('#edit_module').val();
        var sub_module = $('#edit_sub_module').val();
        var task_workload = $('#edit_task_workload').val();
        var concerns = $('#edit_concerns').val();
        var weekly_status = $('#edit_weekly_status').val();
        var remarks = $('#edit_remarks').val();

        if (!date_range || !team || !emp_id || !module || !concerns || !weekly_status || !task_workload) {

            toastr.options = {
                progressBar: true,
                positionClass: "toast-top-left",
                timeOut: 5000,
                extendedTimeOut: 2000,
            };

            toastr.error(`Please fill up the required fields`);

            $('#edit_date_range_report, #edit_team, #edit_name, #edit_module, #edit_task_workload, #edit_concerns, #edit_weekly_status').each(function () {
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

        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to update this weekly report?',
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
                    url: '<?php echo base_url('update_weeklyreport') ?>',
                    type: 'POST',
                    data: {
                        date_range: date_range,
                        team: team,
                        id: id,
                        emp_id: emp_id,
                        emp_name: emp_name,
                        module: module,
                        sub_module: sub_module,
                        task_workload: task_workload,
                        concerns: concerns,
                        weekly_status: weekly_status,
                        remarks: remarks
                    },
                    success: function (response) {
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 5000,
                            extendedTimeOut: 2000,

                        };

                        toastr.success(
                            `Weekly Report was successfully updated`,
                        );
                        $('#edit_weekly_report').modal('hide');
                        var table = $('#weekly_report').DataTable();
                        var currentPage = table.page();

                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                        }, false);
                    }
                });
            }
        });
    }
    function delete_weekly(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to delete this report?',
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
                    url: '<?php echo base_url('delete_weekly') ?>',
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
                            `Weekly Report status was successfully deleted`,
                        );
                        var table = $('#weekly_report').DataTable();
                        var currentPage = table.page();

                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                        }, false);
                    }
                });
            }
        })
    }

    function export_weekly_pdf() {
        const visible_columns = [];
        $('#columnSelectorDropdown .column-toggle:checked').each(function () {
            visible_columns.push(parseInt($(this).val()));
        });

        const team_id = $('#team_filter').val();
        const team_name = $('#team_filter option:selected').text();
        const module_id = $('#module_filter').val();
        const module_name = $('#module_filter option:selected').text();
        const date_range = $('#date_range_filter').val();
        const sub_module_id = $('#sub_module_filter').val();
        const sub_module_name = $('#sub_module_filter option:selected').text();


        const status = $("a.status.active").attr('id') || 'All';

        const query = $.param({
            visible_columns: visible_columns.join(','),
            team_id: team_id,
            team_name: team_name,
            module_id: module_id,
            module_name: module_name,
            date_range: date_range,
            sub_module_id: sub_module_id,
            sub_module_name: sub_module_name,
            status: status !== "All" ? status : null,
        });

        window.open("<?= base_url('Menu/Weekly/export_pdf?') ?>" + query, '_blank');
    }

    function show_update_logs(weekly_id) {
        $('#update_logs').dataTable({
            "processing": true,
            // "serverSide": true,
            "destroy": true,
            "searching": false,
            "paging": false,
            "info": false,
            "ajax": {
                "url": "<?php echo base_url('Menu/Weekly/show_update_logs'); ?>",
                "type": "POST",
                "data": function (d) {
                    d.weekly_id = weekly_id;
                }
            },
            "columns": [
                { "data": "date_ongoing" },
                { "data": "date_done" },
                { "data": "name" },
            ],
            "columnDefs": [
                { "className": "text-center", "targets": ['_all'] },
            ],
        });
    }

    function show_update_weekly(weekly_id, weekly_status) {
        $('#update_logs_weekly').dataTable({
            "processing": true,
            // "serverSide": true,
            "destroy": true,
            "searching": false,
            "paging": false,
            "info": false,
            "ajax": {
                "url": "<?php echo base_url('Menu/Weekly/show_update_weekly'); ?>",
                "type": "POST",
                "data": function (d) {
                    d.weekly_id = weekly_id;
                    d.weekly_status = weekly_status;
                }
            },
            "columns": [
                { "data": "date_ongoing" },
                { "data": "date_done" },
                { "data": "name" },
            ],
            "columnDefs": [
                { "className": "text-center", "targets": ['_all'] },
            ],
        });
    }


</script>