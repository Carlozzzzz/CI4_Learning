<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>My Project</title>

    <!-- Favicons -->
    <link href="<?= base_url(); ?>assets/img/logo2.png" rel="icon">
    <link href="<?= base_url(); ?>assets/img/logo2.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
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

</head>


<body>
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="<?= base_url(); ?>dashboard" class="logo d-flex align-items-center">
                <img class="" src="<?= base_url() ?>assets/img/sample_logo.png" alt="WebApps Logo">
                <span class="d-none d-lg-block">Project Name</span>
            </a>
            <i id="btnsidemenu" class="bi bi-list toggle-sidebar-btn"></i>
        </div>

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="<?= base_url() ?>assets/img/user3_logo.png" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2"><?= session()->get('ci4_username')?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li>
                            <a class="dropdown-item d-flex align-items-
                            " onclick="signout_dialog();"
                                style="cursor-pointer;">
                                <i class="bi bi-arrow-left"></i>
                                <span>Logo out</span>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>

    </header>

    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="side-nav">
            <?php 
                $xcollapsed = "collapsed";
                if($data_activepage == "dashboard"){
                    $xcollapsed = "";
                }
            ?>
            <li class="nav-item">
                <a class="nav-link <?= $xcollapsed?>" href="<?= base_url(); ?>dashboard">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>


            <?php
                $xcollapsed = "collapsed";
                $xshow = "";
                $xactive = "";

                if($data_activepage == "subjectfile" || $data_activepage == "assignsubjectfile" || $data_activepage == "studentsubjectlistfile" || $data_activepage == "teachersubjectlistfile") 
                {
                    $xcollapsed = "";
                    $xshow = "show";
                    $xactive = "active";
                }
            ?>
            <li class="nav-item">
                <a class="nav-link <?= $xcollapsed ?>" data-bs-target="#program-nav" data-bs-toggle="collapse" 
                    href="#">
                    <i class="bi bi-pencil-fill"></i></i><span>Academics</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="program-nav" class="nav-content collapse <?= $xshow?>" data-bs-parent="#side-nav">
                    <?php
                        $xactive = "";
                        if($data_activepage == "subjectfile")
                        {
                            $xactive = "class=\"active\"";
                        }
                    ?>
                    <li>
                        <a href="<?= base_url() ?>subjectfile" <?= $xactive?>>
                            <i class="bi bi-circle"></i><span>Subjects</span>
                        </a>
                    </li>

                    <?php
                        $xactive = "";
                        if($data_activepage == "assignsubjectfile" || $data_activepage == "studentsubjectlistfile" || $data_activepage == "teachersubjectlistfile")
                        {
                            $xactive = "class=\"active\"";
                        }
                    ?>
                    <li>
                        <a href="<?= base_url() ?>assignsubjectfile" <?= $xactive?>>
                            <i class="bi bi-circle"></i><span>Assign Subjects</span>
                        </a>
                    </li>
                </ul>
            </li>

            <?php
                $xcollapsed = "collapsed";
                $xshow = "";
                $xactive = "";

                if($data_activepage == "userfile" || $data_activepage == "teacherfile" || $data_activepage == "studentfile")
                {
                    $xcollapsed = "";
                    $xshow = "show";
                    $xactive = "active";
                }
            ?>
            <li class="nav-item">
                <a class="nav-link <?= $xcollapsed ?>" data-bs-target="#userfile-nav" data-bs-toggle="collapse" 
                    href="#">
                    <i class="bi bi-file-earmark-text" style="font-size: 1.2em;"></i><span>Accounts</span>
                    <i class="bi bi-chevron-down ms-auto" style="font-size: 1.2em;"></i>
                </a>
                <ul id="userfile-nav" class="nav-content collapse <?= $xshow?>" data-bs-parent="#side-nav">
                    <?php
                        $xactive = "";
                        if($data_activepage == "userfile")
                        {
                            $xactive = "class=\"active\"";
                        }
                    ?>
                    <li>
                        <a href="<?= base_url() ?>userfile" <?= $xactive?>>
                            <i class="bi bi-circle"></i><span>Users</span>
                        </a>
                    </li>
                    <?php
                        $xactive = "";
                        if($data_activepage == "studentfile")
                        {
                            $xactive = "class=\"active\"";
                        }
                    ?>
                    <li>
                        <a href="<?= base_url() ?>studentfile" <?= $xactive?>>
                            <i class="bi bi-circle"></i><span>Students</span>
                        </a>
                    </li>
                    <?php
                        $xactive = "";
                        if($data_activepage == "teacherfile")
                        {
                            $xactive = "class=\"active\"";
                        }
                    ?>
                    <li>
                        <a href="<?= base_url() ?>teacherfile" <?= $xactive?>>
                            <i class="bi bi-circle"></i><span>Teachers</span>
                        </a>
                    </li>
                    
                </ul>
            </li>

            
        </ul>
    </aside>
    <main id="main" class="main">
        <?= $this->renderSection('content') ?>
    </main>

    <script src="<?= base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/chart.js/chart.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/echarts/echarts.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/quill/quill.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/tinymce/tinymce.min.js"></script>
    <!-- <script src="<?= base_url(); ?>assets/vendor/php-email-form/validate.js"></script> -->

    <script src="<?= base_url(); ?>assets/js/main.js"></script>

    <script src="<?= base_url(); ?>assets/vendor/sweetalert/sweetalert2.all.min.js"></script>

    <script src="<?= base_url(); ?>assets/vendor/blockui/jquery.blockUI.js"></script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script> -->

    <?= $this->renderSection('script') ?>


    <script type="text/javascript">
    (function() {
        $('.selectpicker').selectpicker();
    });

    jQuery(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();

        const forms = document.querySelectorAll('.needs-validation');
        var ispassvalidation = false;
        Array.prototype.slice.call(forms).forEach((form) => {
            form.addEventListener('submit', (event) => {
                if (!form.checkValidity()) {
                    ispassvalidation = false;
                } else {
                    ispassvalidation = true;
                }

                form.classList.add('was-validated');
                event.preventDefault();
                event.stopPropagation();

                if (ispassvalidation == true) {
                    if (form.classList.contains('save')) {
                        save();
                    }
                    if (form.classList.contains('update')) {
                        update();
                    }
                    if (form.classList.contains('upload')) {
                        upload();
                    }
                }
            }, false);
            form.addEventListener('reset', (event) => {
                form.classList.remove('was-validated');
            }, false);
        });

        checkenter();

        $('.numberonly').keypress(function(e) {
            var charCode = (e.which) ? e.which : event.keyCode
            if (String.fromCharCode(charCode).match(/[^0-9]/g))
                return false;
        });

        $(".not-sortable a").removeClass("dataTable-sorter");
        $(".not-sortable a").removeAttr("href").css("cursor", "default");

    });

    function changeselect(obj) {
        $.blockUI();
        if(checkhassession())
        {
            var xdata = "";
            if (jQuery(obj).hasClass("teacher") == true) {
                xdata += "&selecttype=teacher";
                xdata += "&teacherid=" + jQuery(obj).val();
            }

            xdata += "&showsubject=<?= $data_activepage == "studentsubjectlistfile" ? "yes" : "no"; ?>";

            jQuery.ajax({
                url: "<?= base_url();?>/DefaultCI/changeselect",
                method: "POST",
                data: xdata,
                dataType: "JSON",
                success: function(xret) {
                    $.unblockUI();
                    if (xret.bool) {
                        if (jQuery(obj).hasClass("teacher") == true) {
                            jQuery("#div_subject").empty();
                            jQuery("#div_subject").html(xret.obj);
                        }
                    } else if (xret.bool == false) {
                        Swal.fire({
                            icon: 'error',
                            title: xret.msg,
                            allowOutsideClick: false
                        });
                    }
                },
            });
        }
        else
        {
            window.location.href = "<?= base_url()?>template/errorpage";
        }
    }
    function checkenter() {
        $("input").keydown(function(e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                return false;
            }
        });
    }

    function signout_dialog() {
        Swal.fire({
            title: 'Are you sure you want to logout?',
            text: 'Your session will end here!',
            icon: 'warning',
            allowOutsideClick: false,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, I want to logout!',
        }).then((result) => {
            if (result.value) {
                $.blockUI();
                jQuery.ajax({
                    url: "<?= base_url(); ?>/DefaultCI/submitsignoutuser",
                    method: "POST",
                    data: "",
                    dataType: "JSON",
                    success: function(xret) {
                        if (xret.bool) {
                            window.location.href = "<?= base_url(); ?>";
                        }
                    },
                });
            }
        });
    }

    function checkhassession() {
        var xbool = false;
        var xdata = "&action=checkhassession";
        jQuery.ajax({
            url: "<?= base_url(); ?>DefaultCI/hassession",
            method: "POST",
            data: xdata,
            dataType: "JSON",
            async: false,
            success: function(xret) {
                if (xret.bool) {
                    xbool = true;
                }
            }
        });
        return xbool;
    }

    function viewactive(obj) {
        $.blockUI();
        if (checkhassession()) {
            if (jQuery(obj).is(":checked") == true) {
                window.location.href = "<?= base_url().$data_activepage; ?>";
            } else {
                window.location.href = "<?= base_url().$data_activepage; ?>/index/0";
            }
        } else {
            window.location.href = "<?= base_url();?>template/errorfile";
        }
    }
    </script>
</body>

</html>