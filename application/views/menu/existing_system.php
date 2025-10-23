<!-- Modal for viewing folder files -->
<div class="modal fade zoomIn" id="folderModal" tabindex="-1" aria-labelledby="folderModalLabel" aria-hidden="false"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <div class="w-100">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                            <h5 class="modal-title me-2" id="folder_name"></h5>
                            <input type="hidden" id="persistentFolderName" value="">
                            <small class="text-danger d-block fst-italic mt-1">
                                <i class="ri-information-line me-1"></i>
                                Editing and deleting files is allowed only for users from the uploader's team or belong team.
                            </small>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <?php if ($this->session->userdata('position') != 'Manager') { ?>
                                <button class="btn btn-primary rounded-pill create-folder-modal" data-bs-toggle="modal"
                                    data-bs-target="#file_upload">
                                    <i class="ri-add-line align-bottom me-1"></i> Upload Document
                                </button>
                            <?php } ?>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col-md-4">
                            <select id="teamFilter" class="form-select mb-2" aria-label="Team">
                                <option value="">Select Team</option>
                            </select>
                            <div class="mt-2 mb-2">
                                <select id="moduleFilter" class="form-select mt-2" aria-label="Module">
                                    <option value="">Select Module</option>
                                </select>
                            </div>
                            <small class="text-danger fst-italic">
                                <i class="ri-information-line me-1"></i>
                                Please select a team and module before uploading a document. The module you upload must be one that has an implemented company or business unit.
                            </small>
                        </div>

                        <div class="col-md-4">
                            <select id="subModuleFilter" class="form-select mb-2" aria-label="Submodule">
                                <option value="">Select Submodule</option>
                            </select>
                            <div class="mt-2 mb-2">
                                <select id="buFilter" class="form-select mt-2" aria-label="Business Unit">
                                    <option value="">Select Business Unit</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <select id="deptFilter" class="form-select mb-2" aria-label="Department">
                                <option value="">Select Department</option>
                            </select>
                            <div class="input-group mt-2 mb-2">
                                <input type="date" id="date_range_filter" class="form-control"
                                    placeholder="Date Range Filter" data-provider="flatpickr" data-date-format="F j, Y"
                                    data-range-date="true" />
                                <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal-body">
                <small class="text-info d-block fst-italic mt-1 fs-14">
                    <i class="ri-information-line me-1"></i>
                    <strong>Note:</strong> To preview the file, click its status ribbon shown on the file.
                </small>
                <table id="folderTable" class="table table-striped table-hover compact" width="100%">
                    <thead class="table-dark">
                        <tr>
                            <th width="20%" class="text-center">Image [ <span class="text-danger">click to show</span> ]
                            </th>
                            <th width="15%" class="text-center">Filename</th>
                            <th width="18%" class="text-center">Team</th>
                            <th width="12%" class="text-center">Uploaded By</th>
                            <th width="10%" class="text-center">Module</th>
                            <th width="15%" class="text-center">Date</th>
                            <th width="15%" class="text-center">Description</th>
                            <!-- <th width="8%" class="text-center">Type</th> -->
                            <th width="5%" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
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


<div class="modal fade zoomIn" id="editDateModal" tabindex="-1" aria-labelledby="editDateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit File Date | File Name</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editDateForm">
                    <input type="hidden" id="editFolderName" name="folder_name">
                    <input type="hidden" id="editFileName" name="file_name">
                    <div class="mb-3">
                        <label for="newFileDate" class="form-label">Filename</label>
                        <input type="text" class="form-control" id="edit_original_name" placeholder="Enter File Name">
                    </div>
                    <div class="mb-3">
                        <label for="newFileDate" class="form-label">File Description</label>
                        <textarea type="text" class="form-control" id="edit_file_description" placeholder="Description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="newFileDate" class="form-label">New Date</label>
                        <input type="date" class="form-control" id="oldFileDate" data-provider="flatpickr"
                            data-date-format="F j, Y" data-range-date="true" placeholder="Select New Date">
                    </div>
                    <button type="button" class="btn btn-success" onclick="updateFileDate()">Save Changes</button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#folderModal">Back to List</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- File Upload Modal -->
