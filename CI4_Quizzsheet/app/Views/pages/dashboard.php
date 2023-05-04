<?= $this->extend('template/main')?>

<?= $this->section('content') ?>

<section>

    <h4>Simple Dashboard</h4>
    <a href="<?= base_url()?>defaultci/pdfexample" class="btn btn-primary" target="_target">PDF</a>
    <a href="<?= base_url()?>defaultci/defaultPDF" class="btn btn-primary" target="_target">Default PDF</a>
    <a href="<?= base_url()?>defaultci/displaydata" class="btn btn-primary">displaydata</a>

    <a class="logo d-flex align-items-center bg-dark my-3">
        <img class="" src="<?= base_url() ?>assets/img/sample_logo.png" alt="WebApps Logo">
        <span class="d-none d-lg-block">Project Name</span>
    </a>

    <div class="my-3 p-3 shadow">

        <a href="<?= base_url()?>" class="mb-5 text-success d-flex flex-column">
            <span>
                <?= isset($my_data) ? $my_data : "No data" ?>
            </span>
            <?php $myLogo = isset($my_data) ? $my_data : base_url() . 'assets/img/login_logo.png'; ?>
            <img class="mb-3 logo" src="<?= $myLogo; ?>" alt="Sample_logo">
        </a>
        
    </div>

    <div class="mb-3 shadow border-0" id="editor">
        <p>Hello World!</p>
    </div>

    <div class="mb-3 p-3 shadow" >
        <table id="myTable">
            <thead>
            <tr>
                <th>Name</th>
                <th>Age</th>
                <th>Gender</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>John</td>
                <td>30</td>
                <td>Male</td>
            </tr>
            <tr>
                <td>Jane</td>
                <td>25</td>
                <td>Female</td>
            </tr>
            </tbody>
        </table>

    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

    <script>
        new simpleDatatables.DataTable("#myTable");
        var quill = new Quill('#editor', {
        theme: 'snow'
        });
    </script>

<?= $this->endSection() ?>