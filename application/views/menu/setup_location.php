<div class="modal fade" id="create_location" tabindex="-1" aria-labelledby="create_location" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title">SETUP LOCATION IMPLEMENTED</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <label for="company" class="col-sm-3 col-form-label">Company:</label>
                    <div class="col-sm-9">
                        <select class="form-select mb-3" id="company" style="width: 100%; height: 508px">
                            <option value=""></option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="Business Unit" class="col-sm-3 col-form-label">Business Unit:</label>
                    <div class="col-sm-9">
                        <select class="form-select mb-3" id="business_unit" style="width: 100%; height: 508px">
                            <option value=""></option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="department" class="col-sm-3 col-form-label">Department:</label>
                    <div class="col-sm-9">
                        <select class="form-select mb-3" id="department" style="width: 100%; height: 508px">
                            <option value=""></option>
                        </select>
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
                    <label class="col-sm-3 col-form-label">Date Parallel: </label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="date" id="date_parallel" class="form-control" readonly=""
                                placeholder="Select date" data-provider="flatpickr" />
                            <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Date online: </label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="date" id="date_online" class="form-control" readonly=""
                                placeholder="Select date" data-provider="flatpickr" />
                            <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="remarks" class="col-sm-3 col-form-label">Remarks:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="remarks" placeholder="Remarks" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="submit_location()">Submit</button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_location" tabindex="-1" aria-labelledby="edit_location" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" style="width: 765px">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title">EDIT SETUP LOCATION IMPLEMENTED</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <label for="company" class="col-sm-3 col-form-label">Company:</label>
                    <div class="col-sm-9">
                        <select class="form-select mb-3" id="edit_company" style="width: 100%; height: 508px">
                            <option value=""></option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="Business Unit" class="col-sm-3 col-form-label">Business Unit:</label>
                    <div class="col-sm-9">
                        <select class="form-select mb-3" id="edit_business_unit" style="width: 100%; height: 508px">
                            <option value=""></option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="department" class="col-sm-3 col-form-label">Department:</label>
                    <div class="col-sm-9">
                        <select class="form-select select2 mb-3" id="edit_department"
                            style="width: 100%; height: 508px">
                            <option value=""></option>
                        </select>
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
                    <label class="col-sm-3 col-form-label">Date Parallel: </label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="date" id="edit_date_parallel" class="form-control" readonly=""
                                placeholder="Select date" data-provider="flatpickr" />
                            <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Date online: </label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="date" id="edit_date_online" class="form-control" readonly=""
                                placeholder="Select date" data-provider="flatpickr" />
                            <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="remarks" class="col-sm-3 col-form-label">Remarks:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="edit_remarks" placeholder="Remarks"
                            autocomplete="off">
                        <input type="hidden" class="hidden" id="edit_id">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="update_location()">Submit</button>
                <button type="button" class="btn btn-dark" data-bs-toggle="modal"
                    data-bs-target="#module_list_implemented_modal">Back To List</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="module_list_implemented_modal" tabindex="-1" aria-labelledby="module_list_implemented"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title">LOCATION IMPLEMENTED OF THIS MODULE</h5>
                <div class="d-flex align-items-center flex-shrink-0 ms-2 gap-2">
                    <!-- <button class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#create_location"><i class="ri-add-fill align-bottom me-1"></i> Setup Implemented Location </button> -->
                    <!-- <button class="btn btn-danger waves-effect waves-light"><i class="ri-printer-fill align-bottom me-1"></i> Generate Report </button> -->
                </div>
            </div>
            <div class="modal-body">
                <div class="dropdown">
                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="columnDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false"> Column Visibility</button>
                    <ul class="dropdown-menu" aria-labelledby="columnDropdown" id="columnSelectorDropdown"
                        data-simplebar style="max-height: 300px;">
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="0" checked>
                                Company</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="1" checked>
                                Business Unit</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="2" checked>
                                Department</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="3" checked>
                                Module</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="4" checked>
                                Sub Module</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="5" checked>
                                Date Parallel</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="6" checked>
                                Date Online</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="7" checked>
                                Others</label></li>
                    </ul>
                    <button id="generate_report" class="btn btn-danger btn-sm ms-1">Generate Report</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover no-wrap" id="location_setup">
                        <thead class="table-info text-center text-uppercase">
                            <tr>
                                <th width="20%">Company</th>
                                <th>Business Unit</th>
                                <th>Department</th>
                                <th>Module</th>
                                <th>Sub Module</th>
                                <th>Date Parallel</th>
                                <th>Date Online</th>
                                <th width="20%">Others</th>
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
                <h4 class="mb-sm-0">LOCATION SETUP </h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Location </a></li>
                        <li class="breadcrumb-item active">Index<i class="mdi mdi-alpha-x-circle:"></i></li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header border-1">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0 flex-grow-1 fw-bold">List of Modules | Business Unit | Department
                        Implemented</h5>
                </div>
            </div>
            <div class="card-body">
                <ul class="nav nav-pills arrow-navtabs nav-primary bg-light mb-4" role="tablist">
                    <li class="nav-item">
                        <a id="current" aria-expanded="false" class="nav-link active typeofsystem" data-bs-toggle="tab">
                            <span class="d-block d-sm-none"><iconify-icon icon="ri:list-settings-line"
                                    class="fs-25"></iconify-icon></span>
                            <span class="d-none d-sm-block">Current Module | System</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a id="new" aria-expanded="true" class="nav-link  typeofsystem" data-bs-toggle="tab">
                            <span class="d-block d-sm-none"><iconify-icon icon="ri:chat-new-fill"
                                    class="fs-25"></iconify-icon></span>
                            <span class="d-none d-sm-block">New Module | System</span>
                        </a>
                    </li>
                </ul>
                <hr>
                <div class="table-responsive">
                    <table class="table table-striped table-hover no-wrap compact" id="module_list_implemented">
                        <thead class="table-info text-center text-uppercase">
                            <tr>
                                <th>Module List</th>
                                <th>Type</th>
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

        var typeofsystem = "current";
        loadsystem(typeofsystem);

        $("a.typeofsystem").click(function () {
            $("a.btn-primary").removeClass('btn-primary').addClass('btn-secondary');
            $(this).addClass('btn-primary');
            let typeofsystem = this.id;
            loadsystem(typeofsystem);
        });

        function loadsystem(typeofsystem) {
            var table = $('#module_list_implemented').DataTable({
                "processing": true,
                "serverSide": true,
                "destroy": true,
                "responsive": true,
                "lengthMenu": [[10, 25, 50, 100, 10000], [10, 25, 50, 100, "Max"]],
                "pageLength": 10,
                "ajax": {
                    "url": "<?php echo base_url('module_list_implemented') ?>",
                    "type": "POST",
                    "data": {
                        "typeofsystem": typeofsystem
                    }
                },
                "columns": [
                    { "data": "module" },
                    { "data": "type" },
                    { "data": "action" }
                ],
                "columnDefs": [
                    { "className": "text-start", "targets": ['_all'] },
                ],
            });
        }
    });
