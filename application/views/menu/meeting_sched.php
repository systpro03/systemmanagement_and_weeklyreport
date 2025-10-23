<div class="modal fade zoomIn" id="upload_attendance_modal" tabindex="-1" aria-labelledby="upload_attendance_modal" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-info-subtle">
                <h5 class="modal-title" id="modal-title">Upload Attendance | Meeting</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body p-4">
                <div class="text-center">
                    <p><i class="ri-error-warning-line text-danger"></i> UNDER CONSTRUCTION . . .</p>
                </div>
            </div>
            <div class="modal-footer">
                <div class="hstack gap-2 justify-content-end">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Meeting Details Modal -->
<div class="modal fade zoomIn" id="meetingDetailsModal" tabindex="-1" aria-labelledby="meetingDetailsModalLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-info-subtle">
                <h5 class="modal-title" id="meetingDetailsModalLabel">Meeting Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="meetingDetailsBody">
            </div>
            <div class="modal-footer">
                <div class="hstack gap-2 justify-content-end">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade zoomIn" id="meeting_modal" tabindex="-1" aria-labelledby="meeting_modal" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-info-subtle">
                <h5 class="modal-title" id="modal-title">Add Meeting</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body p-4">
                <form id="meeting-form">
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
                                <label for="module">Module <small><span class="text-danger"> ( You can select multiple
                                            module to assigned. ) </span>:</small></label>
                                <select class="form-select mb-3" id="module" multiple name="module[]">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label>Meeting Date <span class="text-danger">*</span> :</label>
                                <div class="input-group">
                                    <input type="date" id="meeting_date" class="form-control" readonly=""
                                        placeholder="Select date" data-provider="flatpickr" />
                                    <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label>Start Time <span class="text-danger">*</span> :</label>
                                <div class="input-group">
                                    <input type="time" id="time" class="form-control" readonly=""
                                        placeholder="Select Time" value="" />
                                    <span class="input-group-text"><i class="ri-time-line"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Location <span class="text-danger">*</span> :</label>
                                <input id="location" type="text" class="form-control" placeholder="Location"
                                    autocomplete="off" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Reason <span class="text-danger">*</span> :</label>
                                <textarea class="form-control" id="reasons" placeholder="Reason" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="hstack gap-2 justify-content-end">
                        <button type="submit" class="btn btn-success">Add Meeting</button>
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal"> Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade zoomIn" id="edit_meeting_modal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static"
    data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-info-subtle">
                <h5 class="modal-title" id="modal-title">Scheduled Meeting | Edit Meeting</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body p-4">

                <div class="text-end">
                    <a href="#" class="btn btn-sm btn-soft-primary" id="edit-event-btn" data-id="edit-event"
                        onclick="editEvent(this)" role="button">Edit</a>
                </div>


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
                    <div class="d-flex mb-2">
                        <div class="flex-grow-1 d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <i class=" ri-bar-chart-grouped-line  text-muted fs-16"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="d-block fw-semibold mb-0" id="edit_module_preview"></h6>
                            </div>
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
                    <div class="d-flex mb-3">
                        <div class="flex-shrink-0 me-3">
                            <i class="ri-user-2-line text-muted fs-16"></i>
                        </div>
                        <div class="flex-grow-1">
                            <p class="d-block mb-0" id="added_by" />
                        </div>
                    </div>
                </div>
                <form id="edit_meeting-form">
                    <div class="row event-form" id="event-form" style="display: none;">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Team Name <small><span class="text-danger"> ( You can select
                                            multiple team you have assigned to. ) :</span></small></label>
                                <select class="form-select mb-3 " id="edit_team" multiple name="edit_team[]">
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
                                <label>Meeting Date <span class="text-danger">*</span> :</label>
                                <div class="input-group">
                                    <input type="date" id="edit_meeting_date" class="form-control"
                                        data-provider="flatpickr" placeholder="Select date" readonly="" />
                                    <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label>Start Time <span class="text-danger">*</span> :</label>
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
                                <input id="edit_location" type="text" class="form-control" placeholder="Location"
                                    autocomplete="off" />
                                <input id="edit_id" type="hidden" class="hidden form-control" placeholder="Id" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Reason <span class="text-danger">*</span> :</label>
                                <textarea class="form-control" id="edit_reasons" placeholder="Reason"
                                    rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-soft-danger" id="delete-event-btn"><i
                                class="ri-close-line align-bottom"></i> Delete</button>
                        <button type="button" class="btn btn-soft-info" id="update-meeting-btn"> Update</button>
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal"> Close</button>
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
                <h4 class="mb-sm-0">Meeting Setup </h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Meeting </a></li>
                        <li class="breadcrumb-item active">Index<i class="mdi mdi-alpha-x-circle:"></i></li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">

            <!-- Action Button and Upcoming Meetings Panel -->
            <div class="row">
                <div class="col-xl-3">
                    <?php if ($this->session->userdata('position') != 'Programmer'): ?>
                        <div class="card card-h-100 mb-3">
                            <div class="card-header d-flex gap-2">
                                <button class="btn btn-primary flex-fill fs-11" data-bs-toggle="modal"
                                    data-bs-target="#upload_attendance_modal">
                                    <i class="mdi mdi-plus"></i> Upload
                                </button>
                                <button class="btn btn-primary flex-fill fs-11" data-bs-toggle="modal"
                                    data-bs-target="#meeting_modal">
                                    <i class="mdi mdi-plus"></i> New Schedule | Meeting
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>



                    <div class="card shadow-none mb-3">

                        <div class="card-body bg-info-subtle rounded">
                            <ul class="nav nav-pills card-header-pills mb-3" role="tablist">
                                <li class="nav-item w-50">
                                    <a class="nav-link active fs-11" data-bs-toggle="tab" href="#cur_calendar" role="tab">
                                        Upcoming Meetings
                                    </a>
                                </li>
                                <li class="nav-item w-50">
                                    <a class="nav-link fs-11" data-bs-toggle="tab" href="#previous" role="tab">
                                        Previous Meetings
                                    </a>
                                </li>
                            </ul>
                            <select class="form-select mt-2" id="scheduled_meeting">
                                <option value="">Scheduled Meeting</option>
                            </select>

                            <div class="tab-content mt-3">
                                <!-- Upcoming Meetings Tab -->
                                <div class="tab-pane fade show active" id="cur_calendar" role="tabpanel">
                                    <div class="pe-2 me-n1 mb-3" data-simplebar
                                        style="height: 590px; overflow-y: auto;">
                                        <div id="upcoming-event-list"></div>
                                    </div>
                                </div>

                                <!-- Previous Meetings Tab -->
                                <div class="tab-pane fade" id="previous" role="tabpanel">
                                    <div class="pe-2 me-n1 mb-3" data-simplebar
                                        style="height: 590px; overflow-y: auto;">
                                        <div id="previous-event-list"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="pe-2 me-n1 mb-3" data-simplebar style="height: 430px">
                        <div id="upcoming-event-list"></div>
                    </div> -->
                </div>

                <div class="col-xl-9">
                    <div class="card">
                        <div class="card-body">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    $(document).ready(function () {
        $('#team, #edit_team').select2({ placeholder: 'Select Team', allowClear: true, closeOnSelect: false });
        $('#module, #edit_module').select2({ placeholder: 'Module Name | System', allowClear: true, closeOnSelect: false });
        $('#scheduled_meeting').select2({ placeholder: 'Scheduled Meeting', allowClear: true });
    });
    $(document).ready(function () {

        loadScheduledMeeting();


        $.ajax({
            url: '<?php echo base_url('get_team') ?>',
            type: 'POST',
            success: function (response) {
                teamData = JSON.parse(response);
                $('#team, #edit_team').empty().append('<option value="">Select Team Name</option>');
                $('#module, #edit_module').prop('disabled', true);
                teamData.forEach(function (team) {
                    $('#team, #edit_team').append('<option value="' + team.team_id + '">' + team.team_name + '</option>');
                });
            }
        });
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
                    $('#module, #edit_module').prop('disabled', false);
                    moduleData.forEach(function (module) {
                        $('#module, #edit_module').append('<option value="' + module.mod_id + '">' + module.mod_name + '</option>');
                    });
                }
            });
        }
        loadModule();

        $('#team, #edit_team').change(function () {
            loadModule();
        })
    });
