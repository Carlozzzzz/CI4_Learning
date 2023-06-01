<?= $this->extend('template/main') ?>

<?= $this->section('content')?>

    <div class="pagetitle">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url();?>dashboard" onclick="$.blockUI();">Dashboard</a></li>
            <li class="breadcrumb-item">System</li>
            <li class="breadcrumb-item">Fetching from API</li>
            <li class="breadcrumb-item active">datafetchfile</li>
        </ol>
        </nav>
    </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-12 py-3">
                    <h3 class="mb-3">Single and Multiple Fetch of data</h3>
                    <p class="mb-0">using <strong>Async</strong> and <strong>Await</strong></p>
                    <p>open your console to see the results...</p>

                    <p>Sample: <span id="descriptionData">...</span></p>
                </div>
                
            </div>
        </section>
       
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
    <script>
        const descriptionData = document.getElementById("descriptionData");
        const url = 'https://jsonplaceholder.typicode.com/todos/1';

        let myArr = [];
        const responseData = fetch(url)
            .then(response => {
                return response.json();
            })
            .then(loadData => {
                return loadData;
            });
        
            responseData.then( data => {
                console.log(data)
            })
    </script>

        
<?= $this->endSection(); ?>