<?= $this->extend('template/main')?>

<?= $this->section('content') ?>

<section>
    <div class="custom-container">
        <div id="highScores" class="d-flex flex-column align-items-center justify-content-center">
            <h1 id="finalScore" class="mb-3">High Scores</h1>
            <ul id="highScoresList"></ul>
            <a class="custom-btn" href="<?= base_url()?>dashboard">Go to Home</a>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

    <script>
        const highScoresList = document.getElementById("highScoresList");
        const highScores = JSON.parse(localStorage.getItem("highScores")) || [];

        highScoresList.innerHTML = highScores
            .map(score => {
                return `<li class="high-score">${score.name} - ${score.score}</li>`;
            })
            .join("");
    </script>

<?= $this->endSection() ?>