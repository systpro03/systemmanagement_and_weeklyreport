
<div class="container-fluid">

    <div class="col-xl-12">
        <h4 class="text-center my-4 fw-bold">CORPORATE IT-SYSDEV ORGANIZATION STRUCTURE</h4>
        <div class="container text-center">
            <div class="row justify-content-center text-center">
                <div class="col-md-4" data-aos="zoom-in">
                    <img src="http://172.16.161.34:8080/hrms/images/users/43864-2013=2020-02-14=Profile=16-16-40-PM.jpg" class="img-thumbnail avatar-lg rounded-circle" style="border-color: orange">
                    <h6 class="mt-2 fw-bold fs-12">Maria Neliza U. Fuertes</h6>
                    <span class="text-dark" style="font-size: 0.7rem">CPA, CIA, CSCU, CISA, REB, REA, CICA, CrFA , REC</span>
                    <p class="text-dark" style="font-size: 0.7rem">Corporate Audit Group Managing Directress</p>
                </div>
            </div>
            <div class="row justify-content-center text-center mt-1">
                <div class="col-md-4" data-aos="zoom-in">
                    <img src="http://172.16.161.34:8080/hrms/images/users/14484-2013=2023-09-04=Profile=10-28-55-AM.JPG"
                        class="img-thumbnail avatar-lg rounded-circle" style="border-color: orange">
                    <h6 class="mt-2 fw-bold fs-12">Henry D. Baliar</h6>
                    <p class="text-dark" style="font-size: 0.7rem">Corporate IT Manager</p>
                </div>
            </div>
            <div class="row justify-content-center text-center mt-1">
                <div class="col-md-4" data-aos="zoom-in">
                    <img src="http://172.16.161.34:8080/hrms/images/users/21114-2013=2024-01-25=Profile=16-54-41-PM.jpg"
                        class="img-thumbnail avatar-lg rounded-circle" style="border-color: orange">
                    <h6 class="mt-2 fw-bold fs-12">Maria Cristina C. Evarle</h6>
                    <p class="text-dark" style="font-size: 0.7rem">IT SysDev | Sr. Supervisor</p>
                </div>
            </div>

            <div class="row justify-content-center text-center mt-1">
                <div class="col-md-4" data-aos="zoom-in">
                    <img src="http://172.16.161.34:8080/hrms/images/users/06129-2013=2024-01-26=Profile=14-01-22-PM.jpg"
                        class="img-thumbnail avatar-lg rounded-circle" style="border-color: orange">
                    <h6 class="mt-2 fw-bold fs-12">Mark Anthony S. Rabaca</h6>
                    <p class="text-dark" style="font-size: 0.7rem">IT SysDev | Jr. Supervisor</p>
                </div>
            </div>

            <div class="row justify-content-center text-center mt-4">
                <div class="col-md-4" data-aos="zoom-in">
                    <img src="http://172.16.161.34:8080/hrms/images/users/01022-2014=2024-01-25=Profile=16-51-55-PM.jpg"
                        class="img-thumbnail avatar-lg rounded-circle" style="border-color: orange">
                    <h6 class="mt-2 fw-bold fs-12">Jeneffer C. Cutanda</h6>
                    <p class="text-dark" style="font-size: 0.7rem">IT SysDev | Section Head</p>
                </div>
                <div class="col-md-4" data-aos="zoom-in">
                    <img src="http://172.16.161.34:8080/hrms/images/users/03553-2013=2024-01-25=Profile=16-01-05-PM.jpg"
                        class="img-thumbnail avatar-lg rounded-circle" style="border-color: orange">
                    <h6 class="mt-2 fw-bold fs-12">Santos, Joseph Fullido</h6>
                    <p class="text-dark" style="font-size: 0.7rem">IT SysDev | Section Head</p>
                </div>
                <div class="col-md-4" data-aos="zoom-in">
                    <img src="http://172.16.161.34:8080/hrms/images/users/03399-2013=2024-01-26=Profile=13-03-40-PM.jpg"
                        class="img-thumbnail avatar-lg rounded-circle" style="border-color: orange">
                    <h6 class="mt-2 fw-bold fs-12">Mary Ann Caliao</h6>
                    <p class="text-dark" style="font-size: 0.7rem">IT SysDev | Section Head</p>
                </div>
                <!-- <div class="col-md-6" data-aos="zoom-in">
                    <img src="http://172.16.161.34:8080/hrms/images/users/06129-2013=2024-01-26=Profile=14-01-22-PM.jpg"
                        class="img-thumbnail avatar-lg rounded-circle" style="border-color: orange">
                    <h6 class="mt-2 fw-bold fs-12">Mark Anthony S. Rabaca</h6>
                    <p class="text-dark" style="font-size: 0.7rem">IT SysDev | Section Head</p>
                </div> -->
            </div>
            <div class="container text-center mt-5 ">
                <h5 class="fw-bold mb-4 mt-5 text-uppercase">Programmers</h5>
                <div class="row justify-content-center">
                        <?php foreach ($programmers as $pro) : ?>
                            <?php if ($pro['emp_id'] !== '03553-2013' && $pro['emp_id'] !== '03399-2013'): ?>
                            <div class="col-md-2 mb-3 "  data-aos="zoom-in">
                                <img src="http://172.16.161.34:8080/hrms/<?php echo $pro['photo']; ?>"
                                    class="img-thumbnail avatar-lg rounded-circle" style="border-color: orange">
                                <h6 class="mt-2 text-dark fs-6"><?php echo $pro['name']; ?></h6>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <!-- <div class="row justify-content-center">
                        <?php foreach ($programmers as $pro) : ?>
                            <div class="col-md-2 mb-3 "  data-aos="zoom-in">
                                <img src="http://172.16.161.34:8080/hrms/<?php echo $pro['photo']; ?>"
                                    class="img-thumbnail avatar-lg rounded-circle" style="border-color: orange">
                                <h6 class="mt-2 text-dark fs-6"><?php echo $pro['name']; ?></h6>
                            </div>
                    <?php endforeach; ?>
                </div> -->

                <h5 class="fw-bold mb-4 mt-5 text-uppercase">System Analyst's</h5>
                <div class="row justify-content-center">
                    <?php foreach ($analysts as $sa) : ?>
                        <?php if ($sa['emp_id'] !== '21114-2013' && $sa['emp_id'] !== '01022-2014') : ?>
                            <div class="col-md-2 mb-3" data-aos="zoom-in">
                                <img src="http://172.16.161.34:8080/hrms/<?php echo $sa['photo']; ?>"
                                    class="img-thumbnail avatar-lg rounded-circle" style="border-color: orange">
                                <h6 class="mt-2 text-dark fs-6"><?php echo $sa['name']; ?></h6>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <h5 class="fw-bold mb-4 mt-5 text-uppercase">RMS Team</h5>
                <div class="row justify-content-center">
                    <?php foreach ($others as $r) : ?>
                        <?php if ($r['emp_id'] !== '06129-2013'): ?>
                            <div class="col-md-2 mb-3" data-aos="zoom-in">
                                <img src="http://172.16.161.34:8080/hrms/<?php echo $r['photo']; ?>"
                                    class="img-thumbnail avatar-lg rounded-circle" style="border-color: orange">
                                <h6 class="mt-2 text-dark fs-6"><?php echo $r['name']; ?></h6>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