<div class="modal fade zoomIn" id="file_upload" tabindex="-1" aria-labelledby="file_upload" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title" id="uploaded_to"></h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-3">
                    <small><strong>UPLOAD DIRECTORY:</strong></small>
                    <span id="directory_name" class="text-danger fw-bold"></span>
                </p>
                <form id="uploadForm" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-12" id="isrSearchDiv" style="display: none;">
                            <label for="isrSearch" class="col-form-label">Enter ISR Number<span
                                    class="text-danger"><small>( Leave Blanked for the system that has no ISR NO.)
                                        *</small></span></label>
                            <div class="input-group">
                                <input type="search" id="isrSearch" class="form-control" placeholder="Enter ISR Number"
                                    autocomplete="off">
                                <button type="button" id="searchISR" class="btn btn-secondary">Search</button>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <label for="" class=" col-form-label">Date Range:</label>
                            <div class="input-group">
                                <input type="date" id="date_" class="form-control" readonly="" placeholder="Date Range"
                                    data-provider="flatpickr" data-date-format="F d, Y" data-range-date="true" />
                                <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <label for="title" class="col-form-label">Business Unit <span class="text-danger"><small>(
                                        Optional for no business_unit file directory )*</small></span></label>
                            <select id="business_unitFilter1" class="form-select" aria-label="Team">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="col-lg-12">
                            <label for="title" class="col-form-label">Department <span class="text-danger"><small>(
                                        Optional for no department file directory )*</small></span></label>
                            <select id="departmentFilter" class="form-select" aria-label="Team">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="col-lg-12" id="dateImplem" style="display: none;">
                            <label class="col-form-label">Date Implementation | Parallel:</label>
                            <div class="input-group">
                                <input type="date" id="date_implem" class="form-control"
                                    placeholder="Select Date Implemented" data-provider="flatpickr" />
                                <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label class="col-form-label">File Description:</label>
                            <textarea class="form-control" id="file_description" style="height: 70px"placeholder="Description"></textarea>
                        </div>
                        <div class="col-lg-12">
                            <label class="col-form-label">File Name: ( <small class="text-danger">Optional</small> )</label>
                            <input type="text" class="form-control" id="data_file_name" placeholder="Filename">
                        </div>
                        <div class="col-lg-12 mt-3">
                            <label for="fileUpload">Upload a File</label>
                            <input type="file" id="fileUpload" class="filepond filepond-input-multiple" name="file[]"
                                multiple data-allow-reorder="true" data-max-file-size="100MB" data-max-files="20" />
                            <p class="text-center mt-1">
                                <small class="text-danger"><b>Note</b>: Image file max size <b>10MB</b> | PDF max size
                                    <b>50MB</b> | Video max size <b>100MB</b></small>
                            </p>
                            <input type="hidden" hidden id="file_team" name="file_team" class="hidden">
                            <input type="hidden" hidden id="file_module" name="file_module" class="hidden">
                            <input type="hidden" hidden id="file_module_name" name="file_module_name" class="hidden">
                            <input type="hidden" hidden id="file_sub_module" name="file_sub_module" class="hidden">
                            <input type="hidden" hidden id="file_business_unitFilter" name="file_business_unitFilter"
                                class="hidden">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-lg btn-primary" id="uploadBtn">Upload</button>
                        <button type="button" class="btn btn-lg  btn-dark" id="backToListBtn">BACK TO LIST</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">EXISTING | SYSTEM</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Current System </a></li>
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
                    <div class="col-md-12 mt-1">
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
                            <select class="form-select" id="business_unitFilter">
                                <option value="">Business Unit</option>
                            </select>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row" id="folderlist-data"></div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#team').select2({ placeholder: 'Select Team', allowClear: true });
        $('#module').select2({ placeholder: 'Module Name | System', allowClear: true });
        $('#sub_module').select2({ placeholder: 'Sub Module Name', allowClear: true });
        $('#directory').select2({ placeholder: 'Select Directory', allowClear: true, minimumResultsForSearch: Infinity });
        $('#business_unitFilter,#business_unitFilter1').select2({ placeholder: 'Select Business Unit', allowClear: true, minimumResultsForSearch: Infinity });
        $('#departmentFilter').select2({ placeholder: 'Select Department', allowClear: true, minimumResultsForSearch: Infinity });
    });

    $.ajax({
        url: '<?php echo base_url('Admin/get_team_current') ?>',
        type: 'POST',
        success: function (response) {
            teamData = JSON.parse(response);
            $('#team').empty().append('<option value="">Select Team Name</option>');
            teamData.forEach(function (team) {
                $('#team').append('<option value="' + team.team_id + '">' + team.team_name + '</option>');
            });
        }
    });

    $('#team').change(function () {
        loadModule();
    });
    loadModule();
    let moduleData = [];
    let buData = [];
    function loadModule() {
        $.ajax({
            url: '<?php echo base_url('setup_module_current') ?>',
            type: 'POST',
            data: { team: $('#team').val() },
            success: function (response) {
                moduleData = JSON.parse(response);
                $('#module').empty().append('<option value="">Select Module Name</option>');
                $('#sub_module').empty().append('<option value="">Select Sub Module</option>').prop('disabled', true);
                $('#business_unitFilter').empty().append('<option value="">Select Business Unit</option>').prop('disabled', true);
                moduleData.forEach(function (module) {
                    $('#module').append(`<option value="${module.mod_id}">${module.mod_name}</option>`);
                });
            }
        });
    }

    $.ajax({
        url: '<?php echo base_url('business_unit_current') ?>',
        type: 'POST',
        success: function (response) {
            buData = JSON.parse(response);
            $('#business_unitFilter,#business_unitFilter1').empty().append('<option value="">Select Business Unit</option>').prop('disabled', true);
        }
    });

    function updateBusinessUnitDropdown(selectedModuleId) {
        $('#business_unitFilter,#business_unitFilter1').empty().append('<option value="">Select Business Unit</option>');

        if (!selectedModuleId) {
            $('#business_unitFilter,#business_unitFilter1').empty().append('<option value="">Select Business Unit</option>').prop('disabled', true);
            return;
        }

        let hasMatchingBU = false;

        buData.forEach(function (bu) {
            if (Array.isArray(bu.modules) && bu.modules.some(m => m.mod_id == selectedModuleId)) {
                $('#business_unitFilter,#business_unitFilter1').append(
                    `<option value="${bu.bcode}">${bu.business_unit}</option>`
                );
                hasMatchingBU = true;
            }
        });

        $('#business_unitFilter,#business_unitFilter1').prop('disabled', !hasMatchingBU);
    }

    $('#module').change(function () {
        var selectedModuleId = $(this).val();
        $('#sub_module').empty().append('<option value="">Select Sub Module</option>').prop('disabled', true);

        if (!selectedModuleId) {
            $('#business_unitFilter,#business_unitFilter1').empty().append('<option value="">Select Business Unit</option>').prop('disabled', true);
            return;
        }

        var selectedModule = moduleData.find(module => module.mod_id == selectedModuleId);

        if (selectedModule && selectedModule.submodules.length > 0) {
            selectedModule.submodules.forEach(function (subModule) {
                $('#sub_module').append(`<option value="${subModule.sub_mod_id}">${subModule.sub_mod_name}</option>`);
            });
            $('#sub_module').prop('disabled', false);
        }
        updateBusinessUnitDropdown(selectedModuleId);
    });



    function filter() {
        // Show loader
        $('#folderlist-data').html(`<div class="text-center text-primary" style="margin-top: 100px;"><iconify-icon icon="svg-spinners:bars-rotate-fade" width="40" height="40"></iconify-icon></div>`);
        var team = $('#team').val();
        var module = $('#module').val();
        var sub_module = $('#sub_module').val();
        var business_unitFilter = $('#business_unitFilter').val();
        $.ajax({
            url: '<?php echo base_url('Menu/Existing_System/get_folders'); ?>',
            type: 'POST',
            data: {
                team: team,
                module: module,
                sub_module: sub_module,
                bu_filter: business_unitFilter
            },
            dataType: 'json',
            success: function (response) {
                let folderListHTML = '';
                if (Array.isArray(response) && response.length > 0) {
                    $.each(response, function (index, folder) {
                        folderListHTML += `
                    <div class="col-xxl-2 col-6 folder-card">
                        <div class="card bg-light ribbon-box border" id="folder-${index}" onclick="showLoadingAndOpenFolder('${folder.name}')" style="cursor: pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="${folder.name}">
                            <div class="card-body">
                                <div class="d-flex mb-1">
                                    <div class="form-check form-check-danger mb-3 fs-15 flex-grow-1">
                                        <input type="hidden" id="foldername" value="${folder.name}">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <div class="mb-2">
                                        <iconify-icon icon="icon-park-solid:folder-one" class="align-bottom text-warning fs-48"></iconify-icon>
                                    </div>
                                    <h6 class="fs-10 folder-name fw-bold">${folder.name}</h6>
                                </div>
                                <div class="hstack mt-3 text-muted">
                                    <span class="me-auto fs-6 ribbon-three ribbon-three-primary">
                                        <span><b>${folder.matched_files ? folder.matched_files.length : 0} Files</b></span>
                                    </span>
                                    <span style="font-size: 10px">
                                        <b>${folder.size < 1024 * 1024 * 1024 ?
                                (folder.size / (1024 * 1024)).toFixed(2) + ' MB' :
                                (folder.size / (1024 * 1024 * 1024)).toFixed(2) + ' GB'}</b>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>`;
                    });
                } else {
                    folderListHTML = `
                    <div class="text-center text-muted" style="margin-top: 100px;">
                        <p>No folders found.</p>
                    </div>`;
                }
                $('#folderlist-data').html(folderListHTML);
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", error);
                $('#folderlist-data').html(`
                <div class="text-center text-danger" style="margin-top: 100px;">
                    <p>Failed to load folders. Please try again later.</p>
                </div>`);
            }
        });
    }


    filter();

    $('#team, #module, #sub_module, #business_unitFilter').on('change', function () {
        filter();
    });

    function showLoadingAndOpenFolder(folderName) {
        Swal.fire({
            title: "Opening Folder " + folderName,
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            icon: "info",
            html: "Please wait...",
            didOpen: () => {
                Swal.showLoading();
                setTimeout(() => {
                    openFolderModal(folderName);
                }, 1000);
            }
        });
    }


