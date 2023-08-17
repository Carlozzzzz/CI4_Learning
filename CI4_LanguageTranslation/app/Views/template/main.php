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
    <link href="<?= base_url(); ?>assets/img/logo.png" rel="icon">
    <link href="<?= base_url(); ?>assets/img/logo.png" rel="apple-touch-icon">

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
            <a href="<?= base_url(); ?>dashboard" class="logo d-flex align-items-center" onclick="$.blockUI();">
                <img src="<?= base_url(); ?>assets/img/logo.png" alt="WebApps Logo">
                <span class="d-none d-lg-block">DJAPINHS</span>
            </a>
            <i id="btnsidemenu" class="bi bi-list toggle-sidebar-btn"></i>
        </div>

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item ">
                    <select class="custom-select border-0" id="languageSelect">
                        <option value="" disabled selected>Lang</option>
                        <option value="english">English</option>
                        <option value="spanish">Spanish</option>
                    </select>
                </li>
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="<?= base_url();?>assets/img/male-avatar.svg" alt="Profile" class="rounded-circle">
                        <span
                            class="d-none d-md-block dropdown-toggle ps-2"><?= session()->get('hfaoe_username');?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li>
                            <a class="dropdown-item d-flex align-items-center" onclick="signout_diag();"
                                style="cursor: pointer;">
                                <i class="bi bi-arrow-left"></i>
                                <span>Log Out</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>

    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <?php 
            $xcollapsed = "collapsed";
            if($data_activepage == "dashboard")
            {
            $xcollapsed = "";
            }
        ?>
            <li class="nav-item">
                <a class="nav-link <?= $xcollapsed;?>" href="<?= base_url();?>dashboard" onclick="$.blockUI();">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
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

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= base_url(); ?>assets/vendor/blockui/jquery.blockUI.js"></script>

    <script src="<?= base_url(); ?>assets/js/main.js"></script>
    <script src="<?= base_url(); ?>assets/js/translator.js"></script>


    <?= $this->renderSection('script') ?>
    <script>

        function signout_diag() {

            // Working code
            const translationData = fetchAllText(); // Fetch the translation data

            translationData.then((arrData) => {
                const selectedLanguage = $('#languageSelect').val(); // Get the selected language

                // Find the translations for the dialog text
                let dialogTitle = 'Are you sure you want to logout?';
                let dialogText = 'Your session will be end here!';
                let confirmButtonText = 'Yes, I want to logout!';
                let cancelButtonText = 'Cancel';

                for (let i = 0; i < arrData.length; i++) {
                    if (arrData[i].english_text === dialogTitle) {
                        dialogTitle = arrData[i][selectedLanguage + '_text'];
                    }
                    if (arrData[i].english_text === dialogText) {
                        dialogText = arrData[i][selectedLanguage + '_text'];
                    }
                    if (arrData[i].english_text === confirmButtonText) {
                        confirmButtonText = arrData[i][selectedLanguage + '_text'];
                    }
                    if (arrData[i].english_text === cancelButtonText) {
                        cancelButtonText = arrData[i][selectedLanguage + '_text'];
                    }
                }

                Swal.fire({
                    title: dialogTitle,
                    text: dialogText,
                    icon: 'warning',
                    allowOutsideClick: false,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: confirmButtonText,
                    cancelButtonText: cancelButtonText
                }).then((result) => {
                    if (result.value) {
                        $.blockUI();
                        jQuery.ajax({
                            url: "<?= base_url(); ?>/DefaultCI/submitsigoutnuser",
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
            });
        }

			// let imageAltText = 'Loading...';
            // imageAlt: imageAltText,


        getTranslatedSelectAccess('User added').then((msg) => {
            toastr.success(msg);
        });

    </script>


    <script>

        const translationData = fetchAllText(); // Fetch the translation data

        translationData.then((arrData) => {
            const selectedLanguage = $('#languageSelect').val(); // Get the selected language

            // Find the translations for the dialog text
            let dialogTitle = 'Missing Field Poll Name';
            let dialogText = 'Please make sure Poll Name is not empty';

            for (let i = 0; i < arrData.length; i++) {
                if (arrData[i].english_text === dialogTitle) {
                    dialogTitle = arrData[i][selectedLanguage + '_text'];
                }
                if (arrData[i].english_text === dialogText) {
                    dialogText = arrData[i][selectedLanguage + '_text'];
                }
                
            }
            swal.fire(dialogTitle, dialogText, 'error')
        });

        getTranslatedSelectAccess('Cannot send empty message').then((msg) => {
            toastr.info(msg);
        });
    </script>
  
    <!-- AJAX Request processing data -->
    <!-- create test Controller and getTest function -->
    <!-- $route['MyCEA/test/(.+)'] = 'test/$1'; -->
    <script>
        var ajaxFlag = false;
        $(document).ready(function() {

            function makeRequest() {
                return new Promise(function(resolve, reject) {
                    $.post("<?=$this->project_url.'/test/getTest'?>")
                    .done(function(result) {
                        result = JSON.parse(result);
                        if (result) {
                            console.log(result);
                        } else {
                            console.log("No response");
                        }
                        resolve(); 
                    })
                    .fail(function() {
                        console.log("Error response");
                        reject(); 
                    });

                });
            }

            var requestPromise = makeRequest();

            requestPromise.then(function() {
                testFunction();
                ajaxFlag = true;
            });

            afterAjax(); 
        });

        function testFunction() {
            console.log("Inside the ajax request");
        }

        function afterAjax() {
            if(ajaxFlag) {
                console.log("Success : afterAjax");
            }
            else{
                setTimeout(afterAjax, 500);
            }
        }
    </script>
   
</body>

</html>