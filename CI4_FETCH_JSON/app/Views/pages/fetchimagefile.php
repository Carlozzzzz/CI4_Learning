<?= $this->extend('template/main') ?>

<?= $this->section('content')?>

    <div class="pagetitle">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url();?>dashboard" onclick="$.blockUI();">Dashboard</a></li>
            <li class="breadcrumb-item">System</li>
            <li class="breadcrumb-item">Fetching from API</li>
            <li class="breadcrumb-item active">fetchimagefile</li>
        </ol>
        </nav>
    </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-12 py-3">
                    <h3 class="mb-0">Fetch Image</h3>
                </div>
                <div class="col-md-6">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla sed leo ac sapien sodales sagittis ac eu eros. Integer a arcu vel mi gravida hendrerit at a enim.</p>
                </div>
                <div class="col-md-6">
                    <img id="imageDiv" class="img-fluid" alt="Responsive image">
                </div>
            </div>
        </section>
       
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
       
    <script type="text/javascript">
        const imageDiv = document.getElementById("imageDiv");
        const imageLocation = "<?= base_url()?>assets/img/login_logo.png";

        fetch(imageLocation)
            .then( response => {
                console.log(response)
                return response.blob();
            })
            .then(blob => {
                console.log(blob);
                imageDiv.src = URL.createObjectURL(blob);
            })
            .catch(error => {
                console.log(error);
            });
    </script>
        
<?= $this->endSection(); ?>