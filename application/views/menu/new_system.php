<!-- Modal for viewing folder files -->
<div class="modal fade" id="folderModal" tabindex="-1" aria-labelledby="folderModalLabel" aria-hidden="false"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title" id="folder_name"></h5>
                <input type="hidden" id="persistentFolderName" value="">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-md-12 mb-3">
                    <div class="d-flex gap-2">
                        <select id="teamFilter" class="form-select" aria-label="Team">
                            <option value=""></option>
                        </select>
                        <select id="moduleFilter" class="form-select">
                            <option value="">Select Module</option>
                        </select>
                        <select id="subModuleFilter" class="form-select">
                            <option value="">Select Submodule</option>
                        </select>
                        <select id="buFilter" class="form-select">
                            <option value="">Select Business Unit</option>
                        </select>
                        <select id="deptFilter" class="form-select">
                            <option value="">Select Department</option>
                        </select>
                    </div>
                </div>
                <div class="input-group">
                    <input type="date" id="date_range_filter" class="form-control" placeholder="Date Range Filter"
                        data-provider="flatpickr" data-date-format="F j, Y" data-range-date="true" />
                    <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                </div>
                <hr>
                <div class="row" id="folderModalBody"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editDateModal" tabindex="-1" aria-labelledby="editDateModalLabel" aria-hidden="true">
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
                        <label class="form-label">Filename</label>
                        <input type="text" class="form-control" id="edit_original_name" placeholder="Enter File Name">
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
<div class="modal fade" id="file_upload" tabindex="-1" aria-labelledby="file_upload" data-bs-backdrop="static"
    data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title" id="uploaded_to"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="uploadForm" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="directory">Select Directory</label>
                            <select class="form-select" id="directory" name="directory">
                                <option value=""></option>
                                <option value="ISR">ISR</option>
                                <option value="ATTENDANCE">ATTENDANCE</option>
                                <option value="MINUTES">MINUTES</option>
                                <option value="WALKTHROUGH">WALKTHROUGH</option>
                                <option value="FLOWCHART">FLOWCHART</option>
                                <option value="DFD">DFD</option>
                                <option value="SYSTEM_PROPOSED">SYSTEM_PROPOSED</option>
                                <option value="LOCAL_TESTING">LOCAL TESTING</option>
                                <option value="UAT">UAT</option>
                                <option value="LIVE_TESTING">LIVE TESTING</option>
                                <option value="USER_GUIDE">USER_GUIDE</option>
                                <option value="MEMO">MEMO</option>
                                <option value="BUSINESS_ACCEPTANCE">BUSINESS_ACCEPTANCE</option>
                            </select>
                        </div>
                        <div class="col-lg-12" id="isrSearchDiv" style="display: none;">
                            <label for="isrSearch" class="col-form-label">Enter ISR Request Number</label>
                            <div class="input-group">
                                <input type="search" id="isrSearch" class="form-control"
                                    placeholder="Enter ISR Request Number" autocomplete="off">
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
                                <input type="date" id="date_implem" class="form-control" readonly=""
                                    placeholder="Select Date Implemented" data-provider="flatpickr" />
                                <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                            </div>
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
                        <button type="button" class="btn btn-lg btn-dark" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- Create Module -->