</script>
<script>
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
            navLinks: true,
            themeSystem: "bootstrap5",
            headerToolbar: {
                left: "prev,next today",
                center: "title",
                right: "multiMonthYear,dayGridMonth,listMonth",
            },
            events: function (fetchInfo, successCallback, failureCallback) {
                $.ajax({
                    url: '<?= base_url('get_meeting') ?>',
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
                $('#edit_meeting_modal').modal('show');
                $('#edit_team_preview').text(info.event.extendedProps.team_names);
                $('#edit_module_preview').text(info.event.extendedProps.mod_names);
                $('#edit_time_preview').text(info.event.extendedProps.time);
                $('#edit_location_preview').text(info.event.extendedProps.location);
                $('#edit_reason_preview').text(info.event.extendedProps.reasons);
                $('#added_by').text('Added by: ' + info.event.extendedProps.added_by);
                $('#event-details').show();
                $('.fc-popover').remove();

                $('#event-form').hide();
                $('#edit_team').val(info.event.extendedProps.team_ids.split(',')).trigger('change');
                setTimeout(function () {
                    $('#edit_module').val(info.event.extendedProps.mod_ids.split(',')).trigger('change');
                }, 800);

                const localDate = new Date(info.event.start);
                localDate.setMinutes(localDate.getMinutes() - localDate.getTimezoneOffset());

                $('#edit_time').val(info.event.extendedProps.time);
                flatpickr('#edit_meeting_date').setDate(localDate.toISOString().slice(0, 10), true);
                $('#edit_location').val(info.event.extendedProps.location);
                $('#edit_reasons').val(info.event.extendedProps.reasons);
                $('#edit_id').val(info.event.extendedProps.id);

                // ✳️ DATE CONDITION & POSITION CHECK
                const eventDate = new Date(info.event.start);
                const today = new Date();
                today.setHours(0, 0, 0, 0);
                eventDate.setHours(0, 0, 0, 0);

                const userPosition = "<?= $this->session->userdata('position'); ?>";

                if (userPosition !== 'Programmer' && eventDate >= today) {
                    $('#edit-event-btn').text("Edit").show();
                    $('#delete-event-btn').show();
                    $('#update-meeting-btn').hide();

                } else {
                    $('#edit-event-btn').hide();
                    $('#delete-event-btn').hide();
                    $('#update-meeting-btn').hide();
                }

                $('#edit-event-btn').data('event', info.event);
                $('#edit_team').data('assigned-team-ids', info.event.extendedProps.team_ids);
                $('#edit_module').data('assigned-mod-ids', info.event.extendedProps.mod_ids);
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
                        `Meetings cannot be scheduled for past dates. Please choose today or a future date.`,
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

                    toastr.warning(`Meetings cannot be scheduled for weekends ( Sunday ).`);
                    return;
                }


                var selectedDate = info.date;
                flatpickr("#meeting_date", {
                    altInput: true,
                    altFormat: "F j, Y",
                    dateFormat: "Y-m-d",
                }).setDate(selectedDate, true);
                $('#meeting_modal').modal('show');
            }

        });
        calendar.render();
        $('#edit-event-btn').click(function () {
            var event = $(this).data('event');

            if ($(this).text() === "Cancel") {
                $('#event-details').show();
                $('#event-form').hide();
                $('#update-meeting-btn').hide();
                $('#delete-event-btn').show();
                $(this).text("Edit");
            } else {
                $('#event-details').hide();
                $('#event-form').show();
                $('#update-meeting-btn').show();
                $('#delete-event-btn').show();
                $(this).text("Cancel");
            }
        });

        $('#meeting_modal').on('submit', 'form', function (e) {
            e.preventDefault();
            var team_id = $(this).find('#team').val();
            var team_name = $(this).find('#team option:selected').text();
            var mod_id = $(this).find('#module').val();
            var date = $(this).find('#meeting_date').val();
            var time = $(this).find('#time').val();
            var location = $(this).find('#location').val();
            var reasons = $(this).find('#reasons').val();


            var teams = $('#team').val();
            var team_ids_str = Array.isArray(teams) ? teams.join(',') : teams || '';


            var module_ids = $('#module').val();
            var module_ids_str = Array.isArray(module_ids) ? module_ids.join(',') : module_ids || '';


            var selected_time = new Date(date + ' ' + time);
            var currentDateTime = new Date();
            if (selected_time < currentDateTime) {
                toastr.options = {
                    progressBar: true,
                    positionClass: "toast-top-left",
                    timeOut: 5000,
                    extendedTimeOut: 2000,

                };

                toastr.info(
                    `Please select a time | date that is not before the current time | date.`,
                );
                return;
            }

            var eventData = {
                team_id: team_ids_str,
                team_name: team_name,
                mod_id: module_ids_str,
                date_meeting: date,
                time: time,
                location: location,
                reasons: reasons,
            };
            if (team_id == "" || date == "" || time == "" || location == "" || reasons == "") {
                toastr.options = {
                    progressBar: true,
                    positionClass: "toast-top-left",
                    timeOut: 5000,
                    extendedTimeOut: 2000,

                };

                toastr.error(
                    `Please fill up the required fields.`,
                );

                $('#team, #meeting_date, #time, #location,#reasons').each(function () {
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
                        url: '<?= base_url('add_meeting') ?>',
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
                                `Meeting schedule was successfully added.`,
                            );
                            calendar.addEvent(eventData);
                            calendar.refetchEvents();
                            $('#meeting_modal').modal('hide');
                            loadUpcomingEvents();
                        },
                    });
                }
            });
        });

        $('#delete-event-btn').click(function () {
            var id = $('#edit_id').val();
            var team_id = $('#edit_team').val();

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
                        url: '<?= base_url('delete_meeting') ?>',
                        type: 'POST',
                        data: {
                            id: id,
                            team_id: team_id
                        },
                        success: function (response) {
                            response = JSON.parse(response);
                            if (response.status == 'success') {
                                toastr.options = {
                                    progressBar: true,
                                    positionClass: "toast-top-left",
                                    timeOut: 5000,
                                    extendedTimeOut: 2000,
                                };

                                toastr.success('Meeting schedule was successfully deleted.');

                                calendar.refetchEvents();
                                loadUpcomingEvents();
                                $('#edit_meeting_modal').modal('hide');
                            } else {
                                toastr.options = {
                                    progressBar: true,
                                    positionClass: "toast-top-left",
                                    timeOut: 5000,
                                    extendedTimeOut: 2000,
                                };

                                toastr.error(response.message || 'You can\'t delete another team\'s meeting schedule.');
                            }
                        },
                    });
                }
            });
        });


        $('#update-meeting-btn').click(function () {
            var id = $('#edit_id').val();
            var team_id = $('#edit_team').val();
            var team_name = $('#edit_team option:selected').text();
            var mod_id = $('#edit_module').val();
            var date = $('#edit_meeting_date').val();
            var time = $('#edit_time').val();
            var location = $('#edit_location').val();
            var reasons = $('#edit_reasons').val();

            var team_ids = $('#edit_team').val();
            var team_ids_str = team_ids ? team_ids.join(',') : '';

            var module_ids = $('#edit_module').val();
            var module_ids_str = Array.isArray(module_ids) ? module_ids.join(',') : module_ids || '';

            var selected_time = new Date(date + ' ' + time);
            var currentDateTime = new Date();
            if (selected_time < currentDateTime) {

                toastr.options = {
                    progressBar: true,
                    positionClass: "toast-top-left",
                    timeOut: 5000,
                    extendedTimeOut: 2000,

                };

                toastr.info(
                    `Please select a time that is not before the current time.`,
                );

                return;
            }

            var updateData = {
                id: id,
                team_id: team_ids_str,
                team_name: team_name,
                mod_id: module_ids_str,
                date_meeting: date,
                time: time,
                location: location,
                reasons: reasons,
            };
            calendar.addEvent(updateData);
            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to update this schedule?',
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
                        url: '<?= base_url('update_meeting') ?>',
                        type: 'POST',
                        data: updateData,
                        success: function (response) {
                            response = JSON.parse(response);
                            if (response.status == 'success') {
                                toastr.options = {
                                    progressBar: true,
                                    positionClass: "toast-top-left",
                                    timeOut: 5000,
                                    extendedTimeOut: 2000,

                                };

                                toastr.success(
                                    `Meeting schedule was successfully updated.`,
                                );
                                calendar.addEvent(updateData);
                                calendar.refetchEvents();
                                $('#edit_meeting_modal').modal('hide');
                                loadUpcomingEvents();
                            } else {
                                toastr.options = {
                                    progressBar: true,
                                    positionClass: "toast-top-left",
                                    timeOut: 5000,
                                    extendedTimeOut: 2000,

                                };

                                toastr.error(
                                    `Unauthorized, You cant update another teams meeting schedule.`,
                                );
                            }
                        },
                    });
                }
            });
        });
    });

    $('#meeting_modal').on('hidden.bs.modal', function () {
        $('#team').val([]).trigger('change');
        $('#module').val([]).trigger('change');
        $('#meeting_date, #time, #location, #reasons').val("");
    });

    function editEvent(button) {
        $('.event-details').hide();
        $('.event-form').show();
    }

    function loadUpcomingEvents() {
        $.ajax({
            url: '<?= base_url("get_upcoming_meetings") ?>',
            type: 'GET',
            data: {
                date: $('#scheduled_meeting').val() || ''
            },
            dataType: 'json',
            success: function (events) {
                var eventList = $('#upcoming-event-list');
                eventList.empty();
                if (events.length === 0) {
                    eventList.append(`<li class="list-group-item text-primary text-center"><iconify-icon icon="gis:search-layer" width="50" height="50"></iconify-icon><h6 class="mt-1">No meeting scheduled... </h6></li>
                    `);
                } else {
                    events.forEach(function (event) {
                        const meetingDate = new Date(event.date_meeting).toLocaleDateString('en-GB', {
                            day: 'numeric',
                            month: 'long',
                            year: 'numeric'
                        });

                        const teamNames = event.team_names || 'No teams assigned';
                        const moduleNames = event.mod_names || 'No modules assigned | Team Meetimg';
                        const reasons = event.reasons || 'No additional reasons provided';
                        const cardTitle = event.title || 'Meeting Overview';

                        const eventHTML = `
                        <div class="card mb-3 shadow-sm meeting-card"
                            style="transition: box-shadow 0.3s ease; cursor: pointer;"
                            data-date="${meetingDate}"
                            data-time="${event.time || 'TBD'}"
                            data-title="${cardTitle}"
                            data-teams="${teamNames}"
                            data-modules="${moduleNames}"
                            data-reasons="${reasons}">
                            <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="d-flex align-items-center">
                                <i class="mdi mdi-calendar-clock text-warning me-2" aria-hidden="true"></i>
                                <span class="fw-semibold fs-12 text-secondary">${meetingDate}</span>
                                <iconify-icon icon="line-md:check-all" width="20" height="20" class="text-success ms-2"></iconify-icon>
                                </div>
                                <small class="badge bg-primary text-white">${event.time || 'TBD'}</small>
                            </div>
                            <h6 class="card-title fs-12 fw-bold mb-2">${cardTitle}</h6>
                            <p class="mb-1 text-muted">
                                <i class="mdi mdi-account-group me-1" title="Teams"></i>
                                <span>${teamNames}</span>
                            </p>
                            <p class="mb-1 text-muted">
                                <i class="mdi mdi-view-module me-1" title="Modules"></i>
                                <span>${moduleNames}</span>
                            </p>
                            <p class="text-muted fs-10 mb-0 fst-italic">${reasons}</p>
                            </div>
                        </div>
                        `;

                        eventList.append(eventHTML);
                    });
                }
            },
        });
    }
    // loadUpcomingEvents();

    function loadPreviousEvents() {
        $.ajax({
            url: '<?= base_url("Menu/Meeting/get_previous_meetings") ?>',
            type: 'GET',
            data: {
                date: $('#scheduled_meeting').val() || ''
            },
            dataType: 'json',
            success: function (events) {
                var eventList = $('#previous-event-list');
                eventList.empty();
                if (events.length === 0) {
                    eventList.append(`<li class="list-group-item text-primary text-center"><iconify-icon icon="gis:search-layer" width="50" height="50"></iconify-icon><h6 class="mt-1">No meeting scheduled... </h6></li>
                    `);
                } else {
                    events.forEach(function (event) {
                        const meetingDate = new Date(event.date_meeting).toLocaleDateString('en-GB', {
                            day: 'numeric',
                            month: 'long',
                            year: 'numeric'
                        });

                        const teamNames = event.team_names || 'No teams assigned';
                        const moduleNames = event.mod_names || 'No modules assigned';
                        const reasons = event.reasons || 'No additional reasons provided';
                        const cardTitle = event.title || 'Meeting Overview';

                        const eventHTML = `
                        <div class="card mb-3 shadow-sm meeting-card"
                            style="transition: box-shadow 0.3s ease; cursor: pointer;"
                            data-date="${meetingDate}"
                            data-time="${event.time || 'TBD'}"
                            data-title="${cardTitle}"
                            data-teams="${teamNames}"
                            data-modules="${moduleNames}"
                            data-reasons="${reasons}">
                            <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="d-flex align-items-center">
                                <i class="mdi mdi-calendar-clock text-warning me-2" aria-hidden="true"></i>
                                <span class="fw-semibold fs-12 text-secondary">${meetingDate}</span>
                                <iconify-icon icon="line-md:check-all" width="20" height="20" class="text-success ms-2"></iconify-icon>
                                </div>
                                <small class="badge bg-primary text-white">${event.time || 'TBD'}</small>
                            </div>
                            <h6 class="card-title fs-12 fw-bold mb-2">${cardTitle}</h6>
                            <p class="mb-1 text-muted">
                                <i class="mdi mdi-account-group me-1" title="Teams"></i>
                                <span>${teamNames}</span>
                            </p>
                            <p class="mb-1 text-muted">
                                <i class="mdi mdi-view-module me-1" title="Modules"></i>
                                <span>${moduleNames}</span>
                            </p>
                            <p class="text-muted fs-10 mb-0 fst-italic">${reasons}</p>
                            </div>
                        </div>
                        `;
                        eventList.append(eventHTML);
                    });

                }
            },
        });
    }
    // loadPreviousEvents();

    $('#scheduled_meeting').on('change', loadPreviousEvents);
    $('#scheduled_meeting').on('change', loadUpcomingEvents);

    $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
        $('#scheduled_meeting').val('');
        loadUpcomingEvents();
        loadPreviousEvents();
    });




