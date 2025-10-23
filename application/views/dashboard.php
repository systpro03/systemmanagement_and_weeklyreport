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


<!-- left offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasLeftLabel">
    <div class="d-flex align-items-center bg-primary p-3 offcanvas-header">
        <h5 class="m-0 me-2 text-white">My Team Members</h5>
        <button type="button" class="btn-close btn-close-white ms-auto" id="customizerclose-btn" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="card card-animate">
            <div class="card-header border-0">
                <h6 class="card-title mb-0 fw-bold fs-26" style="font-family: 'BirthdayFont';">My Team Members</h6>
            </div>
            <div class="table-responsive">
                <table class="table table-borderless table-nowrap align-middle mb-0" id="team_members">
                    <thead class="table-info">
                        <tr>
                            <th>Member</th>
                            <th>Contact</th>
                            <!-- <th>Team</th>
                            <th>Status</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($team_members)): ?>
                            <?php foreach ($team_members as $member): ?>
                                <tr>
                                    <td class="d-flex">
                                        <img src="<?= $member['photo'] ?>" alt=""
                                            class="avatar-xs rounded-circle shadow me-2" />
                                        <div>
                                            <h5 class="fs-13 mb-0">
                                                <?= htmlspecialchars($member['firstname'] . ' ' . $member['lastname'] . ' ' . $member['suffix']) ?>
                                            </h5>
                                            <p class="fs-6 mb-0 text-muted"><?= htmlspecialchars($member['position']) ?></p>
                                        </div>
                                    </td>
                                    <td>
                                        <h6 class="mb-0"><span class="text-muted"><?= $member['contact_no'] ?></span></h6>
                                    </td>
                                    <!-- <td>
                                        <h6 class="mb-0"><span class="text-muted"><?= $member['team_name'] ?></span></h6>
                                    </td>
                                    <td>
                                        <span class="badge bg-success"><?= $member['status'] ?></span>
                                    </td> -->
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center">No team members found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Dashboard </h4>

                <div class="page-title-right">
                    <a class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLeft"
                        aria-controls="offcanvasLeft">Birthday Celebrants</a>
                    <a class="btn btn-warning" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop"
                        aria-controls="offcanvasTop">My Team Members</a>
                </div>

            </div>
        </div>
    </div>

    <div class="row project-wrapper">
        <div class="col-xxl-12">
            <div class="row">
                <div class="col-xl-3" data-aos="zoom-in-right">
                    <div class="card profile-project-card card-animate profile-project-primary">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-primary rounded-2 fs-2">
                                        <iconify-icon icon="cib:visual-studio-code" class="fs-25"></iconify-icon>
                                    </span>
                                </div>
                                <div class="flex-grow-1 overflow-hidden ms-3">
                                    <p class="fw-bold text-muted text-truncate mb-3">System Programmers </p>
                                    <div class="d-flex align-items-center mb-3">
                                        <h4 class="fs-4 flex-grow-1 mb-0 text-end"><span class="counter-value"
                                                data-target="<?php echo $programmers_count; ?>"></span></h4>
                                    </div>
                                    <p class="text-muted text-truncate mb-0 fs-6">Active Programmers </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3" data-aos="zoom-in-right">
                    <div class="card profile-project-card card-animate profile-project-warning">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-warning rounded-2 fs-2">
                                        <iconify-icon icon="pixel:technology" class="fs-35"></iconify-icon>
                                    </span>
                                </div>
                                <div class="flex-grow-1 overflow-hidden ms-3">
                                    <p class="fw-bold text-muted text-truncate mb-3">System Analysts </p>
                                    <div class="d-flex align-items-center mb-3">
                                        <h4 class="fs-4 flex-grow-1 mb-0 text-end"><span class="counter-value"
                                                data-target="<?php echo $analysts_count; ?>"></span></h4>
                                    </div>
                                    <p class="text-muted text-truncate mb-0 fs-6">Active Analysts </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3" data-aos="zoom-in-left">
                    <div class="card profile-project-card card-animate profile-project-info">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-info rounded-2 fs-2">
                                        <iconify-icon icon="ix:data-management-filled" class="fs-35"></iconify-icon>
                                    </span>
                                </div>
                                <div class="flex-grow-1 overflow-hidden ms-3">
                                    <p class="fw-bold text-muted text-truncate mb-3">
                                        RMS Team </p>
                                    <div class="d-flex align-items-center mb-3">
                                        <h4 class="fs-4 flex-grow-1 mb-0 text-end"><span class="counter-value"
                                                data-target="<?php echo $others_count; ?>"></span> </h4>
                                    </div>
                                    <p class="text-muted text-truncate mb-0 fs-6">Active Rms </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3" data-aos="zoom-in-left">
                    <div class="card profile-project-card card-animate profile-project-success">
                        <div class="card-body">
                            <a href="<?php echo base_url('my_workloads'); ?>">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-light rounded-2 fs-2">
                                            <iconify-icon icon="twemoji:books" class="fs-35"></iconify-icon>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden ms-3">
                                        <p class="fw-bold text-muted text-truncate mb-3">
                                            My Workloads </p>
                                        <div class="d-flex align-items-center mb-3">
                                            <h4 class="fs-4 flex-grow-1 mb-0 text-end"><span class="counter-value"
                                                    data-target="<?php echo $my_workloads; ?>"></span> </h4>
                                        </div>
                                        <p class="text-muted text-truncate mb-0 fs-6">Number of Workloads </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xxl-12">
            <div class="row">
                <div class="col-xl-4" data-aos="zoom-in-up">
                    <div class="card card-animate">
                        <div class="card-header align-items-center d-flex bg-primary-subtle">
                            <h6 class="card-title mb-0 flex-grow-1 fw-bold text-uppercase text-center">Upcoming Meeting
                                Schedules </h6>
                        </div>
                        <div class="card-body" data-simplebar style="max-height: 415px;">
                            <ul id="upcoming-event-list" class="list-group list-group-flush border-dashed"></ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4" data-aos="zoom-in-up">
                    <div class="card card-animate">
                        <div class="card-header align-items-center d-flex bg-primary-subtle">
                            <h6 class="card-title mb-0 flex-grow-1 fw-bold text-uppercase text-center">Training |
                                Fieldwork Schedules</h6>
                        </div>
                        <div class="card-body" data-simplebar style="max-height: 415px;">
                            <ul id="upcoming-training-list" class="list-group list-group-flush border-dashed"></ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4" data-aos="zoom-in-up">
                    <div class="card card-animate">
                        <div class="card-header align-items-center d-flex bg-primary-subtle">
                            <h6 class="card-title mb-0 flex-grow-1 fw-bold text-uppercase text-center"> ALL FILES
                                MONITORING | DIRECTORY
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="nav nav-tabs nav-justified mb-1">
                                <a href="javascript:void(0);" class="nav-link " id="newTab" data-type="new">New System
                                    | Directory</a>
                                <a href="javascript:void(0);" class="nav-link active" id="currentTab"
                                    data-type="current">Current
                                    System | Directory</a>
                            </div>
                            <div id="system_monitoring" class="tab-pane show apex-charts" dir="ltr"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>


