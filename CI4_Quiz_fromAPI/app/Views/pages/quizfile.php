<?= $this->extend('template/main')?>

<?= $this->section('content') ?>

<section>
    <div class="custom-box-size d-flex justify-content-center align-items-center">
        <div id="loader"></div>
        <div id="game" class="d-flex flex-column justify-content-center d-none">
            <div class="d-flex justify-content-between mb-5" id="hud">
                <div id="hud-item">
                    <h3 id="progressText" class="hud-prefix">Question</h3>
                    <div class="mt-2" id="progressBar">
                        <div id="progressBarFull"></div>
                    </div>
                </div>
                <div id="hud-item">
                    <h3 class="hud-prefix">Score</h3>
                    <h1 class="hud-main-text" id="score">0</h1>
                </div>
            </div>
            <h2 class="mb-3" id="question">This is question</h2>
            <div class="choice-container">
                <p class="choice-prefix">A</p>
                <p class="choice-text" data-number="1">Test 1</p>
            </div>
            <div class="choice-container">
                <p class="choice-prefix">B</p>
                <p class="choice-text" data-number="2">Test 2</p>
            </div>
            <div class="choice-container">
                <p class="choice-prefix">C</p>
                <p class="choice-text" data-number="3">Test 3</p>
            </div>
            <div class="choice-container">
                <p class="choice-prefix">D</p>
                <p class="choice-text" data-number="4">Test 4</p>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

    <script>
        const question = document.getElementById("question");
        const choices = Array.from(document.getElementsByClassName("choice-text")); // html collection | node list then convert to array
        const progressText = document.getElementById('progressText');
        const scoreText = document.getElementById('score');
        const progressBarFull = document.getElementById('progressBarFull');
        const game = document.getElementById('game');
        const loader = document.getElementById('loader');


        const CORRECT_BONUS = 10;
        const MAX_QUESTIONS = 3;

        let currentQuestion = {};
        let acceptingAnswers = false;
        let score = 0;
        let questionCounter = 0;
        let availableQuestions = [];

        let questions = [];
        
        // use opentdb.com to Fetch questions online
        fetch("https://opentdb.com/api.php?amount=9&category=9&difficulty=easy&type=multiple")
            .then( res => {
                return res.json();
            }).then(loadedQuestions => {
                // console.log(loadedQuestions.results);
                // convert the questions to new form
                questions = loadedQuestions.results.map( loadedQuestion => {
                    const formattedQuestions = {
                        question : loadedQuestion.question
                    };

                    const answerChoices = [...loadedQuestion.incorrect_answers];
                    formattedQuestions.answer = Math.floor(Math.random() * 3) + 1;
                    answerChoices.splice(
                        formattedQuestions.answer - 1,
                        0,
                        loadedQuestion.correct_answer
                    );

                    answerChoices.forEach((choice, index) => {
                        formattedQuestions["choice" + (index + 1) ] = choice;
                    });

                    return formattedQuestions;

                });
                // questions = loadedQuestions;
            
                
                startGame();
            })
            .catch( err => {
                console.log(err);
            }); // always do catch


        startGame = () => {
            questionCounter = 0;
            score = 0;
            availableQuestions = [...questions]; // copying the questions 
            // console.log(availableQuestions);
            getNewQuestion();

            game.classList.remove("d-none");
            loader.classList.add("d-none");
        }

        getNewQuestion = () => {
            if (availableQuestions.length == 0 || questionCounter >= MAX_QUESTIONS) {
                localStorage.setItem("mostRecentScore", score);
                window.location.href = "<?= base_url() . $data_activepage ?>/endquiz";
            }

            questionCounter ++;
            progressText.innerText = `Question ${questionCounter}/${MAX_QUESTIONS}`;
            // Update the progress bar
            progressBarFull.style.width = `${(questionCounter / MAX_QUESTIONS) * 100}%`;

            // getting random number from 1 to 3
            const questionIndex = Math.floor(Math.random() * availableQuestions.length);
            currentQuestion = availableQuestions[questionIndex];
            question.innerText = currentQuestion.question;

            choices.forEach ( choice => {
                const number = choice.dataset["number"];
                choice.innerText = currentQuestion["choice" + number];
            });

            // removing selected question-answer
            availableQuestions.splice(questionIndex, 1);
            acceptingAnswers = true;
        };

        choices.forEach( choice => {
            choice.addEventListener("click", e => {
                if( !acceptingAnswers) return;

                acceptingAnswers = false;
                const selectedChoice = e.target;
                const selectedAnswer = selectedChoice.dataset["number"];

                const classToApply = selectedAnswer == currentQuestion.answer ? 'correct' : 'incorrect';

                if(classToApply === 'correct')
                {
                    incrementScore(CORRECT_BONUS);
                }

                selectedChoice.parentElement.classList.add(classToApply);

                setTimeout( () => {
                selectedChoice.parentElement.classList.remove(classToApply);
                    // console.log(classToApply);
                    getNewQuestion();
                }, 1000);
            });
        });

        incrementScore = num => {
            score += num;
            scoreText.innerText = score;
        };

    </script>

<?= $this->endSection() ?>