<div class="modal fade" id="add_new_system" tabindex="-1" aria-labelledby="create_module" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title" id="varyingcontentModalLabel">SETUP MODULE | SYSTEM</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    <label for="title" class="col-form-label">Module | System Name:</label>
                    <input type="text" class="form-control" id="mod_name" placeholder="Module Name">
                </div>

                <div class="mb-2">
                    <label for="title" class="col-form-label">Module Abbreviation:</label>
                    <input type="text" class="form-control" id="mod_abbr" placeholder="Abbreviation">
                </div>

                <div class="mb-2">
                    <label class="col-form-label">Date Request:</label>
                    <div class="input-group">
                        <input type="date" id="date_request" class="form-control" readonly=""
                            placeholder="Select Date Request" data-provider="flatpickr" />
                        <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                    </div>
                </div>

                <div class="mb-2">
                    <label for="title" class="col-form-label">Requested To</label>
                    <select id="business_unit" class="form-select" aria-label="Team">
                        <option value=""></option>
                    </select>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="add_new_module()">Submit</button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">NEW | SYSTEM</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">New System </a></li>
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
                            <?php
                            if ($this->session->userdata('position') != 'Manager') { ?>
                                <button class="btn btn-primary w-sm create-folder-modal flex-shrink-0"
                                    data-bs-toggle="modal" data-bs-target="#file_upload">
                                    <i class="ri-add-line align-bottom me-1"></i> Upload Document
                                </button>
                                <a class="btn btn-primary w-sm flex-shrink-0" href="<?= base_url('module_view') ?>">
                                    <i class="ri-add-line align-bottom me-1"></i> New System
                                </a>
                                <?php
                            }
                            ?>
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

        $('#teamFilter').select2({ placeholder: 'Team Name', allowClear: true, minimumResultsForSearch: Infinity });
        $('#moduleFilter').select2({ placeholder: 'Module Name', allowClear: true, minimumResultsForSearch: Infinity });
        $('#subModuleFilter').select2({ placeholder: 'Sub Module Name', allowClear: true, minimumResultsForSearch: Infinity });

        $('#business_unitFilter,#business_unitFilter1, #buFilter').select2({ placeholder: 'Select Business Unit', allowClear: true, minimumResultsForSearch: Infinity });
        $('#departmentFilter, #deptFilter').select2({ placeholder: 'Select Department', allowClear: true, minimumResultsForSearch: Infinity });

        $('#isr_files').select2({ placeholder: 'Select File', allowClear: true, minimumResultsForSearch: Infinity });

    });


    $(document).ready(function () {
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

        $.ajax({
            url: '<?php echo base_url('Menu/Current_Sys/get_dir') ?>',
            type: 'POST',
            success: function (response) {
                dirData = JSON.parse(response);
                $('#directory').empty().append('<option value="">Select Directory</option>');
                dirData.forEach(function (dir) {
                    $('#directory').append('<option value="' + dir.dir_name + '">' + dir.dir_name + '</option>');
                });
            }
        });
    });

    let moduleData = [];
    let buData = [];

    function loadModule() {
        $.ajax({
            url: '<?php echo base_url('setup_module_new') ?>',
            type: 'POST',
            data: { team_id: $('#team').val() },
            success: function (response) {
                moduleData = JSON.parse(response);
                $('#module').empty().append('<option value="">Select Module Name</option>');
                $('#sub_module').empty().append('<option value="">Select Sub Module</option>').prop('disabled', true);
                $('#business_unitFilter,#business_unitFilter1, #buFilter').empty().append('<option value="">Select Business Unit</option>').prop('disabled', true);

                moduleData.forEach(function (module) {
                    $('#module').append(`<option value="${module.mod_id}">${module.mod_name}</option>`);
                });
            }
        });
    }

    $.ajax({
        url: '<?php echo base_url('business_unit') ?>',
        type: 'POST',
        success: function (response) {
            buData = JSON.parse(response);
            $('#business_unitFilter,#business_unitFilter1, #buFilter').empty().append('<option value="">Select Business Unit</option>').prop('disabled', true);
        }
    });

    function updateBusinessUnitDropdown(selectedModuleId) {
        $('#business_unitFilter,#business_unitFilter1, #buFilter').empty().append('<option value="">Select Business Unit</option>');

        if (!selectedModuleId) {
            $('#business_unitFilter,#business_unitFilter1, #buFilter').empty().append('<option value="">Select Business Unit</option>').prop('disabled', true);
            return;
        }

        let hasMatchingBU = false;

        buData.forEach(function (bu) {
            if (Array.isArray(bu.modules) && bu.modules.some(m => m.mod_id == selectedModuleId)) {
                $('#business_unitFilter,#business_unitFilter1, #buFilter').append(
                    `<option value="${bu.bcode}">${bu.business_unit}</option>`
                );
                hasMatchingBU = true;
            }
        });

        $('#business_unitFilter,#business_unitFilter1, #buFilter').prop('disabled', !hasMatchingBU);
    }

    $('#module').change(function () {
        var selectedModuleId = $(this).val();
        $('#sub_module').empty().append('<option value="">Select Sub Module</option>').prop('disabled', true);

        if (!selectedModuleId) {
            $('#business_unitFilter,#business_unitFilter1, #buFilter').empty().append('<option value="">Select Business Unit</option>').prop('disabled', true);
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

    loadModule();

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

    let teamValue = '', moduleValue = '', subModuleValue = '', moduleName = '', subModuleName = '', business_unitFilter = '';

    $('#team').change(function () {
        teamValue = $(this).val();
        teamName = $('#team option:selected').text();
        loadModule();
    });

    $('#module').change(function () {
        moduleValue = $(this).val();
        moduleName = $('#module option:selected').text();
    });

    // Store sub-module and sub-module name
    $('#sub_module').change(function () {
        teamValue = $(this).val();
        subModuleName = $('#sub_module option:selected').text();
    });

    $('#business_unitFilter').change(function () {
        buValue = $(this).val();
        business_unitFilter = $('#business_unitFilter option:selected').text();
        $('#business_unitFilter1').val(buValue).trigger('change');
    });

    $('#file_upload').on('show.bs.modal', function () {
        $('#file_team').val(teamValue);
        $('#file_module').val(moduleValue);
        $('#file_sub_module').val(subModuleValue);
        $('#file_module_name').val(moduleName);
        $('#file_business_unitFilter').val(business_unitFilter);
        let displaySubModuleName = subModuleName || "";
        $('#uploaded_to').text(`${teamName} | ${moduleName} | ${displaySubModuleName} | ${business_unitFilter}`);

        $('#directory').change(function () {
            $('#business_unitFilter1, #departmentFilter').prop('disabled', !$(this).val());
            if ($(this).val() === 'ISR') {
                $('#isrSearchDiv').show();
                $('#business_unitFilter1, #departmentFilter, #fileUpload, #uploadBtn').prop('disabled', true);
            } else {
                $('#isrSearchDiv').hide();
            }
        });
        $('#business_unitFilter1, #departmentFilter').prop('disabled', !$('#directory').val());

    });

    function toggleUploadButton() {
        const isDisabled = !teamValue || !moduleValue
        $('.create-folder-modal').prop('disabled', isDisabled);
    }

    toggleUploadButton();

    $('#team, #module, #sub_module, #business_unitFilter').change(function () {
        teamValue = $('#team').val();
        teamName = $('#team option:selected').text();
        moduleName = $('#module option:selected').text();
        submoduleName = $('#sub_module option:selected').text();
        moduleValue = $('#module').val();
        subModuleValue = $('#sub_module').val();
        business_unitFilter = $('#business_unitFilter option:selected').text();

        toggleUploadButton();
        toastr.options = {
            progressBar: true,
            positionClass: "toast-top-left",
            timeOut: 3000,
            extendedTimeOut: 2000,

        };

        toastr.success(
            `${teamName || ''} | ${moduleName || ''} | ${submoduleName || ''} | ${business_unitFilter || ''}`,
        );

    });

</script>

<script>
    filter();

    $('#team, #module, #sub_module, #business_unitFilter').on('change', function () {
        filter();
    });

    function filter() {
        $('#folderlist-data').html('<div class="text-center text-primary" style="margin-top: 100px;"><iconify-icon icon="svg-spinners:bars-rotate-fade" width="40" height="40"></iconify-icon></div>');
        var team = $('#team').val();
        var module = $('#module').val();
        var sub_module = $('#sub_module').val();
        var bu_filter = $('#business_unitFilter').val();

        $.ajax({
            url: '<?php echo base_url('get_new_folders'); ?>',
            type: 'POST',
            data: {
                team: team,
                module: module,
                sub_module: sub_module,
                bu_filter: bu_filter
            },
            dataType: 'json',

            success: function (response) {
                var folderListHTML = '';
                $.each(response, function (index, folder) {
                    folderListHTML += `
                    <div class="col-xxl-2 col-6 folder-card">
                        <div class="card bg-light ribbon-box border" id="folder-` + index + `" onclick="openFolderModal('` + folder.name + `')" style="cursor: pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="` + folder.name + `" >
                            <div class="card-body">
                                <div class="d-flex mb-1">
                                    <div class="form-check form-check-danger mb-3 fs-15 flex-grow-1">
                                        <input type="hidden" id="foldername" value="` + folder.name + `">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <div class="mb-2">
                                        <iconify-icon icon="fluent:folder-list-16-filled"
                                            class="align-bottom text-warning fs-48"></iconify-icon>
                                    </div>
                                    <h6 class="fs-10 folder-name fw-bold">` + folder.name + `</h6>
                                </div>
                                <div class="hstack mt-3 text-muted">
                                    <span class="me-auto fs-6 ribbon-three ribbon-three-primary">
                                        <span><b>` + (folder.matched_files ? folder.matched_files.length : 0) + ` Files</b></span>
                                    </span>
                                    <span style="font-size: 11px">
                                        <b>` + (folder.size < 1024 * 1024 * 1024 ?
                            (folder.size / (1024 * 1024)).toFixed(2) + ' MB' :
                            (folder.size / (1024 * 1024 * 1024)).toFixed(2) + ' GB') + `</b>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>`;
                });
                $('#folderlist-data').html(folderListHTML);

                // Remove the click handler for the dropdown button
                // The entire card is now clickable, so no need for this handler anymore
                // $('.open-folder-btn').on('click', function () {
                //     var folderName = $(this).data('folder');
                //     openFolderModal(folderName);
                // });
            },
        });
    }

    function openFolderModal(folderName) {
        $('#persistentFolderName').val(folderName);
        const swalInstance = Swal.fire({
            title: "Opening Folder  <br> <b>" + folderName + "</b>",
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            icon: "info",
            html: "<small>Please wait...</small>",
            didOpen: () => {
                Swal.showLoading();
            },
        });

        var team = $('#team').val();
        var module = $('#module').val();
        var sub_module = $('#sub_module').val();
        var business_unit = $('#business_unitFilter').val();
        var department = $('#deptFilter').val() || '';
        $.ajax({
            url: '<?php echo base_url('get_filter_options_new'); ?>',
            type: 'POST',
            dataType: 'json',
            data: {
                business_unit: business_unit,
                team: team
            },
            success: function (response) {
                swalInstance.close();

                var teamOptions = '<option value="">Select Team</option>';
                var buOptions = '<option value="">Select Business Unit</option>';
                var deptOptions = '<option value="">Select Department</option>';

                response.teams.forEach(teamItem => {
                    teamOptions += `<option value="${teamItem.team_id}">${teamItem.team_name}</option>`;
                });

                response.bu.forEach(bunit => {
                    buOptions += `<option value="${bunit.bcode}">${bunit.business_unit}</option>`;
                });

                response.bu.forEach(dept => {
                    deptOptions += `<option value="${dept.bcode}">${dept.business_unit}</option>`;
                });

                $('#teamFilter').html(teamOptions).val(team).trigger('change');
                $('#buFilter').html(buOptions).val(business_unit).trigger('change');
                $('#departmentFilter').html(deptOptions).val(department).trigger('change');
                updateModules(response, team, module, sub_module);

                // Load modal content
                updateFolderModalContent(folderName, team, module, sub_module, business_unit, department,1, null);


            }
        });
    }

    function updateModules(response, selectedTeam, selectedModule, selectedSubModule) {
        let moduleOptions = '<option value="">Select Module</option>';
        const modules = response.modules || [];

        modules.forEach(mod => {
            moduleOptions += `<option value="${mod.module_id}">${mod.mod_name}</option>`;
        });

        $('#moduleFilter').html(moduleOptions).val(selectedModule).trigger('change');

        // Immediately update submodules if applicable
        if (selectedModule) {
            updateSubModules(response, selectedModule, selectedSubModule);
        }
    }

    function updateSubModules(response, selectedModuleId, selectedSubModule) {
        const subModules = response.sub_modules || [];
        const filtered = subModules.filter(sub => sub.mod_id === selectedModuleId);
        let subOptions = '<option value="">Select Submodule</option>';

        filtered.forEach(sub => {
            subOptions += `<option value="${sub.sub_mod_id}">${sub.sub_mod_name}</option>`;
        });

        $('#subModuleFilter').html(subOptions).val(selectedSubModule).prop('disabled', filtered.length === 0);
    }

    function buFilterDropdowninmodal(selectedModuleId) {
        $('#buFilter').empty().append('<option value="">Select Business Unit</option>');

        if (!selectedModuleId) {
            $('#buFilter').empty().append('<option value="">Select Business Unit</option>').prop('disabled', true);
            return;
        }
        let hasMatchingBU = false;
        buData.forEach(function (bu) {
            if (Array.isArray(bu.modules) && bu.modules.some(m => m.mod_id == selectedModuleId)) {
                $('#buFilter').append(
                    `<option value="${bu.bcode}">${bu.business_unit}</option>`
                );
                hasMatchingBU = true;
            }
        });
        $('#buFilter').prop('disabled', !hasMatchingBU);
    }

    function updateFolderModalContent(folderName = $('#persistentFolderName').val(), team, module, sub_module, business_unit, department, page = 1, date) {
        const itemsPerPage = 12;
        $('#folderModalBody').html('<div class="text-center text-primary"><iconify-icon icon="svg-spinners:bars-rotate-fade" width="40" height="40"></iconify-icon></div>');
        $.ajax({
            url: '<?php echo base_url('view_new_folder_modal'); ?>',
            type: 'GET',

            data: {
                folder_name: folderName,
                team: team,
                module: module,
                sub_module: sub_module,
                bu_filter: business_unit,
                department: department,
                date_fil: date
            },
            dataType: 'json',
            success: function (response) {
                let modalContent = '<div class="row">';
                let matchedFiles = response.matched_files || [];
                let totalPages = Math.ceil(matchedFiles.length / itemsPerPage);
                let paginatedFiles = matchedFiles.slice((page - 1) * itemsPerPage, page * itemsPerPage);
                let currentEmpId = "<?= $this->session->userdata('emp_id') ?>";
                if (paginatedFiles.length > 0) {
                    paginatedFiles.forEach(function (file) {
                        let fileExtension = file.name.split('.').pop().toLowerCase();
                        let base_url = "<?= base_url() ?>";
                        modalContent += `
                        <div class="element-item col-xxl-2 col-xl-2 col-sm-6">
                            <div class="gallery-box card  ">`;
                        if (file.status) {
                            let statusClass = '';
                            switch (file.status.toLowerCase()) {
                                case 'pending':
                                    statusClass = 'bg-warning';
                                    break;
                                default:
                                    statusClass = 'bg-success';
                            }

                            modalContent += `
                                    <div class="ribbon ${statusClass}" 
                                        style="position: absolute; top: 0; right: 0; 
                                                padding: 2px 8px; border-top-right-radius: 8px; 
                                                border-bottom-left-radius: 8px; color: #fff;">
                                        ${file.status}
                                    </div>`;
                        }

                        modalContent += `
                                <div class="ribbon bg-info" 
                                    style="position: absolute; top: 0; right: 70px; 
                                            padding: 2px 8px; border-top-right-radius: 8px; 
                                            border-bottom-left-radius: 8px; color: #fff;">
                                    ${file.mod_abbr}
                                </div>`;

                        if (file.uploaded_by === currentEmpId) {
                            modalContent += `
                                        <div class="form-check form-check-danger flex-grow-1 mb-1">
                                            <a class="form-check-input fs-15 text-danger" value="">
                                                <iconify-icon icon="tabler:xbox-x-filled" 
                                                onclick="deleteFile('${folderName}', '${file.name}', '${module}')">
                                                </iconify-icon>
                                            </a>
                                        </div>`;
                        } else {
                            modalContent += `
                                        <div class="form-check form-check-danger flex-grow-1 mb-1">
                                            <a class="form-check-input fs-15 text-danger" value="" hidden>
                                                <iconify-icon icon="tabler:xbox-x-filled" 
                                                onclick="deleteFile('${folderName}', '${file.name}', '${module}')">
                                                </iconify-icon>
                                            </a>
                                        </div>`;
                        }

                        modalContent += `<div class="gallery-container">
                                    ${['jpg', 'jpeg', 'png', 'gif', 'jfif'].includes(fileExtension) ? `
                                        <a class="image-popup" href="${base_url}open_image/${folderName}/${file.name}" target="_blank" title="${file.name}" data-bs-toggle="tooltip" data-bs-placement="top">
                                            <img src="${base_url}open_image/${folderName}/${file.name}" style="width: 100%; height: 150px; background-size: cover; background-repeat: no-repeat !important;" alt="${file.name}" />
                                            <div class="gallery-overlay">
                                                <h5 class="overlay-caption fs-12"></h5>
                                            </div>
                                            <span class=" text-muted" style="font-size: 10px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">${file.name}</span>
                                        </a>
                                    ` : ''}

                                    ${fileExtension === 'pdf' ? `
                                        <a class="image-popup" href="${base_url}open_pdf/${folderName}/${file.name}" target="_blank" title="${file.name}" data-bs-toggle="tooltip" data-bs-placement="top">
                                            <embed src="${base_url}open_pdf/${folderName}/${file.name}" type="application/pdf" style="width: 100%; height: 145px;" />
                                            <div class="gallery-overlay">
                                                <h5 class="overlay-caption fs-12"></h5>
                                            </div>
                                    <span class=" text-muted" style="font-size: 10px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">${file.name}</span>
                                        </a>
                                    ` : ''}

                                    ${fileExtension === 'txt' ? `
                                        <a href="${base_url}open_txt/${folderName}/${file.name}" target="_blank" title="${file.name}" data-bs-toggle="tooltip" data-bs-placement="top">
                                            <iframe src="${base_url}open_txt/${folderName}/${file.name}" style="width: 100%; height: 145px;"></iframe>
                                            <div class="gallery-overlay">
                                                <h5 class="overlay-caption fs-12"></h5>
                                            </div>
                                            <span class=" text-muted" style="font-size: 10px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">${file.name}</span>
                                        </a>
                                    ` : ''}

                                    ${fileExtension === 'docx' ? `
                                        <a href="${base_url}open_docx/${folderName}/${file.name}" target="_blank" title="${file.name}" data-bs-toggle="tooltip" data-bs-placement="top">
                                            <iconify-icon icon="tabler:file-type-docx" class="align-bottom text-info" style="font-size: 150px;"></iconify-icon>
                                            <div class="gallery-overlay">
                                                <h5 class="overlay-caption fs-12"></h5>
                                            </div>
                                            <span class="text-muted" style="font-size: 10px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                ${file.name}
                                            </span>
                                        </a>
                                    ` : ''}

                                    ${fileExtension === 'xlsx' ? `
                                        <a href="${base_url}open_xlsx/${folderName}/${file.name}" target="_blank" title="${file.name}" data-bs-toggle="tooltip" data-bs-placement="top">
                                            <iconify-icon icon="ri:file-excel-2-line" class="align-bottom text-success" style="font-size: 150px;"></iconify-icon>
                                            <div class="gallery-overlay">
                                                <h5 class="overlay-caption fs-12"></h5>
                                            </div>
                                            <span class="text-muted" style="font-size: 10px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                ${file.name}
                                            </span>
                                        </a>
                                    ` : ''}

                                    ${fileExtension === 'csv' ? `
                                        <a href="${base_url}open_csv/${folderName}/${file.name}" target="_blank" title="${file.name}" data-bs-toggle="tooltip" data-bs-placement="top">
                                            <iconify-icon icon="ri:file-excel-2-line" class="align-bottom text-success" style="font-size: 150px;"></iconify-icon>
                                            <div class="gallery-overlay">
                                                <h5 class="overlay-caption fs-12"></h5>
                                            </div>
                                        <span class=" text-muted" style="font-size: 10px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">${file.name}</span>
                                        </a>
                                    ` : ''}

                                    ${['mp3', 'wav', 'ogg'].includes(fileExtension) ? `
                                        <a href="${base_url}open_audio/${folderName}/${file.name}" target="_blank" title="${file.name}" data-bs-toggle="tooltip" data-bs-placement="top" >
                                        <iconify-icon icon="ri:folder-music-fill" class="align-bottom text-center text-success" style="font-size: 130px;"></iconify-icon>
                                        <audio controls style="width: 100%; height: 10px;">
                                            <source src="${base_url}open_audio/${folderName}/${file.name}" type="audio/${fileExtension}">
                                            Your browser does not support the audio element.
                                        </audio>
                                            <span class=" text-muted" style="font-size: 10px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">${file.name}</span>
                                        </a>
                                    ` : ''}

                                    ${['mp4', 'mkv', 'avi', 'x-matroska'].includes(fileExtension) ? `
                                        <a href="${base_url}open_video/${folderName}/${file.name}" target="_blank" title="${file.name}" data-bs-toggle="tooltip" data-bs-placement="top">
                                            <video controls style="width: 100%;">
                                                <source src="${base_url}open_video/${folderName}/${file.name}" type="video/${fileExtension}">
                                                Your browser does not support the video tag.
                                            </video>
                                            <span class="text-muted" style="font-size: 10px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">${file.name}</span>
                                        </a>
                                    ` : ''}
                                </div>
                                <div class="box-content">
                                    <div class="d-flex align-items-center mt-1 justify-content-center">
                                        <div class="flex-shrink-0">
                                            <div class="d-flex gap-3">
                                                <button type="button" class="btn btn-sm fs-10 btn-link text-body text-decoration-none px-0 shadow-none">
                                                    <iconify-icon icon="ri:numbers-fill"
                                                        class="text-muted align-bottom me-1 fs-12"></iconify-icon>
                                                    ${formatFileSize(file.size)}
                                                </button>`;
                                                if (file.uploaded_by === currentEmpId) {
                                                    modalContent += `
                                                    <button type="button" class="btn btn-sm fs-11 text-decoration-none px-0 shadow-none" onclick="openEditDateModal('${folderName}', '${file.name}', '${file.date}', '${file.filename}')">
                                                        <iconify-icon icon="fluent-color:calendar-edit-16" class="text-muted align-bottom me-1 fs-12"></iconify-icon>Edit
                                                    </button>`;
                                                }
                            modalContent += `</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                    });
                } else {
                    modalContent += '<li class="list-group-item text-primary text-center"><iconify-icon icon="fluent:box-multiple-search-24-filled" width="80" height="80"></iconify-icon><h5 class="mt-2">No file available | Not yet uploaded</h5></li>';
                }
                modalContent += '</div>';

                if (totalPages > 1) {
                    modalContent += '<div class="pagination-container text-center mt-3">';

                    if (page > 1) {
                        modalContent += `<button class="btn btn-sm btn-outline-primary" onclick="updateFolderModalContent('${folderName}', '${team}', '${module}', '${sub_module}', '${business_unit}', '${department}', ${page - 1}, '${date}')">Prev</button> `;
                    }

                    modalContent += `<span class="mx-2">Page ${page} of ${totalPages}</span>`;

                    if (page < totalPages) {
                        modalContent += `<button class="btn btn-sm btn-outline-primary" onclick="updateFolderModalContent('${folderName}', '${team}', '${module}', '${sub_module}', '${business_unit}', '${department}', ${page + 1}, '${date}')">Next</button> `;
                    }

                    modalContent += '</div>';
                }
                if (!folderName) {
                    folderName = $('#persistentFolderName').val();
                }

                $('#folderModalBody').html(modalContent);
                $('#folder_name').text(folderName + ' ' + 'FOLDER FILES');
                $('#folderModal').modal('show');


            },
        });
    }


   $('#teamFilter, #moduleFilter, #subModuleFilter, #buFilter, #deptFilter, #date_range_filter').off('change').on('change', function () {

        var folderName = $('#persistentFolderName').val();
        var team = $('#teamFilter').val();
        var module = $('#moduleFilter').val();
        var sub_module = $('#subModuleFilter').val();
        var business_unit = $('#buFilter').val();
        var department = $('#deptFilter').val();
        var date = $('#date_range_filter').val();
        updateFolderModalContent(folderName, team, module, sub_module, business_unit, department, 1, date);

    });



    function formatFileSize(bytes) {
        if (bytes < 1024) return bytes + ' B';
        else if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(2) + ' KB';
        else if (bytes < 1024 * 1024 * 1024) return (bytes / (1024 * 1024)).toFixed(2) + ' MB';
        else return (bytes / (1024 * 1024 * 1024)).toFixed(2) + ' GB';
    }

    function openEditDateModal(folderName, fileName, currentDate, original_file_name) {
        $('#editFolderName').val(folderName);
        $('#editFileName').val(fileName);
        $('#oldFileDate').val(currentDate);
        $('#edit_original_name').val(original_file_name);
        $('#editDateModal').modal('show');
        $('#folderModal').modal('hide');
    }

    function updateFileDate() {
        const folderName = $('#editFolderName').val();
        const fileName = $('#editFileName').val();
        const oldDate = $('#oldFileDate').val();
        const original_file_name = $('#edit_original_name').val();

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
                    url: '<?php echo base_url('Menu/Current_Sys/update_file_date'); ?>',
                    type: 'POST',
                    data: {
                        folder_name: folderName,
                        file_name: fileName,
                        new_date: oldDate,
                        original_file_name: original_file_name
                    },
                    success: function (response) {
                        const res = JSON.parse(response);
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 3000,
                            extendedTimeOut: 2000,
                        };
                        toastr.success('Date updated successfully');
                        $('#editDateModal').modal('hide');
                        var currentPage = $('.pagination-container .mx-2').text().match(/\d+/)[0] || 1;
                        // var currentPage = $('.pagination-container .mx-2').text().trim() || 1;
                        updateFolderModalContent(folder, team, module, sub_module, business_unit, department, currentPage, date);
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

            const directory = document.querySelector('#directory').value;
            const team = document.querySelector('#file_team').value;
            const module = document.querySelector('#file_module').value;
            const moduleName = document.querySelector('#file_module_name').value;
            const sub_module = document.querySelector('#file_sub_module').value;
            const business_unit = document.querySelector('#business_unitFilter1').value;
            const department = document.querySelector('#departmentFilter').value;
            const bu_name = document.querySelector('#business_unitFilter1 option:checked')?.textContent || '';
            const dept_name = document.querySelector('#departmentFilter option:checked')?.textContent || '';
            const isr = document.querySelector('#isrSearch').value;
            const date_implem = document.querySelector('#date_implem').value
            const date_ = document.querySelector('#date_').value;

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
                        url: '<?php echo base_url('upload_new_files'); ?>',
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
                                $('#directory').val('').trigger('change');
                                $('#business_unitFilter1').val('').trigger('change');
                                $('#departmentFilter').val('').trigger('change');
                                filter();
                                updateNotificationCount();
                            } else {
                                Swal.fire({
                                    title: 'Notice!',
                                    text: response.message,
                                    icon: 'info',
                                    confirmButtonText: 'Proceed with Manager\'s Key',
                                    cancelButtonText: 'Cancel',
                                    showCancelButton: true,
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        $('#file_upload').modal('hide');

                                        const askForKey = () => {
                                            Swal.fire({
                                                title: 'Enter Manager\'s Key',
                                                input: 'password',
                                                icon: 'info',
                                                inputAttributes: {
                                                    autocapitalize: 'off',
                                                    autocomplete: 'off',
                                                    placeholder: 'Enter manager\'s key'
                                                },
                                                showCancelButton: true,
                                                confirmButtonText: 'Submit',
                                                cancelButtonText: 'Cancel',
                                                allowOutsideClick: false,
                                                allowEscapeKey: false,
                                                preConfirm: (key) => {
                                                    if (!key) {
                                                        Swal.showValidationMessage('Manager\'s key is required');
                                                    } else {
                                                        formData.set('manager_key', key);
                                                        return key;
                                                    }
                                                }
                                            }).then((keyResult) => {
                                                if (keyResult.isConfirmed && keyResult.value) {
                                                    formData.append('manager_key', keyResult.value);

                                                    $.ajax({
                                                        url: '<?php echo base_url('upload_new_files'); ?>',
                                                        type: 'POST',
                                                        data: formData,
                                                        contentType: false,
                                                        processData: false,
                                                        success: function (overrideResponse) {
                                                            overrideResponse = JSON.parse(overrideResponse);

                                                            // ? Handle Pending Directories (With Valid Manager's Key)
                                                            if (overrideResponse.pending_warning) {
                                                                Swal.fire({
                                                                    title: 'Pending Files Warning',
                                                                    text: overrideResponse.pending,
                                                                    icon: 'warning',
                                                                    confirmButtonText: 'Ok'
                                                                });
                                                                return;
                                                            }

                                                            // ? Handle Pending Directories (Without Manager's Key)
                                                            if (overrideResponse.message.includes("Approve pending files")) {
                                                                Swal.fire({
                                                                    title: 'Pending Files Found',
                                                                    text: overrideResponse.message,
                                                                    icon: 'warning',
                                                                    confirmButtonText: 'OK'
                                                                });
                                                                return;
                                                            }

                                                            // ? Handle Missing Files in Previous Directories
                                                            if (overrideResponse.message.includes("Please upload files to")) {
                                                                Swal.fire({
                                                                    title: 'Missing Files',
                                                                    text: overrideResponse.message,
                                                                    icon: 'warning',
                                                                    confirmButtonText: 'OK'
                                                                });
                                                                return;
                                                            }

                                                            // ? Success Condition
                                                            if (overrideResponse.success) {
                                                                toastr.success(`${overrideResponse.message}`);
                                                                $('#file_upload').modal('hide');

                                                                const pond = FilePond.find(document.querySelector(".filepond-input-multiple"));
                                                                if (pond) {
                                                                    pond.removeFiles();
                                                                }

                                                                document.getElementById('uploadForm').reset();
                                                                $('#directory').val('').trigger('change');
                                                                $('#business_unitFilter1').val('').trigger('change');
                                                                $('#departmentFilter').val('').trigger('change');
                                                                filter();
                                                                updateNotificationCount();
                                                            } else {
                                                                // ?? Handle Invalid Manager's Key
                                                                Swal.fire({
                                                                    title: 'Invalid Key',
                                                                    text: 'The manager\'s key you entered is incorrect. Please try again.',
                                                                    icon: 'error',
                                                                    showCancelButton: true,
                                                                    confirmButtonText: 'Retry',
                                                                    cancelButtonText: 'Cancel'
                                                                }).then((retryResult) => {
                                                                    if (retryResult.isConfirmed) {
                                                                        askForKey();
                                                                    }
                                                                });
                                                            }
                                                        }
                                                    });
                                                }
                                            });
                                        };
                                        askForKey();
                                    }
                                });
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
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo base_url('delete_file_new'); ?>',
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
                                `File was successfully deleted`,
                            );
                            openFolderModal(folderName);
                            filter();
                            updateNotificationCount();
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


    $(document).ready(function () {
        flatpickr("#date_request", {
            dateFormat: "F j, Y"
        });
        $('#business_unit').select2({
            placeholder: "Select Business Unit",
            allowClear: true,
            minimumResultsForSearch: Infinity
        });

        $.ajax({
            url: '<?php echo base_url('business_unit') ?>',
            type: 'POST',
            success: function (response) {
                buData = JSON.parse(response);
                $('#business_unit').empty().append('<option value="">Select Business Unit</option>');
                buData.forEach(function (bu) {
                    $('#business_unit').append('<option value="' + bu.bcode + '">' + bu.business_unit + '</option>');
                });
            }
        });
    });


    function add_new_module() {
        var mod_name = $('#mod_name').val();
        var mod_abbr = $('#mod_abbr').val();
        var typeofsystem = "new";
        var date_request = $('#date_request').val();
        var bcode = $('#business_unit').val();
        var business_unit = $('#business_unit option:selected').text();
        if (mod_name === "" || mod_abbr === "" || date_request === "" || business_unit === "") {
            toastr.options = {
                progressBar: true,
                positionClass: "toast-top-left",
                timeOut: 3000,
                extendedTimeOut: 2000,

            };

            toastr.info(
                `Please fill the required fields`,
            );

            if (mod_name === "") {
                $('#mod_name').addClass('is-invalid');
            }
            if (mod_abbr === "") {
                $('#mod_abbr').addClass('is-invalid');
            }
            if (date_request === "") {
                $('#date_request').addClass('is-invalid');
            }

            return;
        }

        var data = {
            mod_name: mod_name,
            mod_abbr: mod_abbr,
            typeofsystem: typeofsystem,
            date_request: date_request,
            bcode: bcode,
            business_unit: business_unit
        };

        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to add new module?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, add it!',
            cancelButtonText: 'No, cancel!',
        }).then(function (result) {
            if (result.isConfirmed) {
                $('#add_new_system').modal('hide');
                Swal.fire({
                    title: 'Enter Manager\'s Key',
                    input: 'password',
                    icon: 'info',
                    inputAttributes: {
                        autocapitalize: 'off',
                        autocomplete: 'off',
                        placeholder: 'Enter manager\'s key'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Submit',
                    cancelButtonText: 'Cancel',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    preConfirm: (key) => {
                        if (!key) {
                            Swal.showValidationMessage('Manager\'s key is required');
                        } else {
                            return key;
                        }
                    }
                }).then((keyResult) => {
                    if (keyResult.isConfirmed && keyResult.value) {
                        data.manager_key = keyResult.value;

                        $.ajax({
                            url: '<?php echo base_url('add_new_module'); ?>',
                            type: 'POST',
                            data: data,
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
                                    $('#add_new_system').modal('hide');
                                    filter();
                                    loadModule();
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
                            },
                        });
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
            if (!requestNumber) {
                toastr.options = {
                    progressBar: true,
                    positionClass: "toast-top-left",
                    timeOut: 3000,
                    extendedTimeOut: 2000,

                };

                toastr.info(
                    `Please enter ISR request number`,
                );
                $('#isrSearch').addClass('is-invalid');
                return;
            }
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
                url: '<?php echo base_url('get_isr_request'); ?>',
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

    $(document).ready(function () {
        $('#directory').change(function () {
            if ($(this).val() === 'LIVE_TESTING') {
                $('#dateImplem').show();
            } else {
                $('#dateImplem').hide();
            }
        });
    });

</script>
<script>
    // document.addEventListener("DOMContentLoaded", function () {
    //     flatpickr("#date_", {
    //         allowInput: true,
    //         dateFormat: "Y-m-d",
    //         altInput: true,
    //         altFormat: "F j, Y",
    //         disableMobile: true
    //     });
    // });
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