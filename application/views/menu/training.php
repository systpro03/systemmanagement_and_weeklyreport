<div class="modal fade zoomIn" id="training_modal" tabindex="-1" aria-labelledby="training_modal" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-info-subtle">
                <h5 class="modal-title" id="modal-title">Add Training | Fieldwork</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body p-4">
                <form id="training-form">
                    <div class="row event-form">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Team Name <small><span class="text-danger"> ( You can select
                                            multiple team you have assigned to. ) :</span></small></label>
                                <select class="form-select mb-3 " id="team" multiple name="team[]">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="name" class="col-form-label">Name <small><span class="text-danger"> ( You
                                            can select multiple name to assigned. ) :</span></small></label>
                                <select class="form-select mb-3" id="name" multiple name="name[]">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="module">Module <small><span class="text-danger"> ( You can select multiple
                                            module to assigned. ) </span>:</small></label>
                                <select class="form-select mb-3" id="module" multiple name="module[]">
                                    <option></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label for="module">Supervisor <small><span class="text-danger"> ( Optional )
                                        </span>:</small></label>
                                <select class="form-select mb-3" id="supervisor">
                                    <option></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label>Training | Fieldwork Date <small><span class="text-danger"> ( You can select range date )</span></small> <span class="text-danger">*</span> :</label>
                                <div class="input-group">
                                    <input type="date" id="training_date" class="form-control" readonly=""
                                        placeholder="Select date" data-provider="flatpickr"
                                        data-range-date="true" />
                                    <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label>Training Time <span class="text-danger">*</span> :</label>
                                <div class="input-group">
                                    <input type="time" id="time" class="form-control" readonly=""
                                        placeholder="Select Time" value=" " />
                                    <span class="input-group-text"><i class="ri-time-line"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Location <span class="text-danger">*</span> :</label>
                                <input id="location" type="text" class="form-control" placeholder="Location" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Details <span class="text-danger">*</span> :</label>
                                <textarea class="form-control" id="reasons" placeholder="Reason" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="hstack gap-2 justify-content-end">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal"> Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Training Details Modal -->
