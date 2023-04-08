<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap CSS -->
    <link href="<?= base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= base_url(); ?>assets/css/style.css" rel="stylesheet">
   
</head>

<body>
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="<?= base_url(); ?>dashboard" class="logo d-flex align-items-center">
                <img class=" bg-white rounded-circle border border-1" src="<?= base_url() ?>assets/img/quiz_logo.png" alt="WebApps Logo">
                <span class="d-none d-lg-block">Quizzsheet</span>
            </a>
            <i id="btnsidemenu" class="bi bi-list toggle-sidebar-btn"></i>
        </div>

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="<?= base_url() ?>assets/img/man_white_logo.png" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2"><?= session()->get('ci4_username')?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li>
                            <a class="dropdown-item d-flex align-items-center" onclick="signout_dialog();"
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
                if($data_activepage == "dashboard")
                {
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
                $xactive = "";
                $xcollapsed = "collapsed";
                $xshow = "";
                if($data_activepage == "tiktaktoefile" || $data_activepage == "tiktaktoefilev2")
                {
                    $xcollapsed = "";
                    $xshow = "show";
                    $xactive = "active";
                }
            ?>
            <li class="nav-item">
                <a class="nav-link <?= $xcollapsed;?>" data-bs-target="#registration-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-file-earmark-text"></i><span>Quizer Versions</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="registration-nav" class="nav-content collapse <?= $xshow;?>" data-bs-parent="#sidebar-nav">
                    <?php 
                        $xactive = "";
                        if($data_activepage == "tiktaktoefile")
                        {
                            $xactive = "class=\"active\"";
                        }
                    ?>
                    <li>
                        <a href="<?= base_url();?>tiktaktoefile" onclick="$.blockUI();" <?= $xactive;?>>
                            <i class="bi bi-circle"></i><span>V1</span>
                        </a>
                    </li>

                    <?php 
                        $xactive = "";
                        if($data_activepage == "tiktaktoefilev2")
                        {
                            $xactive = "class=\"active\"";
                        }
                    ?>
                    <li>
                        <a href="<?= base_url();?>tiktaktoefilev2" onclick="$.blockUI();" <?= $xactive;?>>
                            <i class="bi bi-circle"></i><span>V2</span>
                        </a>
                    </li>
                </ul>
            </li>

            <?php 
                $xcollapsed = "collapsed";
                if($data_activepage == "scoreboardfile"){
                    $xcollapsed = "";
                }
            ?>
            <li class="nav-item">
                <a class="nav-link <?= $xcollapsed?>" href="<?= base_url(); ?>scoreboardfile">
                    <i class="bi bi-speedometer2"></i>
                    <span>Score Board</span>
                </a>
            </li>
        </ul>
    </aside>

    <!-- Main section -->
    <main id="main" class="main">
        <?= $this->renderSection('content')?>
    </main>
    <!-- <footer class="sticky-bottom">
        <a href="https://www.flaticon.com/free-icons/tic-tac-toe" title="tic tac toe icons">Tic tac toe icons created by Freepik - Flaticon</a>
    </footer> -->

    <!-- Your HTML code here -->
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

    <!-- Add other JavaScript files here -->
    <?= $this->renderSection('scripts')?>

</body>

</html>