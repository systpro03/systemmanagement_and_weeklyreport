<div class="modal fade zoomIn" id="filePreviewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <h5 class="modal-title" id="previewModalLabel">File Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

            </div>
            <div class="modal-body mt-2">
                <!-- iframe injected here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#show_data_in_directory">Back
                    to List</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade zoomIn" id="show_uploaded_documents" tabindex="-1" aria-labelledby="show_uploaded_documents"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" style="width: 655px">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title" id="module_name"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table id="show_uploaded_documents_table" class="table table-striped table-bordered compact">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>Directory Name</th>
                            <th>Status</th>
                            <th>Show Files</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-dark" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade zoomIn" id="show_data_in_directory" tabindex="-1" aria-labelledby="show_data_in_directory"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title" id="directory_module_name"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <small class="text-info d-block fst-italic mt-1 fs-14">
                    <i class="ri-information-line me-1"></i>
                    <strong>Note:</strong> Just click on the file status to preview the file.
                </small>
                <div class="table-responsive">
                    <table id="show_data" class="table table-striped table-bordered compact" width="100%">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>File Name [ <span class="text-danger">click to show</span> ] </th>
                                <th>Original Filename</th>
                                <!-- <th>Status</th> -->
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                    data-bs-target="#show_uploaded_documents">Back To List</button>
                <button type="button" class="btn btn-sm btn-dark" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade zoomIn" id="view_dept_implemented_modules" tabindex="-1" aria-labelledby="view_dept_implemented_modules"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title" id="mod_name"></h5>
                <input type="hidden" id="mod_id">
                <input type="hidden" id="sub_mod_id">
                <input type="hidden" id="id">
                <input type="hidden" id="tos">
            </div>
            <div class="modal-body">
                <div class="d-flex align-items-center justify-content-end mb-3">
                    <div class="col-md-12">
                        <div class="d-flex align-items-center mx-2 gap-2">
                            <select class="form-select" id="coFilter" name="coFilter">
                                <option value=""></option>
                            </select>
                            <select class="form-select" id="buFilter" name="buFilter">
                                <option value=""></option>
                            </select>
                            <select class="form-select" id="departmentFilter" name="departmentFilter">
                                <option value=""></option>
                            </select>
                            <select class="form-select" id="team_filter">
                                <option value="">Select Team</option>
                            </select>
                            <!-- <button class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#create_module"><i class="ri-add-fill align-bottom me-5"></i> </button> -->
                        </div>
                    </div>
                </div>

                <div class="dropdown">
                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="columnDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false"> Column Visibility</button>
                    <ul class="dropdown-menu" aria-labelledby="columnDropdown" id="columnSelectorDropdown"
                        data-simplebar style="max-height: 300px;">
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="0" checked>
                                Business unit</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="1" checked>
                                Sub Module</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="2" checked>
                                Date Requested</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="3" checked>
                                Date Implemented</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="4" checked>
                                Others</label></li>
                        <!-- <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="4" checked> Status</label></li> -->
                        <!-- <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="5" checked> Action</label></li> -->
                    </ul>
                    <button id="generate_report" class="btn btn-danger btn-sm ms-1">Generate Report</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover compact" id="view_dept_implemented_module">
                        <thead class="table-info text-center text-uppercase">
                            <tr>
                                <th width="20%">Business Unit</th>
                                <th>Sub Module</th>
                                <th>Date Requested</th>
                                <th>Date Parallel</th>
                                <th>Date Implemented</th>
                                <th width="25%">Others</th>
                                <!-- <th>Status</th> -->
                                <!-- <th>Action</th> -->
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
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Admin Setup </h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Admin </a></li>
                        <li class="breadcrumb-item active">Index<i class="mdi mdi-alpha-x-circle:"></i></li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header border-1">
                <div class="d-flex align-items-center justify-content-end">
                    <div class="col-md-3">
                        <div class="d-flex align-items-center mx-2 gap-2">
                            <select class="form-select" id="team_filter_module">
                                <option value="">Select Team</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <ul class="nav nav-pills arrow-navtabs nav-primary bg-light mb-4" role="tablist">
                    <li class="nav-item">
                        <a id="all" aria-expanded="false" class="nav-link active typeofsystem" data-bs-toggle="tab">
                            <span class="d-block d-sm-none"><iconify-icon icon="ri:list-settings-line"
                                    class="fs-25"></iconify-icon></span>
                            <span class="d-none d-sm-block">All Module | System</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a id="current" aria-expanded="false" class="nav-link typeofsystem" data-bs-toggle="tab">
                            <span class="d-block d-sm-none"><iconify-icon icon="ri:list-settings-line"
                                    class="fs-25"></iconify-icon></span>
                            <span class="d-none d-sm-block">Current Module | System</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a id="new" aria-expanded="true" class="nav-link typeofsystem" data-bs-toggle="tab">
                            <span class="d-block d-sm-none"><iconify-icon icon="ri:chat-new-fill"
                                    class="fs-25"></iconify-icon></span>
                            <span class="d-none d-sm-block">New Module | System <span
                                    class="badge badge-pill bg-danger mcount" style="display: none;"></span></span>
                        </a>
                    </li>
                </ul>
                <hr>
                <table class="table table-bordered" id="admin_module_list">
                    <thead class="table-info">
                        <tr>
                            <th width="10%">Team Name</th>
                            <th>Module Name</th>
                            <th>Module Abbreviation</th>
                            <th>Module Status</th>
                            <th>Current | New</th>
                            <th width="30%">Module Description</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {
        $('#coFilter, #company, #company1').select2({ placeholder: 'Select Company', allowClear: true, minimumResultsForSearch: Infinity });
        $('#buFilter, #business_unit, #business_unit1').select2({ placeholder: 'Select Business Unit', allowClear: true, minimumResultsForSearch: Infinity });
        $('#departmentFilter, #department, #department1').select2({ placeholder: 'Select Department', allowClear: true, minimumResultsForSearch: Infinity });

        $('#typeofsystem, #typeofsystem2').select2({ placeholder: 'Select Type of System', allowClear: true, minimumResultsForSearch: Infinity });
        $('#team_filter_module, #team, #team_filter, #team2').select2({ placeholder: 'Select Team', allowClear: true, minimumResultsForSearch: Infinity });
    });

    $.ajax({
        url: '<?php echo base_url('setup_location') ?>',
        type: 'POST',
        success: function (response) {
            companyData = JSON.parse(response);
            $('#coFilter, #company, #company1').empty().append('<option value="">Select Company</option>');
            $('#buFilter, #business_unit, #business_unit1').empty().append('<option value="">Select Business Unit</option>');
            $('#departmentFilter, #department,  #department1').empty().append('<option value="">Select Department</option>');
            $('#buFilter, #business_unit, #business_unit1, #departmentFilter, #department,  #department1').prop('disabled', true);

            companyData.forEach(function (company) {
                $('#coFilter, #company, #company1').append('<option value="' + company.company_code + '">' + company.acroname + '</option>');
            });
        }
    });

    $('#coFilter, #company, #company1').change(function () {
        var companyCode = $(this).val();
        $('#buFilter, #business_unit, #business_unit1').empty().append('<option value="">Select Business Unit</option>');
        $('#departmentFilter, #department, #department1').empty().append('<option value="">Select Department</option>');
        $('#buFilter, #business_unit, #business_unit1').prop('disabled', true);
        $('#departmentFilter, #department, #department1').prop('disabled', true);

        var selectedCompany = companyData.find(company => company.company_code == companyCode);

        if (selectedCompany) {
            selectedCompany.business_unit.forEach(function (bu) {
                $('#buFilter, #business_unit, #business_unit1').append('<option value="' + bu.bunit_code + '">' + bu.business_unit + '</option>');
            });
            $('#buFilter, #business_unit, #business_unit1').prop('disabled', false);
        }
    });

    $('#buFilter, #business_unit, #business_unit1').change(function () {
        var companyCode = $('#coFilter').val() || $('#company').val() || $('#company1').val();
        var businessUnitCode = $(this).val();
        $('#departmentFilter, #department, #department1').empty().append('<option value="">Select Department</option>');
        $('#departmentFilter, #department, #department1').prop('disabled', true);

        var selectedCompany = companyData.find(company => company.company_code == companyCode);
        if (selectedCompany) {
            selectedCompany.department.forEach(function (dept) {
                if (dept.bunit_code == businessUnitCode) {
                    $('#departmentFilter, #department, #department1').append('<option value="' + dept.dcode + '">' + dept.dept_name + '</option>');
                }
            });
            $('#departmentFilter, #department, #department1').prop('disabled', false);
        }
    });
    $('#team_filter, #coFilter, #buFilter, #departmentFilter').change(function () {
        $('#view_dept_implemented_module').DataTable().ajax.reload();
    });

    $(document).ready(function () {
        $('#team_filter_module').select2({ placeholder: 'Select Team', allowClear: true, minimumResultsForSearch: Infinity });
    });
    $.ajax({
        url: '<?php echo base_url('get_team') ?>',
        type: 'POST',
        success: function (response) {
            teamData = JSON.parse(response);
            $('#team_filter_module').empty().append('<option value="">Select Team Name</option>');
            teamData.forEach(function (team) {
                $('#team_filter_module').append('<option value="' + team.team_id + '">' + team.team_name + '</option>');
            });
        }
    });

    $('#team_filter_module').change(function () {
        $('#admin_module_list').DataTable().ajax.reload();
    });

    var typeofsystem = "all";
    var table = null;
    var printWindow = null;
    loadsystem(typeofsystem);

    $("a.typeofsystem").click(function () {
        $("a.btn-primary").removeClass('btn-primary').addClass('btn-secondary');
        $(this).addClass('btn-primary');
        typeofsystem = this.id;
        loadsystem(typeofsystem);
    });

    function loadsystem(typeofsystem) {
        table = $('#admin_module_list').DataTable({
            "processing": true,
            "serverSide": true,
            "destroy": true,
            "responsive": true,
            'lengthMenu': [[10, 25, 50, 100, 10000], [10, 25, 50, 100, "Max"]],
            'pageLength': 10,
            "ajax": {
                "url": "<?= base_url('admin_module_list') ?>",
                "dataType": "json",
                "type": "POST",
                "data": function (d) {
                    d.typeofsystem = typeofsystem !== "all" ? typeofsystem : null;
                    d.team = $('#team_filter_module').val();
                }
            },
            "columns": [
                { "data": "team_name" },
                { "data": "mod_name" },
                { "data": 'mod_abbr' },
                { "data": 'mod_status' },
                { "data": 'typeofsystem' },
                { "data": 'module_desc' },
                { "data": 'action' }
            ],
            "paging": true,
            "searching": true,
            "ordering": true,
            "columnDefs": [
                { "className": "text-start", "targets": ['_all'] },
                { "className": "text-justify", "targets": [4] }
            ]
        });
    }

    function approve_new_module(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to approve this as NEW System?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, approve it!',
            cancelButtonText: 'No, cancel!',
            showLoaderOnConfirm: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo base_url('approve_new_module'); ?>',
                    type: 'POST',
                    data: {
                        id: id,
                    },
                    success: function () {
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 5000,
                            extendedTimeOut: 2000,
                            preventDuplicates: true,
                        };
                        updateModuleCount();
                        toastr.success(
                            `New system | module successfully approve`,
                        );
                        var table = $('#admin_module_list').DataTable();
                        var currentPage = table.page();

                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                        }, false);
                    },
                });
            }
        });
    }
    function recall_new_module(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to recall to pending this new System?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, recall it!',
            cancelButtonText: 'No, cancel!',
            showLoaderOnConfirm: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo base_url('recall_new_module'); ?>',
                    type: 'POST',
                    data: {
                        id: id,
                    },
                    success: function () {
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 5000,
                            extendedTimeOut: 2000,
                            preventDuplicates: true,
                        };
                        updateModuleCount();
                        toastr.success(
                            `New system | module was successfully recalled`,
                        );
                        var table = $('#admin_module_list').DataTable();
                        var currentPage = table.page();

                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                        }, false);
                    },
                });
            }
        });
    }

    function view_dept_implemented_module(mod_id, mod_name, team_id, sub_mod_id, sub_mod_name, typeofsystem) {

        $('#mod_name').text(mod_name);
        $('#mod_id').val(mod_id);
        $('#sub_mod_id').val(sub_mod_id);
        $('#id').val(team_id);
        $('#tos').val(typeofsystem);
        table = $('#view_dept_implemented_module').DataTable({
            "processing": true,
            "serverSide": true,
            "destroy": true,
            "responsive": true,
            "lengthMenu": [[10, 25, 50, 100, 10000], [10, 25, 50, 100, "Max"]],
            "pageLength": 10,
            "ajax": {
                "url": "<?php echo base_url('Admin/admin_view_dept_implemented_modules'); ?>",
                "type": "POST",
                "data": function (d) {
                    d.mod_id = mod_id;
                    d.team = $('#team_filter').val();
                    d.requested_to_co = $('#coFilter').val();
                    d.requested_to_bu = $('#buFilter').val();
                    d.requested_to_dep = $('#departmentFilter').val();
                }
            },
            "columns": [
                { "data": "bu_name" },
                { "data": "sub_mod_name" },
                { "data": "date_requested" },
                { "data": "date_parallel" },
                { "data": "date_implem" },
                { "data": "others" }
                // { "data": "status" },
                // {
                //     "data": 'action',
                //     "visible": <?= ($_SESSION['position'] != 'Manager') ? 'true' : 'false'; ?>
                // }

            ],
            "columnDefs": [
                { "className": "text-start", "targets": ['_all'] }
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
            <div style="text-align: center; margin-bottom: 20px; text-transform: uppercase;"><h4>${mod_name} | MODULE REPORT</h4></div>
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
            printWindow.document.title = 'MODULES PER COMPANY | BUSINESS UNIT | DEPARTMENT | IMPLEMENTED - PDF Export';
            printWindow.document.write(printContent);
            printWindow.document.close();
            printWindow.print();
        });
    }

</script>

<script>
    function show_uploaded_documents(mod_id, mod_name) {
        $('#module_name').text(mod_name);
        $('#show_uploaded_documents_table').DataTable({
            "processing": true,
            "serverSide": true,
            "destroy": true,
            "stateSave": true,
            "lengthMenu": [[20, 50, 100, 10000], [20, 50, 100, "Max"]],
            "pageLength": 20,
            "ajax": {
                "url": "<?php echo base_url('Admin/show_uploaded_documents_table'); ?>",
                "type": "POST",
                "data": {
                    mod_id: mod_id,
                    mod_name: mod_name
                }
            },
            "columns": [
                { "data": "directory" },
                { "data": "status" },
                { "data": "action" }
            ],
            "columnDefs": [
                { "className": "text-start", "targets": [0] },
                { "className": "text-center", "targets": [1, 2] },
            ],
        });
    }

    function show_data_in_directory(mod_id, directory, sub_mod_id, team_id, typeofsystem, mod_name) {
        $('#directory_module_name').text(directory + " | " + mod_name);

        $('#show_data').DataTable({
            "processing": true,
            "serverSide": true,
            "destroy": true,
            "responsive": true,
            "lengthMenu": [[10, 20, 50, 100, 10000], [10, 20, 50, 100, "Max"]],
            "pageLength": 10,
            "ajax": {
                "url": "<?php echo base_url('Admin/show_data_in_directory'); ?>",
                "type": "POST",
                "data": {
                    mod_id: mod_id,
                    directory: directory,
                    sub_mod_id: sub_mod_id,
                    team_id: team_id,
                    typeofsystem: typeofsystem,
                    mod_name: mod_name
                }
            },
            "columns": [
                { "data": "filename" },
                { "data": "original_file_name" },
                // { "data": "status" },
            ],
            "columnDefs": [
                { "className": "text-start", "targets": [1] },
                { "className": "text-center", "targets": [0] },
            ],
        });

    }

    function previewFileModal(fileUrl) {
        const extension = fileUrl.split('.').pop().toLowerCase();
        let previewHTML = '';

        if (['jpg', 'jpeg', 'png', 'gif', 'jfif', 'bmp', 'webp'].includes(extension)) {
            previewHTML = `<img src="${fileUrl}" class="img-fluid w-100" style="max-height:100vh; width: 80px object-fit:contain;" />`;

        } else if (extension === 'pdf') {
            previewHTML = `<iframe src="${fileUrl}" style="width: 100%; height: 90vh;" frameborder="0"></iframe>`;

        } else if (['mp4', 'mkv', 'avi', 'x-matroska'].includes(extension)) {
            previewHTML = `
            <video controls style="width: 100%; height: 90vh;" preload="metadata">
                <source src="${fileUrl}" type="video/${extension === 'mp4' ? 'mp4' : 'ogg'}">
                Your browser does not support the video tag.
            </video>`;

        } else if (['mp3', 'wav', 'ogg'].includes(extension)) {
            previewHTML = `
            <audio controls style="width: 100%;">
                <source src="${fileUrl}" type="audio/${extension}">
                Your browser does not support the audio element.
            </audio>`

        } else if (['doc', 'docx', 'xlsx'].includes(extension)) {
            previewHTML = `
                    <div class="text-center p-4">
                        <p class="text-muted">Preview not available for this file type on localhost.</p>
                        <a href="${fileUrl}" class="btn btn-outline-secondary" download>Download File</a>
                    </div>`;

        } else if (['txt', 'csv'].includes(extension)) {
            previewHTML = `
            <iframe src="${fileUrl}" style="width: 100%; height: 90vh;" frameborder="0"></iframe>`;

        } else {
            previewHTML = `<p class="text-muted">Preview not available for this file type.</p>`;
        }

        $('#filePreviewModal .modal-body').html(previewHTML);
        $('#filePreviewModal').modal('show');
        $('#show_data_in_directory').modal('hide');
    }
</script>