<div class="modal fade zoomIn" id="trainingDetailsModal" tabindex="-1" aria-labelledby="trainingDetailsModalLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content shadow-sm">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title fw-bold" id="trainingDetailsModalLabel">
                    <i class="mdi mdi-teach me-2"></i>Training Schedule Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="trainingDetailsBody">
                <!-- Content dynamically inserted -->
            </div>
            <div class="modal-footer">
                <div class="hstack gap-2 justify-content-end">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade zoomIn" id="edit_training_modal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static"
    data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-info-subtle">
                <h5 class="modal-title" id="modal-title">Training | Fieldwork | Edit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body p-4">
                <?php if ($this->session->userdata('position') != 'Programmer'): ?>
                    <div class="text-end">
                        <a href="#" class="btn btn-sm btn-soft-primary" id="edit-event-btn" data-id="edit-event"
                            onclick="editEvent(this)" role="button">Edit </a>
                    </div>
                <?php endif; ?>
                <div class="event-details" id="event-details">
                    <div class="d-flex mb-2">
                        <div class="flex-grow-1 d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <i class="ri-calendar-event-line text-muted fs-16"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="d-block fw-semibold mb-0" id="edit_team_preview"></h6>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="flex-shrink-0 me-3">
                            <i class="ri-calendar-event-line text-muted fs-16"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="d-block fw-semibold mb-0"><span id="edit_training_date_preview"></span></h6>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mb-2">
                        <div class="flex-shrink-0 me-3">
                            <i class="ri-time-line text-muted fs-16"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="d-block fw-semibold mb-0"><span id="edit_time_preview"></span></h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="flex-shrink-0 me-3">
                            <i class="ri-map-pin-line text-muted fs-16"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="d-block fw-semibold mb-0"> <span id="edit_location_preview"></span></h6>
                        </div>
                    </div>
                    <div class="d-flex mb-2">
                        <div class="flex-shrink-0 me-3">
                            <i class="ri-discuss-line text-muted fs-16"></i>
                        </div>
                        <div class="flex-grow-1">
                            <p class="d-block text-muted mb-0" id="edit_reason_preview" />
                        </div>
                    </div>
                    <div class="d-flex mb-2">
                        <div class="flex-shrink-0 me-3">
                            <i class=" ri-team-line  text-muted fs-16"></i>
                        </div>
                        <div class="flex-grow-1">
                            <p class="d-block text-muted mb-0" id="assigned" />
                        </div>
                    </div>
                    <div class="d-flex mb-2">
                        <div class="flex-shrink-0 me-3">
                            <i class="ri-admin-line  text-muted fs-16"></i>
                        </div>
                        <div class="flex-grow-1">
                            <p class="d-block text-muted mb-0" id="sup_assigned_name" />
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="flex-shrink-0 me-3">
                            <i class="ri-user-add-line  text-muted fs-16"></i>
                        </div>
                        <div class="flex-grow-1">
                            <p class="d-block mb-0" id="added_by" />
                        </div>
                    </div>
                </div>
                <form id="edit_training-form">
                    <div class="row event-form" id="event-form" style="display: none;">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Team Name <small><span class="text-danger"> ( You can select
                                            multiple team you have assigned to. )</span>:</small></label>
                                <select class="form-select mb-3" id="edit_team" multiple name="team[]"></select>
                                <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="name" class="col-form-label">Name <small><span class="text-danger"> ( You
                                            can select multiple name to assigned. ) </span>:</small></label>
                                <select class="form-select mb-3" id="edit_name" multiple name="edit_name[]">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="module">Module <small><span class="text-danger"> ( You can select multiple
                                            module to assigned. ) </span>:</small></label>
                                <select class="form-select mb-3" id="edit_module" multiple name="edit_module[]">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="module">Supervisor <small><span class="text-danger"> ( Optional )
                                        </span>:</small></label>
                                <select class="form-select mb-3" id="edit_supervisor">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label>Training | Fieldwork Date <small><span class="text-danger"> ( You can select range date )</span></small> <span class="text-danger">*</span> :</label>
                                <div class="input-group">
                                    <input type="text" id="edit_training_date" class="form-control"
                                        data-provider="flatpickr" placeholder="Select date" readonly=""
                                        data-range-date="true" />
                                    <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label>Training Time <span class="text-danger">*</span> :</label>
                                <div class="input-group">
                                    <input type="time" id="edit_time" class="form-control" placeholder="Select Time"
                                        readonly="" />
                                    <span class="input-group-text"><i class="ri-time-line"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Location <span class="text-danger">*</span> :</label>
                                <input id="edit_location" type="text" class="form-control" placeholder="Location" />
                                <input id="edit_id" type="hidden" class="hidden form-control" placeholder="Id" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Details <span class="text-danger">*</span> :</label>
                                <textarea class="form-control" id="edit_reasons" placeholder="Reason"
                                    rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <?php if ($this->session->userdata('position') != 'Programmer'): ?>
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-soft-danger" id="delete-event-btn"><i
                                    class="ri-close-line align-bottom"></i> Delete</button>
                            <button type="button" class="btn btn-soft-info" id="update-training-btn"> Update</button>
                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal"> Close</button>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Training | Fieldwork Setup </h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Training </a></li>
                        <li class="breadcrumb-item active">Index<i class="mdi mdi-alpha-x-circle:"></i></li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-12">
            <div class="alert alert-info border-0 d-flex align-items-center" role="alert">
                <i class="ri-information-line align-middle me-2 fs-4"></i>
                <div class="flex-grow-1">
                    <strong>Note:</strong>
                    You may create <strong>range-based trainings</strong> using the date selector (e.g., <em>August 1, 2025 to August 5, 2025</em> ) to define multi-day schedules.
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-xl-3">
                    <?php if ($this->session->userdata('position') != 'Programmer'): ?>
                        <div class="card card-h-100">
                            <div class="card-body">
                                <button class="btn btn-primary w-100" data-bs-toggle="modal"
                                    data-bs-target="#training_modal"><i class="mdi mdi-plus"></i> New Schedule |
                                    Fieldwork</button>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="card shadow-none mb-3">

                        <div class="card-body bg-info-subtle rounded">
                            <ul id="training-tabs" class="nav nav-pills card-header-pills mb-3" role="tablist">
                                <li class="nav-item w-50">
                                    <a class="nav-link active fs-11" data-bs-toggle="tab" href="#cur_calendar"
                                        role="tab">
                                        Upcoming Trainings
                                    </a>
                                </li>
                                <li class="nav-item w-50">
                                    <a class="nav-link fs-11" data-bs-toggle="tab" href="#previous" role="tab">
                                        Previous Trainings
                                    </a>
                                </li>
                            </ul>
                            <select class="form-select mt-2" id="scheduled_training">
                                <option value="">Scheduled Trainings</option>
                            </select>

                            <div class="tab-content mt-3">
                                <!-- Upcoming trainings Tab -->
                                <div class="tab-pane fade show active" id="cur_calendar" role="tabpanel">
                                    <div class="pe-2 me-n1 mb-3" data-simplebar
                                        style="height: 590px; overflow-y: auto;">
                                        <div id="upcoming-event-list"></div>
                                    </div>
                                </div>

                                <!-- Previous trainings Tab -->
                                <div class="tab-pane fade" id="previous" role="tabpanel">
                                    <div class="pe-2 me-n1 mb-3" data-simplebar
                                        style="height: 590px; overflow-y: auto;">
                                        <div id="previous-event-list"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div style='clear:both'></div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#team, #edit_team').select2({ placeholder: 'Select Team', allowClear: true, minimumResultsForSearch: Infinity, closeOnSelect: false, });
        $('#module, #edit_module').select2({ placeholder: 'Module Name | System', allowClear: true, minimumResultsForSearch: Infinity, closeOnSelect: false, });
        $('#name, #edit_name').select2({ placeholder: 'Select Name', allowClear: true, closeOnSelect: false });
        $('#supervisor, #edit_supervisor').select2({ placeholder: 'Select Supervisor', allowClear: true, minimumResultsForSearch: Infinity });
        $('#scheduled_training').select2({ placeholder: 'Scheduled Training', allowClear: true });
    });
    $(document).ready(function () {


        loadScheduledTraining();

        $.ajax({
            url: '<?php echo base_url('Menu/Training/get_supervisor') ?>',
            type: 'POST',
            success: function (response) {
                supData = JSON.parse(response);
                supData.forEach(function (sup) {
                    $('#supervisor, #edit_supervisor').append('<option value="' + sup.emp_id + '">' + sup.emp_name + '</option>');
                });
            }
        });


        $.ajax({
            url: '<?php echo base_url('get_team') ?>',
            type: 'POST',
            success: function (response) {
                teamData = JSON.parse(response);
                $('#team, #edit_team').empty().append('<option value="">Select Team Name</option>');
                $('#name, #edit_name').prop('disabled', true);
                teamData.forEach(function (team) {
                    $('#team, #edit_team').append('<option value="' + team.team_id + '">' + team.team_name + '</option>');
                });
            }
        });
        loadModule();
        function loadModule() {
            $.ajax({
                url: '<?php echo base_url('Admin/setup_module_dat5') ?>',
                type: 'POST',
                data: {
                    team: $('#team').val() || $('#edit_team').val(),
                },
                success: function (response) {
                    moduleData = JSON.parse(response);
                    $('#module, #edit_module').empty().append('<option value="">Select Module Name</option>');
                    moduleData.forEach(function (module) {
                        $('#module, #edit_module').append('<option value="' + module.mod_id + '">' + module.mod_name + '</option>');
                    });
                }
            });
        }

        let membersData = [];
        $('#name, #edit_name').prop('disabled', true);
        $('#position, #edit_position').prop('disabled', true);

        $('#team, #edit_team').change(function () {
            var team_ids = $(this).val();
            $('#name, #edit_name').prop('disabled', true).empty().append('<option value="">Select Name</option>');

            // if (team_ids.length === 0) return;
            $.ajax({
                url: '<?php echo base_url('Menu/It_Respo/setup_workload2') ?>',
                type: 'POST',
                data: { team_ids: team_ids },
                success: function (response) {
                    let membersData = JSON.parse(response);
                    let uniqueMembers = {};

                    membersData.forEach(function (member) {
                        if (!uniqueMembers[member.emp_id]) {
                            uniqueMembers[member.emp_id] = member.emp_name;
                        }
                    });

                    $.each(uniqueMembers, function (emp_id, emp_name) {
                        $('#name, #edit_name').append('<option value="' + emp_id + '">' + emp_name + '</option>');
                    });

                    $('#name, #edit_name').prop('disabled', false);
                    const assignedEmpIds = $('#edit_name').data('assigned-ids');
                    if (assignedEmpIds) {
                        $('#edit_name').val(assignedEmpIds.split(',')).trigger('change');
                    }

                    const assignedTeamIds = $('#edit_team').data('assigned-team-ids');
                    if (assignedTeamIds) {
                        loadModule(assignedTeamIds.split(','));
                    }


                    const assignedModIds = $('#edit_module').data('assigned-mod-ids');
                    if (assignedModIds) {
                        loadModule(assignedModIds.split(','));
                    }

                }
            });
        });

        $('#team, #edit_team').change(function () {
            loadModule();
        })
    });
