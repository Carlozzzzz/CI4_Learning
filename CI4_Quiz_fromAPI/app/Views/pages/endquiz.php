<?= $this->extend('template/main')?>

<?= $this->section('content') ?>

<section>
    <div class="custom-container">
        <div id="end" class="d-flex flex-column align-items-center justify-content-center">
            <h1 class="fw-bold mb-3" id="finalScore">0</h1>
            <form class="d-flex flex-column align-items-center examform">
                <input type="text" name="username" id="username" placeholder="username">
                <button id="saveScoreBtn" class="custom-btn" onclick="savingHighScore(event)" disabled>Save</button>
            </form>
            <a href="<?= base_url()?>quizfile" class="custom-btn">Play Again</a>
            <a href="<?= base_url()?>dashboard" class="custom-btn">Home</a>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

    <script>
        const username = document.getElementById("username");
        const saveScoreBtn = document.getElementById("saveScoreBtn");
        const mostRecentScore = localStorage.getItem("mostRecentScore");
        const highScores = JSON.parse(localStorage.getItem("highScores")) || [];

        const MAX_HIGH_SCORES = 5;

        // Setting the score in label
        finalScore.innerText = mostRecentScore;

        username.addEventListener("keyup", () => {
            saveScoreBtn.disabled = !username.value;
        });

        savingHighScore = e => {
            console.log("click the save button");
            e.preventDefault();

            const score = {
                // score: Math.floor(Math.random() * 100),
                score: mostRecentScore,
                name: username.value
            }

            // Sorting ang pushing to local storage
            highScores.push(score);
            highScores.sort((a, b) => b.score - a.score);
            highScores.splice(MAX_HIGH_SCORES);

            localStorage.setItem("highScores", JSON.stringify(highScores));

            window.location.href = "<?= base_url()?>dashboard";

        };
    </script>

<?= $this->endSection() ?>