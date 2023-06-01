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
            
            <div class="g-signin2" data-onsuccess="onSignIn"></div>
        </div>
    </div>
    <!-- end: Chart -->
    
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

    <script type="text/javascript">
        function onSignIn(googleUser) {
            var profile = googleUser.getBasicProfile();
            console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
            console.log('Name: ' + profile.getName());
            console.log('Image URL: ' + profile.getImageUrl());
            console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
        }
        

        function signOut() {
            var auth2 = gapi.auth2.getAuthInstance();
            auth2.signOut().then(function () {
            console.log('User signed out.');
            });
        }
    </script>

<?= $this->endSection() ?>