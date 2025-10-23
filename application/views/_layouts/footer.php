    </div>
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <span id="year"></span> © System Management v1.2.0
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Design by IT - Sysdev't
                    </div>
                </div>
            </div>
        </div>
    </footer>
    </div>
</div>
<!--preloader-->
<div id="preloader">
    <div id="status">
        <img src="<?php echo base_url(); ?>assets/images/Hourglass.gif" alt="Loading..." class="avatar-sm"
            lazy="loading" style="height: 70px; width: 70px">
    </div>
</div>

<!--start back-to-top-->
<button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
    <i class="ri-arrow-up-line"></i>
</button>

<div class="customizer-setting d-none d-md-block">
    <div class="btn-info rounded-pill shadow-lg btn btn-icon btn-lg p-2" data-bs-toggle="offcanvas"
        data-bs-target="#theme-settings">
        <i class='mdi mdi-spin mdi-cog-outline fs-22'></i>
    </div>
</div>

<!-- left offcanvas -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasLeft" aria-labelledby="offcanvasLeftLabel">
    <div class="d-flex align-items-center bg-primary p-3 offcanvas-header">
        <h5 class="m-0 me-2 text-white">Birthday Celebrants</h5>
        <button type="button" class="btn-close btn-close-white ms-auto" id="customizerclose-btn"
            data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="card card-animate">
            <div class="card-header border-0">
                <h6 class="card-title mb-0 fw-bold fs-26" style="font-family: 'BirthdayFont';"><iconify-icon
                        icon="noto:confetti-ball"></iconify-icon> Birthdays <iconify-icon
                        icon="noto:confetti-ball"></iconify-icon></h6>
            </div>
            <div class="card-body pt-0">
                <div class="upcoming-scheduled">
                    <input type="date" id="birthday-calendar" class="form-control" data-time-inline="true" />
                </div>
                <hr>
                <!-- <div class="card mt-3"> -->
                <!-- <div class="card-header"> -->
                <h3 class="card-title capitalized fw-bold fs-22" style="font-family: 'BirthdayFont';"><iconify-icon
                        icon="twemoji:birthday-cake"></iconify-icon> This Month`s Birthday List <iconify-icon
                        icon="noto:confetti-ball"></iconify-icon>: </h3>
                <!-- </div> -->
                <!-- <div class="card-body" data-simplebar style="max-height: 350px;"> -->
                <div id="birthday-list"></div>
                <!-- </div> -->
                <!-- </div> -->
            </div>
        </div>
    </div>
</div>

<!-- Theme Settings -->
<div class="offcanvas offcanvas-end border-0" tabindex="-1" id="theme-settings">
    <div class="d-flex align-items-center bg-primary p-3 offcanvas-header">
        <h5 class="m-0 me-2 text-white">Customize your theme here</h5>
        <button type="button" class="btn-close btn-close-white ms-auto" id="customizerclose-btn"
            data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <div data-simplebar="" class="h-100">
            <div class="p-4">
                <h6 class="mb-0 fw-semibold text-uppercase fs-12">Layout </h6>
                <p class="text-muted">Choose your layout </p>
                <div class="row gy-3">
                    <div class="col-4">
                        <div class="form-check card-radio">
                            <input id="customizer-layout01" name="data-layout" type="radio" value="vertical"
                                class="form-check-input" />
                            <label class="form-check-label p-0 avatar-md w-100 shadow-sm" for="customizer-layout01">
                                <span class="d-flex gap-1 h-100">
                                    <span class="flex-shrink-0">
                                        <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                            <span class="d-block p-1 px-2 bg-primary-subtle rounded mb-2"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                        </span>
                                    </span>
                                    <span class="flex-grow-1">
                                        <span class="d-flex h-100 flex-column">
                                            <span class="bg-light d-block p-1"></span>
                                            <span class="bg-light d-block p-1 mt-auto"></span>
                                        </span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <h5 class="fs-13 text-center mt-2">Vertical </h5>
                    </div>
                    <div class="col-4">
                        <div class="form-check card-radio">
                            <input id="customizer-layout02" name="data-layout" type="radio" value="horizontal"
                                class="form-check-input" />
                            <label class="form-check-label p-0 avatar-md w-100 shadow-sm" for="customizer-layout02">
                                <span class="d-flex h-100 flex-column gap-1">
                                    <span class="bg-light d-flex p-1 gap-1 align-items-center">
                                        <span class="d-block p-1 bg-primary-subtle rounded me-1"></span>
                                        <span class="d-block p-1 pb-0 px-2 bg-primary-subtle ms-auto"></span>
                                        <span class="d-block p-1 pb-0 px-2 bg-primary-subtle"></span>
                                    </span>
                                    <span class="bg-light d-block p-1"></span>
                                    <span class="bg-light d-block p-1 mt-auto"></span>
                                </span>
                            </label>
                        </div>
                        <h5 class="fs-13 text-center mt-2">Horizontal </h5>
                    </div>

                    <div class="col-4">
                        <div class="form-check card-radio">
                            <input id="customizer-layout04" name="data-layout" type="radio" value="semibox"
                                class="form-check-input" />
                            <label class="form-check-label p-0 avatar-md w-100 shadow-sm" for="customizer-layout04">
                                <span class="d-flex gap-1 h-100">
                                    <span class="flex-shrink-0 p-1">
                                        <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                            <span class="d-block p-1 px-2 bg-primary-subtle rounded mb-2"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                        </span>
                                    </span>
                                    <span class="flex-grow-1">
                                        <span class="d-flex h-100 flex-column pt-1 pe-2">
                                            <span class="bg-light d-block p-1"></span>
                                            <span class="bg-light d-block p-1 mt-auto"></span>
                                        </span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <h5 class="fs-13 text-center mt-2">Semi Box </h5>
                    </div>
                    <!-- end col -->
                </div>
                <hr>
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header border-1">
                            <div class="d-flex align-items-center">
                                <h5 class="card-title mb-0 flex-grow-1 fw-bold text-uppercase text-center">Company Phone
                                    | Contact List</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="mt-2 tab-pane active" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover table-bordered compact"
                                            id="company_phone">
                                            <thead class="table-info text-center text-uppercase">
                                                <tr>
                                                    <th>DESCRIPTION</th>
                                                    <th>CONTACT NO.</th>
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

    </div>
    <div class="offcanvas-footer border-top p-3 text-center">
        <div class="row">
            <div class="col-12">
                <button type="button" class="btn btn-primary w-100" id="reset-layout">Reset All Changes</button>
            </div>
        </div>
    </div>
</div>


<!--end back-to-top-->
<!-- JAVASCRIPT -->
<script src="<?php echo base_url(); ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/simplebar/simplebar.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/node-waves/waves.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/feather.min.js"></script>

<!-- App js -->
<script src="<?php echo base_url(); ?>assets/js/app.js"></script>
<script src="<?php echo base_url(); ?>assets/js/select2.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/sweetalert2/sweetalert2.min.js"></script>
<!-- dropzone min -->
<script src="<?php echo base_url(); ?>assets/js/dropzone.js"></script>
<!-- filepond js -->
<script src="<?php echo base_url(); ?>assets/js/filepond.js"></script>
<script src="<?php echo base_url(); ?>assets/js/filepond-plugin-image-preview.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/filepond-plugin-file-validate-size.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/filepond-plugin-image-exif-orientation.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/filepond-plugin-file-encode.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/iconify.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/aos/aos.js"></script>

<script>
    AOS.init({ easing: "ease-out-back", duration: 1e3 });
</script>
<!-- <script src="<?php echo base_url(); ?>assets/libs/particles.js/particles.js"></script>
    <script src="<?php echo base_url(); ?>assets/libs/particles.js/particles.app.js"></script> -->
<script>
    document.getElementById("year").textContent = new Date().getFullYear();
</script>
<script>
    Array.from(document.querySelectorAll("form .auth-pass-inputgroup")).forEach(
        function (e) {
            Array.from(e.querySelectorAll(".password-addon")).forEach(function (r) {
                r.addEventListener("click", function (r) {
                    var o = e.querySelector(".password-input");
                    "password" === o.type ? (o.type = "text") : (o.type = "password");
                });
            });
        }
    );
</script>
<script>
    var previewTemplate,
        dropzone,
        dropzonePreviewNode = document.querySelector("#dropzone-preview-list");

    if (dropzonePreviewNode) {
        previewTemplate = dropzonePreviewNode.parentNode.innerHTML;
        dropzonePreviewNode.parentNode.removeChild(dropzonePreviewNode);
        dropzone = new Dropzone(".dropzone", {
            url: "https://httpbin.org/post",
            method: "post",
            previewTemplate: previewTemplate,
            previewsContainer: "#dropzone-preview",
        });
    }


    // FilePond initialization
    FilePond.registerPlugin(
        FilePondPluginFileEncode,
        FilePondPluginFileValidateSize,
        FilePondPluginImageExifOrientation,
        FilePondPluginImagePreview
    );

    // Initialize FilePond on file input elements
    document.querySelectorAll("input.filepond-input-multiple").forEach(function (inputElement) {
        FilePond.create(inputElement);
    });
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize FilePond with custom options for a specific input
        FilePond.create(document.querySelector(".filepond-input-circle"), {
            labelIdle: 'Drag & Drop your picture or <span class="filepond--label-action">Browse</span>',
            imagePreviewHeight: 50,
            imageCropAspectRatio: "1:1",
            imageResizeTargetWidth: 100,
            imageResizeTargetHeight: 100,
            stylePanelLayout: "compact circle",
            styleLoadIndicatorPosition: "center bottom",
            styleProgressIndicatorPosition: "right bottom",
            styleButtonRemoveItemPosition: "left bottom",
            styleButtonProcessItemPosition: "right bottom",
        });
    });

</script>

<!-- <script type="text/javascript">
    function swal_message1(msg_type, msg) {
        toastr.options = {
            progressBar: true,
            positionClass: "toast-top-left",
            timeOut: 5000,
            extendedTimeOut: 2000,
            preventDuplicates: true,
        };

        toastr.success(
            `${msg}`,
        );
    }

    <?php
    if ($this->session->flashdata('SUCCESSMSG')) {
        date_default_timezone_set('Asia/Manila');
        $hour = date("H");
        $name = ucwords(strtolower($this->session->userdata('name')));

        if ($hour >= 5 && $hour < 12) {
            $greeting = 'Good Morning, ';
        } elseif ($hour >= 12 && $hour < 17) {
            $greeting = 'Good Afternoon, ';
        } else {
            $greeting = 'Good Evening, ';
        }

        $greeting = addslashes($greeting);
        $name = addslashes($name);

        echo "swal_message1('success', '{$greeting} {$name}');";
    }
    ?>
</script> -->

<script>
    $(document).ready(function () {
        $('#page-header-notifications-dropdown').on('click', function () {
            $.ajax({
                url: '<?php echo base_url('fetch_notifications'); ?>',
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    let notificationsHtml = '';

                    if (data.length > 0) {
                        data.forEach(notification => {
                            // Format the date_uploaded into a human-readable format
                            const dateUploaded = new Date(notification.date_uploaded);
                            const formattedDate = dateUploaded.toLocaleString('en-US', {
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric',
                                hour: 'numeric',
                                minute: '2-digit',
                                hour12: true
                            });

                            const requestUrl = '<?= base_url("request"); ?>'
                                + '?team=' + encodeURIComponent(notification.team_name)
                                + '&mod=' + encodeURIComponent(notification.mod_name)
                                + '&uploaded=' + encodeURIComponent(notification.uploaded_to);

                            notificationsHtml +=
                                `
                                <div class="text-reset notification-item d-block dropdown-item position-relative">
                                    <div class="d-flex">
                                        <div class="avatar-xs me-3 flex-shrink-0">
                                            <span class="avatar-title bg-info-subtle text-info rounded-circle fs-16">
                                                <i class="bx bx-badge-check"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1">
                                            <a href="${requestUrl}" class="stretched-link">
                                                <h6 class="mt-0 mb-2 lh-base">Team <b>${notification.team_name} </b> added a new request  
                                                    <span class="text-secondary">for </span> Approval! 
                                                    <span><b>( ${notification.uploaded_to} | ${notification.mod_name} | ${notification.typeofsystem} )</b></span>
                                                </h6>
                                            </a>
                                            <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                <span><i class="mdi mdi-clock-outline"></i> ${formattedDate} </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>`;
                        });
                    } else {
                        notificationsHtml = '<p class="text-center text-muted py-2">No new notifications</p>';
                    }
                    $('#all-noti-tab .pe-2').html(notificationsHtml);
                },
            });
        });
    });

    let rcount = 0;
    let mcount = 0;

    function updateNotificationCount() {
        $.ajax({
            url: '<?php echo base_url('get_notification_count') ?>',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                rcount = response.count || 0; // Store rcount value
                updateAllCount(); // Update total count

                if (response.count === 1) {
                    if (<?php echo $this->session->userdata('is_admin') === 'Yes' ? 'true' : 'false'; ?> && response.count >= 1) {
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 2000,
                            extendedTimeOut: 1000,
                        };
                        toastr.warning(`⚠️ New request pending approval. Please review it promptly.`);
                    }
                }

                if (response.count > 0) {
                    $('.rcount').text(response.count).show();
                } else {
                    $('.rcount').text('0').hide();
                }
            },
        });
    }

    function updateModuleCount() {
        $.ajax({
            url: '<?php echo base_url('get_module_count') ?>',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                mcount = response.count || 0; // Store mcount value
                ncount = response.count2 || 0; // Store ncount value
                updateAllCount(); // Update total count

                if (response.count === 1) {
                    if (<?php echo $this->session->userdata('is_admin') === 'Yes' ? 'true' : 'false'; ?> && response.count >= 1) {
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 2000,
                            extendedTimeOut: 1000,
                        };
                        toastr.warning(`⚠️ New module pending approval. Please review it promptly.`);
                    }
                }

                if (response.count > 0 || response.count2 > 0) {
                    $('.mcount').text(response.count).show();
                    $('.ncount').text(response.count2).show();
                } else {
                    $('.mcount').text('0').hide();
                    $('.ncount').text('0').hide();
                }
            },
        });
    }


    function updateAllCount() {
        const totalCount = rcount + mcount;
        if (totalCount > 0) {
            $('.allcount').text(totalCount).show();
            $('.new_alert').show();
        } else {
            $('.allcount').text('0').hide();
            $('.new_alert').hide();
        }
    }


    function updateAllCountWorkload() {
        const totalCount = workloadcount + weeklycount;
        if (totalCount > 0) {
            $('.all_workload_count').text(totalCount).show();
        } else {
            $('.all_workload_count').text('0').hide();
        }
    }

    updateNotificationCount();
    updateModuleCount();

    workloadCount();
    weeklyCount();

    let workloadcount = 0;
    let weeklycount = 0;

    function workloadCount() {
        $.ajax({
            url: '<?php echo base_url('get_workload_count') ?>',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                workloadcount = response.count || 0;
                updateAllCountWorkload();
                if (response.count >= 1) {
                    if (<?php echo $this->session->userdata('position') === 'Programmer' ? 'true' : 'false'; ?> && response.count >= 1) {
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 3000,
                            extendedTimeOut: 1000,
                        };
                        toastr.info(`⚠️ New project is added in your workload today.`);
                    }
                }

                if (response.count > 0) {
                    $('.workloadcount').text(response.count).show();
                } else {
                    $('.workloadcount').text('0').hide();
                }
            },
        });
    }

    function weeklyCount() {
        $.ajax({
            url: '<?php echo base_url('get_weekly_count') ?>',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                weeklycount = response.count || 0;
                updateAllCountWorkload(); // Update total count
                if (response.count >= 1) {
                    if (<?php echo $this->session->userdata('position') === 'Programmer' ? 'true' : 'false'; ?> && response.count >= 1) {
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 3000,
                            extendedTimeOut: 1000,
                        };
                        toastr.info(`New project is added in your weekly report today.`);
                    }
                }

                if (response.count > 0) {
                    $('.weeklycount').text(response.count).show();
                } else {
                    $('.weeklycount').text('0').hide();
                }
            },
        });
    }
</script>
<script>
    $(document).on('click', '.notification-link', function (e) {
        e.preventDefault(); // stop default navigation

        let team = $(this).data('team');
        let mod = $(this).data('mod');
        let uploaded = $(this).data('uploaded');

        // Redirect with query params
        let baseUrl = $(this).attr('href'); // "<?= base_url('request') ?>"
        window.location.href = baseUrl
            + '?team=' + encodeURIComponent(team)
            + '&mod=' + encodeURIComponent(mod)
            + '&uploaded=' + encodeURIComponent(uploaded);
    });
</script>
<script>
    function message_unseen() {
        $.ajax({
            url: '<?php echo base_url('Chat/message_unseen') ?>',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.total > 0) {
                    $('#total-unseen-count').text(response.total).show();
                } else {
                    $('#total-unseen-count').text('0').hide();
                }
            },
        });
    }
    message_unseen();
</script>
<script>
    let lastUnseenTotal = 0;
    let titleMarqueeInterval = null;
    let marqueeIndex = 0;

    function updateUnseenCount() {
        let total = 0;

        allUsers.forEach(user => {
            if (user.unseen_count && user.unseen_count > 0) {
                total += user.unseen_count;

                let badge = $(`#contact-id-${user.emp_id} .unseen-badge`);
                if (badge.length) {
                    badge.text(user.unseen_count);
                } else {
                    $(`#contact-id-${user.emp_id} .text-end`).append(`
                        <span class="unseen-badge badge bg-danger rounded-pill ms-2" style="font-size: 10px;">
                            ${user.unseen_count}
                        </span>
                    `);
                }

                if ($("#receiver_id").val() != user.emp_id) {
                    $(`#contact-id-${user.emp_id} .last-message`)
                        .addClass('fw-bold').removeClass('text-muted');
                } else {
                    $(`#contact-id-${user.emp_id} .last-message`)
                        .removeClass('fw-bold').addClass('text-muted');
                }
            } else {
                $(`#contact-id-${user.emp_id} .unseen-badge`).remove();
                $(`#contact-id-${user.emp_id} .last-message`)
                    .removeClass('fw-bold').addClass('text-muted');
            }
        });

        if ($('#total-unseen-count').length) {
            if (total > 0) {
                $('#total-unseen-count').text(total).show();

                if (total !== lastUnseenTotal) {
                    toastr.options = {
                        closeButton: true,
                        progressBar: true,
                        positionClass: "toast-bottom-left",
                        timeOut: 0,
                        extendedTimeOut: 0,
                        tapToDismiss: false,
                        onShown: function (toast) {
                            $(toast).hover(
                                function () { $(this).stop(true, true); },
                                function () {}
                            );
                        }
                    };

                    toastr.info(
                        `📩 You have <strong>${total}</strong> new message${total > 1 ? 's' : ''}.`,
                        "New Message Notification"
                    );
                }
            } else {
                $('#total-unseen-count').hide();
                toastr.clear();
            }
        }

        // 💬 Handle page title marquee
        if (!document.originalTitle || document.originalTitle === "undefined" || document.originalTitle === "") {
            document.originalTitle = document.title || "Message Center";
        }

        if (total > 0) {
            startTitleMarquee(total);
        } else {
            stopTitleMarquee();
            document.title = document.originalTitle;
        }

        lastUnseenTotal = total;
    }

    function startTitleMarquee(total) {
        stopTitleMarquee(); // clear any previous intervals first

        let baseMessage = `🔔 You have ${total} new message${total > 1 ? 's' : ''}! `;
        let marqueeText = ` ${baseMessage} `.repeat(3); // repeated for continuous scroll

        marqueeIndex = 0;
        titleMarqueeInterval = setInterval(() => {
            document.title = marqueeText.substring(marqueeIndex) + marqueeText.substring(0, marqueeIndex);
            marqueeIndex = (marqueeIndex + 1) % marqueeText.length;
        }, 200); // adjust speed (lower = faster)
    }

    function stopTitleMarquee() {
        clearInterval(titleMarqueeInterval);
        titleMarqueeInterval = null;
    }

