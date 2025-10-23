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
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#folderModal">Back
                    to List</button>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Request </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <ts href="javascript: void(0);">Requests </ts>
                        </li>
                        <li class="breadcrumb-item active">Index<i class="mdi mdi-alpha-x-circle:"></i></li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-pills animation-nav nav-justified gap-2 mb-3" role="tablist">
                    <!-- <li class="nav-item">
                        <a class="nav-link waves-effect waves-light typeofsystem fw-bold" data-bs-toggle="tab" id="current" role="tab">
                            CURRENT SYSTEM | MODULE 
                        </a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link waves-effect waves-light active typeofsystem fw-bold" data-bs-toggle="tab"
                            id="new" role="tab">
                            NEW SYSTEM | MODULE
                        </a>
                    </li>
                </ul>
                <hr>
                <!-- <div class="col-md-12"> -->
                <div class="row">
                    <div class="col-md-2">
                        <div class="nav nav-pills flex-column nav-pills-tab custom-verti-nav-pills text-center"
                            role="tablist" aria-orientation="vertical">
                            <a href="#!" id="ISR" class="fw-bold nav-link active type" data-bs-toggle="pill"
                                role="tab">ISR <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                    id="count_ISR"></span></a>
                            <a href="#!" id="ATTENDANCE" class="fw-bold nav-link type" data-bs-toggle="pill"
                                role="tab">ATTENDANCE <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                    id="count_ATTENDANCE"></span></a>
                            <a href="#!" id="MINUTES" class="fw-bold nav-link type" data-bs-toggle="pill"
                                role="tab">MINUTES <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                    id="count_MINUTES"></span></a>
                            <a href="#!" id="WALKTHROUGH" class="fw-bold nav-link type" data-bs-toggle="pill"
                                role="tab">WALKTHROUGH <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                    id="count_WALKTHROUGH"></span></a>
                            <a href="#!" id="FLOWCHART" class="fw-bold nav-link type" data-bs-toggle="pill"
                                role="tab">FLOWCHART <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                    id="count_FLOWCHART"></span></a>
                            <a href="#!" id="DFD" class="fw-bold nav-link type" data-bs-toggle="pill" role="tab">DFD
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                    id="count_DFD"></span></a>
                            <a href="#!" id="SYSTEM_PROPOSED" class="fw-bold nav-link type" data-bs-toggle="pill"
                                role="tab">SYSTEM PROPOSED <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                    id="count_SYSTEM_PROPOSED"></span></a>
                            <a href="#!" id="GANTT_CHART" class="fw-bold nav-link type" data-bs-toggle="pill"
                                role="tab">GANTT CHART <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                    id="count_GANTT_CHART"></span></a>
                            <a href="#!" id="LOCAL_TESTING" class="fw-bold nav-link type" data-bs-toggle="pill"
                                role="tab">LOCAL TESTING <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                    id="count_LOCAL_TESTING"></span></a>
                            <a href="#!" id="UAT" class="fw-bold nav-link type" data-bs-toggle="pill" role="tab">UAT
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                    id="count_UAT"></span></a>
                            <a href="#!" id="LIVE_TESTING" class="fw-bold nav-link type" data-bs-toggle="pill"
                                role="tab">LIVE TESTING <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                    id="count_LIVE_TESTING"></span></a>
                            <a href="#!" id="USER_GUIDE" class="fw-bold nav-link type" data-bs-toggle="pill"
                                role="tab">USER GUIDE <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                    id="count_USER_GUIDE"></span></a>
                            <a href="#!" id="MEMO" class="fw-bold nav-link type" data-bs-toggle="pill" role="tab">MEMO
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                    id="count_MEMO"></span></a>
                            <a href="#!" id="BUSINESS_ACCEPTANCE" class="fw-bold nav-link type" data-bs-toggle="pill"
                                role="tab">BUSINESS ACCEPTANCE <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                    id="count_BUSINESS_ACCEPTANCE"></span></a>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <!-- <div class="card">
                            <div class="card-body"> -->
                        <div class="d-flex gap-2 mb-2">
                            <select class="form-select" id="team" name="team">
                                <option value=""></option>
                            </select>
                            <select class="form-select" id="module" name="module">
                                <option value="">Module</option>
                            </select>
                            <select class="form-select" id="sub_module" name="sub_module">
                                <option value="">Sub Module</option>
                            </select>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="columnDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false"> Column Visibility</button>
                            <ul class="dropdown-menu" aria-labelledby="columnDropdown" id="columnSelectorDropdown"
                                data-simplebar style="max-height: 300px;">
                                <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="0"
                                            checked> TEAM</label></li>
                                <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="1"
                                            checked> FILENAME</label></li>
                                <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="2"
                                            checked> MODULE</label></li>
                                <!-- <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="3" checked> UPLOADED TO</label></li> -->
                                <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="3"
                                            checked> STATUS</label></li>
                                <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="4"
                                            checked> ACTION</label></li>
                            </ul>
                            <button id="generate_report" class="btn btn-danger btn-sm ms-1">Generate Report</button>
                        </div>
                        <div class="tab-content mt-1">
                            <div class="col-md-12">
                                <div class="tab-pane fade active show" id="current" role="tabpanel">
                                    <div class="d-flex mb-4">
                                        <div class="flex-grow-1  ratio ratio-16x9">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-hover compact"
                                                    id="typeofsystem_table">
                                                    <thead class="table-info text-uppercase">
                                                        <tr>
                                                            <th>TEAM</th>
                                                            <th style="width: auto; ">FILENAME [ <span
                                                                    class="text-danger">click to show</span> ]</th>
                                                            <th>MODULE</th>
                                                            <!-- <th>UPLOADED</th> -->
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
                        <!-- </div>
                        </div> -->
                    </div>
                </div>
                <!-- </div> -->
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#team').select2({ placeholder: 'Select Team', allowClear: true });
        $('#module').select2({ placeholder: 'Module Name', allowClear: true });
        $('#sub_module').select2({ placeholder: 'Sub Module Name', allowClear: true });
    });
    
    const urlParams = new URLSearchParams(window.location.search);
    const teamParam   = urlParams.get('team');
    const modParam    = urlParams.get('mod');
    const uploaded    = urlParams.get('uploaded');

    $.ajax({
        url: '<?php echo base_url('get_team') ?>',
        type: 'POST',
        success: function (response) {
            teamData = JSON.parse(response);
            $('#team').empty().append('<option value="">Select Team Name</option>');
            teamData.forEach(function (team) {
                $('#team').append('<option value="' + team.team_id + '">' + team.team_name + '</option>');
            });

             if (teamParam) {
                let teamOption = $('#team option').filter(function() {
                    return $(this).text().trim() === teamParam;
                }).val();
                if (teamOption) {
                    $('#team').val(teamOption).trigger('change');
                }
            }
        }
    });
    load_module(typeofsystem);
    function load_module(typeofsystem) {
        $.ajax({
            url: '<?php echo base_url('setup_module_by_type') ?>',
            type: 'POST',
            data: {
                typeofsystem: typeofsystem,
                team: $('#team').val()
            },
            success: function (response) {
                moduleData = JSON.parse(response);
                $('#module').empty().append('<option value="">Select Module Name</option>');
                $('#sub_module').empty().append('<option value="">Select Sub Module</option>');
                $('#sub_module').prop('disabled', true);

                moduleData.forEach(function (module) {
                    $('#module').append('<option value="' + module.mod_id + '">' + module.mod_name + '</option>');
                });
                            if (modParam) {
                    let modOption = $('#module option').filter(function() {
                        return $(this).text().trim() === modParam;
                    }).val();
                    if (modOption) {
                        $('#module').val(modOption).trigger('change');
                    }
                }
            }
        });
    }

    $('#module').change(function () {
        var selectedModuleId = $(this).val();
        $('#sub_module').empty().append('<option value="">Select Sub Module</option>');
        $('#sub_module').prop('disabled', true);

        var selectedModule = moduleData.find(module => module.mod_id == selectedModuleId);

        if (selectedModule && selectedModule.submodules.length > 0) {
            $('#sub_module').prop('disabled', false);
            selectedModule.submodules.forEach(function (subModule) {
                $('#sub_module').append('<option value="' + subModule.sub_mod_id + '">' + subModule.sub_mod_name + '</option>');
            });


        }
    });

    $('#team').change(function () {
        load_module(typeofsystem);
    });
    $('#team, #module, #sub_module').change(function () {
        $('#typeofsystem_table').DataTable().ajax.reload();
        fetchDirectoryCounts();
    });

    var typeofsystem = "new";
    var type = uploaded ? uploaded : "ISR";


    if (type) {
        $("a.type").removeClass('active');
        $("#" + type).addClass('active');
    }


    console.log("Initial type:", type); 
    var table = null;
    var printWindow = null;
    $('#SYSTEM_PROPOSED').closest('a').show();
    $('#GANTT_CHART').closest('a').show();
    updateVisibility();
    load_system_content(typeofsystem, type);
    load_module(typeofsystem);
    fetchDirectoryCounts();
    $("a.typeofsystem").click(function () {
        $("a.typeofsystem").removeClass('btn-primary');
        $(this).addClass('btn-primary');
        typeofsystem = this.id;

        updateVisibility();
        load_module(typeofsystem);
        load_system_content(typeofsystem, type);
        fetchDirectoryCounts();
    });
    function updateVisibility() {
        if (typeofsystem === 'new') {
            $('#SYSTEM_PROPOSED').closest('a').show();
            $('#GANTT_CHART').closest('a').show();
            // $('#GANTT_CHART').closest('a').hide();

        } else if (typeofsystem === 'current') {
            // $('#SYSTEM_PROPOSED').closest('a').hide();
            $('#GANTT_CHART').closest('a').show();
            $('#USER_GUIDE').closest('a').show();
            $('#MEMO').closest('a').show();
            $('#BUSINESS_ACCEPTANCE').closest('a').show();
        }
    }

    $("a.type").click(function () {
        $("a.type").removeClass('btn-primary');
        $(this).addClass('btn-primary');
        type = this.id;
        load_system_content(typeofsystem, type);
    });
    function load_system_content(typeofsystem, type) {
        if (table) {
            table.destroy();
        }

        table = $('#typeofsystem_table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            destroy: true,
            lengthMenu: [[10, 25, 50, 100, 10000], [10, 25, 50, 100, "Max"]],
            pageLength: 10,
            ajax: {
                url: '<?php echo base_url('typeofsystem_data'); ?>',
                type: 'POST',
                data: function (d) {
                    d.type = type;
                    d.system = typeofsystem;
                    d.team = $('#team').val();
                    d.module = $('#module').val();
                    d.sub_module = $('#sub_module').val();
                },
            },
            columns: [
                { data: 'team_name' },
                { data: 'file_name' },
                { data: 'mod_name' },
                { data: 'status' },
                { data: 'action' }
            ],
            columnDefs: [
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
            <div style="text-align: center; margin-bottom: 20px;"><h4>LIST OF REQUESTS</h4></div>
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
            printWindow.document.title = 'LIST OF FILES FOR REQUEST - PDF Export';
            printWindow.document.write(printContent);
            printWindow.document.close();
            printWindow.print();
        });
    }

    function approved(fileId, type, typeofsystem, mod_id) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'Approving this file will allow it to proceed to the next step.?',
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
                    url: '<?php echo base_url('approved'); ?>',
                    type: 'POST',
                    data: {
                        file_id: fileId,
                        type: type,
                        typeofsystem: typeofsystem,
                        mod_id: mod_id
                    },
                    success: function () {
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 5000,
                            extendedTimeOut: 2000,
                            preventDuplicates: true,
                        };

                        toastr.success(
                            `${type} file was successfully approved`,
                        );

                        var table = $('#typeofsystem_table').DataTable();
                        var currentPage = table.page();
                        updateNotificationCount();
                        fetchDirectoryCounts();
                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                        }, false);
                    },
                });
            }
        });
    }
    function backtopending(fileId, type, typeofsystem, mod_id) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to recall this file?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Recall it!',
            cancelButtonText: 'No, cancel!',
            showLoaderOnConfirm: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo base_url('backtopending'); ?>',
                    type: 'POST',
                    data: {
                        file_id: fileId,
                        type: type,
                        typeofsystem: typeofsystem,
                        mod_id: mod_id
                    },
                    success: function () {
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 5000,
                            extendedTimeOut: 2000,
                            preventDuplicates: true,
                        };

                        toastr.success(
                            `${type} file was recalled to pending`,
                        );

                        var table = $('#typeofsystem_table').DataTable();
                        var currentPage = table.page();
                        updateNotificationCount();

                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                        }, false);

                        fetchDirectoryCounts();
                    },
                });
            }
        });
    }
    function fetchDirectoryCounts() {
        const data = {
            team: $('#team').val(),
            module: $('#module').val(),
            sub_module: $('#sub_module').val(),
            typeofsystem: typeofsystem,
        };

        $.ajax({
            url: '<?php echo base_url('Admin/get_directory_counts'); ?>',
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function (response) {
                for (const directory in response) {
                    const count = response[directory];
                    $(`#count_${directory}`).text(count > 0 ? count : '');
                }
            },
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
            </audio>`;

        } else if (['doc', 'docx', 'xlsx'].includes(extension)) {
            previewHTML = `
                    <div class="text-center p-4">
                        <p class="text-muted">Preview not available for this file type.</p>
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
        $('#folderModal').modal('hide');
    }
</script>