</script>


<script>
    $(document).ready(function () {
        $('#company, #edit_company').select2({ placeholder: 'Select Company', allowClear: true, minimumResultsForSearch: Infinity });
        $('#business_unit, #edit_business_unit').select2({ placeholder: 'Select Business Unit', allowClear: true, minimumResultsForSearch: Infinity });
        $('#department, #edit_department').select2({ placeholder: 'Select Department', allowClear: true, minimumResultsForSearch: Infinity });

        $('#module, #edit_module').select2({ placeholder: 'Select Module Name', allowClear: true, minimumResultsForSearch: Infinity });
        $('#sub_module, #edit_sub_module').select2({ placeholder: 'Select Sub Module Name', allowClear: true, minimumResultsForSearch: Infinity });
    });
    var loc = null;
    var printWindow = '';

    function module_list_implemented_modal(mod_id, type) {

        loc = $('#location_setup').DataTable({
            "processing": true,
            "serverSide": true,
            "destroy": true,
            "responsive": true,
            "lengthMenu": [[10, 25, 50, 100, 10000], [10, 25, 50, 100, "Max"]],
            "pageLength": 10,
            "ajax": {
                "url": "<?php echo base_url('setup_location_list'); ?>",
                "type": "POST",
                "data": {
                    "mod_id": mod_id,
                    "typeofsystem": type
                }
            },
            "columns": [
                { "data": "company" },
                { "data": "business_unit" },
                { "data": "department" },
                { "data": "module" },
                { "data": "sub_module" },
                { "data": "date_parallel" },
                { "data": "date_implem" },
                { "data": "remarks" }
            ],
            "columnDefs": [
                { "className": "text-start", "targets": ['_all'] },
            ],
        });
        $('#module_list_implemented_modal').modal('show');
        $('#columnSelectorDropdown').on('click', function (e) {
            e.stopPropagation();
        });
        $('#columnSelectorDropdown .column-toggle').each(function () {
            let columnIdx = $(this).val();
            $(this).prop('checked', loc.column(columnIdx).visible());
        });

        $('#columnSelectorDropdown .column-toggle').on('change', function () {
            let columnIdx = $(this).val();
            let isChecked = $(this).prop('checked');
            loc.column(columnIdx).visible(isChecked);
        });
        $('#generate_report').on('click', function () {

            if (printWindow && !printWindow.closed) {
                return;
            }

            let visibleColumns = [];
            let visibleHeaders = [];
            let desc = -1;
            loc.columns().every(function (index) {
                let headerText = this.header().textContent.trim();
                if (this.visible() && headerText.toLowerCase() !== 'action') {
                    visibleColumns.push(index);
                    visibleHeaders.push(headerText);
                    if (headerText.toLowerCase() === 'description') {
                        desc = visibleColumns.length - 1;
                    }
                }
            });

            let rowData = loc.rows({ filter: 'applied' }).data().toArray();
            let reportData = rowData.map(row => visibleColumns.map(index => row[loc.column(index).dataSrc()]));
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
            <div style="text-align: center; margin-bottom: 20px;"><h4>LOCATION IMPLEMENTED OF THIS MODULE</h4></div>
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
            printWindow.document.title = 'LOCATION SETUP | IMPLEMENTED - PDF Export';
            printWindow.document.write(printContent);
            printWindow.document.close();
            printWindow.print();
        });
    }


    $.ajax({
        url: '<?php echo base_url('setup_location') ?>',
        type: 'POST',
        success: function (response) {
            companyData = JSON.parse(response);
            $('#company, #edit_company').empty().append('<option value="">Select Company</option>');
            $('#business_unit, #edit_business_unit').empty().append('<option value="">Select Business Unit</option>');
            $('#department, #edit_department').empty().append('<option value="">Select Department</option>');
            $('#business_unit, #edit_business_unit, #department, #edit_department').prop('disabled', true);

            companyData.forEach(function (company) {
                $('#company, #edit_company').append('<option value="' + company.company_code + '">' + company.company + '</option>');
            });
        }
    });

    $('#company, #edit_company').change(function () {
        var companyCode = $(this).val();
        $('#business_unit, #edit_business_unit').empty().append('<option value="">Select Business Unit</option>');
        $('#department, #edit_department').empty().append('<option value="">Select Department</option>');
        $('#business_unit, #edit_business_unit').prop('disabled', true);
        $('#department, #edit_department').prop('disabled', true);


        var selectedCompany = companyData.find(company => company.company_code == companyCode);

        if (selectedCompany) {
            selectedCompany.business_unit.forEach(function (bu) {
                $('#business_unit, #edit_business_unit').append('<option value="' + bu.bunit_code + '">' + bu.business_unit + '</option>');
            });
            $('#business_unit, #edit_business_unit').prop('disabled', false);
        }
    });

    $('#business_unit, #edit_business_unit').change(function () {
        var companyCode = $('#company').val() || $('#edit_company').val();
        var businessUnitCode = $(this).val();
        $('#department, #edit_department').empty().append('<option value="">Select Department</option>');
        $('#department, #edit_department').prop('disabled', true);

        var selectedCompany = companyData.find(company => company.company_code == companyCode);
        if (selectedCompany) {
            selectedCompany.department.forEach(function (dept) {
                if (dept.bunit_code == businessUnitCode) {
                    $('#department, #edit_department').append('<option value="' + dept.dcode + '">' + dept.dept_name + '</option>');
                }
            });
            $('#department, #edit_department').prop('disabled', false);
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
                $('#module, #edit_module').append('<option value="' + module.mod_id + '">' + module.mod_name + '</option>');
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

    $('#create_location').on('hidden.bs.modal', function () {
        $('#company, #business_unit, #department, #module, #sub_module').val("").trigger('change');
        $('#date_parallel, #date_online').val("");
        $('#remarks').val("");
    });
    function submit_location() {

        var company = $('#company').val();
        var company_name = $('#company option:selected').text();
        var business_unit = $('#business_unit').val();
        var business_unit_name = $('#business_unit option:selected').text();
        var department = $('#department').val();
        var module = $('#module').val();
        var sub_module = $('#sub_module').val();
        var date_parallel = $('#date_parallel').val();
        var date_online = $('#date_online').val();
        var remarks = $('#remarks').val();

        if (company === "" || business_unit === "" || department === "" || module === "" || date_parallel === "" || date_online === "" || remarks === "") {
            toastr.options = {
                progressBar: true,
                positionClass: "toast-top-left",
                timeOut: 5000,
                extendedTimeOut: 2000,

            };

            toastr.info(
                `Please fill up the required fields`,
            );

            $('#company, #business_unit, #department, #module, #sub_module, #date_parallel, #date_online, #remarks').each(function () {
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
            text: 'You want to setup this location?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, add it!',
            cancelButtonText: 'No, cancel!',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo base_url('submit_location') ?>',
                    type: 'POST',
                    data: {
                        company: company,
                        company_name: company_name,
                        business_unit_name: business_unit_name,
                        business_unit: business_unit,
                        department: department,
                        module: module,
                        sub_module: sub_module,
                        date_parallel: date_parallel,
                        date_online: date_online,
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
                            `Location setup was successfully added`,
                        );
                        $('#create_location').modal('hide');
                        module_list_implemented_modal(module)
                        var table = $('#location_setup').DataTable();
                        var currentPage = table.page();

                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                        }, false);
                    }
                });
            }
        });
    }
    function edit_location_content(id) {
        $.ajax({
            url: '<?php echo base_url('edit_setup_location_content') ?>',
            type: 'POST',
            data: { id: id },
            success: function (response) {
                let data = JSON.parse(response);
                $('#edit_id').val(data.id);
                $('#module_list_implemented_modal').modal('hide');
                setTimeout(function () {
                    $('#edit_company').val(data.company).trigger('change').promise().done(function () {
                        $('#edit_business_unit').val(data.business_unit).trigger('change').promise().done(function () {
                            $('#edit_department').val(data.department).trigger('change');
                        });
                    });
                    $('#edit_module').val(data.mod_id).trigger('change');
                    $('#edit_sub_module').val(data.sub_mod_id).trigger('change');
                    $('#edit_date_parallel').val(data.date_parallel);
                    $('#edit_date_online').val(data.date_online);
                    $('#edit_remarks').val(data.remarks);
                }, 800);
            }
        });
    }
    function update_location() {
        var id = $('#edit_id').val();
        var company = $('#edit_company').val();
        var company_name = $('#edit_company option:selected').text();
        var business_unit = $('#edit_business_unit').val();
        var business_unit_name = $('#edit_business_unit option:selected').text();
        var department = $('#edit_department').val();
        var module = $('#edit_module').val();
        var sub_module = $('#edit_sub_module').val();
        var date_parallel = $('#edit_date_parallel').val();
        var date_online = $('#edit_date_online').val();
        var remarks = $('#edit_remarks').val();

        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to update this location?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update it!',
            cancelButtonText: 'No, cancel!',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo base_url('update_location') ?>',
                    type: 'POST',
                    data: {
                        id: id,
                        company: company,
                        company_name: company_name,
                        business_unit: business_unit,
                        business_unit_name: business_unit_name,
                        department: department,
                        module: module,
                        sub_module: sub_module,
                        date_parallel: date_parallel,
                        date_online: date_online,
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
                            `Location setup was successfully updated`,
                        );
                        $('#edit_location').modal('hide');
                        module_list_implemented_modal(module)
                        var table = $('#location_setup').DataTable();
                        var currentPage = table.page();

                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                        }, false);
                    }
                });
            }
        })
    }
    function delete_setup_location(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to delete this setup?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo base_url('delete_setup_location') ?>',
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
                            `Location setup was successfully deleted`,
                        );
                        var table = $('#location_setup').DataTable();
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