</script>

<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.2/dist/confetti.browser.min.js"></script>
<script>
    $(document).ready(function () {
        function capitalizeName(name) {
            return name
                ? name
                    .split(' ')
                    .map(word => word.charAt(0).toUpperCase() + word.slice(1).toLowerCase())
                    .join(' ')
                : '';
        }

        function updateMarquee(todayBirthdays) {
            const marqueeContainer = $('#birthday-marquee');

            if (todayBirthdays.length > 0) {
                const marqueeContent = `
                <iconify-icon icon="noto:confetti-ball"></iconify-icon>
                Happy birthday to ${todayBirthdays.join(', ')}!
                <iconify-icon icon="emojione-v1:birthday-cake"></iconify-icon>
            `;

                marqueeContainer.html(`
                <marquee behavior="scroll" direction="left" scrollamount="10">
                    ${marqueeContent}
                </marquee>
            `);
            } else {
                marqueeContainer.empty();
            }
        }
        function launchConfetti() {
            const duration = 5 * 1000;
            const animationEnd = Date.now() + duration;
            const defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 9999 };
            function randomInRange(min, max) {
                return Math.random() * (max - min) + min;
            }
            const interval = setInterval(function () {
                const timeLeft = animationEnd - Date.now();

                if (timeLeft <= 0) {
                    return clearInterval(interval);
                }
                const particleCount = 50 * (timeLeft / duration);
                confetti(Object.assign({}, defaults, {
                    particleCount,
                    origin: { x: randomInRange(0.1, 0.3), y: Math.random() - 0.2 }
                }));
                confetti(Object.assign({}, defaults, {
                    particleCount,
                    origin: { x: randomInRange(0.7, 0.9), y: Math.random() - 0.2 }
                }));
            }, 250);
        }

        function showBirthdayAlert(user) {
            const basePhotoUrl = "http://172.16.161.34:8080/hrms/";
            function jsLtrim(str) {
                return str ? str.replace(/^(\.*[\\/]+)/, '') : '';
            }

            const avatar_photo = jsLtrim(user.photo || '');

            const imageUrl =
                avatar_photo && avatar_photo.trim() !== ""
                    ? basePhotoUrl + avatar_photo
                    : "https://cdn-icons-png.flaticon.com/512/2922/2922506.png";

            Swal.fire({
                title: `🎂 Happy Birthday, ${capitalizeName(user.firstname)}!`,
                html: `
                <div style="display:flex;align-items:center;text-align:left;">
                    <img src="${imageUrl}" alt="Image"
                        style="width:100px;height:100px;border-radius:50%;
                            margin-right:20px;object-fit:cover;
                            border:3px solid #ffb6c1;">
                    <div>
                        <p style="font-size:16px;margin-bottom:5px;">
                            Wishing you a wonderful year ahead full of growth, success, and happiness.
                        </p>
                        <p style="font-weight:bold;color:#ff4081;">Enjoy your special day! 🎉</p>
                    </div>
                </div>
            `,
                confirmButtonText: 'Thank You ❤️',
                confirmButtonColor: '#ff4081',
                background: '#fffdf9',
                width: '500px',
                didOpen: () => {
                    launchConfetti();
                }
            });
        }


        function fetchAndUpdateMarquee() {
            $.ajax({
                url: "<?php echo base_url('get_birthdays'); ?>",
                type: "GET",
                data: {
                    month: new Date().getMonth() + 1,
                    year: new Date().getFullYear(),
                },
                dataType: "json",
                success: function (response) {
                    if (response.status === 'success' && response.data.length > 0) {
                        const today = new Date();
                        const sessionUserId = "<?php echo $this->session->userdata('emp_id'); ?>";
                        const todayBirthdays = response.data.filter(birthday => {
                            const birthDate = new Date(birthday.birthdate);
                            return (
                                birthDate.getDate() === today.getDate() &&
                                birthDate.getMonth() === today.getMonth()
                            );
                        });
                        const namesList = todayBirthdays.map(person => {
                            return `${capitalizeName(person.firstname)} ${capitalizeName(person.lastname)} ${person.suffix || ''}`.trim();
                        });
                        updateMarquee(namesList);
                        const myBirthday = todayBirthdays.find(b => b.emp_id == sessionUserId);
                        if (myBirthday) {
                            showBirthdayAlert(myBirthday);
                        }
                    } else {
                        $('#birthday-marquee').empty();
                    }
                }
            });
        }
        fetchAndUpdateMarquee();
    });
