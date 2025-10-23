<div class="modal fade zoomIn" id="show_update_workload" tabindex="-1" aria-labelledby="showUpdateLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title" id="showUpdateLabel">STATUS UPDATE INFORMATION</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-sm table-striped align-middle text-center mb-0" id="update_workload">
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
<div class="modal fade zoomIn" id="create_workload" tabindex="-1" aria-labelledby="create_workloadLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable modal-xl" style="max-width: 98%;">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title">SETUP WORKLOAD</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-info border-0 d-flex align-items-center" role="alert">
                        <i class="ri-information-line align-middle me-2 fs-4"></i>
                        <div class="flex-grow-1">
                            <strong>Note:</strong> You may create multiple workload entries for team members per team
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
                        <select class="form-select" id="team_id" style="width: 100%;">
                            <option value=""></option>
                        </select>
                    </div>
                </div>

                <!-- Table-Style Form Inputs -->
                <div class="table-responsive">
                    <table class="table align-middle text-nowrap compact table-striped table-bordered" id="workload_table">
                        <thead class="table-info">
                            <tr>
                                <th width="15%">Name</th>
                                <th width="8%">Other Position</th>
                                <th width="15%">Module</th>
                                <th width="15%">Sub Module</th>
                                <th width="10%">Sub Module Menu</th>
                                <th>Description</th>
                                <th>Remarks</th>
                                <th width="10%">Status <span style="color:red">*</span></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="workload_body">
                            <!-- Rows will be dynamically appended -->
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-success" id="add_row_btn">+ Add New Workload</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="submit_workload()">Submit</button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<!-- Edit Workload -->
<div class="modal fade zoomIn" id="edit_workload" tabindex="-1" aria-labelledby="edit_workload" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" style="width: 765px">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title">SETUP WORKLOAD</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <label for="team_name" class="col-sm-3 col-form-label">Team Name:</label>
                    <div class="col-sm-9">
                        <select class="form-select mb-3" id="edit_team_id" style="width: 100%; height: 508px">
                            <option value=""></option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="name" class="col-sm-3 col-form-label">Name:</label>
                    <input type="hidden" id="edit_emp_id" name="emp_id">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="col-sm-9">
                        <select class="form-select select2 mb-3" id="edit_name"></select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="name" class="col-sm-3 col-form-label">Position:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="edit_position" placeholder="Position" value=""
                            autocomplete="off">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="name" class="col-sm-3 col-form-label">Additional Position:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="edit_additional_position"
                            placeholder="Additional Position" value="" autocomplete="off">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="module" class="col-sm-3 col-form-label">Module:</label>
                    <div class="col-sm-9">
                        <select class="form-select select2 mb-3" id="edit_module_id"></select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="sub_module" class="col-sm-3 col-form-label">System Sub Module:</label>
                    <div class="col-sm-9">
                        <select class="form-select select2 mb-3" id="edit_sub_module"></select>

                    </div>
                </div>
                <div class="row mb-3">
                    <label for="sub_module_menu" class="col-sm-3 col-form-label">System Sub Module Menu:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="edit_sub_module_menu" autocomplete="off">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="description" class="col-sm-3 col-form-label">Description:</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="edit_description" style="height: 90px"></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="remarks" class="col-sm-3 col-form-label">Remarks:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="edit_remarks" autocomplete="off">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="status" class="col-sm-3 col-form-label">Status: <span
                            style="color: red">*</span></label>
                    <div class="col-sm-9">
                        <select class="form-select mb-3" id="edit_workload_status">
                            <option></option>
                            <option value="Pending">PENDING</option>
                            <option value="Ongoing">ONGOING</option>
                            <option value="Done">DONE</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="submit_updated_workload()">Submit</button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">IT WORKLOAD | RESPONSIBILITIES </h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Workload </a></li>
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
                    <strong>Note:</strong> You may create multiple workload entries for team members per team before
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
                            <input type="date" id="date_range_report" class="form-control" readonly=""
                                placeholder="Date Range" data-provider="flatpickr" data-date-format="F d, Y"
                                data-range-date="true" />
                            <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                        </div>
                        <select class="form-select" id="team" style="width: 150px; height: auto;">
                            <option value=""></option>
                        </select>

                        <select class="form-select" id="module" style="width: 150px; height: auto;">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="ms-2">


                        <?php
                        if ($this->session->userdata('position') != 'Manager') { ?>
                            <div class="d-flex flex-wrap gap-2">
                                <button class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal"
                                    data-bs-target="#create_workload"><i class="ri-add-fill align-bottom me-1"></i> Add
                                    Workload </button>
                            </div>
                            <?php
                        }
                        ?>


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
                <div class="tab-content">
                    <div class="dropdown">
                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="columnDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false"> Column Visibility</button>
                        <ul class="dropdown-menu" aria-labelledby="columnDropdown" id="columnSelectorDropdown"
                            data-simplebar style="max-height: 300px;">
                            <!-- <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="0" checked> Team</label></li> -->
                            <!-- <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="0" checked> Other Position</label></li> -->
                            <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="0"
                                        checked> Name</label></li>
                            <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="1"
                                        checked> Position</label></li>
                            <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="2"
                                        checked> Other Position</label></li>
                            <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="3"
                                        checked> Module</label></li>
                            <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="4"
                                        checked> Sub Module</label></li>
                            <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="5"
                                        checked> Sub Menu</label></li>
                            <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="6"
                                        checked> Description</label></li>
                            <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="7"
                                        checked> Remarks</label></li>
                            <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="8"
                                        checked> Status</label></li>
                            <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="9"
                                        checked> Added</label></li>
                        </ul>
                        <button onclick="export_workload_pdf()" target="_blank" class="btn btn-sm btn-danger ms-1">
                            Generate Report</button>
                    </div>
                    <div class="mt-2 tab-pane active" id="System Analyst" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover responsive compact" id="workload">
                                <thead class="table-info text-center text-uppercase">
                                    <tr>
                                        <!-- <th>Team</th> -->
                                        <th width="10%">Name</th>
                                        <th>Position</th>
                                        <th>Other Position</th>
                                        <th>Module</th>
                                        <th>SubModule</th>
                                        <th>SubMenu</th>
                                        <th>Description</th>
                                        <th width="15%">Remarks</th>
                                        <th>Status</th>
                                        <th width="8%">Added</th>
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

    let rowCount = 0;
    let membersData = [];

    $(document).ready(function () {
        const select2Config = {
            placeholder: 'Select',
            allowClear: true,
            dropdownParent: $('#create_workload')
        };

        function initializeRowSelect2(rowId) {
            $(`#team_id, #name_${rowId}, #module_id_${rowId}, #sub_module_${rowId}, #workload_status_${rowId}`).select2(select2Config);
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
            const $module = $(`#module_id_${rowId}`);
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
                    <select class="form-select" id="name_${rowId}" name="name[]"></select>
                    <input type="hidden" name="emp_id[]" id="emp_id_${rowId}">
                    <input type="hidden" class="form-control" id="position_${rowId}" name="position[]" autocomplete="off">
                    <span id="positiontxt_${rowId}" class="badge bg-primary d-block mt-1 text-center" style="font-size: 0.65rem;"></span>
                </td>
                <td><input type="text" class="form-control" id="additional_position_${rowId}" name="additional_position[]" autocomplete="off"></td>
                <td><select class="form-select" id="module_id_${rowId}" name="module_id[]"></select></td>
                <td><select class="form-select" id="sub_module_${rowId}" name="sub_module[]"></select></td>
                <td><input type="text" class="form-control" id="sub_module_menu_${rowId}" name="sub_module_menu[]" autocomplete="off"></td>
                <td><textarea class="form-control" id="description_${rowId}" name="description[]" rows="5"></textarea></td>
                <td><input type="text" class="form-control" id="remarks_${rowId}" name="remarks[]" autocomplete="off"></td>
                <td>
                    <select class="form-select" id="workload_status_${rowId}" name="workload_status[]">
                        <option></option>
                        <option value="Pending">PENDING</option>
                        <option value="Ongoing">ONGOING</option>
                        <option value="Done">DONE</option>
                    </select>
                </td>
                <td><button type="button" class="btn btn-danger remove-row-btn">×</button></td>
            </tr>
        `);

            $('#workload_body').append(row);
            initializeRowSelect2(rowId);
            populateNameDropdown(rowId);
            populateModuleDropdown(rowId);
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

        $('#team_id').change(function () {
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
                            $(`#positiontxt_${i}`).text('');
                            // resetWorkloadForm();

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
                    team: $('#team_id').val()
                },
                success: function (response) {
                    moduleData = JSON.parse(response);
                    $('#sub_module').prop('disabled', true);

                    moduleData.forEach(function (module) {
                        $('#module_id').append(`<option value="${module.mod_id}">${module.mod_name}</option>`);
                    });
                    for (let i = 0; i < rowCount; i++) {
                        if ($(`#module_id_${i}`).length) {
                            populateModuleDropdown(i);
                        }
                    }
                }
            });
        }

        $(document).on('change', 'select[id^="module_id_"]', function () {
            const rowId = this.id.split('_')[2]; // gets `X` from id="module_id_X"
            const selectedModuleId = $(this).val();

            const $subModule = $(`#sub_module_${rowId}`);
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
            $('#team_id').val('').trigger('change');
            $('#workload_body').empty();
            rowCount = 0;
            addWorkloadRow();
        }

        $('#create_workload').on('hidden.bs.modal', function () {
            resetWorkloadForm();
        });

        addWorkloadRow();
    });
