<!DOCTYPE html>
<!-- Template Name: Clip-Two - Responsive Admin Template build with Twitter Bootstrap 3.x | Author: ClipTheme -->
<!--[if IE 8]><html class="ie8" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9" lang="en"><![endif]-->
<!--[if !IE]><!-->
<?php
// echo "<pre>";
// var_dump(123);
// die();
    // $uri_segment = $this->uri->segment(2);
    // $uri_segment1 = $this->uri->segment(3);

    $user_role = session()->get('role');
    $user_name = ucfirst(session()->get('uname'));
?>

<html lang="en">
    <!-- start: HEAD -->
    <head>
        <meta charset="UTF-8">
        <title>Admin</title>
        <!-- start: META -->
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="google-signin-client_id" content="704429875174-vqg9891rfeinuvnir89t7uaidbig20la.apps.googleusercontent.com">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- end: META -->
        <link rel="icon" href="<?= base_url() ?>assets/images/favicon.png" type="image/png">  
        <!-- start: GOOGLE FONTS -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/googlefonts.css">
        <!--<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />-->
        <!-- end: GOOGLE FONTS -->
        <!-- start: MAIN CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
        <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/fontawesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/themify-icons/themify-icons.min.css">
        <link href="<?= base_url() ?>assets/vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
        <link href="<?= base_url() ?>assets/vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
        <link href="<?= base_url() ?>assets/vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
        <!-- end: MAIN CSS -->
        <!-- start: CLIP-TWO CSS -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/styles.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/plugins.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/themes/theme-1.css" id="skin_color" />
        <!-- end: CLIP-TWO CSS -->
        <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
        <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>front_assets/css/custom.css" media="screen" />

        <link href="<?= base_url() ?>assets/vendor/select2/select2.min.css" rel="stylesheet" media="screen">
        <link href="<?= base_url() ?>assets/vendor/DataTables/css/DT_bootstrap.css" rel="stylesheet" media="screen">
        <link href="<?= base_url() ?>assets/vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">

        <link href="<?= base_url() ?>assets/vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
        <link href="<?= base_url() ?>assets/vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

        <!-- iCheck for checkboxes and radio inputs -->
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/vendor/iCheck/all.css"/>
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/vendor/iCheck/minimal/blue.css"  />

        <link href="<?= base_url() ?>assets/css/myset.css" rel="stylesheet" type="text/css"/>
        <!-- <link rel="stylesheet" type="text/css" href="assets/toggel/css/on-off-switch.css"/> -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <script src="<?= base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

        <!-- Default V2 theme -->
        <link href="https://unpkg.com/survey-jquery/defaultV2.min.css" type="text/css" rel="stylesheet">

        <!-- Survey -->
        <script type="text/javascript" src="https://unpkg.com/survey-jquery/survey.jquery.min.js"></script>
        <script type="text/javascript" src="index.js"></script>
        
        <script src="<?= base_url() ?>front_assets/js/custom.js?v=4"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->


        <!-- Google API -->
        <script src="https://apis.google.com/js/platform.js" async defer></script>

        </script>
        <style type="text/css">
            .action-row{
                margin: 10px 0;
            }
            table thead tr th,
            table tbody tr td{
                text-align: center
            }
        </style>

    </head>

    <!-- end: HEAD -->
    <body>
        <div id="app">
            <!-- sidebar -->
            <div class="sidebar app-aside" id="sidebar">
                <div class="sidebar-container perfect-scrollbar">
                    <nav>

                        <ul class="main-navigation-menu">
                           
                            <li class="<?= ($uri_segment == 'dashboard') ? 'active' : ''; ?>" >
                                <a href="<?= site_url() ?>admin/dashboard" id="dash">
                                    <div class="item-content">
                                        <div class="item-media">
                                            <i class="ti-home"></i>
                                        </div>
                                        <div class="item-inner">
                                            <span class="title">Dashboard </span>
                                        </div>
                                    </div>
                                </a>
                            </li>

                            <li class="<?= ($uri_segment == 'surveyapi') ? 'active' : ''; ?>" >
                                <a href="<?= site_url() ?>admin/surveyapi" id="surveyapi">
                                    <div class="item-content">
                                        <div class="item-media">
                                            <i class="fa fa-life-ring" aria-hidden="true"></i>
                                        </div>
                                        <div class="item-inner">
                                            <span class="title">Survey with API</span>
                                        </div>
                                    </div>
                                </a>
                            </li>

                            <li class="<?= ($uri_segment == 'dbsaleschart') ? 'active' : ''; ?>" >
                                <a href="<?= site_url() ?>admin/dbsaleschart" id="dbsaleschart">
                                    <div class="item-content">
                                        <div class="item-media">
                                            <i class="fa fa-life-ring" aria-hidden="true"></i>
                                        </div>
                                        <div class="item-inner">
                                            <span class="title">DB Sales Charts</span>
                                        </div>
                                    </div>
                                </a>
                            </li>

                            <li class="<?= ($uri_segment == 'apicharts') ? 'active' : ''; ?>" >
                                <a href="<?= site_url() ?>admin/apicharts" id="apicharts">
                                    <div class="item-content">
                                        <div class="item-media">
                                            <i class="fa fa-life-ring" aria-hidden="true"></i>
                                        </div>
                                        <div class="item-inner">
                                            <span class="title">API Charts</span>
                                        </div>
                                    </div>
                                </a>
                            </li>



                        </ul>
                    </nav>
                </div>
            </div>
            <!-- / sidebar -->

            <div class="app-content">
                <!-- start: TOP NAVBAR -->
                <header class="navbar navbar-default navbar-static-top">
                    <!-- start: NAVBAR HEADER -->
                    <div class="navbar-header">
                        <a href="#" class="sidebar-mobile-toggler pull-left hidden-md hidden-lg" class="btn btn-navbar sidebar-toggle" data-toggle-class="app-slide-off" data-toggle-target="#app" data-toggle-click-outside="#sidebar">
                            <i class="ti-align-justify"></i>
                        </a>
                        <a class="navbar-brand" href="<?= base_url() ?>admin/dashboard">
                            <!-- <img src="<?= base_url() ?>front_assets/images/CCO_CORP_Logo_310wide.png" class="kent_logo" alt="CCO Logo" style="max-width: 200px"/> -->
                        </a>
                        <a href="#" class="sidebar-toggler pull-right visible-md visible-lg" data-toggle-class="app-sidebar-closed" data-toggle-target="#app">
                            <i class="ti-align-justify"></i>
                        </a>
                        <a class="pull-right menu-toggler visible-xs-block" id="menu-toggler" data-toggle="collapse" href=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <i class="ti-view-grid"></i>
                        </a>
                    </div>
                    <!-- end: NAVBAR HEADER -->
                    <!-- start: NAVBAR COLLAPSE -->
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-right">
                            <li class="dropdown current-user">
                                <a href class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?= base_url() ?>front_assets/images/avtar.png" alt="admin"> <span class="username"><?=$user_name?> <i class="ti-angle-down"></i></i></span>
                                </a>
                                <ul class="dropdown-menu dropdown-dark">
                                    <li>
                                        <a href="<?= base_url() ?>admin/stripe_key_setting">
                                            Stripe Key Setting
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url() ?>admin/changepassword">
                                            Change Password
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url() ?>admin/alogin/logout">
                                            Log Out
                                        </a>
                                    </li>
                                </ul>
                            </li>

                        </ul>

                    </div>

                </header>
                <!-- end: TOP NAVBAR -->

                <!-- start: Page Content -->
                <?= $this->renderSection('content') ?>
                <!-- end: Page Content -->

            </div>

        </div>
        <!-- start: MAIN JAVASCRIPTS -->
        <script src="<?= base_url(); ?>assets/vendor/moment/moment.min.js"></script>
        <script src="<?= base_url() ?>assets/vendor/modernizr/modernizr.js"></script>
        <script src="<?= base_url() ?>assets/vendor/jquery-cookie/jquery.cookie.js"></script>
        <script src="<?= base_url() ?>assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="<?= base_url() ?>assets/vendor/switchery/switchery.min.js"></script>
        <!-- <script src="<?= base_url() ?>assets/vendor/Chart.js/Chart.min.js"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <!-- end: MAIN JAVASCRIPTS -->

        <script src="<?= base_url() ?>assets/vendor/iCheck/icheck.min.js" type="text/javascript"></script>

        <!-- alertify JavaScript -->
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        <!-- CSS -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        <!-- alertify Default theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
        <!-- alertify Semantic UI theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
        <!-- alertify Bootstrap theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>

        <script src="<?= base_url() ?>assets/vendor/maskedinput/jquery.maskedinput.min.js"></script>
        <script src="<?= base_url() ?>assets/vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
        <script src="<?= base_url() ?>assets/vendor/autosize/autosize.min.js"></script>
        <script src="<?= base_url() ?>assets/vendor/selectFx/classie.js"></script>
        <script src="<?= base_url() ?>assets/vendor/select2/select2.min.js"></script>
        <script src="<?= base_url() ?>assets/vendor/selectFx/selectFx.js"></script>
        <script src="<?= base_url(); ?>assets/vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
        <script src="<?= base_url(); ?>assets/vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
        <script src="<?= base_url() ?>assets/vendor/DataTables/jquery.dataTables.min.js"></script>

        <!-- start: CLIP-TWO JAVASCRIPTS -->
        <script src="<?= base_url() ?>assets/js/main.js?1"></script>
        <!-- start: JavaScript Event Handlers for this page -->

        <script src="<?= base_url() ?>assets/js/table-data.js"></script>

        <script src="<?= base_url() ?>assets/js/form-elements.js"></script>
        <!--<script src="<?= base_url() ?>assets/js/form-wizard.js"></script>-->
        <script src="<?= base_url() ?>assets/js/pages-messages.js"></script>

        <!-- start : Page Script -->
        <?= $this->renderSection('script') ?>
        <!-- end : Page Script -->


        <script>
            jQuery(document).ready(function () {
                Main.init();
            //  FormWizard.init();
            //   FormElements.init();
                Messages.init();
            });
        </script>
        <!-- end: JavaScript Event Handlers for this page -->
        <!-- end: CLIP-TWO JAVASCRIPTS -->  
    </body>
</html>
