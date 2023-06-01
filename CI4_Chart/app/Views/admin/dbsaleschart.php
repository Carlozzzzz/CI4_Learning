<?= $this->extend('template/main')?>

<?= $this->section('content') ?>

<style>
    .StepTitle{
        font-size: 14px;
    }
    .custom-aligner {
        margin: 20px;
    }

    .chart-width {
        width: 100px;
    }
</style>

<div class="main-content">
    <!-- start: Chart -->
    <div class="wrap-content container" id="container">
        <div class="container-fluid container-fullw bg-white">
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- end: Chart -->
    
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

    <script type="text/javascript">
        const baseurl = "<?= base_url() ?>";

        const myChart = (chartType) => {
            jQuery.ajax({
                url: baseurl + 'admin/dbsaleschart/getSalesData',
                dataType: "JSON",
                method: "GET",
                success: data => {
                    let chartX = [];
                    let chartY = [];
                    console.log(data);
                    data.map( item => {
                        chartX.push(item.month);
                        chartY.push(item.sales);
                    })
                    
                    // Initializing and setting chart data
                    const chartData = {
                        labels: chartX,
                        datasets:
                        [
                            {
                                label: 'Sales',
                                data: chartY,
                                backgroundColor: ['lightcoral'],
                                borderColor: ['lightcoral'],
                                borderWidth: 4
                            }
                        ]
                    }

                    // Initialize the canvas where you display the chart
                    // const ctx = document.getElementById(chartType).getContext('2d');
                    const ctx = document.getElementById('barChart').getContext('2d');

                    const config = {
                        type: chartType,
                        data: chartData
                    }

                    // BG and Border for Chart type
                    switch(chartType) {
                        case 'pie':
                            const pieColor = ['salmon', 'red', 'green', 'blue', 'aliceblue', 'pink', 'gold', 'plum', 'darkcyan', 'wheet', 'silver'];
                            chartData.datasets[0].backgroundColor = pieColor;
                            chartData.datasets[0].borderColor = pieColor;
                            break;
                        case 'bar':
                            chartData.datasets[0].backgroundColor = ['skyblue'] 
                            chartData.datasets[0].borderColor = ['skyblue']
                            break;
                        default:
                            config.options = {
                                scales : {
                                    y : {
                                        beginAtZero: true
                                    }
                                }
                            }
                    }
                    const chart = new Chart(ctx, config);

                    
                },
                error: function(xhr, status, error) {
                    console.log(xhr + status + error);
                }
            })
        }

        myChart('line');
    </script>

<?= $this->endSection() ?>