</script>

<script>

    $(document).ready(function () {
        $('#team,#edit_team_id').select2({
            placeholder: 'Select Team',
            allowClear: true,
            // minimumResultsForSearch: Infinity
        });
        $('#module,#edit_module_id').select2({
            placeholder: 'Select Module Name',
            allowClear: true,
            // minimumResultsForSearch: Infinity
        });
        $('#sub_module, #edit_sub_module').select2({
            placeholder: 'Select Sub Module Name',
            allowClear: true,
            // minimumResultsForSearch: Infinity
        });
    });

    var status = "All";
    var table = null;
    var printWindow = null;

    load_workload(status);

    $("a.status").click(function () {
        $("a.btn-primary").removeClass('btn-primary').addClass('btn-secondary');
        $(this).addClass('btn-primary');
        status = this.id;
        load_workload(status);
    });

    $('#team, #module, #date_range_report').change(function () {
        if (table) {
            table.ajax.reload();
        }
    });

    function load_workload(status) {
        if (table) {
            table.destroy();
        }

        table = $('#workload').DataTable({
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
                "url": "<?php echo base_url('workload_list'); ?>",
                "type": "POST",
                "data": function (d) {
                    d.team = $('#team').val();
                    d.module = $('#module').val();
                    d.date_range = $('#date_range_report').val();
                    d.status = status !== "All" ? status : null;
                }
            },
            "columns": [
                // { "data": "team_name" },
                { "data": "emp_id" },
                { "data": "user_type" },
                { "data": "add_pos" },
                { "data": "module" },
                { "data": "sub_mod_name" },
                { "data": "sub_mod_menu" },
                { "data": "description" },
                { "data": "remarks" },
                {
                    "data": "status",
                    "render": function (data, type, row) {
                        var teamId = "<?= $_SESSION['position']; ?>";
                        var disabled = (teamId == 'Manager') ? 'disabled' : '';

                        return `
                            <select class="form-control form-select form-select-sm workload-status-dropdown" data-id="${row.id}" data-emp="${row.emp_id}" style="width: 95px;" ${disabled}>
                                <option value="" ${data === '' ? 'selected' : ''}></option>
                                <option value="Pending" ${data === 'Pending' ? 'selected' : ''}>Pending</option>
                                <option value="Ongoing" ${data === 'Ongoing' ? 'selected' : ''}>Ongoing</option>
                                <option value="Done" ${data === 'Done' ? 'selected' : ''}>Done</option>
                            </select>
                        `;
                    }
                },

                { "data": "date_added" },
                {
                    "data": 'action',
                    "visible": <?= ($_SESSION['position'] != 'Manager') ? 'true' : 'false'; ?>
                }
            ],
            "paging": true,
            "searching": true,
            "ordering": true,
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

    }


    $('#workload').on('change', '.workload-status-dropdown', function () {
        var status = $(this).val();
        var rowId = $(this).data('id');
        var emp_name = $(this).data('emp');
        $.ajax({
            url: "<?php echo base_url('update_workload_status'); ?>",
            type: "POST",
            data: {
                id: rowId,
                status: status,
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
                    `Workload status was successfully updated.`,
                );
                $('#workload').DataTable().ajax.reload(null, false);
            },
        });
    });

    $.ajax({
        url: '<?php echo base_url('get_team') ?>',
        type: 'POST',
        success: function (response) {
            teamData = JSON.parse(response);
            $('#team, #team_id, #edit_team_id').empty().append('<option value="">Select Team Name</option>');
            teamData.forEach(function (team) {
                $('#team, #team_id, #edit_team_id').append('<option value="' + team.team_id + '">' + team.team_name + '</option>');
            });
        }
    });

    // let membersData = [];
    $('#edit_name').prop('disabled', true);
    $('#edit_position').prop('disabled', true);

    $('#edit_team_id').change(function () {
        var team_id = $(this).val();
        $.ajax({
            url: '<?php echo base_url('setup_workload') ?>',
            type: 'POST',
            data: { team_id: team_id },
            success: function (response) {
                membersData = JSON.parse(response);
                $('#edit_name').empty().append('<option value="">Select Name</option>');
                $('#edit_position').val('');
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
            $(`#position_${rowId}`).val(selectedMember.position).prop('disabled', true);
            $(`#positiontxt_${rowId}`).text(selectedMember.position);
            $(`#emp_id_${rowId}`).val(selectedEmpId);
        } else {
            $(`#position_${rowId}`).val('').prop('disabled', false);
            $(`#positiontxt_${rowId}`).text('');
            $(`#emp_id_${rowId}`).val('');
        }
    });

    $('#edit_name').change(function () {
        var selectedEmpId = $(this).val();
        var selectedMember = membersData.find(member => member.emp_id == selectedEmpId);

        if (selectedMember) {
            $('#edit_position').val(selectedMember.position);
            $('#edit_position').prop('disabled', true);
            $('#edit_emp_id').val(selectedEmpId);
        } else {
            $('#edit_position').val('');
            $('#edit_position').prop('disabled', false);
            $('#edit_emp_id').val('');
        }
    });

    load_mod();
    function load_mod() {
        $.ajax({
            url: '<?php echo base_url('Admin/setup_module_dat') ?>',
            type: 'POST',
            data: {
                team: $('#edit_team_id').val()
            },
            success: function (response) {
                moduleData = JSON.parse(response);
                $('#edit_module_id').empty().append('<option value="">Select Module Name</option>');
                $('#edit_sub_module').empty().append('<option value="">Select Sub Module</option>');
                $('#edit_sub_module').prop('disabled', true);

                moduleData.forEach(function (module) {
                    $('#edit_module_id').append('<option value="' + module.mod_id + '">' + module.mod_name + '</option>');
                });
            }
        });
    }

    function load_modFilter() {
        $.ajax({
            url: '<?php echo base_url('Menu/It_Respo/setup_module_workload') ?>',
            type: 'POST',
            data:
            {
                team: $('#team').val()
            },
            success: function (response) {
                moduleData = JSON.parse(response);
                $('#module').empty().append('<option value="">Select Module Name</option>');
                moduleData.forEach(function (module) {
                    $('#module').append('<option value="' + module.mod_id + '">' + module.mod_name + '</option>');
                });
            }
        });
    }
    load_modFilter();

    $('#team').change(function () {
        load_modFilter();
    });


    $('#edit_team_id').change(function () {
        load_mod();
    });

    $('#edit_module_id').change(function () {
        var selectedModuleId = $(this).val();
        $('#edit_sub_module').empty().append('<option value="">Select Sub Module</option>');
        $('#edit_sub_module').prop('disabled', true);

        var selectedModule = moduleData.find(module => module.mod_id == selectedModuleId);

        if (selectedModule && selectedModule.submodules.length > 0) {
            selectedModule.submodules.forEach(function (subModule) {
                $('#edit_sub_module').append('<option value="' + subModule.sub_mod_id + '">' + subModule.sub_mod_name + '</option>');
            });
            $('#edit_sub_module').prop('disabled', false);
        }
    });

    function submit_workload() {
        var team_id = $('#team_id').val();
        var workloads = [];

        let isValid = true;

        $('#workload_body tr').each(function () {
            const row = $(this);
            const rowId = row.data('rowid');

            const emp_id = row.find(`#emp_id_${rowId}`).val();
            var emp_name = $(`#name_${rowId} option:selected`).text();
            const position = row.find(`#position_${rowId}`).val();
            const add_pos = row.find(`#additional_position_${rowId}`).val();
            const module_id = row.find(`#module_id_${rowId}`).val();
            const sub_module = row.find(`#sub_module_${rowId}`).val();
            const sub_module_menu = row.find(`#sub_module_menu_${rowId}`).val();
            const description = row.find(`#description_${rowId}`).val();
            const remarks = row.find(`#remarks_${rowId}`).val();
            const status = row.find(`#workload_status_${rowId}`).val();

            // Basic validation
            if (!emp_id || !module_id || !status || !description) {
                isValid = false;

                // Mark invalid inputs
                row.find(`#name_${rowId}, #module_id_${rowId}, #description_${rowId}, #workload_status_${rowId}`).each(function () {
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
                workloads.push({
                    emp_id,
                    emp_name,
                    position,
                    add_pos,
                    module_id,
                    sub_module,
                    sub_module_menu,
                    description,
                    remarks,
                    status
                });
            }
        });

        if (!team_id || !isValid || workloads.length === 0) {
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
            text: 'You want to add this workload?',
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
                    url: '<?php echo base_url('submit_workload') ?>',
                    type: 'POST',
                    data: {
                        team_id: team_id,
                        workloads: workloads // Send as array
                    },
                    success: function (response) {
                        toastr.success(`Workload was successfully added.`);
                        $('#create_workload').modal('hide');

                        const table = $('#workload').DataTable();
                        const currentPage = table.page();

                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                        }, false);
                    }
                });
            }
        });
    }

    function loadModules(callback) {
        $.ajax({
            url: '<?php echo base_url('Admin/setup_module_dat') ?>',
            type: 'POST',
            data: {
                team: $('#team').val(),
            },
            success: function (response) {
                moduleData = JSON.parse(response);
                $('#module_id, #edit_module_id').empty().append('<option value="">Select Module Name</option>');
                $('#sub_module, #edit_sub_module').empty().append('<option value="">Select Sub Module</option>');
                $('#sub_module, #edit_sub_module').prop('disabled', true);

                moduleData.forEach(function (module) {
                    $('#module_id, #edit_module_id').append('<option value="' + module.mod_id + '">' + module.mod_name + '</option>');
                });

                if (typeof callback === "function") callback();
            }
        });
    }

    function edit_workload_content(id) {
        $.ajax({
            url: '<?php echo base_url("edit_workload_content"); ?>',
            type: 'POST',
            data: { id: id },
            success: function (response) {
                let data = JSON.parse(response);
                console.log(data);
                $('#edit_team_id').val(data.team_id).trigger('change');
                $('#edit_id').val(data.id);

                setTimeout(function () {
                    $('#edit_name').val(data.emp_id).trigger('change');
                    $('#edit_position').val(data.user_type);
                    $('#edit_module_id').val(data.mod_id || '').trigger('change');
                    $('#edit_sub_module').val(data.sub_mod || '').trigger('change');
                    $('#edit_sub_module_menu').val(data.sub_mod_menu);
                    $('#edit_description').val(data.desc);
                    $('#edit_remarks').val(data.remarks);
                    $('#edit_additional_position').val(data.add_pos);
                    $('#edit_workload_status').val(data.status).trigger('change');
                    $('#edit_workload').modal('show');
                }, 300);
            }
        });
    }

    function submit_updated_workload() {

        var id = $('#edit_id').val();
        var team_id = $('#edit_team_id').val();
        var emp_id = $('#edit_emp_id').val();
        var emp_name = $('#edit_name option:selected').text();
        var position = $('#edit_position').val();
        var add_pos = $('#edit_additional_position').val();
        var module_id = $('#edit_module_id').val();
        var sub_module = $('#edit_sub_module').val();
        var sub_module_menu = $('#edit_sub_module_menu').val();
        var description = $('#edit_description').val();
        var remarks = $('#edit_remarks').val();
        var status = $('#edit_workload_status').val();

        if (team_id === "" || emp_id === "" || position === "") {
            toastr.options = {
                progressBar: true,
                positionClass: "toast-top-left",
                timeOut: 5000,
                extendedTimeOut: 2000,

            };

            toastr.error(
                `Please fill up the required fields.`,
            );
            if (position === "") {
                $('#edit_position').addClass('is-invalid');
            }
            return;
        }


        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to update this module?',
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
                    url: '<?php echo base_url('submit_updated_workload') ?>',
                    type: 'POST',
                    data: {
                        id: id,
                        team_id: team_id,
                        emp_id: emp_id,
                        emp_name: emp_name,
                        position: position,
                        add_pos: add_pos,
                        module_id: module_id,
                        sub_module: sub_module,
                        sub_module_menu: sub_module_menu,
                        description: description,
                        remarks: remarks,
                        status: status
                    },
                    success: function (response) {
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 5000,
                            extendedTimeOut: 2000,

                        };

                        toastr.success(
                            `Workload was successfully updated.`,
                        );
                        $('#edit_workload').modal('hide');
                        var table = $('#workload').DataTable();
                        var currentPage = table.page();

                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                        }, false);
                    }
                });
            }
        });
    }


    function delete_workload(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to delete this workload?',
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
                    url: '<?= base_url('delete_workload') ?>',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function () {
                        var table = $('#workload').DataTable();
                        var currentPage = table.page();

                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                        }, false);
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 5000,
                            extendedTimeOut: 2000,

                        };

                        toastr.success(
                            `Workload was successfully deleted.`,
                        );
                    },
                });
            }
        });
    }

    function export_workload_pdf() {
        const visible_columns = [];
        $('#columnSelectorDropdown .column-toggle:checked').each(function () {
            visible_columns.push(parseInt($(this).val()));
        });

        const team_id = $('#team').val();
        const team_name = $('#team option:selected').text();
        const module_id = $('#module').val();
        const module_name = $('#module option:selected').text();
        const status = $('.nav-link.status.active').attr('id');
        const date_range = $('#date_range_report').val();

        const query = $.param({
            visible_columns: visible_columns.join(','),
            team_id: team_id,
            team_name: team_name,
            module_id: module_id,
            module_name: module_name,
            status: status !== "All" ? status : null,
            date_range: date_range
        });

        window.open("<?= base_url('Menu/It_Respo/export_pdf?') ?>" + query, '_blank');
    }


    function show_update_workload(workload_id, status){
        $('#update_workload').dataTable({
            "processing": true,
            // "serverSide": true,
            "destroy": true,
            "searching": false,
            "paging": false,
            "info": false,
            "ajax": {
                "url": "<?php echo base_url('Menu/It_Respo/show_update_workload'); ?>",
                "type": "POST",
                "data": function (d) {
                    d.workload_id = workload_id;
                    d.status = status;
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