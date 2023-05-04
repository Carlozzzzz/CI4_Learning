<?= $this->extend('template/main') ?>

<?= $this->section('content')?>

<style>
/* Style the tab */
.custom-tabpane .tab {
    overflow: hidden;
    background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.custom-tabpane .tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of buttons on hover */
.custom-tabpane .tab button:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
.custom-tabpane .tab button.active {
    background-color: #FFFFFF;
}

.custom-tabpane  .logo2 img {
    max-height: 35px;
    margin-right: 6px;
}

</style>

<div class="pagetitle">
    <nav class="float-end">
        <ol class="breadcrumb">
            <!-- <li class="breadcrumb-item"><a href="<?= base_url();?>dashboard" onclick="$.blockUI();">Dashboard</a></li> -->
            <li class="breadcrumb-item">System</li>
            <li class="breadcrumb-item ">My Subjects</li>
            <li class="breadcrumb-item active">Subjects</li>
            
            
        </ol>
    </nav>
    <h1>My Subject</h1>
    <!-- <br> -->
</div>

<section class="section">
    <div class="card custom-tabpane shadow-sm mt-3 p-0">
        <div class="tab">
            <button class="tablinks p-3" onclick="openTab(event, 'sub_subject')" id="defaultOpen"> 
                <small class="d-flex align-items-center"><i class="ri-book-fill me-1"></i>Subject</small>
            </button>
            <button class="tablinks p-3" onclick="openTab(event, 'sub_quiz')">
                <small class="d-flex align-items-center"><i class="ri-ball-pen-fill me-1"></i>Quiz</small>
            </button>
            <button class="tablinks p-3" onclick="openTab(event, 'sub_students')">
                <small class="d-flex align-items-center"><i class="ri-team-fill me-1"></i>Students</small>
            </button>
        </div>

        <div id="sub_subject" class="tabcontent p-3">
            <h3><?= $data_recordfile[0]['subject']?></h3>
            <p>Subject Content</p>
        </div>

        <div id="sub_quiz" class="tabcontent p-3">
            <h3>Quiz</h3>
           
                <div class="border border-1 rounded-1 d-flex align-items-center text-dark p-2">
                    <span class="logo2 me-0 bg-dark p-3 me-2 rounded-1"><img class="" src="<?= base_url() ?>assets/img/logo.png" alt=""></span>
                    <div class="qui-details w-100 me-2">
                        <h4 class="mb-1">Quiz Title</h4>
                        <p class="text-muted mb-0">Description</p>
                    </div>
                    <button class="btn btn-white btn-flat paper-shadow relative fw-bold p-2"><span class="fs-3"><i class="bi bi-pencil"></i></span></button>
                </div>
        </div>

        <div id="sub_students" class="tabcontent p-3">
            <h3>Students</h3>
            <p>Students progress for each quiz</p>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<script type="text/javascript">
    function save() {
        Swal.fire({
            title: "Are you sure?",
            text: "You want to submit this record?",
            icon: "warning",
            allowOutsideClick: false,
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, submit it!",
        }).then((result) => {
            if (result.value) {
                $.blockUI();
                if (checkhassession()) {
                    xdata = jQuery("#myform").serialize();
                    jQuery.ajax({
                        url: "<?= base_url().$data_activepage?>/submitsave",
                        method: "POST",
                        data: xdata,
                        dataType: "JSON",
                        success: function(xret) {
                            $.unblockUI();
                            if (xret.bool) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Your work has been saved',
                                    text: xret.msg,
                                    allowOutsideClick: false
                                }).then((result) => {
                                    if (result.value) {
                                        $.blockUI();
                                        window.location.href =
                                            "<?= base_url().$data_activepage?>/assignsubject/<?= $data_teacherid ?>";
                                    }
                                });
                            } else if (xret.bool == false) {
                                Swal.fire({
                                    icon: 'error',
                                    title: xret.msg,
                                    allowOutsideClick: false
                                });
                            }
                        }

                    });
                }
            }
        });
    }

    function update() {
        Swal.fire({
            title: "Are you sure?",
            text: "You want to submit the record?",
            icon: "warning",
            allowOutsideClick: false,
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, submit!",
        }).then((result) => {
            if (result.value) {
                $.blockUI();
                if (checkhassession()) {
                    xdata = jQuery("#myform").serialize();
                    jQuery.ajax({
                        url: "<?= base_url().$data_activepage; ?>/submitupdate/<?= isset($data_recordfile[0]['encryptid']) && $data_recordfile[0]['encryptid'] != "" ? $data_recordfile[0]['encryptid'] : "" ?>",
                        method: "POST",
                        data: xdata,
                        dataType: "JSON",
                        success: function(xret) {
                            $.unblockUI();
                            if (xret.bool) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Your work has been saved!",
                                    text: xret.msg,
                                    allowOutsideClick: false,
                                }).then((result) => {
                                    if (result.value) {
                                        window.location.href =
                                            "<?= base_url().$data_activepage?>/assignsubject/<?= $data_teacherid ?>";
                                    }
                                });
                            } else if (xret.bool == false) {
                                Swal.fire({
                                    icon: "error",
                                    title: xret.msg,
                                    allowOutsideClick: false,
                                });
                            }
                        },
                    });
                } else {
                    window.location.href = "<?= base_url(); ?>template/errorpage";
                }
            }
        });
    }

    function cancel() {
        Swal.fire({
            title: "Are you sure?",
            text: "You want to leave this page?",
            icon: "warning",
            allowOutsideClick: false,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "Yes, discard it!",
        }).then((result) => {
            if (result.value) {
                $.blockUI();
                window.location.href = "<?= base_url().$data_activepage?>/assignsubject/<?= $data_teacherid ?>";
            }
        });
    }
</script>

<!-- Teacher -->
<script type="text/javascript">
        
    jQuery(document).ready(function(){
        document.getElementById("defaultOpen").click();
    });

    function openTab(evt, div_targetID) {
        let i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");

        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        tablinks = document.getElementsByClassName("tablinks");

        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        document.getElementById(div_targetID).style.display = "block";
        evt.currentTarget.className += " active";
    }

</script>
<?= $this->endSection(); ?>