</script>
<script>

    $(document).ready(function () {
        $('#update-training-btn').hide();
    });
    $(document).ready(function () {
        flatpickr("#time, #edit_time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "h:i K",
            time_24hr: false,
        });
        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
            initialView: 'multiMonthYear',
            selectable: true,
            editable: false,
            timeZone: "local",
            droppable: false,
            dayMaxEvents: true,
            navLinks: true,
            themeSystem: "bootstrap5",
            headerToolbar: {
                left: "prev,next today",
                center: "title",
                right: "multiMonthYear,dayGridMonth,timeGridWeek,listMonth",
            },
            events: function (fetchInfo, successCallback, failureCallback) {
                $.ajax({
                    url: '<?= base_url('get_training') ?>',
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        if (data && Array.isArray(data)) {
                            data.forEach(function (event) {
                                event.backgroundColor = getRandomColor();
                                event.borderColor = event.backgroundColor;
                            });
                            successCallback(data);
                        } else {
                            failureCallback();
                        }
                    },
                });
            },
            eventClick: function (info) {
                $('#edit_training_modal').modal('show');
                // $('#update-training-btn').hide();
                $('#edit_team_preview').text(info.event.extendedProps.team_names + ' | ' + info.event.extendedProps.mod_names);
                var startDate = new Date(info.event.start);
                var endDate = info.event.end ? new Date(info.event.end) : null;

                startDate.setMinutes(startDate.getMinutes() - startDate.getTimezoneOffset());

                if (endDate) {
                    endDate.setMinutes(endDate.getMinutes() - endDate.getTimezoneOffset());
                    endDate.setDate(endDate.getDate() - 1); // ✅ correct inclusive display
                }

                const formattedStart = startDate.toISOString().slice(0, 10);
                const formattedEnd = endDate ? endDate.toISOString().slice(0, 10) : null;

                const options = { year: 'numeric', month: 'long', day: '2-digit' };
                const formattedStartReadable = startDate.toLocaleDateString('en-US', options);
                const formattedEndReadable = endDate ? endDate.toLocaleDateString('en-US', options) : null;

                $('#edit_training_date_preview').text(formattedEndReadable ? `${formattedStartReadable} to ${formattedEndReadable}` : formattedStartReadable);


                flatpickr("#edit_training_date", {
                    altInput: true,
                    altFormat: "F j, Y",
                    dateFormat: "Y-m-d",
                    mode: "range"
                }).setDate(formattedEnd ? [formattedStart, formattedEnd] : formattedStart, true);

                $('#edit_time_preview').text(info.event.extendedProps.time);
                $('#edit_location_preview').text(info.event.extendedProps.training_loc);
                $('#edit_reason_preview').text(info.event.extendedProps.reasons);
                $('#assigned').text(info.event.extendedProps.assigned);
                $('#sup_assigned_name').text(info.event.extendedProps.sup_assigned_name);
                $('#added_by').text('Added by: ' + info.event.extendedProps.added_by);
                $('#event-details').show();
                $('.fc-popover').remove();

                $('#event-form').hide();
                $('#edit_team').val(info.event.extendedProps.team_ids.split(',')).trigger('change');

                setTimeout(function () {
                    $('#edit_module').val(info.event.extendedProps.mod_ids.split(',')).trigger('change');
                }, 800);
                $('#edit_time').val(info.event.extendedProps.time);
                $('#edit_location').val(info.event.extendedProps.training_loc);
                $('#edit_reasons').val(info.event.extendedProps.reasons);
                $('#edit_id').val(info.event.extendedProps.id);


                if (endDate) endDate.setHours(0, 0, 0, 0);
                const today = new Date();
                today.setHours(0, 0, 0, 0);
                const isOngoingOrFuture = endDate ? endDate >= today : startDate >= today;
                const userPosition = "<?= $this->session->userdata('position'); ?>";
                const team_id = "<?= $this->session->userdata('team_id'); ?>";
                const eventTeams = info.event.extendedProps.team_ids.split(',');
                if (userPosition !== 'Programmer' && isOngoingOrFuture || eventTeams.includes(team_id)) {
                    $('#edit-event-btn').text("Edit").show();
                    $('#delete-event-btn').show();
                    $('#update-training-btn').hide();
                } else {
                    $('#edit-event-btn').hide();
                    $('#delete-event-btn').hide();
                    $('#update-training-btn').hide();
                }
                $('#edit-event-btn').data('event', info.event);
                $('#edit_name').data('assigned-ids', info.event.extendedProps.assigned_ids);
                $('#edit_team').data('assigned-team-ids', info.event.extendedProps.team_ids);
                $('#edit_module').data('assigned-mod-ids', info.event.extendedProps.mod_ids);
                $('#edit_supervisor').val(info.event.extendedProps.sup_assigned).trigger('change');

            },

            eventDidMount: function (info) {
                var color = info.event.backgroundColor;
                info.el.style.backgroundColor = color;
                info.el.style.borderColor = color;
                info.el.style.color = 'white';
                var time = info.event.extendedProps.time;
                var timeElement = info.el.querySelector('.fc-list-event-time');
                if (timeElement) {
                    timeElement.textContent = time;
                }

            },
            dateClick: function (info) {
                var today = new Date();
                today.setHours(0, 0, 0, 0);

                var clickedDate = new Date(info.date);
                clickedDate.setHours(0, 0, 0, 0);

                if (clickedDate < today) {
                    toastr.options = {
                        progressBar: true,
                        positionClass: "toast-top-left",
                        timeOut: 5000,
                        extendedTimeOut: 2000,

                    };

                    toastr.warning(
                        `Trainings cannot be scheduled for past dates. Please choose today or a future date.`,
                    );
                    return;
                }

                var dayOfWeek = info.date.getDay();
                if (dayOfWeek === 0) {
                    toastr.options = {
                        progressBar: true,
                        positionClass: "toast-top-left",
                        timeOut: 5000,
                        extendedTimeOut: 2000,
                    };

                    toastr.warning(`Trainings cannot be scheduled for weekends ( Sunday ).`);
                    return;
                }

                var selectedDate = info.date;
                flatpickr("#training_date", {
                    altInput: true,
                    altFormat: "F j, Y",
                    dateFormat: "Y-m-d",
                    mode: "range",
                }).setDate(selectedDate, true);

                $('#training_modal').modal('show');
            }

        });
        calendar.render();
        $('#edit-event-btn').click(function () {
            var event = $(this).data('event');

            if ($(this).text() === "Cancel") {
                $('#event-details').show();
                $('#event-form').hide();
                $('#update-training-btn').hide();
                $('#delete-event-btn').show();
                $(this).text("Edit");
            } else {
                $('#event-details').hide();
                $('#event-form').show();
                $('#update-training-btn').show();
                $('#delete-event-btn').show();
                $(this).text("Cancel");
            }
        });

        $('#edit_training_modal').on('hidden.bs.modal', function () {
            $('#event-details').show();
            $('#event-form').hide();
            $('#update-training-btn').hide();
            $('#edit-event-btn').text("Edit");
        });


        $('#training_modal').on('submit', 'form', function (e) {
            e.preventDefault();
            var team_id = $(this).find('#team').val();
            var team_name = $(this).find('#team option:selected').text();
            var mod_id = $(this).find('#module').val();
            var date = $(this).find('#training_date').val();
            var time = $(this).find('#time').val();
            var location = $(this).find('#location').val();
            var reasons = $(this).find('#reasons').val();
            var supervisor = $(this).find('#supervisor').val();

            var teams = $('#team').val();
            var team_ids_str = Array.isArray(teams) ? teams.join(',') : teams || '';

            var emp_ids = $('#name').val();
            var emp_ids_str = Array.isArray(emp_ids) ? emp_ids.join(',') : emp_ids || '';


            var module_ids = $('#module').val();
            var module_ids_str = Array.isArray(module_ids) ? module_ids.join(',') : module_ids || '';

            // var selected_time = new Date(date + ' ' + time);
            // var currentDateTime = new Date();

            // if (selected_time < currentDateTime) {
            //     toastr.options = {
            //         progressBar: true,
            //         positionClass: "toast-top-left",
            //         timeOut: 5000,
            //         extendedTimeOut: 2000,

            //     };

            //     toastr.info(
            //         `Please select a time & date that is not before the current time | date.`,
            //     );
            //     return;
            // }

            var eventData = {
                team_id: team_ids_str,
                team_name: team_name,
                mod_id: module_ids_str,
                training_date: date,
                time: time,
                location: location,
                reasons: reasons,
                name: emp_ids_str,
                supervisor: supervisor
            };
            if (team_ids_str == "" || emp_ids_str == "" || mod_id == "" || date == "" || time == "" || location == "" || reasons == "") {
                toastr.options = {
                    progressBar: true,
                    positionClass: "toast-top-left",
                    timeOut: 5000,
                    extendedTimeOut: 2000,

                };

                toastr.error(
                    `Please fill up the required fields.`,
                );

                $('#team, #name, #module, #time, #training_date, #location, #reasons').each(function () {
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
            calendar.addEvent(eventData);
            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to add this data?',
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
                        url: '<?= base_url('add_training') ?>',
                        type: 'POST',
                        data: eventData,
                        success: function (response) {
                            toastr.options = {
                                progressBar: true,
                                positionClass: "toast-top-left",
                                timeOut: 5000,
                                extendedTimeOut: 2000,

                            };

                            toastr.success(
                                `Training schedule was successfully added.`,
                            );
                            calendar.addEvent(eventData);
                            calendar.refetchEvents();
                            $('#training_modal').modal('hide');
                            loadUpcomingEvents();
                        },
                    });
                }
            });
        });

        $('#delete-event-btn').click(function () {
            var id = $('#edit_id').val();
            var team_id = $('#edit_team').val();

            var deleteData = { id: id, team_id: team_id };

            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you really want to delete this event?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, keep it',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url('delete_training') ?>',
                        type: 'POST',
                        data: deleteData,
                        dataType: 'json',
                        success: function (response) {
                            if (response.status === 'success') {
                                toastr.options = {
                                    progressBar: true,
                                    positionClass: "toast-top-left",
                                    timeOut: 5000,
                                    extendedTimeOut: 2000,

                                };
                                toastr.success('Training schedule was successfully deleted.');
                                calendar.refetchEvents();
                                loadUpcomingEvents();
                                $('#edit_training_modal').modal('hide');
                            } else {
                                toastr.options = {
                                    progressBar: true,
                                    positionClass: "toast-top-left",
                                    timeOut: 5000,
                                    extendedTimeOut: 2000,

                                };
                                toastr.error('You can’t delete another team’s training schedule.');
                            }
                        },
                    });
                }
            });
        });

        $('#update-training-btn').click(function () {
            var id = $('#edit_id').val();

            var emp_ids = $('#edit_name').val();
            var emp_ids_str = emp_ids ? emp_ids.join(',') : '';

            var team_ids = $('#edit_team').val();
            var team_ids_str = team_ids ? team_ids.join(',') : '';

            var module_ids = $('#edit_module').val();
            var module_ids_str = Array.isArray(module_ids) ? module_ids.join(',') : module_ids || '';

            var updateData = {
                id: $('#edit_id').val(),
                team_id: team_ids_str,
                team_name: $('#edit_team option:selected').text(),
                mod_id: module_ids_str,
                training_date: $('#edit_training_date').val(),
                time: $('#edit_time').val(),
                location: $('#edit_location').val(),
                reasons: $('#edit_reasons').val(),
                name: emp_ids_str,
                supervisor: $('#edit_supervisor').val(),
            };

            // var selected_time = new Date(updateData.training_date + ' ' + updateData.time);
            // if (selected_time < new Date()) {
            //     toastr.info('Please select a time that is not before the current time.');
            //     return;
            // }
            calendar.addEvent(updateData);
            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to update this training schedule?',
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
                        url: '<?= base_url('update_training') ?>',
                        type: 'POST',
                        data: updateData,
                        dataType: 'json',
                        success: function (response) {
                            if (response.status == 'success') {
                                toastr.options = {
                                    progressBar: true,
                                    positionClass: "toast-top-left",
                                    timeOut: 5000,
                                    extendedTimeOut: 2000,

                                };

                                toastr.success(
                                    `Training schedule was successfully updated.`,
                                );
                                calendar.refetchEvents();
                                $('#edit_training_modal').modal('hide');
                                loadUpcomingEvents();
                            } else {
                                toastr.options = {
                                    progressBar: true,
                                    positionClass: "toast-top-left",
                                    timeOut: 5000,
                                    extendedTimeOut: 2000,

                                };

                                toastr.error(
                                    `You cant update another team's training schedule.`,
                                );
                            }
                        },
                    });
                }
            });
        });
    });


    $('#training_modal').on('hidden.bs.modal', function () {
        $('#team').val([]).trigger('change');
        $('#module').val([]).trigger('change');
        $('#training_date, #time, #location, #reasons').val("");
        $('#supervisor').val("").trigger('change');
    });

    function editEvent(button) {
        $('.event-details').hide();
        $('.event-form').show();
    }

    function loadUpcomingEvents() {
        $.ajax({
            url: '<?= base_url("Menu/Training/get_upcoming_trainings") ?>',
            type: 'GET',
            data: {
                date: $('#scheduled_training').val() || ''
            },
            dataType: 'json',
            success: function (events) {
                var eventList = $('#upcoming-event-list');
                eventList.empty();
                if (events.length === 0) {
                    eventList.append(`<li class="list-group-item text-primary text-center"><iconify-icon icon="fluent:box-multiple-search-24-filled" width="50" height="50"></iconify-icon><h6 class="mt-1">No training scheduled... </h6></li>
                    `);
                } else {
                    events.forEach(function (event) {
                        const eventHTML = `
                        <div class='card mb-3 training-card shadow-sm' style='cursor: pointer;'
                            data-date='${event.date_training}'
                            data-location='${event.training_loc}'
                            data-time='${event.time}'
                            data-teams='${event.team_names}'
                            data-modules='${event.mod_names}'
                            data-reasons='${event.reasons}'
                            data-assigned='${event.assigned_names || "N/A"}'
                            data-supervised='${event.assigned_sup || "N/A"}'>

                            <div class='card-body'>
                            <div class='d-flex mb-3'>
                                <div class='flex-grow-1'>
                                <i class='mdi mdi-checkbox-blank-circle me-2 text-warning'></i>
                                <span class='fw-bold fs-11'>
                                    ${formatTrainingDate(event.date_training)}
                                    |
                                    <strong class='text-danger fw-bold'>${event.training_loc}</strong>
                                </span>
                                </div>
                                <div class='flex-shrink-0'>
                                <small class='badge bg-primary-subtle text-primary'>${event.time}</small>                         
                                </div> 
                            </div>
                            <p class='mb-0 fw-bold'>${event.team_names} | ${event.mod_names || 'N/A'}</p>
                            <span class='text-muted mb-2 d-block'>${event.reasons}</span>
                            <hr class='my-2'>
                            <b>Assigned to:</b> <span class='text-muted'>${event.assigned_names || 'N/A'}</span><br>
                            <b>Supervised by:</b> <span class='text-muted'>${event.assigned_sup || 'N/A'}</span>
                            </div>             
                        </div>
                        `;

                        eventList.append(eventHTML);
                    });
                }
            },
        });
    }
    function loadPreviousEvents() {
        $.ajax({
            url: '<?= base_url("Menu/Training/get_previous_trainings") ?>',
            type: 'GET',
            data: {
                date: $('#scheduled_training').val() || ''
            },
            dataType: 'json',
            success: function (events) {
                var eventList = $('#previous-event-list');
                eventList.empty();
                if (events.length === 0) {
                    eventList.append(`<li class="list-group-item text-primary text-center"><iconify-icon icon="fluent:box-multiple-search-24-filled" width="50" height="50"></iconify-icon><h6 class="mt-1">No training scheduled... </h6></li>
                    `);
                } else {
                    events.forEach(function (event) {
                        const eventHTML = `
                        <div class='card mb-3 training-card shadow-sm' style='cursor: pointer;'
                            data-date='${event.date_training}'
                            data-location='${event.training_loc}'
                            data-time='${event.time}'
                            data-teams='${event.team_names}'
                            data-modules='${event.mod_names}'
                            data-reasons='${event.reasons}'
                            data-assigned='${event.assigned_names || "N/A"}'
                            data-supervised='${event.assigned_sup || "N/A"}'>

                            <div class='card-body'>
                            <div class='d-flex mb-3'>
                                <div class='flex-grow-1'>
                                <i class='mdi mdi-checkbox-blank-circle me-2 text-warning'></i>
                                <span class='fw-bold fs-11'>
                                    ${formatTrainingDate(event.date_training)}
                                    |
                                    <strong class='text-danger fw-bold'>${event.training_loc}</strong>
                                </span>
                                </div>
                                <div class='flex-shrink-0'>
                                <small class='badge bg-primary-subtle text-primary'>${event.time}</small>                         
                                </div> 
                            </div>
                            <p class='mb-0 fw-bold'>${event.team_names} | ${event.mod_names || 'N/A'}</p>
                            <span class='text-muted mb-2 d-block'>${event.reasons}</span>
                            <hr class='my-2'>
                            <b>Assigned to:</b> <span class='text-muted'>${event.assigned_names || 'N/A'}</span><br>
                            <b>Supervised by:</b> <span class='text-muted'>${event.assigned_sup || 'N/A'}</span>
                            </div>             
                        </div>
                        `;

                        eventList.append(eventHTML);
                    });
                }
            },
        });
    }
    $('#scheduled_training').on('change', loadPreviousEvents);
    $('#scheduled_training').on('change', loadUpcomingEvents);

    $('#training-tabs a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
        $('#scheduled_training').val('');
        loadUpcomingEvents();
        loadPreviousEvents();
    });

    function formatTrainingDate(dateStr) {
        if (dateStr.includes(' to ')) {
            let [start, end] = dateStr.split(' to ');
            let startDate = new Date(start);
            let endDate = new Date(end);
            return `${startDate.toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' })} to ${endDate.toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' })}`;
        } else {
            let dateObj = new Date(dateStr);
            return dateObj.toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' });
        }
    }

