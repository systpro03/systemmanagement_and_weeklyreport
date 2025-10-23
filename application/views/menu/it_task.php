<!-- Create task -->
<div class="modal fade" id="create_task" tabindex="-1" aria-labelledby="create_task" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" style="width: 765px">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title">SETUP TASK</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <label for="team_name" class="col-sm-3 col-form-label">Team Name:</label>
                    <div class="col-sm-9">
                        <select class="form-select mb-3" id="team" style="width: 100%; height: 508px">
                            <option value=""></option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="name" class="col-sm-3 col-form-label">Name:</label>
                    <input type="hidden" id="emp_id" name="emp_id">
                    <div class="col-sm-9">
                        <select class="form-select select2 mb-3" id="name"></select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="module" class="col-sm-3 col-form-label">Module:</label>
                    <div class="col-sm-9">
                        <select class="form-select select2 mb-3" id="module"></select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="sub_module" class="col-sm-3 col-form-label">System Sub Module:</label>
                    <div class="col-sm-9">
                        <select class="form-select select2 mb-3" id="sub_module"></select>

                    </div>
                </div>
                <div class="row mb-3">
                    <label for="description" class="col-sm-3 col-form-label">Description:</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="desc" style="height: 90px"></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="concern" class="col-sm-3 col-form-label">Concern:</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="concern" style="height: 90px"></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="remarks" class="col-sm-3 col-form-label">Remarks:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="remarks" autocomplete="off">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="status" class="col-sm-3 col-form-label">Status:</label>
                    <div class="col-sm-9">
                        <select class="form-select mb-3" id="task_status">
                            <option></option>
                            <option value="Pending">PENDING</option>
                            <option value="Ongoing">ONGOING</option>
                            <option value="Done">DONE</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="submit_task()">Submit</button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_task" tabindex="-1" aria-labelledby="edit_task" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" style="width: 765px">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title">EDIT TASK</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
                    <input type="hidden" id="edit_emp_id" name="emp_id">
                    <input type="hidden" id="edit_id" name="task_id">
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
                    <label for="description" class="col-sm-3 col-form-label">Description:</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="edit_desc" style="height: 90px"></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="concern" class="col-sm-3 col-form-label">Concern:</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="edit_concern" style="height: 90px"></textarea>
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
                        <select class="form-select mb-3" id="edit_task_status">
                            <option></option>
                            <option value="Pending">PENDING</option>
                            <option value="Ongoing">ONGOING</option>
                            <option value="Done">DONE</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="update_task_content()">Submit</button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">IT TASK | DAILY </h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Task </a></li>
                        <li class="breadcrumb-item active">Index<i class="mdi mdi-alpha-x-circle:"></i></li>
                    </ol>
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
                                <input type="date" id="date_range_report" class="form-control" readonly=""  placeholder="Date Range" data-provider="flatpickr" data-date-format="F d, Y" data-range-date="true" />
                                <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                            </div>
                            <select class="form-select" id="filter_team" style="width: 150px; height: auto;">
                                <option value=""></option>
                            </select>

                            <select class="form-select" id="filter_module" style="width: 150px; height: auto;">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="ms-2">
                            <div class="d-flex flex-wrap gap-2">
                            <button class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#create_task"><i class="ri-add-fill align-bottom me-1"></i> Add Daily Task </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="dropdown">
                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="columnDropdown" data-bs-toggle="dropdown" aria-expanded="false"> Column Visibility</button>
                        <ul class="dropdown-menu" aria-labelledby="columnDropdown" id="columnSelectorDropdown" data-simplebar style="max-height: 300px;">
                            <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="0" checked> Name</label></li>
                            <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="1" checked> Module</label></li>
                            <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="2" checked> Sub Module</label></li>
                            <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="3" checked> Description</label></li>
                            <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="4" checked> Concern</label></li>
                            <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="5" checked> Remarks</label></li>
                            <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="6" checked> Status</label></li>
                            <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="7" checked> Action</label></li>
                        </ul>
                        <button id="generate_report" class="btn btn-danger btn-sm ms-1">Generate Report</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover no-wrap compact" id="it_task_list">
                            <thead class="table-info text-center text-uppercase">
                                <tr>
                                    <th>Name</th>
                                    <th>Module</th>
                                    <th>Sub Module</th>
                                    <th>Description</th>
                                    <th>Concern</th>
                                    <th>Remarks</th>
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
    $(document).ready(function () {
        $('#team, #edit_team, #filter_team').select2({ placeholder: 'Select Team', allowClear: true, minimumResultsForSearch: Infinity});
        $('#name, #edit_name').select2({ placeholder: 'Select Name', allowClear: true, minimumResultsForSearch: Infinity});
        $('#filter_module, #module, #edit_module').select2({ placeholder: 'Select Module Name', allowClear: true, minimumResultsForSearch: Infinity});
        $('#sub_module, #sub_module').select2({ placeholder: 'Select Sub Module Name', allowClear: true, minimumResultsForSearch: Infinity});
        $('#task_status').select2({ placeholder: 'Select Status', allowClear: true, minimumResultsForSearch: Infinity});
    });

    var table = $('#it_task_list').DataTable({
        "processing": true,
        "serverSide": true,
        "destroy": true,
        "stateSave": true,
        "responsive": true,
        // "scrollY": "400px",
        // "scrollX": true,
        // "scrollCollapse": true,
        "lengthMenu": [[10, 25, 50, 100, 10000], [10, 25, 50, 100, "Max"]],
        "pageLength": 10,
        "ajax": {
            "url": "<?php echo base_url('it_task_list'); ?>",
            "type": "POST",
            "data": function (d) {
                d.team = $('#filter_team').val();
                d.module = $('#filter_module').val();
                d.date_range    = $('#date_range_report').val();
            }
        },
        "columns": [
            { "data": "emp_name" },
            { "data": "module" },
            { "data": "sub_mod_name" },
            { "data": "desc" },
            { "data": "concerns" },
            { "data": "remarks" },
            { "data": "task_status",
                "render": function (data, type, row) {
                    return `
                        <select class="form-control form-select form-select-sm task-status-dropdown" data-id="${row.task_id}" data-emp="${row.emp_name}" style="width: 95px;">
                            <option value="Pending" ${data === 'Pending' ? 'selected' : ''}>Pending</option>
                            <option value="Ongoing" ${data === 'Ongoing' ? 'selected' : ''}>Ongoing</option>
                            <option value="Done" ${data === 'Done' ? 'selected' : ''}>Done</option>
                        </select>
                    `;
                }
            },
            { "data": "action" }
        ],
        "columnDefs": [
            { "className": "text-center", "targets": ['_all'] }
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
    $('#generate_report').on('click', function () {
        let visibleColumns = [];
        let visibleHeaders = [];
        let desc = -1;
        table.columns().every(function (index) {
            let headerText = this.header().textContent.trim();
            if (this.visible() && headerText.toLowerCase() !== 'action') {
                visibleColumns.push(index);
                visibleHeaders.push(headerText);
                if (headerText.toLowerCase() === 'description') {
                    desc = visibleColumns.length - 1;
                }
            }
        });

        let rowData = table.rows({ filter: 'applied' }).data().toArray();
        let reportData = rowData.map(row => visibleColumns.map(index => row[table.column(index).dataSrc()]));
        let printContent = `
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            th, td {
                padding: 10px;
                text-align: left;
                border: 1px solid #ddd;
                word-wrap: break-word;
                max-width: 200px;
                white-space: normal;
            }
            .description {
                width: 300px;
            }
        </style>
        <div style="text-align: center;">
            <h4 style="margin: 0;">TASK REPORT</h4>
            <h4 style="margin: 0;">${$('#date_range_report').val()}</h4>
            <h5 style="margin: 0;">${$('#filter_team option:selected').text()}</h5>
            <h5 style="margin: 0;">${$('#filter_module option:selected').text()}</h5>
        </div>

        <table>
            <thead>
                <tr>${visibleHeaders.map((header, index) => 
                    `<th class="${index === desc ? 'description' : ''}">${header}</th>`
                ).join('')}</tr>
            </thead>
            <tbody>
                ${reportData.map((row, rowIndex) => 
                    `<tr>${row.map((cell, cellIndex) => 
                        `<td class="${cellIndex === desc ? 'description' : ''}">${cell}</td>`
                    ).join('')}</tr>`
                ).join('')}
            </tbody>
        </table>`;
        let printWindow = window.open('', '', '');
        printWindow.document.title = 'TASK Report - PDF Export';
        printWindow.document.write(printContent);
        printWindow.document.close();
        printWindow.print();
    });

    $('#it_task_list').on('change', '.task-status-dropdown', function () {
        var task_status = $(this).val();
        var rowId = $(this).data('id');
        var emp_name = $(this).data('emp');
        $.ajax({
            url: "<?php echo base_url('update_task_status'); ?>",
            type: "POST",
            data: {
                id: rowId,
                task_status: task_status,
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
                    `Task status was successfully updated`,
                );
                $('#it_task_list').DataTable().ajax.reload(null, false);

            },
        });
    });


    $('#filter_team, #filter_module, #date_range_report').change(function () {
        table.ajax.reload();
    });
    

    $.ajax({
        url: '<?php echo base_url('get_team') ?>',
        type: 'POST',
        success: function (response) {
            teamData = JSON.parse(response);
            $('#team, #filter_team, #edit_team').empty().append('<option value="">Select Team Name</option>');
            teamData.forEach(function (team) {
                $('#team, #filter_team, #edit_team').append('<option value="' + team.team_id + '">' + team.team_name + '</option>');
            });
        }
    });

    let membersData = [];
    $('#name, #edit_name').prop('disabled', true);

    $('#team, #edit_team').change(function () {
        var team_id = $(this).val();
        $.ajax({
            url: '<?php echo base_url('setup_workload') ?>',
            type: 'POST',
            data: { team_id: team_id },
            success: function (response) {
                membersData = JSON.parse(response);
                $('#name, #edit_name').empty().append('<option value="">Select Name</option>');
                $('#name, #edit_name').prop('disabled', true);

                if (membersData.length > 0) {
                    membersData.forEach(function (member) {
                        $('#name, #edit_name').append('<option value="' + member.emp_id + '">' + member.emp_name + '</option>');
                    });

                    $('#name, #edit_name').prop('disabled', false);
                }
            }
        });
    });

    $('#name, #edit_name').change(function () {
        var selectedEmpId = $(this).val();
        var selectedMember = membersData.find(member => member.emp_id == selectedEmpId);

        if (selectedMember) {
            $('#emp_id, #edit_emp_id').val(selectedEmpId);
        } else {
            $('#emp_id, #edit_emp_id').val(''); 
        }
    });

    $.ajax({
        url: '<?php echo base_url('setup_module') ?>',
        type: 'POST',
        success: function (response) {
            moduleData = JSON.parse(response);
            $('#module, #edit_module').empty().append('<option value="">Select Module Name</option>');
            $('#sub_module, #edit_sub_module').empty().append('<option value="">Select Sub Module</option>');
            $('#sub_module, #edit_sub_module').prop('disabled', true);

            moduleData.forEach(function (module) {
                $('#filter_module, #module, #edit_module').append('<option value="' + module.mod_id + '">' + module.mod_name + '</option>');
            });
        }
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

    $('#create_task').on('hidden.bs.modal', function () {
        $('#team').val('').trigger('change');
        $('#module').val('').trigger('change');
        $('#sub_module').val('').trigger('change');
        $('#emp_id').val('');
        $('#desc').val('');
        $('#concern').val('');
        $('#remarks').val('');
        $('#task_status').val('').trigger('change');
    });

    function submit_task() {

        var emp_name       = $('#name option:selected').text();
        var team            = $('#team').val();
        var emp_id          = $('#emp_id').val();
        var module          = $('#module').val();
        var sub_module      = $('#sub_module').val();
        var desc            = $('#desc').val();
        var concern         = $('#concern').val();
        var remarks         = $('#remarks').val();
        var status          = $('#task_status').val();

        if (team === "" || module === "" || desc === "" || concern === "" || status === "") {
            toastr.options = {
                progressBar: true,
                positionClass: "toast-top-left",
                timeOut: 5000,
                extendedTimeOut: 2000,
                
            };

            toastr.info(
                `Please fill up the required fields`,
            );
            if (desc === "" || concern === "" || status === "") {
                $('#desc, #concern, #remarks, #task_status').each(function () {
                    if ($(this).val() === '') {
                        $(this).addClass('is-invalid');
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });
            }
            return;
        }

        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to add this task?',
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
                    url: '<?php echo base_url('submit_task') ?>',
                    type: 'POST',
                    data: {
                        team: team,
                        emp_name: emp_name,
                        emp_id: emp_id,
                        module: module,
                        sub_module: sub_module,
                        desc: desc,
                        concern: concern,
                        remarks: remarks,
                        task_status: status
                    },
                    success: function (response) {
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 5000,
                            extendedTimeOut: 2000,
                            
                        };

                        toastr.success(
                            `Task was successfully added`,
                        );
                        $('#create_task').modal('hide');
                        var table = $('#it_task_list').DataTable();
                        var currentPage = table.page();

                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                        }, false);
                    }
                });
            }
        });
    }

    function edit_task_content(task_id) {
        $.ajax({
            url: '<?php echo base_url('edit_task_content') ?>',
            type: 'POST',
            data: { task_id: task_id },
            success: function (response) {
                let data = JSON.parse(response);

                $('#edit_team').val(data.team_id).trigger('change');
                $('#edit_id').val(data.task_id);
                $('#edit_task').modal('show');
                setTimeout(function () {
                    $('#edit_emp_id').val(data.emp_id);
                    $('#edit_name').val(data.emp_id).trigger('change');
                    $('#edit_module').val(data.mod_id).trigger('change');
                    $('#edit_sub_module').val(data.sub_mod_id).trigger('change');
                    $('#edit_desc').val(data.desc);
                    $('#edit_concern').val(data.concerns);
                    $('#edit_remarks').val(data.remarks);
                    $('#edit_task_status').val(data.task_status).trigger('change');
                }, 500);
            }
        });
    }

    function update_task_content(){
        var team            = $('#edit_team').val();
        var task_id         = $('#edit_id').val();
        var emp_name        = $('#edit_name option:selected').text();
        var emp_id          = $('#edit_emp_id').val();
        var module          = $('#edit_module').val();
        var sub_module      = $('#edit_sub_module').val();
        var desc            = $('#edit_desc').val();
        var concern         = $('#edit_concern').val();
        var remarks         = $('#edit_remarks').val();
        var task_status     = $('#edit_task_status').val();
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to update this task?',
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
                    url: '<?php echo base_url('update_task_content') ?>',
                    type: 'POST',
                    data: {
                        team: team,
                        task_id: task_id,
                        emp_name: emp_name,
                        emp_id: emp_id,
                        module: module,
                        sub_module: sub_module,
                        desc: desc,
                        concern: concern,
                        remarks: remarks,
                        task_status: task_status
                    },
                    success: function (response) {
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 5000,
                            extendedTimeOut: 2000,
                            
                        };

                        toastr.success(
                            `Task was successfully updated`,
                        );
                        $('#edit_task').modal('hide');
                        var table = $('#it_task_list').DataTable();
                        var currentPage = table.page();

                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                        }, false);
                    }
                });
            }
        });
    }
    function delete_task(task_id){
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to delete this task?',
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
                    url: '<?php echo base_url('delete_task') ?>',
                    type: 'POST',
                    data: { task_id: task_id },
                    success: function (response) {
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 5000,
                            extendedTimeOut: 2000,
                            
                        };

                        toastr.success(
                            `Task was successfully deleted`,
                        );
                        var table = $('#it_task_list').DataTable();
                        var currentPage = table.page();

                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                        }, false);
                    }
                });
            }
        })
    }
</script>