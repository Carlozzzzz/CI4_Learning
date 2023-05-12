<?= $this->extend('template/main') ?>

<?= $this->section('content')?>

    <div class="pagetitle">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url();?>dashboard" onclick="$.blockUI();">Dashboard</a></li>
            <li class="breadcrumb-item">System</li>
            <li class="breadcrumb-item">Fetching from API</li>
            <li class="breadcrumb-item active">satellitelocationfile</li>
        </ol>
        </nav>
    </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-12 py-3">
                    <h3 class="mb-0">Satellite Location From API</h3>
                    <p class="mt-3">
                        Latitude: <span id="lat"></span><br>
                        Longtide: <span id="long"></span><br>
                        Velocity: <span id="velocity"></span>
                    </p>
                </div>
                <div class="col-12" id="issMap"></div>
            </div>
        </section>
       
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
       
    <script type="text/javascript">
        const api_url = 'https://api.wheretheiss.at/v1/satellites/25544';
        const lat = document.getElementById("lat");
        const long = document.getElementById("long");
        const velo = document.getElementById("velocity");
        let firstTime = true;

        // Initialize the Map and tiles
        const myMap = L.map('issMap').setView([0, 0], 1);
        const attribution =  '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>';
        const tileUrl = 'https://tile.openstreetmap.org/{z}/{x}/{y}.png';
        const tiles = L.tileLayer(tileUrl, {attribution});
        tiles.addTo(myMap);

        // Initialize Marker with custom icon
        const issIcon = L.icon({
            iconUrl: "<?=base_url()?>assets/img/issLogo.png",
            iconSize: [55, 32],
            iconAnchor: [25, 16],
        });
        const marker = L.marker([0, 0], { icon : issIcon }).addTo(myMap);

        async function getISS(){
            const response = await fetch (api_url);
            const data = await response.json();
            const { latitude, longitude, velocity } = data;  // destructuring

            marker.setLatLng([latitude, longitude]);
            if(firstTime)
            {
                myMap.setView([latitude, longitude], 2);
                firstTime = false;
            }
            lat.textContent = latitude;
            long.textContent = longitude;
            velo.textContent = velocity;

        }

        // Start the Application
        getISS();
        setInterval(getISS, 1000);

    </script>
        
<?= $this->endSection(); ?>