</script>

<script>

    $(document).ready(function () {
        $('#teamFilter').select2({ placeholder: 'Team Name', allowClear: true, dropdownParent: $('#folderModal') });
        $('#moduleFilter').select2({ placeholder: 'Module Name', allowClear: true, dropdownParent: $('#folderModal') });
        $('#subModuleFilter').select2({ placeholder: 'Sub Module Name', allowClear: true, dropdownParent: $('#folderModal') });
        $('#buFilter').select2({ placeholder: 'Select Business Unit', allowClear: true, dropdownParent: $('#folderModal') });
        $('#deptFilter').select2({ placeholder: 'Select Department', allowClear: true, dropdownParent: $('#folderModal') });
    });

    function openFolderModal(folderName) {
        Swal.close();
        $('#persistentFolderName').val(folderName);
        var team1 = $('#team').val();
        var module1 = $('#module').val();
        var sub_module1 = $('#sub_module').val();
        var business_unit = $('#business_unitFilter').val();

        $.ajax({
            url: '<?php echo base_url('Admin/get_team_current') ?>',
            type: 'POST',
            success: function (response) {
                teamData = JSON.parse(response);
                $('#teamFilter').empty().append('<option value="">Select Team Name</option>');
                teamData.forEach(function (team) {
                    $('#teamFilter').append('<option value="' + team.team_id + '">' + team.team_name + '</option>');
                });

                $('#teamFilter').val(team1).trigger('change');

                setTimeout(function () {
                    var currentModuleValue = $('#module').val();
                    loadModule1(currentModuleValue);
                }, 100);
            }
        });
        $('#teamFilter').change(function () {
            loadModule1();
        });

        function loadModule1(selectedModuleId = "") {
            $.ajax({
                url: '<?php echo base_url('setup_module_current') ?>',
                type: 'POST',
                data: {
                    team: $('#teamFilter').val()
                },
                success: function (response) {
                    moduleData = JSON.parse(response);

                    $('#moduleFilter').empty().append('<option value="">Select Module Name</option>');
                    $('#subModuleFilter').empty().append('<option value="">Select Sub Module</option>').prop('disabled', true);
                    $('#buFilter, #business_unitFilter1').empty().append('<option value="">Select Business Unit</option>').prop('disabled', true);

                    moduleData.forEach(function (module) {
                        $('#moduleFilter').append(`<option value="${module.mod_id}">${module.mod_name}</option>`);
                    });

                    if (selectedModuleId && $('#moduleFilter option[value="' + selectedModuleId + '"]').length) {
                        $('#moduleFilter').val(selectedModuleId).trigger('change');
                    } else {
                        $('#moduleFilter').val('').trigger('change');
                    }
                }
            });
        }

        $.ajax({
            url: '<?php echo base_url('business_unit_current') ?>',
            type: 'POST',
            success: function (response) {
                buData = JSON.parse(response);
                $('#business_unitFilter1, #buFilter').empty().append('<option value="">Select Business Unit</option>').prop('disabled', true);
            }
        });

        function updateBusinessUnitDropdown(selectedModuleId) {
            $('#business_unitFilter1, #buFilter').empty().append('<option value="">Select Business Unit</option>');

            if (!selectedModuleId) {
                $('#business_unitFilter1, #buFilter').empty().append('<option value="">Select Business Unit</option>').prop('disabled', true);
                return;
            }

            let hasMatchingBU = false;

            buData.forEach(function (bu) {
                if (Array.isArray(bu.modules) && bu.modules.some(m => m.mod_id == selectedModuleId)) {
                    $('#business_unitFilter1, #buFilter').append(
                        `<option value="${bu.bcode}">${bu.business_unit}</option>`
                    );
                    hasMatchingBU = true;
                }
            });
            $('#buFilter').val(business_unit).trigger('change');
            $('#business_unitFilter1, #buFilter').prop('disabled', !hasMatchingBU);
        }

        $('#moduleFilter').change(function () {
            var selectedModuleId = $(this).val();
            $('#subModuleFilter').empty().append('<option value="">Select Sub Module</option>').prop('disabled', true);

            if (!selectedModuleId) {
                $('#business_unitFilter1, #buFilter').empty().append('<option value="">Select Business Unit</option>').prop('disabled', true);
                return;
            }

            var selectedModule = moduleData.find(module => module.mod_id == selectedModuleId);

            if (selectedModule && selectedModule.submodules.length > 0) {
                selectedModule.submodules.forEach(function (subModule) {
                    $('#subModuleFilter').append(`<option value="${subModule.sub_mod_id}">${subModule.sub_mod_name}</option>`);
                });
                $('#subModuleFilter').prop('disabled', false);

                $('#subModuleFilter').val(sub_module1).trigger('change');

            }
            updateBusinessUnitDropdown(selectedModuleId);
        });

        $('#business_unitFilter1, #buFilter').change(function () {
            $('#deptFilter, #departmentFilter').empty().append('<option value="">Select Department</option>');
            $('#deptFilter, #departmentFilter').prop('disabled', true);
            var selectedBusinessUnit = $(this).val();
            if (selectedBusinessUnit) {
                $.ajax({
                    url: '<?php echo base_url('department') ?>',
                    type: 'POST',
                    data: {
                        business_unit: selectedBusinessUnit
                    },
                    success: function (response) {
                        deptData = JSON.parse(response);
                        $('#deptFilter, #departmentFilter').empty().append('<option value="">Select Department</option>');
                        deptData.forEach(function (dept) {
                            $('#deptFilter, #departmentFilter').append('<option value="' + dept.dcode + '">' + dept.dept_name + '</option>');
                        });
                        $('#deptFilter, #departmentFilter').prop('disabled', false);
                    }
                });
            }
        });

        let teamValue = '',
            teamName = '',
            moduleValue = '',
            moduleName = '',
            subModuleValue = '',
            subModuleName = '',
            buValue = '',
            business_unitFilter = '';
            deptValue = '',
            deptFilter = '';


        function updateCreateFolderButtonState() {
            const teamVal = $('#teamFilter').val();
            const moduleVal = $('#moduleFilter').val();
            const isDisabled = !(teamVal && moduleVal);
            $('.create-folder-modal').prop('disabled', isDisabled);
        }

        teamValue = $('#teamFilter').val();
        teamName = teamValue ? $('#teamFilter option:selected').text() : '';

        moduleValue = $('#moduleFilter').val();
        moduleName = moduleValue ? $('#moduleFilter option:selected').text() : '';

        subModuleValue = $('#subModuleFilter').val();
        subModuleName = subModuleValue ? $('#subModuleFilter option:selected').text() : '';

        buValue = $('#buFilter').val();
        business_unitFilter = buValue ? $('#buFilter option:selected').text() : '';
        $('#business_unitFilter1').val(buValue).trigger('change');

        updateCreateFolderButtonState();

        $('#file_upload').on('show.bs.modal', function () {
            let directory_name = $('#persistentFolderName').val();

            $('#directory_name').text(directory_name);
            $('#file_team').val(teamValue);
            $('#file_module').val(moduleValue);
            $('#file_module_name').val(moduleName);
            $('#file_sub_module').val(subModuleValue);
            $('#file_business_unitFilter').val(business_unitFilter);

            let uploadedToParts = [teamName, moduleName, subModuleName, business_unitFilter].filter(Boolean);
            $('#uploaded_to').text(uploadedToParts.join(' | '));

            $('#business_unitFilter1, #departmentFilter, #date_').prop('disabled', !directory_name);
        });

        $('#teamFilter, #moduleFilter, #subModuleFilter, #buFilter, #deptFilter, #date_range_filter').on('change', function () {
            teamValue = $('#teamFilter').val();
            teamName = teamValue ? $('#teamFilter option:selected').text() : '';

            moduleValue = $('#moduleFilter').val();
            moduleName = moduleValue ? $('#moduleFilter option:selected').text() : '';

            subModuleValue = $('#subModuleFilter').val();
            subModuleName = subModuleValue ? $('#subModuleFilter option:selected').text() : '';

            buValue = $('#buFilter').val();
            business_unitFilter = buValue ? $('#buFilter option:selected').text() : '';

            updateCreateFolderButtonState();
            updateFolderModalContent();
        });

        $('#folderModal').modal('show');

    }
    let folderContentTimeout;

    function updateFolderModalContent() {
        clearTimeout(folderContentTimeout);

        folderContentTimeout = setTimeout(function () {
            var folderName = $('#persistentFolderName').val();
            var teamFilter = $('#teamFilter').val();
            var moduleFilter = $('#moduleFilter').val();
            var subModuleFilter = $('#subModuleFilter').val();
            var buFilter = $('#buFilter').val();
            var deptFilter = $('#deptFilter').val();
            var date = $('#date_range_filter').val();
            $('#folder_name').text(folderName.replace(/_/g, ' ') + ' FILES');

            $('#folderTable').DataTable({
                processing: true,
                destroy: true,
                stateSave: true,
                ajax: {
                    url: '<?php echo base_url("Menu/Existing_System/view_folder_modal_server"); ?>',
                    type: 'GET',
                    data: {
                        folder_name: folderName,
                        team: teamFilter,
                        module: moduleFilter,
                        sub_module: subModuleFilter,
                        business_unit: buFilter,
                        department: deptFilter,
                        date: date
                    }
                },
                columns: [
                    { data: 'name' },
                    { data: 'filename' },
                    { data: 'team_name' },
                    { data: 'uploaded_by' },
                    { data: 'mod_abbr' },
                    { data: 'date' },
                    { data: 'file_desc' },
                    // { data: 'path' },
                    { data: 'edit' }
                ],
                columnDefs: [
                    {
                        targets: [0],
                        className: 'text-center',
                        orderable: false
                    }
                ]
            });
        }, 500);
    }


    $('#folderModal').on('shown.bs.modal', function () {
        $('#folderTable').DataTable().columns.adjust().responsive.recalc();
    });


    $('#backToListBtn').on('click', function () {
        $('#file_upload').modal('hide');

        $('#file_upload').on('hidden.bs.modal', function () {
            $('#folderModal').modal('show');
            // Remove the listener so it doesn't stack
            $(this).off('hidden.bs.modal');
        });
    });

    $('.create-folder-modal').on('click', function () {
        const folderName = $('#persistentFolderName').val();
        console.log(folderName);
        if (folderName === 'ISR') {
            $('#isrSearchDiv').show();
        } else {
            $('#isrSearchDiv').hide();
        }

        if (folderName === 'LIVE_TESTING') {
            $('#dateImplem').show();
        } else {
            $('#dateImplem').hide();
        }
    });



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
        $('#folderModal').modal('hide');
    }
    function formatFileSize(bytes) {
        if (bytes < 1024) return bytes + ' B';
        else if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(2) + ' KB';
        else if (bytes < 1024 * 1024 * 1024) return (bytes / (1024 * 1024)).toFixed(2) + ' MB';
        else return (bytes / (1024 * 1024 * 1024)).toFixed(2) + ' GB';
    }

    function openEditDateModal(folderName, fileName, currentDate, original_file_name, file_desc) {
        $('#editFolderName').val(folderName);
        $('#editFileName').val(fileName);
        $('#oldFileDate').val(currentDate);
        $('#edit_original_name').val(original_file_name);
        $('#edit_file_description').val(file_desc);
        $('#editDateModal').modal('show');
        $('#folderModal').modal('hide');
    }

    function updateFileDate() {
        const folderName = $('#editFolderName').val();
        const fileName = $('#editFileName').val();
        const oldDate = $('#oldFileDate').val();
        const original_file_name = $('#edit_original_name').val();
        const file_desc = $('#edit_file_description').val();

        var folder = $('#persistentFolderName').val();
        var team = $('#teamFilter').val();
        var module = $('#moduleFilter').val();
        var sub_module = $('#subModuleFilter').val();
        var business_unit = $('#buFilter').val();
        var department = $('#deptFilter').val();
        var date = $('#date_range_filter').val();

        Swal.fire({
            title: 'Are you sure?',
            html: `Do you want to update <br> <b>"${fileName}"?</b>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo base_url('Menu/Existing_System/update_file_date'); ?>',
                    type: 'POST',
                    data: {
                        folder_name: folderName,
                        file_name: fileName,
                        new_date: oldDate,
                        original_file_name: original_file_name,
                        file_desc: file_desc
                    },
                    success: function (response) {
                        const res = JSON.parse(response);
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 3000,
                            extendedTimeOut: 2000,
                        };
                        toastr.success('Data updated successfully');
                        $('#editDateModal').modal('hide');
                        $('#folderModal').modal('show');
                        $('#folderTable').DataTable().ajax.reload();
                        updateFolderModalContent();
                    }
                });
            }
        });
    }

</script>

<script src="<?php echo base_url(); ?>assets/js/filepond.js"></script>
<script src="<?php echo base_url(); ?>assets/js/filepond-plugin-image-preview.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/filepond-plugin-file-validate-size.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/filepond-plugin-image-exif-orientation.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/filepond-plugin-file-encode.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        FilePond.registerPlugin(
            FilePondPluginFileEncode,
            FilePondPluginFileValidateSize,
            FilePondPluginImageExifOrientation,
            FilePondPluginImagePreview
        );

        document.querySelectorAll("input.filepond-input-multiple").forEach(function (inputElement) {
            FilePond.create(inputElement);
        });

        document.querySelector('#uploadForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const directory = document.querySelector('#persistentFolderName').value;
            const team = document.querySelector('#file_team').value;
            const module = document.querySelector('#file_module').value;
            const moduleName = document.querySelector('#file_module_name').value;
            const sub_module = document.querySelector('#file_sub_module').value;
            const business_unit = document.querySelector('#business_unitFilter1').value;
            const department = document.querySelector('#departmentFilter').value;
            const bu_name = document.querySelector('#business_unitFilter1 option:checked')?.textContent || '';
            const dept_name = document.querySelector('#departmentFilter option:checked')?.textContent || '';
            const isr = document.querySelector('#isrSearch').value;
            const date_implem = document.querySelector('#date_implem').value;
            const date_ = document.querySelector('#date_').value;
            const file_desc = document.querySelector('#file_description').value;
            const data_file_name = document.querySelector('#data_file_name').value;

            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to upload this file to the "${directory}" directory.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, upload it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = new FormData();
                    formData.append('directory', directory);
                    formData.append('file_team', team);
                    formData.append('file_module', module);
                    formData.append('file_module_name', moduleName);
                    formData.append('file_sub_module', sub_module);
                    formData.append('business_unit', business_unit);
                    formData.append('department', department);
                    formData.append('isr', isr);
                    formData.append('date_implem', date_implem);
                    formData.append('bu_name', bu_name);
                    formData.append('dept_name', dept_name);
                    formData.append('date_', date_);
                    formData.append('file_desc', file_desc);
                    formData.append('data_file_name', data_file_name);

                    const pond = FilePond.find(document.querySelector(".filepond-input-multiple"));
                    const files = pond.getFiles();

                    if (files.length === 0) {
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 3000,
                            extendedTimeOut: 2000,
                        };
                        toastr.error(
                            `No files were selected`,
                        );
                        return;
                    }
                    files.forEach(fileItem => {
                        formData.append('file[]', fileItem.file);
                    });

                    const uploadButton = document.querySelector('#uploadBtn');
                    uploadButton.innerHTML = `
                    <span class="d-flex align-items-center">
                        <span class="spinner-border" role="status">
                            <span class="visually-hidden">Uploading...</span>
                        </span>
                        <span class="flex-grow-1 ms-2">Uploading...</span>
                    </span>
                `;
                    uploadButton.disabled = true;

                    $.ajax({
                        url: '<?php echo base_url('Menu/Existing_System/upload_file'); ?>',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            response = JSON.parse(response);

                            if (response.success) {
                                toastr.options = {
                                    progressBar: true,
                                    positionClass: "toast-top-left",
                                    timeOut: 3000,
                                    extendedTimeOut: 2000,

                                };

                                toastr.success(
                                    `${response.message}`,
                                );
                                $('#file_upload').modal('hide');
                                const pond = FilePond.find(document.querySelector(".filepond-input-multiple"));
                                if (pond) {
                                    pond.removeFiles();
                                }
                                document.getElementById('uploadForm').reset();
                                // $('#directory').val('').trigger('change');
                                $('#business_unitFilter1').val('').trigger('change');
                                $('#departmentFilter').val('').trigger('change');
                                filter();
                                $('#folderTable').DataTable().ajax.reload();
                                $('#folderModal').modal('show');
                                updateFolderModalContent();
                            } else {
                                toastr.options = {
                                    progressBar: true,
                                    positionClass: "toast-top-left",
                                    timeOut: 3000,
                                    extendedTimeOut: 2000,

                                };

                                toastr.error(
                                    `${response.message}`,
                                );
                            }

                            uploadButton.innerHTML = 'Upload Files';
                            uploadButton.disabled = false;
                        },
                    });

                } else {
                    return;
                }
            });
        });
    });


    function deleteFile(folderName, fileName, module) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to delete this file?',
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
                    url: '<?php echo base_url('delete_file'); ?>',
                    type: 'POST',
                    data: {
                        folder_name: folderName,
                        file_name: fileName,
                        module: module
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            toastr.options = {
                                progressBar: true,
                                positionClass: "toast-top-left",
                                timeOut: 3000,
                                extendedTimeOut: 2000,

                            };

                            toastr.success(
                                `Successfully deleted`,
                            );
                            // openFolderModal(folderName);
                            $('#folderTable').DataTable().ajax.reload();
                            filter();
                        } else {
                            toastr.options = {
                                progressBar: true,
                                positionClass: "toast-top-left",
                                timeOut: 3000,
                                extendedTimeOut: 2000,

                            };

                            toastr.error(
                                `${response.error}`,
                            );
                        }
                    }
                });
            }
        });
    }
</script>
<script>
    $(document).ready(function () {
        $('#searchISR').click(function () {
            let requestNumber = $('#isrSearch').val();
            const isrfound = Swal.fire({
                title: "Searching ISR #" + requestNumber,
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                icon: "info",
                html: "Please wait...",
                didOpen: () => {
                    Swal.showLoading();
                    const timer = Swal.getPopup().querySelector("b");
                },
            });

            $.ajax({
                url: '<?php echo base_url('Menu/Existing_System/get_isr_request'); ?>',
                type: 'POST',
                data: { requestnumber: requestNumber },
                dataType: 'json',
                success: function (response) {
                    if (response.length > 0) {
                        setTimeout(() => {
                            toastr.options = {
                                progressBar: true,
                                positionClass: "toast-top-left",
                                timeOut: 3000,
                                extendedTimeOut: 2000,

                            };

                            toastr.success(
                                `ISR Number Found`,
                            );
                            isrfound.close();
                        }, 1000);
                        $('#business_unitFilter1, #departmentFilter, #fileUpload, #uploadBtn').prop('disabled', false);
                    } else {
                        setTimeout(() => {
                            toastr.options = {
                                progressBar: true,
                                positionClass: "toast-top-left",
                                timeOut: 3000,
                                extendedTimeOut: 2000,

                            };

                            toastr.error(
                                `ISR Number not found | Not yet approved.`
                            );
                            isrfound.close();
                        }, 1000);
                    }
                },
            });
        });
        $('#isrSearch').on('input', function () {
            if ($(this).val() === '') {
                $('#business_unitFilter1, #departmentFilter, #fileUpload, #uploadBtn').prop('disabled', true);
            }
        });
    });

</script>
<script>
    $(document).on({
        mouseenter: function () {
            $(this).tooltip('show');
        },
        mouseleave: function () {
            $('.tooltip').remove();
        }
    }, '[data-bs-toggle="tooltip"]');
    $('#folderModal').on('shown.bs.modal', function () {
        $('#folderModalBody').css('max-height', '60vh').css('overflow-y', 'auto');
    });

</script>