</script>
<script>
$(document).on('click', '.meeting-card', function () {
  const date = $(this).data('date');
  const time = $(this).data('time');
  const title = $(this).data('title');
  const teams = $(this).data('teams');
  const modules = $(this).data('modules');
  const reasons = $(this).data('reasons');

  const modalBody = `
    <div class="container">
      <div class="row mb-3">
        <div class="col-md-12">
          <h4 class="text-primary fw-bold mb-2"><i class="mdi mdi-clipboard-text-outline me-1"></i>${title}</h4>
          <hr />
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-md-6">
          <p class="mb-1"><i class="mdi mdi-calendar-blank-outline text-primary me-2"></i><strong>Date:</strong> ${date}</p>
          <p class="mb-1"><i class="mdi mdi-clock-time-four-outline text-primary me-2"></i><strong>Time:</strong> ${time}</p>
        </div>
        <div class="col-md-6">
          <p class="mb-1"><i class="mdi mdi-account-group-outline text-primary me-2"></i><strong>Teams Involved:</strong></p>
          <p class="text-muted ms-4">${teams}</p>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-md-12">
          <p class="mb-1"><i class="mdi mdi-view-module-outline text-primary me-2"></i><strong>Modules Discussed:</strong></p>
          <p class="text-muted ms-4">${modules}</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <p class="mb-1"><i class="mdi mdi-comment-text-outline text-primary me-2"></i><strong>Purpose / Remarks:</strong></p>
          <div class="alert alert-secondary border-start border-4 border-primary fst-italic ms-2">
            ${reasons}
          </div>
        </div>
      </div>
    </div>
  `;

  $('#meetingDetailsBody').html(modalBody);
  const modal = new bootstrap.Modal(document.getElementById('meetingDetailsModal'));
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
    function loadScheduledMeeting() {
        // Bind the event handler for tab change
        $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function () {
            let activeTab = $(this).attr('href').replace('#', '');
            $.ajax({
                url: '<?php echo base_url('Menu/Meeting/get_scheduled_meeting') ?>',
                type: 'POST',
                data: {
                    date_type: activeTab
                },
                success: function (response) {
                    let meetingData = JSON.parse(response);
                    $('#scheduled_meeting').empty().append('<option value="">Scheduled Meeting</option>');

                    meetingData.forEach(function (meet) {
                        let dateObj = new Date(meet.date_meeting);
                        let formattedDate = dateObj.toLocaleDateString('en-US', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        });
                        $('#scheduled_meeting').append(
                            '<option value="' + meet.date_meeting + '">' + formattedDate + '</option>'
                        );
                    });
                },
            });
        });

        let initialTab = $('a[data-bs-toggle="tab"].active');
        if (initialTab.length) {
            initialTab.trigger('shown.bs.tab');
        }
    }
</script>