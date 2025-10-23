<!-- Varying modal content -->
<div class="modal fade" id="create_kpi" tabindex="-1" aria-labelledby="create_kpiLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title" id="varyingcontentModalLabel">CREATE KPI</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="title" class="col-form-label">Title:</label>
                    <input type="text" class="form-control" id="title" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="type" class="col-form-label">Type:</label>
                    <select class="form-select mb-3" id="type">
                        <option></option>
                        <option value="System Analyst">SYSTEM ANALYST</option>
                        <option value="Programmer">PROGRAMMER</option>
                        <option value="RMS">RMS</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="desc" class="col-form-label">Description:</label>
                    <textarea class="form-control" id="desc" style="height: 210px"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="submitKPI()">Submit</button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Varying modal content -->
<div class="modal fade" id="edit_kpi" tabindex="-1" aria-labelledby="create_kpiLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title" id="varyingcontentModalLabel">UPDATE KPI</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="" id="edit_kpi_content"></div>
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
    <div class="container-fluid">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header border-1">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">Key Performance Indicator</h5>
                        <div class="flex-shrink-0">
                            <div class="d-flex flex-wrap gap-2">
                                <button class="btn btn-primary waves-effect waves-light add-btn" data-bs-toggle="modal"
                                    data-bs-target="#create_kpi"><i class="ri-add-line align-bottom me-1"></i> Create
                                    KPI </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="nav nav-pills arrow-navtabs nav-primary bg-light mb-4" role="tablist">
                        <li class="nav-item">
                            <a id="System Analyst" aria-expanded="false" class="nav-link active type" data-bs-toggle="tab" >
                                <span class="d-block d-sm-none"><iconify-icon icon="solar:lightbulb-bolt-bold-duotone" class="fs-25"></iconify-icon></span>
                                <span class="d-none d-sm-block">System Analyst's KPI</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="Programmer" aria-expanded="true" class="nav-link type" data-bs-toggle="tab" >
                                <span class="d-block d-sm-none"><iconify-icon icon="solar:code-file-bold-duotone" class="fs-25"></iconify-icon></span>
                                <span class="d-none d-sm-block">Programmer's KPI </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="RMS" aria-expanded="true" class="nav-link type" data-bs-toggle="tab" >
                                <span class="d-block d-sm-none"><iconify-icon icon="solar:siderbar-bold-duotone" class="fs-25"></iconify-icon></span>
                                <span class="d-none d-sm-block">Record Management System KPI </span>
                            </a>
                        </li>
                    </ul>
                    <hr>
                    <div class="tab-content">
                    <div class="dropdown">
                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="columnDropdown" data-bs-toggle="dropdown" aria-expanded="false"> Column Visibility</button>
                        <ul class="dropdown-menu" aria-labelledby="columnDropdown" id="columnSelectorDropdown" data-simplebar style="max-height: 300px;">
                            <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="0" checked> Title</label></li>
                            <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="1" checked> Description</label></li>
                            <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="2" checked> Type</label></li>
                            <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="3" checked> Action</label></li>
                        </ul>
                        <button id="generate_report" class="btn btn-danger btn-sm ms-1">Generate Report</button>
                    </div>
                        <div class="mt-2 tab-pane active" id="System Analyst" role="tabpanel">
                            <div class="table-responsive">
                            <table class="table table-striped table-hover" id="kpi">
                                <thead class="table-info text-center text-uppercase">
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
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
        </div>
    </div>
</div>

