<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Rules | Regulations Signed Per Team</h4>

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
    <div class="row">
        <div class="col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xxl-3">
                            <div class="nav nav-pills flex-column nav-pills-tab custom-verti-nav-pills text-center" role="tablist" aria-orientation="vertical">

                                <?php if ($this->session->userdata('team_name') == 'ALGORITHM ASSASSIN') : ?>
                                    <a href="#ALGORITHM_ASSASSINS" class="fw-bold nav-link active" data-bs-toggle="pill" role="tab">ALGORITHM ASSASSIN</a>
                                <?php endif; ?>
                                <?php if ($this->session->userdata('team_name') == 'CODE CONQUERORS') : ?>
                                    <a href="#CODE_CONQUERORS" class="fw-bold nav-link active" data-bs-toggle="pill" role="tab">CODE CONQUERORS</a>
                                <?php endif; ?>
                                <?php if ($this->session->userdata('team_name') == 'CTRL+ ALT ELITE') : ?>
                                    <a href="#CTRL_ALT_ELITE" class="fw-bold nav-link active" data-bs-toggle="pill" role="tab">CTRL + ALT ELITE</a>
                                <?php endif; ?>
                                <?php if ($this->session->userdata('team_name') == 'CYBER CENTINELS') : ?>
                                    <a href="#CYBER_SINTENELS" class="fw-bold nav-link active" data-bs-toggle="pill" role="tab">CYBER CENTINELS</a>
                                <?php endif; ?>
                                <?php if ($this->session->userdata('team_name') == 'LOGIC LEGENDS') : ?>
                                    <a href="#LOGIC_LEGENDS" class="fw-bold nav-link active" data-bs-toggle="pill" role="tab">LOGIC LEGENDS</a>
                                <?php endif; ?>
                                <?php if ($this->session->userdata('team_name') == 'QUANTUM QUANTS') : ?>
                                    <a href="#QUANTUM_QUANTS" class="fw-bold nav-link active" data-bs-toggle="pill" role="tab">QUANTUM QUANTS</a>
                                <?php endif; ?>
                                <?php if ($this->session->userdata('team_name') == 'SERVER SAMURAI') : ?>
                                    <a href="#SERVER_SAMURAI" class="fw-bold nav-link active" data-bs-toggle="pill" role="tab">SERVER SAMURAI</a>
                                <?php endif; ?>
                                <?php if ($this->session->userdata('team_name') == 'SYNTAX SOLDIERS') : ?>
                                    <a href="#SYNTAX_SOLDIERS" class="fw-bold nav-link active" data-bs-toggle="pill" role="tab">SYNTAX SOLDIERS</a>
                                <?php endif; ?>
                                <?php if ($this->session->userdata('team_name') == 'TECH TACTICIANS') : ?>
                                    <a href="#TECH_TACTICIANS" class="fw-bold nav-link active" data-bs-toggle="pill" role="tab">TECH TACTICIANS</a>
                                <?php endif; ?>

                                <?php if ($this->session->userdata('position') === 'Manager') :?>
                                    <a href="#ALGORITHM_ASSASSINS" class="fw-bold nav-link active" data-bs-toggle="pill" role="tab">ALGORITHM ASSASSIN</a>
                                    <a href="#CODE_CONQUERORS" class="fw-bold nav-link" data-bs-toggle="pill" role="tab">CODE CONQUERORS</a>
                                    <a href="#CTRL_ALT_ELITE" class="fw-bold nav-link" data-bs-toggle="pill" role="tab">CTRL + ALT ELITE</a>
                                    <a href="#CYBER_SINTENELS" class="fw-bold nav-link" data-bs-toggle="pill" role="tab">CYBER CENTINELS</a>
                                    <a href="#LOGIC_LEGENDS" class="fw-bold nav-link" data-bs-toggle="pill" role="tab">LOGIC LEGENDS</a>
                                    <a href="#QUANTUM_QUANTS" class="fw-bold nav-link" data-bs-toggle="pill" role="tab">QUANTUM QUANTS</a>
                                    <a href="#SERVER_SAMURAI" class="fw-bold nav-link" data-bs-toggle="pill" role="tab">SERVER SAMURAI</a>
                                    <a href="#SYNTAX_SOLDIERS" class="fw-bold nav-link" data-bs-toggle="pill" role="tab">SYNTAX SOLDIERS</a>
                                    <a href="#TECH_TACTICIANS" class="fw-bold nav-link" data-bs-toggle="pill" role="tab">TECH TACTICIANS</a>
                                <?php endif; ?>

                            </div>
                        </div>
                        <div class="col-xxl-9">
                            <div class="tab-content mt-3">
                                <?php if ($this->session->userdata('team_name') == 'ALGORITHM ASSASSIN') : ?>
                                <div class="tab-pane fade show active" id="ALGORITHM_ASSASSINS" role="tabpanel">
                                    <div class="d-flex mb-4">
                                        <div class="flex-grow-1 ms-3 ratio ratio-16x9">
                                            <iframe src="<?php echo base_url(); ?>assets/pdf/Algorithm Assasins.pdf" width="100%" height="500"></iframe>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <?php if ($this->session->userdata('team_name') == 'CODE CONQUERORS') : ?>
                                <div class="tab-pane fade show active" id="CODE_CONQUERORS" role="tabpanel">
                                    <div class="d-flex mb-4">
                                        <div class="flex-grow-1 ms-3 ratio ratio-16x9">
                                            <iframe src="<?php echo base_url(); ?>assets/pdf/Code Conquerors.pdf" width="100%" height="500"></iframe>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if ($this->session->userdata('team_name') == 'CTRL+ ALT ELITE') : ?>
                                <div class="tab-pane fade show active" id="CTRL_ALT_ELITE" role="tabpanel">
                                    <div class="d-flex mb-4">
                                        <div class="flex-grow-1 ms-3 ratio ratio-16x9">
                                            <iframe src="<?php echo base_url(); ?>assets/pdf/ctrlaltelite.pdf" width="100%" height="500"></iframe>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <?php if ($this->session->userdata('team_name') == 'CYBER CENTINELS') : ?>
                                <div class="tab-pane fade show active" id="CYBER_SINTENELS" role="tabpanel">
                                    <div class="d-flex mb-4">
                                        <div class="flex-grow-1 ms-3 ratio ratio-16x9">
                                            <iframe src="<?php echo base_url(); ?>assets/pdf/cybersintenels.pdf" width="100%" height="500"></iframe>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <?php if ($this->session->userdata('team_name') == 'LOGIC LEGENDS') : ?>
                                <div class="tab-pane fade show active" id="LOGIC_LEGENDS" role="tabpanel">
                                    <div class="d-flex mb-4">
                                        <div class="flex-grow-1 ms-3 ratio ratio-16x9">
                                            <iframe src="<?php echo base_url(); ?>assets/pdf/Logiclegends.pdf" width="100%" height="500"></iframe>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <?php if ($this->session->userdata('team_name') == 'QUANTUM QUANTS') : ?>
                                <div class="tab-pane fade show active" id="QUANTUM_QUANTS" role="tabpanel">
                                    <div class="d-flex mb-4">
                                        <div class="flex-grow-1 ms-3 ratio ratio-16x9">
                                            <iframe src="<?php echo base_url(); ?>assets/pdf/quantumquants.pdf" width="100%" height="500"></iframe>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <?php if ($this->session->userdata('team_name') == 'SERVER SAMURAI') : ?>
                                <div class="tab-pane fade show active" id="SERVER_SAMURAI" role="tabpanel">
                                    <div class="d-flex mb-4">
                                        <div class="flex-grow-1 ms-3 ratio ratio-16x9">
                                            <iframe src="<?php echo base_url(); ?>assets/pdf/serversamurai.pdf" width="100%" height="500"></iframe>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <?php if ($this->session->userdata('team_name') == 'SYNTAX SOLDIERS') : ?>
                                <div class="tab-pane fade show active" id="SYNTAX_SOLDIERS" role="tabpanel">
                                    <div class="d-flex mb-4">
                                        <div class="flex-grow-1 ms-3 ratio ratio-16x9">
                                            <iframe src="<?php echo base_url(); ?>assets/pdf/syntaxsoldiers.pdf" width="100%" height="500"></iframe>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <?php if ($this->session->userdata('team_name') == 'TECH TACTICIANS') : ?>
                                <div class="tab-pane fade show active" id="TECH_TACTICIANS" role="tabpanel">
                                    <div class="d-flex mb-4">
                                        <div class="flex-grow-1 ms-3 ratio ratio-16x9">
                                            <iframe src="<?php echo base_url(); ?>assets/pdf/techtacticians.pdf" width="100%" height="500"></iframe>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <?php if ($this->session->userdata('position')=== 'Manager') : ?>
                                <div class="tab-pane fade show active" id="ALGORITHM_ASSASSINS" role="tabpanel">
                                    <div class="d-flex mb-4">
                                        <div class="flex-grow-1 ms-3 ratio ratio-16x9">
                                            <iframe src="<?php echo base_url(); ?>assets/pdf/Algorithm Assasins.pdf" width="100%" height="500"></iframe>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade show" id="CODE_CONQUERORS" role="tabpanel">
                                    <div class="d-flex mb-4">
                                        <div class="flex-grow-1 ms-3 ratio ratio-16x9">
                                            <iframe src="<?php echo base_url(); ?>assets/pdf/Code Conquerors.pdf" width="100%" height="500"></iframe>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade show" id="CTRL_ALT_ELITE" role="tabpanel">
                                    <div class="d-flex mb-4">
                                        <div class="flex-grow-1 ms-3 ratio ratio-16x9">
                                            <iframe src="<?php echo base_url(); ?>assets/pdf/ctrlaltelite.pdf" width="100%" height="500"></iframe>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade show" id="CYBER_SINTENELS" role="tabpanel">
                                    <div class="d-flex mb-4">
                                        <div class="flex-grow-1 ms-3 ratio ratio-16x9">
                                            <iframe src="<?php echo base_url(); ?>assets/pdf/cybersintenels.pdf" width="100%" height="500"></iframe>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade show" id="LOGIC_LEGENDS" role="tabpanel">
                                    <div class="d-flex mb-4">
                                        <div class="flex-grow-1 ms-3 ratio ratio-16x9">
                                            <iframe src="<?php echo base_url(); ?>assets/pdf/Logiclegends.pdf" width="100%" height="500"></iframe>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade show" id="QUANTUM_QUANTS" role="tabpanel">
                                    <div class="d-flex mb-4">
                                        <div class="flex-grow-1 ms-3 ratio ratio-16x9">
                                            <iframe src="<?php echo base_url(); ?>assets/pdf/quantumquants.pdf" width="100%" height="500"></iframe>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade show" id="SERVER_SAMURAI" role="tabpanel">
                                    <div class="d-flex mb-4">
                                        <div class="flex-grow-1 ms-3 ratio ratio-16x9">
                                            <iframe src="<?php echo base_url(); ?>assets/pdf/serversamurai.pdf" width="100%" height="500"></iframe>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade show" id="SYNTAX_SOLDIERS" role="tabpanel">
                                    <div class="d-flex mb-4">
                                        <div class="flex-grow-1 ms-3 ratio ratio-16x9">
                                            <iframe src="<?php echo base_url(); ?>assets/pdf/syntaxsoldiers.pdf" width="100%" height="500"></iframe>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade show" id="TECH_TACTICIANS" role="tabpanel">
                                    <div class="d-flex mb-4">
                                        <div class="flex-grow-1 ms-3 ratio ratio-16x9">
                                            <iframe src="<?php echo base_url(); ?>assets/pdf/techtacticians.pdf" width="100%" height="500"></iframe>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
