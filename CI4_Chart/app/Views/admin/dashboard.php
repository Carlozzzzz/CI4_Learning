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
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Flash Report:</label>
                        <select name="select_flashreport" id="select_flashreport" class="form-control">
                            <option value="">Select</option>
                            <?php

                            if (!empty($sessions)) {
                                foreach ($sessions as $session) {
                                    if ($session["sessions_id"] != '') {
                                        ?>
                                        <option value="<?= $session["sessions_id"] ?>"><?= $session["sessions_id"] ?></option>
                                        <?php
                                    }
                                }
                            }
                            ?>
                        </select>
                        
                    </div>
                </div>
                <div class="col-md-9">
                    <canvas id="flashChart" height="100"></canvas>
                </div>

                <div class="col-md-3" style="margin-top: 10px;">
                    <div class="form-group">
                        <label>Polling Report:</label>
                        <select name="select_pollreport" id="select_pollreport" class="form-control">
                            <option value="">Select</option>
                            <?php

                            if (!empty($sessions)) {
                                foreach ($sessions as $session) {
                                    if ($session["sessions_id"] != '') {
                                        ?>
                                        <option value="<?= $session["sessions_id"] ?>"><?= $session["sessions_id"] ?></option>
                                        <?php
                                    }
                                }
                            }
                            ?>
                        </select>
                        
                    </div>
                </div>
                <div class="col-lg-9">
                    <canvas id="pollingChart" height="100"></canvas>
                </div>

               
            </div>
        </div>
    </div>
    <!-- end: Chart -->
    
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

    <script type="text/javascript">
        var flashChart, pollingChart;

        $(document).ready(function () {
            displayFlashReportChart(<?php echo json_encode($flash_report_list); ?>);
            displayPollingReportChart(<?php echo json_encode($poll_list); ?>, <?php echo json_encode($polling_report_list); ?>);
            
        });

        $(document).ready(function() {
            $('#select_flashreport').change(function() {
                var selectedValue = $(this).val();
                var xdata = "&selectedValue="+selectedValue;
                if (selectedValue !== '') {
                    $.ajax({
                        url: "<?= base_url() ?>admin/dashboard/get_new_flashreport", 
                        method: 'POST',
                        data: xdata,
                        dataType: 'json',
                        success: function(response) {
                            if(flashChart)
                            {
                                flashChart.destroy();
                            }
                            if(response.chartData)
                            {
                                displayFlashReportChart(response.chartData);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr + status + error);
                        }
                    });
                }
            });

            $('#select_pollreport').change(function() {
                var selectedValue = $(this).val();
                var xdata = "&selectedValue="+selectedValue;
                if (selectedValue !== '') {
                    $.ajax({
                        url: "<?= base_url() ?>admin/dashboard/get_new_pollreport", 
                        method: 'POST',
                        data: xdata,
                        dataType: 'json',
                        success: function(response) {
                            if(pollingChart)
                            {
                                pollingChart.destroy();
                            }
                            if(response.poll_list && response.polling_report_list)
                            {
                                console.log(response);
                                displayPollingReportChart(response.poll_list, response.polling_report_list);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr + status + error);
                        }
                    });
                }
            });
        });

        function displayFlashReportChart(chartData) {
            let ctx = document.getElementById('flashChart').getContext('2d');
            // var chartData = <?php //echo json_encode($flash_report_list); ?>;
            // console.log(chartData);
            let attendeeCount = 0;
            let total_chat = 0; 
            let total_questions = 0;
            let total_polls = 0;
            let labels = ["Attendees", "Total Chats", "Total Questions", "Total Polls"];
            let dataPoints = [];
            
            // Count the attendees here
            chartData.forEach(function() {
                attendeeCount++;
            });
            dataPoints.push(attendeeCount);
            // Process the Number of Chats here
            chartData.forEach(function(item) {
                total_chat += item.total_chat;
            });
            dataPoints.push(total_chat);
            // Process the Number of Questions here
            chartData.forEach(function(item) {
                total_questions += item.total_questions;
            });
            dataPoints.push(total_questions);
            // Process the Number of Polls here
            chartData.forEach(function(item) {
                total_polls += item.total_polls;
            });
            dataPoints.push(total_polls);

            flashChart = new Chart(ctx, {
                type: 'bar',
                data: {
                labels: labels,
                datasets: [{
                    label: 'Flash Report',
                    data: dataPoints,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        ],
                    borderWidth: 1,
                }]
                },
                options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
                }
            });
        }

        function displayPollingReportChart(pollData, pollReportData) {
            let ctx = document.getElementById('pollingChart').getContext('2d');
            let total_polls = 0;
            let answered_polls = 0;
            let unanswered_polls = 0;
            let labels = ["Polls", "Total Poll Answers", "Total Unanswered Polls"];
            let dataPoints = [];
            
            pollData.map( data => {
                console.log(data);
            });

            // Count the Poll here
            pollData.forEach(function() {
                total_polls++;
            });
            dataPoints.push(total_polls);
            
            // Process the Total Answer and Unanswered Polls here
            pollReportData.forEach(function(report) {
                report.polling_answer.forEach(function(answer) {
                    // console.log(answer);
                    if(answer)
                    {
                        answered_polls++;
                    }
                });
                
                const checkNull = report.polling_answer.every(answer => answer === '');
                if(checkNull)
                {
                    unanswered_polls++;
                }
            });
            dataPoints.push(answered_polls);
            dataPoints.push(unanswered_polls);

            pollingChart = new Chart(ctx, {
                type: 'bar',
                data: {
                labels: labels,
                datasets: [{
                    label: 'Polling Report',
                    data: dataPoints,
                    backgroundColor: [
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        ],
                    borderColor: [
                        'rgb(255, 159, 64)',
                        'rgb(75, 192, 192)',
                        'rgb(255, 205, 86)',
                        'rgb(255, 99, 132)',
                        ],
                    borderWidth: 1,
                }]
                },
                options: {
                scales: {
                    y: {
                    beginAtZero: true
                    }
                }
                }
            });
        }



    
    </script>

<?= $this->endSection() ?>