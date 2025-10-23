<!-- Create Module -->
<div class="modal fade zoomIn" id="setup_bu_of_module" tabindex="-1" aria-labelledby="create_module" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title" id="varyingcontentModalLabel">Assign Company / BU to Module from Masterfile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row mb-2">
                        <label for="team" class="col-sm-3 col-form-label">Team:</label>
                        <input type="hidden" id="emp_id" class="form-control hidden">
                        <div class="col-sm-9">
                            <select class="form-select" id="team">
                                <option></option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label for="module_add" class="col-sm-3 col-form-label">Module: <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-select" id="module_add">
                                <option></option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label for="sub_mdl" class="col-sm-3 col-form-label">Sub Module:</label>
                        <div class="col-sm-9">
                            <select class="form-select" id="sub_mdl">
                                <option></option>
                            </select>
                        </div>

                    </div>

                    <div class="row mb-2">
                        <label for="date_request" class="col-sm-3 col-form-label">Date Request: <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="date" id="date_request" class="form-control" readonly
                                    placeholder="Select Date Request" data-provider="flatpickr" />
                                <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label for="company" class="col-sm-3 col-form-label">Company: <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-select" id="company1">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label for="business_unit" class="col-sm-3 col-form-label">Business Unit:</label>
                        <div class="col-sm-9">
                            <select class="form-select" id="business_unit1">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label for="department" class="col-sm-3 col-form-label">Department:</label>
                        <div class="col-sm-9">
                            <select class="form-select" id="department1">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label for="typeofsystem" class="col-sm-3 col-form-label">Type of System: <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select name="type" class="form-select" id="typeofsystem">
                                <option value=""></option>
                                <option value="current">Current System</option>
                                <option value="new">New System</option>
                            </select>
                        </div>
                    </div>

                    <!-- <div class="row mb-2" id="dateImplem" style="display: none;">
                        <label class="col-sm-3 col-form-label">Date Implem:</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="date" id="date_implem" class="form-control" readonly=""
                                    placeholder="Select Date Implemented" data-provider="flatpickr" />
                                <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2" id="dateParallel" style="display: none;">
                        <label class="col-sm-3 col-form-label">Date Parallel:</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="date" id="date_parallel" class="form-control" readonly=""
                                    placeholder="Select Date Parallel" data-provider="flatpickr" />
                                <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                            </div>
                        </div>
                    </div> -->

                    <div class="row mb-2">
                        <label for="other_details" class="col-sm-3 col-form-label">Other Details</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="other_details" name="other_details" row="5"></textarea>
                        </div>
                    </div>

                    <!-- Gantt Chart Section -->
                    <div id="ganttSection" style="display: none;">

                        <!-- Gantt Chart Notice -->
                        <div class="row mb-2">
                            <div class="col-sm-12 text-center">
                                <label class="form-label text-danger fw-bold">⚠️ Gantt is required</label>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <label for="team_name" class="col-sm-3 col-form-label">Incharge: <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-select mb-3" id="incharge">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label class="col-sm-3 col-form-label">Implementation: <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" id="date_implementation" class="form-control"
                                        placeholder="Select Date Implementation" data-provider="flatpickr"
                                        data-date-format="F j, Y" data-range-date="true" />
                                    <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <label class="col-sm-3 col-form-label">Start | Coding:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" id="date_start" class="form-control"
                                        placeholder="Select Date Start" data-provider="flatpickr"
                                        data-date-format="F j, Y" />
                                    <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <label class="col-sm-3 col-form-label">End | Coding:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" id="date_end" class="form-control" placeholder="Select Date End"
                                        data-provider="flatpickr" data-date-format="F j, Y" />
                                    <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <label class="col-sm-3 col-form-label">Date Testing:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" id="date_testing" class="form-control"
                                        placeholder="Select Date Testing" data-provider="flatpickr"
                                        data-date-format="F j, Y" data-range-date="true" />
                                    <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <label class="col-sm-3 col-form-label">Date Parallel:</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" id="date_parallel_2" class="form-control"
                                        placeholder="Select Date Parallel" data-provider="flatpickr"
                                        data-date-format="F j, Y" data-range-date="true" />
                                    <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="name" class="col-sm-3 col-form-label">Description: <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="description" style="height: 70px"
                                    placeholder="Description"></textarea>
                            </div>
                        </div>

                    </div>


                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="insert_setup_bu_module()">Submit</button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Create Module -->
