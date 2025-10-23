<div class="modal fade zoomIn" id="setup_company_phone" tabindex="-1" aria-labelledby="add_module_msfl" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title">ADD COMPANY PHONE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row mb-2">
                        <label for="mod_name" class="col-sm-4 col-form-label">Description :</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="description" autocomplete="off">
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label for="mod_abbr" class="col-sm-4 col-form-label">Ip Phone | Contact:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="ip_phone" autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="add_company_phone()">Submit</button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade zoomIn" id="edit_setup_company_phone" tabindex="-1" aria-labelledby="add_module_msfl" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title">EDIT COMPANY PHONE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row mb-2">
                        <label class="col-sm-4 col-form-label">Description :</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="edit_description" autocomplete="off">
                            <input type="hidden" class="form-control" id="id">
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label class="col-sm-4 col-form-label">Ip Phone | Contact:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="edit_ip_phone" autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="submit_company_phone()">Submit</button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade zoomIn" id="setup_team" tabindex="-1" aria-labelledby="add_module_msfl" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title">ADD NEW TEAM</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row mb-2">
                        <label for="mod_name" class="col-sm-3 col-form-label">Team Name :</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="team_name" autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="add_team()">Submit</button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade zoomIn" id="edit_team" tabindex="-1" aria-labelledby="add_module_msfl" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title">EDIT TEAM NAME</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row mb-2">
                        <label class="col-sm-3 col-form-label">Team Name:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="edit_team_name" autocomplete="off">
                            <input type="hidden" class="form-control" id="id">
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label class="col-sm-3 col-form-label">STATUS:</label>
                        <div class="col-sm-9">
                            <select name="" id="edit_status" class="form-control">
                                <option value="Active">ACTIVE</option>
                                <option value="Inactive">INACTIVE</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="submit_team()">Submit</button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Company Phone | Team Name Setup</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Company Phone | Team Setup</a></li>
                        <li class="breadcrumb-item active">Index<i class="mdi mdi-alpha-x-circle:"></i></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xxl-6">
            <div class="card">
                <div class="card-header border-1">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1 fw-bold">Company Phone List</h5>
                        <button class="btn btn-primary waves-effect waves-light"  data-bs-toggle="modal"  data-bs-target="#setup_company_phone">
                            <i class="ri-add-fill align-bottom me-1 fs-12"></i> Setup Company Phone
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="mt-2 tab-pane active" role="tabpanel">
                            <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered compact" id="company_phone1">
                                <thead class="table-info text-center text-uppercase">
                                    <tr>
                                        <th>DESCRIPTION</th>
                                        <th>CONTACT NO. | IP PHONE</th>
                                        <th>ACTION</th>
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
        <div class="col-xxl-6">
            <div class="card">
                <div class="card-header border-1">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1 fw-bold">Team List</h5>
                        <button class="btn btn-primary waves-effect waves-light"  data-bs-toggle="modal"  data-bs-target="#setup_team" title="Setup Team Name"  id="tooltipButton">
                            <i class="ri-add-fill align-bottom me-1 fs-12"></i> Setup Team Name
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="mt-2 tab-pane active" role="tabpanel">
                            <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered compact" id="team_list">
                                <thead class="table-info text-center text-uppercase">
                                    <tr>
                                        <th>TEAM NAME</th>
                                        <th>STATUS</th>
                                        <th>ACTION</th>
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
</div>