</script>
<script>
    $(document).on('click', '.training-card', function () {
        const date = formatTrainingDate($(this).data('date'));
        const time = $(this).data('time');
        const location = $(this).data('location');
        const teams = $(this).data('teams');
        const modules = $(this).data('modules');
        const reasons = $(this).data('reasons');
        const assigned = $(this).data('assigned');
        const supervised = $(this).data('supervised');

        const modalBody = `
            <div class="container">
            <div class="row mb-3">
                <div class="col-md-12">
                <h4 class="text-primary fw-bold"><i class="mdi mdi-school-outline me-2"></i>Training Session Overview</h4>
                <hr />
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                <p class="mb-1"><i class="mdi mdi-calendar-month-outline text-primary me-2"></i><strong>Date:</strong> <small>${date}</small></p>
                <p class="mb-1"><i class="mdi mdi-clock-time-four-outline text-primary me-2"></i><strong>Time:</strong> ${time}</p>
                </div>
                <div class="col-md-6">
                <p class="mb-1"><i class="mdi mdi-map-marker-outline text-primary me-2"></i><strong>Location:</strong> ${location}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                <p class="mb-1"><i class="mdi mdi-account-group-outline text-primary me-2"></i><strong>Teams:</strong></p>
                <p class="text-muted ms-4">${teams}</p>
                </div>
                <div class="col-md-12">
                <p class="mb-1"><i class="mdi mdi-view-module-outline text-primary me-2"></i><strong>Modules:</strong></p>
                <p class="text-muted ms-4">${modules}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                <p class="mb-1"><i class="mdi mdi-comment-outline text-primary me-2"></i><strong>Purpose / Remarks:</strong></p>
                <div class="alert alert-secondary border-start border-2 border-primary fst-italic ms-2">
                    ${reasons}
                </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                <p class="mb-1"><i class="mdi mdi-account-arrow-right-outline text-primary me-2"></i><strong>Assigned To:</strong></p>
                <p class="text-muted ms-4">${assigned}</p>
                </div>
                <div class="col-md-6">
                <p class="mb-1"><i class="mdi mdi-account-tie-outline text-primary me-2"></i><strong>Supervised By:</strong></p>
                <p class="text-muted ms-4">${supervised}</p>
                </div>
            </div>
            </div>
        `;

        $('#trainingDetailsBody').html(modalBody);
        const modal = new bootstrap.Modal(document.getElementById('trainingDetailsModal'));
        modal.show();
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

<script>
    function loadScheduledTraining() {
        $('#training-tabs a[data-bs-toggle="tab"]').on('shown.bs.tab', function () {
            let activeTab = $(this).attr('href').replace('#', '');
            $.ajax({
                url: '<?php echo base_url('Menu/Training/get_scheduled_training') ?>',
                type: 'POST',
                data: {
                    date_type: activeTab
                },
                success: function (response) {
                    let trainingData = JSON.parse(response);
                    $('#scheduled_training').empty().append('<option value="">Scheduled Training</option>');

                    trainingData.forEach(function (meet) {
                        let trainingDate = meet.date_training;

                        let formattedDate = '';
                        if (trainingDate.includes('to')) {
                            // Range case: split and format both dates
                            let [start, end] = trainingDate.split(' to ').map(d => new Date(d.trim()));
                            let options = { year: 'numeric', month: 'long', day: 'numeric' };

                            formattedDate = `${start.toLocaleDateString('en-US', options)} to ${end.toLocaleDateString('en-US', options)}`;
                        } else {
                            // Single date case
                            let dateObj = new Date(trainingDate.trim());
                            formattedDate = dateObj.toLocaleDateString('en-US', {
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric'
                            });
                        }

                        $('#scheduled_training').append(
                            '<option value="' + trainingDate + '">' + formattedDate + '</option>'
                        );
                    });
                },
            });
        });

        // Trigger initial tab on page load
        let initialTab = $('a[data-bs-toggle="tab"].active');
        if (initialTab.length) {
            initialTab.trigger('shown.bs.tab');
        }
    }

</script>