<div class="modal fade zoomIn" id="create_module" tabindex="-1" aria-labelledby="create_module" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title" id="display_mod_name"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row mb-2">
                        <label for="date_request" class="col-sm-3 col-form-label">Date Request:</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="date" id="date_request" class="form-control" readonly
                                    placeholder="Select Date Request" data-provider="flatpickr" />
                                <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label for="company" class="col-sm-3 col-form-label">Company <span class="text-danger">*</span>
                            :</label>
                        <div class="col-sm-9">
                            <select class="form-select" id="company">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label for="business_unit" class="col-sm-3 col-form-label">Business Unit <span
                                class="text-danger">*</span> :</label>
                        <div class="col-sm-9">
                            <select class="form-select" id="business_unit">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label for="department" class="col-sm-3 col-form-label">Department :</label>
                        <div class="col-sm-9">
                            <select class="form-select" id="department">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="other_details" class="col-sm-3 col-form-label">Other Details</label>
                        <div class="col-sm-9">
                            <!-- <textarea type="text" class="form-control" id="other_details" row="5"></textarea> -->
                            <textarea class="form-control" id="other_details" name="other_details" row="5"></textarea>
                            <input type="hidden" class="form-control" id="hidden_id">
                            <input type="hidden" class="form-control" id="hidden_sub_mod_id">
                            <input type="hidden" class="form-control" id="hidden_team_id">
                            <input type="hidden" class="form-control" id="hidden_type">
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="add_module()">Submit</button>
                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                    data-bs-target="#view_dept_implemented_modules">Back To List</button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Edit Module -->
<div class="modal fade zoomIn" id="edit_module" tabindex="-1" aria-labelledby="edit_module" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title" id="varyingcontentModalLabel">EDIT MODULE NAME</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="" id="edit_module_content">
                </div>
            </div>

        </div>
    </div>
</div>
<!-- View Submodule of the module -->
<div class="modal fade zoomIn" id="submodule" tabindex="-1" aria-labelledby="submodule" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title" id="sub_mod_name"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="" id="submodule_content">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#module_msfl">Back
                    To Masterfile</button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Add Submodule -->
<div class="modal fade zoomIn" id="add_submodule" tabindex="-1" aria-labelledby="add_submodule" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title" id="varyingcontentModalLabel">ADD SUBMODULE NAME</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="" id="add_submodule_content"></div>
            </div>

        </div>
    </div>
</div>
<!-- Edit Submodule -->
<div class="modal fade zoomIn" id="edit_submodule" tabindex="-1" aria-labelledby="edit_submodule" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title" id="varyingcontentModalLabel">EDIT SUBMODULE NAME</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="" id="edit_submodule_content">

                </div>
            </div>

        </div>
    </div>
</div>
<!-- Create Module -->
<div class="modal fade zoomIn" id="add_module_msfl" tabindex="-1" aria-labelledby="add_module_msfl" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title">ADD MODULE TO MASTERFILE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row mb-2">
                        <label for="team" class="col-sm-3 col-form-label">Team:</label>
                        <div class="col-sm-9">
                            <select class="form-select" id="team2">
                                <option></option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label for="mod_name" class="col-sm-3 col-form-label">Module | System:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="mod_name2" autocomplete="off">
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label for="mod_abbr" class="col-sm-3 col-form-label">Abbreviation:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="mod_abbr2" autocomplete="off">
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label for="module_desc" class="col-sm-3 col-form-label">Module Description:</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="module_desc" autocomplete="off" rows="8" placeholder="Description"></textarea>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label for="typeofsystem" class="col-sm-3 col-form-label">Type of System:</label>
                        <div class="col-sm-9">
                            <select name="type" class="form-select" id="typeofsystem2">
                                <option value=""></option>
                                <option value="current">Current System</option>
                                <option value="new">New System</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="add_module_msfl()">Submit</button>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#module_msfl">Back
                    To Masterfile</button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade zoomIn" id="edit_module_msfl" tabindex="-1" aria-labelledby="edit_module_msfl" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title" id="varyingcontentModalLabel">EDIT MODULE MASTERFILE NAME</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="" id="edit_module_msfl_content">
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade zoomIn" id="module_msfl" tabindex="-1" aria-labelledby="submodule" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title" id="varyingcontentModalLabel">MODULE MASTERFILE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="" id="module_msfl_content">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
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
                            <?php
                            if ($this->session->userdata('position') != 'Manager') { ?>
                                <button class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#create_module"><i class="ri-add-fill align-bottom me-5"></i> </button>
                            <?php } ?>
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
                                Date Parallel</label></li>
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="5" checked>
                                Others</label></li>
                        <!-- <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="4" checked> Status</label></li> -->
                        <li><label class="dropdown-item"><input type="checkbox" class="column-toggle" value="6" checked>
                                Action</label></li>
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
                                <th>Action</th>
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
                <h4 class="mb-sm-0">Module Setup </h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Module </a></li>
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
                    <div class="col-md-12">
                        <div class="d-flex align-items-center mx-2 gap-2">
                            <select class="form-select" id="team_filter_module">
                                <option value="">Select Team</option>
                            </select>
                            <button class="btn btn-info waves-effect rounded-pill waves-light add-btn" data-bs-toggle="modal"
                                data-bs-target="#module_msfl" onclick="view_module_msfl()"
                                style="width: 55%"><iconify-icon icon="tabler:layout-list-filled"
                                    class="align-middle fs-15"></iconify-icon> Module Masterfile</button>

                            <?php
                            if ($this->session->userdata('position') != 'Manager') { ?>
                                <button class="btn btn-primary waves-effect rounded-pill waves-light" data-bs-toggle="modal"
                                    data-bs-target="#setup_bu_of_module" title="Setup Module" id="tooltipButton"
                                    style="width: 75%">
                                    <i class="ri-add-fill align-middle me-1 fs-12"></i> Assign Company / BU to Module from Masterfile
                                </button>
                                <?php
                            }
                            ?>
                            <button class="btn btn-danger waves-effect rounded-pill waves-light generate" target="_blank"
                                title="Print Module" id="tooltipButton" data-bs-toggle="tooltip"><iconify-icon
                                    icon="fluent:document-pdf-32-filled"
                                    class="align-middle fs-15 me-4"></iconify-icon></button>
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
                                    class="badge badge-pill bg-danger ncount" style="display: none;"></span></span>
                        </a>
                    </li>
                </ul>
                <hr>
                <div class="table-responsive">
                    <div id="note-new" class="mb-2">
                        <iconify-icon icon="emojione-v1:note-pad" width="24" height="24" class="align-bottom"></iconify-icon>
                        <strong> Note:</strong>
                        <span class="text-danger fst-italic">
                            The data below shows modules that have a company or business unit implemented from the module masterfile. 
                            Please ensure that a <strong><u>Company</u></strong> or <strong><u>Business Unit</u></strong> is set up first so that the module will be visible in other <strong><u>module name</u></strong> filters.
                        </span>
                    </div>

                    <table class="table table-striped table-hover compact" id="module_list">
                        <thead class="table-info text-center text-uppercase">
                            <tr>
                                <th>Team Name</th>
                                <th width="25%">Module Name</th>
                                <th>Status</th>
                                <th width="30%" style="text-align: justify;">Module Description</th>
                                <!-- <th>REQUESTED TO</th> -->
                                <!--<th>Date Requested</th>
                                <th>Date Implem</th>
                                <th>Other Details</th> -->
                                <th class="text-center">Action</th>
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


