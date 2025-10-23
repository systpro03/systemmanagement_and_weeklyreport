<div class="modal fade" id="add_server" tabindex="-1" aria-labelledby="add_server" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title">Setup Server</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row mb-3">
                        <label for="team" class="col-sm-3 col-form-label">Team Name:</label>
                        <div class="col-sm-9">
                            <select class="form-select" id="team">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="module" class="col-sm-3 col-form-label">Module:</label>
                        <div class="col-sm-9">
                            <select class="form-select select2" id="module"></select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="details" class="col-sm-3 col-form-label">Details:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="details" autocomplete="off">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="server" class="col-sm-3 col-form-label">Server:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="server" autocomplete="off">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="db_name" class="col-sm-3 col-form-label">Database Name:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="db_name" autocomplete="off">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="username" class="col-sm-3 col-form-label">Username:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="username" autocomplete="off">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password" class="col-sm-3 col-form-label">Password:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="password" autocomplete="off">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="location" class="col-sm-3 col-form-label">Backup Location:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="location" autocomplete="off">
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="submit_server()">Submit</button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Edit Server Modal -->
<div class="modal fade" id="editServerModal" tabindex="-1" aria-labelledby="editServerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable"">
        <div class=" modal-content">
        <div class="modal-header bg-info-subtle">
            <h5 class="modal-title">Edit Server</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="editServerForm">
                <div class="row mb-3">
                    <label for="team" class="col-sm-3 col-form-label">Team Name:</label>
                    <div class="col-sm-9">
                        <select class="form-select" id="edit_t">
                            <option value=""></option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="module" class="col-sm-3 col-form-label">Module:</label>
                    <div class="col-sm-9">
                        <select class="form-select select2" id="edit_module"></select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="server" class="col-sm-3 col-form-label">Details:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="edit_details" autocomplete="off">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="server" class="col-sm-3 col-form-label">Server:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="edit_server" autocomplete="off">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="db_name" class="col-sm-3 col-form-label">Database Name:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="edit_db_name" autocomplete="off">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="username" class="col-sm-3 col-form-label">Username:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="edit_username" autocomplete="off">
                        <input type="hidden" class="form-control" id="edit_id">

                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="password" class="col-sm-3 col-form-label">Password:</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="edit_password" autocomplete="off">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="location" class="col-sm-3 col-form-label">Location:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="edit_location" autocomplete="off">
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="update_server()">Save changes</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
</div>
</div>



<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Server Address </h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Server </a></li>
                        <li class="breadcrumb-item active">Index<i class="mdi mdi-alpha-x-circle:"></i></li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-end">
                    <div class="col-md-5">
                        <div class="d-flex align-items-center mx-2 gap-2">
                            <select class="form-select" id="team_filter">
                                <option value="">Select Team</option>
                            </select>
                            <select class="form-select" id="module_filter">
                                <option value="">Select Module</option>
                            </select>
                            <?php if ($this->session->userdata('position') == 'System Analyst') { ?>
                                <button class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal"
                                    data-bs-target="#add_server"><i class="ri-add-fill align-bottom me-3"></i> </button>
                            <?php } ?>
                        </div>
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
                                Module</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="2" checked>
                                Details</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="3" checked>
                                Server</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="4" checked>
                                Database Name</label></li>
                        <!-- <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="5" checked>
                                Username</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="6" checked>
                                Password</label></li> -->
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="5" checked>
                                Backup Location</label></li>


                        <?php
                        if ($this->session->userdata('position') != 'Manager' && $this->session->userdata('position') != 'Programmer') { ?>
                            <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="6" checked>
                                    Action</label></li>
                            <?php
                        }
                        ?>
                    </ul>
                    <button id="generate_report" class="btn btn-danger btn-sm ms-1">Generate Report</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered dt-responsive table-hover compact"
                        id="server_list">
                        <thead class="table-dark text-uppercase">
                            <tr>
                                <th width="15%">Team</th>
                                <th width="25%">Module / Project</th>
                                <th width="10%">Details</th>
                                <th width="10%">Server</th>
                                <th width="10%">Database Name</th>
                                <!-- <th>Username</th>
                                <th>Password</th> -->
                                <th width="15%">Backup Location</th>
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
<style>
    tbody tr {
        color: black !important;
    }
