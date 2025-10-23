<div class="container kpi-section">
    <h2 class="fw-bold text-center"></h2>
    <div class="card">
        <div class="bg-warning-subtle position-relative">
            <div class="card-body p-5">
                <div class="text-center">
                    <h3 class="fw-semibold">Key Performance Indicator ( KPI ) </h3>
                    <!-- <p class="mb-0 text-muted">Last update: 16 Sept, 2022 </p> -->
                </div>
            </div>
            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                    xmlns:svgjs="http://svgjs.com/svgjs" width="1440" height="60" preserveaspectratio="none"
                    viewbox="0 0 1440 60">
                    <g mask="url(&quot;#SvgjsMask1001&quot;)" fill="none">
                        <path d="M 0,4 C 144,13 432,48 720,49 C 1008,50 1296,17 1440,9L1440 60L0 60z"
                            style="fill: var(--vz-secondary-bg);"></path>
                    </g>
                    <defs>
                        <mask id="SvgjsMask1001">
                            <rect width="1440" height="60" fill="#ffffff"></rect>
                        </mask>
                    </defs>
                </svg>
            </div>
        </div>
        <div class="card-body">
            <div class="row justify-content-center mt-5">
                <?php foreach ($kpiData as $type => $kpis): ?>
                    <div class="col-md-4 d-flex flex-column align-items-center kpi-item">
                        <?php
                        if ($type == 'RMS') {
                            $type = 'Record Management System';
                        }
                        ?>
                        <div class="kpi-icon <?php echo $type == 'System Analyst' ? 'bg-primary' : ($type == 'Programmer' ? 'bg-success' : 'bg-warning'); ?>" data-aos="zoom-in-down" data-aos-duration="1000">
                            <iconify-icon
                                icon="<?php echo $type == 'System Analyst' ? 'solar:laptop-minimalistic-bold-duotone' : ($type == 'Programmer' ? 'solar:code-circle-bold-duotone' : 'solar:siderbar-bold-duotone'); ?>"></iconify-icon>
                        </div>
                        <h4 class="kpi-header mt-1 mb-3 fs-15" data-aos="zoom-in" data-aos-duration="1000"><?php echo $type; ?>'s KPI</h4>

                        <?php foreach ($kpis as $kpi): ?>
                            <div class="kpi-description " data-aos="zoom-in-up" data-aos-duration="1000">
                                <p class="fw-bold "><i class="ri-checkbox-circle-fill text-success"></i>
                                    <?php echo $kpi->title; ?></p>
                                <p><?php echo $kpi->description; ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</div>