<!-- <script>
    $(document).ready(function () {
        $('#note-new').hide();

        $('.typeofsystem').on('click', function () {
            const tabId = $(this).attr('id');

            if (tabId === 'new') {
                $('#note-new').show();
            } else {
                $('#note-new').hide();
            }
        });
    });
</script> -->
<script>

    $(document).ready(function () {
        $('#coFilter, #company, #company1').select2({ placeholder: 'Select Company', allowClear: true, minimumResultsForSearch: Infinity });
        $('#buFilter, #business_unit, #business_unit1').select2({ placeholder: 'Select Business Unit', allowClear: true, minimumResultsForSearch: Infinity });
        $('#departmentFilter, #department, #department1').select2({ placeholder: 'Select Department', allowClear: true, minimumResultsForSearch: Infinity });

        $('#typeofsystem, #typeofsystem2').select2({ placeholder: 'Select Type of System', allowClear: true, minimumResultsForSearch: Infinity });
        $('#team_filter_module, #team, #team_filter, #team2').select2({ placeholder: 'Select Team', allowClear: true, minimumResultsForSearch: Infinity });
        $('#module_add').select2({ placeholder: 'Select Module From Masterfile', allowClear: true, minimumResultsForSearch: Infinity });
        $('#sub_mdl').select2({ placeholder: 'Select Sub Module Name', allowClear: true, minimumResultsForSearch: Infinity });
        $('#incharge, #edit_incharge').select2({ placeholder: 'Select Incharge', allowClear: true, minimumResultsForSearch: Infinity });
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

    

    $.ajax({
        url: '<?php echo base_url('get_team') ?>',
        type: 'POST',
        success: function (response) {
            teamData = JSON.parse(response);
            // $('#team_filter_module, #team, #team_filter, #team2').empty().append('<option value="">Select Team Name</option>');
            teamData.forEach(function (team) {
                $('#team_filter_module, #team, #team_filter, #team2').append('<option value="' + team.team_id + '">' + team.team_name + '</option>');
            });
        }
    });
    $('#team, #edit_team').change(function () {
        var team_id = $(this).val();
        $.ajax({
            url: '<?php echo base_url('setup_workload') ?>',
            type: 'POST',
            data: { team_id: team_id },
            success: function (response) {
                membersData = JSON.parse(response);
                $('#incharge, #edit_incharge').empty().append('<option value="">Select Name</option>');
                $('#incharge, #edit_incharge').prop('disabled', true);

                if (membersData.length > 0) {
                    membersData.forEach(function (member) {
                        $('#incharge, #edit_incharge').append('<option value="' + member.emp_id + '">' + member.emp_name + '</option>');
                    });

                    $('#incharge, #edit_incharge').prop('disabled', false);
                }
            }
        });
    });
    $('#incharge, #edit_incharge').change(function () {
        var selectedEmpId = $(this).val();
        var selectedMember = membersData.find(member => member.emp_id == selectedEmpId);

        if (selectedMember) {
            $('#emp_id, #edit_emp_id').val(selectedEmpId);
        } else {
            $('#emp_id, #edit_emp_id').val('');
        }
    });
    function load_mod() {
        $.ajax({
            url: '<?php echo base_url('Admin/setup_module_dat') ?>',
            type: 'POST',
            data: {
                team: $('#team').val()
            },
            success: function (response) {
                moduleData = JSON.parse(response);
                $('#module_add').empty().append('<option value="">Select Module Name</option>');
                $('#sub_mdl, #edit_sub_module_add').empty().append('<option value="">Select Sub Module</option>');
                $('#sub_mdl, #edit_sub_module_add').prop('disabled', true);

                moduleData.forEach(function (module) {
                    $('#module_add').append('<option value="' + module.mod_id + '" data-typeofsystem="' + module.typeofsystem + '">' + module.mod_name + '</option>');
                });
            }
        });
    }
    $('#team').change(function () {
        load_mod();
    });

    $('#module_add, #edit_module_add').change(function () {
        var selectedModuleId = $(this).val();
        var selectedModule = moduleData.find(module => module.mod_id == selectedModuleId);

        $('#sub_mdl, #edit_sub_module_add').empty().append('<option value="">Select Sub Module</option>');
        $('#sub_mdl, #edit_sub_module_add').prop('disabled', true);

        if (selectedModule) {
            if (selectedModule.submodules.length > 0) {
                selectedModule.submodules.forEach(function (subModule) {
                    $('#sub_mdl, #edit_sub_module_add').append('<option value="' + subModule.sub_mod_id + '">' + subModule.sub_mod_name + '</option>');
                });
                $('#sub_mdl, #edit_sub_module_add').prop('disabled', false);
            }
            $('#typeofsystem').val(selectedModule.typeofsystem).trigger('change').prop('disabled', true);
        }
    });



    $('#team_filter_module').change(function () {
        $('#module_list').DataTable().ajax.reload();
    });

    $('#team_filter, #coFilter, #buFilter, #departmentFilter').change(function () {
        $('#view_dept_implemented_module').DataTable().ajax.reload();
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
        table = $('#module_list').DataTable({
            "processing": true,
            "serverSide": true,
            "destroy": true,
            // "responsive": true,
            'lengthMenu': [[10, 25, 50, 100, 10000], [10, 25, 50, 100, "Max"]],
            'pageLength': 10,
            "ajax": {
                "url": "<?= base_url('module_list') ?>",
                "dataType": "json",
                "type": "POST",
                "data": function (d) {
                    d.typeofsystem = typeofsystem !== "all" ? typeofsystem : null;
                    d.team = $('#team_filter_module').val();
                }
            },
            "columns": [
                { "data": "team_name" },
                { "data": 'mod_name' },
                { "data": 'status' },
                { "data": 'module_desc'},
                // {
                //     "data": 'action',
                //     "visible": <?= ($_SESSION['position'] != 'Manager') ? 'true' : 'false'; ?>
                // }
                {
                    "data": 'action'
                }

            ],
            "paging": true,
            "searching": true,
            "ordering": true,
            "columnDefs": [
                { "className": "text-start", "targets": ['_all'] },
                { "className": "text-justify", "targets": [3] }
            ]
        });
    }

    $('#create_module').on('hidden.bs.modal', function () {
        $('#mod_name').val('');
        $('#sub_mdl').val('');
        $('#typeofsystem').val('').trigger('change');
    });


    function add_module_msfl() {
        var mod_name = $('#mod_name2').val();
        var mod_abbr = $('#mod_abbr2').val();
        var typeofsystem = $('#typeofsystem2').val();
        var team = $('#team2').val();
        var module_desc = $('#module_desc').val();

        if (team === "" || mod_name === "" || mod_abbr === "" || typeofsystem === "") {
            toastr.options = {
                progressBar: true,
                positionClass: "toast-top-left",
                timeOut: 5000,
                extendedTimeOut: 2000,

            };

            toastr.error(
                `Please fill up the required fields`,
            );
            $('#team2, #mod_name2, #mod_abbr2, #typeofsystem2').each(function () {
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

        var data = {
            mod_name: mod_name,
            mod_abbr: mod_abbr,
            typeofsystem: typeofsystem,
            team: team,
            module_desc: module_desc
        };

        $.ajax({
            url: '<?php echo base_url("add_module_msfl"); ?>',
            type: 'POST',
            data: data,
            success: function () {
                $('#add_module_msfl').modal('hide');
                $('#module_msfl').modal('show');
                view_module_msfl();
                updateModuleCount();
                var table = $('#module_masterfile').DataTable();
                var currentPage = table.page();

                table.ajax.reload(function () {
                    table.page(currentPage).draw(false);
                }, false);
                toastr.options = {
                    progressBar: true,
                    positionClass: "toast-top-left",
                    timeOut: 5000,
                    extendedTimeOut: 2000,

                };

                toastr.success(
                    `Module was successfully added in masterfile`,
                );
            },
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
                "url": "<?php echo base_url('view_dept_implemented_modules'); ?>",
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
                { "data": "others" },
                // { "data": "status" },
                {
                    "data": 'action',
                    "visible": <?= ($_SESSION['position'] != 'Manager') ? 'true' : 'false'; ?>
                }

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
    function edit_module_msfl(mod_id) {

        $.ajax({
            url: '<?= base_url('edit_module_msfl') ?>',
            type: 'POST',
            data: {
                mod_id: mod_id
            },
            error: function () {
                toastr.options = {
                    progressBar: true,
                    positionClass: "toast-top-left",
                    timeOut: 5000,
                    extendedTimeOut: 2000,

                };

                toastr.error(
                    `Oops! Something went wrong.`,
                );
            },
            success: function (data) {
                $("#edit_module_msfl_content").html(data);
            }
        });
    }

    $('#setup_bu_of_module').on('hidden.bs.modal', function () {
        $('#module_add').val('').trigger('change');
        $('#sub_mdl').val('').trigger('change');
        $('#typeofsystem').val('').trigger('change');
        $('#company1').val('').trigger('change');
        $('#business_unit1').val('').trigger('change');
        $('#department1').val('').trigger('change');
        $('#date_request').val('');
        $('#team').val('').trigger('change');
        $('#other_details').val('');
        if ($('#date_implem')[0]._flatpickr) {
            $('#date_implem')[0]._flatpickr.clear();
        } else {
            $('#date_implem').val('');
        }


        if ($('#date_parallel')[0]._flatpickr) {
            $('#date_parallel')[0]._flatpickr.clear();
        } else {
            $('#date_parallel').val('');
        }

    });


    $('#typeofsystem').change(function () {
        var val = $(this).val();
        if (val === 'current') {
            $('#ganttSection').hide();
        } else if (val === 'new') {
            $('#ganttSection').show();
        } else {
            $('#ganttSection').hide();
        }
    });


    function insert_setup_bu_module() {
        var mod_name = $('#module_add').val();
        var mod = $('#module_add option:selected').text().trim();
        var sub_module = $('#sub_mdl').val();
        var typeofsystem = $('#typeofsystem').val();
        var co = $('#company1').val() || '';
        var bcode = $('#business_unit1').val() || '';
        var dep = $('#department1').val() || '';

        var company = $('#company1 option:selected').text().trim();
        var business_unit = $('#business_unit1 option:selected').text().trim();
        var department = $('#department1 option:selected').text().trim();

        var date_request = $('#date_request').val();
        var team = $('#team').val();

        var date_implem = $('#date_implem').val();
        var date_parallel = $('#date_parallel').val();

        var other_details = $('#other_details').val();

        var emp_name = $('#incharge option:selected').text();
        var emp_id = $('#emp_id').val();
        var date_implementation = $('#date_implementation').val();
        var date_start = $('#date_start').val();
        var date_end = $('#date_end').val();
        var date_testing = $('#date_testing').val();
        var date_parallel_2 = $('#date_parallel_2').val();
        var description = $('#description').val();

        if (company === 'Select Company') company = '';
        if (business_unit === 'Select Business Unit') business_unit = '';
        if (department === 'Select Department') department = '';

        if (bcode === "") {
            business_unit = '';
        }

        if (mod_name === "" || typeofsystem === "" || co === "") {
            toastr.options = {
                progressBar: true,
                positionClass: "toast-top-left",
                timeOut: 5000,
                extendedTimeOut: 2000,
            };

            toastr.error(`Please fill up the required fields`);
            $('#module_add, #typeofsystem, #company1').each(function () {
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

        if (typeofsystem === 'new') {
            const ganttFields = ['#incharge', '#date_implementation', '#description'];
            let ganttValid = true;

            ganttFields.forEach(function (field) {
                let $input = $(field);
                let isEmpty = !$input.val();

                $input.removeClass('is-invalid');

                if ($input.hasClass('select2-hidden-accessible')) {
                    const $select2 = $input.next('.select2-container');
                    $select2.removeClass('is-invalid');
                    if (isEmpty) {
                        $select2.addClass('is-invalid');
                        ganttValid = false; // ✅ FIX HERE
                    }
                } else {
                    if (isEmpty) {
                        $input.addClass('is-invalid');
                        ganttValid = false; // ✅ FIX HERE
                    }
                }
            });

            if (!ganttValid) {
                toastr.options = {
                    progressBar: true,
                    positionClass: "toast-top-left",
                    timeOut: 5000,
                    extendedTimeOut: 2000,
                };
                toastr.error("⚠️ Gantt is required.");
                return;
            }
        }

        var data = {
            mod_name: mod_name,
            mod: mod,
            sub_module: sub_module,
            typeofsystem: typeofsystem,
            bcode: bcode,
            co: co,
            dep: dep,
            company: company,
            business_unit: business_unit,
            department: department,
            date_request: date_request,
            team: team,
            date_implem: date_implem,
            date_parallel: date_parallel,
            other_details: other_details,
            emp_name: emp_name,
            emp_id: emp_id,
            date_implementation: date_implementation,
            date_start: date_start,
            date_end: date_end,
            date_testing: date_testing,
            date_parallel_2: date_parallel_2,
            description: description
        };

        Swal.fire({
            title: 'Confirm Action',
            text: 'Are you sure you want to add this module and submit its Gantt details?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, add it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo base_url("add_module"); ?>',
                    type: 'POST',
                    data: data,
                    success: function () {
                        const team_id = $('#team').val();
                        const team_name = $('#team option:selected').text();
                        const module_id = $('#module_add').val();
                        const module_name = $('#module_add option:selected').text();
                        const emp_id = $('#emp_id').val();
                        const emp_name = $('#incharge option:selected').text();

                        const export_query = $.param({
                            team_id: team_id,
                            team_name: team_name,
                            module_id: module_id,
                            module_name: module_name,
                            emp_id: emp_id,
                            emp_name: emp_name
                        });

                        $('#setup_bu_of_module').modal('hide');

                        const table = $('#module_list').DataTable();
                        const currentPage = table.page();
                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                        }, false);

                        updateModuleCount();

                        Swal.fire({
                            title: 'Success!',
                            html: 'Module was successfully added.<br><b>Do you want to generate the Gantt PDF?</b>',
                            icon: 'success',
                            showCancelButton: true,
                            confirmButtonText: '📄 Generate PDF',
                            cancelButtonText: 'Close',
                            confirmButtonColor: '#dc3545',
                            cancelButtonColor: '#aaa',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.open("<?= base_url('Menu/gantt/export_pdf2?') ?>" + export_query, '_blank');
                            }
                        });
                    },
                });
            }
        });
    }


    function export_pdf(team_id, team_name, module_id, module_name, emp_id) {


        const export_query = $.param({
            team_id,
            team_name,
            module_id,
            module_name,
            emp_id: emp_id,
        });

        Swal.fire({
            html: `Are you sure you want to generate the Gantt PDF of <br> <b>${module_name}</b>?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: '📄 Generate PDF',
            cancelButtonText: 'Close',
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#aaa',
        }).then((result) => {
            if (result.isConfirmed) {
                window.open("<?= base_url('Menu/gantt/export_pdf2?') ?>" + export_query, '_blank');
            }
        });
    }




    $('#setup_bu_of_module').on('show.bs.modal', function () {
        $('#ganttSection input, #ganttSection textarea, #ganttSection select').removeClass('is-invalid');
    });

    function add_module() {
        var mod_name = $('#hidden_id').val();
        var sub_module = $('#hidden_sub_mod_id').val();
        var typeofsystem = $('#hidden_type').val();
        var co = $('#company').val() || '';
        var bcode = $('#business_unit').val() || '';
        var dep = $('#department').val() || '';

        var company = $('#company option:selected').text().trim();
        var business_unit = $('#business_unit option:selected').text().trim();
        var department = $('#department option:selected').text().trim();

        var date_request = $('#date_request').val();
        var team = $('#hidden_team_id').val();
        var other_details = $('#other_details').val();


        if (company === 'Select Company') company = '';
        if (business_unit === 'Select Business Unit') business_unit = '';
        if (department === 'Select Department') department = '';


        if (bcode === "") {
            business_unit = '';
        }


        if (mod_name === "" || typeofsystem === "" || co === "" || bcode === "") {
            toastr.options = {
                progressBar: true,
                positionClass: "toast-top-left",
                timeOut: 5000,
                extendedTimeOut: 2000,

            };

            toastr.error(
                `Please fill up the required fields`,
            );
            $('#mod_name').each(function () {
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

        var data = {
            mod_name: mod_name,
            sub_module: sub_module,
            typeofsystem: typeofsystem,
            bcode: bcode,
            co: co,
            bcode: bcode,
            dep: dep,

            company: company,
            business_unit: business_unit,
            department: department,

            department: department,
            date_request: date_request,
            team: team,
            other_details: other_details
        };

        $.ajax({
            url: '<?php echo base_url("add_module"); ?>',
            type: 'POST',
            data: data,
            success: function () {
                $('#create_module').modal('hide');
                $('#view_dept_implemented_modules').modal('show');
                var table = $('#view_dept_implemented_module').DataTable();
                var currentPage = table.page();

                table.ajax.reload(function () {
                    table.page(currentPage).draw(false);
                }, false);
                toastr.options = {
                    progressBar: true,
                    positionClass: "toast-top-left",
                    timeOut: 5000,
                    extendedTimeOut: 2000,

                };

                toastr.success(
                    `Module was successfully added`,
                );

                updateModuleCount();
            },
        });
    }
    function view_submodule(mod_id, mod_name) {

        $("#sub_mod_name").text('Sub Module of: ' + mod_name);
        $.ajax({
            url: '<?= base_url('view_submodule') ?>',
            type: 'POST',
            data: { mod_id: mod_id },
            error: function () {
                toastr.options = {
                    progressBar: true,
                    positionClass: "toast-top-left",
                    timeOut: 5000,
                    extendedTimeOut: 2000,

                };

                toastr.error(
                    `Oops! Something went wrong.`,
                );
            },
            success: function (data) {
                $("#submodule_content").html(data);
            }
        });
    }
    function view_module_msfl() {
        $.ajax({
            url: '<?= base_url('view_module_msfl') ?>',
            type: 'POST',
            error: function () {
                toastr.options = {
                    progressBar: true,
                    positionClass: "toast-top-left",
                    timeOut: 5000,
                    extendedTimeOut: 2000,

                };

                toastr.error(
                    `Oops! Something went wrong.`,
                );
            },
            success: function (data) {
                $("#module_msfl_content").html(data);
            }
        });
    }
    function add_submodule_content(mod_id) {
        $.ajax({
            url: '<?= base_url('add_submodule_content') ?>',
            type: 'POST',
            data: { mod_id: mod_id },
            error: function () {
                toastr.options = {
                    progressBar: true,
                    positionClass: "toast-top-left",
                    timeOut: 5000,
                    extendedTimeOut: 2000,

                };

                toastr.error(
                    `Oops! Something went wrong.`,
                );
            },
            success: function (data) {
                $("#add_submodule_content").html(data);
            }
        });
    }
    function add_submodule() {
        var mod_id = $('#mod_id').val();
        var sub_mod_name = $('#sub_mod_name1').val();

        if (sub_mod_name === "") {
            toastr.options = {
                progressBar: true,
                positionClass: "toast-top-left",
                timeOut: 5000,
                extendedTimeOut: 2000,

            };

            toastr.info(
                `Sub module name is required.`,
            );

            $('#sub_mod_name1').each(function () {
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
            text: 'To add this sub module?',
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
                    url: '<?php echo base_url("insert_submodule"); ?>',
                    type: 'POST',
                    data: { mod_id: mod_id, sub_mod_name: sub_mod_name },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        });
                    },
                    success: function (data) {
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 5000,
                            extendedTimeOut: 2000,

                        };

                        toastr.success(
                            `Sub module was successfully added.`,
                        );
                        var table = $('#submodule_list').DataTable();
                        var currentPage = table.page();

                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                        }, false);
                        view_submodule(mod_id);
                        $('#submodule').modal('show');
                        $('#add_submodule').modal('hide');

                    }
                });
            }
        });
    }

    function delete_submodule(sub_mod_id, sub_mod_name) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'To delete this sub module?',
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
                    url: '<?php echo base_url('delete_submodule'); ?>',
                    type: 'POST',
                    data: { sub_mod_id: sub_mod_id, sub_mod_name: sub_mod_name },
                    success: function (response) {
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 5000,
                            extendedTimeOut: 2000,

                        };

                        toastr.success('Module setup was successfully deleted');

                        $('#submodule_list').DataTable().ajax.reload();
                        var currentPage = table.page();
                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                        }, false);
                    },
                });
            }
        });
    }


    function edit_view_dept_implemented_modules(id) {

        $.ajax({
            url: '<?= base_url('edit_module') ?>',
            type: 'POST',
            data: {
                id: id,
            },
            error: function () {
                toastr.options = {
                    progressBar: true,
                    positionClass: "toast-top-left",
                    timeOut: 5000,
                    extendedTimeOut: 2000,

                };

                toastr.error(
                    `Oops! Something went wrong.`,
                );
            },
            success: function (data) {
                $("#edit_module_content").html(data);
            }
        });
    }

    function submiteditedmodule_msfl(id) {
        var mod_name = $('#edit_mod_name').val();
        var mod_abbr = $('#edit_mod_abbr').val();
        var team = $('#edit_team_').val();
        var typeofsystem = $('#type_').val();
        var module_desc = $('#edit_module_desc').val();

        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to update this module masterfile name!',
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
                    url: '<?php echo base_url("update_module_msfl"); ?>',
                    type: 'POST',
                    data: {
                        id: id,
                        mod_name: mod_name,
                        mod_abbr: mod_abbr,
                        team: team,
                        typeofsystem: typeofsystem,
                        module_desc: module_desc
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        });
                    },
                    success: function (data) {
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 5000,
                            extendedTimeOut: 2000,

                        };

                        toastr.success(
                            `Module Masterfile was successfully updated`,
                        );
                        $('#edit_module_msfl').modal('hide');
                        $('#module_msfl').modal('show');
                        var table = $('#module_masterfile').DataTable();
                        var currentPage = table.page();

                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                        }, false);


                        $('#module_list').DataTable().ajax.reload();
                    }
                });
            }
        });
    }
    function submiteditedmodule(id) {
        var mod_name = $('#edit_mod_name').val();
        var mod = $('#edit_mod_id option:selected').text().trim();
        var sub_mod = $('#edit_sub_mod_id').val();
        var mod_abbr = $('#edit_mod_abbr').val();
        var bcode = $('#edit_business_unit').val() || '';

        var co = $('#edit_co').val() || '';
        var bcode = $('#edit_bu').val() || '';
        var dep = $('#edit_dept').val() || '';

        var company = $('#edit_co option:selected').text().trim();
        var business_unit = $('#edit_bu option:selected').text().trim();
        var department = $('#edit_dept option:selected').text().trim();
        var date_request = $('#edit_date_request').val();
        var date_implem = $('#edit_date_implem').val();
        var team = $('#edit_team_').val();
        var date_implem = $('#edit_date_implem').val();
        var date_parallel = $('#edit_date_parallel').val();
        var other_details = $('#edit_other_details').val();


        if (company === 'Select Company') company = '';
        if (business_unit === 'Select Business Unit') business_unit = '';
        if (department === 'Select Department') department = '';


        if (bcode === "") {
            business_unit = '';
        }

        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to edit this module data Implemented!',
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
                    url: '<?php echo base_url("update_module"); ?>',
                    type: 'POST',
                    data: {
                        id: id,
                        mod_name: mod_name,
                        mod: mod,
                        sub_mod: sub_mod,
                        mod_abbr: mod_abbr,
                        co: co,
                        bcode: bcode,
                        dep: dep,

                        company: company,
                        business_unit: business_unit,
                        department: department,

                        date_request: date_request,
                        team: team,
                        date_implem: date_implem,
                        date_parallel: date_parallel,
                        other_details: other_details
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        });
                    },
                    success: function (data) {
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 5000,
                            extendedTimeOut: 2000,

                        };

                        toastr.success(
                            `Module was successfully updated`,
                        );
                        $('#edit_module').modal('hide');
                        $('#view_dept_implemented_modules').modal('show');
                        var table = $('#view_dept_implemented_module').DataTable();
                        var currentPage = table.page();

                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                        }, false);
                    }
                });
            }
        });
    }
    function edit_submodule_modal(sub_mod_id) {
        $.ajax({
            url: '<?= base_url('edit_submodule_content') ?>',
            type: 'POST',
            data: { sub_mod_id: sub_mod_id },
            cache: false,
            error: function () {
                toastr.options = {
                    progressBar: true,
                    positionClass: "toast-top-left",
                    timeOut: 5000,
                    extendedTimeOut: 2000,

                };

                toastr.error(
                    `Oops! Something went wrong.`,
                );
            },
            success: function (data) {
                $("#edit_submodule_content").html(data);
            }
        });
    }
    function submiteditedsubmodule(sub_mod_id) {
        var sub_mod_name = $('#edit_sub_mod_name').val();

        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to edit this sub module name!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update it!',
            cancelButtonText: 'No, cancel!',
            showLoaderOnConfirm: true,
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '<?php echo base_url("update_submodule"); ?>',
                    type: 'POST',
                    data: { sub_mod_id: sub_mod_id, sub_mod_name: sub_mod_name },
                    error: function () {
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 5000,
                            extendedTimeOut: 2000,

                        };

                        toastr.error(
                            `Oops! Something went wrong.`,
                        );
                    },
                    success: function (data) {
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 5000,
                            extendedTimeOut: 2000,

                        };

                        toastr.success(
                            `Sub Module was successfully updated`,
                        );
                        $('#edit_submodule').modal('hide');
                        $('#submodule').modal('show');
                        $('#submodule_list').DataTable().ajax.reload();
                    }
                });
            }
        });
    }
    function approve_new_module(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to approve this new System?',
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

                        };

                        toastr.success(
                            `New system | module successfully approve`,
                        );
                        var table = $('#module_list').DataTable();
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

                        };

                        toastr.success(
                            `New system | module was successfully recalled`,
                        );
                        var table = $('#module_list').DataTable();
                        var currentPage = table.page();

                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                        }, false);
                    },
                });
            }
        });
    }
    function deleteModuleset(id) {
        Swal.fire({
            title: 'Warning?',
            text: 'Module setup will be deleted !',
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
                    url: '<?php echo base_url('deleteModuleset'); ?>',
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

                        };

                        toastr.success(
                            `Module setup was successfully deleted`,
                        );
                        $('#module_list').DataTable().ajax.reload();
                        var table = $('#view_dept_implemented_module').DataTable();
                        var currentPage = table.page();

                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                        }, false);
                        updateModuleCount();
                    },
                });
            }
        });
    }

    function delete_module_msfl(id) {
        Swal.fire({
            title: 'Warning?',
            text: 'Module will be deactivated as well as the setup and sub modules.',
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
                    url: '<?php echo base_url('delete_module'); ?>',
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

                        };

                        toastr.success(
                            `Module was successfully deactivated`,
                        );
                        var table = $('#module_masterfile').DataTable();
                        var currentPage = table.page();

                        table.ajax.reload(function () {
                            table.page(currentPage).draw(false);
                        }, false);
                        updateModuleCount();
                    },
                });
            }
        });
    }

    function see_why_pending() {
        Swal.fire({
            icon: 'warning',
            title: 'Pending Approval',
            text: 'Not yet approved. Please upload the necessary documents and wait for management approval.',
            position: 'top-center',
            showConfirmButton: true,
            timer: 5000,
            timerProgressBar: true,
        });
    }


</script>

<script>
    $(document).ready(function () {
        $('.generate').click(function () {
            window.open('<?php echo site_url("admin/generate_pdf"); ?>', '_blank');
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var tooltipButton = document.getElementById('tooltipButton');
        new bootstrap.Tooltip(tooltipButton);
    });

</script>
<script>
    $(document).ready(function () {
        $('[data-bs-target="#create_module"]').on("click", function () {
            let modId = $("#mod_id").val();
            let subModId = $("#sub_mod_id").val();
            let modName = $("#mod_name").text();
            let teamId = $("#id").val();
            let systemType = $("#tos").val();

            $("#hidden_id").val(modId);
            $("#hidden_sub_mod_id").val(subModId);
            $("#display_mod_name").text(`Module: ${modName}`);
            $("#hidden_team_id").val(teamId);
            $("#hidden_type").val(systemType);
        });
    });

</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        flatpickr.defaultConfig.allowInput = true;
        flatpickr.defaultConfig.dateFormat = "Y-m-d";
        flatpickr.defaultConfig.altInput = true;
        flatpickr.defaultConfig.altFormat = "F j, Y";
        flatpickr.defaultConfig.disableMobile = true;
        flatpickr("[data-provider='flatpickr']");
    });

</script>

<style>
    .text-justify {
        text-align: justify !important;
        white-space: normal !important;
        word-break: break-word;
    }

</style>