<script>
    var type = "System Analyst";
    var table = null;
    var printWindow = null; 
    loadkpi(type);

    $("a.type").click(function () {
        $("a.btn-primary").removeClass('btn-primary').addClass('btn-secondary');
        $(this).addClass('btn-primary');
        let type = this.id;
        loadkpi(type);
    });

    function loadkpi(type){
        if (table) {
            table.destroy();
        }
        table =$('#kpi').DataTable({
            processing: true,
            serverSide: true,
            // stateSave: true,
            destroy: true,
            lengthMenu: [[10, 25, 50, 100, 10000], [10, 25, 50, 100, "Max"]],
            pageLength: 10,
            ajax: {
                url: '<?php echo base_url('kpi_list'); ?>',
                type: 'POST',
                data: {
                    type: type
                }
            },
            columns: [
                { data: 'title' },
                { data: 'description' },
                { data: 'type' },
                { data: 'action' }
            ],
            paging: true,
            searching: true,
            ordering: true,
            columnDefs: [
                { "className": "text-left", "targets": ['_all'] }
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
            <div style="text-align: center; margin-bottom: 20px;"><h4>LIST OF KPI</h4></div>
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
            printWindow.document.title = 'KPI LIST - PDF Export';
            printWindow.document.write(printContent);
            printWindow.document.close();
            printWindow.print();
        });
    }

    function submitKPI() {

        let title           = $('#title').val();
        let type            = $('#type').val();
        let description     = $('#desc').val();

        if (title === "" || type === "" || description === "") {
            toastr.options = {
                progressBar: true,
                positionClass: "toast-top-left",
                timeOut: 5000,
                extendedTimeOut: 2000,
                preventDuplicates: true,
            };

            toastr.info(
                `Please fill up required fields.`,
            );

            $('#title, #type, #desc').each(function () {
                if ($(this).val() === '') {
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });



            return;
        }

        let data = {
            title: title,
            type: type,
            description: description
        };

        $.ajax({
            url: '<?php echo base_url("create_kpi"); ?>',
            type: 'POST',
            data: data,
            success: function() {
                $('#create_kpi').modal('hide');
                var table = $('#kpi').DataTable();
                var currentPage = table.page();

                table.ajax.reload(function () {
                    table.page(currentPage).draw(false);
                }, false);
                toastr.options = {
                    progressBar: true,
                    positionClass: "toast-top-left",
                    timeOut: 5000,
                    extendedTimeOut: 2000,
                    preventDuplicates: true,
                };

                toastr.success(
                    `Kpi was successfully added`,
                );
                
            },
        });
    }

    function edit_kpi(id) {
        $.ajax({
            url: '<?= base_url('edit_kpi') ?>',
            type: 'POST',
            data: {id: id},
            error: function () {
                toastr.options = {
                    progressBar: true,
                    positionClass: "toast-top-left",
                    timeOut: 5000,
                    extendedTimeOut: 2000,
                    preventDuplicates: true,
                };

                toastr.success(
                    `Oops! Something went wrong. Please try again`,
                );
                
            },
            success: function (data) {
                $("#edit_kpi_content").html(data);
            }
        });
    }
    function submiteditedKPI(id){
        let title = $('#ktitle').val().trim();
        let type = $('#type_edit').val();
        let description = $('#description').val().trim(); 

        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to update this KPI!',
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
                    url: '<?= base_url('update_kpi') ?>',
                    type: 'POST',
                    data: {
                        id: id, 
                        title: title,
                        type: type,
                        description: description
                    },
                    success: function() {
                        $('#edit_kpi').modal('hide');
                        var table = $('#kpi').DataTable();
                        var currentPage = table.page();

                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                        }, false);
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 5000,
                            extendedTimeOut: 2000,
                            preventDuplicates: true,
                        };

                        toastr.success(
                            `Kpi was successfully updated`,
                        );
                        
                    },
                });
            }
        });
    }
    function delete_kpi(id){
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this KPI.',
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
                    url: '<?= base_url('delete_kpi') ?>',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function() {
                        var table = $('#kpi').DataTable();
                        var currentPage = table.page();
                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                        }, false);
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 5000,
                            extendedTimeOut: 2000,
                            preventDuplicates: true,
                        };

                        toastr.success(
                            `Kpi was successfully deleted`,
                        );
                    },
                });
            }
        });
    }

</script>
