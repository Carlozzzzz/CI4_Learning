<?= $this->extend('template/main')?>

<?= $this->section('content') ?>

<style>
    .StepTitle{
        font-size: 14px;
    }
    .custom-aligner {
        margin: 20px;
    }
</style>

<div class="main-content">
    <!-- start: Chart -->
    <div class="wrap-content container" id="container">
        <div class="container-fluid container-fullw bg-white">
            <!-- <div class="row">
                <canvas id="flashChart"></canvas>
            </div> -->
            <div class="row">
                
                <div class="col-md-12">
                    <div id="surveyContainer"></div>
                </div>
               
            </div>
        </div>
    </div>
    <!-- end: Chart -->
    
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

    <script type="text/javascript">

        const surveyJson = {
            elements: [{
                name: "FirstName",
                title: "Enter your first name:",
                type: "text"
            }, {
                name: "LastName",
                title: "Enter your last name:",
                type: "text"
            }, {
                name: "MiddleName",
                title: "Enter your middle name:",
                type: "text"
            }, {
                name: "Suffix",
                title: "Enter your suffix:",
                type: "text"
            }, {
                name: "Age",
                title: "Enter your age:",
                type: "text"
            }]
        };

        const survey = new Survey.Model(surveyJson);

        function alertResults (sender) {
            const results = JSON.stringify(sender.data);
            alert(results);
        }

        survey.onComplete.add(alertResults);

        $(function() {
            $("#surveyContainer").Survey({ model: survey });
        });
    </script>

<?= $this->endSection() ?>