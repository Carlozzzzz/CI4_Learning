<?= $this->extend('template/main')?>

<?= $this->section('content') ?>

<section>

    <h4>Simple Dashboard</h4>
    <a href="<?= base_url()?>defaultci/pdfexample" class="btn btn-primary" target="_target">PDF</a>
    <a href="<?= base_url()?>defaultci/displaydata" class="btn btn-primary">displaydata</a>

    <div class="mt-5">
        <p><?= isset($my_data) ? $my_data : "Nothing to display." ?></p>
        <!-- <img src="<?= $_SERVER['DOCUMENT_ROOT']."/img/user_logo.png"; ?>" alt="img"> -->
        <!-- <img src="<?= base_url() ?>assets/img/logo.png" alt=""> -->
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

    <script>
        
    </script>

<?= $this->endSection() ?>