<script>
    $('#company_phone1').DataTable({
        "processing": true,
        "serverSide": true,
        "destroy": true,
        "responsive": true,
        "lengthMenu": [[10, 25, 50, 100, 10000], [10, 25, 50, 100, "Max"]],
        "pageLength": 10,
        "ajax": {
            url: '<?php echo base_url('list_company_phone'); ?>',
            type: 'POST',
        },
        "columns": [
            { "data": 'team' },
            { "data": 'ip_phone'},
            { "data": 'action',}
        ],
        "columnDefs": [
            { "className": "text-start", "targets": ['_all'] },
        ],
    });
    function add_company_phone(){
        var desc = $('#description').val();
        var ip   = $('#ip_phone').val();
        if(desc == '' || ip == ''){ 
            toastr.options = {
                progressBar: true,
                positionClass: "toast-top-left",
                timeOut: 5000,
                extendedTimeOut: 2000,
                preventDuplicates: true,
            };

            toastr.error(
                `Please fill in the required fields.`,
            );
            $('#description, #ip_phone').each(function () {
                if ($(this).val() === '') {
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });
            return false; 
        }
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to add this contact number?',
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
                    url: '<?php echo base_url('add_company_phone') ?>',
                    type: 'POST',
                    data: { 
                        description: desc,
                        ip_phone: ip
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
                            `Company phone was successfully added.`,
                        );
                        $('#setup_company_phone').modal('hide');
                        load_company();
                        var table = $('#company_phone1').DataTable();
                        var currentPage = table.page();

                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                        }, false);
                    }
                });
            }
        });
    }
    function edit_company_phone(id, team, ip_phone){
        $('#edit_description').val(team);
        $('#edit_ip_phone').val(ip_phone);
        $('#id').val(id);
    }
    function submit_company_phone(){
        var id          = $('#id').val();
        var team        = $('#edit_description').val();
        var ip_phone    = $('#edit_ip_phone').val();
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to update this contact number?',
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
                    url: '<?php echo base_url('update_company_phone') ?>',
                    type: 'POST',
                    data: { 
                        id: id,
                        description: team,
                        ip_phone: ip_phone
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
                            `Company phone was successfully updated.`,
                        );
                        $('#edit_setup_company_phone').modal('hide');
                        load_company();
                        var table = $('#company_phone1').DataTable();

                        var currentPage = table.page();

                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                        }, false);
                    }
                });
            }
        });
    }
    function delete_company_phone(id){
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to remove this contact number?',
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
                    url: '<?php echo base_url('delete_company_phone') ?>',
                    type: 'POST',
                    data: { 
                        id: id
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
                            `Company phone was successfully removed.`,
                        );
                        var table = $('#company_phone').DataTable();
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

<script>
    $('#team_list').DataTable({
        "processing": true,
        "serverSide": true,
        "destroy": true,
        "responsive": true,
        "lengthMenu": [[10, 25, 50, 100, 10000], [10, 25, 50, 100, "Max"]],
        "pageLength": 10,
        "ajax": {
            url: '<?php echo base_url('team_list'); ?>',
            type: 'POST',
        },
        "columns": [
            { "data": 'team_name' },
            { "data": 'status'},
            { "data": 'action',}
        ],
        "columnDefs": [
            { "className": "text-start", "targets": ['_all'] },
        ],
    });
    function add_team(){
        var team        = $('#team_name').val();
        var status      = 'Active';
        if(team == ''){
            toastr.options = {
                progressBar: true,
                positionClass: "toast-top-left",
                timeOut: 5000,
                extendedTimeOut: 2000,
                preventDuplicates: true,
            };
            toastr.error('Please enter team name.');
            $('#team_name').each(function () {
                if ($(this).val() === '') {
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });
            return false;
        }
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to add this new team?',
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
                    url: '<?php echo base_url('add_team') ?>',
                    type: 'POST',
                    data: { 
                        team: team,
                        status: status
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
                            `New team was successfully added.`,
                        );
                        $('#setup_team').modal('hide');
                        var table = $('#team_list').DataTable();
                        var currentPage = table.page();

                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                        }, false);
                    }
                });
            }
        });
    }
    function edit_team(id, team_name, status){
        $('#edit_team_name').val(team_name);
        $('#edit_status').val(status);
        $('#id').val(id);
    }
    function submit_team(){
        var id          = $('#id').val();
        var team        = $('#edit_team_name').val();
        var status      = $('#edit_status').val();
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to update this team name?',
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
                    url: '<?php echo base_url('update_team') ?>',
                    type: 'POST',
                    data: { 
                        id: id,
                        team: team,
                        status: status
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
                            `Team name was successfully updated.`,
                        );
                        $('#edit_setup_team').modal('hide');
                        var table = $('#team_list').DataTable();

                        var currentPage = table.page();

                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                        }, false);
                    }
                });
            }
        });
    }
    function delete_team(id){
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to remove this team name?',
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
                    url: '<?php echo base_url('delete_team') ?>',
                    type: 'POST',
                    data: { 
                        id: id
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
                            `Team name was successfully removed.`,
                        );
                        var table = $('#team_list').DataTable();
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