</style>
<script>
    $(document).ready(function () {
        $('#team_filter, #team, #edit_t').select2({ placeholder: 'Select Team', allowClear: true, minimumResultsForSearch: Infinity });
        $('#module_filter, #module, #edit_module').select2({ placeholder: 'Select Module Name', allowClear: true });
    });
        var table = null;
        var printWindow = null;
        if (table) {
            table.destroy();
        }
        table = $('#server_list').DataTable({
            "processing": true,
            "serverSide": true,
            "destroy": true,
            "lengthMenu": [[10, 25, 50, 500, 10000], [10, 25, 50, 500, "Max"]],
            "pageLength": 500,
            "ajax": {
                "url": '<?php echo base_url('server_list'); ?>',
                "type": 'POST',
                "data": function (d) {
                    d.team = $('#team_filter').val();
                    d.module = $('#module_filter').val();
                },
            },
            "columns": [
                { "data": 'team' },
                { "data": 'module' },
                { "data": 'details' },
                { "data": 'server' },
                { "data": 'database' },
                // { "data": 'username' },
                // { "data": 'password' },
                { "data": 'location' },
                {
                    "data": "action",
                    "visible": <?= ($_SESSION['position'] != 'Programmer' && $_SESSION['position'] != 'Manager') ? 'true' : 'false'; ?>
                }
                // {
                //     "data": 'action',
                //     "visible": <?= ($_SESSION['is_admin'] == 'Yes') ? 'true' : 'false'; ?>
                // },
            ],
            rowCallback: function (row, data) {
                if (data.team_color) {
                    $(row).css('background-color', getColorCode(data.team_color));
                }
            },
            "paging": true,
            "searching": true,
            "ordering": true,
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
            <div style="text-align: center; margin-bottom: 20px;"><h4>LIST OF SERVER ADDRESS SETUP</h4></div>
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
            printWindow.document.title = 'SERVER-LIST - PDF Export';
            printWindow.document.write(printContent);
            printWindow.document.close();
            printWindow.print();
        });

        $.ajax({
            url: '<?php echo base_url('Admin/get_team5') ?>',
            type: 'POST',
            success: function (response) {
                teamData = JSON.parse(response);
                $('#team, #team_filter, #edit_t').empty().append('<option value="">Select Team Name</option>');
                teamData.forEach(function (team) {
                    $('#team, #team_filter, #edit_t').append('<option value="' + team.team_id + '">' + team.team_name + '</option>');
                });
            }
        });

        loadModule();
        function loadModule() {
            $.ajax({
                url: '<?php echo base_url('Admin/setup_module_dat5') ?>',
                type: 'POST',
                data: {
                    team: $('#team').val() || $('#team_filter').val() || $('#edit_t').val(),
                },
                success: function (response) {
                    moduleData = JSON.parse(response);
                    $('#module, #edit_module, #module_filter').empty().append('<option value="">Select Module Name</option>');
                    moduleData.forEach(function (module) {
                        $('#module, #edit_module, #module_filter').append('<option value="' + module.mod_id + '">' + module.mod_name + '</option>');
                    });
                }
            });
        }
        $('#team_filter, #team, #edit_t').change(function () {
            loadModule();
        });

        $('#team_filter, #module_filter').change(function () {
            table.ajax.reload();
        });

        function getColorCode(className) {
            const colors = {
                'bg-color-1': 'rgb(211, 240, 255)',   // Soft Sky Blue
                'bg-color-2': 'rgb(221, 251, 224)',   // Soft Mint Green
                'bg-color-3': 'rgb(251, 235, 203)',   // Warm Beige
                'bg-color-4': 'rgb(255, 223, 230)',   // Soft Rose Pink
                'bg-color-5': 'rgb(238, 222, 255)',   // Lilac Lavender
                'bg-color-6': 'rgb(224, 255, 255)',   // Pale Cyan
                'bg-color-7': 'rgb(250, 250, 210)',   // Light Lemon Yellow
                'bg-color-8': 'rgb(240, 248, 255)',   // Alice Blue
                'bg-color-9': 'rgb(253, 245, 230)',   // Eggshell
            };
            return colors[className] || '#ffffff';
        }


    // });

