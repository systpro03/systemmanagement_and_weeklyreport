
<div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="create_kpiLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title" id="varyingcontentModalLabel">SETUP USER : <soan id="emp_name"></soan></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="title" class="col-form-label">Team <span class="text-danger">*</span> :</label>
                    <input type="hidden" class="hidden" id="emp_id">
                    <select class="form-select mb-3" id="team_id" style="width: 100%; height: 508px">
                        <option value=""></option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="type" class="col-form-label">Position <span class="text-danger">*</span> :</label>
                    <select class="form-select mb-3" id="type">
                        <option></option>
                        <option value="System Analyst">SYSTEM ANALYST</option>
                        <option value="Programmer">PROGRAMMER</option>
                        <option value="RMS">RMS</option>
                        <option value="Manager">MANAGER</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="type" class="col-form-label">Contact Number | Fb Account <span class="text-danger">( If available )</span> :</label>
                    <input type="text" class="form-control" id="contact_no" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="type" class="col-form-label">IP Address <span class="text-danger">( If available )</span> :</label>
                    <input type="text" class="form-control" id="ip_address" autocomplete="off">
                </div>


                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="parttimeCheckbox" value="Parttime">
                    <label class="form-check-label fw-6" for="parttimeCheckbox"> Check ( <iconify-icon icon="line-md:check-all" class="align-bottom fs-22"></iconify-icon> ) if part time in the selected team. <span class="text-danger">*</span> </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="insertUser()">Submit</button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="updateUser" tabindex="-1" aria-labelledby="create_kpiLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title" id="varyingcontentModalLabel">UPDATE USER <soan id="edit_emp_name"></soan></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="type" class="col-form-label">Employee Name :</label>
                    <input type="text" class="form-control" id="emp_name_data_edit" disabled
                <div class="mb-3">
                    <label for="title" class="col-form-label">Team:</label>
                    <input type="hidden" class="hidden" id="edit_id">
                    <select class="form-select mb-3" id="edit_team_id" style="width: 100%; height: 508px">
                        <option value=""></option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="type" class="col-form-label">Position:</label>
                    <select class="form-select mb-3" id="edit_type">
                        <option></option>
                        <option value="System Analyst">SYSTEM ANALYST</option>
                        <option value="Programmer">PROGRAMMER</option>
                        <option value="RMS">RMS</option>
                        <option value="Manager">Manager</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="type" class="col-form-label">Position:</label>
                    <select class="form-select mb-3" id="edit_parttime">
                        <option></option>
                        <option value="Parttime">Part Time</option>
                        <option value="Fulltime">Full Time</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="type" class="col-form-label">Contact Number | Fb Account <span class="text-danger">( If available )</span> :</label>
                    <input type="text" class="form-control" id="edit_contact_no" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="type" class="col-form-label">IP Address <span class="text-danger">( If available )</span> :</label>
                    <input type="text" class="form-control" id="edit_ip_address" autocomplete="off">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="updateUser()">Submit</button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Admin Setup </h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">User </a></li>
                        <li class="breadcrumb-item active">Index<i class="mdi mdi-alpha-x-circle:"></i></li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="col-xl-12">
        <div class="card">
            <div class="card-header border-1">
                <div class="d-flex align-items-center">
                    <h5 class="card-title mb-0 flex-grow-1"></h5>
                    <div class="flex-shrink-0">
                        <div class="d-flex gap-3 align-items-start flex-grow-1">
                            <select class="form-select" id="filter_team" style="width: auto; height: auto;">
                                <option value=""></option>
                            </select>
                            <input type="search" class="form-control" id="search" name="search"
                                style="width: 500px;" placeholder="Search Employee to add..." autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="dropdown">
                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="columnDropdown" data-bs-toggle="dropdown" aria-expanded="false"> Column Visibility</button>
                    <ul class="dropdown-menu" aria-labelledby="columnDropdown" id="columnSelectorDropdown" data-simplebar style="max-height: 300px;">
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="0" checked> Team</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="1" checked> Emp ID</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="2" checked> Employee Name</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="3" checked> Contact Number</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="4" checked> Position</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="5" checked> Type</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="6" checked> Action</label></li>
                    </ul>
                    <button id="generate_report" class="btn btn-danger btn-sm ms-1">Generate Report</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped dt-responsive table-hover compact" id="user_list">
                        <thead class="table-info text-uppercase">
                            <tr>
                                <th>Team</th>
                                <th>Emp ID</th>
                                <th>Employee</th>
                                <th>Contact</th>
                                <th>IP Address</th>
                                <!-- <th>Position</th> -->
                                <th>Type</th>
                                <th class="text-center">Admin</th>
                                <th class="text-center">Supervisor</th>
                                <th class="text-center">Managers Key</th>
                                <th width="10%">Action</th>
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
        $('#team_id, #filter_team, #edit_team_id').select2({
            placeholder: 'Select Team',
            allowClear: true,
            minimumResultsForSearch: Infinity
        });
        $('#type, #edit_type').select2({
            placeholder: 'Position',
            allowClear: true,
            minimumResultsForSearch: Infinity
        });
        $('#edit_parttime').select2({
            placeholder: 'Type',
            allowClear: true,
            minimumResultsForSearch: Infinity
        });
    });

    $.ajax({
        url: '<?php echo base_url('Admin/get_team_current') ?>',
        type: 'POST',
        success: function (response) {
            teamData = JSON.parse(response);
            $('#filter_team, #team_id, #edit_team_id').empty().append('<option value="">Select Team Name</option>');
            teamData.forEach(function (team) {
                $('#filter_team, #team_id, #edit_team_id').append('<option value="' + team.team_id + '">' + team.team_name + '</option>');
            });
        }
    });
    var table = null;
    var printWindow = null; 
    $(document).ready(function () {
        if (table) {
            table.destroy();
        }
        table = $('#user_list').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            // "stateSave": true,
            "destroy": true,
            // "scrollY": "400px",
            // "scrollX": true,
            // "scrollCollapse": true,
            "lengthmenu": [[10, 25, 50, 100, 10000], [10, 25, 50, 100, "Max"]],
            "pageLength": 10,
            // "stateSave": true,
            "ajax": {
                "url": '<?php echo base_url('user_list'); ?>',
                "type": 'POST',
                "data": function (d) {
                    d.filter_team = $('#filter_team').val();
                }
            },
            "columns": [
                { "data": 'team_name' },
                { "data": 'emp_id' },
                { "data": 'name' },
                { "data": 'contact_no' },
                { "data": 'ip_address' },
                // { "data": 'position' },
                { "data": 'type' },
                { "data": 'is_admin' },
                { "data": 'is_supervisor' },
                { "data": "is_manager_key" },
                { "data": 'action' }
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
        $('#generate_report').on('click', function () {

            if (printWindow && !printWindow.closed) {
                return;
            }

            let visibleColumns = [];
            let visibleHeaders = [];
            let desc = -1;
            table.columns().every(function (index) {
                let headerText = this.header().textContent.trim();
                if (this.visible() && headerText.toLowerCase() !== 'action') {
                    visibleColumns.push(index);
                    visibleHeaders.push(headerText);
                    if (headerText.toLowerCase() === 'position') {
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
            <div style="text-align: center; margin-bottom: 20px;"><h4>LIST OF USERS</h4></div>
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
            printWindow = window.open('', '', '');
            printWindow.document.title = 'USERS LIST - PDF Export';
            printWindow.document.write(printContent);
            printWindow.document.close();
            printWindow.print();
        });


        $('#filter_team').change(function () {
            table.ajax.reload();
        });
    });


    $("input[name='search']").autocomplete({
        source: function (request, response) {
            $.get("<?php echo base_url('search'); ?>", {
                query: request.term
            }, function (data) {
                data = JSON.parse(data);
                response(data);
            });
        },
    }).data("ui-autocomplete")._renderItem = function (ul, item) {
        var listItem = $("<li>").append(
            $("<div>").css({
                "font-family": "Inter-Regular, sans-serif",
            }).html(`${item.emp_id} - ${item.name}`)
        );

        listItem.click(function () {
            var emp_id = item.emp_id;
            add_employee_access(emp_id);
        });

        return listItem.appendTo(ul);
    }.bind($("input[name='search']"));
    $("div.ui-helper-hidden-accessible[role='status']").hide();
    $("div.ui-menu ui-widget ui-widget-content ui-autocomplete ui-front").hide();


    $('#addUser').on('hidden.bs.modal', function () {
        $('#team_id').val('').trigger('change');
        $('#type').val('').trigger('change');
        $('#emp_id').val('');
        $('#contact_no').val('');
        $('#parttimeCheckbox').prop('checked', false);
    });

    function add_employee_access(emp_id) {
        $.ajax({
            url: '<?php echo base_url('emp_data') ?>',
            type: 'POST',
            data: { emp_id: emp_id },
            success: function (data) {
                var empData = JSON.parse(data);
                $('#emp_name').text(empData.name);
                $('#emp_id').val(empData.emp_id);
                $('#addUser').modal('show');
            },
        });
    }

    function insertUser() {
        var emp_id = $('#emp_id').val();
        var team_id = $('#team_id').val();
        var position = $('#type').val();
        var contact_no = $('#contact_no').val();
        var ip_address = $('#ip_address').val();
        var isParttimeChecked = $('#parttimeCheckbox').is(':checked') ? $('#parttimeCheckbox').val() : null;

        if(team_id == '' || position == ''){
            toastr.options = {
                progressBar: true,
                positionClass: "toast-top-left",
                timeOut: 5000,
                extendedTimeOut: 2000,
                preventDuplicates: true,
            };

            toastr.info(
                `Please fill up the required fields`,
            );

            $('#emp_id, #type').each(function () {
                if ($(this).val() === '') {
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });
            return false;
        }
        Swal.fire({
            title: 'Add User',
            text: 'Are you sure you want to add this user?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, add it!',
            cancelButtonText: 'No, cancel!',
            showLoaderOnConfirm: true,
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '<?php echo base_url('add_user') ?>',
                    type: 'POST',
                    data: {
                        emp_id: emp_id,
                        team_id: team_id,
                        position: position,
                        is_parttime: isParttimeChecked,
                        contact_no: contact_no,
                        ip_address: ip_address
                    },
                    success: function (data) {
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 5000,
                            extendedTimeOut: 2000,
                            preventDuplicates: true,
                        };

                        toastr.success(
                            `User was successfully added`,
                        );
                        $('#addUser').modal('hide');
                        var table = $('#user_list').DataTable();
                        var currentPage = table.page();

                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                        }, false);
                    }
                });
            }
        });
    }
    function update_user_content(id, name) {
        $('#emp_name_data_edit').val(name);
        $.ajax({
            url: '<?php echo base_url('update_user_content') ?>',
            type: 'POST',
            data: { id: id },
            success: function (response) {
                let data = JSON.parse(response);
                $('#edit_team_id').val(data.team_id).trigger('change');
                $('#edit_id').val(data.id);
                $('#edit_emp_name').val(data.name);
                $('#edit_contact_no').val(data.contact_no);
                $('#edit_ip_address').val(data.ip_address);
                $('#edit_type').val(data.position).trigger('change');
                $('#edit_parttime').val(data.type).trigger('change');
            }
        });
    }
    function updateUser() {
        var id          = $('#edit_id').val();
        var team_id     = $('#edit_team_id').val();
        var position    = $('#edit_type').val();
        var type        = $('#edit_parttime').val();
        var contact_no  = $('#edit_contact_no').val();
        var ip_address  = $('#edit_ip_address').val();
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to update this user data?',
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
                    url: '<?php echo base_url('update_user') ?>',
                    type: 'POST',
                    data: {
                        id: id,
                        team_id: team_id,
                        position: position,
                        type: type,
                        contact_no: contact_no,
                        ip_address: ip_address
                    },
                    success: function (data) {
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 5000,
                            extendedTimeOut: 2000,
                            preventDuplicates: true,
                        };

                        toastr.success(
                            `User was successfully updated`,
                        );
                        var table = $('#user_list').DataTable();
                        var currentPage = table.page();

                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                        }, false);
                        $('#updateUser').modal('hide');
                    }
                });
            }
        });
    }
    function reset_password(id, emp_id) {
        Swal.fire({
            title: 'Are you sure ',
            text: 'You want to reset this user password?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, reset it!',
            cancelButtonText: 'No, cancel!',
            showLoaderOnConfirm: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo base_url('reset_password') ?>',
                    type: 'POST',
                    data: { id: id, emp_id: emp_id },
                    success: function (data) {
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 5000,
                            extendedTimeOut: 2000,
                            preventDuplicates: true,
                        };

                        toastr.success(
                            `Password was successfully reset`,
                        );
                        var table = $('#user_list').DataTable();
                        var currentPage = table.page();

                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                        }, false);
                    }
                });
            }
        });
    }
    function update_admin_enable(id, emp_id) {
        let checkbox = event.target;

        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to set this user to have admin access?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, enable it!',
            cancelButtonText: 'No, cancel!',
            showLoaderOnConfirm: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo base_url('update_admin_enable') ?>',
                    type: 'POST',
                    data: { 
                        id: id,
                        emp_id: emp_id
                     },
                    success: function (data) {
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 5000,
                            extendedTimeOut: 2000,
                            preventDuplicates: true,
                        };

                        toastr.success('Admin access has been successfully added to this user.');
                        
                        var table = $('#user_list').DataTable();
                        var currentPage = table.page();

                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                        }, false);
                    }
                });
            } else {
                checkbox.checked = false;
            }
        });
    }

    function update_admin_disable(id, emp_id) {
        let checkbox = event.target;
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to remove this user\'s admin access?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, disable it!',
            cancelButtonText: 'No, cancel!',
            showLoaderOnConfirm: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo base_url('update_admin_disable') ?>',
                    type: 'POST',
                    data: { 
                        id: id,
                        emp_id: emp_id
                     },
                    success: function (data) {
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 5000,
                            extendedTimeOut: 2000,
                            preventDuplicates: true,
                        };

                        toastr.success('Admin access has been successfully removed.');
                        
                        var table = $('#user_list').DataTable();
                        var currentPage = table.page();

                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                        }, false);
                    }
                });
            } else {
                checkbox.checked = true;
            }
        });
    }

    function update_sup_enable(id, emp_id) {
        let checkbox = event.target;

        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to set this user to have supervisor access?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, enable it!',
            cancelButtonText: 'No, cancel!',
            showLoaderOnConfirm: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo base_url('Admin/update_sup_enable') ?>',
                    type: 'POST',
                    data: { 
                        id: id,
                        emp_id: emp_id
                     },
                    success: function (data) {
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 5000,
                            extendedTimeOut: 2000,
                            preventDuplicates: true,
                        };

                        toastr.success('Supervisor access has been successfully added to this user.');
                        
                        var table = $('#user_list').DataTable();
                        var currentPage = table.page();

                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                        }, false);
                    }
                });
            } else {
                checkbox.checked = false;
            }
        });
    }

    function update_sup_disable(id, emp_id) {
        let checkbox = event.target;
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to remove this user\'s admin access?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, disable it!',
            cancelButtonText: 'No, cancel!',
            showLoaderOnConfirm: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo base_url('Admin/update_sup_disable') ?>',
                    type: 'POST',
                    data: { 
                        id: id,
                        emp_id: emp_id
                     },
                    success: function (data) {
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 5000,
                            extendedTimeOut: 2000,
                            preventDuplicates: true,
                        };

                        toastr.success('Supervisor access has been successfully removed.');
                        
                        var table = $('#user_list').DataTable();
                        var currentPage = table.page();

                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                        }, false);
                    }
                });
            } else {
                checkbox.checked = true;
            }
        });
    }

    function update_key_enable(id, emp_id, emp_no) {
        let checkbox = event.target;

        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to set this user to have managers key access?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, enable it!',
            cancelButtonText: 'No, cancel!',
            showLoaderOnConfirm: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo base_url('Admin/update_key_enable') ?>',
                    type: 'POST',
                    data: { 
                        id: id,
                        emp_id: emp_id,
                        emp_no: emp_no
                     },
                    success: function (data) {
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 5000,
                            extendedTimeOut: 2000,
                            preventDuplicates: true,
                        };

                        toastr.success('Manager Key access has been successfully added to this user.');
                        
                        var table = $('#user_list').DataTable();
                        var currentPage = table.page();

                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                        }, false);
                    }
                });
            } else {
                checkbox.checked = false;
            }
        });
    }

    function update_key_disable(id, emp_id, emp_no) {
        let checkbox = event.target;
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to remove this user\'s managers key access?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, disable it!',
            cancelButtonText: 'No, cancel!',
            showLoaderOnConfirm: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo base_url('Admin/update_key_disable') ?>',
                    type: 'POST',
                    data: { 
                        id: id,
                        emp_id: emp_id,
                        emp_no: emp_no
                     },
                    success: function (data) {
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 5000,
                            extendedTimeOut: 2000,
                            preventDuplicates: true,
                        };

                        toastr.success('Manager Key access has been successfully removed.');
                        
                        var table = $('#user_list').DataTable();
                        var currentPage = table.page();

                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                        }, false);
                    }
                });
            } else {
                checkbox.checked = true;
            }
        });
    }
    
    function delete_user(id){
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to delete this user access?',
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
                    url: '<?php echo base_url('delete_user') ?>',
                    type: 'POST',
                    data: { id: id },
                    success: function (data) {
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 5000,
                            extendedTimeOut: 2000,
                            preventDuplicates: true,
                        };

                        toastr.success(
                            `User was successfully removed.`,
                        );
                        var table = $('#user_list').DataTable();
                        var currentPage = table.page();

                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                        }, false);
                    }
                });
            }
        });
    }

</script>