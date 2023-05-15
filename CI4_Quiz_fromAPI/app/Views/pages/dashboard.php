<?= $this->extend('template/main')?>

<?= $this->section('content') ?>

<section>
    <div class="custom-box-size d-flex justify-content-center">
        <div id="home" class="d-flex flex-column align-items-center justify-content-center">
            <h1 class="mb-4 fw-bold custom-color">Start Quiz</h1>
            <a class="custom-btn" href="<?= base_url()?>quizfile">Play</a>
            <a class="custom-btn" href="<?= base_url()?>quizfile/highscores">High Scores</a>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

    <script>
        
    </script>

<?= $this->endSection() ?>