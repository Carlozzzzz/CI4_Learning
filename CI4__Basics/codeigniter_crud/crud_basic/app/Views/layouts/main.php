<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Crud CI4 Basic</title>

    <!-- Favicons -->
    <link href="<?= base_url(); ?>assets/img/logo.png" rel="icon">
    <link href="<?= base_url(); ?>assets/img/logo.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url(); ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">

    <!-- Template Main CSS File -->
    <link href="<?= base_url(); ?>assets/css/style.css" rel="stylesheet">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
        <div class="container">
            <a class="navbar-brand" href="/">Ci4 tuturial</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/blog">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/blog/post">Post</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container ">

        <?= $this->renderSection('content') ?>

    </div>

    <a href="#" class="back-to-top foradmin d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <input type="hidden" id="textHidden" value="sample hidden value">
    <script src="<?= base_url(); ?>/assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="<?= base_url(); ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>/assets/vendor/chart.js/chart.min.js"></script>
    <script src="<?= base_url(); ?>/assets/vendor/echarts/echarts.min.js"></script>
    <script src="<?= base_url(); ?>/assets/vendor/quill/quill.min.js"></script>
    <script src="<?= base_url(); ?>/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="<?= base_url(); ?>/assets/vendor/tinymce/tinymce.min.js"></script>
    <!-- <script src="<?= base_url(); ?>assets/vendor/php-email-form/validate.js"></script> -->

    <script src="<?= base_url(); ?>/assets/js/main.js"></script>

    <script src="<?= base_url(); ?>/assets/vendor/sweetalert/sweetalert2.all.min.js"></script>

    <script src="<?= base_url(); ?>/assets/vendor/blockui/jquery.blockUI.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

    <script>

    function delete_data(id) {
        if (confirm("Are you sure you want to remove it? ")) {
            window.location.href = "<?php echo base_url(); ?>/crud/delete/" + id;
        }
        return false;
    }
    </script>
    
</body>

</html>