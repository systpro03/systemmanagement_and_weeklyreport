<!doctype html>
<html lang="en" data-preloader="enable">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta charset="utf-8" />
        <title>Authentication</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <script src="<?php echo base_url(); ?>assets/js/layout.js"></script>
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/css/app.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/css/custom.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div class="auth-page-wrapper py-5 d-flex justify-content-center align-items-center min-vh-100">
            <div class="auth-page-content overflow-hidden p-0">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-7 col-lg-8">
                            <div class="text-center">
                                <img src="<?php echo base_url(); ?>assets/images/notfound.jpg" alt="error img" class="img-fluid" />
                                <div class="mt-3">
                                    <h3 class="fs-35" style="font-family: 'BirthdayFont';">Sorry, Your <b style="color: red;">Session</b> has expired !!! </h3>
                                    <p class=" mb-4 fw-bold " style="font-style: italic;">Please Log in, To continue! </p>
                                    <a href="<?php echo base_url('login'); ?>" class="btn btn-primary"><i class="mdi mdi-home me-1"></i>Sign in
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<style>
    @font-face {
    font-family: 'BirthdayFont';
    src: url('<?php echo base_url("assets/fonts/chicken.otf"); ?>') format('opentype');
    font-weight: normal;
    font-style: normal;
}
</style>