</script>


<script>
    function load_company() {
        $('#company_phone').DataTable({
            "processing": true,
            "serverSide": true,
            "destroy": true,
            "lengthMenu": [[25, 50, 100, 10000], [25, 50, 100, "Max"]],
            "pageLength": 25,
            "ajax": {
                "url": '<?php echo base_url('list_company_phone_dashboard'); ?>',
                "type": 'POST',
            },
            "columns": [
                { "data": 'team' },
                { "data": 'ip_phone' }
            ],
            "columnDefs": [
                { "className": "text-center", "targets": ['_all'] }
            ],
        });
    }
    load_company();

</script>
<script>

    function warnUnencryptedChats() {
        window.location.href = "<?php echo base_url('chat'); ?>";
    }

</script>
<!-- <script>
function warnUnencryptedChats() {
    Swal.fire({
        title: "⚠️ Security Notice",
        html: `
            <p style="text-align:left">
                Please be aware that <b>your chat messages are not end-to-end encrypted</b>. 
                This means your conversations could potentially be <b>monitored, stored, or accessed</b> 
                by system administrators or unauthorized third parties.
            </p>
            <p style="text-align:left; margin-top:10px;">
                <b>Recommendation:</b> Do not share sensitive, confidential, or personal information 
                such as passwords, financial data, or private documents.
            </p>
            <p style="text-align:left; margin-top:10px; color:#0d6efd;">
                📌 For system-related concerns or technical issues, please reach out to your 
                <b>IT Department / System Administrator</b>.
            </p>
            <p style="text-align:left; margin-top:15px; font-style:italic; color:#d9534f;">
                🤫 Wag masyadong tsismoso... baka may nakikinig.........Share your code / idea nalang HAHAHAAH!
            </p>
        `,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "I Understand, Proceed to Chat...",
        cancelButtonText: "Cancel",
        reverseButtons: false,
        focusCancel: true,
        width: "600px"
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirect if they confirm
            window.location.href = "<?php echo base_url('chat'); ?>";
            // Swal.fire({
            //     title: "😂 It's a Prank!",
            //     html: `
            //         <p style="text-align:center; font-size:16px;">
            //             🚧 The chat module is still <b>under construction</b>.<br>
            //             We're currently fixing bugs and polishing features.<br><br>
            //         </p>
            //     `,
            //     icon: "info",
            //     confirmButtonText: "Alright, balik ka muna!",
            //     width: "500px"
            // });
        }
    });
}



