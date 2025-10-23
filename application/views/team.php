<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Team Member</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Team </a></li>
                        <li class="breadcrumb-item active">Index<i class="mdi mdi-alpha-x-circle:"></i></li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="team-list grid-view-filter row" id="team-member-list">
                
            </div>
        </div>
    </div>
</div>

<script>
    $.ajax({
    url: "<?= base_url('team_member') ?>",
    method: "GET",
    dataType: "json",
    success: function(res) {
        let html = '';
        let base_team_icon = "<?= base_url('assets/images/teamicon/'); ?>"; // PHP executes once here

        $.each(res.team_members, function(i, member) {
            html += `
            <div class="col">
                <div class="card team-box" data-aos="zoom-in">
                    <div class="team-cover">
                        <img src="${base_team_icon}${member.team_id}.png" alt="" class="img-fluid">
                    </div>
                    <div class="card-body p-4">
                        <div class="row align-items-center team-row">
                            <div class="col-lg-4 col">
                                <div class="team-profile-img">
                                    <img src="${member.photo}" alt="" class="img-thumbnail rounded-circle avatar-lg material-shadow">
                                    <div class="team-content">
                                        <a class="member-name">
                                            <h5 class="fs-16 mb-1">${member.firstname} ${member.lastname}</h5>
                                        </a>
                                        <span class="badge text-success fs-11">${member.position}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col">
                                <div class="row text-muted text-center">
                                    <div class="col-6 border-end border-end-dashed">
                                        <h5 class="mb-1">${member.workload_count}</h5>
                                        <p class="text-muted mb-0 fs-11">Workload</p>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="mb-1">${member.weekly_report_count}</h5>
                                        <p class="text-muted mb-0 fs-11">Weekly Report</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col"></div>
                        </div>
                    </div>
                </div>
            </div>`;
        });

        $("#team-member-list").html(html);
    }

});

</script>