<script>
    $(document).ready(function () {
        $('#team_members').DataTable({
            "columnDefs": [
                { "className": "text-start", "targets": ['_all'] },
            ],
        });
    });
    $(document).ready(function () {
        const calendarElement = document.getElementById('birthday-calendar');
        const birthdayList = $('#birthday-list');
        const currentDate = new Date();

        function update_birthdays(month, year) {
            $('#birthday-list').html('<div class="text-center text-primary "><iconify-icon icon="svg-spinners:bars-rotate-fade" width="30" height="30"></iconify-icon></div>');
            $.ajax({
                url: "<?php echo base_url('get_birthdays'); ?>",
                type: "GET",
                data: { month: month, year: year },
                dataType: "json",
                success: function (response) {
                    birthdayList.empty();
                    let todayBirthdays = [];

                    if (response.status === 'success' && response.data.length > 0) {
                        const birthdayDates = [];

                        response.data.forEach((birthday) => {
                            const birthDate = new Date(birthday.birthdate);
                            birthdayDates.push(birthDate.getDate());

                            const formattedDate = birthDate.toLocaleDateString('en-US', {
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric',
                            });

                            let age = year - birthDate.getFullYear();
                            const isBeforeBirthday =
                                currentDate.getMonth() + 1 < month ||
                                (currentDate.getMonth() + 1 === month &&
                                    currentDate.getDate() < birthDate.getDate());
                            if (isBeforeBirthday) {
                                age--;
                            }

                            // Capitalize the first and last name before displaying
                            const fullName = `${birthday.firstname} ${birthday.lastname} ${birthday.suffix}`;
                            const formattedName = capitalizeName(fullName);

                            // Check if today is the person's birthday
                            const isTodayBirthday = birthDate.getDate() === currentDate.getDate() &&
                                birthDate.getMonth() === currentDate.getMonth();

                            if (isTodayBirthday) {
                                todayBirthdays.push(formattedName);
                            }

                            const bday_photo = birthday.photo.replace(/(\.\.\/)+/g, '');
                            let birthdayHTML = `
                            <div class="mini-stats-wid d-flex align-items-center mt-2">
                                <div class="flex-shrink-0 avatar-sm">
                                    <span class="mini-stat-icon avatar-title rounded-circle text-danger bg-danger-subtle fs-4">
                                        <img class="rounded-circle header-profile-user avatar-sm" src="http://172.16.161.34:8080/hrms/${bday_photo}" alt=""/>
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1 fw-bold">${formattedName}`;

                            if (isTodayBirthday) {
                                birthdayHTML += ' <iconify-icon icon="vaadin:check-circle" style="color: green; font-weight: bold"></iconify-icon>';
                            }

                            birthdayHTML += `</h6>
                                    <p class="text-muted mb-0 fs-11">${formattedDate}</p>
                                </div>
                            </div>`;
                            // <div class="flex-shrink-0">
                            //         <p class="text-muted mb-0 fs-15"><span class="badge bg-success fw-bold">${age} years old</span></p>
                            //     </div>
                            birthdayList.append(birthdayHTML);
                        });
                        updateCalendar(birthdayDates, month, year, response.data);
                    }
                },
            });
        }


        // Helper function to capitalize the first letter of each word
        function capitalizeName(name) {
            return name.split(' ').map(word => {
                return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
            }).join(' ');
        }


        function updateCalendar(birthdayDates, month, year, birthdayData) {
            const calendarInstance = calendarElement._flatpickr;
            const today = new Date();
            let todayBirthdays = []; // To store names of people with birthdays today

            if (calendarInstance) {
                calendarInstance.set('disable', [
                    function (date) {
                        return !(date.getMonth() === month - 1 && birthdayDates.includes(date.getDate()));
                    },
                ]);

                calendarInstance.set('onDayCreate', function (dObj, dStr, fp, dayElem) {
                    const day = parseInt(dayElem.innerText);

                    if (dayElem.classList.contains('prevMonthDay') || dayElem.classList.contains('nextMonthDay')) {
                        return;
                    }

                    // If it's a birthday date, highlight it
                    if (birthdayDates.includes(day)) {
                        dayElem.classList.add('highlighted-day');

                        const birthdaysOnDay = birthdayData.filter(b => {
                            const birthDate = new Date(b.birthdate);
                            return birthDate.getDate() === day && birthDate.getMonth() + 1 === month;
                        });

                        // Extract names for today's birthdays
                        if (
                            today.getDate() === day &&
                            today.getMonth() + 1 === month &&
                            today.getFullYear() === year
                        ) {
                            todayBirthdays = birthdaysOnDay.map(person => `${person.firstname} ${person.lastname} ${person.suffix}`);
                        }

                        const tooltipContent = birthdaysOnDay
                            .map(person => `${person.lastname}, ${person.firstname} ${person.suffix}`)
                            .join('<br>');
                        dayElem.setAttribute('data-bs-toggle', 'tooltip');
                        dayElem.setAttribute('data-bs-placement', 'top');
                        dayElem.setAttribute('data-bs-html', 'true');
                        dayElem.setAttribute('title', tooltipContent);

                        // Replace today's date with a cake icon if it's someone's birthday
                        if (
                            today.getDate() === day &&
                            today.getMonth() + 1 === month &&
                            today.getFullYear() === year
                        ) {
                            dayElem.innerHTML = '<iconify-icon icon="emojione-v1:birthday-cake" style="font-size: 35px;"></iconify-icon>';
                        }

                        dayElem.addEventListener('click', (event) => {
                            event.preventDefault();
                            event.stopPropagation();
                            calendarInstance.close();
                        });
                    }
                });

                const tooltipElements = document.querySelectorAll('[data-bs-toggle="tooltip"]');
                tooltipElements.forEach(dayElem => {
                    new bootstrap.Tooltip(dayElem);
                });
            }
        }


        const flatpickrInstance = flatpickr(calendarElement, {
            defaultDate: currentDate,
            inline: true,
            onMonthChange: function (selectedDates, dateStr, instance) {
                const newMonth = instance.currentMonth + 1;
                const newYear = instance.currentYear;
                update_birthdays(newMonth, newYear);
            },
            onYearChange: function (selectedDates, dateStr, instance) {
                const newMonth = instance.currentMonth + 1;
                const newYear = instance.currentYear;
                update_birthdays(newMonth, newYear);
            },
            onReady: function () {
                update_birthdays(currentDate.getMonth() + 1, currentDate.getFullYear());
            },
        });

        function loadUpcomingEvents() {
            $('#upcoming-event-list').html('<div class="text-center text-primary "><iconify-icon icon="svg-spinners:bars-rotate-fade" width="30" height="30"></iconify-icon></div>');
            $.ajax({
                url: '<?= base_url("get_upcoming_meetings") ?>',
                type: 'GET',
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
                            const moduleNames = event.mod_names || 'No modules assigned';
                            const reasons = event.reasons || 'No additional reasons provided';
                            const cardTitle = event.title || 'Meeting Overview';

                            var eventHTML = `
                            <li class="list-group-item ps-0 pe-0 py-2 meeting-card border-0 border-bottom"
                                style="cursor: pointer;"
                                data-date="${meetingDate}"
                                data-time="${event.time || 'TBD'}"
                                data-title="${cardTitle}"
                                data-teams="${teamNames}"
                                data-modules="${moduleNames}"
                                data-reasons="${reasons}"
                                data-location="${event.location || 'N/A'}">
                                
                                <a href="#" class="d-block text-decoration-none text-dark">
                                <div class="row g-3 align-items-center">
                                    <!-- Date Bubble -->
                                    <div class="col-auto">
                                    <div class="avatar-sm bg-light rounded shadow-sm p-2 text-center">
                                        <h5 class="mb-0 fw-bold text-info">${new Date(event.date_meeting).getDate()}</h5>
                                        <small class="text-muted">${new Date(event.date_meeting).toLocaleString('en-GB', { weekday: 'short' })}</small>
                                    </div>
                                    </div>

                                    <!-- Meeting Info -->
                                    <div class="col">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="mb-1 text-dark fs-13 fw-semibold">
                                        <i class="mdi mdi-clock-outline me-1 text-primary"></i>
                                        <span class="text-danger">${event.time || 'TBD'}</span>
                                        </h6>
                                        <span class="badge bg-info-subtle text-info fs-10">${event.location || 'No location'}</span>
                                    </div>

                                    <div class="text-muted fs-12 mb-1">
                                        <strong class="text-dark">${event.team_names}</strong> | ${event.mod_names}
                                    </div>

                                    <div class="text-secondary fs-12 fst-italic">${event.reasons}</div>
                                    </div>
                                </div>
                                </a>
                            </li>
                            `;

                            eventList.append(eventHTML);
                        });
                    }
                },
            });
        }
        loadUpcomingEvents();



        function loadTrainings() {
            $('#upcoming-training-list').html('<div class="text-center text-primary "><iconify-icon icon="svg-spinners:bars-rotate-fade" width="30" height="30"></iconify-icon></div>');
            $.ajax({
                url: '<?= base_url("get_upcoming_trainings") ?>',
                type: 'GET',
                dataType: 'json',
                success: function (events) {
                    var eventList = $('#upcoming-training-list');
                    eventList.empty();
                    if (events.length === 0) {
                        eventList.append(`<li class="list-group-item text-primary text-center"><iconify-icon icon="gis:search-layer" width="50" height="50"></iconify-icon><h6 class="mt-1">No training scheduled... </h6></li>
                        `);
                    } else {
                        events.forEach(function (event) {
                            const eventHTML = `
                                <div class="card mb-3 training-card shadow-sm border-0"
                                    style="cursor: pointer;"
                                    data-date='${event.date_training}'
                                    data-location='${event.training_loc}'
                                    data-time='${event.time}'
                                    data-teams='${event.team_names}'
                                    data-modules='${event.mod_names}'
                                    data-reasons='${event.reasons}'
                                    data-assigned='${event.assigned_names || "N/A"}'
                                    data-supervised='${event.assigned_sup || "N/A"}'>

                                    <div class="card-body pb-2">
                                    <!-- Header Row: Date & Location -->
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div class="d-flex align-items-center">
                                        <i class="mdi mdi-calendar-outline text-warning me-2 fs-5"></i>
                                        <span class='fw-bold fs-11'>
                                            ${formatTrainingDate(event.date_training)}
                                            |
                                            <strong class='text-danger fw-bold text-uppercase'>${event.training_loc}</strong>
                                        </span>
                                        </span>
                                        </div>
                                        <span class="badge bg-danger text-light fw-normal fs-10">${event.time || 'TBD'}</span>
                                    </div>

                                    <!-- Teams and Modules -->
                                    <div class="mb-1">
                                        <p class="mb-1 fw-bold fs-13">
                                        <i class="mdi mdi-account-group-outline text-info me-1"></i>
                                        ${event.team_names} | <span class="text-muted">${event.mod_names}</spa>
                                        </p>
                                    </div>

                                    <!-- Reason -->
                                    <div class="mb-2">
                                        <i class="mdi mdi-comment-outline text-secondary me-1"></i>
                                        <span class="text-muted fs-12">${event.reasons}</span>
                                    </div>

                                    <hr class="my-2" />

                                    <!-- Assignment Info -->
                                    <div class="fs-12">
                                        <p class="mb-1">
                                        <strong><i class="mdi mdi-account-outline me-1 text-primary"></i>Assigned to:</strong>
                                        <span class="text-muted">${event.assigned_names || 'N/A'}</span>
                                        </p>
                                        <p class="mb-0">
                                        <strong><i class="mdi mdi-account-tie-outline me-1 text-success"></i>Supervised by:</strong>
                                        <span class="text-muted">${event.assigned_sup || 'N/A'}</span>
                                        </p>
                                    </div>
                                    </div>
                                </div>
                            `;
                            eventList.append(eventHTML);
                        });
                    }
                },
            });
        }
        loadTrainings();
    });

