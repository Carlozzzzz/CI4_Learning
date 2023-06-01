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
                    <a href="<?= base_url('datafetchfile/datafetch_file2')?>" class="btn btn-primary">Practice</a>
                </div>
                
            </div>
        </section>
       
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
       
    <!-- Single Fetch data -->
    <script type="text/javascript">
        // Defined your global variables here
        const descriptionData = document.getElementById("descriptionData");
        const url = 'https://jsonplaceholder.typicode.com/todos/1';

        const responseData = fetch(url)
            .then( response => {
                // console.log(response);
                return response.json();
            })
            .then( loadData => {
                return loadData;
            })
            .catch(error => {
                console.log(error);
            });
        
        responseData.then( data =>{
            // console.log(data);
            descriptionData.textContent = data.title;
        });
       

    </script>

    <!-- Single Fetch data using ASYNC / AWAIT-->
    <script>
        const url2 = 'https://jsonplaceholder.typicode.com/todos/2';

        const LoadData = async () => {
            try {
                const res = await fetch(url2);
                const data = await res.json();

                return data;
            } catch (error) {
                return error;
            }
        };

        LoadData().then( data => console.log(data));

    </script>

    <!-- Multiple Fetch data using ASYNC / AWAIT-->
    <script>
        const url1 = 'https://jsonplaceholder.typicode.com/todos/1';
        const url3 = 'https://jsonplaceholder.typicode.com/todos/1';

        const LoadMultipleData = async () => {
            try {
                const results = await Promise.all([
                    fetch(url1),
                    fetch(url2),
                    fetch(url3)
                ]);

                const dataResponses = results.map( result => result.json())
                const finalData = await Promise.all(dataResponses);

                return finalData;

            } catch (error) {
                
            }
        }

       LoadMultipleData().then(data => console.log(data));
    </script>

        
<?= $this->endSection(); ?>