</script> -->
<style>
    .header-marquee {
        /* background-color: #f7f7f7; */
        /* color: #333 !important; */
        color: #f7f7f7 !important;
        /* font-weight: bold; */
        color: black;
        width: 800px;



    }

    marquee {
        display: block;
        font-size: 30px;
        font-family: 'BirthdayFont', the-richland;

    }

    @font-face {
        font-family: 'BirthdayFont';
        src: url('<?php echo base_url("assets/fonts/chicken.otf"); ?>') format('opentype');
        font-weight: normal;
        font-style: normal;
    }



    .select2-container--default.is-invalid .select2-selection--single {
        border: 1px solid #dc3545 !important;
        border-radius: 0.25rem;
        padding-right: 2.25rem;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%23dc3545' viewBox='0 0 12 12'%3e%3ccircle cx='6' cy='6' r='6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        background-size: 0.75rem 0.75rem;
    }

    .select2-container--default.is-invalid .select2-selection--multiple {
        border: 1px solid #dc3545 !important;
        border-radius: 0.25rem;
    }
</style>
<!-- <script>
    document.addEventListener("DOMContentLoaded", function () {
    var tooltipButton = document.getElementById('tooltipButton');
        new bootstrap.Tooltip(tooltipButton);
    });
</script> -->
<?php $this->load->view('menu/chat_modal'); ?>

</body>

</html>