</script>
<script src="<?php echo base_url(); ?>assets/js/apexcharts.js"></script>
<script>
    let chart;
    function renderChart(chartData, labels, colors) {
        const options = {
            chart: {
                type: 'bar',
                height: 350, // ✅ Fixed height
                toolbar: { show: false }
            },
            series: [{
                name: 'Value',
                data: chartData
            }],
            xaxis: {
                categories: labels,
                labels: {
                    rotate: -45,      // ✅ Rotate labels to fit
                    trim: false,      // ✅ Prevent hiding
                    style: {
                        fontSize: '7px',
                    }
                }
            },
            plotOptions: {
                bar: {
                    distributed: true,
                    horizontal: false,
                    columnWidth: '90%',
                    dataLabels: {
                        position: 'top'
                    }
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                    return val;
                },
                offsetY: -20,
                style: {
                    fontSize: '10px',
                    colors: ['#304758']
                }
            },
            tooltip: {
                y: {
                    formatter: val => val
                }
            },
            colors: colors,
            legend: {
                show: false
            },
            grid: {
                padding: {
                    bottom: 20
                }
            }
        };

        if (chart) {
            chart.destroy();
        }

        chart = new ApexCharts(document.querySelector("#system_monitoring"), options);
        chart.render();
    }

    function fetchChartData(type, typeofsystem) {
        $.ajax({
            url: '<?php echo base_url("Dashboard/getChartData"); ?>',
            type: 'POST',
            data: { type: type, typeofsystem: typeofsystem },
            dataType: 'json',
            success: function (response) {
                renderChart(response.chartData, response.labels, response.colors);
            },
            error: function () {
                console.error("Chart data fetch failed.");
            }
        });
    }

    $(document).ready(function () {
        fetchChartData('current', 'current');
        $('.nav-link').click(function () {
            $('.nav-link').removeClass('active');
            $(this).addClass('active');
            const type = $(this).data('type');
            fetchChartData(type, type);
        });
    });
