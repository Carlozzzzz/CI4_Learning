<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>

        <!-- Favicons -->
        <link href="<?= base_url(); ?>assets/img/logo2.png" rel="icon">
        <link href="<?= base_url(); ?>assets/img/logo2.png" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
                rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="<?= base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= base_url(); ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="<?= base_url(); ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="<?= base_url(); ?>assets/vendor/quill/quill.snow.css" rel="stylesheet">
        <link href="<?= base_url(); ?>assets/vendor/quill/quill.bubble.css" rel="stylesheet">
        <link href="<?= base_url(); ?>assets/vendor/remixicon/remixicon.css" rel="stylesheet">
        <link href="<?= base_url(); ?>assets/vendor/simple-datatables/style.css" rel="stylesheet">

        

        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">

        <!-- Template Main CSS File -->
        <link href="<?= base_url(); ?>assets/css/style.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="<?= base_url(); ?>assets/css/main.css" rel="stylesheet">

    </head>
    <body>
        <section class="gradient-form">
            <div class="container py-5">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-xl-10">
                        <div class="card rounded-3 text-black">
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    <div class="card-body p-md-5 mx-md-4">
                                        <div class="text-center">
                                        <img src="<?= base_url() ?>assets/img/login2_logo.png"
                                            style="width: 100px;" alt="logo">
                                        <h4 class="mt-3 mb-5 pb-1">Login Default Template</h4>
                                        </div>

                                        <form name="myform" id="myform" class="needs-validation" method="POST" autocomplete="off" enctype="multipart/form-data" novalidate>
                                            <p>Please login to your account</p>

                                            <div class="form-floating mb-4">
                                                <input type="text" name="txtfld[username]" id="txtusername" 
                                                    class="form-control"
                                                    placeholder="Phone number or email address" 
                                                    required>
                                                <label class="form-label" for="txtusername">Username</label>
                                                <div class="invalid-feedback">
                                                    Please provide valid Username.
                                                </div>
                                            </div>

                                            <div class="form-floating mb-4">
                                                <input type="password" name="txtfld[password]" id="txtpassword" 
                                                    class="form-control"
                                                    placeholder="Password" 
                                                    required>
                                                <label class="form-label" for="txtpassword">Password</label>
                                                <div class="invalid-feedback">
                                                    Please provide valid Password.
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-center justify-content-center">
                                                <button type="submit" id="submit"
                                                    class="btn btn-primary btn-block fa-lg gradient-custom-2 me-3 createnew">
                                                        Log in
                                                </button>
                                                <a class="text-muted" href="#!">Forgot password?</a>
                                            </div>

                                            <div class="d-flex align-items-center justify-content-center pb-4">
                                                <p class="mb-0 me-2">Don't have an account?</p>
                                                <button type="button" class="btn btn-outline-danger createnew" id="createnew">Create new</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                    <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                        <h4 class="mb-4">Your Project Title</h4>
                                        <p class="small mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script src="<?= base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
        <script src="<?= base_url(); ?>assets/vendor/apexcharts/apexcharts.min.js"></script>
        <script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?= base_url(); ?>assets/vendor/tinymce/tinymce.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/main.js"></script>
        <script src="<?= base_url(); ?>assets/vendor/sweetalert/sweetalert2.all.min.js"></script>
        <script src="<?= base_url(); ?>assets/vendor/blockui/jquery.blockUI.js"></script>

        <script>

            jQuery(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip();
                
                const forms = document.querySelectorAll('.needs-validation');
                var ispassvalidation = false;
                Array.prototype.slice.call(forms).forEach((form) => {
                    form.addEventListener('submit', (event) => {
                        if(!form.checkValidity())
                        {
                            ispassvalidation = false;
                        }
                        else
                        {
                            ispassvalidation = true;
                        }
                        form.classList.add('was-validated');
                        event.preventDefault();
                        event.stopPropagation();

                        if(ispassvalidation == true)
                        {
                            var strtest = "<?php echo base_url()?>";
                            signin();
                        }

                    }, false);
                    form.addEventListener('reset', (event) => {
                        
                    }, false);

                    
                });

                checkenter();
            });

            function signin(){
                console.log('signing in..');
                // write ajax code here
                $.blockUI();
                var xdata = jQuery("#myform").serialize();
                jQuery.ajax({
                    url : "<?= base_url(); ?>DefaultCI/submitsigninuser",
                    method: "POST",
                    data: xdata,
                    dataType: "JSON",
                    success: function(xret){
                        $.unblockUI();
                        if(xret.bool)
                        {
                            Swal.fire({
                                icon: 'success',
                                title: 'Welcome to Potato Login Systems, Developing an CI3 to CI4 project.',
                                allowOutsideClick: false
                            }).then((result) => {
                                if(result.value){
                                    $.blockUI();
                                    window.location.href = "<?= base_url(); ?>dashboard";
                                }
                            });
                        }
                        else if(xret.bool == false)
                        {
                            console.log(xret.msg);
                            Swal.fire({
                                icon: 'error',
                                title: xret.msg,
                                allowOutsideClick: false
                            }).then((result) => {
                                if(result.value)
                                {
                                    jQuery("#myform").removeClass("was-validated");
                                    jQuery("input").addClass("is-invalid");
                                }
                            });
                        }
                    },
                });

            }

            
        </script>
        
    </body>



</html>