</script>
<script>

    function submit_server() {
        var team = $('#team').val();
        var module = $('#module').val();
        var details = $('#details').val();
        var server = $('#server').val();
        var db_name = $('#db_name').val();
        var username = $('#username').val();
        var password = $('#password').val();
        var location = $('#location').val();

        if (team == '' || module == '' || server == '' || db_name == '' || username == '' || password == '') {
            toastr.options = {
                progressBar: true,
                positionClass: "toast-top-left",
                timeOut: 5000,
                extendedTimeOut: 2000,

            };
            toastr.info(
                `Please fill up the required fields`,
            );

            $('#team, #module, #server, #name, #db_name, #username, #password').each(function () {
                if ($(this).val() === '') {
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });
            return;
        }

        Swal.fire({
            title: 'Submit Server',
            text: 'Are you sure you want to submit server?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, submit it!',
            cancelButtonText: 'No, cancel!',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo base_url('submit_server') ?>',
                    type: 'POST',
                    data: {
                        team: team,
                        module: module,
                        details: details,
                        server: server,
                        db_name: db_name,
                        username: username,
                        password: password,
                        location: location
                    },
                    success: function (response) {
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 5000,
                            extendedTimeOut: 2000,

                        };
                        toastr.success(
                            `Server data submitted successfully`,
                        );
                        $('#server_list').DataTable().ajax.reload();
                        $('#add_server').modal('hide');

                    }
                });
            }
        });

    }

    function edit_server(server_id) {
        $.ajax({
            url: '<?php echo base_url('edit_server') ?>',
            type: 'POST',
            data: { id: server_id },
            success: function (response) {
                let data = JSON.parse(response);
                $('#edit_t').val(data.team).trigger('change');
                $('#edit_id').val(data.server_id);

                setTimeout(function () {
                    $('#edit_module').val(data.module).trigger('change');
                    $('#edit_server').val(data.server);
                    $('#edit_details').val(data.details);
                    $('#edit_db_name').val(data.db_name);
                    $('#edit_username').val(data.username);
                    $('#edit_password').val('');
                    // $('#edit_password').val(data.password);
                    $('#edit_location').val(data.location);
                }, 300);
            },
        });
    }

    $('#add_server').on('hidden.bs.modal', function () {
        $('#team').val('').trigger('change');
        $('#module').val('').trigger('change');
        $('#details').val('');
        $('#server').val('');
        $('#db_name').val('');
        $('#username').val('');
        $('#password').val('');
        $('#location').val('');
    });

    function update_server() {
        var id = $('#edit_id').val();
        var team = $('#edit_t').val();
        var module = $('#edit_module').val();
        var details = $('#edit_details').val();
        var server = $('#edit_server').val();
        var db_name = $('#edit_db_name').val();
        var username = $('#edit_username').val();
        var password = $('#edit_password').val();
        var location = $('#edit_location').val();

        Swal.fire({
            title: 'Update Server',
            text: 'Are you sure you want to update server?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update it!',
            cancelButtonText: 'No, cancel!',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo base_url('update_server') ?>',
                    type: 'POST',
                    data: {
                        id: id,
                        team: team,
                        module: module,
                        details: details,
                        server: server,
                        db_name: db_name,
                        username: username,
                        password: password,
                        location: location
                    },
                    success: function (response) {
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 5000,
                            extendedTimeOut: 2000,

                        };
                        toastr.success(
                            `Server data was updated successfully`,
                        );
                        $('#server_list').DataTable().ajax.reload();
                        $('#editServerModal').modal('hide');

                    }
                });
            }
        })

    }

    function delete_server(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to delete this server data?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo base_url('delete_server') ?>',
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
                            `Server Data was successfully deleted`,
                        );
                        var table = $('#server_list').DataTable();
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