</script>
<script>

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
    $(document).on('click', '.meeting-card', function () {
        const date = $(this).data('date');
        const time = $(this).data('time');
        const title = $(this).data('title');
        const teams = $(this).data('teams');
        const modules = $(this).data('modules');
        const reasons = $(this).data('reasons');
        const location = $(this).data('location');

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
            <div class="row mb-3">
                <div class="col-md-12">
                <p class="mb-1"><i class="mdi mdi-map-marker-outline text-primary me-2"></i><strong>Location:</strong></p>
                <p class="text-muted ms-4">${location}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                <p class="mb-1"><i class="mdi mdi-comment-text-outline text-primary me-2"></i><strong>Purpose / Remarks:</strong></p>
                <div class="alert alert-secondary border-start border-2 border-primary fst-italic ms-2">
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
<style>
    .highlighted-day {
        background-color: rgb(244, 244, 244);
        color: rgb(255, 0, 0);
        border-radius: 50%;
        font-weight: bold;
        font-style: italic;
        font-size: 1rem;
    }

    .upcoming-scheduled .flatpickr-calendar .flatpickr-day.selected {
        background-color: transparent !important;
        border-color: transparent !important;
    }

    .training-card:hover,
    .meeting-card:hover {
        background-color: rgb(75 56 179);
        transition: background-color 0.3s ease;
        color: #fff !important;
    }

    .training-card:hover .text-muted,
    .meeting-card:hover .text-muted {
        color: #fff !important;
    }
</style>